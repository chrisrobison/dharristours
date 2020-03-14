<div class='tableGroup'>
   <div class='boxHeading'> IAI ID: <?php print $current->IAIID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>IAI</span><input type='text' name='IAI[<?php print $current->IAIID; ?>][IAI]' id='IAI' value='<?php print $current->IAI; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='IAI[<?php print $current->IAIID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Name</span><input type='text' name='IAI[<?php print $current->IAIID; ?>][Name]' id='Name' value='<?php print $current->Name; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Phone</span><input type='text' name='IAI[<?php print $current->IAIID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='50' class='boxValue' /></div>
      </span>
   </div>
</div>