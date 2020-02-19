<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> Department ID: <?php print $current->DepartmentID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Department</label><input type='text' dbtype='varchar(50)' name='Department[<?php print $current->DepartmentID; ?>][Department]' id='Department' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Department No</label><input type='text' dbtype='int(4)' name='Department[<?php print $current->DepartmentID; ?>][DepartmentNo]' id='DepartmentNo' value='' size='4' class='boxValue' /></div>
         <div class='contentField'><label>Location</label><input type='text' dbtype='varchar(50)' name='Department[<?php print $current->DepartmentID; ?>][Location]' id='Location' value='' size='50' class='boxValue' /></div>

      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Head</label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "Department[$current->DepartmentID][Head_EmployeeID]")."</div>";?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Department[<?php print $current->DepartmentID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>