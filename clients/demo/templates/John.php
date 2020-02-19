<div class='tableGroup'>
   <div class='boxHeading'> John ID: <?php print $current->JohnID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>John</span><input type='text' name='John[<?php print $current->JohnID; ?>][John]' id='John' value='<?php print $current->John; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='John[<?php print $current->JohnID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>To Do List ID</span><?php $boss->db->addResource("ToDoList");$arr = $boss->db->ToDoList->getlist();print $boss->utility->buildSelect($arr, $current->ToDoListID, "ToDoListID", "ToDoList", "John[$current->JohnID][ToDoListID]");?></div>
      </span>
   </div>
</div>