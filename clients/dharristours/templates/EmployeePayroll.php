<div class='tableGroup'>
   <div class='formHeading'>EmployeePayroll ID: <?php print $current->EmployeePayrollID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Employee </label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "EmployeePayroll[$current->EmployeePayrollID][EmployeeID]")."</div>";?>
         <div class='contentField'><label>Employee</label><input type='text' dbtype='varchar(100)' name='EmployeePayroll[<?php print $current->EmployeePayrollID; ?>][Employee]' id='Employee' value='<?php print $current->Employee; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Job Date</label><input type='text' dbtype='date' name='EmployeePayroll[<?php print $current->EmployeePayrollID; ?>][JobDate]' id='JobDate' value='<?php print $current->JobDate; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Jobs</label><textarea dbtype='text' name='EmployeePayroll[<?php print $current->EmployeePayrollID; ?>][Jobs]' id='Jobs' class='textBox'><?php print $current->Jobs; ?></textarea></div>
         <div class='contentField'><label>Start Time</label><input type='text' dbtype='varchar(100)' name='EmployeePayroll[<?php print $current->EmployeePayrollID; ?>][StartTime]' id='StartTime' value='<?php print $current->StartTime; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>End Time</label><input type='text' dbtype='varchar(100)' name='EmployeePayroll[<?php print $current->EmployeePayrollID; ?>][EndTime]' id='EndTime' value='<?php print $current->EndTime; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Hours Worked</label><input type='text' dbtype='decimal(12,2)' name='EmployeePayroll[<?php print $current->EmployeePayrollID; ?>][HoursWorked]' id='HoursWorked' value='<?php print $current->HoursWorked; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Trip IDs</label><?php $boss->db->addResource("Trip");$arr = $boss->db->Trip->getlist();print $boss->utility->buildSelect($arr, $current->TripID, "TripID", "Trip", "EmployeePayroll[$current->EmployeePayrollID][TripIDs]")."</div>";?>
         <div class='contentField'><label>Rate</label><input type='text' dbtype='decimal(4,2)' name='EmployeePayroll[<?php print $current->EmployeePayrollID; ?>][Rate]' id='Rate' value='<?php print $current->Rate; ?>' size='42' class='boxValue' /></div>
         <div class='contentField'><label>Pay Period Start Date</label><input type='text' dbtype='varchar(29)' name='EmployeePayroll[<?php print $current->EmployeePayrollID; ?>][PayPeriodStartDate]' id='PayPeriodStartDate' value='<?php print $current->PayPeriodStartDate; ?>' size='29' class='boxValue date' /></div>
</div>
</div>
</div>