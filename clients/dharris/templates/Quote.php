<?php
   if ($in['sendEmail']) {
      $util = $boss->utility;
      $msg = $util->getFile('templates/QuoteEmail_'.$in['sendEmail'].'.txt');

      if ($msg) { 
         foreach ($in['Quote'] as $key=>$val) { 
            $quote = $val; 
            $quote['ModifiedBy'] = ($quote['ModifiedBy']) ? $quote['ModifiedBy'] :   $_SESSION['Login']->FirstName . ' ' . $_SESSION['Login']->LastName . " <".$_SESSION['Login']->Email.">";
            $quote['RFCDate'] = date('r');
            $quote['QuoteID'] = $in['QuoteID'];
            $quote['URL'] = "http://".$_SERVER['SERVER_NAME']."/apps/content.php?pid=".$in['ProcessID']."&rid=".$in['Resource']."&tid=".$in['QuoteID'];
            $rep = "\$quote[\$1]";
            $msg = preg_replace("/\#(\w+)\#/e", $rep, $msg);
            file_put_contents("/tmp/sscsf_mail.log", $msg, FILE_APPEND | LOCK_EX);
            $util->sendMail($msg);
         }
      }
   }
?>
<div class='tableGroup'>
   <div class='boxHeading'> Quote ID: <?php print $current->QuoteID; ?></div>
   <div class='fieldcontainer'>
   <div id='emailOption' class='msg' style="display:none">
      <input type='checkbox' name='sendEmail' id='sendEmail' value='Updated' /> Send email notification of updates
   </div>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Business ID</span><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist("LoginID='".$_SESSION['LoginID']."'");print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "Quote[$current->QuoteID][BusinessID]");?></div>
         <div class='contentField'><span class='fieldLabel'>Date</span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][Date]' id='Date' value='<?php print $current->Date; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Start Time</span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][StartTime]' id='StartTime' value='<?php print $current->StartTime; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>End Time</span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][EndTime]' id='EndTime' value='<?php print $current->EndTime; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Hours</span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][Hours]' id='Hours' value='<?php print $current->Hours; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Pickup Address</span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][Pickup]' id='Pickup' value='<?php print $current->Pickup; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Drop Off Address</span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][DropOff]' id='DropOff' value='<?php print $current->DropOff; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Contact Name</span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][ContactName]' id='ContactName' value='<?php print $current->ContactName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Contact Phone</span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][ContactPhone]' id='ContactPhone' value='<?php print $current->ContactPhone; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'># of Passengers</span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][NumberOfPassengers]' id='NumberOfPassengers' value='<?php print $current->NumberOfPassengers; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Number Of Buses</span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][NumberOfBuses]' id='NumberOfBuses' value='<?php print $current->NumberOfBuses; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Budget Amount</span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][BudgetAmount]' id='BudgetAmount' value='<?php print $current->BudgetAmount; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Status</span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][Status]' id='Status' value='<?php print $current->Status; ?>' size='50' class='boxValue' /></div>
      </div>
      <div style="clear:left" class='contentField'><span class='fieldLabel'>Notes</span><textarea name='Quote[<?php print $current->QuoteID; ?>][Notes]' id='Notes' class='textBox' style='width:45em;height:5em;'><?php print $current->Notes; ?></textarea></div>
   </div>
</div>
<script type='text/javascript'>
   $(function() {
      $("#Date").css({"width":"13em"}).datepicker({
            showOn: "button",
            buttonImage: "/img/calendar.png",
            buttonImageOnly: true
      });
      $(".boxValue,.genSelect").change(
         function() {
            $("#sendEmail").attr("checked", true);
            $("#emailOption").css({'background':'#eee','background':'rgba(0,0,0,.3)','box-shadow':'-4px -4px -4px rgba(0,0,0,.5)','-moz-box-shadow':'-4px -4px -4px rgba(0,0,0,.5)','padding':'.5em'});
            $("#emailOption").show('slow');
         }
      );
   });
</script>
