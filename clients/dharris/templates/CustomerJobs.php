
<script type="text/javascript">
function doPrint() {
   window.open("/clients/dharris/templates/Confirmation.php?ID=<?php print $current->JobID; ?>", "ConfWin", "height=800,width=600,resizable=yes,scrollbars=yes,status=yes,toolbar=yes,menubar=yes,location=no,personalbar=no");
}
</script>
<div class='tableGroup'>
   <div class='boxHeading'> Job ID: <?php print $current->JobID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Job</span><input type='text' disabled='true' name='Job[<?php print $current->JobID; ?>][Job]' id='Job' value='<?php print $current->Job; ?>' size='50' class='boxValue' /></div>

<div class='contentField'><span class='fieldLabel'>Job Date</span><input type='text' disabled='true' name='Job[<?php print $current->JobID; ?>][JobDate]' id='JobDate' value='<?php print $current->JobDate; ?>' size='25' class='boxValue' /></div>

<div class='contentField'><span class='fieldLabel'>Business</span><input type='text' disabled='true' name='Job[<?php print $current->JobID; ?>][BusinessID]' id='BusinessID' value='<?php print $current->BusinessID; ?>' size='50' class='boxValue' /></div>

<div class='contentField'><span class='fieldLabel'>Business Location</span><input type='text' disabled='true' name='Job[<?php print $current->JobID; ?>][BusinessLocation]' id='BusinessLocation' value='<?php print $current->BusinessLocation; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Contact Name</span><input type='text' name='Job[<?php print $current->JobID; ?>][ContactName]' id='ContactName' value='<?php print $current->ContactName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Contact Phone</span><input type='text' name='Job[<?php print $current->JobID; ?>][ContactPhone]' id='ContactPhone' value='<?php print $current->ContactPhone; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Pickup Location</span><input type='text' name='Job[<?php print $current->JobID; ?>][PickupLocation]' id='PickupLocation' value='<?php print $current->PickupLocation; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Drop Off Location</span><input type='text' name='Job[<?php print $current->JobID; ?>][DropOffLocation]' id='DropOffLocation' value='<?php print $current->DropOffLocation; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Final Drop Off Location</span><input type='text' name='Job[<?php print $current->JobID; ?>][FinalDropOffLocation]' id='FinalDropOffLocation' value='<?php print $current->FinalDropOffLocation; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Pickup Time</span><input type='text' disabled='true' name='Job[<?php print $current->JobID; ?>][PickupTime]' id='PickupTime' value='<?php print $current->PickupTime; ?>' size='25' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Drop Off Time</span><input type='text' disabled='true' name='Job[<?php print $current->JobID; ?>][DropOffTime]' id='DropOffTime' value='<?php print $current->DropOffTime; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Number Of Items</span><input type='text' disabled='true' name='Job[<?php print $current->JobID; ?>][NumberOfItems]' id='NumberOfItems' value='<?php print $current->NumberOfItems; ?>' size='11' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Description</span><input type='text' name='Job[<?php print $current->JobID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Special Instructions</span><input type='text' name='Job[<?php print $current->JobID; ?>][SpecialInstructions]' id='SpecialInstructions' value='<?php print $current->SpecialInstructions; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Hours</span><input type='text' disabled='true' name='Job[<?php print $current->JobID; ?>][Hours]' id='Hours' value='<?php print $current->Hours; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Quote</span><input type='text' disabled='true' name='Job[<?php print $current->JobID; ?>][Quote]' id='Quote' value='<?php print $current->Quote; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Confirm(1=y,0=n)</span><input type='text' name='Job[<?php print $current->JobID; ?>][Confirmed]' id='Confirmed' value='<?php print $current->Confirmed; ?>' size='1' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Job Completed</span><input type='text' disabled='true' name='Job[<?php print $current->JobID; ?>][JobCompleted]' id='JobCompleted' value='<?php print $current->JobCompleted; ?>' size='1' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Job Cancelled</span><input type='text' disabled='true' name='Job[<?php print $current->JobID; ?>][JobCancelled]' id='JobCancelled' value='<?php print $current->JobCancelled; ?>' size='1' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Last Modified</span><input type='text' disabled='true' name='Job[<?php print $current->JobID; ?>][LastModified]' id='LastModified' value='<?php print $current->LastModified; ?>' size='25' class='boxValue' /></div>
      </span>
   </div>
</div>
