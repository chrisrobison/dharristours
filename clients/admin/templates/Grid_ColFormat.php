<div class='tableGroup'>
   <div class='formHeading'>Grid_ColFormat ID: <?php print $current->Grid_ColFormatID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Col Format </label><?php $boss->db->addResource("ColFormat");$arr = $boss->db->ColFormat->getlist();print $boss->utility->buildSelect($arr, $current->ColFormatID, "ColFormatID", "ColFormat", "Grid_ColFormat[$current->Grid_ColFormatID][ColFormatID]")."</div>";?>
         <div class='contentField'><label>Type</label><input type='text' dbtype='varchar(9)' name='Grid_ColFormat[<?php print $current->Grid_ColFormatID; ?>][Type]' id='Type' value='' size='9' class='boxValue' /></div>
         <div class='contentField'><label>Options</label><input type='text' dbtype='varchar(101)' name='Grid_ColFormat[<?php print $current->Grid_ColFormatID; ?>][Options]' id='Options' value='' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Description</label><textarea dbtype='text' name='Grid_ColFormat[<?php print $current->Grid_ColFormatID; ?>][Description]' id='Description' class='textBox'></textarea></div>
</div>
</div>
</div>