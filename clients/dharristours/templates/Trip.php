 <div class='tableGroup'>
   <div class='formHeading'>Trip ID: <?php print $current->TripID; ?></div>
<?php 

$job = $boss->getObject("Job",$current->JobID);
?>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Driver</label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "Trip[$current->TripID][EmployeeID]")."</div>";?>
         <div class='contentField'><label>Job </label><?php $boss->db->addResource("Job");$arr = $boss->db->Job->getlist();print $boss->utility->buildSelect($arr, $current->JobID, "JobID", "Job", "Trip[$current->TripID][JobID]")."</div>";?>
         <div class='contentField'><label>Job Start Date</label><input type='text' dbtype='date' name='Trip[<?php print $current->TripID; ?>][JobStartDate]' id='JobStartDate' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Yard Start Time</label><input type='text' dbtype='varchar(100)' name='Trip[<?php print $current->TripID; ?>][YardStartTime]' id='YardStartTime' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Yard Start Mileage</label><input type='text' dbtype='int(15)' name='Trip[<?php print $current->TripID; ?>][YardStartMileage]' id='YardStartMileage' value='' size='15' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Job Arrival Time</label><input type='text' dbtype='varchar(100)' name='Trip[<?php print $current->TripID; ?>][JobArrivalTime]' id='JobArrivalTime' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Job Start Time</label><input type='text' dbtype='varchar(100)' name='Trip[<?php print $current->TripID; ?>][JobStartTime]' id='JobStartTime' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Job End Date</label><input type='text' dbtype='datetime' name='Trip[<?php print $current->TripID; ?>][JobEndDate]' id='JobEndDate' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Job Endtime</label><input type='text' dbtype='varchar(100)' name='Trip[<?php print $current->TripID; ?>][JobEndtime]' id='JobEndtime' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Yard End Time</label><input type='text' dbtype='varchar(100)' name='Trip[<?php print $current->TripID; ?>][YardEndTime]' id='YardEndTime' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Yard End Mileage</label><input type='text' dbtype='int(15)' name='Trip[<?php print $current->TripID; ?>][YardEndMileage]' id='YardEndMileage' value='' size='15' class='boxValue' /></div>
         <div class='contentField'><label>Overtime</label><select dbtype='tinyint(4)' name='Trip[<?php print $current->TripID; ?>][Overtime]' id='Overtime'><option value='0'>No</option><option value='1'>Yes</option></select></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Trip[<?php print $current->TripID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>
