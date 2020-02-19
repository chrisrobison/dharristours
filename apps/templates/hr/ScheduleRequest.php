<?php 
   $boss = new boss();
   $util = $boss->utility;
   $current = new stdClass;
   if ($in['ID']) $current = $boss->getObject('HR_ScheduleRequest', $in['ID']);
   
?>
<script language='Javascript' type='text/javascript' src='/lib/js/personnel.js'> </script>
<div class='tableGroup'>
   <div class='boxHeading'>New Scheduling Request</div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Request Subject</label><input type='text' name='HR_ScheduleRequest[<?php print $current->HR_ScheduleRequestID; ?>][HR_ScheduleRequest]' id='HR_ScheduleRequest' value='<?php print $current->HR_ScheduleRequest; ?>' size='50' class='boxValue' /></div>
            <input type='hidden' name='HR_ScheduleRequest[<?php print $current->HR_ScheduleRequestID; ?>][SupervisorID]' id='SupervisorID' value='<?php print $_SESSION['Employee']->SupervisorID; ?>' />
            <input type='hidden' name='HR_ScheduleRequest[<?php print $current->HR_ScheduleRequestID; ?>][EmployeeID]' id='EmployeeID' value='<?php print $_SESSION['Employee']->EmployeeID; ?>' />
            <div class='contentField'><label>Start Date</label><input type='text' id='StartDate' name='HR_ScheduleRequest[<?php print $current->HR_ScheduleRequestID; ?>][StartDate]' value='<?php print date('m-d-Y h:i:sa', strtotime($current->StartDate)); ?>' size='15' class='date'></div>
            <div class='contentField'><label>Return Date</label><input type='text' id='ReturnDate' name='HR_ScheduleRequest[<?php print $current->HR_ScheduleRequestID; ?>][ReturnDate]' value='<?php print date('m-d-Y h:i:sa', strtotime($current->ReturnDate)); ?>' size='15' class='date'></div>
         </div>
         <div class='fieldcolumn'>
            <div class='contentField'><label>Type</label>
               <select name='HR_ScheduleRequest[<?php print $current->HR_ScheduleRequestID; ?>][Type]' id='Type' class='boxValue' >
                  <option value='' >-- Select --</option>
                  <option value='sick' >Sick</option>
                  <option value='vacation' >Vacation</option>
                  <option value='holiday' >Holiday</option>
                  <option value='jury' >Jury</option>
               </select>
            </div>
            <div class='contentField'><label>Hours Used</label><input type='text' name='HR_ScheduleRequest[<?php print $current->HR_ScheduleRequestID; ?>][BenefitUsed]' id='BenefitUsed' value='<?php print $current->BenefitUsed; ?>' size='5' style='width: 4em; max-width: 4em;' class='boxValue' /></div>
            <div class='contentField'><label>Employee Authorized</label>
               <span id='EmployeeEAuthdisp'><?php print ($current->EmployeeEAuth != '0000-00-00 00:00:00') ? $current->EmployeeEAuth : 'Not Authorized' ?></span>
               <input type='hidden' name='HR_ScheduleRequest[<?php print $current->HR_ScheduleRequestID; ?>][EmployeeEAuth]' id='EmployeeEAuth' />
               <input type='button' value='Authorize' onclick="authorize('EmployeeEAuth')" id='EmployeeEAuthButton' />
            </div>
            <div class='contentField'>
               <label>Supervisor Authorized</label>
               <span id='SupervisorEAuthdisp'><?php print ($current->SupervisorEAuth != '0000-00-00 00:00:00') ? $current->SupervisorEAuth : 'Not Authorized' ?></span>
               <input type='hidden' name='HR_ScheduleRequest[<?php print $current->HR_ScheduleRequestID; ?>][SupervisorEAuth]' id='SupervisorEAuth' />
               <?php if ($_SESSION['UserID'] == $current->SupervisorID) { ?>
               <input type='button' value='Authorize' onclick="authorize('SupervisorEAuth')" id='SupervisorEAuthButton' />
               <?php } ?>
            </div>
         <?php 
         if ($current->ModifiedBy) { 
            print "<div class='contentField'><label>Last Modified By</label><span style='margin-left:1em;'>{$current->ModifiedBy}</span></div>";
         } 
         ?>
         <input type='hidden' name='HR_ScheduleRequest[<?php print $current->HR_ScheduleRequestID; ?>][ModifiedBy]' id='ModifiedBy' value='<?php print $_SESSION['Email'] ?>' size='50' class='boxValue' />
         </div>
         <br clear='left'>
         <div class='contentField'><label>Notes</label><textarea name='HR_ScheduleRequest[<?php print $current->HR_ScheduleRequestID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
         <div class='notice' style='font-size:.9em;font-style:italic;position:relative;width:50%;margin:1em auto;color:#909090;'>* Jury Duty benefit requires copies of court issued jury notice and time records <br>which may be provided by the court clerk at the time service is performed.</div>
      </div>
   </div>
</div>
<?php
   if (!$in['ID'] && !$in['HR_ScheduleRequestID']) {
?>
<script language='Javascript' type='text/javascript'>
   
      simpleConfig.init = function() { 
         $("#formContainer").css({"height":"auto"});
         <?php if (!$in['ID'] && !$in['HR_ScheduleRequestID']) print "doNew();\n"; ?>
      };
</script>
<?php
   }
?>
