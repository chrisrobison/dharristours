<div class='tableGroup'>
   <h1 class='boxHeading'> Model ID: <?php print $current->ModelID; ?></h1>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Model</label><input type='text' dbtype='varchar(100)' name='Model[<?php print $current->ModelID; ?>][Model]' id='Model' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Process ID</label><?php $boss->db->addResource("Process");$arr = $boss->db->Process->getlist();print $boss->utility->buildSelect($arr, $current->ProcessID, "ProcessID", "Process", "Model[$current->ModelID][ProcessID]")."</div>";?>
         <div class='contentField'><label>Resource</label><input type='text' dbtype='varchar(100)' name='Model[<?php print $current->ModelID; ?>][Resource]' id='Resource' value='' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Config</label><textarea dbtype='text' name='Model[<?php print $current->ModelID; ?>][Config]' id='Config' class='textBox'></textarea></div>

</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Model[<?php print $current->ModelID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>