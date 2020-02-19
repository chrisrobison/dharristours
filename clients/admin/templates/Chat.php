<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> Chat ID: <?php print $current->ChatID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Chat</label><textarea dbtype='text' name='Chat[<?php print $current->ChatID; ?>][Chat]' id='Chat' class='textBox'></textarea></div>
         <div class='contentField'><label>User ID</label><?php $boss->db->addResource("User");$arr = $boss->db->User->getlist();print $boss->utility->buildSelect($arr, $current->UserID, "UserID", "User", "Chat[$current->ChatID][UserID]")."</div>";?>
         <div class='contentField'><label>Sender ID</label><?php $boss->db->addResource("Sender");$arr = $boss->db->Sender->getlist();print $boss->utility->buildSelect($arr, $current->SenderID, "SenderID", "Sender", "Chat[$current->ChatID][SenderID]")."</div>";?>
         <div class='contentField'><label>Content Type</label><input type='text' dbtype='varchar(50)' name='Chat[<?php print $current->ChatID; ?>][ContentType]' id='ContentType' value='' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Notified</label><select dbtype='tinyint(1)' name='Chat[<?php print $current->ChatID; ?>][Notified]' id='Notified'><option value='0'>False</option><option value='1'>True</option></select></div>
</div>
</div>
</div>