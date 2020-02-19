<div class='tableGroup'>
   <h1 class='boxHeading'> Calendar ID: <?php print $current->CalendarID; ?></h1>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Calendar</label><input type='text' dbtype='varchar(100)' name='Calendar[<?php print $current->CalendarID; ?>][Calendar]' id='Calendar' value='<?php print $current->Calendar; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Notes</label><textarea dbtype='text' name='Calendar[<?php print $current->CalendarID; ?>][Notes]' id='Notes' class='textBox'><?php print $current->Notes; ?></textarea></div>
         <div class='contentField'><label>Start Date Time</label><input type='text' dbtype='datetime' name='Calendar[<?php print $current->CalendarID; ?>][StartDateTime]' id='StartDateTime' value='<?php print $current->StartDateTime; ?>' size='25' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Duration</label><input type='text' dbtype='int(10)' name='Calendar[<?php print $current->CalendarID; ?>][Duration]' id='Duration' value='<?php print $current->Duration; ?>' size='10' class='boxValue' /></div>
         <div class='contentField'><label>Login ID</label><?php $boss->db->addResource("Login");$arr = $boss->db->Login->getlist();print $boss->utility->buildSelect($arr, $current->LoginID, "LoginID", "Login", "Calendar[$current->CalendarID][LoginID]");?></div>
      </div>
   </div>
</div>