<div class='tableGroup'>
   <div class='boxHeading'> Creative ID: <?php print $current->CreativeID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Creative</span><input type='text' name='Creative[<?php print $current->CreativeID; ?>][Creative]' id='Creative' value='<?php print $current->Creative; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Title</span><input type='text' name='Creative[<?php print $current->CreativeID; ?>][Title]' id='Title' value='<?php print $current->Title; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Mojo ID</span><input type='text' name='Creative[<?php print $current->CreativeID; ?>][MojoID]' id='MojoID' value='<?php print $current->MojoID; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Type</span><input type='text' name='Creative[<?php print $current->CreativeID; ?>][Type]' id='Type' value='<?php print $current->Type; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Height</span><input type='text' name='Creative[<?php print $current->CreativeID; ?>][Height]' id='Height' value='<?php print $current->Height; ?>' size='5' style="width:50px;" class='boxValue' /> <span class='fieldLabel'>Width</span><input type='text' name='Creative[<?php print $current->CreativeID; ?>][Width]' id='Width' value='<?php print $current->Width; ?>' size='5' class='boxValue' style="width:50px;" /></div>
      </span>
      <div class='contentField'><span class='fieldLabel'>Containers</span><textarea name='Creative[<?php print $current->CreativeID; ?>][Containers]' id='Containers' class='textBox' style='width:41em;height:5em;'><?php print $current->Containers; ?></textarea></div>
      <div class='contentField'><span class='fieldLabel'>Background</span><textarea name='Creative[<?php print $current->CreativeID; ?>][Background]' id='Background' class='textBox' style='width:41em;height:5em;'><?php print $current->Background; ?></textarea></div>
      <div class='contentField'><span class='fieldLabel'>Overlay</span><textarea name='Creative[<?php print $current->CreativeID; ?>][Overlay]' id='Overlay' class='textBox' style='width:41em;height:5em;'><?php print $current->Overlay; ?></textarea></div>
      <div class='contentField'><span class='fieldLabel'>Defaults</span><textarea name='Creative[<?php print $current->CreativeID; ?>][Defaults]' id='Defaults' class='textBox' style='width:41em;height:5em;'><?php print $current->Defaults; ?></textarea></div>
      <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='Creative[<?php print $current->CreativeID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
   </div>
</div>
