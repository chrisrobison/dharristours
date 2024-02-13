<div class='tableGroup'>
   <div class='formHeading'>Rate ID: <?php print $current->RateID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Rate</label><input type='text' dbtype='varchar(100)' name='Rate[<?php print $current->RateID; ?>][Rate]' id='Rate' value='<?php print $current->Rate; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Rate[<?php print $current->RateID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Default</label><select dbtype='tinyint(1)' name='Rate[<?php print $current->RateID; ?>][Default]' id='Default'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->Default; ?></select></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='mediumtext' name='Rate[<?php print $current->RateID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>