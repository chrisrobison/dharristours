<div class='tableGroup'>
   <div class='boxHeading'> Tracking ID: <?php print $current->TrackingID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Tracking</span><input type='text' name='Tracking[<?php print $current->TrackingID; ?>][Tracking]' id='Tracking' value='<?php print $current->Tracking; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='Tracking[<?php print $current->TrackingID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Duration</span><input type='text' name='Tracking[<?php print $current->TrackingID; ?>][Duration]' id='Duration' value='<?php print $current->Duration; ?>' size='11' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Job ID</span><?php $boss->db->addResource("Job");$arr = $boss->db->Job->getlist();print $boss->utility->buildSelect($arr, $current->JobID, "JobID", "Job", "Tracking[$current->TrackingID][JobID]");?></div>
      </span>
   </div>
</div>