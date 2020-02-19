<div class='tableGroup'>
   <h1 class='boxHeading'> ToDoList ID: <?php print $current->ToDoListID; ?></h1>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>To Do List</label><input type='text' dbtype='varchar(100)' name='ToDoList[<?php print $current->ToDoListID; ?>][ToDoList]' id='ToDoList' value='<?php print $current->ToDoList; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?></div>
         <div class='contentField'><label>Owner</label><input type='text' dbtype='varchar(50)' name='ToDoList[<?php print $current->ToDoListID; ?>][Owner]' id='Owner' value='<?php print $current->Owner; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Status</label><input type='text' dbtype='varchar(25)' name='ToDoList[<?php print $current->ToDoListID; ?>][Status]' id='Status' value='<?php print $current->Status; ?>' size='25' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Completed By</label><input type='text' dbtype='date' name='ToDoList[<?php print $current->ToDoListID; ?>][CompletedBy]' id='CompletedBy' value='<?php print $current->CompletedBy; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Priority</label><input type='text' dbtype='int(11)' name='ToDoList[<?php print $current->ToDoListID; ?>][Priority]' id='Priority' value='<?php print $current->Priority; ?>' size='11' class='boxValue' /></div>
</div>
         <div class='contentField'><label>Notes</label><textarea dbtype='text' name='ToDoList[<?php print $current->ToDoListID; ?>][Notes]' id='Notes' class='textBox'></textarea></div></div>
</div>