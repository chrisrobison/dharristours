<div class='tableGroup'>
   <div class='boxHeading'> Note To Payroll ID: <?php print $current->NoteToPayrollID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Note Title</span><input type='text' name='NoteToPayroll[<?php print $current->NoteToPayrollID; ?>][NoteToPayroll]' id='NoteToPayroll' value='<?php print $current->NoteToPayroll; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Employee</span>
	    <select name='NoteToPayroll[<?php print $current->NoteToPayrollID; ?>][EmployeeID]' id='EmployeeID' class='boxValue' >
               <option value='' >select</option>
	       <?php
		  $util->listEmployees();
	       ?>
	    </select>
	 </div>
         <div class='contentField'><span class='fieldLabel'>Supervisor</span>
	    <select name='NoteToPayroll[<?php print $current->NoteToPayrollID; ?>][SupervisorID]' id='SupervisorID' class='boxValue' >
               <option value='' >select</option>
	       <?php
		  $util->listEmployees();
	       ?>
	    </select>
         </div>
      </span>
      <span class='fieldcolumn'>
        <div class='contentField'><span class='fieldLabel'>Note</span><textarea name='NoteToPayroll[<?php print $current->NoteToPayrollID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
   </div>
</div>
