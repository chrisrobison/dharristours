<div class='tableGroup'>
   <div class='formHeading'>InvoiceParent ID: <?php print $current->InvoiceParentID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Invoice Parent</label><input type='text' dbtype='varchar(100)' name='InvoiceParent[<?php print $current->InvoiceParentID; ?>][InvoiceParent]' id='InvoiceParent' value='<?php print $current->InvoiceParent; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='InvoiceParent[<?php print $current->InvoiceParentID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Invoice IDs</label><?php $boss->db->addResource("Invoice");$arr = $boss->db->Invoice->getlist();print $boss->utility->buildSelect($arr, $current->InvoiceID, "InvoiceID", "Invoice", "InvoiceParent[$current->InvoiceParentID][InvoiceIDs]")."</div>";?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='InvoiceParent[<?php print $current->InvoiceParentID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>