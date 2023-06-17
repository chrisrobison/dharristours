<div class='tableGroup'>
   <div class='formHeading'>Email ID: <?php print $current->EmailID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(100)' name='Email[<?php print $current->EmailID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Email[<?php print $current->EmailID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Subject</label><input type='text' dbtype='varchar(100)' name='Email[<?php print $current->EmailID; ?>][Subject]' id='Subject' value='<?php print $current->Subject; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Date</label><input type='text' dbtype='datetime' name='Email[<?php print $current->EmailID; ?>][Date]' id='Date' value='<?php print $current->Date; ?>' size='25' class='boxValue date' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Body</label><textarea dbtype='text' name='Email[<?php print $current->EmailID; ?>][Body]' id='Body' class='textBox'><?php print $current->Body; ?></textarea></div>
         <div class='contentField'><label>Headers</label><textarea dbtype='text' name='Email[<?php print $current->EmailID; ?>][Headers]' id='Headers' class='textBox'><?php print $current->Headers; ?></textarea></div>
         <div class='contentField'><label>To</label><input type='text' dbtype='varchar(100)' name='Email[<?php print $current->EmailID; ?>][To]' id='To' value='<?php print $current->To; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>From</label><input type='text' dbtype='varchar(100)' name='Email[<?php print $current->EmailID; ?>][From]' id='From' value='<?php print $current->From; ?>' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Email[<?php print $current->EmailID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>