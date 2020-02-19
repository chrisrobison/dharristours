<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> TestTable ID: <?php print $current->TestTableID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Test Table</label><input type='text' dbtype='varchar(100)' name='TestTable[<?php print $current->TestTableID; ?>][TestTable]' id='TestTable' value='' size='50' class='boxValue' /></div>

      </div>
      <div class='fieldcolumn'>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='TestTable[<?php print $current->TestTableID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>