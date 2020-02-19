<div class='tableGroup'>
   <h1 class='boxHeading'> Evan ID: <?php print $current->EvanID; ?></h1>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Evan</label><input type='text' dbtype='varchar(100)' name='Evan[<?php print $current->EvanID; ?>][Evan]' id='Evan' value='' size='50' class='boxValue' /></div>

         <div class='contentField'><label>Phone</label><input type='text' dbtype='varchar(100)' name='Evan[<?php print $current->EvanID; ?>][Phone]' id='Phone' value='' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(100)' name='Evan[<?php print $current->EvanID; ?>][Email]' id='Email' value='' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Evan[<?php print $current->EvanID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>