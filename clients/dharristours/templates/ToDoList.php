<div class='tableGroup'>
   <div class='formHeading'>ToDo ID: <?php print $current->ToDoID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>To Do</label><input type='text' dbtype='varchar(100)' name='ToDo[<?php print $current->ToDoID; ?>][ToDo]' id='ToDo' value='' size='50' class='boxValue' /></div>

         <div class='contentField'><label>Assigned To</label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "ToDo[$current->ToDoID][AssignedTo_EmployeeID]")."</div>";?>
         <div class='contentField'><label>Complete By Date</label><input type='text' dbtype='datetime' name='ToDo[<?php print $current->ToDoID; ?>][CompleteByDate]' id='CompleteByDate' value='' size='25' class='boxValue date' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Completed</label><select dbtype='tinyint(1)' name='ToDo[<?php print $current->ToDoID; ?>][Completed]' id='Completed'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Priority</label><select dbtype='tinyint(1)' name='ToDo[<?php print $current->ToDoID; ?>][Priority]' id='Priority'><option value='0'>No</option><option value='1'>Yes</option></select></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='ToDo[<?php print $current->ToDoID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>