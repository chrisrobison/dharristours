<div class='tableGroup'>
   <div class='formHeading'>To Do ID: <?php print $current->ToDoID; ?></div>
   <div class='fieldcontainer'>
    <div id='emailOption' class='msg' ><input type='hidden' name='sendEmail' id='sendEmail' value='New' default='New' /></div>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>To Do</label><input type='text' dbtype='varchar(100)' name='ToDo[<?php print $current->ToDoID; ?>][ToDo]' id='ToDo' value='<?php print $current->ToDo; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Assigned To</label><?php $boss->db->addResource("Login");$arr = $boss->db->Login->getlist();print $boss->utility->buildSelect($arr, $current->Email, "Email", "Email", "ToDo[$current->ToDoID][AssignedTo]")."</div>";?>
         <div class='contentField'><label>Complete By Date</label><input type='text' dbtype='date' name='ToDo[<?php print $current->ToDoID; ?>][CompleteByDate]' id='CompleteByDate' value='<?php print $current->CompleteByDate; ?>' size='25' class='boxValue date' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Completed</label><select dbtype='tinyint(1)' name='ToDo[<?php print $current->ToDoID; ?>][Completed]' id='Completed'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->Completed; ?></select></div>
         <div class='contentField'><label>Priority</label><select dbtype='tinyint(1)' name='ToDo[<?php print $current->ToDoID; ?>][Priority]' id='Priority'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->Priority; ?></select></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='ToDo[<?php print $current->ToDoID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>
