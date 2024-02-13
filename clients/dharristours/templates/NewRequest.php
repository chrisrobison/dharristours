<style>
#rateTable {
    background: #fff;
    text-align: center;
}
#rateTable {
    width: 100%; 
    border-collapse: collapse;
}

#rateTable td, #rateTable th {
    border-right: 1px solid #333;
    border-bottom: 1px solid #333;
}
#rateTable th {
    background: #222;
    color:#fff;
}
.genSelect {
    width: 30rem;
}
.arrows button {
  background-color: transparent;
  border: none;
  cursor: pointer;
  margin: 0;
  outline: none;
  padding: 0;
}

.arrows {
  align-items: center;
  display: flex;
}

.arrow {
  position: relative;
}
.arrow + .arrow {
  margin-left: 16px;
}

.arrow-link {
  align-items: center;
  background-color: #999;
  border-bottom: 4px solid #666;
  border-top: 4px solid #666;
  display: flex;
  height: 70px;
  justify-content: center;
  line-height: 1.45;
  padding-left: 40px;
  position: relative;
  width: 130px;
  color: #fff;
  text-shadow: 1px 1px 0px #000;
}
.step {
  border-radius: 50%;
  width: 30px;
  height: 30px;
  position: absolute;
  display:flex;
  align-items: center;
  justify-content: center;
  top: -8px; left: 30px;
  font-size: 2em;
}
.arrow-is-active .arrow-link {
  background-color: #b00;
  border-bottom-color: #700;
  border-top-color: #700;
  font-weight: bold;
  color:#fff;
}
.arrow-is-complete .arrow-link {
  background-color: #0b0;
  border-bottom-color: #060;
  border-top-color: #060;
}

.arrow-head {
  background-color: #999;
  backface-visibility: hidden;
  border-radius: 6px 0px 6px 0px;
  border-top: 4px solid #666;
  border-right: 4px solid #666;
  border-bottom: 4px solid transparent;
  border-left: 4px solid transparent;
  height: 51px;
  position: absolute;
  right: 0;
  top: 50%;
  transform: translateX(50%) translateY(-50%) rotate(45deg);
  width: 51px;
}
.arrow-is-active .arrow-head {
  background-color: #b00;
  border-top-color: #700;
  border-right-color: #700;
}
.arrow-is-complete .arrow-head {
  background-color: #0b0;
  border-top-color: #060;
  border-right-color: #060;
}

.arrow-tail {
  background-color: white;
  border-radius: 6px 0px 6px 0px;
  border-top: 4px solid #666;
  border-right: 4px solid #666;
  border-bottom: 4px solid transparent;
  border-left: 4px solid transparent;
  height: 51px;
  position: absolute;
  left: 0;
  top: 50%;
  transform: translateX(-50%) translateY(-50%) rotate(45deg);
  width: 51px;
}
.arrow-is-active .arrow-tail {
  border-top-color: #600;
  border-right-color: #600;
}
.arrow-is-complete .arrow-tail {
  border-top-color: #060;
  border-right-color: #060;
}

.arrow:first-of-type {
  border-left: 4px solid #060;
}
.arrow:first-of-type.arrow-is-active,
.arrow-is-active .arrow:first-of-type {
  border-left-color: #060;
}
.arrow:first-of-type.arrow-is-complete,
.arrow-is-complete .arrow:first-of-type {
  border-left-color: #0b0;
}
.arrow:first-of-type .arrow-link {
  padding-left: 20px;
}

.arrow-1 {
  z-index: 5;
}
.arrow-2 {
  z-index: 4;
}
.arrow-3 {
  z-index: 3;
}
.arrow-4 {
  z-index: 2;
}
.arrow-5 {
  z-index: 1;
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
            <p>Add a rate for each bus needed for the job or click the 'Calculate' <br>button to automatically assign standard rates.<br>
                
            <input type='hidden' rel="data" name="Request[<?php print $current->RequestID; ?>][RatesIDs]" id="RatesIDs" value="<?php print $current->RatesIDs; ?>" onchange="updateRates(this.value)"/>
            <div class='contentField'><label style='width:4em'>Rate </label><?php $boss->db->addResource("Rate");$arr = $boss->db->Rate->getlist();print $boss->utility->buildRatesSelect($arr, $current->RateID, "RateID", "RateID", "Request[$current->RequestID][RateID]");?><button onclick="addRate(document.querySelector('#RateID').options[document.querySelector('#RateID').selectedIndex].value); return false;">Add Rate</button><button onclick="calcRates(); return false;">Calculate</button></div>

            <table id='rateTable'>
                <thead>
                    <tr>
                        <th>Bus Size</th>
                        <th>1st 4 hr</th>
                        <th>Overtime</th>
                        <th>One Way</th>
                        <th style='width:1rem;'></th>
                    </tr>
                </thead>
                <tbody id='ratesTableBody'>
                    <tr>
                        <td colspan='5'>No Rates Assigned</td>
                    </tr>
                </tbody>
            </table>
<script>
<?php
    $ratesobj = $boss->getObject("Rates");
    $allrates = array();

    foreach ($ratesobj->Rates as $obj) {
        if ($obj->RatesID) {
            $allrates[$obj->RatesID] = $obj;
        }
    }
    print "let allrates = " . json_encode($allrates) .";\n";
?>
    function calcRates() {
        let pax = simpleConfig.current.Pax;
        let rids = [];

        while (pax > 44) {
           rids.push(3);
           pax = pax - 45;
        }

        if (pax > 38) {
            rids.push(2);
        } else if (pax > 0) {
            rids.push(1);
        }
        document.querySelector("#RatesIDs").value = rids.join(",");
        updateRates(rids);

        doModify($("#RatesIDs"));
    }
    function updateRates(ratelist) {
        let rids = document.querySelector("#RatesIDs").value;
        allrids = rids.split(/,/);
        
        // let out = "<table id='ratesTable'><thead><tr><th>Bus Size</th><th>1st 4 hr</th><th>Overtime</th><th>One Way</th><th style='width:1rem;'></th></tr></thead><tbody>";
        let out = "";
        if (allrids.length) {
            allrids.forEach(rid=>{
                let myrate = allrates[rid];
                if (myrate) {
                    out += `<tr><td>${myrate.Pax} Passengers</td><td>$${myrate.FirstFour}</td><td>$${myrate.Overtime}</td><td>$${myrate.OneWay}</td><td><button onclick="removeRate(${rid}); return false">x</button></tr>`;
                }
            });
        }
        if (out == "") {
            out += "<tr><td colspan=5>No Rates Assigned</td></tr>";
        }
        // out += "</tbody></table>";
        document.querySelector("#ratesTableBody").innerHTML = out;

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
    function addRate(ratesID) {
        let rids = document.querySelector("#RatesIDs").value;
        allrids = rids.split(/,/);
        allrids.push(ratesID);
        let newrids = allrids.join(",");
        document.querySelector("#RatesIDs").value = newrids;
        updateRates();
        doModify($("#RatesIDs"));
    }
</script>
<style>
.arrows {
    box-sizing: border-box;
}
.arrow-link {
    font-size: 1.2rem;
}
.arrow-1 .step {
    left: 12px;
}
#simpleForm input.boxValue, #simpleForm textarea.textBox {
    width: 30em;
}
</style>
<script>
function updateArrow(who, add) {
    document.querySelector(`.arrow-${who}`).classList.add(add).remove('arrow-is-active');
}
</script>
            <div id="rateTable">
            </div>
        </fieldset>
        <div class='contentField' style="display:none;"><label>UID</label><input type='text' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][UID]' id='UID' value='<?php print $current->UID; ?>' size='50' class='boxValue' /></div>
    </div>
    <div class='fieldcolumn'>
        <div class='contentField' style='padding-left:1rem;'>
            <input style="position:absolute;" type="checkbox" id="QuoteSent" name="Request[<?php print $current->RequestID; ?>][QuoteSent]" value="1" onchange="updateArrow(2, 'arrow-is-complete')"/>
            <input style="position:absolute;" type="checkbox" id="ClientConfirmed" name="Request[<?php print $current->RequestID; ?>][ClientConfirmed]" value="1" onchange="updateArrow(3, 'arrow-is-complete')"/>
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
        </div>
        <fieldset>
            <legend>Trip Details</legend>
            <div class='contentField'><label>Pickup</label><input type='text' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][Pickup]' id='Pickup' value='<?php print $current->Pickup; ?>' size='50' class='boxValue' /></div>
            <div class='contentField'><label>Destination</label><input type='text' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][Destination]' id='Destination' value='<?php print $current->Destination; ?>' size='50' class='boxValue' /></div>
            <div class='contentField'><label>Return</label><input type='text' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][Return]' id='Return' value='<?php print $current->Return; ?>' size='50' class='boxValue' /></div>
            <div class='contentField'><label>Pax</label><input type='number' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][Pax]' id='Pax' value='<?php print $current->Pax; ?>' size='50' class='boxValue' style='width:4em;'/></div>
            <div class='contentField'><label>Date</label><input type='text' dbtype='date' name='Request[<?php print $current->RequestID; ?>][Date]' id='Date' value='<?php print $current->Date; ?>' size='25' class='boxValue date' style='width:6em' /></div>
            <div class='contentField'><label>Start</label><input type='time' dbtype='time' name='Request[<?php print $current->RequestID; ?>][Start]' id='Start' value='<?php print $current->Start; ?>' size='25' class='boxValue' style='width:7em;' />
            <label style='width: 3em;'>End</label><input type='time' dbtype='time' name='Request[<?php print $current->RequestID; ?>][End]' id='End' value='<?php print $current->End; ?>' size='25' class='boxValue' style='width:7em;' /></div>
            <div class='contentField'><label>Round Trip</label><input type='checkbox' dbtype='tinyint(1)' name='Request[<?php print $current->RequestID; ?>][RoundTrip]' id='RoundTrip' value='Yes'></div>
            <!--input type='text' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][RoundTrip]' id='RoundTrip' value='<?php print $current->RoundTrip; ?>' size='50' class='boxValue' /></div-->
            <div class='contentField'><label>Options</label><input type='checkbox' dbtype='tinyint(1)' name='Request[<?php print $current->RequestID; ?>][ADA]' id='ADA' value='Yes'><label style='width:5em;text-align:left;'>ADA</label>
            <input type='checkbox' dbtype='tinyint(1)' name='Request[<?php print $current->RequestID; ?>][Shuttle]' id='Shuttle' value='Yes'><label style="width:5em;text-align:left;">Shuttle</label>
            <input type='checkbox' dbtype='tinyint(1)' name='Request[<?php print $current->RequestID; ?>][Text]' id='Text' value='Yes'><label style="width:5em;text-align:left;">Text</label>
            </div>
        </fieldset>
    </div>
</div>
   <div class="fieldcolumn">
      <fieldset>
         <legend>Quote Email</legend>
         <button onclick="previewQuote();return false;">Preview Email</button>
         <button onclick="sendQuote();return false;">Send Quote</button>
         <div class'contentfield'=""><iframe id="quote" style="width:800px;height:30em;" src="/files/email-templates/preview.php?tpl=quote.html&id=<?php print $current->RateID; ?>"></iframe></div>
      </fieldset>
    </div>
    <div class='contentField' style='float:left'><label>Notes</label><textarea dbtype='text' name='Request[<?php print $current->RequestID; ?>][Notes]' id='Notes' style='width:48em;white-space:normal;' class='textBox'>
<?php print $current->Notes; ?>
         </textarea></div></div>
</div>
<script>
function sendQuote() {
    fetch("https://dharristours.simpsf.com/files/email-templates/sendquote.php?id="+simpleConfig.current.RequestID).then(r=>r.json()).then(data=>{ 
        console.dir(data);
        document.querySelector('#QuoteSent').setAttribute('checked', 'checked');
        document.querySelector('.arrow-is-active').classList.remove('arrow-is-active');
        document.querySelector('.arrow-2').classList.add('arrow-is-complete');
        document.querySelector('.arrow-3').classList.add('arrow-is-active');

        doModify($('#QuoteSent'));
        alert("Quote sent successfully.");
    });
}
function previewQuote() {
    window.open('/files/email-templates/preview.php?id='+simpleConfig.id, '_blank');
}

</script>
