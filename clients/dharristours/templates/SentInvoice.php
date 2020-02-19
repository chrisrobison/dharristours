<div class='tableGroup'>
   <div class='formHeading'>SentInvoice ID: <?php print $current->SentInvoiceID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Business</label><input type='text' dbtype='char(50)' name='SentInvoice[<?php print $current->SentInvoiceID; ?>][Business]' id='Business' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='char(50)' name='SentInvoice[<?php print $current->SentInvoiceID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Business Location</label><input type='text' dbtype='char(50)' name='SentInvoice[<?php print $current->SentInvoiceID; ?>][BusinessLocation]' id='BusinessLocation' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Job </label><?php $boss->db->addResource("Job");$arr = $boss->db->Job->getlist();print $boss->utility->buildSelect($arr, $current->JobID, "JobID", "Job", "SentInvoice[$current->SentInvoiceID][JobID]")."</div>";?>
         <div class='contentField'><label>Job Date</label><input type='text' dbtype='char(50)' name='SentInvoice[<?php print $current->SentInvoiceID; ?>][JobDate]' id='JobDate' value='' size='50' class='boxValue date' /></div>
         <div class='contentField'><label>Quote Amount</label><input type='text' dbtype='char(50)' name='SentInvoice[<?php print $current->SentInvoiceID; ?>][QuoteAmount]' id='QuoteAmount' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Paid Date</label><input type='text' dbtype='char(50)' name='SentInvoice[<?php print $current->SentInvoiceID; ?>][PaidDate]' id='PaidDate' value='' size='50' class='boxValue date' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Paid Amt</label><input type='text' dbtype='char(50)' name='SentInvoice[<?php print $current->SentInvoiceID; ?>][PaidAmt]' id='PaidAmt' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Check Num</label><input type='text' dbtype='char(50)' name='SentInvoice[<?php print $current->SentInvoiceID; ?>][CheckNum]' id='CheckNum' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>TIPS</label><input type='text' dbtype='char(50)' name='SentInvoice[<?php print $current->SentInvoiceID; ?>][TIPS]' id='TIPS' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>OUTSOURCED</label><input type='text' dbtype='char(50)' name='SentInvoice[<?php print $current->SentInvoiceID; ?>][OUTSOURCED]' id='OUTSOURCED' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>NOTES</label><input type='text' dbtype='char(50)' name='SentInvoice[<?php print $current->SentInvoiceID; ?>][NOTES]' id='NOTES' value='' size='50' class='boxValue' /></div>
</div>
</div>
</div>