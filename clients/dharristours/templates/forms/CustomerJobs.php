<div class='tableGroup'>
   <div class='formHeading'> Job ID: <?php print $current->JobID; ?></div>
   <span id="customButtons">
      <a name='confirmButton' class='simpleButton disabled' onclick='return openWin("<?php print $boss->app->Assets; ?>/templates/Confirmation.php?ID="+simpleConfig.id, "btnConfWin")'><span class='ui-icon ui-icon-print'></span> Print Confirmation</a>
   </span>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
	 <div class='contentField'><span class='fieldLabel'>Confirmed: </span><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][Confirmed]' id='Confirmed'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><span class='fieldLabel'>Job: </span><span name='Job[][Job]' id='Job'></span></div>
	 <div class='contentField'><span class='fieldLabel'>Job Date: </span><span name='Job[][JobDate]' id='JobDate'></span></div>
         <div class='contentField'><span class='fieldLabel'>P/U Time: </span><span name='Job[][PickupTime]' id='PickupTime'></span></div>
         <div class='contentField'><span class='fieldLabel'>D/O Time: </span><span name='Job[][DropOffTime]' id='DropOffTime'></span></div>
         <div class='contentField'><span class='fieldLabel'>Num Pax: </span><span name='Job[][NumberOfItems]' id='NumberOfItems'></span></div>
         <div class='contentField'><span class='fieldLabel'>P/U Location: </span><span name='Job[][PickupLocation]' id='PickupLocation'></span></div>
         <div class='contentField'><span class='fieldLabel'>D/O Location: </span><span name='Job[][DropOffLocation]' id='DropOffLocation'></span></div>
         <div class='contentField'><span class='fieldLabel'>Final D/O: </span><span name='Job[][FinalDropOffLocation]' id='FinalDropOffLocation'></span></div>
      </div>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Hours: </span><span name='Job[][Hours]' id='Hours'></span></div>
         <div class='contentField'><span class='fieldLabel'>Quote Amount: $</span><span name='Job[][QuoteAmount]' id='QuoteAmount'></span></div>
	 <div class='contentField'><span class='fieldLabel'>Business Location: </span><span name='Job[][BusinessLocation]' id='BusinessLocation'></span></div>
         <div class='contentField'><span class='fieldLabel'>Contact: </span><input type='text' name='Job[<?php print $current->JobID; ?>][ContactName]' id='ContactName' value='<?php print $current->ContactName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Phone: </span><input type='text' name='Job[<?php print $current->JobID; ?>][ContactPhone]' id='ContactPhone' value='<?php print $current->ContactPhone; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Description: </span><input type='text' name='Job[<?php print $current->JobID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Special Instructions: </span><input type='text' name='Job[<?php print $current->JobID; ?>][SpecialInstructions]' id='SpecialInstructions' value='<?php print $current->SpecialInstructions; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Completed: </span><span name='Job[][JobCompleted]' id='JobCompleted'></span></div>
         <div class='contentField'><span class='fieldLabel'>Trip Cancelled: </span><span name='Job[][JobCancelled]' id='JobCancelled'></span></div>
      </div>
   </div>
</div>
