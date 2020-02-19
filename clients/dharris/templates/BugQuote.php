<?php
   if ($in['sendEmail']) {
      if (!$util) $util = new utility();
      $msgfile = 'templates/QuoteEmail_'.$in['sendEmail'].'.txt';
      if (file_exists($msgfile)) {
         $msg = file_get_contents($msgfile);
         
         foreach ($in['Quote'] as $key=>$val) { $quote = $val; }

         $quote['AssignedBy'] = ($quote['AssignedBy']) ? $quote['AssignedBy'] :   $_SESSION['Login']->FirstName . ' ' . $_SESSION['Login']->LastName . " <".$_SESSION['Login']->Email.">";
         $quote['RFCDate'] = date('r');
         $quote['URL'] = "http://".$_SERVER['SERVER_NAME']."/apps/index.php?pid=".$in['ProcessID']."&rid=".$in['Resource']."&tid=".$in['QuoteID'];
         $rep = "\$quote[\$1]";
         $msg = preg_replace("/\#(\w+)\#/e", $rep, $msg);
         $util->sendMail($msg);
      }
   }
?>
<script language='Javascript' type='text/javascript'>
   var userEmail = '<?php print htmlspecialchars($_SESSION['Email'], ENT_QUOTES); ?>';

   function flagEmail(msgType) {
      var frm = document.mainform;
      if (frm) {
         frm['sendEmail'].value = msgType;
      }
   }

   function addDate(who) {
      who.value += "\n----\nUpdated by " + userEmail + "\n" + Date() + "\n----\n";
      flagEmail('Status');
   }
</script>
<input type='hidden' name='sendEmail' value='' />
<input type='hidden' name='AssignedBy' value='<?php print $_SESSION['Email']; ?>' />
<input type='hidden' name='Quote[<?php print $current->QuoteID; ?>][AssignedBy]' value='<?php print $current->AssignedBy; ?>' />
<div class='boxHeading' style='line-height: 24px;border-bottom:1px solid #909090;'> 
   <span class='radio' style='background-color:transparent;float:right;padding=0;top:-2px;'>
      Quote:     <input type='radio' name='Quote[<?php print $current->QuoteID; ?>][Category]' id='Category' value='Quote' <?php if (strtolower($current->Category)=='quote') print "checked='true'";?> />
      Cancel:     <input type='radio' name='Quote[<?php print $current->QuoteID; ?>][Category]' id='Category' value='Cancel' <?php if (strtolower($current->Category)=='cancel') print "checked='true'";?> />
   </span>
Quote ID: <span id='mainID'><?php print $current->QuoteID; ?></span>
</div>

<div class='contentField'><span class='fieldLabel'>Date:</span><input type='text' name='Quote[<? print $current->QuoteID; ?>][Date]' id='Date' value='<?php print htmlspecialchars($current->Date, ENT_QUOTES); ?>' size='50' class='boxValue' style='width:50em;' /></div>
<div class='contentField'><span class='fieldLabel'>Start Time:</span><input type='text' name='Quote[<? print $current->QuoteID; ?>][StartTime]' id='StartTime' value='<?php print htmlspecialchars($current->StartTime, ENT_QUOTES); ?>' size='50' class='boxValue' style='width:50em;' /></div>
<div class='contentField'><span class='fieldLabel'>End Time:</span><input type='text' name='Quote[<? print $current->QuoteID; ?>][EndTime]' id='EndTime' value='<?php print htmlspecialchars($current->EndTime, ENT_QUOTES); ?>' size='50' class='boxValue' style='width:50em;' /></div>
<div class='contentField'><span class='fieldLabel'>Description:</span><textarea name='Quote[<? print $current->QuoteID; ?>][Quote]' id='Quote' rows='5' cols='80' class='boxValue'><?php print htmlspecialchars($current->Quote, ENT_QUOTES); ?></textarea></div>
<div class='contentField'><span class='fieldLabel'>Pickup Address:</span><textarea name='Quote[<? print $current->QuoteID; ?>][Pickup]' id='Pickup' rows='5' cols='80' class='boxValue'><?php print htmlspecialchars($current->Pickup, ENT_QUOTES); ?></textarea></div>
<div class='contentField'><span class='fieldLabel'>Dropoff Address:</span><textarea name='Quote[<? print $current->QuoteID; ?>][Dropoff]' id='Dropoff' rows='5' cols='80' class='boxValue'><?php print htmlspecialchars($current->Dropoff, ENT_QUOTES); ?></textarea></div>
<div class='contentField'><span class='fieldLabel'>Number Of Passengers:</span><input type='text' name='Quote[<? print $current->QuoteID; ?>][NumberOfPassengers]' id='NumberOfPassengers' value='<?php print $current->NumberOfPassengers; ?>' size='50' class='boxValue' /></div>
<div class='contentField'>

<span class='fieldLabel'>Email To:</span><select class='selectBox' name='Quote[<? print $current->QuoteID; ?>][ContactName]' id='ContactName' onchange="flagEmail('Assign')"><option>-- Not Assigned --</option>
   <?php 
      $obj->db->addResource('Login');
      $obj->db->Login->getlist();
      $users = array();
      foreach ($obj->db->Login->Login as $val) {
         $users[$val->Email] = $val->FirstName.' '.$val->LastName;
      }
      foreach ($users as $userid=>$user) {
         print "<option value='".$userid."'".(($current->ContactName==$userid) ? ' SELECTED' : '').'>'.$user.'</option>';
      }
   ?>
</select>
<span class='defaultFont' style='padding-left:1em;'>Number Of Buses:</span><select class='selectBox' name='Quote[<? print $current->QuoteID; ?>][NumberOfBuses]' id='NumberOfBuses'>
   <?php 
      $status = array(1,2,3,4,5,6,7,8,9);
      foreach ($status as $stat) {
         print "<option value='".$stat."'".(($current->NumberOfBuses==$stat) ? ' SELECTED' : '').'>'.$stat.'</option>';
      }
   ?>
</select>
<span class='defaultFont' style='padding-left:1em;'>Status:</span><select class='selectBox' name='Quote[<? print $current->QuoteID; ?>][Status]' id='Status' onchange="flagEmail('Status')">
   <?php 
      $status = array('New', 'On Hold', 'Requires feedback', 'Rejected', 'Accepted');
      foreach ($status as $stat) {
         print "<option value='".$stat."'".(($current->Status==$stat) ? ' SELECTED' : '').'>'.$stat.'</option>';
      }
   ?>
</select>
</div>
<div class='contentField'><span class='fieldLabel'>Notes:</span><textarea onchange='addDate(this);' name='Quote[<? print $current->QuoteID; ?>][Notes]' id='Notes' rows='12' cols='80' class='boxValue'><?php print htmlspecialchars($current->Notes, ENT_QUOTES); ?></textarea></div>
