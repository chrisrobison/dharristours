<div class='tableGroup'>
   <div class='boxHeading'> Feedback ID: <?php print $current->FeedbackID; ?></div>
   <div class='fieldcontainer'>
         <div class='contentField'><span class='fieldLabel'>Feedback</span><input type='text' dbtype='varchar(100)' name='Feedback[<?php print $current->FeedbackID; ?>][Feedback]' id='Feedback' value='<?php print $current->Feedback; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Name</span><input type='text' dbtype='varchar(200)' name='Feedback[<?php print $current->FeedbackID; ?>][Name]' id='Name' value='<?php print $current->Name; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea dbtype='text' name='Feedback[<?php print $current->FeedbackID; ?>][Notes]' id='Notes' class='textBox'><?php print $current->Notes; ?></textarea></div>
   </div>
</div>
