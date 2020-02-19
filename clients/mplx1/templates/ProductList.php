<div class='tableGroup'>
   <div class='formHeading'>ProductList ID: <?php print $current->ProductListID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Product List</label><input type='text' dbtype='varchar(100)' name='ProductList[<?php print $current->ProductListID; ?>][ProductList]' id='ProductList' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='ProductList[<?php print $current->ProductListID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>

      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Document</label><textarea dbtype='text' name='ProductList[<?php print $current->ProductListID; ?>][Document]' id='Document' class='textBox'></textarea></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='ProductList[<?php print $current->ProductListID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>