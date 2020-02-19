<div class='tableGroup'>
   <div class='formHeading'>HelpDesk ID: <?php print $current->HelpDeskID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Help Desk</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][HelpDesk]' id='HelpDesk' value='<?php print $current->HelpDesk; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Request Type</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][RequestType]' id='RequestType' value='<?php print $current->RequestType; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Request Status</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][RequestStatus]' id='RequestStatus' value='<?php print $current->RequestStatus; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Name</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Name]' id='Name' value='<?php print $current->Name; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Number</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Number]' id='Number' value='<?php print $current->Number; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Department</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Department]' id='Department' value='<?php print $current->Department; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Severity</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Severity]' id='Severity' value='<?php print $current->Severity; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>User_Severity</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][User_Severity]' id='User_Severity' value='<?php print $current->User_Severity; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Category</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Category]' id='Category' value='<?php print $current->Category; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Owner</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Owner]' id='Owner' value='<?php print $current->Owner; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Online Acct Type</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][OnlineAcctType]' id='OnlineAcctType' value='<?php print $current->OnlineAcctType; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Domain</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Domain]' id='Domain' value='<?php print $current->Domain; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Online User</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][OnlineUser]' id='OnlineUser' value='<?php print $current->OnlineUser; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Online Passwd</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][OnlinePasswd]' id='OnlinePasswd' value='<?php print $current->OnlinePasswd; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Screen Shot</label><input type='text' dbtype='varchar(200)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][ScreenShot]' id='ScreenShot' value='<?php print $current->ScreenShot; ?>' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>