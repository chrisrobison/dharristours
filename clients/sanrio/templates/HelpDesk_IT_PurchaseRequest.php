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
         <div class='contentField'><label>Status: </label>
		<select onchange="flagEmail('Status')" name='HelpDesk[<?php print $current->HelpDeskID; ?>][RequestStatus]'  id='RequestStatus'><?php print $boss->utility->makeListOptions('Request Status', ''); ?></select></div>

	 <div class='contentField'><label>Label:</label><span name='HelpDesk[][HelpDesk]' id='HelpDesk'></span>
	 <div class='contentField'><label>Category:</label><span name='HelpDesk[][Category]' id='Category'></span>
	 <div class='contentField'><label>Description:</label><span name='HelpDesk[][Description]' id='Description'></span>
	 <div class='contentField'><label>User Severity:</label><span name='HelpDesk[][User_Severity]' id='User_Severity'></span>
    

         <div class='contentField'><label>IT Severity</label>
		<select onchange="flagEmail('Updated')" name='HelpDesk[<?php print $current->HelpDeskID; ?>][Severity]'  id='Severity'><?php print $boss->utility->makeListOptions('Severity', ''); ?></select></div>


      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Assigned To: </label>
		<select onchange="flagEmail('Assign')" name='HelpDesk[<?php print $current->HelpDeskID; ?>][Owner]'  id='Owner'><?php print $boss->utility->makeListOptions('Assigned To', ''); ?></select></div>


         	<input type='hidden' dbtype='int(15)' rel='data' name='HelpDesk[<?php print $current->HelpDeskID; ?>][RequestTypeID]' id='RequestTypeID' value='1' default='1' />

	 <div class='contentField'><label>Last Modified by:</label><span name='HelpDesk[][LastModifiedBy]' id='LastModifiedBy'></span>
	 
    <input type='hidden' name='HelpDesk[<?php print $current->HelpDeskID; ?>][LastModifiedBy]' rel='data' value='<?php print $_SESSION['Email']; ?>' style='width:15em' /></div>

         <div class='contentField'><label>Notes:</label><textarea  dbtype='text' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Notes]' id='Notes' class='textBox'></textarea></div>

      </div>
   </div>
</div>
