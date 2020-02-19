<div class='tableGroup'>
   <h1 class='boxHeading'> Message ID: <?php print $current->MessageID; ?></h1>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Message</label><input type='text' dbtype='varchar(100)' name='Message[<?php print $current->MessageID; ?>][Message]' id='Message' value='<?php print $current->Message; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Content</label><textarea dbtype='text' name='Message[<?php print $current->MessageID; ?>][Content]' id='Content' class='textBox'><?php print $current->Content; ?></textarea></div>
         <div class='contentField'><label>Reply To</label><input type='text' dbtype='varchar(75)' name='Message[<?php print $current->MessageID; ?>][ReplyTo]' id='ReplyTo' value='<?php print $current->ReplyTo; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Type</label><input type='text' dbtype='varchar(50)' name='Message[<?php print $current->MessageID; ?>][Type]' id='Type' value='<?php print $current->Type; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Process ID</label><?php $boss->db->addResource("Process");$arr = $boss->db->Process->getlist();print $boss->utility->buildSelect($arr, $current->ProcessID, "ProcessID", "Process", "Message[$current->MessageID][ProcessID]");?></div>
         <div class='contentField'><label>Condition</label><input type='text' dbtype='varchar(150)' name='Message[<?php print $current->MessageID; ?>][Condition]' id='Condition' value='<?php print $current->Condition; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Query</label><textarea dbtype='text' name='Message[<?php print $current->MessageID; ?>][Query]' id='Query' class='textBox'><?php print $current->Query; ?></textarea></div>
<?php print $current->Notes; ?></div>
</div>
         <div class='contentField'><label>Notes</label><textarea dbtype='text' name='Message[<?php print $current->MessageID; ?>][Notes]' id='Notes' class='textBox'></textarea></div></div>
</div>