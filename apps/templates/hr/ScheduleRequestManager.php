<?php 
   $boss = new boss();
   $util = $boss->utility;
   $current = $boss->getObject('ScheduleRequest', $in['ID']);
   
?>
<script type='text/javascript' src='/lib/js/personnel.js'> </script>
<div class='tableGroup'>
   <div class='boxHeading'> New Scheduling Request</div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Schedule Request Title</span><input type='text' name='ScheduleRequest[<?php print $current->ScheduleRequestID; ?>][ScheduleRequest]' id='ScheduleRequest' value='<?php print $current->ScheduleRequest; ?>' size='50' class='boxValue' /></div>
      <!--
         <div class='contentField'><span class='fieldLabel'>Employee</span>
	    <select name='ScheduleRequest[<?php print $current->ScheduleRequestID; ?>][EmployeeID]' id='EmployeeID' class='boxValue' >
               <option value='' >select</option>
	       <?php
		  $util->listEmployees();
	       ?>
	    </select>
	 </div>
         <div class='contentField'><span class='fieldLabel'>Supervisor</span>
	    <select name='ScheduleRequest[<?php print $current->ScheduleRequestID; ?>][SupervisorID]' id='SupervisorID' class='boxValue' >
               <option value='' >select</option>
	       <?php
		  $util->listEmployees();
	       ?>
	    </select>
         </div>
      -->
      <input type='hidden' name='ScheduleRequest[<?php print $current->ScheduleRequestID; ?>][SupervisorID]' id='SupervisorID' value='<?php print $_SESSION['Employee']->SupervisorID; ?>' />
      <input type='hidden' name='ScheduleRequest[<?php print $current->ScheduleRequestID; ?>][EmployeeID]' id='EmployeeID' value='<?php print $_SESSION['Employee']->EmployeeID; ?>' />
	 <div class='contentField'><span class='fieldLabel'>First Day</span>
	    <input type='text' id='fmonth' value='<?php print date('n', strtotime($current->FirstDay)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeDate('fmonth', 'fdate', 'fyear', '<?php print $current->ScheduleRequestID; ?>', 'ScheduleRequest',  'FirstDay')" /> /
	    <input type='text' id='fdate' value='<?php print date('j', strtotime($current->FirstDay)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeDate('fmonth', 'fdate', 'fyear', '<?php print $current->ScheduleRequestID; ?>', 'ScheduleRequest', 'FirstDay')" /> /
	    <input type='text' id='fyear' value='<?php print date('Y', strtotime($current->FirstDay)); ?>' size='4' maxlength='4' class='boxValue' style='width:4em; min-width:4em;' onchange="makeDate('fmonth', 'fdate', 'fyear', '<?php print $current->ScheduleRequestID; ?>', 'ScheduleRequest', 'FirstDay')" /> 
	 </div>
	 <div class='contentField'><span class='fieldLabel'>Last Day</span>
	    <input type='text' id='lmonth' value='<?php print date('n', strtotime($current->LastDay)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeDate('lmonth', 'ldate', 'lyear', '<?php print $current->ScheduleRequestID; ?>', 'ScheduleRequest', 'LastDay')" /> /
	    <input type='text' id='ldate' value='<?php print date('j', strtotime($current->LastDay)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeDate('lmonth', 'ldate', 'lyear', '<?php print $current->ScheduleRequestID; ?>', 'ScheduleRequest', 'LastDay')"/> /
	    <input type='text' id='lyear' value='<?php print date('Y', strtotime($current->LastDay)); ?>' size='4' maxlength='4' class='boxValue' style='width:4em; min-width:4em;' onchange="makeDate('lmonth', 'ldate', 'lyear', '<?php print $current->ScheduleRequestID; ?>', 'ScheduleRequest', 'LastDay')"/> 
	 </div>
	 <input type='hidden' id='FirstDay' />
	 <input type='hidden' id='LastDay' />
	 <div class='contentField'><span class='fieldLabel'>Leave Time</span>
	    <input type='text' id='lhour' value='<?php print date('g', strtotime($current->LeaveTime)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('lhour', 'lminute', 'lampm', '<?php print $current->ScheduleRequestID; ?>', 'ScheduleRequest', 'LeaveTime')" /> :
	    <input type='text' id='lminute' value='<?php print date('i', strtotime($current->LeaveTime)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('lhour', 'lminute', 'lampm', '<?php print $current->ScheduleRequestID; ?>', 'ScheduleRequest', 'LeaveTime')" /> 
	    <select id='lampm' class='boxValue' style='width:4em; min-width: 4em;' onchange="makeTime('lhour', 'lminute', 'lampm', '<?php print $current->ScheduleRequestID; ?>', 'ScheduleRequest', 'LeaveTime')" >
               <option value='am' <?php print date('a', strtotime($current->LeaveTime)) == 'am' ? 'selected' : '' ?> >am</option>
               <option value='pm' <?php print date('a', strtotime($current->LeaveTime)) == 'pm' ? 'selected' : '' ?> >pm</option>
	    </select>
	 </div>
	 <div class='contentField'><span class='fieldLabel'>Return Time</span>
	    <input type='text' id='rhour' value='<?php print date('g', strtotime($current->ReturnTime)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('rhour', 'rminute', 'rampm',  '<?php print $current->ScheduleRequestID; ?>', 'ScheduleRequest', 'ReturnTime')" /> :
	    <input type='text' id='rminute' value='<?php print date('i', strtotime($current->ReturnTime)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('rhour', 'rminute', 'rampm', '<?php print $current->ScheduleRequestID; ?>', 'ScheduleRequest', 'ReturnTime')" /> 
	    <select id='rampm' class='boxValue' style='width:4em; min-width: 4em;' onchange="makeTime('rhour', 'rminute', 'rampm', '<?php print $current->ScheduleRequestID; ?>', 'ScheduleRequest', 'ReturnTime')" >
               <option value='am' <?php print date('a', strtotime($current->ReturnTime)) == 'am' ? 'selected' : '' ?> >am</option>
               <option value='pm' <?php print date('a', strtotime($current->ReturnTime)) == 'pm' ? 'selected' : '' ?> >pm</option>
	    </select>
	 </div>
	 <input type='hidden' id='LeaveTime' />
	 <input type='hidden' id='ReturnTime' />
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Type</span>
	    <select name='ScheduleRequest[<?php print $current->ScheduleRequestID; ?>][Type]' id='Type' class='boxValue' >
               <option value='' >-- Select --</option>
               <option value='sick' >Sick</option>
               <option value='vacation' >Vacation</option>
               <option value='holiday' >Holiday</option>
               <option value='jury' >Jury</option>
	    </select>
         </div>
         <div class='contentField'><span class='fieldLabel'>Hours Used</span><input type='text' name='ScheduleRequest[<?php print $current->ScheduleRequestID; ?>][BenefitUsed]' id='BenefitUsed' value='<?php print $current->BenefitUsed; ?>' size='5' style='width: 4em; max-width: 4em;' class='boxValue' /></div>
         <!-- <div class='contentField'><span class='fieldLabel'>Benefit Hours Remain</span><input type='text' name='ScheduleRequest[<?php print $current->ScheduleRequestID; ?>][BenefitRemain]' id='BenefitRemain' value='<?php print $current->BenefitRemain; ?>' size='5' style='width: 4em; max-width: 4em;' class='boxValue' /></div> -->
         <div class='contentField'><span class='fieldLabel'>Employee Authorized</span>
	 <span id='EmployeeEAuthdisp'><?php print ($current->EmployeeEAuth != '0000-00-00 00:00:00') ? $current->EmployeeEAuth : 'Not Authorized' ?></span>
    <input type='hidden' name='ScheduleRequest[<?php print $current->ScheduleRequestID; ?>][EmployeeEAuth]' id='EmployeeEAuth' />
	          <input type='button' value='Authorize' onclick="authorize('EmployeeEAuth')" id='EmployeeEAuthButton' />
	 </div>
         <div class='contentField'><span class='fieldLabel'>Supervisor Authorized</span>
	 <span id='SupervisorEAuthdisp'><?php print ($current->SupervisorEAuth != '0000-00-00 00:00:00') ? $current->SupervisorEAuth : 'Not Authorized' ?></span>
    <input type='hidden' name='ScheduleRequest[<?php print $current->ScheduleRequestID; ?>][SupervisorEAuth]' id='SupervisorEAuth' />
	 <?php if ($_SESSION['UserID'] == $current->SupervisorID) { ?>
	          <input type='button' value='Authorize' onclick="authorize('SupervisorEAuth')" id='SupervisorEAuthButton' />
	       <?php } ?>
	 </div>
	 <?php 
      if ($current->ModifiedBy) { 
         // print "<div class='contentField'><span class='fieldLabel'>Modified By</span>{$current->ModifiedBy}</div>";
      } 
      ?>
         <input type='hidden' name='ScheduleRequest[<?php print $current->ScheduleRequestID; ?>][ModifiedBy]' id='ModifiedBy' value='<?php print $_SESSION['Email'] ?>' size='50' class='boxValue' />
      </span>
      <br clear='left'>
      <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='ScheduleRequest[<?php print $current->ScheduleRequestID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      <span class='notice' style='font-style:italic;position:relative;left:11em;top:2em;color:#909090;'>* Jury Duty benefit requires copies of court issued jury notice and time records 
      which may be provided by the court clerk at the time service is performed.</span>
   </div>
</div>
<?php
   if (!$in['ID'] && !$in['ScheduleRequestID']) {
?>
<script language='Javascript' type='text/javascript'>
   doNew();
</script>
<?php
   }
?>
