<div class='tableGroup'>
   <div class='formHeading'>Request ID: <?php print $current->RequestID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Request</label><input type='text' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][Request]' id='Request' value='<?php print $current->Request; ?>' size='50' class='boxValue' /></div>
         <fieldset>
            <legend>Contact</legend>
             <div class='contentField'><label style='width:4em'>Name</label><input type='text' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][Name]' id='Name' value='<?php print $current->Name; ?>' size='50' class='boxValue' /></div>
             <div class='contentField'><label style='width:4em'>Email</label><input type='text' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
             <div class='contentField'><label style='width:4em;'>Phone</label><input type='text' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='50' class='boxValue' /></div>
        </fieldset>
        <div class='contentField'><label>Business </label><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist();print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "Request[$current->RequestID][BusinessID]")."</div>";?>
        <div class='contentField'><label>Quote </label><?php $boss->db->addResource("Quote");$arr = $boss->db->Quote->getlist();print $boss->utility->buildSelect($arr, $current->QuoteID, "QuoteID", "Quote", "Request[$current->RequestID][QuoteID]")."</div>";?>
        <div class='contentField'><label>UID</label><input type='text' dbtype='varchar(100)' name='Request[<?php print $current->RequestID; ?>][UID]' id='UID' value='<?php print $current->UID; ?>' size='50' class='boxValue' /></div>
    </div>
    <div class='fieldcolumn'>
        <div class='contentField'><br></div>
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
        <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Request[<?php print $current->RequestID; ?>][Notes]' id='Notes' style='width:48em;white-space:normal;' class='textBox'>
<?php print $current->Notes; ?>
         </textarea></div></div>
</div>
