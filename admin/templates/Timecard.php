<div class='tableGroup'>
   <div class='boxHeading'> Timecard ID: <?php print $current->TimecardID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Timecard</span><input type='text' name='Timecard[<?php print $current->TimecardID; ?>][Timecard]' id='Timecard' value='<?php print $current->Timecard; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='Timecard[<?php print $current->TimecardID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Date</span><input type='text' name='Timecard[<?php print $current->TimecardID; ?>][Date]' id='Date' value='<?php print $current->Date; ?>' size='25' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Hours</span><input type='text' name='Timecard[<?php print $current->TimecardID; ?>][Hours]' id='Hours' value='<?php print $current->Hours; ?>' size='42' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Overtime</span><input type='text' name='Timecard[<?php print $current->TimecardID; ?>][Overtime]' id='Overtime' value='<?php print $current->Overtime; ?>' size='42' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Doubletime</span><input type='text' name='Timecard[<?php print $current->TimecardID; ?>][Doubletime]' id='Doubletime' value='<?php print $current->Doubletime; ?>' size='42' class='boxValue' /></div>
      </span>
   </div>
</div>