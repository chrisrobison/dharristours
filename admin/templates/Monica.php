<div class='tableGroup'>
   <div class='boxHeading'> Monica ID: <?php print $current->MonicaID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Monica</span><input type='text' name='Monica[<?php print $current->MonicaID; ?>][Monica]' id='Monica' value='<?php print $current->Monica; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='Monica[<?php print $current->MonicaID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Phone</span><input type='text' name='Monica[<?php print $current->MonicaID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='50' class='boxValue' /></div>
      </span>
   </div>
</div>