<div class='tableGroup'>
   <button style='float:right' onclick='window.open("<?php print $boss->app->Assets; ?>/templates/InvoiceReport.php?ID="+simpleConfig.id, "btnJobWin", "height=800,width=600,resizable=yes,scrollbars=yes,status=yes,toolbar=yes,menubar=yes,location=no,personalbar=no");return false;'>Print Invoice</button>
   <div class='formHeading'> Invoice ID: <?php print $current->InvoiceID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>For: </span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][Invoice]' id='Invoice' value='<?php print $current->Invoice; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Invoice Sent: </label><select dbtype='tinyint(4)' name='Invoice[<?php print $current->InvoiceID; ?>][InvoiceSent]' id='InvoiceSent'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><span class='fieldLabel'>Job ID</span><input type='text' dbtype='int(15)' name='Invoice[<?php print $current->InvoiceID; ?>][JobID]' id='JobID' value='' size='15' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Description</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Invoice Date</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][InvoiceDate]' id='InvoiceDate' value='<?php print $current->InvoiceDate; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Invoice Amt</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][InvoiceAmt]' id='InvoiceAmt' value='<?php print $current->InvoiceAmt; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Gas</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][Gas]' id='Gas' value='<?php print $current->Gas; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Misc</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][MiscCost]' id='MiscCost' value='<?php print $current->MiscCost; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Billable Hours</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][BillableHours]' id='BillableHours' value='<?php print $current->BillableHours; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Paid Amt</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][PaidAmt]' id='PaidAmt' value='<?php print $current->PaidAmt; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Balance</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][Balance]' id='Balance' value='<?php print $current->Balance; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Check Num</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][CheckNum]' id='CheckNum' value='<?php print $current->CheckNum; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Check Date</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][CheckDate]' id='CheckDate' value='<?php print $current->CheckDate; ?>' size='50' class='boxValue' /></div>
          <div class='contentField'><label>Business</label><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist();print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "Job[".$current->InvoiceID."][BusinessID]");?></div>
      </span>
   </div>
      <div class='contentField'><span class='fieldLabel'>Private Notes</span><textarea name='Invoice[<?php print $current->InvoiceID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height=5em;'><?php print $current->Notes; ?></textarea></div>
</div>
