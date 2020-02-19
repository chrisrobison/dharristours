<div class='tableGroup'>
   <div class='formHeading'>Model ID: <?php print $current->ModelID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Model</label><input type='text' dbtype='varchar(100)' name='Model[<?php print $current->ModelID; ?>][Model]' id='Model' value='<?php print $current->Model; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Process </label><?php $boss->db->addResource("Process");$arr = $boss->db->Process->getlist();print $boss->utility->buildSelect($arr, $current->ProcessID, "ProcessID", "Process", "Model[$current->ModelID][ProcessID]")."</div>";?>
         <div class='contentField'><label>Resource</label><input type='text' dbtype='varchar(100)' name='Model[<?php print $current->ModelID; ?>][Resource]' id='Resource' value='<?php print $current->Resource; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Config</label><textarea dbtype='text' name='Model[<?php print $current->ModelID; ?>][Config]' id='Config' class='textBox'><?php print $current->Config; ?></textarea></div>
      </div>
      <div class='fieldcolumn'>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Login </label><?php $boss->db->addResource("Login");$arr = $boss->db->Login->getlist();print $boss->utility->buildSelect($arr, $current->LoginID, "LoginID", "Login", "Model[$current->ModelID][LoginID]")."</div>";?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Model[<?php print $current->ModelID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>