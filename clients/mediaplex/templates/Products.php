<div class='tableGroup'>
   <div class='formHeading'>Products ID: <?php print $current->ProductsID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Products</label><input type='text' dbtype='varchar(100)' name='Products[<?php print $current->ProductsID; ?>][Products]' id='Products' value='<?php print $current->Products; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Products[<?php print $current->ProductsID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Product List </label><?php $boss->db->addResource("ProductList");$arr = $boss->db->ProductList->getlist();print $boss->utility->buildSelect($arr, $current->ProductListID, "ProductListID", "ProductList", "Products[$current->ProductsID][ProductListID]")."</div>";?>
         <div class='contentField'><label>SKU</label><input type='text' dbtype='varchar(100)' name='Products[<?php print $current->ProductsID; ?>][SKU]' id='SKU' value='<?php print $current->SKU; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Active</label><select dbtype='tinyint(1)' name='Products[<?php print $current->ProductsID; ?>][Active]' id='Active'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->Active; ?></select></div>
         <div class='contentField'><label>New</label><select dbtype='tinyint(1)' name='Products[<?php print $current->ProductsID; ?>][New]' id='New'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->New; ?></select></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Products[<?php print $current->ProductsID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>