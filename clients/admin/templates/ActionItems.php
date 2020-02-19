<div class='tableGroup'>
   <h1 class='boxHeading'> MeetingActionItem ID: <?php print $current->MeetingActionItemID; ?></h1>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Meeting Action Item</label><input type='text' dbtype='varchar(100)' name='MeetingActionItem[<?php print $current->MeetingActionItemID; ?>][MeetingActionItem]' id='MeetingActionItem' value='<?php print $current->MeetingActionItem; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?></div>
         <div class='contentField'><label>Meeting Minutes ID</label><?php $boss->db->addResource("MeetingMinutes");$arr = $boss->db->MeetingMinutes->getlist();print $boss->utility->buildSelect($arr, $current->MeetingMinutesID, "MeetingMinutesID", "MeetingMinutes", "MeetingActionItem[$current->MeetingActionItemID][MeetingMinutesID]");?></div>
         <div class='contentField'><label>Responsible Party</label><input type='text' dbtype='varchar(150)' name='MeetingActionItem[<?php print $current->MeetingActionItemID; ?>][ResponsibleParty]' id='ResponsibleParty' value='<?php print $current->ResponsibleParty; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Due Date</label><input type='text' dbtype='varchar(25)' name='MeetingActionItem[<?php print $current->MeetingActionItemID; ?>][DueDate]' id='DueDate' value='<?php print $current->DueDate; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Business ID</label><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist();print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "MeetingActionItem[$current->MeetingActionItemID][BusinessID]");?></div>
</div>
         <div class='contentField'><label>Notes</label><textarea dbtype='text' name='MeetingActionItem[<?php print $current->MeetingActionItemID; ?>][Notes]' id='Notes' class='textBox'></textarea></div></div>
</div>