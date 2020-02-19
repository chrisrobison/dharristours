<div class='tableGroup'>
   <div class='boxHeading'> Calendar ID: <?php print $current->CalendarID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Calendar</span><input type='text' name='Calendar[<?php print $current->CalendarID; ?>][Calendar]' id='Calendar' value='<?php print $current->Calendar; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='Calendar[<?php print $current->CalendarID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Start Date Time</span><input type='text' name='Calendar[<?php print $current->CalendarID; ?>][StartDateTime]' id='StartDateTime' value='<?php print $current->StartDateTime; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Duration</span><input type='text' name='Calendar[<?php print $current->CalendarID; ?>][Duration]' id='Duration' value='<?php print $current->Duration; ?>' size='11' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Login ID</span><input type='text' name='Calendar[<?php print $current->CalendarID; ?>][LoginID]' id='LoginID' value='<?php print $current->LoginID; ?>' size='11' class='boxValue' /></div>
      </span>
   </div>
</div>