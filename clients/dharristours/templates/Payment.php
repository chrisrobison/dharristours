<div class='tableGroup'>
   <div class='formHeading'>Payment ID: <?php print $current->PaymentID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Payment</label><input type='text' dbtype='varchar(100)' name='Payment[<?php print $current->PaymentID; ?>][Payment]' id='Payment' value='<?php print $current->Payment; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Payment[<?php print $current->PaymentID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Business </label><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist();print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "Payment[$current->PaymentID][BusinessID]")."</div>";?>
         <div class='contentField'><label>Invoice Parent </label><?php $boss->db->addResource("InvoiceParent");$arr = $boss->db->InvoiceParent->getlist();print $boss->utility->buildSelect($arr, $current->InvoiceParentID, "InvoiceParentID", "InvoiceParent", "Payment[$current->PaymentID][InvoiceParentID]")."</div>";?>
         <div class='contentField'><label>Invoice </label><?php $boss->db->addResource("Invoice");$arr = $boss->db->Invoice->getlist();print $boss->utility->buildSelect($arr, $current->InvoiceID, "InvoiceID", "Invoice", "Payment[$current->PaymentID][InvoiceID]")."</div>";?>
         <div class='contentField'><label>Amount</label><input type='text' dbtype='decimal(10,2)' name='Payment[<?php print $current->PaymentID; ?>][Amount]' id='Amount' value='<?php print $current->Amount; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Received On</label><input type='text' dbtype='datetime' name='Payment[<?php print $current->PaymentID; ?>][ReceivedOn]' id='ReceivedOn' value='<?php print $current->ReceivedOn; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Received By</label><input type='text' dbtype='varchar(100)' name='Payment[<?php print $current->PaymentID; ?>][ReceivedBy]' id='ReceivedBy' value='<?php print $current->ReceivedBy; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Check Num</label><input type='text' dbtype='varchar(100)' name='Payment[<?php print $current->PaymentID; ?>][CheckNum]' id='CheckNum' value='<?php print $current->CheckNum; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Purchase Order</label><input type='text' dbtype='varchar(100)' name='Payment[<?php print $current->PaymentID; ?>][PurchaseOrder]' id='PurchaseOrder' value='<?php print $current->PurchaseOrder; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>PO</label><input type='text' dbtype='varchar(100)' name='Payment[<?php print $current->PaymentID; ?>][PO]' id='PO' value='<?php print $current->PO; ?>' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Payment[<?php print $current->PaymentID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>