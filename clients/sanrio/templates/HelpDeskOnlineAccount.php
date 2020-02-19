<script language='Javascript' type='text/javascript'>
   var userEmail = '<?php print htmlspecialchars($_SESSION['Email'], ENT_QUOTES); ?>';

   function flagEmail(msgType) {
      $("#sendEmail").val(msgType);
   }
</script>
<input type='hidden' name='sendEmail' id='sendEmail' value='' />
<input type='hidden' name='HelpDesk[<?php print $current->HelpDeskID; ?>][AssignedBy]' id='AssignedBy' value='<?php print $_SESSION['Email']; ?>' />
<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> HelpDesk ID: <?php print $current->HelpDeskID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'>
            <label>Domain</label>
            <select onchange="flagEmail('11_New')" name='HelpDesk[<?php print $current->HelpDeskID; ?>][Domain]' id='Domain'><?php print $boss->utility->makeListOptions('Domain', ''); ?></select>
         </div>
         <div class='contentField'>
            <label>Account Type</label>
            <select name='HelpDesk[<?php print $current->HelpDeskID; ?>][OnlineAcctType]' id='OnlineAcctType'><?php print $boss->utility->makeListOptions('OnlineAcctType', ''); ?></select>
         </div>
         <div class='contentField'>
            <label>Customer Name</label>
            <input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Name]' id='Name' value='' size='50' class='boxValue' />
         </div>
         <div class='contentField'>
            <label>Customer Number</label>
            <input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Number]' id='Number' value='' size='50' class='boxValue' />
         </div>
         <div class='contentField'><label>Notes</label><textarea  dbtype='text' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Notes]' id='Notes' class='textBox'></textarea></div>
         <input type='hidden' dbtype='varchar(100)' rel='data' name='HelpDesk[<?php print $current->HelpDeskID; ?>][RequestType]' id='RequestType' value='Online Account' default='Online Account' />
         <input type='hidden' dbtype='varchar(100)' rel='data' name='HelpDesk[<?php print $current->HelpDeskID; ?>][RequestStatus]' id='RequestStatus' value='New' default='New' />
         <input type='hidden' dbtype='varchar(100)' rel='data' name='HelpDesk[<?php print $current->HelpDeskID; ?>][HelpDesk]' id='HelpDesk' value='Online Account: [<?php print $_SESSION['Email']; ?>] [<?php print date(DATE_RFC822); ?>]' default='Online Account: [<?php print $_SESSION['Email']; ?>] [<?php print date(DATE_RFC822); ?>]' />
      </div>
   </div>
</div>
