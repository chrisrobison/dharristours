<input type='hidden' name='Resource' value='Login'/>
<input type='hidden' name='t' id='t' value='Users'/>
<?php
/**
  * commented this out and replaced with the following line on 10/03/06 HK
<input type='hidden' name='x' id='x' value='<?php print (preg_match("/edit|new/", $in['x'])) ? 'update' : ''; ?>'/>
**/
?>
<input type='hidden' name='x' id='x' value='update'/>
<input type='hidden' name='LoginID' id='LoginID' value='<?php print $in['LoginID']; ?>'/>
<h1>User Manager</h1>
<?php

   if (!$in['LoginID'] && $in['x']!='new') {
      $boss->db->addResource('Login');
      $boss->db->Login->getlist();
      $users = $boss->db->Login->Login;
?>
   <div style='position:relative;width:100%;'>
   <p style='position:relative;width:80%;'>The table below lists the users defined for users of the backend application.  
   You may create a new user by clicking the 'Add New User' link. 
      <br/>To edit an existing user, click the 'edit' link to the right of the user you wish to edit.  To delete a user,
      click the 'delete' link associated with that user.</p>
      
      <div style='position:relative;width:80%;'>
         <div style='float:left;position:relative;left:1em;' onmouseover="this.style.backgroundColor='#ffffaa';" onmouseout="this.style.backgroundColor='transparent';"><a href='#' onclick="document.form1.x.value='new';setTimeout(function() { document.form1.submit(); }, 250);return false;"><img src='/img/orange_arrow.gif' border='0' style='float:left;margin-right:3px;position:relative;top:-2px;'/>Add New User</a></div>
      </div>
      <br clear='left'/><br/>
<?php
      $tfields = array('User Name'=>'Login');
      $tbl = $boss->utility->buildODATable('Login', $users, 0, $tfields);
      print "<div style='position:relative;width:700px;' class='navTableWrap'><table width='100%' border='0' cellpadding='0' cellspacing='0' class='navTable'>\n".$tbl."\n</table></div>\n";
?>
      </div>
<?php
   } else {
      $nav = $boss->utility->buildNav($boss, 0);
      if ($in['x'] != 'new') $current = $boss->getObject('Login', $in['LoginID']);
?>
   <div class='odaHead'><?php print ($in['x'] == 'new') ? 'Add New User' : 'Edit User'; ?></div><br/>
      <div class='odaRow'>
         <div class='oda'><label class='fieldLabel' for='User' accesskey='n'>First Name</label><input tabindex='10' type='text' name='Login[<?php print ($in['x']=='new') ? 'new1' : $current->LoginID; ?>][FirstName]' id='FirstName' value='<?php print $current->FirstName; ?>'/></div>
      <br clear='left'/>
         <div class='oda'><label class='fieldLabel' for='User' accesskey='n'>Last Name</label><input tabindex='20' type='text' name='Login[<?php print ($in['x']=='new') ? 'new1' : $current->LoginID; ?>][LastName]' id='LastName' value='<?php print $current->LastName; ?>'/></div>
      <br clear='left'/>
      </div>
      <div class='odaRow'>
         <div class='oda'><label class='fieldLabel' for='Email' accesskey='e'>Email</label><input tabindex='30' type='text' name='Login[<?php print ($in['x']=='new') ? 'new1' : $current->LoginID; ?>][Email]' id='Email' size='30' value='<?php print $current->Email; ?>'/></div>
      </div><br clear='left'/>
      <div class='odaRow'>
         <div class='oda'><label class='fieldLabel' for='Login' accesskey='u'>Username</label><input tabindex='40' type='text' name='Login[<?php print ($in['x']=='new') ? 'new1' : $current->LoginID; ?>][Login]' id='Login' value='<?php print $current->Login; ?>'/></div>
      </div><br clear='left'/>
      <div class='odaRow'>
         <div class='oda'><label class='fieldLabel' for='Passwd' accesskey='p'>Password</label><input tabindex='50' type='password' name='Login[<?php print ($in['x']=='new') ? 'new1' : $current->LoginID; ?>][Passwd]' id='Passwd' value='<?php print $current->Passwd; ?>'/></div>
      </div><br clear='left'/>
<div class='odaRow'>
         <div class='oda'><label class='fieldLabel' for='Group' accesskey='g'>Group</label><select tabindex='60' name='Login[<?php print ($in['x']=='new') ? 'new1' : $current->LoginID; ?>][GroupsID]' id='Group'>
         <?php
            $boss->db->addResource('Groups');
            $boss->db->Groups->getlist();
            $groups = $boss->db->Groups->Groups;
            foreach ($groups as $group) {
               $s = ($current->GroupsID==$group->GroupsID) ? ' SELECTED' : '';
               print "<option value='{$group->GroupsID}'$s>{$group->Groups}</option>\n";
            }
         ?>
         </select></div>
      </div>
      <input tabindex='70' type='button' value='Cancel' style='float:right;margin-right:3em;' onclick="document.location.href='/oda.php?t=Users'" accesskey='c'/>
      <input tabindex='80' type='submit' value='Save' style='float:right;margin-right:1em;' accesskey='s'/>
      <script language='Javascript' type='text/javascript'>
         setTimeout("document.getElementById('Login').select()", 500);
      </script>
<?php
   }
?>

