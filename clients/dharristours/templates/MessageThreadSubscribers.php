<div class='tableGroup'>
   <div class='formHeading'>MessageThreadSubscribers ID: <?php print $current->MessageThreadSubscribersID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Message Thread Subscribers</label><input type='text' dbtype='varchar(100)' name='MessageThreadSubscribers[<?php print $current->MessageThreadSubscribersID; ?>][MessageThreadSubscribers]' id='MessageThreadSubscribers' value='<?php print $current->MessageThreadSubscribers; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='MessageThreadSubscribers[<?php print $current->MessageThreadSubscribersID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Resource </label><?php $boss->db->addResource("Resource");$arr = $boss->db->Resource->getlist();print $boss->utility->buildSelect($arr, $current->ResourceID, "ResourceID", "Resource", "MessageThreadSubscribers[$current->MessageThreadSubscribersID][ResourceID]")."</div>";?>
         <div class='contentField'><label>Resource Type</label><input type='text' dbtype='varchar(100)' name='MessageThreadSubscribers[<?php print $current->MessageThreadSubscribersID; ?>][ResourceType]' id='ResourceType' value='<?php print $current->ResourceType; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Subscriber</label><input type='text' dbtype='int(15)' name='MessageThreadSubscribers[<?php print $current->MessageThreadSubscribersID; ?>][Subscriber]' id='Subscriber' value='<?php print $current->Subscriber; ?>' size='15' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='MessageThreadSubscribers[<?php print $current->MessageThreadSubscribersID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>