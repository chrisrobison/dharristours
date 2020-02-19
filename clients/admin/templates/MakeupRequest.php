<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> HR_MakeupTime ID: <?php print $current->HR_MakeupTimeID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Makeup Time ID</label><?php $boss->db->addResource("MakeupTime");$arr = $boss->db->MakeupTime->getlist();print $boss->utility->buildSelect($arr, $current->MakeupTimeID, "MakeupTimeID", "MakeupTime", "HR_MakeupTime[$current->HR_MakeupTimeID][MakeupTimeID]")."</div>";?>
         <div class='contentField'><label>Makeup Time</label><input type='text' dbtype='varchar(100)' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][MakeupTime]' id='MakeupTime' value='' size='50' class='boxValue' /></div>

         <div class='contentField'><label>Date Off</label><input type='text' dbtype='date' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][DateOff]' id='DateOff' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Start Time Off</label><input type='text' dbtype='time' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][StartTimeOff]' id='StartTimeOff' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>End Time Off</label><input type='text' dbtype='time' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][EndTimeOff]' id='EndTimeOff' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Break Length Off</label><input type='text' dbtype='decimal(4,2)' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][BreakLengthOff]' id='BreakLengthOff' value='' size='42' class='boxValue' /></div>
         <div class='contentField'><label>Reason</label><textarea dbtype='text' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][Reason]' id='Reason' class='textBox'></textarea></div>
         <div class='contentField'><label>Makeup Date</label><input type='text' dbtype='date' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][MakeupDate]' id='MakeupDate' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Makeup Start Time</label><input type='text' dbtype='time' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][MakeupStartTime]' id='MakeupStartTime' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Makeup End Time</label><input type='text' dbtype='time' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][MakeupEndTime]' id='MakeupEndTime' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Makeup Break</label><input type='text' dbtype='decimal(4,2)' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][MakeupBreak]' id='MakeupBreak' value='' size='42' class='boxValue' /></div>
         <div class='contentField'><label>Makeup Date2</label><input type='text' dbtype='date' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][MakeupDate2]' id='MakeupDate2' value='' size='25' class='boxValue date' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Makeup Start Time2</label><input type='text' dbtype='time' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][MakeupStartTime2]' id='MakeupStartTime2' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Makeup End Time2</label><input type='text' dbtype='time' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][MakeupEndTime2]' id='MakeupEndTime2' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Makeup Break2</label><input type='text' dbtype='decimal(4,2)' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][MakeupBreak2]' id='MakeupBreak2' value='' size='42' class='boxValue' /></div>
         <div class='contentField'><label>Makeup Date3</label><input type='text' dbtype='date' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][MakeupDate3]' id='MakeupDate3' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Makeup Start Time3</label><input type='text' dbtype='time' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][MakeupStartTime3]' id='MakeupStartTime3' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Makeup End Time3</label><input type='text' dbtype='time' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][MakeupEndTime3]' id='MakeupEndTime3' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Makeup Break3</label><input type='text' dbtype='time' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][MakeupBreak3]' id='MakeupBreak3' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Employee EAuth</label><input type='text' dbtype='datetime' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][EmployeeEAuth]' id='EmployeeEAuth' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Supervisor EAuth</label><input type='text' dbtype='datetime' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][SupervisorEAuth]' id='SupervisorEAuth' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Note To Supervisor</label><textarea dbtype='text' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][NoteToSupervisor]' id='NoteToSupervisor' class='textBox'></textarea></div>
         <div class='contentField'><label>Supervisor ID</label><?php $boss->db->addResource("Supervisor");$arr = $boss->db->Supervisor->getlist();print $boss->utility->buildSelect($arr, $current->SupervisorID, "SupervisorID", "Supervisor", "HR_MakeupTime[$current->HR_MakeupTimeID][SupervisorID]")."</div>";?>
         <div class='contentField'><label>Employee ID</label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "HR_MakeupTime[$current->HR_MakeupTimeID][EmployeeID]")."</div>";?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>