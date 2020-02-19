<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> IntakeForm ID: <?php print $current->IntakeFormID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Event Name</label><input type='text' dbtype='varchar(100)' name='IntakeForm[<?php print $current->IntakeFormID; ?>][IntakeForm]' id='IntakeForm' value='' size='50' class='boxValue' /></div>

         <div class='contentField'><label>Event Type ID</label><?php $boss->db->addResource("EventType");$arr = $boss->db->EventType->getlist();print $boss->utility->buildSelect($arr, $current->EventTypeID, "EventTypeID", "EventType", "IntakeForm[$current->IntakeFormID][EventTypeID]")."</div>";?>
         <div class='contentField'><label>Name</label><input type='text' dbtype='varchar(100)' name='IntakeForm[<?php print $current->IntakeFormID; ?>][Name]' id='Name' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Phone</label><input type='text' dbtype='varchar(100)' name='IntakeForm[<?php print $current->IntakeFormID; ?>][Phone]' id='Phone' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Address</label><input type='text' dbtype='varchar(100)' name='IntakeForm[<?php print $current->IntakeFormID; ?>][Address]' id='Address' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(100)' name='IntakeForm[<?php print $current->IntakeFormID; ?>][Email]' id='Email' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Event Date</label><input type='text' dbtype='datetime' name='IntakeForm[<?php print $current->IntakeFormID; ?>][EventDate]' id='EventDate' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Day Of Event</label><input type='text' dbtype='varchar(100)' name='IntakeForm[<?php print $current->IntakeFormID; ?>][DayOfEvent]' id='DayOfEvent' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Start Time</label><input type='text' dbtype='varchar(100)' name='IntakeForm[<?php print $current->IntakeFormID; ?>][StartTime]' id='StartTime' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>End Time</label><input type='text' dbtype='varchar(100)' name='IntakeForm[<?php print $current->IntakeFormID; ?>][EndTime]' id='EndTime' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>No Of Guests</label><input type='text' dbtype='int(15)' name='IntakeForm[<?php print $current->IntakeFormID; ?>][NoOfGuests]' id='NoOfGuests' value='' size='15' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Lodge Room</label><input type='text' dbtype='varchar(100)' name='IntakeForm[<?php print $current->IntakeFormID; ?>][LodgeRoom]' id='LodgeRoom' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Bar</label><input type='text' dbtype='varchar(100)' name='IntakeForm[<?php print $current->IntakeFormID; ?>][Bar]' id='Bar' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Host</label><select dbtype='tinyint(1)' name='IntakeForm[<?php print $current->IntakeFormID; ?>][Host]' id='Host'><option value='0'>False</option><option value='1'>True</option></select></div>
         <div class='contentField'><label>Non Profit</label><select dbtype='tinyint(1)' name='IntakeForm[<?php print $current->IntakeFormID; ?>][NonProfit]' id='NonProfit'><option value='0'>False</option><option value='1'>True</option></select></div>
         <div class='contentField'><label>Member Sponsor</label><input type='text' dbtype='varchar(100)' name='IntakeForm[<?php print $current->IntakeFormID; ?>][MemberSponsor]' id='MemberSponsor' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Caterer</label><input type='text' dbtype='varchar(100)' name='IntakeForm[<?php print $current->IntakeFormID; ?>][Caterer]' id='Caterer' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Music</label><input type='text' dbtype='varchar(100)' name='IntakeForm[<?php print $current->IntakeFormID; ?>][Music]' id='Music' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><textarea dbtype='text' name='IntakeForm[<?php print $current->IntakeFormID; ?>][Description]' id='Description' class='textBox'></textarea></div>
         <div class='contentField'><label>Special Request</label><textarea dbtype='text' name='IntakeForm[<?php print $current->IntakeFormID; ?>][SpecialRequest]' id='SpecialRequest' class='textBox'></textarea></div>
         <div class='contentField'><label>Budget</label><input type='text' dbtype='decimal(10,2)' name='IntakeForm[<?php print $current->IntakeFormID; ?>][Budget]' id='Budget' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Misc</label><textarea dbtype='text' name='IntakeForm[<?php print $current->IntakeFormID; ?>][Misc]' id='Misc' class='textBox'></textarea></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='IntakeForm[<?php print $current->IntakeFormID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>