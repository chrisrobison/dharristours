<div class='tableGroup'>
   <div class='boxHeading'> Overtime ID: <?php print $current->OvertimeID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Overtime Title</span><input type='text' name='Overtime[<?php print $current->OvertimeID; ?>][Overtime]' id='Overtime' value='<?php print $current->Overtime; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Date of Overtime</span>
	    <input type='text' id='month' value='<?php print date('n', strtotime($current->Date)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeDate('month', 'date', 'year', '<?php print $current->OvertimeAuthorizationID; ?>', 'OvertimeAuthorization',  'Date')" /> /
	    <input type='text' id='date' value='<?php print date('j', strtotime($current->Date)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeDate('month', 'date', 'year', '<?php print $current->OvertimeAuthorizationID; ?>', 'OvertimeAuthorization', 'Date')" /> /
	    <input type='text' id='year' value='<?php print date('Y', strtotime($current->Date)); ?>' size='4' maxlength='4' class='boxValue' style='width:4em; min-width:4em;' onchange="makeDate('month', 'date', 'year', '<?php print $current->OvertimeAuthorizationID; ?>', 'OvertimeAuthorization', 'Date')" /> 
	</div> 
	<input type='hidden' id='Date' />
         <div class='contentField'><span class='fieldLabel'>Number of Hours</span><input type='text' name='Overtime[<?php print $current->OvertimeID; ?>][NumberHours]' size='5' style='width: 4em; max-width: 4em;' id='NumberHours' value='<?php print $current->NumberHours; ?>' size='42' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Employee EAuth</span>
	 <span id='EmployeeEAuthdisp'><?php print $current->EmployeeEAuth ? $current->EmployeeEAuth : 'not authorized' ?></span><input type='hidden' name='OvertimeAuthorization[<?php print $current->OvertimeAuthorizationID; ?>][EmployeeEAuth]' id='EmployeeEAuth' />
	 <?php 
	    if ($_SESSION['UserID'] == $current->EmployeeID) {
               ?>
	          <input type='button' value='authorize' onclick="authorize('EmployeeEAuth')" />
	       <?php
            }
	 ?>
	 </div>
         <div class='contentField'><span class='fieldLabel'>Supervisor EAuth</span>
	 <span id='SupervisorEAuthdisp'><?php print $current->SupervisorEAuth ? $current->SupervisorEAuth : 'not authorized' ?></span><input type='hidden' name='OvertimeAuthorization[<?php print $current->OvertimeAuthorizationID; ?>][SupervisorEAuth]' id='SupervisorEAuth' />
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
         <div class='contentField'><span class='fieldLabel'>Reason</span><textarea name='Overtime[<?php print $current->OvertimeID; ?>][Reason]' id='Reason' class='textBox' style='width:41em;height:5em;'><?php print $current->Reason; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Note To Supervisor</span><textarea name='Overtime[<?php print $current->OvertimeID; ?>][NoteToSupervisor]' id='NoteToSupervisor' class='textBox' style='width:41em;height:5em;'><?php print $current->NoteToSupervisor; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='Overtime[<?php print $current->OvertimeID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
   </div>
</div>
