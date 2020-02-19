<div class='tableGroup'>
   <div class='boxHeading'> Component ID: <?php print $current->ComponentID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Component</span><input type='text' name='Component[<?php print $current->ComponentID; ?>][Component]' id='Component' value='<?php print $current->Component; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Type</span><input type='text' name='Component[<?php print $current->ComponentID; ?>][Type]' id='Type' value='<?php print $current->Type; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Class</span><input type='text' name='Component[<?php print $current->ComponentID; ?>][Class]' id='Class' value='<?php print $current->Class; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Banner</span><input type='text' name='Component[<?php print $current->ComponentID; ?>][Banner]' id='Banner' value='<?php print $current->Banner; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Src</span><input type='text' name='Component[<?php print $current->ComponentID; ?>][Src]' id='Src' value='<?php print $current->Src; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Tag</span><input type='text' name='Component[<?php print $current->ComponentID; ?>][Tag]' id='Tag' value='<?php print $current->Tag; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Title</span><input type='text' name='Component[<?php print $current->ComponentID; ?>][Title]' id='Title' value='<?php print $current->Title; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Creative ID</span><?php $boss->db->addResource("Creative");$arr = $boss->db->Creative->getlist();print $boss->utility->buildSelect($arr, $current->CreativeID, "CreativeID", "Creative", "Component[$current->ComponentID][CreativeID]");?></div>
      </span>
         <div class='contentField'><span class='fieldLabel'>Content</span><textarea name='Component[<?php print $current->ComponentID; ?>][Content]' id='Content' class='textBox' style='width:41em;height:5em;'><?php print $current->Content; ?></textarea></div>
      <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='Component[<?php print $current->ComponentID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
   </div>
</div>
