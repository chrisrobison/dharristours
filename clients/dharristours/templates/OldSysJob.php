<div class='tableGroup'>
   <div class='formHeading'>OldSysJob ID: <?php print $current->OldSysJobID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Job </label><?php $boss->db->addResource("Job");$arr = $boss->db->Job->getlist();print $boss->utility->buildSelect($arr, $current->JobID, "JobID", "Job", "OldSysJob[$current->OldSysJobID][JobID]")."</div>";?>
         <div class='contentField'><label>Job</label><input type='text' dbtype='varchar(100)' name='OldSysJob[<?php print $current->OldSysJobID; ?>][Job]' id='Job' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Job Date</label><input type='text' dbtype='date' name='OldSysJob[<?php print $current->OldSysJobID; ?>][JobDate]' id='JobDate' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Quote </label><?php $boss->db->addResource("Quote");$arr = $boss->db->Quote->getlist();print $boss->utility->buildSelect($arr, $current->QuoteID, "QuoteID", "Quote", "OldSysJob[$current->OldSysJobID][QuoteID]")."</div>";?>
         <div class='contentField'><label>Trip </label><?php $boss->db->addResource("Trip");$arr = $boss->db->Trip->getlist();print $boss->utility->buildSelect($arr, $current->TripID, "TripID", "Trip", "OldSysJob[$current->OldSysJobID][TripID]")."</div>";?>
         <div class='contentField'><label>Invoice </label><?php $boss->db->addResource("Invoice");$arr = $boss->db->Invoice->getlist();print $boss->utility->buildSelect($arr, $current->InvoiceID, "InvoiceID", "Invoice", "OldSysJob[$current->OldSysJobID][InvoiceID]")."</div>";?>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(150)' name='OldSysJob[<?php print $current->OldSysJobID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Quote</label><input type='text' dbtype='float' name='OldSysJob[<?php print $current->OldSysJobID; ?>][Quote]' id='Quote' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Business </label><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist();print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "OldSysJob[$current->OldSysJobID][BusinessID]")."</div>";?>
         <div class='contentField'><label>Business Location</label><input type='text' dbtype='varchar(50)' name='OldSysJob[<?php print $current->OldSysJobID; ?>][BusinessLocation]' id='BusinessLocation' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Contact Name</label><input type='text' dbtype='varchar(50)' name='OldSysJob[<?php print $current->OldSysJobID; ?>][ContactName]' id='ContactName' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Contact Phone</label><input type='text' dbtype='varchar(25)' name='OldSysJob[<?php print $current->OldSysJobID; ?>][ContactPhone]' id='ContactPhone' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Pickup Location</label><input type='text' dbtype='varchar(100)' name='OldSysJob[<?php print $current->OldSysJobID; ?>][PickupLocation]' id='PickupLocation' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Drop Off Location</label><input type='text' dbtype='varchar(100)' name='OldSysJob[<?php print $current->OldSysJobID; ?>][DropOffLocation]' id='DropOffLocation' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Final Drop Off Location</label><input type='text' dbtype='varchar(100)' name='OldSysJob[<?php print $current->OldSysJobID; ?>][FinalDropOffLocation]' id='FinalDropOffLocation' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Pickup Time</label><input type='text' dbtype='time' name='OldSysJob[<?php print $current->OldSysJobID; ?>][PickupTime]' id='PickupTime' value='' size='25' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Drop Off Time</label><input type='text' dbtype='time' name='OldSysJob[<?php print $current->OldSysJobID; ?>][DropOffTime]' id='DropOffTime' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Number Of Items</label><input type='text' dbtype='int(11)' name='OldSysJob[<?php print $current->OldSysJobID; ?>][NumberOfItems]' id='NumberOfItems' value='' size='11' class='boxValue' /></div>
         <div class='contentField'><label>Special Instructions</label><textarea dbtype='text' name='OldSysJob[<?php print $current->OldSysJobID; ?>][SpecialInstructions]' id='SpecialInstructions' class='textBox'></textarea></div>
         <div class='contentField'><label>Hours</label><input type='text' dbtype='float' name='OldSysJob[<?php print $current->OldSysJobID; ?>][Hours]' id='Hours' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>SPAB</label><select dbtype='tinyint(4)' name='OldSysJob[<?php print $current->OldSysJobID; ?>][SPAB]' id='SPAB'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Wheel Chair</label><select dbtype='tinyint(4)' name='OldSysJob[<?php print $current->OldSysJobID; ?>][WheelChair]' id='WheelChair'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Confirmed</label><select dbtype='tinyint(1)' name='OldSysJob[<?php print $current->OldSysJobID; ?>][Confirmed]' id='Confirmed'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Job Completed</label><select dbtype='tinyint(1)' name='OldSysJob[<?php print $current->OldSysJobID; ?>][JobCompleted]' id='JobCompleted'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Job Cancelled</label><select dbtype='tinyint(1)' name='OldSysJob[<?php print $current->OldSysJobID; ?>][JobCancelled]' id='JobCancelled'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Employee </label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "OldSysJob[$current->OldSysJobID][EmployeeID]")."</div>";?>

         <div class='contentField'><label>Status</label><input type='text' dbtype='varchar(100)' name='OldSysJob[<?php print $current->OldSysJobID; ?>][Status]' id='Status' value='' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='OldSysJob[<?php print $current->OldSysJobID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>