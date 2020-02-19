<div class='tableGroup'>
   <div class='formHeading'>Jenny ID: <?php print $current->JennyID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Jenny</label><input type='text' dbtype='varchar(100)' name='Jenny[<?php print $current->JennyID; ?>][Jenny]' id='Jenny' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Jenny[<?php print $current->JennyID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>

      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(100)' name='Jenny[<?php print $current->JennyID; ?>][Email]' id='Email' value='' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Jenny[<?php print $current->JennyID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>