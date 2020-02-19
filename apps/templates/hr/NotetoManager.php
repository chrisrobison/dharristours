<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> HR_NoteToSupervisor ID: <?php print $current->HR_NoteToSupervisorID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Note To Supervisor</label><input type='text' dbtype='varchar(100)' name='HR_NoteToSupervisor[<?php print $current->HR_NoteToSupervisorID; ?>][HR_NoteToSupervisor]' id='HR_NoteToSupervisor' value='' size='50' class='boxValue' /></div>

         <div class='contentField'><label>Supervisor ID</label><?php $boss->db->addResource("Supervisor");$arr = $boss->db->Supervisor->getlist();print $boss->utility->buildSelect($arr, $current->SupervisorID, "SupervisorID", "Supervisor", "HR_NoteToSupervisor[$current->HR_NoteToSupervisorID][SupervisorID]")."</div>";?>
         <div class='contentField'><label>Employee ID</label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "HR_NoteToSupervisor[$current->HR_NoteToSupervisorID][EmployeeID]")."</div>";?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='HR_NoteToSupervisor[<?php print $current->HR_NoteToSupervisorID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>