<script language='Javascript' type='text/javascript'>
   var userEmail = '<?php print htmlspecialchars($_SESSION['Email'], ENT_QUOTES); ?>';

   function flagEmail(msgType) {
      $("#sendEmail").val(msgType);
   }

   function addDate(who) {
      who.value += "\n----\nUpdated by " + userEmail + "\n" + Date() + "\n----\n";
      flagEmail('Status');
   }
</script>
<input type='hidden' name='sendEmail' id='sendEmail' value='' />
<input type='hidden' name='AssignedBy' value='<?php print $_SESSION['Email']; ?>' />

<div class='tableGroup'>


   <div class='formHeading'><h1 class='boxHeading'> HelpDesk ID: <?php print $current->HelpDeskID; ?></h1></div>


   <div class='fieldcontainer'>


      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Status</label>
		<select onchange="flagEmail('Status')" name='HelpDesk[<?php print $current->HelpDeskID; ?>][RequestStatus]'  id='RequestStatus'><?php print $boss->utility->makeListOptions('Request Status', ''); ?></select></div>

         <div class='contentField'><label>Domain</label><input type='text' disabled='disabled' dbtype='varchar(100)' name='HelpDesk[<?php print $current->Domain; ?>][Domain]' id='Domain' value='' size='100' class='boxValue' /></div>

         <div class='contentField'><label>Account Type</label><input type='text' disabled='disabled' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][OnlineAcctType]' id='OnlineAcctType' value='' size='100' class='boxValue' /></div>

      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'>
            <label>Customer Name</label>
            <input type='text' disabled='disabled' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Name]' id='Name' value='' size='50' class='boxValue' />
         </div>
         <div class='contentField'>
            <label>Customer Number</label>
            <input type='text' dbtype='varchar(100)' disabled='disabled' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Number]' id='Number' value='' size='50' class='boxValue' />
         </div>
	</div>

         <div class='contentField'>
            <label>Online User</label>
            <input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][OnlineUser]' id='OnlineUser' value='' size='50' class='boxValue' />
         </div>

         <div class='contentField'>
            <label>Online Password</label>
            <input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][OnlinePasswd]' id='OnlinePasswd' value='' size='50' class='boxValue' />
         </div>
	 <div class='contentField'><label>Created by</label><span name='HelpDesk[][CreatedBy]' id='CreatedBy_display'></span>
	 
    <input type='text' disabled='disabled' id='CreatedBy' name='HelpDesk[<?php print $current->HelpDeskID; ?>][CreatedBy]' rel='data' value='<?php print $_SESSION['Email']; ?>' style='width:15em' /></div>

	 <div class='contentField'><label>Last Modified by</label><span id='LastModifiedBy_display'></span>
	 
    <input type='text' disabled='disabled' id='LastModifiedBy' name='HelpDesk[<?php print $current->HelpDeskID; ?>][LastModifiedBy]' rel='data' value='<?php print $_SESSION['Email']; ?>' style='width:15em' /></div>

         <div class='contentField'><label>Notes</label><textarea  dbtype='text' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Notes]' id='Notes' class='textBox'></textarea></div>

      </div>
   </div>
</div>
