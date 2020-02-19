<div class='tableGroup'>
   <div class='formHeading'>Job ID: <?php print $current->JobID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Job</label><input type='text' dbtype='varchar(100)' name='Job[<?php print $current->JobID; ?>][Job]' id='Job' value='<?php print $current->Job; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Job Date</label><input type='text' dbtype='date' name='Job[<?php print $current->JobID; ?>][JobDate]' id='JobDate' value='<?php print $current->JobDate; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Quote </label><?php $boss->db->addResource("Quote");$arr = $boss->db->Quote->getlist();print $boss->utility->buildSelect($arr, $current->QuoteID, "QuoteID", "Quote", "Job[$current->JobID][QuoteID]")."</div>";?>
         <div class='contentField'><label>Trip </label><?php $boss->db->addResource("Trip");$arr = $boss->db->Trip->getlist();print $boss->utility->buildSelect($arr, $current->TripID, "TripID", "Trip", "Job[$current->JobID][TripID]")."</div>";?>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(150)' name='Job[<?php print $current->JobID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Quote Amount</label><input type='text' dbtype='float' name='Job[<?php print $current->JobID; ?>][QuoteAmount]' id='QuoteAmount' value='<?php print $current->QuoteAmount; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Business </label><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist();print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "Job[$current->JobID][BusinessID]")."</div>";?>
         <div class='contentField'><label>Business Location</label><input type='text' dbtype='varchar(50)' name='Job[<?php print $current->JobID; ?>][BusinessLocation]' id='BusinessLocation' value='<?php print $current->BusinessLocation; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Contact Name</label><input type='text' dbtype='varchar(50)' name='Job[<?php print $current->JobID; ?>][ContactName]' id='ContactName' value='<?php print $current->ContactName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Contact Phone</label><input type='text' dbtype='varchar(25)' name='Job[<?php print $current->JobID; ?>][ContactPhone]' id='ContactPhone' value='<?php print $current->ContactPhone; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Contact Email</label><input type='text' dbtype='varchar(150)' name='Job[<?php print $current->JobID; ?>][ContactEmail]' id='ContactEmail' value='<?php print $current->ContactEmail; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Round Trip</label><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][RoundTrip]' id='RoundTrip'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->RoundTrip; ?></select></div>
         <div class='contentField'><label>Pickup Location</label><textarea dbtype='text' name='Job[<?php print $current->JobID; ?>][PickupLocation]' id='PickupLocation' class='textBox'><?php print $current->PickupLocation; ?></textarea></div>
         <div class='contentField'><label>Drop Off Location</label><textarea dbtype='text' name='Job[<?php print $current->JobID; ?>][DropOffLocation]' id='DropOffLocation' class='textBox'><?php print $current->DropOffLocation; ?></textarea></div>
         <div class='contentField'><label>Final Drop Off Location</label><textarea dbtype='text' name='Job[<?php print $current->JobID; ?>][FinalDropOffLocation]' id='FinalDropOffLocation' class='textBox'><?php print $current->FinalDropOffLocation; ?></textarea></div>
         <div class='contentField'><label>Pickup Time</label><input type='text' dbtype='time' name='Job[<?php print $current->JobID; ?>][PickupTime]' id='PickupTime' value='<?php print $current->PickupTime; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Drop Off Time</label><input type='text' dbtype='time' name='Job[<?php print $current->JobID; ?>][DropOffTime]' id='DropOffTime' value='<?php print $current->DropOffTime; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Number Of Items</label><input type='text' dbtype='int(11)' name='Job[<?php print $current->JobID; ?>][NumberOfItems]' id='NumberOfItems' value='<?php print $current->NumberOfItems; ?>' size='11' class='boxValue' /></div>
         <div class='contentField'><label>Special Instructions</label><textarea dbtype='text' name='Job[<?php print $current->JobID; ?>][SpecialInstructions]' id='SpecialInstructions' class='textBox'><?php print $current->SpecialInstructions; ?></textarea></div>
         <div class='contentField'><label>Hours</label><input type='text' dbtype='float' name='Job[<?php print $current->JobID; ?>][Hours]' id='Hours' value='<?php print $current->Hours; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>SPAB</label><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][SPAB]' id='SPAB'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->SPAB; ?></select></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Cargo</label><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][Cargo]' id='Cargo'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->Cargo; ?></select></div>
         <div class='contentField'><label>Wheel Chair</label><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][WheelChair]' id='WheelChair'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->WheelChair; ?></select></div>
         <div class='contentField'><label>Confirmed</label><select dbtype='tinyint(1)' name='Job[<?php print $current->JobID; ?>][Confirmed]' id='Confirmed'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->Confirmed; ?></select></div>
         <div class='contentField'><label>Job Completed</label><select dbtype='tinyint(1)' name='Job[<?php print $current->JobID; ?>][JobCompleted]' id='JobCompleted'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->JobCompleted; ?></select></div>
         <div class='contentField'><label>Job Cancelled</label><select dbtype='tinyint(1)' name='Job[<?php print $current->JobID; ?>][JobCancelled]' id='JobCancelled'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->JobCancelled; ?></select></div>
         <div class='contentField'><label>Employee </label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "Job[$current->JobID][EmployeeID]")."</div>";?>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Status</label><input type='text' dbtype='varchar(100)' name='Job[<?php print $current->JobID; ?>][Status]' id='Status' value='<?php print $current->Status; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Bus </label><?php $boss->db->addResource("Bus");$arr = $boss->db->Bus->getlist();print $boss->utility->buildSelect($arr, $current->BusID, "BusID", "Bus", "Job[$current->JobID][BusID]")."</div>";?>
         <div class='contentField'><label>On Spot Time</label><input type='text' dbtype='varchar(25)' name='Job[<?php print $current->JobID; ?>][OnSpotTime]' id='OnSpotTime' value='<?php print $current->OnSpotTime; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Depart Yard Time</label><input type='text' dbtype='varchar(25)' name='Job[<?php print $current->JobID; ?>][DepartYardTime]' id='DepartYardTime' value='<?php print $current->DepartYardTime; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Job Printed</label><input type='text' dbtype='datetime' name='Job[<?php print $current->JobID; ?>][JobPrinted]' id='JobPrinted' value='<?php print $current->JobPrinted; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>School </label><?php $boss->db->addResource("School");$arr = $boss->db->School->getlist();print $boss->utility->buildSelect($arr, $current->SchoolID, "SchoolID", "School", "Job[$current->JobID][SchoolID]")."</div>";?>
         <div class='contentField'><label>No Invoice</label><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][NoInvoice]' id='NoInvoice'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->NoInvoice; ?></select></div>
         <div class='contentField'><label>Invoice Satisfied</label><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][InvoiceSatisfied]' id='InvoiceSatisfied'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->InvoiceSatisfied; ?></select></div>
         <div class='contentField'><label>Invoice Outstanding</label><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][InvoiceOutstanding]' id='InvoiceOutstanding'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->InvoiceOutstanding; ?></select></div>
         <div class='contentField'><label>Additional Bus</label><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][AdditionalBus]' id='AdditionalBus'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->AdditionalBus; ?></select></div>
         <div class='contentField'><label>Quote Only</label><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][QuoteOnly]' id='QuoteOnly'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->QuoteOnly; ?></select></div>
         <div class='contentField'><label>Driver Notified</label><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][DriverNotified]' id='DriverNotified'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->DriverNotified; ?></select></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Job[<?php print $current->JobID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>