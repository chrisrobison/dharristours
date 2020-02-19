<div class='tableGroup'>
   <div class='formHeading'>
      Job ID: <?php print $current->JobID; ?>
   </div>
   <span id="customButtons">
      <a name='createInvoiceButton' class='simpleButton disabled' onclick='return openWin("<?php print $boss->app->Assets; ?>/templates/JobToInvoice.php?ID="+simpleConfig.id, "btnInvWin")'><span class='ui-icon ui-icon-print'></span>GenInvoice</a>
      <a name='driverLogButton' class='simpleButton disabled' onclick='return openWin("<?php print $boss->app->Assets; ?>/templates/DriverLog.php?ID="+simpleConfig.id, "btnJobWin")'><span class='ui-icon ui-icon-print'></span>DriverLog</a>
      <a name='confirmButton' class='simpleButton disabled' onclick='return openWin("<?php print $boss->app->Assets; ?>/templates/Confirmation.php?ID="+simpleConfig.id, "btnConfWin")'><span class='ui-icon ui-icon-print'></span>Confirmation</a>
      <a name='subLog' class='simpleButton disabled' onclick='openWin("<?php print $boss->app->Assets; ?>/templates/DriverLogExternal.php?ID="+simpleConfig.id, "btnLogWin")'><span class='ui-icon ui-icon-print'></span>SubLog</a>
   </span>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Job: </span><input type='text' name='Job[<?php print $current->JobID; ?>][Job]' id='Job' value='<?php print $current->Job; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Job Date: </span><input type='text' name='Job[<?php print $current->JobID; ?>][JobDate]' id='JobDate' value='<?php print $current->JobDate; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><span class='fieldLabel'>Business: </span><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist();print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "Job[".$current->JobID."][BusinessID]");?></div>
         <div class='contentField'><span class='fieldLabel'>Business Location: </span><input type='text' name='Job[<?php print $current->JobID; ?>][BusinessLocation]' id='BusinessLocation' value='<?php print $current->BusinessLocation; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Contact: </span><input type='text' name='Job[<?php print $current->JobID; ?>][ContactName]' id='ContactName' value='<?php print $current->ContactName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Phone</span><input type='text' name='Job[<?php print $current->JobID; ?>][ContactPhone]' id='ContactPhone' value='<?php print $current->ContactPhone; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Email</span><input type='text' name='Job[<?php print $current->JobID; ?>][ContactEmail]' id='ContactEmail' value='<?php print $current->ContactEmail; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>PU Location: </span><input type='text' name='Job[<?php print $current->JobID; ?>][PickupLocation]' id='PickupLocation' value='<?php print $current->PickupLocation; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Drop Location: </span><input type='text' name='Job[<?php print $current->JobID; ?>][DropOffLocation]' id='DropOffLocation' value='<?php print $current->DropOffLocation; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Final Drop: </span><input type='text' name='Job[<?php print $current->JobID; ?>][FinalDropOffLocation]' id='FinalDropOffLocation' value='<?php print $current->FinalDropOffLocation; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>PU Time: </span><input type='text' name='Job[<?php print $current->JobID; ?>][PickupTime]' id='PickupTime' value='<?php print $current->PickupTime; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Drop Off Time: </span><input type='text' name='Job[<?php print $current->JobID; ?>][DropOffTime]' id='DropOffTime' value='<?php print $current->DropOffTime; ?>' size='25' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Num Pax: </span><input type='text' name='Job[<?php print $current->JobID; ?>][NumberOfItems]' id='NumberOfItems' value='<?php print $current->NumberOfItems; ?>' size='11' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Bus: </span><?php $boss->db->addResource("Bus");$arr = $boss->db->Bus->getlist();print $boss->utility->buildSelect($arr, $current->BusID, "BusID", "Bus", "Job[".$current->JobID."][BusID]");?></div>
         <div class='contentField'><span class='fieldLabel'>Description: </span><input type='text' name='Job[<?php print $current->JobID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Special Instructions: </span><input type='text' name='Job[<?php print $current->JobID; ?>][SpecialInstructions]' id='SpecialInstructions' value='<?php print $current->SpecialInstructions; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Hours: </span><input type='text' name='Job[<?php print $current->JobID; ?>][Hours]' id='Hours' value='<?php print $current->Hours; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Quote ID: </span><input type='text'  name='Job[<?php print $current->JobID; ?>][QuoteID]' id='QuoteID' value='<?php print $current->QuoteID; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Quote Amount: $</span><input type='text' name='Job[<?php print $current->JobID; ?>][QuoteAmount]' id='QuoteAmount' value='<?php print $current->QuoteAmount; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>SPAB: </label><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][SPAB]' id='SPAB'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Confirmed: </label><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][Confirmed]' id='Confirmed'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Trip Completed: </label><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][JobCompleted]' id='JobCompleted'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Job Cancelled: </label><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][JobCancelled]' id='JobCancelled'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><span class='fieldLabel'>Employee: </span><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist("Active=1");print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "Job[$current->JobID][EmployeeID]");?></div>
      </span>
      <div class='contentField'><span class='fieldLabel'>Private Notes: </span><textarea name='Job[<?php print $current->JobID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
   </div>
</div>
