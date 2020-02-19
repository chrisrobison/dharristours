<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> Employee ID: <?php print $current->EmployeeID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Employee</label><input type='text' dbtype='varchar(100)' name='Employee[<?php print $current->EmployeeID; ?>][Employee]' id='Employee' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(100)' name='Employee[<?php print $current->EmployeeID; ?>][Email]' id='Email' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>First Name</label><input type='text' dbtype='varchar(50)' name='Employee[<?php print $current->EmployeeID; ?>][FirstName]' id='FirstName' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Last Name</label><input type='text' dbtype='varchar(50)' name='Employee[<?php print $current->EmployeeID; ?>][LastName]' id='LastName' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Title</label><input type='text' dbtype='varchar(100)' name='Employee[<?php print $current->EmployeeID; ?>][Title]' id='Title' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Phone</label><input type='text' dbtype='varchar(25)' name='Employee[<?php print $current->EmployeeID; ?>][Phone]' id='Phone' value='' size='25' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Location</label><input type='text' dbtype='varchar(50)' name='Employee[<?php print $current->EmployeeID; ?>][Location]' id='Location' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Active</label><select dbtype='tinyint(4)' name='Employee[<?php print $current->EmployeeID; ?>][Active]' id='Active'><option value='0'>False</option><option value='1'>True</option></select></div>
         <div class='contentField'><label>Supervisor</label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "Employee[$current->EmployeeID][Supervisor_EmployeeID]")."</div>";?>
         <div class='contentField'><label>Employee Num</label><input type='text' dbtype='varchar(100)' name='Employee[<?php print $current->EmployeeID; ?>][EmployeeNum]' id='EmployeeNum' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Hire Date</label><input type='text' dbtype='date' name='Employee[<?php print $current->EmployeeID; ?>][HireDate]' id='HireDate' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Term Date</label><input type='text' dbtype='datetime' name='Employee[<?php print $current->EmployeeID; ?>][TermDate]' id='TermDate' value='' size='25' class='boxValue date' /></div>
</div>
</div>
</div>