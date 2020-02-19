<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> Employee ID: <?php print $current->EmployeeID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Employee</label><input type='text' dbtype='varchar(100)' name='Employee[<?php print $current->EmployeeID; ?>][Employee]' id='Employee' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(100)' name='Employee[<?php print $current->EmployeeID; ?>][Email]' id='Email' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Alt Email</label><input type='text' dbtype='varchar(100)' name='Employee[<?php print $current->EmployeeID; ?>][AltEmail]' id='AltEmail' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>First Name</label><input type='text' dbtype='varchar(50)' name='Employee[<?php print $current->EmployeeID; ?>][FirstName]' id='FirstName' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Middle Name</label><input type='text' dbtype='varchar(25)' name='Employee[<?php print $current->EmployeeID; ?>][MiddleName]' id='MiddleName' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Last Name</label><input type='text' dbtype='varchar(50)' name='Employee[<?php print $current->EmployeeID; ?>][LastName]' id='LastName' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Title</label><input type='text' dbtype='varchar(100)' name='Employee[<?php print $current->EmployeeID; ?>][Title]' id='Title' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Department</label><input type='text' dbtype='varchar(50)' name='Employee[<?php print $current->EmployeeID; ?>][Department]' id='Department' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Pay Status</label><input type='text' dbtype='varchar(50)' name='Employee[<?php print $current->EmployeeID; ?>][PayStatus]' id='PayStatus' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Phone</label><input type='text' dbtype='varchar(25)' name='Employee[<?php print $current->EmployeeID; ?>][Phone]' id='Phone' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Cell</label><input type='text' dbtype='varchar(25)' name='Employee[<?php print $current->EmployeeID; ?>][Cell]' id='Cell' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Location</label><input type='text' dbtype='varchar(50)' name='Employee[<?php print $current->EmployeeID; ?>][Location]' id='Location' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Address</label><input type='text' dbtype='varchar(50)' name='Employee[<?php print $current->EmployeeID; ?>][Address]' id='Address' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>City</label><input type='text' dbtype='varchar(50)' name='Employee[<?php print $current->EmployeeID; ?>][City]' id='City' value='' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>State</label><input type='text' dbtype='char(2)' name='Employee[<?php print $current->EmployeeID; ?>][State]' id='State' value='' size='2' class='boxValue' /></div>
         <div class='contentField'><label>Zip</label><input type='text' dbtype='varchar(10)' name='Employee[<?php print $current->EmployeeID; ?>][Zip]' id='Zip' value='' size='10' class='boxValue' /></div>

         <div class='contentField'><label>Vacation Hours</label><input type='text' dbtype='decimal(7,2)' name='Employee[<?php print $current->EmployeeID; ?>][VacationHours]' id='VacationHours' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Sick Hours</label><input type='text' dbtype='decimal(7,2)' name='Employee[<?php print $current->EmployeeID; ?>][SickHours]' id='SickHours' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Rate</label><input type='text' dbtype='float unsigned' name='Employee[<?php print $current->EmployeeID; ?>][Rate]' id='Rate' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Birth Date</label><input type='text' dbtype='date' name='Employee[<?php print $current->EmployeeID; ?>][BirthDate]' id='BirthDate' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>SSN</label><input type='text' dbtype='char(9)' name='Employee[<?php print $current->EmployeeID; ?>][SSN]' id='SSN' value='' size='9' class='boxValue' /></div>
         <div class='contentField'><label>Year Salary</label><input type='text' dbtype='float unsigned' name='Employee[<?php print $current->EmployeeID; ?>][YearSalary]' id='YearSalary' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Active</label><select dbtype='tinyint(4)' name='Employee[<?php print $current->EmployeeID; ?>][Active]' id='Active'><option value='0'>False</option><option value='1'>True</option></select></div>
         <div class='contentField'><label>Commission</label><input type='text' dbtype='decimal(7,2)' name='Employee[<?php print $current->EmployeeID; ?>][Commission]' id='Commission' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Supervisor</label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "Employee[$current->EmployeeID][Supervisor_EmployeeID]")."</div>";?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='longtext' name='Employee[<?php print $current->EmployeeID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>