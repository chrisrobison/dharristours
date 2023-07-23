<style>
#rateTable {
    background: #fff;
    text-align: center;
}
#ratesTable {
    width: 100%; 
}
#rateTable td, #rateTable th {
    border-right: 1px solid #333;
    border-bottom: 1px solid #333;
}
</style>
<script>
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
         <div class='contentField'><label>Request</label><input type='text' onchange="updateQuoteEmail()" dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][Request]' id='Request' value='<?php print $current->Request; ?>' size='100' style='width:40em;' class='boxValue' /></div>
         <fieldset>
            <legend>Contact</legend>
             <div class='contentField'><label style='width:4em'>Name</label><input type='text' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][Name]' id='Name' value='<?php print $current->Name; ?>' size='50' class='boxValue' /></div>
             <div class='contentField'><label style='width:4em'>Email</label><input type='text' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
             <div class='contentField'><label style='width:4em;'>Phone</label><input type='text' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='50' class='boxValue' /></div>
            <div class='contentField'><label>Business </label><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist();print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "Request[$current->RequestID][BusinessID]")."</div>";?>
        </fieldset>
        <fieldset>
            <legend>Rates</legend>
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
    function updateRates(ratelist) {
        let rids = document.querySelector("#RatesIDs").value;
        allrids = rids.split(/,/);
        
        let out = "<table id='ratesTable'><thead><tr><th>Bus Size</th><th>1st 4 hr</th><th>Overtime</th><th>One Way</th><th></th></tr></thead><tbody>";
        if (allrids.length) {
            allrids.forEach(rid=>{
                let myrate = allrates[rid];
                if (myrate) {
                    out += `<tr><td>${myrate.Pax} Passengers</td><td>$${myrate.FirstFour}</td><td>$${myrate.Overtime}</td><td>$${myrate.OneWay}</td><td><button onclick="removeRate(${rid}); return false">x</button></tr>`;
                }
            });
        } else {
            out += "<tr><td colspan=4>No Rates Assigned</td></tr>";
        }
        out += "</tbody></table>";
        document.querySelector("#rateTable").innerHTML = out;

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
            <input type='hidden' rel="data" name="Request[<?php print $current->RequestID; ?>][RatesIDs]" id="RatesIDs" value="<?php print $current->RatesIDs; ?>" onchange="updateRates(this.value)"/>
            <div class='contentField'><label>Rate </label><?php $boss->db->addResource("Rate");$arr = $boss->db->Rate->getlist();print $boss->utility->buildRatesSelect($arr, $current->RateID, "RateID", "RateID", "Request[$current->RequestID][RateID]");?><button onclick="addRate(document.querySelector('#RateID').options[document.querySelector('#RateID').selectedIndex].value); return false;">Add Rate</button></div>
            <div id="rateTable">
            </div>
        <!--div class='contentField'><label>Quote </label><?php $boss->db->addResource("Quote");$arr = $boss->db->Quote->getlist();print $boss->utility->buildSelect($arr, $current->QuoteID, "QuoteID", "Quote", "Request[$current->RequestID][QuoteID]")."</div>";?>-->
        </fieldset>
      <fieldset>
         <legend>Quote Email</legend>
         <div class'contentfield'=""><iframe id="quote" style="width:800px;height:30em;" src="/files/email-templates/example.php?id=<?php print $current->RateID; ?>"></iframe></div>
      </fieldset>
    </div>
    <div class='fieldcolumn'>
        <div class='contentField'><label>UID</label><input type='text' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][UID]' id='UID' value='<?php print $current->UID; ?>' size='50' class='boxValue' /></div>
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
    <div class='contentField' style='float:left'><label>Notes</label><textarea dbtype='text' name='Request[<?php print $current->RequestID; ?>][Notes]' id='Notes' style='width:48em;white-space:normal;' class='textBox'>
<?php print $current->Notes; ?>
         </textarea></div></div>
</div>
