<script type="text/javascript">
function doPrint() {
   window.open("/clients/dharris/templates/InvoiceReport.php?ID=<?php print $current->InvoiceID; ?>", "InvWin", "height=800,width=600,resizable=yes,scrollbars=yes,status=yes,toolbar=yes,menubar=yes,location=no,personalbar=yes");  
}
</script>
<div class='tableGroup'>
   <div class='boxHeading'> Invoice ID: <?php print $current->InvoiceID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>For: </span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][Invoice]' id='Invoice' value='<?php print $current->Invoice; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Job ID</span><?php $boss->db->addResource("Job");$arr = $boss->db->Job->getlist();print $boss->utility->buildSelect($arr, $current->JobID, "JobID", "Job", "Invoice[$current->InvoiceID][JobID]");?></div>
         <div class='contentField'><span class='fieldLabel'>Description</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Invoice Date</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][InvoiceDate]' id='InvoiceDate' value='<?php print $current->InvoiceDate; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Invoice Amt</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][InvoiceAmt]' id='InvoiceAmt' value='<?php print $current->InvoiceAmt; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Tax</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][Tax]' id='Tax' value='<?php print $current->Tax; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Start Time</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][StartTime]' id='StartTime' value='<?php print $current->StartTime; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>End Time</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][EndTime]' id='EndTime' value='<?php print $current->EndTime; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Billable Hours</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][BillableHours]' id='BillableHours' value='<?php print $current->BillableHours; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Paid Amt</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][PaidAmt]' id='PaidAmt' value='<?php print $current->PaidAmt; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Balance</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][Balance]' id='Balance' value='<?php print $current->Balance; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Check Num</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][CheckNum]' id='CheckNum' value='<?php print $current->CheckNum; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Check Date</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][CheckDate]' id='CheckDate' value='<?php print $current->CheckDate; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Private Notes</span><textarea name='Invoice[<?php print $current->InvoiceID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height=5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
   </div>
</div>
