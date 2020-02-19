<div class='tableGroup'>
   <div class='formHeading'>Grid_ColModelOption ID: <?php print $current->Grid_ColModelOptionID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Col Model Option </label><?php $boss->db->addResource("ColModelOption");$arr = $boss->db->ColModelOption->getlist();print $boss->utility->buildSelect($arr, $current->ColModelOptionID, "ColModelOptionID", "ColModelOption", "Grid_ColModelOption[$current->Grid_ColModelOptionID][ColModelOptionID]")."</div>";?>
         <div class='contentField'><label>Property</label><input type='text' dbtype='varchar(15)' name='Grid_ColModelOption[<?php print $current->Grid_ColModelOptionID; ?>][Property]' id='Property' value='' size='15' class='boxValue' /></div>
         <div class='contentField'><label>Type</label><input type='text' dbtype='varchar(9)' name='Grid_ColModelOption[<?php print $current->Grid_ColModelOptionID; ?>][Type]' id='Type' value='' size='9' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Description</label><textarea dbtype='text' name='Grid_ColModelOption[<?php print $current->Grid_ColModelOptionID; ?>][Description]' id='Description' class='textBox'></textarea></div>
         <div class='contentField'><label>Default Val</label><input type='text' dbtype='varchar(91)' name='Grid_ColModelOption[<?php print $current->Grid_ColModelOptionID; ?>][DefaultVal]' id='DefaultVal' value='' size='50' class='boxValue' /></div>
</div>
</div>
</div>