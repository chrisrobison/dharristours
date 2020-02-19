<div class='tableGroup'>
   <div class='boxHeading'> ArtShows ID: <?php print $current->ArtShowsID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Art Shows</span><input type='text' name='ArtShows[<?php print $current->ArtShowsID; ?>][ArtShows]' id='ArtShows' value='<?php print $current->ArtShows; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='ArtShows[<?php print $current->ArtShowsID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Location</span><input type='text' name='ArtShows[<?php print $current->ArtShowsID; ?>][Location]' id='Location' value='<?php print $current->Location; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Artwork ID</span><?php $boss->db->addResource("Artwork");$arr = $boss->db->Artwork->getlist();print $boss->utility->buildSelect($arr, $current->ArtworkID, "ArtworkID", "Artwork", "ArtShows[$current->ArtShowsID][ArtworkID]");?></div>
      </span>
   </div>
</div>