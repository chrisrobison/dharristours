<div class='tableGroup'>
   <div class='formHeading'>Awesome ID: <?php print $current->AwesomeID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Awesome</label><input type='text' dbtype='varchar(100)' name='Awesome[<?php print $current->AwesomeID; ?>][Awesome]' id='Awesome' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Awesome[<?php print $current->AwesomeID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>

      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Level</label><input type='text' dbtype='int(15)' name='Awesome[<?php print $current->AwesomeID; ?>][Level]' id='Level' value='' size='15' class='boxValue' /></div>
         <div class='contentField'><label>is Awesome</label><select dbtype='tinyint(1)' name='Awesome[<?php print $current->AwesomeID; ?>][isAwesome]' id='isAwesome'><option value='0'>No</option><option value='1'>Yes</option></select></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Awesome[<?php print $current->AwesomeID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>