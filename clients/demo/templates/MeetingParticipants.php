<div class='tableGroup'>
   <div class='boxHeading'> MeetingParticipants ID: <?php print $current->MeetingParticipantsID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Meeting Participants</span><input type='text' name='MeetingParticipants[<?php print $current->MeetingParticipantsID; ?>][MeetingParticipants]' id='MeetingParticipants' value='<?php print $current->MeetingParticipants; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='MeetingParticipants[<?php print $current->MeetingParticipantsID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Role</span><input type='text' name='MeetingParticipants[<?php print $current->MeetingParticipantsID; ?>][Role]' id='Role' value='<?php print $current->Role; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Meeting Minutes ID</span><select name='MeetingParticipants[<?php print $current->MeetingParticipantsID; ?>][MeetingMinutesID]' id='MeetingParticipants[<?php print $current->MeetingParticipantsID; ?>][MeetingMinutesID]' class='genSelect'><option value='3'>Sanrio IT Opportunity Meeting  July 28, 2010</option></select></div>         <div class='contentField'><span class='fieldLabel'>Business ID</span><select name='MeetingParticipants[<?php print $current->MeetingParticipantsID; ?>][BusinessID]' id='MeetingParticipants[<?php print $current->MeetingParticipantsID; ?>][BusinessID]' class='genSelect'><option value='4'>Sanrio Inc.</option></select></div>      </span>
   </div>
</div>