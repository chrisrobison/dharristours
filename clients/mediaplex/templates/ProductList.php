<div class='tableGroup'>
   <div class='formHeading'>ProductList ID: <?php print $current->ProductListID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Product List</label><input type='text' dbtype='varchar(100)' name='ProductList[<?php print $current->ProductListID; ?>][ProductList]' id='ProductList' value='<?php print $current->ProductList; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='ProductList[<?php print $current->ProductListID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>URL</label><input type='text' dbtype='varchar(100)' name='ProductList[<?php print $current->ProductListID; ?>][URL]' id='URL' value='<?php print $current->URL; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Filename</label><input type='text' dbtype='varchar(100)' name='ProductList[<?php print $current->ProductListID; ?>][Filename]' id='Filename' value='<?php print $current->Filename; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>DBType</label><input type='text' dbtype='varchar(100)' name='ProductList[<?php print $current->ProductListID; ?>][DBType]' id='DBType' value='<?php print $current->DBType; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Type</label><input type='text' dbtype='varchar(100)' name='ProductList[<?php print $current->ProductListID; ?>][Type]' id='Type' value='<?php print $current->Type; ?>' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='ProductList[<?php print $current->ProductListID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>