<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> NewHire ID: <?php print $current->NewHireID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>New Hire</label><input type='text' dbtype='varchar(100)' name='NewHire[<?php print $current->NewHireID; ?>][NewHire]' id='NewHire' value='' size='50' class='boxValue' /></div>

         <div class='contentField'><label>Employee Num</label><input type='text' dbtype='varchar(100)' name='NewHire[<?php print $current->NewHireID; ?>][EmployeeNum]' id='EmployeeNum' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>First Name</label><input type='text' dbtype='varchar(100)' name='NewHire[<?php print $current->NewHireID; ?>][FirstName]' id='FirstName' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Dental Plan</label><input type='text' dbtype='varchar(100)' name='NewHire[<?php print $current->NewHireID; ?>][DentalPlan]' id='DentalPlan' value='' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Medical Plan</label><input type='text' dbtype='varchar(100)' name='NewHire[<?php print $current->NewHireID; ?>][MedicalPlan]' id='MedicalPlan' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>PTO</label><input type='text' dbtype='varchar(100)' name='NewHire[<?php print $current->NewHireID; ?>][PTO]' id='PTO' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Employee ID</label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "NewHire[$current->NewHireID][EmployeeID]")."</div>";?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='NewHire[<?php print $current->NewHireID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>