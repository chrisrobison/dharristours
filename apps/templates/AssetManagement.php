<div class='tableGroup'>
   <div class='boxHeading'> Asset ID: <?php print $current->AssetID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Asset</span><input type='text' name='Asset[<?php print $current->AssetID; ?>][Asset]' id='Asset' value='<?php print $current->Asset; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>URI</span><input type='text' name='Asset[<?php print $current->AssetID; ?>][URI]' id='URI' value='<?php print $current->URI; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='Asset[<?php print $current->AssetID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
   </div>
</div>