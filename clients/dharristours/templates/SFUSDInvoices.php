<div class='tableGroup'>
   <div class='boxHeading'> Invoice ID: <?php print $current->InvoiceID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Invoice</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][Invoice]' id='Invoice' value='<?php print $current->Invoice; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Job ID</span><?php $boss->db->addResource("Job");$arr = $boss->db->Job->getlist();print $boss->utility->buildSelect($arr, $current->JobID, "JobID", "Job", "Invoice[$current->InvoiceID][JobID]");?></div>
         <div class='contentField'><span class='fieldLabel'>Description</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Invoice Date</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][InvoiceDate]' id='InvoiceDate' value='<?php print $current->InvoiceDate; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Invoice Amt</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][InvoiceAmt]' id='InvoiceAmt' value='<?php print $current->InvoiceAmt; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Tax</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][Tax]' id='Tax' value='<?php print $current->Tax; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Actual Date</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][ActualDate]' id='ActualDate' value='<?php print $current->ActualDate; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Arrival Time</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][ArrivalTime]' id='ArrivalTime' value='<?php print $current->ArrivalTime; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Start Time</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][StartTime]' id='StartTime' value='<?php print $current->StartTime; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>End Time</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][EndTime]' id='EndTime' value='<?php print $current->EndTime; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Start Miles</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][StartMiles]' id='StartMiles' value='<?php print $current->StartMiles; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>End Miles</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][EndMiles]' id='EndMiles' value='<?php print $current->EndMiles; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Billable Hours</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][BillableHours]' id='BillableHours' value='<?php print $current->BillableHours; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Paid Amt</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][PaidAmt]' id='PaidAmt' value='<?php print $current->PaidAmt; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Balance</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][Balance]' id='Balance' value='<?php print $current->Balance; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Check Num</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][CheckNum]' id='CheckNum' value='<?php print $current->CheckNum; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Check Date</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][CheckDate]' id='CheckDate' value='<?php print $current->CheckDate; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Note</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][Note]' id='Note' value='<?php print $current->Note; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Last Updated</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][LastUpdated]' id='LastUpdated' value='<?php print $current->LastUpdated; ?>' size='25' class='boxValue' /></div>
      </span>
   </div>
</div>