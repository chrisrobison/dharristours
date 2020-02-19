<div class='tableGroup'>
   <div class='formHeading'>Quote ID: <?php print $current->QuoteID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Quote</label><input type='text' dbtype='varchar(100)' name='Quote[<?php print $current->QuoteID; ?>][Quote]' id='Quote' value='<?php print $current->Quote; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(250)' name='Quote[<?php print $current->QuoteID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Special Instructions</label><textarea dbtype='text' name='Quote[<?php print $current->QuoteID; ?>][SpecialInstructions]' id='SpecialInstructions' class='textBox'><?php print $current->SpecialInstructions; ?></textarea></div>
         <div class='contentField'><label>Business </label><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist();print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "Quote[$current->QuoteID][BusinessID]")."</div>";?>
         <div class='contentField'><label>Date</label><input type='text' dbtype='date' name='Quote[<?php print $current->QuoteID; ?>][Date]' id='Date' value='<?php print $current->Date; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Start Time</label><input type='text' dbtype='time' name='Quote[<?php print $current->QuoteID; ?>][StartTime]' id='StartTime' value='<?php print $current->StartTime; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>End Date</label><input type='text' dbtype='date' name='Quote[<?php print $current->QuoteID; ?>][EndDate]' id='EndDate' value='<?php print $current->EndDate; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>End Time</label><input type='text' dbtype='time' name='Quote[<?php print $current->QuoteID; ?>][EndTime]' id='EndTime' value='<?php print $current->EndTime; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Number Of Passengers</label><input type='text' dbtype='varchar(25)' name='Quote[<?php print $current->QuoteID; ?>][NumberOfPassengers]' id='NumberOfPassengers' value='<?php print $current->NumberOfPassengers; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Hours</label><input type='text' dbtype='varchar(25)' name='Quote[<?php print $current->QuoteID; ?>][Hours]' id='Hours' value='<?php print $current->Hours; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Budget Amount</label><input type='text' dbtype='varchar(25)' name='Quote[<?php print $current->QuoteID; ?>][BudgetAmount]' id='BudgetAmount' value='<?php print $current->BudgetAmount; ?>' size='25' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Pickup</label><input type='text' dbtype='varchar(100)' name='Quote[<?php print $current->QuoteID; ?>][Pickup]' id='Pickup' value='<?php print $current->Pickup; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Drop Off</label><input type='text' dbtype='varchar(100)' name='Quote[<?php print $current->QuoteID; ?>][DropOff]' id='DropOff' value='<?php print $current->DropOff; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Round Trip</label><select dbtype='tinyint(1)' name='Quote[<?php print $current->QuoteID; ?>][RoundTrip]' id='RoundTrip'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->RoundTrip; ?></select></div>
         <div class='contentField'><label>SPAB</label><select dbtype='tinyint(4)' name='Quote[<?php print $current->QuoteID; ?>][SPAB]' id='SPAB'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->SPAB; ?></select></div>
         <div class='contentField'><label>Wheel Chair</label><select dbtype='tinyint(4)' name='Quote[<?php print $current->QuoteID; ?>][WheelChair]' id='WheelChair'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->WheelChair; ?></select></div>
         <div class='contentField'><label>Contact Name</label><input type='text' dbtype='varchar(100)' name='Quote[<?php print $current->QuoteID; ?>][ContactName]' id='ContactName' value='<?php print $current->ContactName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Contact Phone</label><input type='text' dbtype='varchar(100)' name='Quote[<?php print $current->QuoteID; ?>][ContactPhone]' id='ContactPhone' value='<?php print $current->ContactPhone; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Contact Email</label><input type='text' dbtype='varchar(100)' name='Quote[<?php print $current->QuoteID; ?>][ContactEmail]' id='ContactEmail' value='<?php print $current->ContactEmail; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Status</label><input type='text' dbtype='varchar(50)' name='Quote[<?php print $current->QuoteID; ?>][Status]' id='Status' value='<?php print $current->Status; ?>' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Quote[<?php print $current->QuoteID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>