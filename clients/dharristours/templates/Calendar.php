<div class='tableGroup'>
   <div class='formHeading'>Calendar ID: <?php print $current->CalendarID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Calendar</label><input type='text' dbtype='varchar(1000)' name='Calendar[<?php print $current->CalendarID; ?>][Calendar]' id='Calendar' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Subject</label><input type='text' dbtype='varchar(1000)' name='Calendar[<?php print $current->CalendarID; ?>][Subject]' id='Subject' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Location</label><input type='text' dbtype='varchar(200)' name='Calendar[<?php print $current->CalendarID; ?>][Location]' id='Location' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Owner</label><input type='text' dbtype='varchar(150)' name='Calendar[<?php print $current->CalendarID; ?>][Owner]' id='Owner' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Invitees</label><textarea dbtype='text' name='Calendar[<?php print $current->CalendarID; ?>][Invitees]' id='Invitees' class='textBox'></textarea></div>
         <div class='contentField'><label>Description</label><textarea dbtype='text' name='Calendar[<?php print $current->CalendarID; ?>][Description]' id='Description' class='textBox'></textarea></div>
         <div class='contentField'><label>Start Time</label><input type='text' dbtype='datetime' name='Calendar[<?php print $current->CalendarID; ?>][StartTime]' id='StartTime' value='' size='25' class='boxValue date' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>End Time</label><input type='text' dbtype='datetime' name='Calendar[<?php print $current->CalendarID; ?>][EndTime]' id='EndTime' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>All Day Event</label><select dbtype='tinyint(1)' name='Calendar[<?php print $current->CalendarID; ?>][AllDayEvent]' id='AllDayEvent'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Color</label><input type='text' dbtype='varchar(200)' name='Calendar[<?php print $current->CalendarID; ?>][Color]' id='Color' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Recurring Rule</label><input type='text' dbtype='varchar(500)' name='Calendar[<?php print $current->CalendarID; ?>][RecurringRule]' id='RecurringRule' value='' size='50' class='boxValue' /></div>

</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Calendar[<?php print $current->CalendarID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>