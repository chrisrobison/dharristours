<?php
   $boss = new boss();
   if ($in['ID']) $current = $boss->getObject('HR_MissedPunch', $in['ID']);
?>
<div class='tableGroup'>
   <div class='boxHeading'> HR_MissedPunch ID: <?php print $current->HR_MissedPunchID; ?></div>
   <span class='notice'>
      This notice is to correct and explain the reason for a current timesheet error.  By EAuthorizing
      this document, the signee affirms that the hours are being changed to reflect the actual and 
      legitimate time worked by the employee for whom the correction is requested.
   </span>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <input type='hidden' name='HR_MissedPunch[<?php print $current->HR_MissedPunchID; ?>][EmployeeID]' value='<?php print $current->EmployeeID; ?>' id='EmployeeID'/>
         <input type='hidden' name='HR_MissedPunch[<?php print $current->HR_MissedPunchID; ?>][SupervisorID]' value='<?php print $current->SupervisorID; ?>' id='SupervisorID'/>
         <div class='contentField'><span class='fieldLabel'>Missed Punch Title</span><input type='text' name='HR_MissedPunch[<?php print $current->HR_MissedPunchID; ?>][HR_MissedPunch]' id='HR_MissedPunch' value='<?php print $current->HR_MissedPunch; ?>' size='50' class='boxValue' /></div>
        <div class='contentField'><span class='fieldLabel'>Employee</span>
	    <select name='HR_MissedPunch[<?php print $current->HR_MissedPunchID; ?>][EmployeeID]' id='EmployeeID' class='boxValue' >
               <option value='' >-- Select Employee --</option>
	       <?php
		      print $util->listEmployees(((!$current->EmployeeID) ? $_SESSION['Employee']->EmployeeID : $current->EmployeeID));
	       ?>
	    </select>
	 </div>
         <div class='contentField'><span class='fieldLabel'>Supervisor</span>
	    <select name='HR_MissedPunch[<?php print $current->HR_MissedPunchID; ?>][SupervisorID]' id='SupervisorID' class='boxValue' >
               <option value='' >-- Select Supervisor --</option>
	       <?php
		      print $util->listEmployees(((!$current->SupervisorID) ? $_SESSION['Employee']->SupervisorID : $current->SupervisorID));
	       ?>
	    </select>
         </div>
      </span>
      <span class='fieldcolumn'>
 	 <div class='contentField'><span class='fieldLabel'>Date Missed Punch</span>
	    <input type='text' id='fmonth' value='<?php print date('n', strtotime($current->DateHR_MissedPunch)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeDate('fmonth', 'fdate', 'fyear', '<?php print $current->HR_MissedPunchID; ?>', 'HR_MissedPunch',  'DateHR_MissedPunch')" /> /
	    <input type='text' id='fdate' value='<?php print date('j', strtotime($current->DateHR_MissedPunch)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeDate('fmonth', 'fdate', 'fyear', '<?php print $current->HR_MissedPunchID; ?>', 'HR_MissedPunch', 'DateHR_MissedPunch')" /> /
	    <input type='text' id='fyear' value='<?php print date('Y', strtotime($current->DateHR_MissedPunch)); ?>' size='4' maxlength='4' class='boxValue' style='width:4em; min-width:4em;' onchange="makeDate('fmonth', 'fdate', 'fyear', '<?php print $current->HR_MissedPunchID; ?>', 'HR_MissedPunch', 'DateHR_MissedPunch')" /> 
	 </div>
	 <input type='hidden' id='DateHR_MissedPunch' />
 	 <div class='contentField'><span class='fieldLabel'>Incorrect Time</span>
	    <input type='text' id='ihour' value='<?php print date('g', strtotime($current->IncorrectTime)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('ihour', 'iminute', 'iampm', '<?php print $current->HR_MissedPunchID; ?>', 'HR_MissedPunch', 'IncorrectTime')" /> :
	    <input type='text' id='iminute' value='<?php print date('i', strtotime($current->IncorrectTime)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('ihour', 'iminute', 'iampm', '<?php print $current->HR_MissedPunchID; ?>', 'HR_MissedPunch', 'IncorrectTime')" /> 
	    <select id='iampm' class='boxValue' style='width:4em; min-width: 4em;' onchange="makeTime('ihour', 'iminute', 'iampm', '<?php print $current->HR_MissedPunchID; ?>', 'HR_MissedPunch', 'IncorrectTime')" >
               <option value='am' <?php print date('a', strtotime($current->IncorrectTime)) == 'am' ? 'selected' : '' ?> >am</option>
               <option value='pm' <?php print date('a', strtotime($current->IncorrectTime)) == 'pm' ? 'selected' : '' ?> >pm</option>
	    </select>
	 </div>
         <input type='hidden' id='IncorrectTime' />
  	 <div class='contentField'><span class='fieldLabel'>Correct Time</span>
	    <input type='text' id='chour' value='<?php print date('g', strtotime($current->CorrectTime)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('chour', 'cminute', 'campm', '<?php print $current->HR_MissedPunchID; ?>', 'HR_MissedPunch', 'CorrectTime')" /> :
	    <input type='text' id='cminute' value='<?php print date('i', strtotime($current->CorrectTime)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('chour', 'cminute', 'campm', '<?php print $current->HR_MissedPunchID; ?>', 'HR_MissedPunch', 'CorrectTime')" /> 
	    <select id='campm' class='boxValue' style='width:4em; min-width: 4em;' onchange="makeTime('chour', 'cminute', 'campm', '<?php print $current->HR_MissedPunchID; ?>', 'HR_MissedPunch', 'CorrectTime')" >
               <option value='am' <?php print date('a', strtotime($current->CorrectTime)) == 'am' ? 'selected' : '' ?> >am</option>
               <option value='pm' <?php print date('a', strtotime($current->CorrectTime)) == 'pm' ? 'selected' : '' ?> >pm</option>
	    </select>
	 </div>
         <input type='hidden' id='CorrectTime' />      
         <div class='contentField'><span class='fieldLabel'>Reason</span><textarea name='HR_MissedPunch[<?php print $current->HR_MissedPunchID; ?>][Reason]' id='Reason' class='textBox' style='width:41em;height:5em;'><?php print $current->Reason; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Employee EAuth</span>
	 <span id='EmployeeEAuthdisp'><?php print $current->EmployeeEAuth ? $current->EmployeeEAuth : 'Not Authorized' ?></span><input type='hidden' name='HR_MissedPunch[<?php print $current->HR_MissedPunchID; ?>][EmployeeEAuth]' id='EmployeeEAuth' />
	 <?php 
	    if (($_SESSION['Employee']->EmployeeID == $current->EmployeeID) || $_SESSION['Employee']->EmployeeID == 181 || $_SESSION['Employee']->EmployeeID == 1) {
               ?>
	          <input type='button' value='Authorize' onclick="authorize('EmployeeEAuth')" />
	       <?php
            }
	 ?>
	 </div>
         <div class='contentField'><span class='fieldLabel'>Supervisor EAuth</span>
	 <span id='SupervisorEAuthdisp'><?php print $current->SupervisorEAuth ? $current->SupervisorEAuth : 'Not Authorized' ?></span><input type='hidden' name='HR_MissedPunch[<?php print $current->HR_MissedPunchID; ?>][SupervisorEAuth]' id='SupervisorEAuth' />
	 <?php
	    if (($_SESSION['Employee']->EmployeeID == $current->SupervisorID) || $_SESSION['Employee']->EmployeeID == 181 || $_SESSION['Employee']->EmployeeID == 1) {
               ?>
	          <input type='button' value='Authorize' onclick="authorize('SupervisorEAuth')" />
	       <?php
            }
	 ?>
	 </div>
	 <?php
	    if ($current->ModifiedBy) {
         ?>
               <div class='contentField'><span class='fieldLabel'>Modified By</span><?php print $current->ModifiedBy; ?></div>
	 <?php
	    }
         ?>
         <input type='hidden' name='HR_MissedPunch[<?php print $current->HR_MissedPunchID; ?>][ModifiedBy]' id='ModifiedBy' value='<?php print $_SESSION['Email'] ?>' size='50' class='boxValue' />
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='HR_MissedPunch[<?php print $current->HR_MissedPunchID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
   </div>
</div>
