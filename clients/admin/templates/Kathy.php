<div class='tableGroup'>
   <div class='formHeading'>Kathy ID: <?php print $current->KathyID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Kathy</label><input type='text' dbtype='varchar(100)' name='Kathy[<?php print $current->KathyID; ?>][Kathy]' id='Kathy' value='<?php print $current->Kathy; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Kathy[<?php print $current->KathyID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
      </div>
      <div class='fieldcolumn'>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Kathy[<?php print $current->KathyID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>