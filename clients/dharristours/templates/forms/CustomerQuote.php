<script language='Javascript' type='text/javascript'>
  var userEmail = '<?php print htmlspecialchars($_SESSION['Email'], ENT_QUOTES); ?>';

  // function flagEmail(msgType) { $("input[name=sendEmail]").val(msgType); }
//$('#SaveButton').bind('click', function() {
//  alert('Quote has been emailed!');
//});
</script>
<div class='tableGroup'>
   <div class='formHeading'> Quote ID: <?php print $current->QuoteID; ?></div>
   <div class='fieldcontainer'>
   <div id='emailOption' class='msg' >
      <input type='checkbox' checked='checked' name='sendEmailToggle' id='sendEmailToggle' value='New' /> Send email notification of updates
      <input type='hidden' name='sendEmail' id='sendEmail' value='New' default='New' />
   </div>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Quote Amount: $</span><input type='text' disabled='disabled' name='Quote[<?php print $current->QuoteID; ?>][Quote]' id='Quote' value='<?php print $current->Quote; ?>' size='25' class='boxValue' /></div>
 	 <div class='contentField'><label>Status: </label><span name='Quote[][Status]' id='Status'></span></div>
         <div class='contentField'><label>Job Date: </label><input type='text' dbtype='date' name='Quote[<?php print $current->QuoteID; ?>][Date]' id='Date' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><span class='fieldLabel'>Business: </span><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist("LoginID='".$_SESSION['LoginID']."'");print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "Quote[$current->QuoteID][BusinessID]");?></div>
         <div class='contentField'><span class='fieldLabel'>Description: </span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='250' class='boxValue' /></div>
         <div class='contentField'>
            <label>Start Time: </label>		
            <select name='Quote[<?php print $current->QuoteID; ?>][StartHours]' id='StartHours' default='00'><?php print $boss->utility->makeListOptions('Hours_24', ''); ?></select>:<select name='Quote[<?php print $current->QuoteID; ?>][StartMinutes]' id='StartMinutes' default='00'><?php print $boss->utility->makeListOptions('Minutes_15', ''); ?></select>
         </div>
         <div class='contentField'>
            <label>End Time: </label>		
            <select name='Quote[<?php print $current->QuoteID; ?>][EndHours]' id='EndHours' default='00'><?php print $boss->utility->makeListOptions('Hours_24', ''); ?></select>:<select name='Quote[<?php print $current->QuoteID; ?>][EndMinutes]' id='EndMinutes' default='00'><?php print $boss->utility->makeListOptions('Minutes_15', ''); ?></select>
         </div>
         <div class='contentField'><span class='fieldLabel'>Est Hours: </span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][Hours]' id='Hours' value='<?php print $current->Hours; ?>' size='25' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Pickup Address: </span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][Pickup]' id='Pickup' value='<?php print $current->Pickup; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Drop Off Address: </span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][DropOff]' id='DropOff' value='<?php print $current->DropOff; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Contact Name: </span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][ContactName]' id='ContactName' value='<?php print $current->ContactName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Contact Phone: </span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][ContactPhone]' id='ContactPhone' value='<?php print $current->ContactPhone; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Contact Email: </span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][ContactEmail]' id='ContactEmail' value='<?php print $current->ContactEmail; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Num of Pax: </span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][NumberOfPassengers]' id='NumberOfPassengers' value='<?php print $current->NumberOfPassengers; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Budget Amount: </span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][BudgetAmount]' id='BudgetAmount' value='<?php print $current->BudgetAmount; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Round Trip: </label><select dbtype='tinyint(1)' name='Quote[<?php print $current->QuoteID; ?>][RoundTrip]' id='RoundTrip'><option value='0'>No</option><option value='1'>Yes</option></select></div>
      </div>
      <div style="clear:left" class='contentField'><span class='fieldLabel'>Special Instructions - </span><textarea name='Quote[<?php print $current->QuoteID; ?>][SpecialInstructions]' id='SpecialInstructions' class='textBox' style='width:45em;height:5em;'><?php print $current->SpecialInstructions; ?></textarea></div>
   </div>
</div>
