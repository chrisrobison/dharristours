<div class='tableGroup'>
   <div class='formHeading'>GLCode ID: <?php print $current->GLCodeID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>GLCode</label><input type='text' dbtype='varchar(100)' name='GLCode[<?php print $current->GLCodeID; ?>][GLCode]' id='GLCode' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='GLCode[<?php print $current->GLCodeID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>

      </div>
      <div class='fieldcolumn'>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='GLCode[<?php print $current->GLCodeID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>