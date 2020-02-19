<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> HR_Overtime ID: <?php print $current->HR_OvertimeID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Overtime ID</label><?php $boss->db->addResource("Overtime");$arr = $boss->db->Overtime->getlist();print $boss->utility->buildSelect($arr, $current->OvertimeID, "OvertimeID", "Overtime", "HR_Overtime[$current->HR_OvertimeID][OvertimeID]")."</div>";?>
         <div class='contentField'><label>Overtime</label><input type='text' dbtype='varchar(100)' name='HR_Overtime[<?php print $current->HR_OvertimeID; ?>][Overtime]' id='Overtime' value='' size='50' class='boxValue' /></div>

         <div class='contentField'><label>Date</label><input type='text' dbtype='date' name='HR_Overtime[<?php print $current->HR_OvertimeID; ?>][Date]' id='Date' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Number Hours</label><input type='text' dbtype='decimal(4,2)' name='HR_Overtime[<?php print $current->HR_OvertimeID; ?>][NumberHours]' id='NumberHours' value='' size='42' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Reason</label><textarea dbtype='text' name='HR_Overtime[<?php print $current->HR_OvertimeID; ?>][Reason]' id='Reason' class='textBox'></textarea></div>
         <div class='contentField'><label>Employee EAuth</label><input type='text' dbtype='datetime' name='HR_Overtime[<?php print $current->HR_OvertimeID; ?>][EmployeeEAuth]' id='EmployeeEAuth' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Supervisor EAuth</label><input type='text' dbtype='datetime' name='HR_Overtime[<?php print $current->HR_OvertimeID; ?>][SupervisorEAuth]' id='SupervisorEAuth' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Note To Supervisor</label><textarea dbtype='text' name='HR_Overtime[<?php print $current->HR_OvertimeID; ?>][NoteToSupervisor]' id='NoteToSupervisor' class='textBox'></textarea></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='HR_Overtime[<?php print $current->HR_OvertimeID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>