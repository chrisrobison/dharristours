<div class='tableGroup'>
   <div class='boxHeading'> School ID: <?php print $current->SchoolID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>School</span><input type='text' name='School[<?php print $current->SchoolID; ?>][School]' id='School' value='<?php print $current->School; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='School[<?php print $current->SchoolID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Job ID</span><?php $boss->db->addResource("Job");$arr = $boss->db->Job->getlist();print $boss->utility->buildSelect($arr, $current->JobID, "JobID", "Job", "School[$current->SchoolID][JobID]");?></div>
      </span>
   </div>
</div>