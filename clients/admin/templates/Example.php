<div class='tableGroup'>
   <h1 class='boxHeading'> Example ID: <?php print $current->ExampleID; ?></h1>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Example</label><input type='text' dbtype='varchar(100)' name='Example[<?php print $current->ExampleID; ?>][Example]' id='Example' value='<?php print $current->Example; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Testing</label><input type='text' dbtype='varchar(100)' name='Example[<?php print $current->ExampleID; ?>][Testing]' id='Testing' value='<?php print $current->Testing; ?>' size='50' class='boxValue' /></div>
</div>
         <div class='contentField'><label>Notes</label><textarea dbtype='text' name='Example[<?php print $current->ExampleID; ?>][Notes]' id='Notes' class='textBox'></textarea></div></div>
</div>