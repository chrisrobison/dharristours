<div class='tableGroup'>
   <div class='boxHeading'> Note To Payroll ID: <?php print $current->HR_NoteToPayrollID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Note Title</span><input type='text' name='HR_NoteToPayroll[<?php print $current->HR_NoteToPayrollID; ?>][HR_NoteToPayroll]' id='HR_NoteToPayroll' value='<?php print $current->HR_NoteToPayroll; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Employee</span>
	    <select name='HR_NoteToPayroll[<?php print $current->HR_NoteToPayrollID; ?>][EmployeeID]' id='EmployeeID' class='boxValue' >
               <option value='' >select</option>
	       <?php
		  $util->listEmployees();
	       ?>
	    </select>
	 </div>
         <div class='contentField'><span class='fieldLabel'>Supervisor</span>
	    <select name='HR_NoteToPayroll[<?php print $current->HR_NoteToPayrollID; ?>][SupervisorID]' id='SupervisorID' class='boxValue' >
               <option value='' >select</option>
	       <?php
		  $util->listEmployees();
	       ?>
	    </select>
         </div>
      </span>
      <span class='fieldcolumn'>
        <div class='contentField'><span class='fieldLabel'>Note</span><textarea name='HR_NoteToPayroll[<?php print $current->HR_NoteToPayrollID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
   </div>
</div>
