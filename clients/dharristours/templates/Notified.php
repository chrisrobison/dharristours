<div class='tableGroup'>
   <div class='formHeading'>Notified ID: <?php print $current->NotifiedID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Notify </label><?php $boss->db->addResource("Notify");$arr = $boss->db->Notify->getlist();print $boss->utility->buildSelect($arr, $current->NotifyID, "NotifyID", "Notify", "Notified[$current->NotifiedID][NotifyID]")."</div>";?>
         <div class='contentField'><label>Notified</label><input type='text' dbtype='varchar(500)' name='Notified[<?php print $current->NotifiedID; ?>][Notified]' id='Notified' value='<?php print $current->Notified; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Name</label><input type='text' dbtype='varchar(100)' name='Notified[<?php print $current->NotifiedID; ?>][Name]' id='Name' value='<?php print $current->Name; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Caller</label><input type='text' dbtype='varchar(100)' name='Notified[<?php print $current->NotifiedID; ?>][Caller]' id='Caller' value='<?php print $current->Caller; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Caller Name</label><input type='text' dbtype='varchar(100)' name='Notified[<?php print $current->NotifiedID; ?>][CallerName]' id='CallerName' value='<?php print $current->CallerName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(100)' name='Notified[<?php print $current->NotifiedID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Voice</label><input type='text' dbtype='varchar(100)' name='Notified[<?php print $current->NotifiedID; ?>][Voice]' id='Voice' value='<?php print $current->Voice; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>SMS</label><input type='text' dbtype='varchar(100)' name='Notified[<?php print $current->NotifiedID; ?>][SMS]' id='SMS' value='<?php print $current->SMS; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>When</label><input type='text' dbtype='datetime' name='Notified[<?php print $current->NotifiedID; ?>][When]' id='When' value='<?php print $current->When; ?>' size='25' class='boxValue date' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Max Attempts</label><input type='text' dbtype='int(15)' name='Notified[<?php print $current->NotifiedID; ?>][MaxAttempts]' id='MaxAttempts' value='<?php print $current->MaxAttempts; ?>' size='15' class='boxValue' /></div>
         <div class='contentField'><label>Attempts</label><input type='text' dbtype='int(15)' name='Notified[<?php print $current->NotifiedID; ?>][Attempts]' id='Attempts' value='<?php print $current->Attempts; ?>' size='15' class='boxValue' /></div>
         <div class='contentField'><label>Choice</label><input type='text' dbtype='varchar(500)' name='Notified[<?php print $current->NotifiedID; ?>][Choice]' id='Choice' value='<?php print $current->Choice; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Response</label><input type='text' dbtype='varchar(100)' name='Notified[<?php print $current->NotifiedID; ?>][Response]' id='Response' value='<?php print $current->Response; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Respondent</label><input type='text' dbtype='varchar(50)' name='Notified[<?php print $current->NotifiedID; ?>][Respondent]' id='Respondent' value='<?php print $current->Respondent; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Backup Voice</label><input type='text' dbtype='varchar(25)' name='Notified[<?php print $current->NotifiedID; ?>][BackupVoice]' id='BackupVoice' value='<?php print $current->BackupVoice; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Process </label><?php $boss->db->addResource("Process");$arr = $boss->db->Process->getlist();print $boss->utility->buildSelect($arr, $current->ProcessID, "ProcessID", "Process", "Notified[$current->NotifiedID][ProcessID]")."</div>";?>
         <div class='contentField'><label>Remote</label><input type='text' dbtype='varchar(100)' name='Notified[<?php print $current->NotifiedID; ?>][Remote]' id='Remote' value='<?php print $current->Remote; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Remote </label><?php $boss->db->addResource("Remote");$arr = $boss->db->Remote->getlist();print $boss->utility->buildSelect($arr, $current->RemoteID, "RemoteID", "Remote", "Notified[$current->NotifiedID][RemoteID]")."</div>";?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Notified[<?php print $current->NotifiedID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>