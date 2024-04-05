let worker = {
    init() {
        self.addEventListener("message", (evt) => worker.handleMessage(evt), false);
    },
    async handleMessage(evt) {
        let obj = evt.data;
        console.log('handling message');
        console.dir(evt);

        if (obj && obj.action) {
            worker.request = obj;
            let results = await worker[obj.action].apply(self, obj.args);
            let out = {
                request: obj.action,
                results: results,
            };
            if (obj.cb) out.cb = obj.cb;
            worker.sendMessage(out);
        }
    },
    sendMessage(msg) {
        self.postMessage(msg);
    },
    async fetchJobs(start, end) {
        let out = {};
        /*
        let cache = JSON.parse(localStorage.getItem("jobs"));
        if (cache) {
            out = { results: cache, cb: worker.request.cb, request: worker.request.action };
            worker.sendMessage(out);
        }
        */
        let now = new Date().getTime();
        if (!start) {
            start = new Date("2023-01-01").getTime();
        }
        if (!end) end = now + 1209600000;

        let sdate = new Date(start).toISOString().substring(0, 10);
        let edate = new Date(end).toISOString().substring(0, 10);

        let cond =
            `JobCancelled=0 and JobDate>'${sdate}' AND JobDate<'${edate}' AND NoInvoice=0 AND InvoiceSatisfied=0 AND BusinessID!='332' ORDER BY JobDate DESC`;

        const rawResponse = await fetch(`/portal/api.php?type=listJobs&cond=${encodeURIComponent(cond)}`);
        
        out.results = await rawResponse.json();
        console.log(`fetchJobs results for ${cond}`);
        console.dir(out);
        
//        localStorage.setItem("jobs", JSON.stringify(out));
        return out;
    },
    doSort(arr, sortKey, desc) {
        
    },
    importIDB(dname, sname, arr) { 
      return new Promise(function(resolve) {
        
        let r = window.indexedDB.open(dname);

        r.onupgradeneeded = () => {
          var store = r.result.createObjectStore(sname, {keyPath: "name"});
        };

        r.onsuccess = () => {
            let tactn = r.result.transaction(sname, "readwrite");
            let store = tactn.objectStore(sname);
            for (let obj of arr) {
              store.put(obj);
            }
            resolve(r.result);
        };

        r.onerror = (e) => {
            alert("Error accessing IndexedDB: " + e.target.errorCode)
        }    
      });
    }
 };

worker.init();

