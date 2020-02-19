<div class='tableGroup'>
   <div class='formHeading'>PurchaseOrder ID: <?php print $current->PurchaseOrderID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Purchase Order</label><input type='text' dbtype='varchar(100)' name='PurchaseOrder[<?php print $current->PurchaseOrderID; ?>][PurchaseOrder]' id='PurchaseOrder' value='<?php print $current->PurchaseOrder; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>PONumber</label><input type='text' dbtype='varchar(100)' name='PurchaseOrder[<?php print $current->PurchaseOrderID; ?>][PONumber]' id='PONumber' value='<?php print $current->PONumber; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Purchase Status</label><input type='text' dbtype='varchar(100)' name='PurchaseOrder[<?php print $current->PurchaseOrderID; ?>][PurchaseStatus]' id='PurchaseStatus' value='<?php print $current->PurchaseStatus; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Amount</label><input type='text' dbtype='decimal(10,2)' name='PurchaseOrder[<?php print $current->PurchaseOrderID; ?>][Amount]' id='Amount' value='<?php print $current->Amount; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Quote</label><input type='text' dbtype='decimal(10,2)' name='PurchaseOrder[<?php print $current->PurchaseOrderID; ?>][Quote]' id='Quote' value='<?php print $current->Quote; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>PODate</label><input type='text' dbtype='datetime' name='PurchaseOrder[<?php print $current->PurchaseOrderID; ?>][PODate]' id='PODate' value='<?php print $current->PODate; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>PAR</label><?php $boss->db->addResource("PAR");$arr = $boss->db->PAR->getlist();print $boss->utility->buildSelect($arr, $current->PARID, "PARID", "PAR", "PurchaseOrder[$current->PurchaseOrderID][PARID]")."</div>";?>
         <div class='contentField'><label>Vendor </label><?php $boss->db->addResource("Vendor");$arr = $boss->db->Vendor->getlist();print $boss->utility->buildSelect($arr, $current->VendorID, "VendorID", "Vendor", "PurchaseOrder[$current->PurchaseOrderID][VendorID]")."</div>";?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='PurchaseOrder[<?php print $current->PurchaseOrderID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>