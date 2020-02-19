<div class='tableGroup'>
   <div class='formHeading'>Catalog ID: <?php print $current->CatalogID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Catalog</label><input type='text' dbtype='varchar(100)' name='Catalog[<?php print $current->CatalogID; ?>][Catalog]' id='Catalog' value='<?php print $current->Catalog; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Catalog[<?php print $current->CatalogID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Product Name</label><input type='text' dbtype='varchar(100)' name='Catalog[<?php print $current->CatalogID; ?>][ProductName]' id='ProductName' value='<?php print $current->ProductName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Where</label><input type='text' dbtype='varchar(100)' name='Catalog[<?php print $current->CatalogID; ?>][Where]' id='Where' value='<?php print $current->Where; ?>' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Catalog[<?php print $current->CatalogID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>