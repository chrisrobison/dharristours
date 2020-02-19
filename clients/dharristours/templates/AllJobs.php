<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> Job ID: <?php print $current->JobID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Job</label><input type='text' dbtype='varchar(100)' name='Job[<?php print $current->JobID; ?>][Job]' id='Job' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Job Date</label><input type='text' dbtype='date' name='Job[<?php print $current->JobID; ?>][JobDate]' id='JobDate' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Business </label><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist();print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "Job[$current->JobID][BusinessID]")."</div>";?>
         <div class='contentField'><label>Business Location</label><input type='text' dbtype='varchar(50)' name='Job[<?php print $current->JobID; ?>][BusinessLocation]' id='BusinessLocation' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Contact Name</label><input type='text' dbtype='varchar(50)' name='Job[<?php print $current->JobID; ?>][ContactName]' id='ContactName' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Contact Phone</label><input type='text' dbtype='varchar(25)' name='Job[<?php print $current->JobID; ?>][ContactPhone]' id='ContactPhone' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Pickup Location</label><input type='text' dbtype='varchar(100)' name='Job[<?php print $current->JobID; ?>][PickupLocation]' id='PickupLocation' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Drop Off Location</label><input type='text' dbtype='varchar(100)' name='Job[<?php print $current->JobID; ?>][DropOffLocation]' id='DropOffLocation' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Final Drop Off Location</label><input type='text' dbtype='varchar(100)' name='Job[<?php print $current->JobID; ?>][FinalDropOffLocation]' id='FinalDropOffLocation' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Pickup Time</label><input type='text' dbtype='time' name='Job[<?php print $current->JobID; ?>][PickupTime]' id='PickupTime' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Drop Off Time</label><input type='text' dbtype='time' name='Job[<?php print $current->JobID; ?>][DropOffTime]' id='DropOffTime' value='' size='25' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Number Of Items</label><input type='text' dbtype='int(11)' name='Job[<?php print $current->JobID; ?>][NumberOfItems]' id='NumberOfItems' value='' size='11' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(150)' name='Job[<?php print $current->JobID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Special Instructions</label><input type='text' dbtype='varchar(150)' name='Job[<?php print $current->JobID; ?>][SpecialInstructions]' id='SpecialInstructions' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Hours</label><input type='text' dbtype='float' name='Job[<?php print $current->JobID; ?>][Hours]' id='Hours' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Quote</label><input type='text' dbtype='float' name='Job[<?php print $current->JobID; ?>][Quote]' id='Quote' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Confirmed</label><select dbtype='tinyint(1)' name='Job[<?php print $current->JobID; ?>][Confirmed]' id='Confirmed'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Job Completed</label><select dbtype='tinyint(1)' name='Job[<?php print $current->JobID; ?>][JobCompleted]' id='JobCompleted'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Job Cancelled</label><select dbtype='tinyint(1)' name='Job[<?php print $current->JobID; ?>][JobCancelled]' id='JobCancelled'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Employee </label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "Job[$current->JobID][EmployeeID]")."</div>";?>

</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Job[<?php print $current->JobID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>
