<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> ToDo ID: <?php print $current->ToDoID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>To Do</label><input type='text' dbtype='varchar(100)' name='ToDo[<?php print $current->ToDoID; ?>][ToDo]' id='ToDo' value='' size='50' class='boxValue' /></div>

         <div class='contentField'>         <div class='contentField'><label>Complete By Date</label><input type='text' dbtype='datetime' name='ToDo[<?php print $current->ToDoID; ?>][CompleteByDate]' id='CompleteByDate' value='' size='25' class='boxValue date' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Completed</label><select dbtype='tinyint(1)' name='ToDo[<?php print $current->ToDoID; ?>][Completed]' id='Completed'><option value='0'>False</option><option value='1'>True</option></select></div>
         <div class='contentField'><label>Priority</label><select dbtype='tinyint(1)' name='ToDo[<?php print $current->ToDoID; ?>][Priority]' id='Priority'><option value='0'>False</option><option value='1'>True</option></select></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='ToDo[<?php print $current->ToDoID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>