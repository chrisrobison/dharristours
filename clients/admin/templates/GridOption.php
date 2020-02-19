<div class='tableGroup'>
   <div class='formHeading'>GridOption ID: <?php print $current->GridOptionID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Grid Option</label><input type='text' dbtype='varchar(50)' name='GridOption[<?php print $current->GridOptionID; ?>][GridOption]' id='GridOption' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Type</label><input type='text' dbtype='varchar(28)' name='GridOption[<?php print $current->GridOptionID; ?>][Type]' id='Type' value='' size='28' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><textarea dbtype='text' name='GridOption[<?php print $current->GridOptionID; ?>][Description]' id='Description' class='textBox'></textarea></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Default Val</label><input type='text' dbtype='varchar(54)' name='GridOption[<?php print $current->GridOptionID; ?>][DefaultVal]' id='DefaultVal' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Changable</label><input type='text' dbtype='varchar(21)' name='GridOption[<?php print $current->GridOptionID; ?>][Changable]' id='Changable' value='' size='21' class='boxValue' /></div>
</div>
</div>
</div>