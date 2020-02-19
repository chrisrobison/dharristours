<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> Application ID: <?php print $current->ApplicationID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Application</label><input type='text' dbtype='varchar(100)' name='Application[<?php print $current->ApplicationID; ?>][Application]' id='Application' value='' size='50' class='boxValue' /></div>

      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(100)' name='Application[<?php print $current->ApplicationID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Application[<?php print $current->ApplicationID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>