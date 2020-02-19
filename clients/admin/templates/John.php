<div class='tableGroup'>
   <h1 class='boxHeading'> John ID: <?php print $current->JohnID; ?></h1>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>John</label><input type='text' dbtype='varchar(100)' name='John[<?php print $current->JohnID; ?>][John]' id='John' value='<?php print $current->John; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Notes</label><textarea dbtype='text' name='John[<?php print $current->JohnID; ?>][Notes]' id='Notes' class='textBox'><?php print $current->Notes; ?></textarea></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Phone</label><input type='text' dbtype='varchar(50)' name='John[<?php print $current->JohnID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='50' class='boxValue' /></div>
      </div>
   </div>
</div>