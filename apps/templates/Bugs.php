<?php
if ($in['sendEmail']) {
      $util = $boss->utility;
      $msgfile = $boss->getFilePath('BugEmail_'.$in['sendEmail'].'.txt');
      if (file_exists($msgfile)) {
         $msg = file_get_contents($msgfile);
         $bug = $in['Bug'][$current->BugID];
//         $bug = $in['Bug'][$in['BugID']];
         
         $bug['RFCDate'] = date('r');
         $bug['URL'] = "//".$_SERVER['DOCUMENT_ROOT']."/grid/?pid=".$in['pid']."&rsc=Bug&id=".$in['BugID'];
         $rep = "\$bug[\$1]";
         $msg = preg_replace("/\#(\w+)\#/e", $rep, $msg);
         file_put_contents("/tmp/bug_emails.txt", $msg, FILE_APPEND);
         $util->sendMail($msg);
      }
   }
?>
<script language='Javascript' type='text/javascript'>
   var userEmail = '<?php print htmlspecialchars($_SESSION['Email'], ENT_QUOTES); ?>';

   function flagEmail(msgType) {
      $("#sendEmail").val(msgType);
   }

   function addDate(who) {
     // who.value += "\n----\nUpdated by " + userEmail + "\n" + Date() + "\n----\n";
     // flagEmail('Status');
   }
</script>
<input type='hidden' name='sendEmail' id='sendEmail' value='' />
<input type='hidden' name='AssignedBy' value='<?php print $_SESSION['Email']; ?>' />
<input type='hidden' name='Bug[<?php print $current->BugID; ?>][AssignedBy]' id='AssignedBy' value='<?php print ($current->AssignedBy) ? $current->AssignedBy : $_SESSION['Email']; ?>' />
<div class='tableGroup'>
 <div class='formHeading'>
 Bug ID: <?php print $current->BugID; ?>
 </div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
       <div class='contentField'><label>Category</label><select name='Bug[<?php print $current->BugID; ?>][Category]' id='Category'><option value='Bug'>Bug</option><option value='Feature'>Feature</option></select></div>
</div>
<div class='contentField'><label>Name</label><input type='text' name='Bug[<? print $current->BugID; ?>][Title]' id='Title' value='<?php print htmlspecialchars($current->Title, ENT_QUOTES); ?>' onchange="flagEmail('Status')" class='boxValue' /></div>
<div class='contentField'><label>Description</label><textarea name='Bug[<? print $current->BugID; ?>][Bug]' id='Bug' rows='5' cols='80' onchange="flagEmail('Status')" class='boxValue'><?php print htmlspecialchars($current->Bug, ENT_QUOTES); ?></textarea></div>
<div class='contentField'><label>Section</label><input type='text' name='Bug[<? print $current->BugID; ?>][Section]' id='Section' value='<?php print $current->Section; ?>' onchange="flagEmail('Status')" size='50' class='boxValue' /> <div style='display:inline-block;width:20em;'>Assigned By: <a id='AssignedBy' href="mailto:<?php print $current->AssignedBy; ?>"><?php print $current->AssignedBy; ?></a></div></div>
<div class='contentField'>

<label>Assigned To</label><select class='selectBox' name='Bug[<? print $current->BugID; ?>][Owner]' id='Owner' onchange="flagEmail('Assign')"><option>-- Not Assigned --</option>
   <?php 
      if (!$boss) $boss = new boss();
      //$boss->db->addResource('Login');
      $boss->addResource('Login');
      $boss->db->Login->getlist();
      $users = array();
      foreach ($boss->db->Login->Login as $val) {
         $users[$val->Email] = $val->FirstName.' '.$val->LastName;
      }
      foreach ($users as $userid=>$user) {
         print "<option value='".$userid."'".(($current->Owner==$userid) ? ' SELECTED' : '').'>'.$user.'</option>';
      }
   ?>
</select>
<label class='defaultFont' style='padding-left:1em;'>Priority</label><select class='selectBox' name='Bug[<? print $current->BugID; ?>][Priority]' id='Priority'>
   <?php 
      $status = array(1,2,3,4,5,6,7,8,9);
      foreach ($status as $stat) {
         print "<option value='".$stat."'".(($current->Priority==$stat) ? ' SELECTED' : '').'>'.$stat.'</option>';
      }
   ?>
</select>
<label class='defaultFont' style='padding-left:1em;'>Status</label><select class='selectBox' name='Bug[<? print $current->BugID; ?>][Status]' id='Status' onchange="flagEmail('Status')">
   <?php 
      $status = array('New', 'On Hold', 'Requires feedback', 'Rejected', 'In Queue', 'In Development', 'In Review', 'Completed', 'Closed');
      foreach ($status as $stat) {
         print "<option value='".$stat."'".(($current->Status==$stat) ? ' SELECTED' : '').'>'.$stat.'</option>';
      }
   ?>
</select>
</div>
<div class='contentField'><label>Notes</label><textarea onchange='addDate(this);' name='Bug[<? print $current->BugID; ?>][Notes]' id='Notes' rows='12' onchange="flagEmail('Status')" cols='80' class='boxValue'><?php print htmlspecialchars($current->Notes, ENT_QUOTES); ?></textarea></div>
<input type='hidden' name='Bug[<? print $current->BugID; ?>][Module]' id='Module' value='<?php print $in['Module']; ?>' />
<input type='hidden' name='Bug[<? print $current->BugID; ?>][Process]' id='Process' value='<?php print $in['Process']; ?>' />
</div></div>
