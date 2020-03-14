<div class='tableGroup'>
   <div class='boxHeading'> HR_MakeupTime ID: <?php print $current->HR_MakeupTimeID; ?></div>
   <span class='notice' >
         By filling out this form I request the opportunity to miss work on the date indicated because of 
	 personal obligations and to make up those missed hours at straight-time pay during the same workweek.  
	 I understand that Interactivte can grant or deny this request and that I may not exceed 11 hours of 
	 work in one day or 40 hours in a workweek when makeup time is scheduled.  I certify that Interactivate 
	 has not encouraged or solicited me to take personal time off and make up the missed time and that this 
	 request entirely on a volunteer basis. </span>   
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Makeup Time Title</span><input type='text' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][HR_MakeupTime]' id='HR_MakeupTime' value='<?php print $current->HR_MakeupTime; ?>' size='50' class='boxValue' /></div>
          <div class='contentField'><span class='fieldLabel'>Employee</span>
	    <select name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][EmployeeID]' id='EmployeeID' class='boxValue' >
               <option value='' >select</option>
	       <?php
		      print $util->listEmployees($current->EmployeeID);
	       ?>
	    </select>
	 </div>
         <div class='contentField'><span class='fieldLabel'>Supervisor</span>
	    <select name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][SupervisorID]' id='SupervisorID' class='boxValue' >
               <option value='' >select</option>
	       <?php
		      print $util->listEmployees($current->SupervisorID);
	       ?>
	    </select>
         </div>        

	 <div class='contentField'><span class='fieldLabel'>Date Off</span>
	    <input type='text' id='omonth' value='<?php print date('n', strtotime($current->DateOff)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeDate('omonth', 'odate', 'oyear', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime',  'DateOff')" /> /
	    <input type='text' id='odate' value='<?php print date('j', strtotime($current->DateOff)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeDate('omonth', 'odate', 'oyear', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'DateOff')" /> /
	    <input type='text' id='oyear' value='<?php print date('Y', strtotime($current->DateOff)); ?>' size='4' maxlength='4' class='boxValue' style='width:4em; min-width:4em;' onchange="makeDate('omonth', 'odate', 'oyear', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'DateOff')" /> 
	    <input type='hidden' id='DateOff' />   
	 </div>
 	 <div class='contentField'><span class='fieldLabel'>Start Time Off</span>
	    <input type='text' id='sohour' value='<?php print date('g', strtotime($current->StartTimeOff)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('sohour', 'sominute', 'soampm', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'StartTimeOff')" /> :
	    <input type='text' id='sominute' value='<?php print date('i', strtotime($current->StartTimeOff)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('sohour', 'sominute', 'soampm', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'StartTimeOff')" /> 
	    <select id='soampm' class='boxValue' style='width:4em; min-width: 4em;' onchange="makeTime('sohour', 'sominute', 'soampm', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'StartTimeOff')" >
               <option value='am' <?php print date('a', strtotime($current->StartTimeOff)) == 'am' ? 'selected' : '' ?> >am</option>
               <option value='pm' <?php print date('a', strtotime($current->StartTimeOff)) == 'pm' ? 'selected' : '' ?> >pm</option>
	    </select>
	    <input type='hidden' id='StartTimeOff' />
	 </div>
  	 <div class='contentField'><span class='fieldLabel'>End Time Off</span>
	    <input type='text' id='eohour' value='<?php print date('g', strtotime($current->EndTimeOff)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('eohour', 'eominute', 'eoampm', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'EndTimeOff')" /> :
	    <input type='text' id='eominute' value='<?php print date('i', strtotime($current->EndTimeOff)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('eohour', 'eominute', 'eoampm', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'EndTimeOff')" /> 
	    <select id='eoampm' class='boxValue' style='width:4em; min-width: 4em;' onchange="makeTime('eohour', 'eominute', 'eoampm', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'EndTimeOff')" >
               <option value='am' <?php print date('a', strtotime($current->EndTimeOff)) == 'am' ? 'selected' : '' ?> >am</option>
               <option value='pm' <?php print date('a', strtotime($current->EndTimeOff)) == 'pm' ? 'selected' : '' ?> >pm</option>
	    </select>
	    <input type='hidden' id='EndTimeOff' />
	 </div>
         <div class='contentField'><span class='fieldLabel'>Missed Break Length (hours)</span><input type='text' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][BreakLengthOff]' style='width:4em; max-width:4em;' id='BreakLengthOff' value='<?php print $current->BreakLengthOff; ?>' size='42' class='boxValue' /></div>
	 
 	 <div class='contentField'><span class='fieldLabel'>Makeup Date</span>
	    <input type='text' id='mmonth' value='<?php print date('n', strtotime($current->MakeupDate)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeDate('mmonth', 'mdate', 'myear', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime',  'MakeupDate')" /> /
	    <input type='text' id='mdate' value='<?php print date('j', strtotime($current->MakeupDate)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeDate('mmonth', 'mdate', 'myear', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupDate')" /> /
	    <input type='text' id='myear' value='<?php print date('Y', strtotime($current->MakeupDate)); ?>' size='4' maxlength='4' class='boxValue' style='width:4em; min-width:4em;' onchange="makeDate('mmonth', 'mdate', 'myear', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupDate')" /> 
	    <input type='hidden' id='MakeupDate' />   
	 </div>        
   	 <div class='contentField'><span class='fieldLabel'>Makeup Start Time</span>
	    <input type='text' id='mshour' value='<?php print date('g', strtotime($current->MakeupStartTime)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('mshour', 'msminute', 'msampm', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupStartTime')" /> :
	    <input type='text' id='msminute' value='<?php print date('i', strtotime($current->MakeupStartTime)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('mshour', 'msminute', 'msampm', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupStartTime')" /> 
	    <select id='msampm' class='boxValue' style='width:4em; min-width: 4em;' onchange="makeTime('mshour', 'msminute', 'msampm', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupStartTime')" >
               <option value='am' <?php print date('a', strtotime($current->MakeupStartTime)) == 'am' ? 'selected' : '' ?> >am</option>
               <option value='pm' <?php print date('a', strtotime($current->MakeupStartTime)) == 'pm' ? 'selected' : '' ?> >pm</option>
	    </select>
	    <input type='hidden' id='MakeupStartTime' />
	 </div>        
    	 <div class='contentField'><span class='fieldLabel'>Makeup End Time</span>
	    <input type='text' id='mehour' value='<?php print date('g', strtotime($current->MakeupEndTime)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('mehour', 'meminute', 'meampm', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupEndTime')" /> :
	    <input type='text' id='meminute' value='<?php print date('i', strtotime($current->MakeupEndTime)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('mehour', 'meminute', 'meampm', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupEndTime')" /> 
	    <select id='meampm' class='boxValue' style='width:4em; min-width: 4em;' onchange="makeTime('mehour', 'meminute', 'meampm', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupEndTime')" >
               <option value='am' <?php print date('a', strtotime($current->MakeupEndTime)) == 'am' ? 'selected' : '' ?> >am</option>
               <option value='pm' <?php print date('a', strtotime($current->MakeupEndTime)) == 'pm' ? 'selected' : '' ?> >pm</option>
	    </select>
	    <input type='hidden' id='MakeupEndTime' />
	 </div>        
         <div class='contentField'><span class='fieldLabel'>Makeup Break (hours)</span><input type='text' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][MakeupBreak]' style='width:4em; max-width:4em;' id='MakeupBreak' value='<?php print $current->MakeupBreak; ?>' size='42' class='boxValue' /></div>
	 
      </span>
      <span class='fieldcolumn'>
 	 <div class='contentField'><span class='fieldLabel'>Makeup Date 2</span>
	    <input type='text' id='mmonth2' value='<?php print date('n', strtotime($current->MakeupDate2)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeDate('mmonth2', 'mdate2', 'myear2', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime',  'MakeupDate2')" /> /
	    <input type='text' id='mdate2' value='<?php print date('j', strtotime($current->MakeupDate2)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeDate('mmonth2', 'mdate2', 'myear2', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupDate2')" /> /
	    <input type='text' id='myear2' value='<?php print date('Y', strtotime($current->MakeupDate2)); ?>' size='4' maxlength='4' class='boxValue' style='width:4em; min-width:4em;' onchange="makeDate('mmonth2', 'mdate2', 'myear2', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupDate2')" /> 
	    <input type='hidden' id='MakeupDate2' />   
	 </div>        
   	 <div class='contentField'><span class='fieldLabel'>Makeup Start Time 2</span>
	    <input type='text' id='mshour2' value='<?php print date('g', strtotime($current->MakeupStartTime2)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('mshour2', 'msminute2', 'msampm2', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupStartTime2')" /> :
	    <input type='text' id='msminute2' value='<?php print date('i', strtotime($current->MakeupStartTime2)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('mshour2', 'msminute2', 'msampm2', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupStartTime2')" /> 
	    <select id='msampm2' class='boxValue' style='width:4em; min-width: 4em;' onchange="makeTime('mshour2', 'msminute2', 'msampm2', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupStartTime2')" >
               <option value='am' <?php print date('a', strtotime($current->MakeupStartTime)) == 'am' ? 'selected' : '' ?> >am</option>
               <option value='pm' <?php print date('a', strtotime($current->MakeupStartTime)) == 'pm' ? 'selected' : '' ?> >pm</option>
	    </select>
	    <input type='hidden' id='MakeupStartTime2' />
	 </div>        
    	 <div class='contentField'><span class='fieldLabel'>Makeup End Time 2</span>
	    <input type='text' id='mehour2' value='<?php print date('g', strtotime($current->MakeupEndTime2)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('mehour2', 'meminute2', 'meampm2', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupEndTime2')" /> :
	    <input type='text' id='meminute2' value='<?php print date('i', strtotime($current->MakeupEndTime2)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('mehour2', 'meminute2', 'meampm2', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupEndTime2')" /> 
	    <select id='meampm2' class='boxValue' style='width:4em; min-width: 4em;' onchange="makeTime('mehour2', 'meminute2', 'meampm2', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupEndTime2')" >
               <option value='am' <?php print date('a', strtotime($current->MakeupEndTime2)) == 'am' ? 'selected' : '' ?> >am</option>
               <option value='pm' <?php print date('a', strtotime($current->MakeupEndTime2)) == 'pm' ? 'selected' : '' ?> >pm</option>
	    </select>
	    <input type='hidden' id='MakeupEndTime2' />
	 </div>        
         <div class='contentField'><span class='fieldLabel'>Makeup Break 2 (hours)</span><input type='text' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][MakeupBreak2]' style='width:4em; max-width:4em;' id='MakeupBreak2' value='<?php print $current->MakeupBreak2; ?>' size='42' class='boxValue' /></div>
 	 
	 <div class='contentField'><span class='fieldLabel'>Makeup Date 3</span>
	    <input type='text' id='mmonth3' value='<?php print date('n', strtotime($current->MakeupDate3)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeDate('mmonth3', 'mdate3', 'myear3', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime',  'MakeupDate3')" /> /
	    <input type='text' id='mdate3' value='<?php print date('j', strtotime($current->MakeupDate2)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeDate('mmonth3', 'mdate3', 'myear3', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupDate3')" /> /
	    <input type='text' id='myear3' value='<?php print date('Y', strtotime($current->MakeupDate3)); ?>' size='4' maxlength='4' class='boxValue' style='width:4em; min-width:4em;' onchange="makeDate('mmonth3', 'mdate3', 'myear3', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupDate3')" /> 
	    <input type='hidden' id='MakeupDate3' />   
	 </div>        
   	 <div class='contentField'><span class='fieldLabel'>Makeup Start Time 3</span>
	    <input type='text' id='mshour3' value='<?php print date('g', strtotime($current->MakeupStartTime3)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('mshour3', 'msminute3', 'msampm3', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupStartTime3')" /> :
	    <input type='text' id='msminute3' value='<?php print date('i', strtotime($current->MakeupStartTime3)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('mshour3', 'msminute3', 'msampm3', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupStartTime3')" /> 
	    <select id='msampm3' class='boxValue' style='width:4em; min-width: 4em;' onchange="makeTime('mshour3', 'msminute3', 'msampm3', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupStartTime3')" >
               <option value='am' <?php print date('a', strtotime($current->MakeupStartTime)) == 'am' ? 'selected' : '' ?> >am</option>
               <option value='pm' <?php print date('a', strtotime($current->MakeupStartTime)) == 'pm' ? 'selected' : '' ?> >pm</option>
	    </select>
	    <input type='hidden' id='MakeupStartTime3' />
	 </div>        
    	 <div class='contentField'><span class='fieldLabel'>Makeup End Time 3</span>
	    <input type='text' id='mehour3' value='<?php print date('g', strtotime($current->MakeupEndTime3)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('mehour3', 'meminute3', 'meampm3', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupEndTime3')" /> :
	    <input type='text' id='meminute3' value='<?php print date('i', strtotime($current->MakeupEndTime3)); ?>' size='2' maxlength='2' class='boxValue' style='width:2em; min-width:2em;' onchange="makeTime('mehour3', 'meminute3', 'meampm3', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupEndTime3')" /> 
	    <select id='meampm3' class='boxValue' style='width:4em; min-width: 4em;' onchange="makeTime('mehour3', 'meminute3', 'meampm3', '<?php print $current->HR_MakeupTimeID; ?>', 'HR_MakeupTime', 'MakeupEndTime3')" >
               <option value='am' <?php print date('a', strtotime($current->MakeupEndTime3)) == 'am' ? 'selected' : '' ?> >am</option>
               <option value='pm' <?php print date('a', strtotime($current->MakeupEndTime3)) == 'pm' ? 'selected' : '' ?> >pm</option>
	    </select>
	    <input type='hidden' id='MakeupEndTime3' />
	 </div>        
         <div class='contentField'><span class='fieldLabel'>Makeup Break 3 (hours)</span><input type='text' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][MakeupBreak3]' style='width:4em; max-width:4em;' id='MakeupBreak3' value='<?php print $current->MakeupBreak3; ?>' size='42' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Employee EAuth</span>
	    <span id='EmployeeEAuthdisp'><?php print $current->EmployeeEAuth ? $current->EmployeeEAuth : 'not authorized' ?></span><input type='hidden' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][EmployeeEAuth]' id='EmployeeEAuth' />
	 <?php 
	    if ($_SESSION['UserID'] == $current->EmployeeID) {
               ?>
	          <input type='button' value='authorize' onclick="authorize('EmployeeEAuth')" />
	       <?php
            }
	 ?>
	 </div>
         <div class='contentField'><span class='fieldLabel'>Supervisor EAuth</span>
	 <span id='SupervisorEAuthdisp'><?php print $current->SupervisorEAuth ? $current->SupervisorEAuth : 'not authorized' ?></span><input type='hidden' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][SupervisorEAuth]' id='SupervisorEAuth' />
	 <?php
	    if ($_SESSION['UserID'] == $current->SupervisorID) {
               ?>
	          <input type='button' value='authorize' onclick="authorize('SupervisorEAuth')" />
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
         <input type='hidden' name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][ModifiedBy]' id='ModifiedBy' value='<?php print $_SESSION['Email'] ?>' size='50' class='boxValue' />
         <div class='contentField'><span class='fieldLabel'>Reason</span><textarea name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][Reason]' id='Reason' class='textBox' style='width:41em;height:5em;'><?php print $current->Reason; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Note To Supervisor</span><textarea name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][HR_NoteToSupervisor]' id='HR_NoteToSupervisor' class='textBox' style='width:41em;height:5em;'><?php print $current->HR_NoteToSupervisor; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='HR_MakeupTime[<?php print $current->HR_MakeupTimeID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
      
   </div>
</div>
