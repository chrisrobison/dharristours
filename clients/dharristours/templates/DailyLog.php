<!--script>
   $(function() {
      $("#JobID").change(function(evt) {
         $("#Trip_Job_TripID").attr("name", "Trip[" + simpleConfig.id + "][Job][" + $("#JobID").val() + "][TripID]").val(simpleConfig.id);
      });
   });
</script -->
<div class='tableGroup'>
   <div class='formHeading'>Trip ID: <?php print $current->TripID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Overtime</label><select dbtype='tinyint(4)' name='Trip[<?php print $current->TripID; ?>][Overtime]' id='Overtime'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Bus </label><?php $boss->db->addResource("Bus");$arr = $boss->db->Bus->getlist();print $boss->utility->buildSelect($arr, $current->BusID, "BusID", "Bus", "Trip[$current->TripID][BusID]")."</div>";?>
         <div class='contentField'><label>Trip</label><input type='text' dbtype='varchar(100)' name='Trip[<?php print $current->TripID; ?>][Trip]' id='Trip' value='<?php print $current->Trip; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Trip[<?php print $current->TripID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Job ID(#Only)</label><input type='text' dbtype='int(15)' name='Trip[<?php print $current->TripID; ?>][JobID]' id='JobID' value='<?php print $current->JobID; ?>' size='15' class='boxValue' /></div>
         <div class='contentField'><label>Job Start Time</label><input type='text' dbtype='varchar(100)' name='Trip[<?php print $current->TripID; ?>][JobStartTime]' id='JobStartTime' value='<?php print $current->JobStartTime; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Job End Time</label><input type='text' dbtype='varchar(100)' name='Trip[<?php print $current->TripID; ?>][JobEndTime]' id='JobEndTime' value='<?php print $current->JobEndTime; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Total Trip Hours</label><input type='text' dbtype='float' name='Trip[<?php print $current->TripID; ?>][TotalHoursWorked]' id='TotalHoursWorked' value='<?php print $current->TotalHoursWorked; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Employee </label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "Trip[$current->TripID][EmployeeID]")."</div>";?>
         <div class='contentField'><label>Pax</label><input type='text' dbtype='int(15)' name='Trip[<?php print $current->TripID; ?>][ActualPax]' id='ActualPax' value='<?php print $current->ActualPax; ?>' size='15' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Date</label><input type='text' dbtype='date' name='Trip[<?php print $current->TripID; ?>][JobStartDate]' id='JobStartDate' value='<?php print $current->JobStartDate; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>(If Diff) End Date</label><input type='text' dbtype='date' name='Trip[<?php print $current->TripID; ?>][JobEndDate]' id='JobEndDate' value='<?php print $current->JobEndDate; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Yard Departure Time</label><input type='text' dbtype='varchar(100)' name='Trip[<?php print $current->TripID; ?>][YardStartTime]' id='YardStartTime' value='<?php print $current->YardStartTime; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Yard Start Mileage</label><input type='text' dbtype='int(15)' name='Trip[<?php print $current->TripID; ?>][YardStartMileage]' id='YardStartMileage' value='<?php print $current->YardStartMilage; ?>' size='15' class='boxValue' /></div>
         <div class='contentField'><label>On Spot Time</label><input type='text' dbtype='varchar(100)' name='Trip[<?php print $current->TripID; ?>][JobArrivalTime]' id='JobArrivalTime' value='<?php print $current->JobArrivalTime; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Yard Return Time</label><input type='text' dbtype='varchar(100)' name='Trip[<?php print $current->TripID; ?>][YardEndTime]' id='YardEndTime' value='<?php print $current->YardEndTime; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Final Mileage</label><input type='text' dbtype='int(15)' name='Trip[<?php print $current->TripID; ?>][YardEndMileage]' id='YardEndMileage' value='<?php print $current->YardEndMileage; ?>' size='15' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Trip[<?php print $current->TripID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>

</div>
   <input type="hidden" id='Trip_Job_TripID' name='Trip[][Job][][TripID]' value='<?php print $current->TripID; ?>' />
