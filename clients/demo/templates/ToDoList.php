<div class='tableGroup'>
   <div class='boxHeading'> ToDoList ID: <?php print $current->ToDoListID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>To Do List</span><input type='text' name='ToDoList[<?php print $current->ToDoListID; ?>][ToDoList]' id='ToDoList' value='<?php print $current->ToDoList; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='ToDoList[<?php print $current->ToDoListID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Owner</span><input type='text' name='ToDoList[<?php print $current->ToDoListID; ?>][Owner]' id='Owner' value='<?php print $current->Owner; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Status</span><input type='text' name='ToDoList[<?php print $current->ToDoListID; ?>][Status]' id='Status' value='<?php print $current->Status; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Completed By</span><input type='text' name='ToDoList[<?php print $current->ToDoListID; ?>][CompletedBy]' id='CompletedBy' value='<?php print $current->CompletedBy; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Priority</span><input type='text' name='ToDoList[<?php print $current->ToDoListID; ?>][Priority]' id='Priority' value='<?php print $current->Priority; ?>' size='11' class='boxValue' /></div>
      </span>
   </div>
</div>