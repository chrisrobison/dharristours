<div class='tableGroup'>
   <h1 class='boxHeading'> Maria ID: <?php print $current->MariaID; ?></h1>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Maria</label><input type='text' dbtype='varchar(100)' name='Maria[<?php print $current->MariaID; ?>][Maria]' id='Maria' value='<?php print $current->Maria; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Notes</label><textarea dbtype='text' name='Maria[<?php print $current->MariaID; ?>][Notes]' id='Notes' class='textBox'><?php print $current->Notes; ?></textarea></div>
         <div class='contentField'><label>Phone</label><input type='text' dbtype='varchar(50)' name='Maria[<?php print $current->MariaID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Todo</label><textarea dbtype='text' name='Maria[<?php print $current->MariaID; ?>][Todo]' id='Todo' class='textBox'><?php print $current->Todo; ?></textarea></div>
      </div>
   </div>
</div>