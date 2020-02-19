<div class='tableGroup'>
   <div class='boxHeading'> Artwork ID: <?php print $current->ArtworkID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Artwork</span><input type='text' name='Artwork[<?php print $current->ArtworkID; ?>][Artwork]' id='Artwork' value='<?php print $current->Artwork; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='Artwork[<?php print $current->ArtworkID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Subject</span><input type='text' name='Artwork[<?php print $current->ArtworkID; ?>][Subject]' id='Subject' value='<?php print $current->Subject; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Medium</span><input type='text' name='Artwork[<?php print $current->ArtworkID; ?>][Medium]' id='Medium' value='<?php print $current->Medium; ?>' size='50' class='boxValue' /></div>
      </span>
   </div>
</div>