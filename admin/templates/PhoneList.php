<div class='tableGroup'>
   <div class='boxHeading'> Employee ID: <?php print $current->EmployeeID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Employee</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][Employee]' id='Employee' value='<?php print $current->Employee; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>First Name</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][FirstName]' id='FirstName' value='<?php print $current->FirstName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Last Name</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][LastName]' id='LastName' value='<?php print $current->LastName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Title</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][Title]' id='Title' value='<?php print $current->Title; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Department</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][Department]' id='Department' value='<?php print $current->Department; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Pay Status</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][PayStatus]' id='PayStatus' value='<?php print $current->PayStatus; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Job Status</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][JobStatus]' id='JobStatus' value='<?php print $current->JobStatus; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Office Status</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][OfficeStatus]' id='OfficeStatus' value='<?php print $current->OfficeStatus; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Hire Date</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][HireDate]' id='HireDate' value='<?php print $current->HireDate; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Leave Date</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][LeaveDate]' id='LeaveDate' value='<?php print $current->LeaveDate; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Office</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][Office]' id='Office' value='<?php print $current->Office; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Phone</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Extension</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][Extension]' id='Extension' value='<?php print $current->Extension; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Email</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Alt Email</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][AltEmail]' id='AltEmail' value='<?php print $current->AltEmail; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Location</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][Location]' id='Location' value='<?php print $current->Location; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='Employee[<?php print $current->EmployeeID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
   </div>
</div>