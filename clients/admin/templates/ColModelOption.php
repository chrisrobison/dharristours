<div class='tableGroup'>
   <div class='formHeading'>ColModelOption ID: <?php print $current->ColModelOptionID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Col Model Option</label><input type='text' dbtype='varchar(50)' name='ColModelOption[<?php print $current->ColModelOptionID; ?>][ColModelOption]' id='ColModelOption' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Type</label><input type='text' dbtype='varchar(9)' name='ColModelOption[<?php print $current->ColModelOptionID; ?>][Type]' id='Type' value='' size='9' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><textarea dbtype='text' name='ColModelOption[<?php print $current->ColModelOptionID; ?>][Description]' id='Description' class='textBox'></textarea></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Default Val</label><input type='text' dbtype='varchar(91)' name='ColModelOption[<?php print $current->ColModelOptionID; ?>][DefaultVal]' id='DefaultVal' value='' size='50' class='boxValue' /></div>
</div>
</div>
</div>