<div class='tableGroup'>
   <h1 class='boxHeading'> QA_Test ID: <?php print $current->QA_TestID; ?></h1>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>QA_Test</label><input type='text' dbtype='varchar(100)' name='QA_Test[<?php print $current->QA_TestID; ?>][QA_Test]' id='QA_Test' value='<?php print $current->QA_Test; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Section</label><input type='text' dbtype='varchar(100)' name='QA_Test[<?php print $current->QA_TestID; ?>][Section]' id='Section' value='<?php print $current->Section; ?>' size='50' class='boxValue' /></div>
</div>
         <div class='contentField'><label>Notes</label><textarea dbtype='text' name='QA_Test[<?php print $current->QA_TestID; ?>][Notes]' id='Notes' class='textBox'></textarea></div>
</div>