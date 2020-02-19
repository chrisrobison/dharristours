<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> PAR ID: <?php print $current->PARID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>PAR</label><input type='text' dbtype='varchar(100)' name='PAR[<?php print $current->PARID; ?>][PAR]' id='PAR' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='PAR[<?php print $current->PARID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>

      </div>
      <div class='fieldcolumn'>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='PAR[<?php print $current->PARID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>