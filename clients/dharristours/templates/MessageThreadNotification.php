<div class='tableGroup'>
   <div class='formHeading'>MessageThreadNotification ID: <?php print $current->MessageThreadNotificationID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Message Thread Notification</label><input type='text' dbtype='varchar(100)' name='MessageThreadNotification[<?php print $current->MessageThreadNotificationID; ?>][MessageThreadNotification]' id='MessageThreadNotification' value='<?php print $current->MessageThreadNotification; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='MessageThreadNotification[<?php print $current->MessageThreadNotificationID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>New Message Count</label><input type='text' dbtype='int(15)' name='MessageThreadNotification[<?php print $current->MessageThreadNotificationID; ?>][NewMessageCount]' id='NewMessageCount' value='<?php print $current->NewMessageCount; ?>' size='15' class='boxValue' /></div>
         <div class='contentField'><label>Recipient</label><input type='text' dbtype='int(15)' name='MessageThreadNotification[<?php print $current->MessageThreadNotificationID; ?>][Recipient]' id='Recipient' value='<?php print $current->Recipient; ?>' size='15' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Resource </label><?php $boss->db->addResource("Resource");$arr = $boss->db->Resource->getlist();print $boss->utility->buildSelect($arr, $current->ResourceID, "ResourceID", "Resource", "MessageThreadNotification[$current->MessageThreadNotificationID][ResourceID]")."</div>";?>
         <div class='contentField'><label>Resource Type</label><input type='text' dbtype='varchar(100)' name='MessageThreadNotification[<?php print $current->MessageThreadNotificationID; ?>][ResourceType]' id='ResourceType' value='<?php print $current->ResourceType; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>URL</label><input type='text' dbtype='varchar(100)' name='MessageThreadNotification[<?php print $current->MessageThreadNotificationID; ?>][URL]' id='URL' value='<?php print $current->URL; ?>' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='MessageThreadNotification[<?php print $current->MessageThreadNotificationID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>