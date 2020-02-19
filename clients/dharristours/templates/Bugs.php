<?php
if ($in['sendEmail']) {
      $util = $boss->utility;
      $msgfile = $boss->getFilePath('ToDoEmail_'.$in['sendEmail'].'.txt');
      if (file_exists($msgfile)) {
         $msg = file_get_contents($msgfile);
         $todo = $in['ToDo'][$current->ToDoID];
//         $todo = $in['ToDo'][$in['ToDoID']];
         
         $todo['RFCDate'] = date('r');
         $todo['URL'] = "//".$_SERVER['DOCUMENT_ROOT']."/grid/?pid=".$in['pid']."&rsc=ToDo&id=".$in['ToDoID'];
         $rep = "\$todo[\$1]";
         $msg = preg_replace("/\#(\w+)\#/e", $rep, $msg);
         file_put_contents("/tmp/todo_emails.txt", $msg, FILE_APPEND);
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
<input type='hidden' name='ToDo[<?php print $current->ToDoID; ?>][AssignedBy]' id='AssignedBy' value='<?php print ($current->AssignedBy) ? $current->AssignedBy : $_SESSION['Email']; ?>' />
<div class='tableGroup'>
 <div class='formHeading'>
 ToDo ID: <?php print $current->ToDoID; ?>
 </div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
       <div class='contentField'><label>Category</label><select name='ToDo[<?php print $current->ToDoID; ?>][Category]' id='Category'><option value='ToDo'>ToDo</option><option value='Feature'>Feature</option></select></div>
</div>
<div class='contentField'><label>Name</label><input type='text' name='ToDo[<? print $current->ToDoID; ?>][Title]' id='Title' value='<?php print htmlspecialchars($current->Title, ENT_QUOTES); ?>' onchange="flagEmail('Status')" class='boxValue' /></div>
<div class='contentField'><label>Description</label><textarea name='ToDo[<? print $current->ToDoID; ?>][ToDo]' id='ToDo' rows='5' cols='80' onchange="flagEmail('Status')" class='boxValue'><?php print htmlspecialchars($current->ToDo, ENT_QUOTES); ?></textarea></div>
<div class='contentField'><label>Section</label><input type='text' name='ToDo[<? print $current->ToDoID; ?>][Section]' id='Section' value='<?php print $current->Section; ?>' onchange="flagEmail('Status')" size='50' class='boxValue' /> <div style='display:inline-block;width:20em;'>Assigned By: <a id='AssignedBy' href="mailto:<?php print $current->AssignedBy; ?>"><?php print $current->AssignedBy; ?></a></div></div>
<div class='contentField'>

<label>Assigned To</label><select class='selectBox' name='ToDo[<? print $current->ToDoID; ?>][Owner]' id='Owner' onchange="flagEmail('Assign')"><option>-- Not Assigned --</option>
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
<label class='defaultFont' style='padding-left:1em;'>Priority</label><select class='selectBox' name='ToDo[<? print $current->ToDoID; ?>][Priority]' id='Priority'>
   <?php 
      $status = array(1,2,3,4,5,6,7,8,9);
      foreach ($status as $stat) {
         print "<option value='".$stat."'".(($current->Priority==$stat) ? ' SELECTED' : '').'>'.$stat.'</option>';
      }
   ?>
</select>
<label class='defaultFont' style='padding-left:1em;'>Status</label><select class='selectBox' name='ToDo[<? print $current->ToDoID; ?>][Status]' id='Status' onchange="flagEmail('Status')">
   <?php 
      $status = array('New', 'On Hold', 'Requires feedback', 'Rejected', 'In Queue', 'In Development', 'In Review', 'Completed', 'Closed');
      foreach ($status as $stat) {
         print "<option value='".$stat."'".(($current->Status==$stat) ? ' SELECTED' : '').'>'.$stat.'</option>';
      }
   ?>
</select>
</div>
<div class='contentField'><label>Notes</label><textarea onchange='addDate(this);' name='ToDo[<? print $current->ToDoID; ?>][Notes]' id='Notes' rows='12' onchange="flagEmail('Status')" cols='80' class='boxValue'><?php print htmlspecialchars($current->Notes, ENT_QUOTES); ?></textarea></div>
<input type='hidden' name='ToDo[<? print $current->ToDoID; ?>][Module]' id='Module' value='<?php print $in['Module']; ?>' />
<input type='hidden' name='ToDo[<? print $current->ToDoID; ?>][Process]' id='Process' value='<?php print $in['Process']; ?>' />
</div></div>
