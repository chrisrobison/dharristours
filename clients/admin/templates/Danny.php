<div class='tableGroup'>
   <div class='formHeading'>Danny ID: <?php print $current->DannyID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Danny</label><input type='text' dbtype='varchar(100)' name='Danny[<?php print $current->DannyID; ?>][Danny]' id='Danny' value='<?php print $current->Danny; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Danny[<?php print $current->DannyID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Weed</label><input type='text' dbtype='varchar(100)' name='Danny[<?php print $current->DannyID; ?>][Weed]' id='Weed' value='<?php print $current->Weed; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Employee </label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "Danny[$current->DannyID][EmployeeID]")."</div>";?>
         <div class='contentField'><label>In Trouble</label><select dbtype='tinyint(1)' name='Danny[<?php print $current->DannyID; ?>][InTrouble]' id='InTrouble'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->InTrouble; ?></select></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Danny[<?php print $current->DannyID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>