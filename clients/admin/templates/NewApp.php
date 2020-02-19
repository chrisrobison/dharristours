<div class='tableGroup'>
   <h1 class='boxHeading'> Action ID: <?php print $current->ActionID; ?></h1>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Process ID</label><?php $boss->db->addResource("Process");$arr = $boss->db->Process->getlist();print $boss->utility->buildSelect($arr, $current->ProcessID, "ProcessID", "Process", "Action[$current->ActionID][ProcessID]");?></div>
         <div class='contentField'><label>Action</label><input type='text' dbtype='varchar(75)' name='Action[<?php print $current->ActionID; ?>][Action]' id='Action' value='<?php print $current->Action; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Resource</label><input type='text' dbtype='varchar(75)' name='Action[<?php print $current->ActionID; ?>][Resource]' id='Resource' value='<?php print $current->Resource; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Template</label><input type='text' dbtype='varchar(75)' name='Action[<?php print $current->ActionID; ?>][Template]' id='Template' value='<?php print $current->Template; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>JS</label><input type='text' dbtype='varchar(200)' name='Action[<?php print $current->ActionID; ?>][JS]' id='JS' value='<?php print $current->JS; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Pre Condition</label><input type='text' dbtype='varchar(75)' name='Action[<?php print $current->ActionID; ?>][PreCondition]' id='PreCondition' value='<?php print $current->PreCondition; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Pre_Action</label><input type='text' dbtype='varchar(75)' name='Action[<?php print $current->ActionID; ?>][Pre_Action]' id='Pre_Action' value='<?php print $current->Pre_Action; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Pre Fail</label><input type='text' dbtype='varchar(75)' name='Action[<?php print $current->ActionID; ?>][PreFail]' id='PreFail' value='<?php print $current->PreFail; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Post Condition</label><input type='text' dbtype='varchar(75)' name='Action[<?php print $current->ActionID; ?>][PostCondition]' id='PostCondition' value='<?php print $current->PostCondition; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Post_Action</label><input type='text' dbtype='varchar(75)' name='Action[<?php print $current->ActionID; ?>][Post_Action]' id='Post_Action' value='<?php print $current->Post_Action; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Post Fail</label><input type='text' dbtype='varchar(75)' name='Action[<?php print $current->ActionID; ?>][PostFail]' id='PostFail' value='<?php print $current->PostFail; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Access</label><input type='text' dbtype='int(30)' name='Action[<?php print $current->ActionID; ?>][Access]' id='Access' value='<?php print $current->Access; ?>' size='30' class='boxValue' /></div>
         <div class='contentField'><label>Buttons</label><input type='text' dbtype='int(11)' name='Action[<?php print $current->ActionID; ?>][Buttons]' id='Buttons' value='<?php print $current->Buttons; ?>' size='11' class='boxValue' /></div>
      </div>
   </div>
</div>