<div class='tableGroup'>
   <div class='formHeading'>ProductAttributes ID: <?php print $current->ProductAttributesID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Product Attributes</label><input type='text' dbtype='varchar(100)' name='ProductAttributes[<?php print $current->ProductAttributesID; ?>][ProductAttributes]' id='ProductAttributes' value='<?php print $current->ProductAttributes; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='ProductAttributes[<?php print $current->ProductAttributesID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Type</label><input type='text' dbtype='varchar(100)' name='ProductAttributes[<?php print $current->ProductAttributesID; ?>][Type]' id='Type' value='<?php print $current->Type; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Value</label><input type='text' dbtype='varchar(100)' name='ProductAttributes[<?php print $current->ProductAttributesID; ?>][Value]' id='Value' value='<?php print $current->Value; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Products </label><?php $boss->db->addResource("Products");$arr = $boss->db->Products->getlist();print $boss->utility->buildSelect($arr, $current->ProductsID, "ProductsID", "Products", "ProductAttributes[$current->ProductAttributesID][ProductsID]")."</div>";?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='ProductAttributes[<?php print $current->ProductAttributesID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>