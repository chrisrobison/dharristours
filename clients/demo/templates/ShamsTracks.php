<div class='tableGroup'>
   <div class='boxHeading'> ShamsTracks ID: <?php print $current->ShamsTracksID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Shams Tracks</span><input type='text' name='ShamsTracks[<?php print $current->ShamsTracksID; ?>][ShamsTracks]' id='ShamsTracks' value='<?php print $current->ShamsTracks; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='ShamsTracks[<?php print $current->ShamsTracksID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Album</span><input type='text' name='ShamsTracks[<?php print $current->ShamsTracksID; ?>][Album]' id='Album' value='<?php print $current->Album; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Length</span><input type='text' name='ShamsTracks[<?php print $current->ShamsTracksID; ?>][Length]' id='Length' value='<?php print $current->Length; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Artist</span><input type='text' name='ShamsTracks[<?php print $current->ShamsTracksID; ?>][Artist]' id='Artist' value='<?php print $current->Artist; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Location</span><input type='text' name='ShamsTracks[<?php print $current->ShamsTracksID; ?>][Location]' id='Location' value='<?php print $current->Location; ?>' size='50' class='boxValue' /></div>
      </span>
   </div>
</div>