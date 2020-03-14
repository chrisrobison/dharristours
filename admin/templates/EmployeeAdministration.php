<div class='tableGroup'>
   <div class='boxHeading'> Employee ID: <?php print $current->EmployeeID; ?></div>
   <input type='hidden' name='EmployeeID' value='<?php print $current->EmployeeID; ?>'/>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Employee</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][Employee]' id='Employee' value='<?php print $current->Employee; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>First Name</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][FirstName]' id='FirstName' value='<?php print $current->FirstName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Last Name</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][LastName]' id='LastName' value='<?php print $current->LastName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Title</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][Title]' id='Title' value='<?php print $current->Title; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Department</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][Department]' id='Department' value='<?php print $current->Department; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Supervisor</span>
	         <select name='ScheduleRequest[<?php print $current->ScheduleRequestID; ?>][SupervisorID]' id='SupervisorID' class='boxValue' >
               <option value=''>-- Select Supervisor --</option>
	            <?php
		            print $util->listEmployees($current->SupervisorID);
               ?>
            </select>
         </div>
         <div class='contentField'><span class='fieldLabel'>Pay Status</span><select name='Employee[<?php print $current->EmployeeID; ?>][PayStatus]' id='PayStatus' style='position:relative;z-index:99999;'>
               <option value='hourly'<?php print ($current->PayStatus=='hourly') ? ' SELECTED' : ''; ?>>Hourly</option>
               <option value='salary'<?php print ($current->PayStatus=='salary') ? ' SELECTED' : ''; ?>>Salary</option>
            </select>
         </div>
         <div class='contentField'><span class='fieldLabel'>Pay Rate</span> $<input type='text' name='Employee[<?php print $current->EmployeeID; ?>][Rate]' id='Rate' value='<?php print $current->Rate ; ?>' size='10' class='boxValue' style="width: 5em;" /> / hour</div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Hire Date</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][HireDate]' id='HireDate' value='<?php print $current->HireDate; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Leave Date</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][LeaveDate]' id='LeaveDate' value='<?php print $current->LeaveDate; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Office</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][Office]' id='Office' value='<?php print $current->Office; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Phone</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Extension</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][Extension]' id='Extension' value='<?php print $current->Extension; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Email</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Alt Email</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][AltEmail]' id='AltEmail' value='<?php print $current->AltEmail; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Active</span><input type='text' name='Employee[<?php print $current->EmployeeID; ?>][Active]' id='Active' value='<?php print $current->Active; ?>' size='5' class='boxValue' /></div>
      </span>
   </div>
</div>
