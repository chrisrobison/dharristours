<div class='tableGroup'>
   <div class='boxHeading'> Tracks ID: <?php print $current->TracksID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Tracks</span><input type='text' name='Tracks[<?php print $current->TracksID; ?>][Tracks]' id='Tracks' value='<?php print $current->Tracks; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='Tracks[<?php print $current->TracksID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Artist</span><input type='text' name='Tracks[<?php print $current->TracksID; ?>][Artist]' id='Artist' value='<?php print $current->Artist; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Genre</span><input type='text' name='Tracks[<?php print $current->TracksID; ?>][Genre]' id='Genre' value='<?php print $current->Genre; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Bpm</span><input type='text' name='Tracks[<?php print $current->TracksID; ?>][Bpm]' id='Bpm' value='<?php print $current->Bpm; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Year</span><input type='text' name='Tracks[<?php print $current->TracksID; ?>][Year]' id='Year' value='<?php print $current->Year; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Comments</span><input type='text' name='Tracks[<?php print $current->TracksID; ?>][Comments]' id='Comments' value='<?php print $current->Comments; ?>' size='50' class='boxValue' /></div>
      </span>
   </div>
</div>