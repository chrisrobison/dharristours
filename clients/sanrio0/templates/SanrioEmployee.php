<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> SanrioEmployee ID: <?php print $current->SanrioEmployeeID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>LOC</label><input type='text' dbtype='varchar(4)' name='SanrioEmployee[<?php print $current->SanrioEmployeeID; ?>][LOC]' id='LOC' value='' size='4' class='boxValue' /></div>
         <div class='contentField'><label>Department Name</label><input type='text' dbtype='varchar(32)' name='SanrioEmployee[<?php print $current->SanrioEmployeeID; ?>][DepartmentName]' id='DepartmentName' value='' size='32' class='boxValue' /></div>
         <div class='contentField'><label>Dept Num</label><input type='text' dbtype='int(2)' name='SanrioEmployee[<?php print $current->SanrioEmployeeID; ?>][DeptNum]' id='DeptNum' value='' size='2' class='boxValue' /></div>
         <div class='contentField'><label>Employee Num</label><input type='text' dbtype='int(4)' name='SanrioEmployee[<?php print $current->SanrioEmployeeID; ?>][EmployeeNum]' id='EmployeeNum' value='' size='4' class='boxValue' /></div>
         <div class='contentField'><label>First Name</label><input type='text' dbtype='varchar(13)' name='SanrioEmployee[<?php print $current->SanrioEmployeeID; ?>][FirstName]' id='FirstName' value='' size='13' class='boxValue' /></div>
         <div class='contentField'><label>Last Name</label><input type='text' dbtype='varchar(14)' name='SanrioEmployee[<?php print $current->SanrioEmployeeID; ?>][LastName]' id='LastName' value='' size='14' class='boxValue' /></div>
         <div class='contentField'><label>Full Name</label><input type='text' dbtype='varchar(20)' name='SanrioEmployee[<?php print $current->SanrioEmployeeID; ?>][FullName]' id='FullName' value='' size='20' class='boxValue' /></div>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(26)' name='SanrioEmployee[<?php print $current->SanrioEmployeeID; ?>][Email]' id='Email' value='' size='26' class='boxValue' /></div>
         <div class='contentField'><label>Hire Date</label><input type='text' dbtype='varchar(20)' name='SanrioEmployee[<?php print $current->SanrioEmployeeID; ?>][HireDate]' id='HireDate' value='' size='20' class='boxValue date' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Job Title</label><input type='text' dbtype='varchar(32)' name='SanrioEmployee[<?php print $current->SanrioEmployeeID; ?>][JobTitle]' id='JobTitle' value='' size='32' class='boxValue' /></div>
         <div class='contentField'><label>FLSA</label><input type='text' dbtype='varchar(2)' name='SanrioEmployee[<?php print $current->SanrioEmployeeID; ?>][FLSA]' id='FLSA' value='' size='2' class='boxValue' /></div>
         <div class='contentField'><label>Sup First Name</label><input type='text' dbtype='varchar(20)' name='SanrioEmployee[<?php print $current->SanrioEmployeeID; ?>][SupFirstName]' id='SupFirstName' value='' size='20' class='boxValue' /></div>
         <div class='contentField'><label>Sup Last Name</label><input type='text' dbtype='varchar(19)' name='SanrioEmployee[<?php print $current->SanrioEmployeeID; ?>][SupLastName]' id='SupLastName' value='' size='19' class='boxValue' /></div>
         <div class='contentField'><label>Area</label><input type='text' dbtype='int(3)' name='SanrioEmployee[<?php print $current->SanrioEmployeeID; ?>][Area]' id='Area' value='' size='3' class='boxValue' /></div>
         <div class='contentField'><label>Home Phone</label><input type='text' dbtype='varchar(9)' name='SanrioEmployee[<?php print $current->SanrioEmployeeID; ?>][HomePhone]' id='HomePhone' value='' size='9' class='boxValue' /></div>
         <div class='contentField'><label>HDate</label><input type='text' dbtype='date' name='SanrioEmployee[<?php print $current->SanrioEmployeeID; ?>][HDate]' id='HDate' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Employee ID</label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "SanrioEmployee[$current->SanrioEmployeeID][EmployeeID]")."</div>";?>
</div>
</div>
</div>