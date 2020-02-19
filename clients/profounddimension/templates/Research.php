<div class='tableGroup'>
   <div class='formHeading'>Research ID: <?php print $current->ResearchID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Research</label><input type='text' dbtype='varchar(100)' name='Research[<?php print $current->ResearchID; ?>][Research]' id='Research' value='<?php print $current->Research; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Research[<?php print $current->ResearchID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Source</label><input type='text' dbtype='varchar(100)' name='Research[<?php print $current->ResearchID; ?>][Source]' id='Source' value='<?php print $current->Source; ?>' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Research[<?php print $current->ResearchID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>