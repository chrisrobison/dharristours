<div class='tableGroup'>
   <div class='boxHeading'> ShamsAlbums ID: <?php print $current->ShamsAlbumsID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Shams Albums</span><input type='text' name='ShamsAlbums[<?php print $current->ShamsAlbumsID; ?>][ShamsAlbums]' id='ShamsAlbums' value='<?php print $current->ShamsAlbums; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='ShamsAlbums[<?php print $current->ShamsAlbumsID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Shams Tracks ID</span><?php $boss->db->addResource("ShamsTracks");$arr = $boss->db->ShamsTracks->getlist();print $boss->utility->buildSelect($arr, $current->ShamsTracksID, "ShamsTracksID", "ShamsTracks", "ShamsAlbums[$current->ShamsAlbumsID][ShamsTracksID]");?></div>
      </span>
   </div>
</div>