<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> HelpDesk ID: <?php print $current->HelpDeskID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Help Desk</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][HelpDesk]' id='HelpDesk' value='' size='50' class='boxValue' /></div>

         <div class='contentField'><label>Request Type</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][RequestType]' id='RequestType' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Request Status</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][RequestStatus]' id='RequestStatus' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Name</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Name]' id='Name' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Number</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Number]' id='Number' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Department</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Department]' id='Department' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Severity</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Severity]' id='Severity' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>User_Severity</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][User_Severity]' id='User_Severity' value='' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Category</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Category]' id='Category' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Owner</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Owner]' id='Owner' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Online Acct Type</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][OnlineAcctType]' id='OnlineAcctType' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Domain</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Domain]' id='Domain' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Online User</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][OnlineUser]' id='OnlineUser' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Online Passwd</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][OnlinePasswd]' id='OnlinePasswd' value='' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>