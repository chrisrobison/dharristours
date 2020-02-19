<div class='tableGroup'>
   <h1 class='boxHeading'> Test ID: <?php print $current->TestID; ?></h1>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Test</label><input type='text' dbtype='varchar(100)' name='Test[<?php print $current->TestID; ?>][Test]' id='Test' value='<?php print $current->Test; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Notes</label><textarea dbtype='text' name='Test[<?php print $current->TestID; ?>][Notes]' id='Notes' class='textBox'><?php print $current->Notes; ?></textarea></div>
      </div>
      <div class='fieldcolumn'>
      </div>
   </div>
</div>