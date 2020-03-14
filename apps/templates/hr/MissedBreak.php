<div class='tableGroup'>
   <div class='boxHeading'> HR_MissedBreak ID: <?php print $current->HR_MissedBreakID; ?></div>
   <span class='notice'>
      This notice is to document the fact that the employee listed on this form was NOT PROVIDED
      THE OPPORTUNITY to take the appropriate rest period(s) and/or meal period(s) as required
      by Inter@ctivate policy.  This notice is not intended to reflect an employee's willful 
      declination of the required 10 minute rest period and/or 30 minute meal period and should
      only be used when the employee's workload or circumstance was such that a break was not 
      possible.
   </span>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Missed Break Title</span><input type='text' name='HR_MissedBreak[<?php print $current->HR_MissedBreakID; ?>][HR_MissedBreak]' id='HR_MissedBreak' value='<?php print $current->HR_MissedBreak; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Missed Break Date</span><input type='text' name='HR_MissedBreak[<?php print $current->HR_MissedBreakID; ?>][HR_MissedBreakDate]' id='HR_MissedBreakDate' value='<?php print $current->HR_MissedBreakDate; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Employee</span>
	    <select name='HR_MissedBreak[<?php print $current->HR_MissedBreakID; ?>][EmployeeID]' id='EmployeeID' class='boxValue' >
               <option value='' >-- Select Employee --</option>
	       <?php
		  print $util->listEmployees(((!$current->EmployeeID) ? $_SESSION['Employee']->EmployeeID : $current->EmployeeID) );
	       ?>
	    </select>
	 </div>
         <div class='contentField'><span class='fieldLabel'>Supervisor</span>
	    <select name='HR_MissedBreak[<?php print $current->HR_MissedBreakID; ?>][SupervisorID]' id='SupervisorID' class='boxValue' >
               <option value='' >-- Select Supervisor --</option>
	       <?php
		  print $util->listEmployees($current->SupervisorID);
	       ?>
	    </select>
        </div>
         <div class='contentField'><span class='fieldLabel'>* Supervisor Aware</span>
	    <input type='radio' name='HR_MissedBreak[<?php print $current->HR_MissedBreakID; ?>][SupervisorAware]' value='1' />Yes &nbsp;
	    <input type='radio' name='HR_MissedBreak[<?php print $current->HR_MissedBreakID; ?>][SupervisorAware]' value='0' />No 
	 </div>
         <div class='contentField'><span class='fieldLabel'>** Employee Aware</span>
	    <input type='radio' name='HR_MissedBreak[<?php print $current->HR_MissedBreakID; ?>][EmployeeAware]' value='1' />Yes &nbsp;
	    <input type='radio' name='HR_MissedBreak[<?php print $current->HR_MissedBreakID; ?>][EmployeeAware]' value='0' />No 
	 </div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Reason</span><textarea name='HR_MissedBreak[<?php print $current->HR_MissedBreakID; ?>][Reason]' id='Reason' class='textBox' style='width:41em;height:5em;'><?php print $current->Reason; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Employee EAuth</span>
	 <span id='EmployeeEAuthdisp'><?php print $current->EmployeeEAuth ? $current->EmployeeEAuth : 'not authorized' ?></span><input type='hidden' name='HR_MissedBreak[<?php print $current->HR_MissedBreakID; ?>][EmployeeEAuth]' id='EmployeeEAuth' />
	 <?php 
	    if ($_SESSION['Employee']->EmployeeID == $current->EmployeeID) {
               ?>
	          <input type='button' value='Authorize' onclick="authorize('EmployeeEAuth')" />
	       <?php
            }
	 ?>
	 </div>
         <div class='contentField'><span class='fieldLabel'>Supervisor EAuth</span>
	 <span id='SupervisorEAuthdisp'><?php print $current->SupervisorEAuth ? $current->SupervisorEAuth : 'not authorized' ?></span><input type='hidden' name='HR_MissedBreak[<?php print $current->HR_MissedBreakID; ?>][SupervisorEAuth]' id='SupervisorEAuth' />
	 <?php
	    if ($_SESSION['Employee']->EmployeeID == $current->SupervisorID) {
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
         <input type='hidden' name='HR_MissedBreak[<?php print $current->HR_MissedBreakID; ?>][ModifiedBy]' id='ModifiedBy' value='<?php print $_SESSION['Email'] ?>' size='50' class='boxValue' />
         <div class='contentField'><span class='fieldLabel'>Payroll Comments</span><textarea name='HR_MissedBreak[<?php print $current->HR_MissedBreakID; ?>][PayrollComments]' id='PayrollComments' class='textBox' style='width:41em;height:5em;'><?php print $current->PayrollComments; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='HR_MissedBreak[<?php print $current->HR_MissedBreakID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
      <span class='notice'>
         * Was the Supervisor aware of this problem prior to the break time?
	 ** Was the employee informed about when to take a break and/or who would would assume 
	 duties while the break was taken PRIOR to the break time?
      </span>
   </div>
</div>
