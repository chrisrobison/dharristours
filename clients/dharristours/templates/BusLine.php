<div class='tableGroup'>
   <div class='formHeading'>BusLine ID: <?php print $current->BusLineID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Bus Line</label><input type='text' dbtype='varchar(100)' name='BusLine[<?php print $current->BusLineID; ?>][BusLine]' id='BusLine' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='BusLine[<?php print $current->BusLineID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>

      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Stop1</label><input type='text' dbtype='varchar(100)' name='BusLine[<?php print $current->BusLineID; ?>][Stop1]' id='Stop1' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Stop2</label><input type='text' dbtype='varchar(100)' name='BusLine[<?php print $current->BusLineID; ?>][Stop2]' id='Stop2' value='' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='BusLine[<?php print $current->BusLineID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>