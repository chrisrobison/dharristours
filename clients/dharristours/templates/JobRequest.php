<div class='tableGroup'>
   <div class='boxHeading'> JobRequest ID: <?php print $current->JobRequestID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Job Request</span><input type='text' name='JobRequest[<?php print $current->JobRequestID; ?>][JobRequest]' id='JobRequest' value='<?php print $current->JobRequest; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='JobRequest[<?php print $current->JobRequestID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Name</span><input type='text' name='JobRequest[<?php print $current->JobRequestID; ?>][Name]' id='Name' value='<?php print $current->Name; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Phone</span><input type='text' name='JobRequest[<?php print $current->JobRequestID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Pickup Location</span><input type='text' name='JobRequest[<?php print $current->JobRequestID; ?>][PickupLocation]' id='PickupLocation' value='<?php print $current->PickupLocation; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Dropoff Location</span><input type='text' name='JobRequest[<?php print $current->JobRequestID; ?>][DropoffLocation]' id='DropoffLocation' value='<?php print $current->DropoffLocation; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Final Dropoff Location</span><input type='text' name='JobRequest[<?php print $current->JobRequestID; ?>][FinalDropoffLocation]' id='FinalDropoffLocation' value='<?php print $current->FinalDropoffLocation; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Start Date</span><input type='text' name='JobRequest[<?php print $current->JobRequestID; ?>][StartDate]' id='StartDate' value='<?php print $current->StartDate; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Start Time</span><input type='text' name='JobRequest[<?php print $current->JobRequestID; ?>][StartTime]' id='StartTime' value='<?php print $current->StartTime; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>End Time</span><input type='text' name='JobRequest[<?php print $current->JobRequestID; ?>][EndTime]' id='EndTime' value='<?php print $current->EndTime; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Passengers</span><input type='password' name='JobRequest[<?php print $current->JobRequestID; ?>][Passengers]' id='Passengers' value='<?php print $current->Passengers; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Email</span><input type='text' name='JobRequest[<?php print $current->JobRequestID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
      </span>
   </div>
</div>