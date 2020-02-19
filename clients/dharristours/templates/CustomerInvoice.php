<script type="text/javascript">
function customPrint(id) {
   if (!id) {
      id = simpleConfig.id;
   }
   window.open("<?php print $boss->app->Assets; ?>/templates/InvoiceReport.php?ID="+id, "ConfWin", "height=800,width=600,resizable=yes,scrollbars=yes,status=yes,toolbar=yes,menubar=yes,location=no,personalbar=no");
}
</script>
<div class='tableGroup'>
   <div class='formHeading'> Invoice ID: <?php print $current->InvoiceID; ?></div>
   <button style='float:middle' onclick='window.open("<?php print $boss->app->Assets; ?>/templates/InvoiceReport.php?ID="+simpleConfig.id, "btnJobWin", "height=800,width=600,resizable=yes,scrollbars=yes,status=yes,toolbar=yes,menubar=yes,location=no,personalbar=no");return false;'>Print Invoice</button>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Invoice</span><input type='text' disabled='true' name='Invoice[<?php print $current->InvoiceID; ?>][Invoice]' id='Invoice' value='<?php print $current->Invoice; ?>' size='50' class='boxValue' /></div>
<div class='contentField'><span class='fieldLabel'>Job</span><input type='text'  disabled='true' name='Invoice[<?php print $current->JobID; ?>][JobID]' id='JobID' value='<?php print $current->JobID; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Invoice Date</span><input type='text' disabled='true' name='Invoice[<?php print $current->InvoiceID; ?>][InvoiceDate]' id='InvoiceDate' value='<?php print $current->InvoiceDate; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Invoice Amt</span><input type='text' disabled='true' name='Invoice[<?php print $current->InvoiceID; ?>][InvoiceAmt]' id='InvoiceAmt' value='<?php print $current->InvoiceAmt; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Misc Amt</span><input type='text' disabled='true' name='Invoice[<?php print $current->InvoiceID; ?>][Tax]' id='Tax' value='<?php print $current->Tax; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Actual Date</span><input type='text' disabled='true' name='Invoice[<?php print $current->InvoiceID; ?>][ActualDate]' id='ActualDate' value='<?php print $current->ActualDate; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Arrival Time</span><input type='text' disabled='true' name='Invoice[<?php print $current->InvoiceID; ?>][ArrivalTime]' id='ArrivalTime' value='<?php print $current->ArrivalTime; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Start Time</span><input type='text' disabled='true' name='Invoice[<?php print $current->InvoiceID; ?>][StartTime]' id='StartTime' value='<?php print $current->StartTime; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>End Time</span><input type='text' disabled='true' name='Invoice[<?php print $current->InvoiceID; ?>][EndTime]' id='EndTime' value='<?php print $current->EndTime; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Start Miles</span><input type='text' disabled='true' name='Invoice[<?php print $current->InvoiceID; ?>][StartMiles]' id='StartMiles' value='<?php print $current->StartMiles; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>End Miles</span><input type='text' disabled='true' name='Invoice[<?php print $current->InvoiceID; ?>][EndMiles]' id='EndMiles' value='<?php print $current->EndMiles; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Billable Hours</span><input type='text' disabled='true' name='Invoice[<?php print $current->InvoiceID; ?>][BillableHours]' id='BillableHours' value='<?php print $current->BillableHours; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Check Num</span><input type='text' disabled='true' name='Invoice[<?php print $current->InvoiceID; ?>][CheckNum]' id='CheckNum' value='<?php print $current->CheckNum; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Check Date</span><input type='text' disabled='true' name='Invoice[<?php print $current->InvoiceID; ?>][CheckDate]' id='CheckDate' value='<?php print $current->CheckDate; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Check Amt</span><input type='text' disabled='true' name='Invoice[<?php print $current->InvoiceID; ?>][PaidAmt]' id='PaidAmt' value='<?php print $current->PaidAmt; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Balance</span><input type='text' disabled='true' name='Invoice[<?php print $current->InvoiceID; ?>][Balance]' id='Balance' value='<?php print $current->Balance; ?>' size='50' class='boxValue' /></div>
      </span>
   </div>
</div>
