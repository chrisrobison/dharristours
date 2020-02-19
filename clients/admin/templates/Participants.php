<div class='tableGroup'>
   <div class='boxHeading'> Participants ID: <?php print $current->ParticipantsID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Participants</span><input type='text' name='Participants[<?php print $current->ParticipantsID; ?>][Participants]' id='Participants' value='<?php print $current->Participants; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='Participants[<?php print $current->ParticipantsID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Role</span><input type='text' name='Participants[<?php print $current->ParticipantsID; ?>][Role]' id='Role' value='<?php print $current->Role; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Meeting Minutes ID</span><select name='Participants[<?php print $current->ParticipantsID; ?>][MeetingMinutesID]' id='Participants[<?php print $current->ParticipantsID; ?>][MeetingMinutesID]' class='genSelect'><option value='1'>Sanrio July 28, 2010</option></select></div>      </span>
   </div>
</div>