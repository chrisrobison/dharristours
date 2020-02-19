<div class='tableGroup'>
   <div class='formHeading'>Option ID: <?php print $current->OptionID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Option</label><input type='text' dbtype='varchar(50)' name='Option[<?php print $current->OptionID; ?>][Option]' id='Option' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Type</label><input type='text' dbtype='varchar(28)' name='Option[<?php print $current->OptionID; ?>][Type]' id='Type' value='' size='28' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><textarea dbtype='text' name='Option[<?php print $current->OptionID; ?>][Description]' id='Description' class='textBox'></textarea></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Default Val</label><input type='text' dbtype='varchar(54)' name='Option[<?php print $current->OptionID; ?>][DefaultVal]' id='DefaultVal' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Changable</label><input type='text' dbtype='varchar(21)' name='Option[<?php print $current->OptionID; ?>][Changable]' id='Changable' value='' size='21' class='boxValue' /></div>
</div>
</div>
</div>