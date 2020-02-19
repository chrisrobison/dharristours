<div class='tableGroup'>
   <h1 class='boxHeading'> QA_Testing ID: <?php print $current->QA_TestingID; ?></h1>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>QA_Testing</label><input type='text' dbtype='varchar(100)' name='QA_Testing[<?php print $current->QA_TestingID; ?>][QA_Testing]' id='QA_Testing' value='' size='50' class='boxValue' /></div>

         <div class='contentField'><label>Sections ID</label><?php $boss->db->addResource("Sections");$arr = $boss->db->Sections->getlist();print $boss->utility->buildSelect($arr, $current->SectionsID, "SectionsID", "Sections", "QA_Testing[$current->QA_TestingID][SectionsID]")."</div>";?>
         <div class='contentField'><label>Action Performed</label><input type='text' dbtype='varchar(100)' name='QA_Testing[<?php print $current->QA_TestingID; ?>][ActionPerformed]' id='ActionPerformed' value='' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Approved</label><select dbtype='tinyint(1)' name='QA_Testing[<?php print $current->QA_TestingID; ?>][Approved]' id='Approved'><option value='0'>False</option><option value='1'>True</option></select></div>
         <div class='contentField'><label>Tester</label><?php $boss->db->addResource("Login");$arr = $boss->db->Login->getlist();print $boss->utility->buildSelect($arr, $current->LoginID, "LoginID", "Login", "QA_Testing[$current->QA_TestingID][Tester_LoginID]")."</div>";?>
         <div class='contentField'><label>Priority Issue</label><select dbtype='tinyint(1)' name='QA_Testing[<?php print $current->QA_TestingID; ?>][PriorityIssue]' id='PriorityIssue'><option value='0'>False</option><option value='1'>True</option></select></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='QA_Testing[<?php print $current->QA_TestingID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>