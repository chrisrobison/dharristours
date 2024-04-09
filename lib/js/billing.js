(function() {
    const $ = str => document.querySelector(str);
    const $$ = str => document.querySelectorAll(str);

    let app = {
        allbusiness: allbusiness,
        body: [],
        config: {
            perpage: 100,
        },
        async filter(evt, col) {
            let txt = evt.target.value;
            let newjobs = [];
            app.state.focus = evt.target;
            app.state.searchValue = txt;
            app.state.searchField = col;
            if (txt) {
                for (let job of app.jobs) {
                    if (job) {
                        let re = new RegExp(txt, "i");
                        if (col == "InvoiceID") {
                            if (job.related_Invoice[0].InvoiceID.match(re)) {
                                    //console.log(`Got match!`);
                                    //console.dir(job);
                                newjobs.push(JSON.parse(JSON.stringify(job)));
                            }
                        } else {
                            if (typeof(job[col]) === "string") {
                                if (job[col].match(re)) {
                                    //console.log(`Got match!`);
                                    //console.dir(job);
                                    newjobs.push(JSON.parse(JSON.stringify(job)));
                                } 
                            }
                        }
                    }
                }

                if (newjobs.length) {
                    await app.renderJobs(newjobs);
                }

                setTimeout(function() {
                    document.querySelector(`#search-${app.state.searchField}`).value = app.state
                        .searchValue;
                    document.querySelector(`#search-${app.state.searchField}`).focus();
                }, 100);
            } else {
                app.currentJobs = [];
                app.jobs.forEach(job => {
                    app.currentJobs.push(JSON.parse(JSON.stringify(job)))
                });
                app.renderJobs(app.currentJobs);
            }
        },
        async init() {
            $("#overlay").style.display = "flex";
            app.worker = new Worker("/files/worker.js", { type: "module" } );
            app.worker.onmessage = app.handleMessage;

            let sd = app.getConfig("startdate");
            let ed = app.getConfig("enddate");
            if (sd) $("#startdate").value = sd.substring(0, 10);
            if (ed) $("#enddate").value = ed.substring(0, 10);

            let tmpcnt = app.getConfig("count");
            if (tmpcnt && tmpcnt > 9) {
                app.config.perpage = tmpcnt;
                $("#count").value = tmpcnt;
            }
            
            let cache = JSON.parse(localStorage.getItem('jobs'));

            if (cache) {
                await app.receiveJobs({results: cache}, 1);
            }

            let myview = localStorage.getItem("view");
            if (myview) {
                setTimeout(function() {
                    $("#view").value = myview;
                }, 1000);
                for (let opt of $("#view").options) {
                    if (opt.value == myview) {
                        app.currentJobs = app.jobs;
                        opt.selected = true;
                    };
                }
            }
            
            $("#resize").addEventListener("mousedown", app.doDown);
            document.addEventListener("keydown", app.doKey);
            //app.initCalendar();
            // app.currentJobs = JSON.parse(JSON.stringify(app.jobs));
            
            let startdate = $("#startdate").value;
            let enddate = $("#enddate").value;
            app.fetchJobs(startdate, enddate);
/*
            app.jobs = await app.fetchJobs(startdate, enddate);
            for (let i = 0; i < app.jobs.length; i++) {
                if (app.jobs[i]) {
                    $("#loading").innerHTML = `Updating Job ${i} of ${app.jobs.length}`;
                    app.jobs[i].Business = app.allbusiness[app.jobs[i].BusinessID].Business;
                }
            }
            app.currentJobs = app.jobs;
            app.renderJobs(app.currentJobs);
            $("#overlay").style.display = "none";
*/
        },
        // Handles web worker messages. Expects data in message 
        // to have a 'results' property containing the data and a
        // 'cb' or 'callback' property that contains the function to 
        // send the 'results' data to
        handleMessage(evt) {
            //console.log("handling message");
            //console.dir(evt);

            let data = evt.data;
            
            if (!data.cb && data.callback) data.cb = data.callback;

            if (data.results && data.cb) {
                app[data.cb](data.results);
            }
        },
        async receiveJobs(data, doani=0) {
            //console.log(`receiveJobs results`);
            //console.dir(data);
            if (data.results) {
                app.jobs = data.results;
                localStorage.setItem('jobs', JSON.stringify(data.results));

                for (let item of app.jobs) {
                    if (item) {
                        item.Business = allbusiness[item.BusinessID];
                    }
                }
            }
            app.currentJobs = app.jobs;
            app.changeView($("#view").value);
            // await app.renderJobs(app.currentJobs);
            if (doani) {
                $(".loading").classList.add("run");
            } else {
                $(".loading").classList.remove("run");
            }

            return data.results;
        },
        async fetchJobs(start, end) {
            $("#overlay").style.display = "flex";
            $("#loading").innerHTML = `...`;
            $(".loading").classList.remove("run");

            let cache = JSON.parse(localStorage.getItem('jobs'));

            if (cache) {
                app.receiveJobs({results: cache}, 1);
            }
            let now = new Date().getTime();
            if (!start) {
                start = new Date("2023-01-01").getTime();
            }
            if (!end) end = now + 1209600000;

            let sdate = new Date(start).toISOString().substring(0, 10);
            let edate = new Date(end).toISOString().substring(0, 10);
            app.worker.postMessage({action: "fetchJobs", args: [sdate, edate], cb: "receiveJobs"});
        },
        formatCurrency(val) {
            return Intl.NumberFormat("en-US", {
                style: 'currency',
                currency: 'USD'
            }).format(val);
        },
        initCalendar() {
            app.picker = new easepick.create({
                element: "#startdate",
                css: [
                    "https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.css"
                ],
                zIndex: 99999,
                plugins: [
                    "RangePlugin",
                    "PresetPlugin",
                    "KbdPlugin"
                ],
                setup(picker) {
                    picker.on("select", (e) => {
                        app.filterDates(e.detail.start, e.detail.end);
                    });
                },
                onClickCalendarDay: function() {
                    let start = app.picker.getStartDate();
                    let end = app.picker.getEndDate();

                    if (start && end) {
                        app.filterDates(start + ' - ' + end);
                    }
                }
            })
        },
        validDate(d) {
            return d instanceof Date && !isNaN(d);             
        },
        async filterDates(startDate, endDate) {
            $("#overlay").style.display = "flex";
            if (!startDate) {
                startDate = $("#startdate").value;
            }
            if (!endDate) {
                endDate = $("#enddate").value;
            }
            
            let m;
            let startOk = 0;
            let endOk = 0;
            if (m = startDate.match(/(\d\d\d\d)\-(\d+)\-(\d+)/)) {
                let tmpyr = parseInt(m[1]);
                let tmpmo = parseInt(m[2]);
                let tmpday = parseInt(m[3]);
                
                if ((tmpyr > 2022) && (tmpmo > 0) && (tmpday > 0) && (tmpday < 32)) {
                    startOk = 1;
                }
            }
            if (m = endDate.match(/(\d\d\d\d)\-(\d+)\-(\d+)/)) {
                let tmpyr = parseInt(m[1]);
                let tmpmo = parseInt(m[2]);
                let tmpday = parseInt(m[3]);
                
                if ((tmpyr > 2022) && (tmpmo > 0) && (tmpday > 0) && (tmpday < 32)) {
                    endOk = 1;
                }
            }

            if (startOk && endOk) {
                $("#overlay").style.display = "flex";

                if (!endDate) endDate = startDate;
                if (typeof(startDate) === "string") {
                    startDate = new Date(startDate);
                }
                if (typeof(endDate) === "string") {
                    endDate = new Date(endDate);
                }
                
                if (app.validDate(startDate) && app.validDate(endDate)) {
                    //console.log( `Filtering dates for ${startDate.toISOString()} - ${endDate.toISOString()}`);
                    let start = startDate.getTime();
                    let end = endDate.getTime();
                    let range = startDate.toISOString() + ' - ' + endDate.toISOString();
                    let search = location.search.replace(/^\?/, '');
                    if (search) search = '&' + search;
                    app.storeConfig("startdate", startDate);
                    app.storeConfig("enddate", endDate);

                    // document.location.href = document.location.origin + document.location.pathname + '?range=' + encodeURIComponent(range) + search;
                    let filteredJobs = [];
                    let newjobs = await app.fetchJobs(startDate, endDate);
                    /*
                    app.jobs.forEach(job=>{
                        if (job) {
                            let jobdate = new Date(job.JobDate).getTime();
                            console.log(`start: ${start}  end: ${end}  jobdate: ${jobdate}`);
                            if ((jobdate > start) && (jobdate < end)) {
                                filteredJobs.push(job);
                            }
                        }
                    });
                    */
                    app.jobs = newjobs;
                    app.currentJobs = newjobs;
                    //app.renderJobs(app.currentJobs);
                    app.changeView($("#view").value);
                    $("#overlay").style.display = "none";
                }
            }
        },
        doCheckbox(e) {
            //console.log("doCheckbox");
            //console.dir(e);

            if ((e.shiftKey) && (app.lastCheck)) {
                let row = e.target.closest("tr");
                let lastrow = app.lastCheck.closest("tr");

                let lastrowidx = parseInt(lastrow.dataset.index);
                let rowidx = parseInt(row.dataset.index);

                if (lastrowidx < rowidx) {
                    let currow = lastrow.nextElementSibling;
                    for (let i = lastrowidx; i < rowidx - 1; i++) {
                        currow.querySelector(".job-select").setAttribute("checked", true);
                        currow = currow.nextElementSibling;
                    }
                } else {
                    let currow = lastrow.previousElementSibling;
                    for (let i = lastrowidx; i > rowidx + 1; i--) {
                        currow.querySelector(".job-select").setAttribute("checked", true);
                        currow = currow.previousElementSibling;

                    }
                }
            }
            $("#all-jobs").checked = true;
            app.lastCheck = e.target;
            setTimeout(function() {
                app.sumCheckbox();
            }, 10);
        },
        sumCheckbox() {
            let sum = 0;
            let boxes = $$(".job-select:checked");
            if (!boxes.length) {
                app.sumCurrentView();
            }
            $$(".job-select").forEach(chkbox => {
                if (chkbox.checked) {
                    let tr = chkbox.closest("tr");
                    if (tr.dataset.jobid) {
                        let job = app.jobs.find(el => el.JobID == tr.dataset.jobid);
                        let inv = job.related_Invoice;

                        if (inv && inv[0]) {
                            let invtot = parseFloat(inv[0].Balance);
                            if (!isNaN(invtot)) sum += invtot;
                        }

                    }
                }
            });
            $("#sumtotal").innerHTML = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD'
            }).format(sum);
            $("#sumlabel").innerHTML = "Total for Selected Invoices";
            return sum;
        },
        toggleSearch(forceHide) {
            if (!forceHide) {
                $("#searchbar").classList.toggle("showsearch");
            } else {
                $("#searchbar").classList.remove("showsearch");
            }

            if (!$("#searchbar").classList.contains("showsearch")) {
                app.currentJobs = [];
                app.jobs.forEach(job => {
                    app.currentJobs.push(JSON.parse(JSON.stringify(job)))
                });
                app.renderJobs(app.currentJobs);
            }
        },
        selectRow(e) {
            let row = e.target.closest("tr");
            let rowrect = row.getBoundingClientRect();
            if (row) {
                $$(".selected").forEach(el => el.classList.remove("selected"));
                row.classList.add("selected");
                setTimeout(function() {
                    row.scrollIntoView(true);
                    setTimeout(function() {

                        row.closest(".scrollWrap").scrollBy(0, -rowrect.height);
                    }, 300);
                }, 600);
            }
        },
        doKey(e) {
            switch (e.key) {
                case "Escape":
                    app.hideJob();
                    break;
                case "Enter":

                    break;
                
                default:
            }
        },
        doDown(e) {
            let frame = document.querySelector("#jobframe");

            document.addEventListener("mousemove", app.doMove);
            document.addEventListener("mouseup", app.doUp);
            let rect = $("#jobview").getBoundingClientRect();

            app.state.resize = {
                y: rect.y
            };
            app.state.jobview = document.querySelector("#jobview");
            app.state.jobview.style.transitionDuration = "0ms";

            $("#jobframe").style.display = "none";

            app.state.jobview.style.top = e.clientY + 'px';
            app.state.jobview.style.height = window.innerHeight - e.clientY + 'px';

            $("#jobframe").style.height = window.innerHeight - e.clientY + 'px';
            console.dir(e);
        },
        doMove(e) {
            app.state.resize.y += e.movementY;
            app.state.jobview.style.top = e.clientY + 'px';
            app.state.jobview.style.height = window.innerHeight - e.clientY + 'px';
            $("#jobframe").style.height = window.innerHeight - e.clientY + 'px';

            e.preventDefault();
        },
        doUp(e) {
            document.removeEventListener("mousemove", app.doMove);
            document.removeEventListener("mouseup", app.doUp);
            $("#jobframe").style.display = "block";
            app.state.viewerTop = e.y;
            app.state.viewerHeight = window.innerHeight - e.y;
            app.storeConfig("viewerHeight", app.state.viewerHeight);
            app.storeConfig("viewerTop", app.state.viewerTop);
        },
        storeConfig(key, val) {
            localStorage.setItem(key, JSON.stringify(val));
        },
        getConfig(key) {
            return JSON.parse(localStorage.getItem(key));
        },
        showViewer(title) {
            let t = app.getConfig("viewerTop") || window.innerHeight / 2;
            $("#viewer-title").innerHTML = title;
            $("#jobview").style.top = t + 'px';
            $("#jobview").style.height = `calc( 100vh - ${t}px )`;
            $("#jobview").classList.add("open");
        },
        show(url, title = "Viewer") {
            app.showViewer(title);
            $("#jobframe").src = url;
        },
        showParent(id) {
            app.showViewer("Master Invoice");
            $("#jobframe").src = `/files/templates/MasterInvoice.php?id=${id}`;
        },
        showJob(id) {
            app.showViewer("Job ID: " + id);
            $("#jobframe").src = `view.php?rsc=Job&id=${id}&tpl=Jobs6_2.php`;
        },
        hideJob() {
            $("#jobview").style.top = "100vh";
            $("#jobview").style.height = "0";
            $("#jobview").classList.remove("open");
        },
        showCurrentJobs(checked) {
            let now = new Date();
            let newjobs = [];
            if (checked) {
                app.jobs.forEach(job => {
                    if (job) {
                        let then = new Date(job.JobDate);
                        if (then.getTime() < now.getTime()) {
                            newjobs.push(JSON.parse(JSON.stringify(job)));
                        }
                    }
                });
            } else {
                newjobs = app.jobs;
            }
            app.currentJobs = newjobs;
            app.renderJobs(newjobs);
        },
        showCompleted() {
            location.href = location.origin + location.pathname + '?complete=1' + location.search.replace(
                /^\?/, '');

        },
        // Resets view (shows all records)
        resetView() {
            $$("#jobs tbody tr").forEach(el => el.classList.remove('hidden'));
        },
        hideAll() {
            $$("#jobs tbody tr").forEach(el => el.classList.add("hidden"));
        },
        showAll() {
            $("#loading").innerHTML = `Loading ${app.jobs.length} records...`;
            let newjobs = [];
            let bid = $("#BusinessID").value;
            
            for (const job of app.jobs) {
               if ((bid == 332) || (job.BusinessID==bid)) {
                    newjobs.push(job);
               } 
            }
            app.currentJobs = newjobs;

            if ($("#current").checked) {
                app.showCurrentJobs(true);
            } else {
                app.renderJobs(app.currentJobs);
            }

        },
        showSent() {
            let list = [];
            let cnt = 0;
            let tot = app.jobs.length;

            for (const job of app.jobs) {
                if (job) {
                    if (job.related_Invoice && job.related_Invoice[0] && (job.related_Invoice[0].InvoiceSent == 1)) {
                        ++cnt;
                        $("#loading").innerHTML = `Found ${cnt} in ${tot} records...`;
                        list.push(job);
                    }
                }
            }
            app.currentJobs = list;
            app.renderJobs(list);                
        },
        showNeedsSent() {
            let list = [];
            let cnt = 0;
            let tot = app.jobs.length;
            let bid = $("#BusinessID").value;

            for (const job of app.jobs) {
                if (job) {
                    if (job.related_Invoice && job.related_Invoice[0] && (job.related_Invoice[0].InvoiceSent == 0) && (job.related_Invoice[0].Balance>0) && ((bid==332) || (job.BusinessID==bid))) {
                        ++cnt;
                        $("#loading").innerHTML = `Found ${cnt} in ${tot} records...`;
                        list.push(job);
                    }
                }
            }
            app.currentJobs = list;
            app.renderJobs(list);                
        },
        showNoInvoice() {
            let noinv = [];
            let cnt = 0;
            let tot = app.jobs.length;
            let bid = $("#BusinessID").value;

            for (const job of app.jobs) {
                if (job) {
                    if ((job.InvoiceID == 0) && (!(job.related_Invoice)) && ((bid==332) || (job.BusinessID==bid))) {
                        ++cnt;
                        $("#loading").innerHTML = `Found ${cnt} in ${tot} records...`;
                        noinv.push(job);
                    }
                }
            }
            app.currentJobs = noinv;
            app.renderJobs(app.currentJobs);
        },
        changeView(view) {
            app.resetView();
            app.state.view = view;
            localStorage.setItem("view", view);

            let cnt = 0, tot = 0, paid = 0, owed = 0;
            switch (view) {
                case "unpaid":
                    let unpaid = [];
                    for (const job of app.currentJobs) {
                        if (job) {
                            if (job.related_Invoice && job.related_Invoice[0] && job.related_Invoice[0].Balance > 0) {
                                unpaid.push(job);
                            }
                        }
                    }
                    app.currentJobs = unpaid;
                    app.renderJobs(unpaid);
                    break;
                case "all":
                    $("#overlay").style.display = "flex";
                    $("#loading").innerHTML = `Loading ${app.jobs.length} records...`;

                    app.showAll();
                    
                    $("#overlay").style.display = "none";
                    break;
                case "no-invoice":
                    $("#overlay").style.display = "flex";
                    
                    app.showNoInvoice();

                    $("#overlay").style.display = "none";

                    break;
                case "invoice-created":
                    $("#overlay").style.display = "flex";

                    app.showNeedsSent();

                    $("#overlay").style.display = "none";
                    
                    break;
                case "invoice-sent":
                    $("#overlay").style.display = "flex";

                    app.showSent();

                    $("#overlay").style.display = "none";
                    
                    break;
                case "paid":
                    cnt = 0;
                    tot = app.jobs.length;
                    let found = [];

                    app.jobs.forEach(job => {
                        if (job) {
                            if (job.related_Invoice && job.related_Invoice[0] && (job.related_Invoice[0].Balance==0)) {
                                ++cnt;
                                $("#loading").innerHTML = `Found ${cnt} PAID in ${tot} records...`;
                                found.push(job);
                            }
                        }
                    });
                    app.currentJobs = found;
                    app.changeView($("#view").value);
                    
                    break;
                case "unassigned":
                    app.hideAll();
                    $$(".unassigned").forEach(el => el.classList.remove('hidden'));
                    break;
                case "assigned":
                    app.hideAll();
                    $$(".assigned").forEach(el => el.classList.remove('hidden'));
                    break;
                case "completed":
                    app.showCompleted();
                    break;
                case "overdue30":
                    app.showPastDue(30);
                    break;
                case "overdue60":
                    app.showPastDue(60);
                    break;
                case "overdue90":
                    app.showPastDue(90);
                    break;
                case "overdue":
                    app.showPastDue();
                    break;
                case "onlymaster":
                    app.showMasterInvoices();
                    break;
            }
        },
        jobs: [],
        async switchBusiness(id) {
            $("#overlay").style.display = "flex";
            let jobs;
            if (id==332) {
                jobs = await app.fetchJobs();
            } else {
                jobs = await app.getBusinessJobs(id);
            }
            $("#overlay").style.display = "none";
        },
        checkAll() {
            let checked = (document.querySelector("#all-jobs").checked);
            if (checked) {
                document.querySelectorAll(".job-select").forEach(el => {
                    el.setAttribute("checked", true);
                    el.checked = true;
                });
            } else {
                document.querySelectorAll(".job-select").forEach(el => {
                    el.removeAttribute("checked");
                    el.checked = false;
                });

            }
        },
        async getMasterInvoice(id) {
            let out;

            // First check if we have the job in memory
            app.masterInvoice.forEach(inv => {
                if (inv && inv.invID == id) out = inv;
            });

            // If not, check the general app.cache
            if (!out) {
                if (app.cache[`InvoiceParent_${id}`]) {
                    return app.cache[`InvoiceParent_${id}`];
                }

                // Otherwise, fetch it from the server and save for later
                //console.log(`Fetching InvoiceParent ID ${id}`);
                const rawResponse = await fetch(`/portal/api.php?type=getMasterInvoice&id=${id}`);
                out = await rawResponse.json();
                app.masterInvoice.push(out);
                app.cache[`InvoiceParent_${id}`] = out;
            }
            return out;
        },
        async getBusinessJobs(id) {
            //console.log(`Fetching jobs for business id ${id}`);
            let startdate = $("#startdate").value;
            let enddate = $("#enddate").value;
            let query = '';
            if (startdate) {
                query += "&start=" + encodeURIComponent(startdate);
            }
            if (enddate) {
                query += "&end=" + encodeURIComponent(enddate);
            }
//            const rawResponse = await fetch(`/portal/api.php?type=getBusinessJobs&bid=${id}${query}`);
//            out = await rawResponse.json();
            //console.log("results for getBusinessJobs for id " + id);
            //console.dir(out);
//            app.jobs = out;
            let newjobs = [];
            let start = new Date(startdate);
            let end = new Date(enddate);

            for (const job of app.jobs) {
                if (job && ((job.BusinessID==id) || (id==332))) {
                    newjobs.push(job);
                }
            }
            app.currentJobs = newjobs;
            app.changeView($("#view").value);
            //app.renderJobs(app.currentJobs);
            
            return app.currentJobs;
        },
        // get Job by id using any means possible
        async getJob(id) {
            let out;

            // First check if we have the job in memory
            for (const job of app.jobs) {
                if (job && job.JobID == id) return job;
            }

            // If not, check the general app.cache
            if (!out) {
                if (app.cache[`Job_${id}`]) {
                    return app.cache[`Job_${id}`];
                }

                // Otherwise, fetch it from the server and save for later
                //console.log(`Fetching job id ${id}`);
                const rawResponse = await fetch(`/portal/api.php?type=getJob&id=${id}`);
                out = await rawResponse.json();
                app.jobs.push(out);
                app.cache[`Job_${id}`] = out;
            }
            return out;
        },
        addPayment() {
            let selected = $$(".job-select:checked");
            let ids = [];
            let ok = 1;
            if (selected) {
                selected.forEach((item) => {
                    ids.push(item.id.replace(/^\D*/g, ''));
                    //console.log(item.id);
                });
                $("#pay-ids").innerHTML = ids.join(", ");
                //console.log(`ids ${ids}`);
                let bn = "", bid=0;
                let payjobs = []; let tot = 0;
                for (const job of app.jobs) {
                    if (job && ids.includes(job.JobID)) {
                        if (!bid) {
                            bid = job.BusinessID;
                            bn = app.allbusiness[bid].Business;
                        }
                        /*if (job.BusinessID !== bid) {
                            alert("Cannot apply single payment to multiple customers. Please select jobs that belong to the same Business.");
                            ok = 0;
                            break;
                        }
                        */
                        if (job && !job.related_Invoice) {
                            alert("NO INVOICE: Cannot accept payment for a job with no invoice. Create an invoice and try again.");
                            ok = 0;
                            break;
                        }
                        payjobs.push(job);
                        tot += parseFloat(job.related_Invoice[0].Balance);
                    }
                }

                if (ok) {
                    $("#pay-business").innerHTML = bn;
                    $("#pay-amount").innerHTML = `$${tot}`;
                    $("#amount").value = tot;
                    $("#payment").showModal();
                }
            }
        },
        formatDate(when=Date.now()) {
            let now = new Date(when);
            let out;

            if (now) {
                let mo = now.getMonth() + 1;
                if (mo < 10) mo = '0' + mo;
                let day = now.getDate();
                if (day < 10) day = '0' + day;
                
                let hr = now.getHours();
                if (hr < 10) hr = '0' + hr;

                let min = now.getMinutes();
                if (min < 10) min = '0' + min;

                let sec = now.getSeconds();
                if (sec < 10) sec = '0' + sec;

                out = `${now.getFullYear()}-${mo}-${day} ${hr}:${min}:${sec}`;
            }
            return out;
        },
        async savePayment() {
            let amt = parseFloat($("#amount").value);
            let notes = $("#Notes").value;

            /**
             * TODO: Need to iterate over selected jobs/invoices 
             *       and apply payment value to their balances.
             *       If more than one job is selected, balance is applied
             *       to each job in the order they are displayed
             *       potentially leaving some checked jobs without any
             *       change to their balance. The idea is to be able to
             *       receive a check for many jobs and apply its 
             *       value to invoice balance (accounts payable)
             *       this payment can be done at any time before or 
             *       after the trip has been complteted, preferably 
             *       before.
             *
             *      So build up a simple update object for job invoices
             *      with adjusted balances as well as a new Receivable 
             *      record with the payment notes and amount and BusinessID, etc
             */
            let out = {Invoice: {}, Payment: {} };
            let sel = $$(".job-select:checked");
            let bid = 0, business = '';
            let myjobids = [], myinvids = [];
            let ok = 1, invid = 0;
            if (sel) {
                for (let i=0; i<sel.length; i++) {
                    let item = sel[i];
                    let jobid = item.closest("tr")?.dataset.jobid;
                    invid = item.closest("tr")?.dataset.invoiceid;
                    myjobids.push(jobid);
                    myinvids.push(invid);
                    let job = await app.getJob(jobid);
                    let baseamt = amt;

                    if (job && job.related_Invoice && job.related_Invoice[0]) {
                        if (!out.Invoice[invid]) out.Invoice[invid] = {};
                        if (!bid) {
                            bid = job.BusinessID; 
                            business = app.allbusiness[bid].Business;
                        }
                        amt = amt - parseFloat(job.related_Invoice[0].Balance);

                        if (amt < 0) {          // Partial payment
                            out.Invoice[invid].Balance = Math.abs(amt);
                            out.Invoice[invid].PaidAmt = parseFloat(job.related_Invoice[0].Paid) + parseFloat(job.related_Invoice[0].Balance);
                            
                            job.related_Invoice[0].Balance = Math.abs(amt);
                            job.related_Invoice[0].PaidAmt = parseFloat(job.related_Invoice[0].Paid) + parseFloat(job.related_Invoice[0].Balance);

                        } else if (amt > 0) {   // We still have money
                            out.Invoice[invid].Balance = "0.00";
                            out.Invoice[invid].PaidAmt = job.related_Invoice[0].Balance;
                        } else {                // No more money.
                            out.Invoice[invid].Balance = "0.00";
                            out.Invoice[invid].PaidAmt = job.related_Invoice[0].Balance;
                            break;
                        }
                    }
                }
                if (amt > 0) {
                    // We still have left over money and no more invoices to apply it to
                    // We need to do something here but I'm not quite sure what...yet.
                    //
                    // I think I know the best way to handle this: add a 'Balance' field to 
                    // the 'Business' table. We can store balances both positive and negative
                    // to it which would make it an easy way to see who owe's what to who.
                    //
                    // In an ideal world, we would have a single Ledger table that accepts both
                    // incoming and outgoing payments or two tables, Incoming (or Receivable) and Outgoing (or Payable)
                    // each containing only their respective types. In either case, it would be a ledger system
                    // 
                    // For now, I am adding a Balance field to the Business table and log any extra amounts here
                    //
                    // [update] There was already a 'Credit' field in the Business table.  I'll just use that instead
                    //
                    out.Business = { };
                    out.Business[bid] =  {
                        Credit: parseInt(job.allbusiness[bid].Credit) + amt
                    }
                }
                if (ok) {
                    // This is where we build up the object for our new Payment
                    let fmt = new Intl.NumberFormat("en-US", { style: "currency", currency: "USD", minimumFractionDigits: 2 });
                    let formatted = fmt.format($("#amount").value);

                    out.Payment.new1 = {
                        Payment: `Received $${formatted} for ${business}`,
                        BusinessID: bid,
                        InvoiceID: invid,
                        InvoiceIDs: myinvids,
                        JobIDs: myjobids,
                        CheckNum: $("#checknum").value,
                        CheckDate: $("#checkdate").value,
                        Amount: $("#amount").value,
                        Notes: notes,
                        ReceivedOn: app.formatDate(Date.now()),
                        ReceivedBy: app.state.email,
                    };

                    $("#overlay").style.display = "flex";
                    // Send off 
                    app.sendPayment(out, myjobids);
                    
                    setTimeout(function() { $("#overlay").style.display = "none"; }, 1000);
                }
            }
        },
        sendPayment(out, myjobids) {
           fetch("/portal/api.php?type=makePayment", {
                method: "POST",
                cache: "no-cache",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(out)
            }).then(r=>r.json()).then(data=>{
                //console.log("makePayment return");
                //console.dir(data);
                alert("Payment applied successfully.");
                if (myjobids.length) {
                    for (const myjobid of myjobids) {
                        $(`#job_${myjobid} > td.balance`).innerHTML = "$0.00";
                        $(`#job_${myjobid} > td.status`).innerHTML = "<span class='badge bg-success'>PAID</span>";
                    }
                }
            });

        },
        makePageNav(jobs, curpage) {
            let jobcnt = jobs.length;

            let totpages = Math.ceil(jobcnt / app.config.perpage);
            let pages = (totpages > 5) ? 5 : totpages;
            let start = curpage - 2;
            let perpage = app.config.perpage;

            if (start < 0) start = 0;

            let startrec = (curpage * parseInt(app.config.perpage)) + 1;
            let endrec = (curpage * parseInt(app.config.perpage)) + parseInt(app.config.perpage);
            if (endrec > jobcnt) endrec = jobcnt;

            let out = "";
            if (jobcnt > perpage) {
                out += ` <label class='viewing'>Viewing: ${startrec}-${endrec}/${jobcnt} </label> `;
                out += `<ul class="pagination pagination-sm float-right">`;

                if (curpage > 0) {
                    out +=
                        `<li class="page-item"><a onclick="return app.goto(0, event);" class="page-link" href="?page=0">«</a></li>`;
                    out +=
                        `<li class="page-item"><a onclick="return app.goto(${Math.abs(curpage - 1)}, event);" class="page-link" href="?page=${Math.abs(curpage - 1)}">‹</a></li>`;
                }
                for (let i = start; i < start + pages; i++) {
                    if (i <= totpages) {
                        active = (curpage == i) ? " style='background:#ff0;' " : "";
                        out +=
                            `<li class="page-item"><a onclick="return app.goto(${i}, event);" class="page-link" ${active} href="?page=${i}">${i+1}</a></li>`;
                    }
                }
                // Add ... if we span any numbers, show if more than 5 pages
                if (pages > 5) {
                    out +=
                        `<li class="page-item"><a onclick="return app.goto(${Math.ceil(jobcnt / perpage)}, event);" class="page-link" href="?page=${Math.ceil(jobcnt /perpage)}">...</a></li>`;
                    out +=
                        `<li class="page-item"><a onclick="return app.goto(${Math.ceil(jobcnt / perpage)}, event);" class="page-link" href="?page=${Math.ceil(jobcnt /perpage)}">${Math.ceil(jobcnt/perpage)}</a></li>`;
                }
                if (totpages > curpage) {
                    out +=
                        `<li class="page-item"><a onclick="return app.goto(${curpage + 1}, event);" class="page-link" href="?page=${curpage + 1}">›</a></li>`;
                    out +=
                        `<li class="page-item"><a onclick="return app.goto(${Math.ceil(jobcnt / perpage) - 1}, event);" class="page-link" href="?page=${Math.ceil(jobcnt / perpage) - 1}">»</a></li>`;
                }
            } else {
                out += ` <label class='viewing'>Viewing: 1-${jobcnt}</label> `;
            }
            $(".page-nav").innerHTML = out;
        },
        sumCurrentView() {
            let sum = 0;
            let quotesum = 0;
            if (app.currentJobs) {
                app.currentJobs.forEach(job => {
                    if (job) {
                        if (job.related_Invoice && job.related_Invoice[0]) {
                            let val = parseInt(job.related_Invoice[0].Balance);
                            if (val && !isNaN(val)) {
                                sum += val;
                            }
                        } else if (job.QuoteAmount) {
                            let qval = parseInt(job.QuoteAmount);
                            if (qval && !isNaN(job.QuoteAmount)) {
                                quotesum += qval;
                            }
                        }
                    }
                });

                $("#quotesumlabel").innerHTML = "Uninvoiced (Quotes) Total";
                $("#quotesumtotal").innerHTML = new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD'
                }).format(quotesum);
                $("#sumlabel").innerHTML = "Total Outstanding for Current View";
                $("#sumtotal").innerHTML = new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD'
                }).format(sum);
            }
        },
        async showPastDue(lateness = 0) {
            $("#overlay").style.display = "flex";
            let overdue = [];
            let now = new Date().getTime();
            let invoices = await app.getInvoices();
            //console.log(`in showPastDue with a lateness of '${lateness}'.  \nMy invoices list: \n`);
            //console.dir(invoices);
            let bid = $("#BusinessID").value;

            let myjobs = [];
            let sum = 0;
            $("#loading").innerHTML = `[1/${invoices.length}]`;
            if (invoices && invoices.length) {
                for (var i = 0; i < invoices.length; i++) {
                    $("#loading").innerHTML = `[${i}/${invoices.length}]`;
                    let inv = invoices[i];
                    if (inv) {
                        let then = new Date(inv.InvoiceDate).getTime();
                        let elapsed = Math.floor(((((now - then) / 1000) / 60) / 60) / 24);
                        if (elapsed > lateness) {
                            if (inv.JobID) {
                                let job = await app.getJob(inv.JobID);
                                if (job) {
                                    job.related_Invoice = [inv];
                                    
                                    if ((job.InvoiceSatisfied == 0) && (job.NoInvoice == 0) && (job.JobCancelled == 0)) { 
                                        if ((bid == 332) || (inv.BusinessID==bid)) {
                                            sum += inv.Balance;
                                            myjobs.push(job);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            app.pastdue = myjobs;
            app.currentJobs = myjobs;
            //console.log("past due");
            //console.dir(app.pastdue);
            await app.renderJobs(myjobs);

        },
        async showEmailDialog(type, id) {
            $("#email-ids").innerHTML = id;

            let myjob = await this.getJob(id);
            let mybusiness = app.allbusiness[myjob.BusinessID];
            $("#email-business").innerHTML = myjob.Job;
            $("#email-invoice").innerHTML = myjob.related_Invoice[0].InvoiceID;
            $("#email-dialog").showModal();
        },
        async renderJobs(jobs, page = 0) {
            if (!jobs) return;
            $("#overlay").style.display = "flex";
            let cnt;
            cnt = jobs.length;
            let perpage = (cnt < app.config.perpage) ? cnt : parseInt(app.config.perpage);
            let start = page * perpage;
            let end = parseInt(start) + parseInt(perpage);

            // buckets
            let allinvoices = [];
            let bucket = [];
            let currentBID = $("#BusinessID").value;

            let idx = 0;
            let out = "";
            $("#loading").innerHTML = `[1/${perpage}]`;
            app.makePageNav(jobs, page);
            $(".viewing").innerHTML = `Viewing: ${start+1}-${end} / ${cnt}`;
            let now = new Date();
            for (let i = start; i < (start + perpage); i++) {
                $("#loading").innerHTML = `[${idx}/${start+perpage}]`;
                let row = jobs[i];
                if (row && row.NoInvoice!=1) {
                    let status = '',
                        balance = 0,
                        noinvoice = 0,
                        toolurl = "https://dharristours.simpsf.com/clients/dharristours/templates/JobToPrint.php?z=" + btoa("ID=" + row.JobID) + "#Invoice";
                    let tmp, iid;
                    //console.log(`renderJobs: job ${i} of ${start + perpage} bid: ${currentBID} row.bid: ${row.BusinessID}`);
                    if (row && ((currentBID==332) || (currentBID==row.BusinessID))) {
                        // console.log("Passed business test");
                        if ((row.InvoiceParentID !== undefined) && !app.body[row.InvoiceParentID]) {
                            app.body[row.InvoiceParentID] = document.createElement("tbody");
                            app.body[row.InvoiceParentID].dataset.pid = row.InvoiceParentID;
                        }
                        row.Business = app.allbusiness[row.BusinessID].Business;
                        row.BusinessName = row.Business.Business;

                        let invoicedate = new Date(row.JobDate);
                        let elapsed = Math.floor(((((now.getTime() - invoicedate.getTime()) / 1000) /
                            60) / 60) / 24);

                        let overdue = '';
                        if (elapsed > 30) {
                            overdue = `<span class='badge bg-danger'>PAST DUE ${elapsed - 30} DAYS</span>`;
                        }

                        if (row.related_Invoice) {
                            if (row.related_Invoice[0].Balance > 0 && elapsed > 30) {
                                row.Status = `${elapsed - 30} Days Overdue`;
                                status +=
                                    `<span class='badge bg-danger'>${elapsed - 30} DAYS OVERDUE</span>`;
                            } else if ((row.related_Invoice[0].InvoiceSent == 1) && (row.related_Invoice[0].Balance > 0)) {
                                row.Status = "Invoice Sent";
                                status += "<span class='badge bg-info'>INVOICE SENT</span>";
                            } else if (row.related_Invoice[0].Balance > 0) {
                                row.Status = "Invoice Created";
                                status += "<span class='badge bg-warning'>INVOICE CREATED</span>";
                                balance = row.related_Invoice[0].Balance;
                            }
                            if (row.related_Invoice[0].Balance == 0) {
                                row.Status = "Paid";
                                status += "<span class='badge bg-success'>PAID</span>";
                            }
                            balance = row.related_Invoice[0].Balance;
                        } else {
                            row.Status = "No Invoice";
                            status = "<span class='badge bg-danger'>NO INVOICE</span>";
                            balance = row.QuoteAmount;
                            noinvoice = 1;
                        }
                        let noinv, currentpid, pid, hasBalance, date, stats, due;

                        if (balance || noinvoice) {
                            hasBalance = (row.related_Invoice && row.related_Invoice[0] && row
                                .related_Invoice[0].Balance) ? 'hasBalance' : 'noBalance';
                            noinv = (noinvoice) ? "no-invoice" : "has-invoice";

                            pid = (row.related_Invoice && row.related_Invoice[0] && row.related_Invoice[
                                0].InvoiceParentID) ? row.related_Invoice[0].InvoiceParentID : 0;
                            iid = (row.related_Invoice && row.related_Invoice[0] && row.related_Invoice[
                                0].InvoiceID) ? row.related_Invoice[0].InvoiceID : 0;
                            date = new Date(row.JobDate).toISOString().substring(0, 10);


                            // Separate items with parentid into their own tbody's
                            let mstatus = "";
                            if (pid && (!app.body[pid]) && (pid != 0)) {
                                stats = await app.getParentInfo(pid);

                                if (stats.date) {
                                    pdate = new Date(stats.date).toISOString().substring(0, 10);
                                }
                                if (stats.total == 0) {
                                    mstatus = "<span class='badge bg-success'>PAID</span>";
                                } else if (overdue) {
                                    mstatus = overdue;
                                } else {
                                    mstatus = "<span class='badge bg-warning'>HAS INVOICES</span>";
                                }
                                due = stats.total;
                                currentpid = pid;
                                let masterurl = "https://dharristours.simpsf.com/clients/dharristours/templates/JobToPrint.php?z=" + btoa("ID=" + row.JobID) + "#MasterInvoice";
                                let mtr = document.createElement("tr");
                                mtr.className = `parent ${hasBalance}`;
                                mtr.dataset.pid = pid;

                                tmp = `
                                <td><a href="#" class='toggle closed' onclick="this.classList.toggle('closed');app.toggleGroup(${pid});return false;">▶</a></td>
                                <td>${pid}</td>
                                <td></td>
                                <td><span data-bid="${row.BusinessID}" class="Business">${row.Business}</span></td>
                                <td><span class="Job">Invoice Parent ID: ${pid} [${stats.count} Invoices / ${stats.unpaid} Unpaid]</span></td>
                                <td>${pdate}</td>
                                <td class='balance' id='balance_${pid}'>${app.formatCurrency(due)}</td>
                                <td class='status' id='status_${pid}'>${mstatus}</td>
                                <td><a href="/files/templates/InvoiceMaster.php?id=${pid}" onclick="app.showParent(${pid}); app.selectRow(event); return false;" target="_blank"><i class="fas fa-file-invoice"></i> Master Invoice</a> | <a href="${masterurl}" title="Invoice Tool" target="_blank"><i class="fa-solid fa-screwdriver-wrench"></i></a> | <a href="#" title="Email Master Invoice" onclick="app.showEmailDialog('master',${pid}); return false;" target="_blank"><i class="fa-regular fa-envelope"></i></a></a>
                                </td>`;
                                mtr.innerHTML = tmp;
                                if (pid && !app.body[pid]) {
                                    app.body[pid] = document.createElement("tbody");
                                    app.body[pid].dataset.pid = pid; 
                                }
                                if (pid) app.body[pid].append(mtr);
                            }

                            let tr = document.createElement("tr");
                            // Markup for each row of invoice data
                            let xtra = (pid && pid !== "0") ? " hidden child" : "";
                            let showpid = (pid) ? pid : "";
                            due = balance;
                            row.Balance = due;
                            idx++;
                            tr.id = `job_${row.JobID}`;
                            tr.dataset.index = idx;
                            tr.dataset.parent = pid;
                            tr.dataset.jobid = row.JobID;
                            tr.dataset.businessid = row.BusinessID;
                            tr.dataset.invoiceid = iid;
                            tr.className = `${hasBalance} ${noinv} ${xtra}`;

                            tmp = `<td><input type='checkbox' onclick="app.doCheckbox(event)" id='job_${row.JobID}' class='job-select'></td><td class="InvID">${iid}</td><td>${row.JobID}</td><td><span class="Business">${row.Business}</span></td><td><span class="Job">${row.Job}</span></td><td>${date}</td><td class="balance">${app.formatCurrency(due)}</td><td class="status">${status}</td>`;

                            toolurl = "https://dharristours.simpsf.com/clients/dharristours/templates/JobToPrint.php?z=" + btoa("ID=" + row.JobID) + "#Invoice";

                            if (!noinvoice) {
                                let url = "/files/templates/print/InvoiceReport.php?z=" + btoa( `ID=${iid}`);
                                tmp +=
                                    `<td class='rowlinks'><a target='_blank' title="View Invoice" onclick='app.show("${url}", "Invoice ${iid}");app.selectRow(event);return false;' href='${url}'><i class='fa-solid fa-eye'></i> Invoice</a> | <a href='#' title="View Job" onclick='app.showJob(${row.JobID});return false;'><i class='fas fa-bus'></i> Job</a> | <a href="${toolurl}" target="_blank"><i class="fa-solid fa-screwdriver-wrench"></i></a> | <a href="#" title="Email Invoice" onclick="app.showEmailDialog('invoice',${row.JobID}); return false;" target="_blank"><i class="fa-regular fa-envelope"></i></a></td>`;
                            } else {
                                tmp +=
                                    `<td class='rowlinks'><a target='invoice' title="Create Invoice" href='/files/invoices/${pid}.pdf' onclick='app.makeInvoice("${row.JobID}");return false;'><i class='fa-solid fa-file-invoice'></i> Invoice</a> | <a href='#' title="View Job" onclick='app.showJob(${row.JobID});return false;'><i class='fas fa-bus'></i> Job</a> | <a href="${toolurl}" title="Invoice Tool" target="_blank"><i class="fa-solid fa-screwdriver-wrench"></i></a></td>`;
                            }
                            tr.innerHTML = tmp;
                            if (!pid) pid = 0;
                            if (!app.body[pid]) {
                                app.body[pid] = document.createElement("tbody");
                                app.body[pid].dataset.pid = pid;
                            }
                            app.body[pid].append(tr);
                        }
                    }
                }
            }
            //print out;
            $$("#jobs tbody").forEach(el => {
                el.parentElement.removeChild(el);
            });
            if (app.body) {
                out = "";
                for (const tbody of app.body) {
                    if (tbody) {
                        $("#jobs").append(tbody);
                    }
                }
            }
            $("#overlay").style.display = "none";
            app.sumCurrentView();
            app.body = [];

        },
        makeInvoice(id) {
            let job_ids = [];
            if (id) job_ids.push(id);

            $$("input[type='checkbox']:checked").forEach(el => {
                if (el.id.match(/^job_/)) {
                    let job_id = el.id.replace(/^job_/i, '');
                    job_ids.push(job_id);
                }
                el.checked = false;
            });
//            console.log(`makeInvoice: making invoices for jobs: ${job_ids.join(',')}`);
            fetch("/files/templates/JobToPrint.php?x=massinvoice&JobIDs=" + JSON.stringify(job_ids)).then(r => r.json()).then(data => {
                //console.log("JobToPrint massinvoice results:");
                //console.dir(data);
                if (data.results && data._ids) {
                    data._ids.forEach(obj => {
                        let row = $(`#job_${obj.JobID}`);
                        if (row) {
                            let rowlinks = row.querySelector(".rowlinks");
                            if (rowlinks) {
                                let url = "/files/templates/print/InvoiceReport.php?z=" + btoa(`ID=${obj.InvoiceID}`);
                                let toolurl = "https://dharristours.simpsf.com/clients/dharristours/templates/JobToPrint.php?ID=" + row.JobID + "#Invoice";
                                rowlinks.innerHTML = `<a target='_blank' onclick='app.show(\"${url}\", \"Invoice ${obj.InvoiceID}");app.selectRow(event);return false;' href='${url}'><i class='fa-solid fa-eye'></i> Invoice</a> | <a href='showJob?id=${obj.JobID}' onclick='app.showJob(${obj.JobID});return false;'><i class='fas fa-bus'></i> Job</a> | <a href="${toolurl}" target="_blank"><i class="fa-solid fa-screwdriver-wrench"></i></a>`;
                            }
                            let rowstatus = row.querySelector(".status");
                            if (rowstatus) {
                                rowstatus.innerHTML =
                                    "<span class='badge bg-warning'>INVOICE CREATED</span>";
                            }
                            let invid = row.querySelector(".InvID");
                            if (invid) {
                                invid.innerHTML = obj.InvoiceID;
                            }
                        }
                    });

                    let s = (data.results.length > 1) ? 's' : '';
                    setTimeout(function() {
                        alert(
                            `${data.results.length} invoice${s} processed:\n\t${data.results.join("\n\t")}\n`
                        );
                    }, 10);
                }
                $(".selected")?.classList.remove("selected");
            });
        },
        async newMasterInvoice() {
            let ids = [],
                job_ids = [];
            $$("input[type='checkbox']:checked").forEach(el => {
                let job_id = el.id.replace(/^job_/i, '');
                let job = app.jobs.find(function(el) {
                    if (el) {
                        return el.JobID == job_id;
                    } else {
                        return false;
                    }
                });
                if (job) {
                    job_ids.push(job.JobID);
                    if (job && job.related_Invoice) {
                        ids.push(job.related_Invoice[0].InvoiceID);
                    }
                }
            });
            //console.log(`job ids: `);
            //console.dir(ids);
            let tmpjob = await app.getJob(job_ids[0]);
            let bid;
            if (tmpjob) {
                bid = tmpjob.BusinessID;
                bname = app.allbusiness[bid].Business;
            }

            let now = new Date();
            obj = {
                InvoiceParent: {
                    "new1": {
                        JobIDs: job_ids.join(','),
                        InvoiceIDs: ids.join(','),
                        BusinessID: bid,
                        InvoiceParent: `Master Invoice for ${bname} - ${now.getMonth()+1}/${now.getDate()}/${now.getFullYear()}`
                    }
                }
            };
            obj.InvoiceParent['new1'].Invoice = [];

            ids.forEach(id => {
                obj.InvoiceParent['new1'].Invoice[id] = {
                    InvoiceID: id
                }
            });

            (async () => {
                const rawResponse = await fetch(
                    '/grid/ctl.php?x=save&rsc=InvoiceParent&json2=true', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(obj)
                    });
                const content = await rawResponse.json();

                let newid = content.id;
                //console.log("new master invoice");
                //console.dir(content);
                let mid = content.id;
                let upd = {
                    Invoice: []
                };
                ids.forEach(inv_id => {
                    upd.Invoice[inv_id] = {
                        InvoiceID: inv_id
                    };
                    upd.Invoice[inv_id].InvoiceParentID = newid;
                });
                const newResponse = await fetch(
                    "/grid/ctl.php?x=save&rsc=Invoice&json2=true", {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(upd)
                    });
                const newcontent = await newResponse.json();
                //console.log("Updated invoices");
                //console.dir(newcontent);

                alert(`New Master Invoice ID ${mid} created`);
                location.reload();
            })();
        },
        goto(page, event) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            app.renderJobs(app.currentJobs, page);

            return false;
        },
        doSort(evt) {
            //console.log("doSort");
            //console.dir(evt);
            let tgt = evt.target;
            let th = evt.target.closest("th");
            if (tgt.dataset.name) {
                
                $("#overlay").style.display = "flex";
                $("#loading").innerHTML = `Sorting ${app.jobs.length} Job records.<br>Please be patient...`;
                $(".loading").classList.add("run");
                    let sortBy = tgt.dataset.name;
                let typ = th.dataset.type ? th.dataset.type : 'string';

                if (app.state.sort == sortBy) {
                    app.state.sortDir ^= 1;
                }
                $(`.sort`).classList.remove(`sort`);
                app.state.sort = sortBy;
                th.classList.add(`sort`);
                
                if (typ === "string") {
                    app.currentJobs.sort((a, b) => {
                        if (a && b) {
                            if (a[sortBy].toLowerCase().replace(/\W/g, '') < b[sortBy].toLowerCase().replace(/\W/g, '')) {
                                return -1;
                            } else if (a[sortBy].toLowerCase().replace(/\W/g, '') > b[sortBy].toLowerCase().replace(/\W/g, '')) {
                                return 1;
                            } else {
                                return 0;
                            }
                        } else if (a === b) {
                            return 0;
                        } else if (a === null) {
                            return -1;
                        } else if (b === null) {
                            return 1;
                        } else {
                            return 0;
                        }
                    });
                } else if (typ === 'numeric') {
                    app.currentJobs.sort((a, b) => {
                        if (!a) return -1;
                        if (!b) return 1;
                        let clean_a = parseInt(a[sortBy]) || 0;
                        let clean_b = parseInt(b[sortBy]) || 0;
                        
                        return clean_a - clean_b;
                    });
                } else if (typ === 'date') {
                    app.currentJobs.sort((a, b) => {
                        if (a && b) {
                            return ((new Date(a.JobDate).getTime() || 0) - (new Date(b.JobDate).getTime() || 0))
                        } else {
                            return 0;
                        }
                    });

                } else if (typ === "business") {
                    app.currentJobs.sort((a, b) => {
                        if (a && b) {
                            if (!a.Business) a.Business = app.allbusiness[a.BusinessID].Business || "";
                            if (!b.Business) b.Business = app.allbusiness[b.BusinessID].Business || "";
                            let aname = (typeof(a.Business)==="string") ? a.Business.toLowerCase().replace(/\W/g, '') : a.Business.Business.toLowerCase().replace(/\W/g, '');
                            let bname = (typeof(b.Business)==="string") ? b.Business.toLowerCase().replace(/\W/g, '') : b.Business.Business.toLowerCase().replace(/\W/g, '');
                            if (aname < bname) {
                                return -1;
                            } else if (aname > bname) {
                                return 1;
                            } else {
                                return 0;
                            }
                        } else {
                            return 0;
                        }
                    });
                } else if (typ === "status") {

                }
                if (app.state.sortDir) {
                    app.currentJobs.reverse();
                }
                setTimeout(function() {
                    $(`.sort > span.sorticon`).style.transform =
                        `rotateX(${app.state.sortDir * 180}deg)`;
                }, 10);
                app.renderJobs(app.currentJobs);
            }
            $(".loading").classList.remove("run");
        },
        cache: {

        },
        async getInvoices() {
            let cond = encodeURIComponent("Balance > 0");
            const rawResponse = await fetch(
                `/portal/api.php?type=getInvoices&cond=${cond}`);
            const content = await rawResponse.json();
            app.invoices = content;

            return content;
        },
        async getParentInfo(pid) {
            if (pid !== 0) {
                if (!app.cache[pid]) {
                    const rawResponse = await fetch(
                        '/portal/api.php?type=sumInvoices&pid=' + pid);
                    const content = await rawResponse.json();
                    app.cache[pid] = content;
                    return content;
                } else {
                    return app.cache[pid];
                }
            }
        },
        viewMasterInvoice(id) {
            if (app.state.masterInvoiceID) {
                let url = "InvoiceMaster.php?id=" + app.state.masterInvoiceID;
                window.open(url, "masterinvoice");

            }
        },
        showMasterInvoices() {
            let out = [];
            for (let i = 0; i < app.jobs.length; i++) {
                if (app.jobs[i] && app.jobs[i].related_Invoice && app.jobs[i]
                    .related_Invoice[0].InvoiceParentID > 0) {
                    out.push(JSON.parse(JSON.stringify(app.jobs[i])));
                }
            }
            app.currentJobs = out;
            app.currentJobs.sort((a, b) => {
                if (a.related_Invoice[0].InvoiceParentID < b.related_Invoice[0]
                    .InvoiceParentID) {
                    return -1;
                } else if (a.related_Invoice[0].InvoiceParentID > b
                    .related_Invoice[0].InvoiceParentID) {
                    return 1;
                } else {
                    return 0;
                }
            });
            //console.log("showMasterInvoices");
            //console.dir(app.currentJobs);

            app.renderJobs(app.currentJobs);
        },
        changeCount(num) {
            if (num == "all") {
                num = 1000000;
            }
            app.storeConfig("count", num);
            app.config.perpage = num;
            app.renderJobs(app.currentJobs, 0);

            //window.location.href = window.location.origin + location.pathname +'?count=' + num;    
        },
        async selectInvoiceReport(id) {
            $$("input[type='checkbox']:checked").forEach(el => el.removeAttribute(
                'checked'));
            //$$("tr").forEach(el=>el.style.display = 'none');
            let report = app.invoiceReports.find(function(el) {
                if (el) {
                    return (el.InvoiceParentID == id);
                } else {
                    return false;
                }
            });

            if (!report) {
                report = await app.getMasterInvoice(id);
            }
            if (report) {
                let ids = report.InvoiceIDs.split(/\,/);
                let job_ids = report.JobIDs.split(/\,/);
                let newlist = [];
                if (job_ids) {
                    for (const item of job_ids) {
                        let job = await app.getJob(item);
                        if (job) {
                            newlist.push(job);
                        }
                        /* let el = $(`#job_${item}`);
                        if (el) {
                            el.setAttribute("checked", true);
                            el.closest("tr").style.display = "table-row";
                        }
                        */
                    }
                    app.jobs = newlist;
                    app.data.Job = {
                        Job: newlist
                    };
                    app.renderJobs(app.jobs);
                }
            } else {

            }
            $("#view").selectedIndex = 1;
            app.state.masterInvoiceID = id;
        },
        state: {
            sort: "JobDate",
            sortDir: 0,
        },
        toggleGroup(pid) {
            $$(`tr[data-parent='${pid}']`).forEach(el => {
                el.classList.toggle("hidden");
            });
        },
        masterInvoice: [],
        invoiceReports: [],
        data: {}
    };
    app.init();
    window.app = app;
})();
