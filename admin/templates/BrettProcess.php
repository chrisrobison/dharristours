<div class='tableGroup'>
   <div class='boxHeading'> Brett ID: <?php print $current->BrettID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Brett</span><input type='text' name='Brett[<?php print $current->BrettID; ?>][Brett]' id='Brett' value='<?php print $current->Brett; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='Brett[<?php print $current->BrettID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Phone</span><input type='text' name='Brett[<?php print $current->BrettID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Address</span><input type='text' name='Brett[<?php print $current->BrettID; ?>][Address]' id='Address' value='<?php print $current->Address; ?>' size='50' class='boxValue' /></div>
      </span>
   </div>
</div>