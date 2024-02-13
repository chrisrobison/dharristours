<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lexend:wght@200..900">
<link rel="stylesheet" href="/portal/assets/fontawesome-free-6.4.0-web/css/all.min.css">
<link rel="stylesheet" href="/files/templates/Request.css">
<style>
.cash {
    text-align: right;
    width: 5rem;
    padding-right: 4%;
}
</style>
<script>

window.loadFormCallback = function(data) {
console.log("loadFormCallback");
console.dir(data);
    // reset arrows
    let arrows = [];
    for (let i=1; i<5; i++) {
        arrows[i] = document.querySelector(`.arrow-${i}`);
        arrows[i].classList.remove('arrow-is-complete');
        arrows[i].classList.remove('arrow-is-active');
    }
    arrows[1].classList.add('arrow-is-complete'); // First step is always complete
    if (data.QuoteSent==0 && data.ClientConfirmed ==0) {
        arrows[2].classList.add('arrow-is-active');
    }
    if (data.QuoteSent==1) {
        arrows[2].classList.add('arrow-is-complete');
        arrows[3].classList.add('arrow-is-active');
    }
    if (data.ClientConfirmed==1) {
        arrows[2].classList.add('arrow-is-complete');
        arrows[3].classList.add('arrow-is-complete');
        arrows[4].classList.add('arrow-is-active');
    }

    if (data.JobID!=0) {
        arrows[2].classList.add('arrow-is-complete');
        arrows[3].classList.add('arrow-is-complete');
        arrows[4].classList.add('arrow-is-complete');
    }
}
function updateQuoteEmail() {
    return true;
   let id = document.querySelector("#simpleID").value;
   console.log(`updateQuoteEmail got ID ${id}`);
   let url = "/files/email-templates/example.php?id="+id;
   console.log(`Frame URL: ${url}`);
   document.querySelector("#quote").src = "/files/email-templates/example.php?id="+id;
}
</script>
<div class='tableGroup'>
   <div class='formHeading'>Request ID: <?php print $current->RequestID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Request</label><input style='width:40rem;' type='text' onchange="updateQuoteEmail()" dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][Request]' id='Request' value='<?php print $current->Request; ?>' size='100' class='boxValue' /></div>
         <fieldset>
            <legend>Contact</legend>
             <div class='contentField'><label style='width:4em'>Name</label><input type='text' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][Name]' id='Name' value='<?php print $current->Name; ?>' size='50' class='boxValue' /></div>
             <div class='contentField'><label style='width:4em'>Email</label><input type='text' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
             <div class='contentField'><label style='width:4em;'>Phone</label><input type='text' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='50' class='boxValue' /></div>
            <div class='contentField'><label style='width:4em;'>Business </label><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist();print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "Request[$current->RequestID][BusinessID]");?></div>
        </fieldset>
        <fieldset>
            <legend>Rates</legend>
            <p>Add a rate for each bus needed for the job or click the 'Auto-Calculate' button to <br>
               automatically calculate the buses required and assign standard rates.<br>
               </p>
            <input type='hidden' rel="data" name="Request[<?php print $current->RequestID; ?>][RatesIDs]" id="RatesIDs" value="<?php print $current->RatesIDs; ?>" onchange="updateRates(this.value)"/>
            <div class='contentField'>
                <label style='width:4em'>Tier</label>
                <select style='width: 15rem;' name='Request[$current->RequestID][RatesID]' id='RatesID' onchange="updateRateList(this.options[this.selectedIndex])">
                <?php 
                    $boss->db->addResource("Rate");
                    $arr = $boss->db->Rate->getlist();
                    foreach ($arr as $idx=>$item) {
                        $sel = ($item->Default) ? ' SELECTED' : '';
                        print "<option value='".$item->RateID."'$sel>".$item->Rate."</option>";
                    }
                ?>
                </select>
            </div>
            <div class='contentField'><label style='width:4em'>Rate </label><?php $boss->db->addResource("Rate");$arr = $boss->db->Rate->getlist();print $boss->utility->buildRatesSelect($arr, $current->RateID, "RateID", "RateID", "Request[$current->RequestID][RateID]");?><button onclick="addRate(document.querySelector('#RateID').options[document.querySelector('#RateID').selectedIndex].value); return false;">Add Rate</button><button onclick="return calcRates(event);">Auto-Calculate</button></div>

            <table id='rateTable'>
                <thead>
                    <tr>
                        <th>Bus Size</th>
                        <th>One Way</th>
                        <th>Overtime</th>
                        <th>1st 4 hr</th>
                        <th style='width:1rem;'></th>
                    </tr>
                </thead>
                <tbody id='ratesTableBody'>
                    <tr>
                        <td colspan='5'>No Rates Assigned</td>
                    </tr>
                </tbody>
            </table>
            <div style="display:flex;flex-direction:row;">
                <div>
                    <label>Payment Method</label> <input type="text" name="Request[<?php print $current->RequestID; ?>][PaymentMethod]" id="PaymentMethod" value="Purchase Order" ><br>
                    <label>Payment Number</label> <input type="text" name="Request[<?php print $current->RequestID; ?>][PaymentNumber]" id="PaymentNumber" value="Payment Number" ><br>
                    
                </div>
                <div style="text-align:right;width:50%;">
                    <span style="opacity:0"><label>Subtotal</label> $<input readonly class='cash' type="text" name="Request[<?php print $current->RequestID; ?>][QuoteAmount]" id="QuoteAmount" value="0.00" onchange="updateRates()"><br></span>
                    <label>Fuel Fee</label> $<input type="text" class='cash' name="Request[<?php print $current->RequestID; ?>][Fuel]" id="Fuel" value="0.00" onchange="updateRates()"><br>
                    <label>Mileage Fee</label> $<input type="text" class='cash' name="Request[<?php print $current->RequestID; ?>][Mileage]" id="Mileage" value="0.00" onchange="updateRates()"><br>
                    <label>Driver Hours</label> <input type="text" name="Request[<?php print $current->RequestID; ?>][DriverHours]" id="DriverHours" style="width: 3rem;text-align:center;" value="0" onchange="updateRates()">=<span id="DriverHoursTotal"></span><br>
                    <label>Other Fees</label> $<input type="text" class='cash' name="Request[<?php print $current->RequestID; ?>][OtherFees]" id="OtherFees" value="0.00" onchange="updateRates()"><br>
                    <label>Quote Total</label> $<input readonly type="text" class='cash' name="Request[<?php print $current->RequestID; ?>][QuoteTotal]" id="QuoteTotal" value="0.00"><br>
                </div>
            </div>
            <div id="rateTable"> </div>
        </fieldset>
        <div class='contentField' style="display:none;"><label>UID</label><input type='text' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][UID]' id='UID' value='<?php print $current->UID; ?>' size='50' class='boxValue' /></div>
    </div>
    <div class='fieldcolumn'>
        <div class='contentField' style='padding-left:1rem;'>
            <!--input type="checkbox" id="QuoteSent" name="Request[<?php print $current->RequestID; ?>][QuoteSent]" value="1" onchange="updateArrow(2, 'arrow-is-complete')"/>
            <input type="checkbox" id="ClientConfirmed" name="Request[<?php print $current->RequestID; ?>][ClientConfirmed]" value="1" onchange="updateArrow(3, 'arrow-is-complete')"/-->
            <div class='arrows'>
                <button class="arrow arrow-1 arrow-is-complete">
                    <span class="arrow-head" aria-hidden="true"></span>
                    <span class="arrow-link"><span class="step">1</span> <br>Request</span>
                </button>
                
                <button class="arrow arrow-2 arrow-is-active">
                    <span class="arrow-head" aria-hidden="true"></span>
                    <span class="arrow-link"><span class="step">2</span> <br>Quote Sent</span>
                    <span class="arrow-tail" aria-hidden="true"></span>
                </button>

                <button class="arrow arrow-3">
                    <span class="arrow-head" aria-hidden="true"></span>
                    <span class="arrow-link"><span class="step">3</span> <br>Confirmed</span>
                    <span class="arrow-tail" aria-hidden="true"></span>
                </button>

                <button class="arrow arrow-4">
                    <span class="arrow-head" aria-hidden="true"></span>
                    <span class="arrow-link"><span class="step">4</span> <br>Job Created</span>
                    <span class="arrow-tail" aria-hidden="true"></span>
                </button>
            </div>
            <div class='buttonBar'>
                <button onclick="return previewQuote(event);"><i class="fa-solid fa-eye"></i> Preview Quote</button>
                <button onclick="return sendQuote(event);"><i class="fa-solid fa-share-from-square"></i> Send Quote</button>
                <button onclick="return confirmQuote(event);"><i class="fa-solid fa-person-circle-check"></i> Confirm</button>
                <button onclick="return createJob(event);"><i class="fa-solid fa-wand-magic-sparkles"></i> Create Job</button>

            </div>
        </div>
        <fieldset>
            <legend>Trip Details</legend>
            <input type='hidden' id='Times' name='Request[<?php print $current->RequestID; ?>][Times]' value='<?php print preg_replace("/\"/", "\"", $current->Times); ?>' onchange="updateTimes()"/>
            
            <div style='font-size:0.8em;text-align:right' class='contentField'><select name="Request[][PickupTimeType]" id="PickupTimeType"><option value="Depart By">Depart By</option><option value="Arrive By">Arrive By</option></select><input type='time' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][PickupTime]' id='PickupTime' value='<?php print $current->PickupTime; ?>' size='20' style="width:10rem;" class='boxValue' /></div>
            
            <div class='contentField'><label>Pickup</label><input type='text' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][Pickup]' id='Pickup' value='<?php print $current->Pickup; ?>' size='50' class='boxValue' /></div>
            <div class='contentField'><label>Destination</label><input type='text' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][Destination]' id='Destination' value='<?php print $current->Destination; ?>' size='50' class='boxValue' /></div>
            <!--input type='text' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][Destination]' id='Destination' value='<?php print $current->Destination; ?>' onchange='updateStops(this.value)' /-->
            <div id='waypoints'></div>
            
            <div style='text-align:right;font-size:0.8em;' class='contentField'><select name="Request[][FinalDropOffTimeType]" id="FinalDropOffTimeType"><option value="Depart By">Depart By</option><option value="Arrive By">Arrive By</option></select><input type='time' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][FinalDropOffTime]' id='FinalDropOffTime' value='<?php print $current->FinalDropOffTime; ?>' size='20' style="width:10rem;" class='boxValue' /></div>
            
            <div class='contentField'><label>Return</label><input type='text' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][Return]' id='Return' value='<?php print $current->Return; ?>' size='50' class='boxValue' /></div>
            <div class='contentField'><label>Pax</label><input type='number' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][Pax]' id='Pax' value='<?php print $current->Pax; ?>' size='50' class='boxValue' style='width:4em;'/></div>
            <div class='contentField'><label>Date</label><input type='text' dbtype='date' name='Request[<?php print $current->RequestID; ?>][Date]' id='Date' value='<?php print $current->Date; ?>' size='25' class='boxValue date' style='width:6em' /></div>
            <div class='contentField'><label>Start</label><input type='time' dbtype='time' name='Request[<?php print $current->RequestID; ?>][Start]' id='Start' value='<?php print $current->Start; ?>' size='25' class='boxValue' style='width:7em;' />
            <label style='width: 3em;'>End</label><input type='time' dbtype='time' name='Request[<?php print $current->RequestID; ?>][End]' id='End' value='<?php print $current->End; ?>' size='25' class='boxValue' style='width:7em;' /></div>
            <div class='contentField'><label>Round Trip</label><input type='checkbox' dbtype='tinyint(1)' name='Request[<?php print $current->RequestID; ?>][RoundTrip]' id='RoundTrip' value='Yes'></div>
            <div class='contentField'><label>Options</label><input type='checkbox'  onchange="updateRates()" dbtype='tinyint(1)' name='Request[<?php print $current->RequestID; ?>][ADA]' id='ADA' value='Yes'><label style='width:5em;text-align:left;'>ADA</label>
            <input type='checkbox' onchange="updateRates()" dbtype='tinyint(1)' name='Request[<?php print $current->RequestID; ?>][Shuttle]' id='Shuttle' value='Yes'><label style="width:5em;text-align:left;">Shuttle</label>
            <input type='checkbox' onchange="updateRates()" dbtype='tinyint(1)' name='Request[<?php print $current->RequestID; ?>][Cargo]' id='Cargo' value='Yes'><label style="width:5em;text-align:left;">Cargo</label>
            <input type='checkbox' dbtype='tinyint(1)' name='Request[<?php print $current->RequestID; ?>][Text]' id='Text' value='Yes'><label style="width:5em;text-align:left;">Text</label>
            </div>
        </fieldset>
        <div class='contentField'><label>Job ID</label><input type='text' dbtype='int(15)' name='Request[<?php print $current->RequestID; ?>][JobID]' id='JobID' value='<?php print $current->JobID; ?>' style='width:4rem;'><a onclick="return loadUrl('https://dharristours.simpsf.com/grid/?pid=335');">View</a></div>
        <div class='contentField'><input type='checkbox' dbtype='int(15)' name='Request[<?php print $current->RequestID; ?>][QuoteCancelled]' id='QuoteCancelled' value='1'><label>Request Cancelled</label></div>
        <div class='contentField'><input type='checkbox' name='Request[<?php print $current->RequestID; ?>][QuoteLocked]' id='QuoteLocked' value='1'><label>Quote Locked</label></div>

        <div class="buttonBar"><button style="background-color:#c00;box-shadow:0 7px #800;" onclick="return showCancelDialog(event);"><i class="fa-solid fa-wand-magic-sparkles"></i> Cancel Quote</button></div>
    </div>
</div>
            <input type='text' dbtype='tinyint(1)' name='Request[<?php print $current->RequestID; ?>][QuoteSent]' id='QuoteSent' value='0' style="opacity:0;">
            <input type='text' dbtype='tinyint(1)' name='Request[<?php print $current->RequestID; ?>][ClientConfirmed]' id='ClientConfirmed' value='0' style="opacity:0;">
    <div class='contentField' style='float:left'><label>Instructions</label><textarea dbtype='text' name='Request[<?php print $current->RequestID; ?>][Instructions]' id='Instructions' style='width:48em;white-space:normal;' class='textBox'><?php print $current->Instructions; ?></textarea></div>
   <!--div class="fieldcolumn">
      <fieldset>
         <legend>Quote Email</legend>
         <button onclick="previewQuote(event);">Preview Email</button>
         <button onclick="sendQuote(event);">Send Quote</button>
         <div class'contentfield'=""><iframe id="quote" style="width:800px;height:30em;" src="/files/email-templates/preview.php?tpl=quote.html&id=<?php print $current->RateID; ?>"></iframe></div>
      </fieldset>
    </div-->
    <div class='contentField' style='float:left'><label>Notes</label><textarea dbtype='text' name='Request[<?php print $current->RequestID; ?>][Notes]' id='Notes' style='width:48em;white-space:normal;' class='textBox'><?php print $current->Notes; ?></textarea></div>
    </div>
</div>
<dialog id="cancelRequest" style="position:absolute; top:50%;padding:0px;">
    <header style="height:2rem; font-size:1.1rem;background-color:#900;color:#fff;">Cancel Request</header>
    <div style="padding: 1rem">
        <h2>Cancel Request</h2>
        <div><label for="reason">Reason</label><select id="reason" name="reason"><option> -- Choose Reason -- </option><option value="customer">Customer Cancelled</option><option value="expired">Quote Expired</option><option value="no_bus">No Bus</option><option value="no_driver">No Driver</option></select></div>
        <div><label for="message">Message</label><textarea id="message" name="message" cols="50" rows="4">We're sorry, but we are unable to accommodate your reservation request.</textarea></div>
        <div class="buttonBar" style="text-align:right;"><button onclick="return sendCancelMessage(event, document.querySelector('#message').value)">Send Message</button>
        <button style="background-color:#900;box-shadow:0 7px 0 #800;" onclick="return cancelRequest(event)">Cancel Quote</button>
        <button onclick="event.preventDefault();event.stopPropagation();document.querySelector('#cancelRequest').close()">Return to Jobs</button>
        </div>
    </div>
</dialog>
<script>
function showCancelDialog(evt) {
    if (evt) {
        evt.preventDefault();
        evt.stopPropagation();
    }
    document.querySelector("#cancelRequest").showModal();
}
function loadJob(evt, jobid) {
    evt.stopPropagation();
    evt.preventDefault();

    loadUrl("https://dharristours.simpsf.com/grid/?pid=335", "Job");
    return false;
}
function updateTimes() {
    let json = document.querySelector("#Times").value;
    if (json) {
        let times = JSON.parse(json);
        console.log("updateTimes");
        console.dir(times);
        updateStops();
    }
}
function createJob(evt) {
    evt.stopPropagation();
    evt.preventDefault();

    let rec = simpleConfig.current;
    rec.QuoteLocked = 1;

    if (!rec.BusinessID) {
      alert("No Business assigned. Assign business before creating job.");
      return false;
    }
    rec.QuoteTotal = document.querySelector("#QuoteTotal").value;
    rec.QuoteAmount = document.querySelector("#QuoteAmount").value;

    let newjob = { 
        Job: { 
            new1: {
                Job: rec.Request,
                JobDate: rec.Date,
                BusinessID: rec.BusinessID,
                RequestID: rec.RequestID,
                ContactName: rec.Name,
                ContactPhone: rec.Phone,
                ContactEmail: rec.Email,
                RoundTrip: rec.RoundTrip,
                PickupLocation: rec.Pickup,
                DropOffLocation: rec.Destination,
                FinalDropOffLocation: rec.Return,
                PickupTime: rec.Start,
                EstDuration: rec.DriverHours,
                Hours: rec.DriverHours,
                DropOffTime: rec.End,
                NumberOfItems: rec.Pax,
                SpecialInstructions: rec.Notes,
                SPAB: rec.SPAB,
                Cargo: rec.Cargo,
                WheelChair: rec.ADA,
                Confirmed: rec.ClientConfirmed,
                QuoteAmount: rec.QuoteAmount,
                Fuel: rec.Fuel,
                Mileage: rec.Mileage,
                QuoteTotal: rec.QuoteTotal,
                QuoteLocked: rec.QuoteLocked
            }
        }
    };
    console.log("createJob sending:");
    console.dir(newjob);
    fetch("/grid/ctl.php?x=new&rsc=Job&json="+encodeURIComponent(JSON.stringify(newjob))).then(r=>r.json()).then(data=>{
        console.log("createJob");
        console.dir(data);
        simpleConfig.Job = data.record;
        document.querySelector("#JobID").value = data.record.JobID;
        doModify($("#JobID"));
        alert(`Job ID ${data.record.JobID} created.`);
    });
    return false;
}

function confirmQuote(evt) {
    evt.preventDefault();
    evt.stopPropagation();
    

    return false;
}

function sendQuote(evt) {
    evt.preventDefault();
    evt.stopPropagation();
    fetch("https://dharristours.simpsf.com/files/email-templates/sendquote.php?id="+simpleConfig.current.RequestID).then(r=>r.json()).then(data=>{ 
        console.dir(data);
        document.querySelector('#QuoteSent').value = 1;
        document.querySelector('.arrow-is-active').classList.remove('arrow-is-active');
        document.querySelector('.arrow-2').classList.add('arrow-is-complete');
        document.querySelector('.arrow-3').classList.add('arrow-is-active');
        
        document.querySelector("#QuoteLocked").setAttribute("checked", true);
        simpleConfig.current.QuoteLocked = 1;

        doModify($('#QuoteSent'));
        alert("Quote sent successfully.");
    });
    return false;
}
function previewQuote(evt) {
    evt.preventDefault();
    evt.stopPropagation();
    window.open('/files/email-templates/preview.php?id='+simpleConfig.id, '_blank');
    return false;
}
//document.querySelector("#formContainer").style.display = "block";

function updateArrow(who, add) {
    document.querySelector(`.arrow-${who}`).classList.add(add).remove('arrow-is-active');
}

function setStops() {
    let newdest = [];
    document.querySelectorAll(".stop").forEach(el=>{
        newdest.push(el.value); 
    });
    if (newdest.length) {
        document.querySelector("#Destination").value = newdest.join("|");
    }
}

function updateStops() {
    let txt = document.querySelector("#Destination").value;
    let ttxt = document.querySelector("#Times").value.replace(/\&quot;/g, '"');
    console.dir(ttxt);
    let times;
    if (ttxt) {
        times = JSON.parse(ttxt);
        console.log("updateStops: times");
        console.dir(times);
    }

    if (times) {
        times.forEach((time)=>{
            if ((time.title == "Pickup") || (time.title == "FinalDropOff")) {
                time.title = time.title.replace(/\s.*/,'');

                let tty = document.querySelector(`#${time.title}TimeType`);
                let opts = tty.options;
                for (let i=0; i<opts.length;i++) {
                    if (opts[i].value == `${time.type}`) {
                        opts[i].setAttribute("selected","true");
                    } else {
                        opts[i].removeAttribute("selected");
                    }
                }
                document.querySelector(`#${time.title}Time`).value = time.time;
            }
        });
    }
    console.log(`updating Stops from ${txt}`);
    let stops = txt.split(/\|/);
    let out = "";
    console.log("stops");
console.dir(stops);
    for (let i=0; i<stops.length; i++) {
        if (times) {
            times.forEach((time)=>{
                if (time.title == `Stop${i+1}`) {
                    out += `<button style="float:left;" onclick="return addStop(event)">Add Stop</button><div style='text-align:right;' class='contentField'><select id="Stop${i+1}TimeType"><option`;
                    if (time.type == "Arrive By") {
                        out += " SELECTED";
                    }
                    out += ">Arrive By</option><option";
                    if (time.type == "Depart By") {
                        out += " SELECTED";
                    }
                    out += ">Depart By</option></select>";
                    out += `<input type='time' id='Stop${i+1}' value='${time.time}' size='20' style='width:10rem;' class='boxValue stop' onchange='setStops()' /></div>`;
                }
            });
        }
        out += `<div class='contentField'><label>Stop ${i+1}</label><input type='text' id='Stop${i+1}' value='${stops[i]}' size='50' class='boxValue stop' onchange='setStops()' /></div>`;
    }
    console.log(out);
    document.querySelector("#waypoints").innerHTML = out;
}

function updateDestination() {
    let i = 1;
    let waypoints = [];
    while (el = document.querySelector(`#Stop${i}`)) {
        waypoints.push(el.value);
    }
    document.querySelector("Destination").value = waypoints.join("|");
}
<?php
    $ratesobj = $boss->getObject("Rates");
    $allrates = array();
    
    foreach ($ratesobj->Rates as $obj) {
        if (($obj->RatesID === 0) || $obj->RatesID) {
            $allrates[] = $obj;
        }
    }
    print "let allrates = " . json_encode($allrates) .";\n";
?>
    function getCurrentRates() {
        let el = document.querySelector("#RatesID");
        let val = el.options[el.selectedIndex].value;
        let ratename = el.options[el.selectedIndex].text;
        
        if (!ratename || (ratename == "Select Rate")) {
            ratename = "_Standard Rate";
        }
        let keys = Object.keys(allrates);
        
        let currates = [];

        keys.forEach(key=>{
            let item = allrates[key];
            if ((item.Rate==ratename) || (item.Rate==`_${ratename}`)) {
                currates.push(item);
            }
        });
        
        currates.sort(function(a, b) { 
            if (parseInt(a.Pax) < parseInt(b.Pax)) return 1;
            if (parseInt(a.Pax) > parseInt(b.Pax)) return -1;
            if (parseInt(a.Pax) == parseInt(b.Pax)) return 0;
        });
        return currates;
    }
    function calcRates(e) {
        if (e) {
            e.preventDefault();
            e.stopPropagation();
        }
        let pax = simpleConfig.current.Pax;
        let rids = [];
        
        let currates = getCurrentRates();
        if (currates) {
            let maxpax = parseInt(currates[0].Pax);
            let minpax = parseInt(currates[currates.length-1].Pax);
            while (pax > maxpax) {
                rids.push(currates[0].RatesID);
                pax = pax - maxpax;
            }

            if (pax > minpax) {
                for (let i = currates.length-1; i>0; i--) {
                    if (pax <= currates[i].Pax)   {
                        rids.push(currates[i].RatesID);
                        pax = pax - currates[i].Pax;
                        if (pax<0) pax = 0;
                        i=0;
                    }
                }
                if (pax) {
                    rids.push(currates[currates.length-1].RatesID);
                }
            } else {
                rids.push(currates[currates.length-1].RatesID);
            }
        }
        let start = document.querySelector("#Start").value;
        let end = document.querySelector("#End").value;
        
        let sparts = start.split(/:/);
        let eparts = end.split(/:/);
        
        let sdate = new Date();
        sdate.setMinutes(sparts[1]);
        sdate.setHours(sparts[0]);

        let startsec = sdate.getTime() / 1000;

        let edate = new Date();
        edate.setMinutes(eparts[1]);
        edate.setHours(eparts[0]);
        
        let endsec = edate.getTime() / 1000;

        let duration = endsec - startsec;
    
        let dhrs = (~~(duration / 36) / 100);
        let dmins = ~~(duration - (dhrs * 3600) / 60);
        
        let ddmin = ~~((dmins / 15) * 15) % 60;
        document.querySelector("#DriverHours").value = `${dhrs}`;

        document.querySelector("#RatesIDs").value = rids.join(",");
        updateRates(rids);

        doModify($("#RatesIDs"));
        return false;
    }
    function updateRates(ratelist) {
        let locked = document.querySelector('#QuoteLocked').setAttribute('checked', true);
        if (locked) return false;
        if (typeof(ratelist) === "string") {
            allrids = ratelist.split(/,/);
        } else if (!ratelist) {
            rids = document.querySelector("#RatesIDs").value;
            allrids = rids.split(/,/);
        } else {
            allrids = ratelist;
        }
        
        
        // let out = "<table id='ratesTable'><thead><tr><th>Bus Size</th><th>1st 4 hr</th><th>Overtime</th><th>One Way</th><th style='width:1rem;'></th></tr></thead><tbody>";
        let out = "";
        let tots = { pax:0, firstfour:0, ot:0, oneway:0, overtime:0 };
        let driverHours = document.querySelector("#DriverHours").value;
        let overtime = ((driverHours - 4) > 0) ? driverHours - 4 : 0;
        
        if (allrids.length) {
            allrids.forEach(rid=>{
                let myrate = allrates.find(item=>item.RatesID==rid);
                if (myrate) {
                    tots.pax += parseInt(myrate.Pax);
                    tots.firstfour += parseInt(myrate.FirstFour);
                    tots.ot += parseInt(myrate.Overtime);
                    tots.oneway += parseInt(myrate.OneWay);
                    
                    if (overtime) {
                        tots.overtime += parseInt(myrate.Overtime) * overtime;
                    }
                    out += `<tr><td>${myrate.Pax} Passengers</td><td>$${myrate.OneWay}</td><td>$${myrate.Overtime}</td><td>$${myrate.FirstFour}</td><td><button onclick="removeRate(${rid}); return false">x</button></tr>`;
                }
            });
            out += `<tr><td style='border-top:2px solid #000;'>Totals</td><td style='border-top:2px solid #000;'>$${tots.oneway}</td><td style='border-top:2px solid #000;'>$${tots.ot}/hr</td><td style='border-top:2px solid #000;'>$${tots.firstfour}</td><td style='border-top:2px solid #000;'></td></tr>`;
        }
        if (out == "") {
            out += "<tr><td colspan=5>No Rates Assigned</td></tr>";
        }
        // out += "</tbody></table>";
        document.querySelector("#ratesTableBody").innerHTML = out;
        tots.fuel = document.querySelector("#Fuel").value;
        tots.mileage = document.querySelector("#Mileage").value;
        let otherfees = 0;
        if (document.querySelector("#ADA").checked) {
            otherfees += 100;
        }
        if (document.querySelector("#Shuttle").checked) {
            otherfees += 100;
        }
        if (document.querySelector("#Cargo").checked) {
            otherfees += 100;
        }
        document.querySelector("#OtherFees").value = otherfees;

        tots.other = document.querySelector("#OtherFees").value;
        document.querySelector("#DriverHoursTotal").innerHTML = `$${tots.overtime}`;
        tots.driver = 0; 
        if (overtime) {
            tots.driver = overtime * tots.ot;
            document.querySelector("#DriverHoursTotal").innerHTML = '$' + tots.driver;
        }
        simpleConfig.current.QuoteTotal = document.querySelector("#QuoteAmount").value = document.querySelector("#QuoteTotal").value = parseInt(tots.overtime) + parseInt(tots.other) + parseInt(tots.fuel) + parseInt(tots.mileage) + parseInt(tots.firstfour);
    }
    function removeRate(rid) {
        let rids = document.querySelector("#RatesIDs").value;
        allrids = rids.split(/,/);
        let newrids = [];
        allrids.forEach(item=>{
            if (item != rid) {
                newrids.push(item);
            }
        });
        document.querySelector("#RatesIDs").value = newrids.join(",");
        updateRates();
        doModify($("#RatesIDs"));
    }
    function updateRateList(sel) {
        if (!sel) sel = "";
        let newrates = [];
        if (!sel || sel.text == "Standard Rate") {
            sel.text = "_Standard Rate";
        }
        let opt = `<optgroup label='${sel.text}'>`;
        allrates.forEach(rate=>{
            if (rate.Rate == sel.text) {
                opt += "<option value='"+rate.RatesID+"'>"+rate.Rates+"</option>";
                newrates.push(rate);
            }
        });
        opt += "</optgroup>";
        document.querySelector("#RateID").innerHTML = opt;
    }

    function addRate(ratesID) {
        let rids = document.querySelector("#RatesIDs").value;
        allrids = rids.split(/,/);
        allrids.push(ratesID);
        let newrids = allrids.join(",");
        document.querySelector("#RatesIDs").value = newrids;
        updateRates(allrids);

        doModify($("#RatesIDs"));
    }


    function cancelRequest(e) {
        if (e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        document.querySelector("#QuoteCancelled").setAttribute('checked');

        return false;
    }

    function cancelCancel(e) {
        e.preventDefault();
        e.stopPropagation();

    }
</script>
<dialog id="cancelDialog">
    <h2>Cancel Request?</h2>
    <button onclick="return cancelCancel(event);">">Cancel</button>
    <button onclick="cancelRequest()">OK</button>
</dialog>
<script src="/portal/assets/fontawesome-free-6.4.0-web/js/all.min.js"></script>
