<div class='tableGroup'>
   <div class='formHeading'>MessageThreads ID: <?php print $current->MessageThreadsID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Message Threads</label><input type='text' dbtype='varchar(100)' name='MessageThreads[<?php print $current->MessageThreadsID; ?>][MessageThreads]' id='MessageThreads' value='<?php print $current->MessageThreads; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='MessageThreads[<?php print $current->MessageThreadsID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Login </label><?php $boss->db->addResource("Login");$arr = $boss->db->Login->getlist();print $boss->utility->buildSelect($arr, $current->LoginID, "LoginID", "Login", "MessageThreads[$current->MessageThreadsID][LoginID]")."</div>";?>
         <div class='contentField'><label>Business </label><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist();print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "MessageThreads[$current->MessageThreadsID][BusinessID]")."</div>";?>
         <div class='contentField'><label>Job </label><?php $boss->db->addResource("Job");$arr = $boss->db->Job->getlist();print $boss->utility->buildSelect($arr, $current->JobID, "JobID", "Job", "MessageThreads[$current->MessageThreadsID][JobID]")."</div>";?>
         <div class='contentField'><label>Request </label><?php $boss->db->addResource("Request");$arr = $boss->db->Request->getlist();print $boss->utility->buildSelect($arr, $current->RequestID, "RequestID", "Request", "MessageThreads[$current->MessageThreadsID][RequestID]")."</div>";?>
         <div class='contentField'><label>Resource </label><?php $boss->db->addResource("Resource");$arr = $boss->db->Resource->getlist();print $boss->utility->buildSelect($arr, $current->ResourceID, "ResourceID", "Resource", "MessageThreads[$current->MessageThreadsID][ResourceID]")."</div>";?>
         <div class='contentField'><label>Resource Type</label><input type='text' dbtype='varchar(100)' name='MessageThreads[<?php print $current->MessageThreadsID; ?>][ResourceType]' id='ResourceType' value='<?php print $current->ResourceType; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Content</label><textarea dbtype='text' name='MessageThreads[<?php print $current->MessageThreadsID; ?>][Content]' id='Content' class='textBox'><?php print $current->Content; ?></textarea></div>
         <div class='contentField'><label>Read</label><select dbtype='tinyint(1)' name='MessageThreads[<?php print $current->MessageThreadsID; ?>][Read]' id='Read'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->Read; ?></select></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='MessageThreads[<?php print $current->MessageThreadsID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>