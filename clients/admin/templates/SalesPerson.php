<div class='tableGroup'>
   <div class='formHeading'>SalesPerson ID: <?php print $current->SalesPersonID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Sales Person</label><input type='text' dbtype='varchar(100)' name='SalesPerson[<?php print $current->SalesPersonID; ?>][SalesPerson]' id='SalesPerson' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='SalesPerson[<?php print $current->SalesPersonID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>

      </div>
      <div class='fieldcolumn'>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='SalesPerson[<?php print $current->SalesPersonID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>