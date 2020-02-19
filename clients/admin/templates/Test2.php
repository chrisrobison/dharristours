<div class='tableGroup'>
   <h1 class='boxHeading'> Test2 ID: <?php print $current->Test2ID; ?></h1>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Test2</label><input type='text' dbtype='varchar(100)' name='Test2[<?php print $current->Test2ID; ?>][Test2]' id='Test2' value='<?php print $current->Test2; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Notes</label><textarea dbtype='text' name='Test2[<?php print $current->Test2ID; ?>][Notes]' id='Notes' class='textBox'><?php print $current->Notes; ?></textarea></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Comment</label><textarea dbtype='text' name='Test2[<?php print $current->Test2ID; ?>][Comment]' id='Comment' class='textBox'><?php print $current->Comment; ?></textarea></div>
      </div>
   </div>
</div>