<div class='tableGroup'>
   <div class='formHeading'>Employment ID: <?php print $current->EmploymentID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Employment</label><input type='text' dbtype='varchar(100)' name='Employment[<?php print $current->EmploymentID; ?>][Employment]' id='Employment' value='<?php print $current->Employment; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Employment[<?php print $current->EmploymentID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Company</label><input type='text' dbtype='varchar(100)' name='Employment[<?php print $current->EmploymentID; ?>][Company]' id='Company' value='<?php print $current->Company; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Job Title</label><input type='text' dbtype='varchar(100)' name='Employment[<?php print $current->EmploymentID; ?>][JobTitle]' id='JobTitle' value='<?php print $current->JobTitle; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Project</label><input type='text' dbtype='varchar(100)' name='Employment[<?php print $current->EmploymentID; ?>][Project]' id='Project' value='<?php print $current->Project; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Role</label><input type='text' dbtype='varchar(100)' name='Employment[<?php print $current->EmploymentID; ?>][Role]' id='Role' value='<?php print $current->Role; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Purpose</label><input type='text' dbtype='varchar(100)' name='Employment[<?php print $current->EmploymentID; ?>][Purpose]' id='Purpose' value='<?php print $current->Purpose; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Awards Certs</label><input type='text' dbtype='varchar(100)' name='Employment[<?php print $current->EmploymentID; ?>][AwardsCerts]' id='AwardsCerts' value='<?php print $current->AwardsCerts; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Documentation</label><input type='file' dbtype='blob' name='Employment[<?php print $current->EmploymentID; ?>][Documentation]' id='Documentation' class='boxValue'><?php print $current->Documentation; ?></div>
         <div class='contentField'><label>URL</label><input type='text' dbtype='varchar(100)' name='Employment[<?php print $current->EmploymentID; ?>][URL]' id='URL' value='<?php print $current->URL; ?>' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Employment[<?php print $current->EmploymentID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>