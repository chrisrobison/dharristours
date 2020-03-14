<div class='tableGroup'>
   <div class='boxHeading'> HR_Overtime ID: <?php print $current->HR_OvertimeID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Subject</span><input type='text' name='HR_Overtime[<?php print $current->HR_OvertimeID; ?>][HR_Overtime]' id='HR_Overtime' value='<?php print $current->HR_Overtime; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Date of HR_Overtime</span> <input type='text' id='Date' name='HR_Overtime[][Date]' class='date' /> </div> 
	<input type='hidden' id='Date' />
         <div class='contentField'><span class='fieldLabel'>Number of Hours</span><input type='text' name='HR_Overtime[<?php print $current->HR_OvertimeID; ?>][NumberHours]' size='5' style='width: 4em; max-width: 4em;' id='NumberHours' value='<?php print $current->NumberHours; ?>' size='42' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Employee EAuth</span>
	 <span id='EmployeeEAuthdisp'><?php print $current->EmployeeEAuth ? $current->EmployeeEAuth : 'not authorized' ?></span><input type='hidden' name='HR_OvertimeAuthorization[<?php print $current->HR_OvertimeAuthorizationID; ?>][EmployeeEAuth]' id='EmployeeEAuth' />
	 <?php 
	    if ($_SESSION['UserID'] == $current->EmployeeID) {
               ?>
	          <input type='button' value='authorize' onclick="authorize('EmployeeEAuth')" />
	       <?php
            }
	 ?>
	 </div>
         <div class='contentField'><span class='fieldLabel'>Supervisor EAuth</span>
	 <span id='SupervisorEAuthdisp'><?php print $current->SupervisorEAuth ? $current->SupervisorEAuth : 'not authorized' ?></span><input type='hidden' name='HR_OvertimeAuthorization[<?php print $current->HR_OvertimeAuthorizationID; ?>][SupervisorEAuth]' id='SupervisorEAuth' />
	 <?php
	    if ($_SESSION['UserID'] == $current->SupervisorID) {
               ?>
	          <input type='button' value='authorize' onclick="authorize('SupervisorEAuth')" />
	       <?php
            }
	 ?>
	 </div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Reason</span><textarea name='HR_Overtime[<?php print $current->HR_OvertimeID; ?>][Reason]' id='Reason' class='textBox' style='width:41em;height:5em;'><?php print $current->Reason; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Note To Supervisor</span><textarea name='HR_Overtime[<?php print $current->HR_OvertimeID; ?>][HR_NoteToSupervisor]' id='HR_NoteToSupervisor' class='textBox' style='width:41em;height:5em;'><?php print $current->HR_NoteToSupervisor; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='HR_Overtime[<?php print $current->HR_OvertimeID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
   </div>
</div>
