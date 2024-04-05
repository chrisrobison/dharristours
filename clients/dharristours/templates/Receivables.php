<div class='tableGroup'>
   <div class='formHeading'>Receivable ID: <?php print $current->ReceivableID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Receivable</label><input type='text' dbtype='varchar(100)' name='Receivable[<?php print $current->ReceivableID; ?>][Receivable]' id='Receivable' value='<?php print $current->Receivable; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Receivable[<?php print $current->ReceivableID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Amount</label><input type='text' dbtype='decimal(10,2)' name='Receivable[<?php print $current->ReceivableID; ?>][Amount]' id='Amount' value='<?php print $current->Amount; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Due Date</label><input type='text' dbtype='date' name='Receivable[<?php print $current->ReceivableID; ?>][DueDate]' id='DueDate' value='<?php print $current->DueDate; ?>' size='25' class='boxValue date' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Invoice </label><?php $boss->db->addResource("Invoice");$arr = $boss->db->Invoice->getlist();print $boss->utility->buildSelect($arr, $current->InvoiceID, "InvoiceID", "Invoice", "Receivable[$current->ReceivableID][InvoiceID]")."</div>";?>
         <div class='contentField'><label>Invoice Parent </label><?php $boss->db->addResource("InvoiceParent");$arr = $boss->db->InvoiceParent->getlist();print $boss->utility->buildSelect($arr, $current->InvoiceParentID, "InvoiceParentID", "InvoiceParent", "Receivable[$current->ReceivableID][InvoiceParentID]")."</div>";?>
         <div class='contentField'><label>Business </label><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist();print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "Receivable[$current->ReceivableID][BusinessID]")."</div>";?>
         <div class='contentField'><label>Payment </label><?php $boss->db->addResource("Payment");$arr = $boss->db->Payment->getlist();print $boss->utility->buildSelect($arr, $current->PaymentID, "PaymentID", "Payment", "Receivable[$current->ReceivableID][PaymentID]")."</div>";?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Receivable[<?php print $current->ReceivableID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>