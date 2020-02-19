<div class='tableGroup'>
   <div class='formHeading'>Timecard ID: <?php print $current->TimecardID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Timecard</label><input type='text' dbtype='varchar(100)' name='Timecard[<?php print $current->TimecardID; ?>][Timecard]' id='Timecard' value='<?php print $current->Timecard; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Date</label><input type='text' dbtype='date' name='Timecard[<?php print $current->TimecardID; ?>][Date]' id='Date' value='<?php print $current->Date; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Regular</label><input type='text' dbtype='decimal(3,2)' name='Timecard[<?php print $current->TimecardID; ?>][Regular]' id='Regular' value='<?php print $current->Regular; ?>' size='32' class='boxValue' /></div>
         <div class='contentField'><label>Overtime</label><input type='text' dbtype='decimal(3,2)' name='Timecard[<?php print $current->TimecardID; ?>][Overtime]' id='Overtime' value='<?php print $current->Overtime; ?>' size='32' class='boxValue' /></div>
         <div class='contentField'><label>Doubletime</label><input type='text' dbtype='decimal(3,2)' name='Timecard[<?php print $current->TimecardID; ?>][Doubletime]' id='Doubletime' value='<?php print $current->Doubletime; ?>' size='32' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Total</label><input type='text' dbtype='decimal(5,2)' name='Timecard[<?php print $current->TimecardID; ?>][Total]' id='Total' value='<?php print $current->Total; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Employee </label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "Timecard[$current->TimecardID][EmployeeID]")."</div>";?>
<?php print $current->Notes; ?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Timecard[<?php print $current->TimecardID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>