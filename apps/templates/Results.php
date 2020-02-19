<div class='tableGroup'>
   <div class='formHeading'>Notify ID: <?php print $current->NotifyID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Notify</label><textarea dbtype='text' dbtype='text' name='Notify[<?php print $current->NotifyID; ?>][Notify]' id='Notify' value='<?php print $current->Notify; ?>' style='width:28em;' class='textBox'></textarea></div>
         <div class='contentField'><label>Name</label><input disabled='disabled' type='text' dbtype='varchar(100)' name='Notify[<?php print $current->NotifyID; ?>][Name]' id='Name' value='<?php print $current->Name; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Caller</label><input disabled='disabled' type='text' dbtype='varchar(100)' name='Notify[<?php print $current->NotifyID; ?>][Caller]' id='Caller' value='<?php print $current->Caller; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Caller Name</label><input disabled='disabled' type='text' dbtype='varchar(100)' name='Notify[<?php print $current->NotifyID; ?>][CallerName]' id='CallerName' value='<?php print $current->CallerName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Email</label><input disabled='disabled' type='text' dbtype='varchar(100)' name='Notify[<?php print $current->NotifyID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Voice</label><input disabled='disabled' type='text' dbtype='varchar(100)' name='Notify[<?php print $current->NotifyID; ?>][Voice]' id='Voice' value='<?php print $current->Voice; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>SMS</label><input disabled='disabled' type='text' dbtype='varchar(100)' name='Notify[<?php print $current->NotifyID; ?>][SMS]' id='SMS' value='<?php print $current->SMS; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>When</label><input disabled='disabled' type='text' dbtype='datetime' name='Notify[<?php print $current->NotifyID; ?>][When]' id='When' value='<?php print $current->When; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Until</label><input disabled='disabled' type='text' dbtype='datetime' name='Notify[<?php print $current->NotifyID; ?>][Until]' id='Until' value='<?php print $current->Until; ?>' size='25' class='boxValue date' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Max Attempts</label><input disabled='disabled' type='text' dbtype='int(15)' name='Notify[<?php print $current->NotifyID; ?>][MaxAttempts]' id='MaxAttempts' value='<?php print $current->MaxAttempts; ?>' size='15' class='boxValue' /></div>
         <div class='contentField'><label>Attempts</label><input disabled='disabled' type='text' dbtype='int(11)' name='Notify[<?php print $current->NotifyID; ?>][Attempts]' id='Attempts' value='<?php print $current->Attempts; ?>' size='11' class='boxValue' /></div>
         <div class='contentField'><label>Choice</label><input disabled='disabled' type='text' dbtype='varchar(500)' name='Notify[<?php print $current->NotifyID; ?>][Choice]' id='Choice' value='<?php print $current->Choice; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Response</label><input disabled='disabled' type='text' dbtype='varchar(100)' name='Notify[<?php print $current->NotifyID; ?>][Response]' id='Response' value='<?php print $current->Response; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Backup Voice</label><input disabled='disabled' type='text' dbtype='varchar(25)' name='Notify[<?php print $current->NotifyID; ?>][BackupVoice]' id='BackupVoice' value='<?php print $current->BackupVoice; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>ProcessID</label><input disabled='disabled' type='text' dbtype='varchar(100)' name='Notify[<?php print $current->NotifyID; ?>][ProcessID]' id='ProcessID' value='<?php print $current->ProcessID; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Remote</label><input disabled='disabled' type='text' dbtype='varchar(100)' name='Notify[<?php print $current->NotifyID; ?>][Remote]' id='Remote' value='<?php print $current->Remote; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>RemoteID</label><input disabled='disabled' type='text' dbtype='varchar(100)' name='Notify[<?php print $current->NotifyID; ?>][RemoteID]' id='RemoteID' value='<?php print $current->RemoteID; ?>' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea disabled='disabled' dbtype='text' name='Notify[<?php print $current->NotifyID; ?>][Notes]' id='Notes' style='width:28em;' class='textBox'></textarea></div></div>
</div>
