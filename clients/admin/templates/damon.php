<div class='tableGroup'>
   <h1 class='boxHeading'> damon ID: <?php print $current->damonID; ?></h1>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>damon</label><input type='text' dbtype='varchar(100)' name='damon[<?php print $current->damonID; ?>][damon]' id='damon' value='<?php print $current->damon; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?></div>
         <div class='contentField'><label>Phone</label><input type='text' dbtype='varchar(100)' name='damon[<?php print $current->damonID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Cost</label><input type='text' dbtype='decimal(10,2)' name='damon[<?php print $current->damonID; ?>][Cost]' id='Cost' value='<?php print $current->Cost; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Example</label><select dbtype='tinyint(1)' name='damon[<?php print $current->damonID; ?>][Example]' id='Example'><option value='0'>False</option><option value='1'>True</option><?php print $current->Example; ?></select></div>
</div>
         <div class='contentField'><label>Notes</label><textarea dbtype='text' name='damon[<?php print $current->damonID; ?>][Notes]' id='Notes' class='textBox'></textarea></div>
</div>