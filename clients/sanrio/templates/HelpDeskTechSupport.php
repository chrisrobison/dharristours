<script language='Javascript' type='text/javascript'>
   var userEmail = '<?php print htmlspecialchars($_SESSION['Email'], ENT_QUOTES); ?>';

   function flagEmail(msgType) {
      $("input[name=sendEmail]").val(msgType);
   }
</script>

<input type='hidden' name='sendEmail' id='sendEmail' value='' />
<input type='hidden' name='AssignedBy' value='<?php print $_SESSION['Email']; ?>' />

<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> HelpDesk ID: <?php print $current->HelpDeskID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <input type='hidden' dbtype='varchar(100)' rel='data' name='HelpDesk[<?php print $current->HelpDeskID; ?>][RequestType]' id='RequestType' value='Tech Support' default='Tech Support' />
         <input type='hidden' dbtype='varchar(100)' rel='data' name='HelpDesk[<?php print $current->HelpDeskID; ?>][RequestStatus]' id='RequestStatus' value='New' default='New' />
         <input type='hidden' dbtype='varchar(100)' rel='data' name='HelpDesk[<?php print $current->HelpDeskID; ?>][HelpDesk]' id='HelpDesk' value='Support: [<?php print $_SESSION['Email']; ?>] [<?php print date(DATE_RFC822); ?>]' default='Support: [<?php print $_SESSION['Email']; ?>] [<?php print date(DATE_RFC822); ?>]' />
         <div class='contentField'>
            <label>Category</label>
            <select onchange="flagEmail('10_New')" name='HelpDesk[<?php print $current->HelpDeskID; ?>][Category]'	id='Category'><?php print $boss->utility->makeListOptions('Category', ''); ?></select>
         </div>
         <div class='contentField'>
            <label>Severity</label>		
            <select name='HelpDesk[<?php print $current->HelpDeskID; ?>][User_Severity]' id='User_Severity'><?php print $boss->utility->makeListOptions('Severity', ''); ?></select>
         </div>
         <div class='contentField'>
            <label>Describe Problem</label>
            <textarea dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Description]' id='Description' class='textBox'></textarea>
         </div>
         <div class='contentField'>
            <label>Notes</label>
            <textarea rel='data' dbtype='text' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Notes]' id='Notes' class='textBox'></textarea>
         </div>
         <div class='contentField'>
            <label>Upload Image</label>
            <input type="file" name="uploadFile" id="uploadFile" />
         </div>
         <img src="<?php print $current->ScreenShot; ?>" id="ScreenShot" name="HelpDesk[<?php print $current->HelpDeskID; ?>][ScreenShot]" />
      </div>
   </div>
</div>
<script type='text/javascript'>
$(function() { var sform = $("#simpleForm"); if (sform.length) sform.attr({ enctype: "multipart/form-data",  target:"uploadFrame" }); });
</script>
