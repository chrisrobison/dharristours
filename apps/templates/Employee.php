<div class='tableGroup'>
   <div class='formHeading'>Employee ID: <?php print $current->EmployeeID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
      <fieldset class='jobstatus' title="Org">
         <legend>Org</legend>
         <div class='contentField'><label>Supervisor</label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Supervisor_Employee", "Employee[$current->EmployeeID][Supervisor_EmployeeID]")."</div>";?>
         <div class='contentField'><label>Business </label><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist();print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "Employee[$current->EmployeeID][BusinessID]")."</div>";?>
      </fieldset>
      <fieldset class='jobstatus' title="General">
         <legend>General Information</legend>
         <div class='contentField'><label>Full Name</label><input type='text' dbtype='varchar(100)' name='Employee[<?php print $current->EmployeeID; ?>][Employee]' id='Employee' value='<?php print $current->Employee; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Active</label><select dbtype='tinyint(4)' name='Employee[<?php print $current->EmployeeID; ?>][Active]' id='Active'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->Active; ?></select></div>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(100)' name='Employee[<?php print $current->EmployeeID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Alt Email</label><input type='text' dbtype='varchar(100)' name='Employee[<?php print $current->EmployeeID; ?>][AltEmail]' id='AltEmail' value='<?php print $current->AltEmail; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>First Name</label><input type='text' dbtype='varchar(50)' name='Employee[<?php print $current->EmployeeID; ?>][FirstName]' id='FirstName' value='<?php print $current->FirstName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Middle Name</label><input type='text' dbtype='varchar(25)' name='Employee[<?php print $current->EmployeeID; ?>][MiddleName]' id='MiddleName' value='<?php print $current->MiddleName; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Last Name</label><input type='text' dbtype='varchar(50)' name='Employee[<?php print $current->EmployeeID; ?>][LastName]' id='LastName' value='<?php print $current->LastName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Phone</label><input type='text' dbtype='varchar(25)' name='Employee[<?php print $current->EmployeeID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Cell</label><input type='text' dbtype='varchar(25)' name='Employee[<?php print $current->EmployeeID; ?>][Cell]' id='Cell' value='<?php print $current->Cell; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Fax</label><input type='text' dbtype='varchar(25)' name='Employee[<?php print $current->EmployeeID; ?>][Fax]' id='Fax' value='<?php print $current->Fax; ?>' size='25' class='boxValue' /></div>
      </fieldset>
      <fieldset class='jobstatus' title="Mailing">
         <legend>Mailing</legend>
         <div class='contentField'><label>Location</label><input type='text' dbtype='varchar(50)' name='Employee[<?php print $current->EmployeeID; ?>][Location]' id='Location' value='<?php print $current->Location; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Address</label><input type='text' dbtype='varchar(50)' name='Employee[<?php print $current->EmployeeID; ?>][Address]' id='Address' value='<?php print $current->Address; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>City</label><input type='text' dbtype='varchar(50)' name='Employee[<?php print $current->EmployeeID; ?>][City]' id='City' value='<?php print $current->City; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>State</label><input type='text' dbtype='char(2)' name='Employee[<?php print $current->EmployeeID; ?>][State]' id='State' value='<?php print $current->State; ?>' size='2' class='boxValue' /></div>
         <div class='contentField'><label>Zip</label><input type='text' dbtype='varchar(10)' name='Employee[<?php print $current->EmployeeID; ?>][Zip]' id='Zip' value='<?php print $current->Zip; ?>' size='10' class='boxValue' /></div>
      </fieldset>
      </div>
      <div class='fieldcolumn'>
      <fieldset class='jobstatus' title="Payroll">
         <legend>Payroll</legend>
         <div class='contentField'><label>Title</label><input type='text' dbtype='varchar(100)' name='Employee[<?php print $current->EmployeeID; ?>][Title]' id='Title' value='<?php print $current->Title; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Department</label><input type='text' dbtype='varchar(50)' name='Employee[<?php print $current->EmployeeID; ?>][Department]' id='Department' value='<?php print $current->Department; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Pay Status</label><input type='text' dbtype='varchar(50)' name='Employee[<?php print $current->EmployeeID; ?>][PayStatus]' id='PayStatus' value='<?php print $current->PayStatus; ?>' size='50' default="hourly" class='boxValue' /></div>
         <div class='contentField'><label>Rate</label><input type='text' dbtype='float unsigned' name='Employee[<?php print $current->EmployeeID; ?>][Rate]' id='Rate' value='<?php print $current->Rate; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Vacation Hours</label><input type='text' dbtype='decimal(7,2)' name='Employee[<?php print $current->EmployeeID; ?>][VacationHours]' id='VacationHours' value='<?php print $current->VacationHours; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Sick Hours</label><input type='text' dbtype='decimal(7,2)' name='Employee[<?php print $current->EmployeeID; ?>][SickHours]' id='SickHours' value='<?php print $current->SickHours; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Birth Date</label><input type='text' dbtype='date' name='Employee[<?php print $current->EmployeeID; ?>][BirthDate]' id='BirthDate' value='<?php print $current->BirthDate; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>SSN</label><input type='text' dbtype='char(9)' name='Employee[<?php print $current->EmployeeID; ?>][SSN]' id='SSN' value='<?php print $current->SSN; ?>' size='9' class='boxValue' /></div>
         <div class='contentField'><label>Year Salary</label><input type='text' dbtype='float unsigned' name='Employee[<?php print $current->EmployeeID; ?>][YearSalary]' id='YearSalary' value='<?php print $current->YearSalary; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Commission</label><input type='text' dbtype='decimal(7,2)' name='Employee[<?php print $current->EmployeeID; ?>][Commission]' id='Commission' value='<?php print $current->Commission; ?>' size='50' class='boxValue' /></div>
      </fieldset>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='longtext' name='Employee[<?php print $current->EmployeeID; ?>][Notes]' id='Notes' style='width:38em;' class='textBox'></textarea></div></div>
</div>
