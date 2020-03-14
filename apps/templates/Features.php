<?php
   if ($in['sendEmail']) {
      if (!$util) $util = new utility();
      $msgfile = 'templates/BugEmail_'.$in['sendEmail'].'.txt';
      if (file_exists($msgfile)) {
         $msg = file_get_contents($msgfile);
         $bug = $in['Bug'][$in['BugID']];
         
         $bug['RFCDate'] = date('r');
         $bug['URL'] = "http://clonesoft.simplesoftwaresf.com/index.php?pid=85&mid=10&rid=Bug&tid=".$in['BugID'];
         $rep = "\$bug[\$1]";
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
<input type='hidden' name='Bug[<?php print $current->BugID; ?>][AssignedBy]' value='<?php print $current->AssignedBy; ?>' />
<div class='boxHeading' style='line-height: 24px;border-bottom:1px solid #909090;'> 
   <span class='radio' style='background-color:transparent;float:right;padding=0;top:-2px;'>
      Bug:     <input type='radio' name='Bug[<?php print $current->BugID; ?>][Category]' id='Category' value='Bug' <?php if (strtolower($current->Category)=='bug') print "checked='true'";?> />
      Feature: <input type='radio' name='Bug[<?php print $current->BugID; ?>][Category]' id='Category' value='Feature' <?php if (preg_match("/feature/i", $current->Category)) print "checked='true'"; ?> />
   </span>
Bug ID: <span id='mainID'><?php print $current->BugID; ?></span>
</div>

<div class='contentField'><span class='fieldLabel'>Name:</span><input type='text' name='Bug[<? print $current->BugID; ?>][Title]' id='Title' value='<?php print $current->Title; ?>' size='50' class='boxValue' style='width:50em;' /></div>
<div class='contentField'><span class='fieldLabel'>Description:</span><textarea name='Bug[<? print $current->BugID; ?>][Bug]' id='Bug' rows='5' cols='80' class='boxValue'><?php print $current->Bug; ?></textarea></div>
<div class='contentField'><span class='fieldLabel'>Section:</span><input type='text' name='Bug[<? print $current->BugID; ?>][Section]' id='Section' value='<?php print $current->Section; ?>' size='50' class='boxValue' /></div>
<div class='contentField'>

<span class='fieldLabel'>Assigned To:</span><select class='selectBox' name='Bug[<? print $current->BugID; ?>][Owner]' id='Owner' onchange="flagEmail('Assign')"><option>-- Not Assigned --</option>
   <?php 
      $obj->db->addResource('Login');
      $obj->db->Login->getlist();
      $users = array();
      foreach ($obj->db->Login->Login as $val) {
         $users[$val->Email] = $val->FirstName.' '.$val->LastName;
      }
      foreach ($users as $userid=>$user) {
         print "<option value='".$userid."'".(($current->Owner==$userid) ? ' SELECTED' : '').'>'.$user.'</option>';
      }
   ?>
</select>
<span class='defaultFont' style='padding-left:1em;'>Priority:</span><select class='selectBox' name='Bug[<? print $current->BugID; ?>][Priority]' id='Priority'>
   <?php 
      $status = array(1,2,3,4,5,6,7,8,9);
      foreach ($status as $stat) {
         print "<option value='".$stat."'".(($current->Priority==$stat) ? ' SELECTED' : '').'>'.$stat.'</option>';
      }
   ?>
</select>
<span class='defaultFont' style='padding-left:1em;'>Status:</span><select class='selectBox' name='Bug[<? print $current->BugID; ?>][Status]' id='Status' onchange="flagEmail('Status')">
   <?php 
      $status = array('New', 'On Hold', 'Requires feedback', 'Rejected', 'In Queue', 'In Development', 'In Review', 'Completed', 'Closed');
      foreach ($status as $stat) {
         print "<option value='".$stat."'".(($current->Status==$stat) ? ' SELECTED' : '').'>'.$stat.'</option>';
      }
   ?>
</select>
</div>
<div class='contentField'><span class='fieldLabel'>Notes:</span><textarea onchange='addDate(this);' name='Bug[<? print $current->BugID; ?>][Notes]' id='Notes' rows='12' cols='80' class='boxValue'><?php print $current->Notes; ?></textarea></div>
<input type='hidden' name='Bug[<? print $current->BugID; ?>][Module]' id='Module' value='<?php print $in['Module']; ?>' />
<input type='hidden' name='Bug[<? print $current->BugID; ?>][Process]' id='Process' value='<?php print $in['Process']; ?>' />
