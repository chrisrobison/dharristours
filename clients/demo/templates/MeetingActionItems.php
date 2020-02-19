<div class='tableGroup'>
   <div class='boxHeading'> MeetingActionItem ID: <?php print $current->MeetingActionItemID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Meeting Action Item</span><input type='text' name='MeetingActionItem[<?php print $current->MeetingActionItemID; ?>][MeetingActionItem]' id='MeetingActionItem' value='<?php print $current->MeetingActionItem; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='MeetingActionItem[<?php print $current->MeetingActionItemID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Meeting Minutes ID</span><select name='MeetingActionItem[<?php print $current->MeetingActionItemID; ?>][MeetingMinutesID]' id='MeetingActionItem[<?php print $current->MeetingActionItemID; ?>][MeetingMinutesID]' class='genSelect'><option value='3'>Sanrio IT Opportunity Meeting  July 28, 2010</option></select></div>         <div class='contentField'><span class='fieldLabel'>Responsible Party</span><input type='text' name='MeetingActionItem[<?php print $current->MeetingActionItemID; ?>][ResponsibleParty]' id='ResponsibleParty' value='<?php print $current->ResponsibleParty; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Due Date</span><input type='text' name='MeetingActionItem[<?php print $current->MeetingActionItemID; ?>][DueDate]' id='DueDate' value='<?php print $current->DueDate; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Business ID</span><select name='MeetingActionItem[<?php print $current->MeetingActionItemID; ?>][BusinessID]' id='MeetingActionItem[<?php print $current->MeetingActionItemID; ?>][BusinessID]' class='genSelect'><option value='4'>Sanrio Inc.</option></select></div>      </span>
   </div>
</div>