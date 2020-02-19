<div class='tableGroup'>
   <div class='boxHeading'> Statics ID: <?php print $current->StaticsID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Statics</span><input type='text' name='Statics[<?php print $current->StaticsID; ?>][Statics]' id='Statics' value='<?php print $current->Statics; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='Statics[<?php print $current->StaticsID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Percentage</span><input type='text' name='Statics[<?php print $current->StaticsID; ?>][Percentage]' id='Percentage' value='<?php print $current->Percentage; ?>' size='25' class='boxValue' /></div>
      </span>
   </div>
</div>