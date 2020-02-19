<div class='tableGroup'>
   <div class='formHeading'>JobCal ID: <?php print $current->JobCalID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Job </label><?php $boss->db->addResource("Job");$arr = $boss->db->Job->getlist();print $boss->utility->buildSelect($arr, $current->JobID, "JobID", "Job", "JobCal[$current->JobCalID][JobID]")."</div>";?>
         <div class='contentField'><label>Job</label><input type='text' dbtype='int(11)' name='JobCal[<?php print $current->JobCalID; ?>][Job]' id='Job' value='' size='11' class='boxValue' /></div>
         <div class='contentField'><label>Employee</label><input type='text' dbtype='varchar(100)' name='JobCal[<?php print $current->JobCalID; ?>][Employee]' id='Employee' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Number Of Items</label><input type='text' dbtype='bigint(11)' name='JobCal[<?php print $current->JobCalID; ?>][NumberOfItems]' id='NumberOfItems' value='' size='11' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(150)' name='JobCal[<?php print $current->JobCalID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Start Date Time</label><input type='text' dbtype='datetime' name='JobCal[<?php print $current->JobCalID; ?>][StartDateTime]' id='StartDateTime' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Duration</label><input type='text' dbtype='bigint(10)' name='JobCal[<?php print $current->JobCalID; ?>][Duration]' id='Duration' value='' size='10' class='boxValue' /></div>
         <div class='contentField'><label>Login </label><?php $boss->db->addResource("Login");$arr = $boss->db->Login->getlist();print $boss->utility->buildSelect($arr, $current->LoginID, "LoginID", "Login", "JobCal[$current->JobCalID][LoginID]")."</div>";?>
         <div class='contentField'><label>Color</label><input type='text' dbtype='varchar(10)' name='JobCal[<?php print $current->JobCalID; ?>][Color]' id='Color' value='' size='10' class='boxValue' /></div>
</div>
</div>
</div>