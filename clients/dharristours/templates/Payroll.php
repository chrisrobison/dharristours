<div class='tableGroup'>
   <div class='formHeading'>EmployeePayrollDetails ID: <?php print $current->EmployeePayrollDetailsID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>For</label><input type='text' dbtype='varchar(100)' name='EmployeePayrollDetails[<?php print $current->EmployeePayrollDetailsID; ?>][EmployeePayrollDetails]' id='EmployeePayrollDetails' value='<?php print $current->EmployeePayrollDetails; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='EmployeePayrollDetails[<?php print $current->EmployeePayrollDetailsID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Payroll Date</label><input type='text' dbtype='date' name='EmployeePayrollDetails[<?php print $current->EmployeePayrollDetailsID; ?>][PayrollDate]' id='PayrollDate' value='<?php print $current->PayrollDate; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Start Time</label><input type='text' dbtype='time' name='EmployeePayrollDetails[<?php print $current->EmployeePayrollDetailsID; ?>][StartTime]' id='StartTime' value='<?php print $current->StartTime; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>End Time</label><input type='text' dbtype='time' name='EmployeePayrollDetails[<?php print $current->EmployeePayrollDetailsID; ?>][EndTime]' id='EndTime' value='<?php print $current->EndTime; ?>' size='25' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Regular Hours</label><input type='text' dbtype='decimal(15,4)' name='EmployeePayrollDetails[<?php print $current->EmployeePayrollDetailsID; ?>][RegularHours]' id='RegularHours' value='<?php print $current->RegularHours; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Overtime Hours</label><input type='text' dbtype='decimal(15,4)' name='EmployeePayrollDetails[<?php print $current->EmployeePayrollDetailsID; ?>][OvertimeHours]' id='OvertimeHours' value='<?php print $current->OvertimeHours; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Total Hours</label><input type='text' dbtype='varchar(100)' name='EmployeePayrollDetails[<?php print $current->EmployeePayrollDetailsID; ?>][TotalHours]' id='TotalHours' value='<?php print $current->TotalHours; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Break</label><input type='text' dbtype='decimal(15,4)' name='EmployeePayrollDetails[<?php print $current->EmployeePayrollDetailsID; ?>][Break]' id='Break' value='<?php print $current->Break; ?>' size='50' class='boxValue' /></div>
</div>
</div>
