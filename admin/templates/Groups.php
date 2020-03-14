<input type='hidden' name='Resource' value='Groups'/>
<input type='hidden' name='t' id='t' value='Groups'/>

<?php
/**
  * commented this out and replaced with the following line on 10/03/06 HK
<input type='hidden' name='x' id='x' value='<?php print (preg_match("/edit|new/", $in['x'])) ? 'update' : ''; ?>'/>
**/
?>
<input type='hidden' name='x' id='x' value='update'/>
<input type='hidden' name='GroupsID' id='GroupsID' value='<?php print $in['GroupsID']; ?>'/>
<h1>Group Manager</h1>
<?php
   if (!$in['GroupsID'] && $in['x']!='new') {
      $boss->db->addResource('Groups');
      $boss->db->Groups->getlist();
      $groups = $boss->db->Groups->Groups;
?>
   <div style='position:relative;width:100%;'>
   <p style='position:relative;width:80%;'>The table below lists the groups defined for users of the backend application.  
   You may create a new group by clicking the 'Add New Group' link. 
      <br/>To edit an existing group, click the 'edit' link to the right of the group you wish to edit.  To delete a group,
      click the 'delete' link associated with that group.</p>
      
      <div style='position:relative;width:80%;'>
         <div style='float:left;position:relative;left:1em;' onmouseover="this.style.backgroundColor='#ffffaa';" onmouseout="this.style.backgroundColor='transparent';"><a href='#' onclick="document.form1.x.value='new';setTimeout(function() { document.form1.submit(); }, 250);return false;"><img src='/img/orange_arrow.gif' border='0' style='float:left;margin-right:3px;position:relative;top:-2px;'/>Add New Group</a></div>
      </div>
      <br clear='left'/><br/>
<?php
      $tfields = array('Group Name'=>'Groups');
      $tbl = $boss->utility->buildODATable('Groups', $groups, 0, $tfields);
      print "<div style='position:relative;width:700px;'><table width='100%' border='0' cellpadding='0' cellspacing='0' class='navTable'>\n".$tbl."\n</table></div>\n";
?>
      </div>
<?php
   } else {
      $nav = $boss->utility->buildNav($boss, 0);
      if ($in['x'] != 'new') $current = $boss->getObject('Groups', $in['GroupsID']);
?>
   <div class='odaHead'><?php print ($in['x'] == 'new') ? 'Add New Group' : 'Edit Group'; ?></div><br/>
      <div class='odaRow'>
         <div class='oda'><label class='fieldLabel' for='Group' tabindex='10' accesskey='n'>Name</label><input tabindex='10' type='text' name='Groups[<?php print ($in['x']=='new') ? 'new1' : $current->GroupsID; ?>][Groups]' id='Groups' value='<?php print $current->Groups; ?>'/></div>
      </div><br clear='left'/>
      <div class='odaRow'>
         <div class='oda'><label tabindex='30' class='fieldLabel' for='ParentID' style='float:left;' accesskey='p'>Description</label>
         <textarea tabindex='20' name='Groups[<?php print ($in['x']=='new') ? 'new1' : $current->GroupsID; ?>][Notes]' id='Notes' rows='6' cols='80' style='border:1px inset #a0a0a0;'><?php print $current->Notes; ?></textarea>
         </div>
         <div class='oda'>
            <h2 tabindex='30' style='font-size:1.3em;margin:0px;' accesskey='p'>Permissions</h2>
            <hr style='height:1px;background-color:#cccccc;' />
            <blockquote>
               <?php
                  $boss->db->addResource('Module');
                  $module = $boss->db->Module->getlist('Access != 0 order by sequence asc');
                  foreach ($module as $val) {
                     $modAccessSum += $val->Access;
                  }

                  $boss->db->addResource('Process');
                  $process = $boss->db->Process->getlist('Access != 0 order by sequence asc');
                  foreach ($process as $val) {
                     $proAccessSum += $val->Access;
                  }
                  
                  $boss->db->addResource('Nav');
                  $section = $boss->db->Nav->getlist('TopLevel = 1 and Access != 0 order by sequence asc');
                  foreach ($section as $val) {
                     $secAccessSum += $val->Access;
                  }
               ?>
               <input type='hidden' id='ModuleAccess' name='Groups[<?php print ($in['x']=='new') ? 'new1' : $current->GroupsID; ?>][Access]' value='<?php print $in['x'] != 'new' ? $current->Access : $modAccessSum ; ?>'/>
               <input type='hidden' id='ProcessAccess' name='Groups[<?php print ($in['x']=='new') ? 'new1' : $current->GroupsID; ?>][ProcessAccess]' value='<?php print $in['x'] != 'new' ? $current->ProcessAccess : $proAccessSum ; ?>'/>
               <input type='hidden' id='ContentAccess' name='Groups[<?php print ($in['x']=='new') ? 'new1' : $current->GroupsID; ?>][ContentAccess]' value='<?php print $in['x'] != 'new' ? $current->ContentAccess : $secAccessSum ; ?>'/>
               <?php
                  $tabindex = 100;
                  foreach ($module as $mod) {
                     $tabindex += 10;
               ?>
                     <div class='oda' style='margin-left:3em;'><input tabindex='<?php print($tabindex) ?>' type='checkbox' value='<?php print $mod->Access ?>' <?php print ((((int) $current->Access & (int) $mod->Access) ==  $mod->Access) || $in['x']=='new') ? "checked='checked'" : ''; ?> onchange="updateAccess(this, <?php print $mod->Access ?>, 'Module', <?php print $mod->ModuleID; ?>)"/><label tabindex='40' accesskey='v' class='fieldLabel2' style='padding:2px;'><?php print $mod->Module ?></label></div>
               
               <?php
                     foreach ($process as $pro) {
                        if($pro->ModuleID == $mod->ModuleID) {
                           $tabindex += 10;
               ?>
                           <div class='oda' style='margin-left:6em;'><input tabindex='<?php print($tabindex) ?>' type='checkbox' value='<?php print $pro->Access ?>' <?php print ((((int) $current->ProcessAccess & (int) $pro->Access) ==  $pro->Access) || $in['x']=='new') ? "checked='checked'" : ''; ?> onchange="updateAccess(this, <?php print $pro->Access ?>, 'Process', <?php print $pro->ProcessID; ?>)"/><label tabindex='40' accesskey='v' class='fieldLabel2' style='padding:2px;'><?php print $pro->Process ?></label></div>
               <?php
                           if ($pro->Process == 'Website') {
                              foreach ($section as $sec) {
                                 $tabindex += 10;
               ?>
                                 <div class='oda' style='margin-left:9em;'><input tabindex='<?php print $tabindex ?>' type='checkbox' value='<?php print $sec->Access ?>' <?php print ((((int) $current->ContentAccess & (int) $sec->Access) ==  $sec->Access) || $in['x']=='new') ? "checked='checked'" : ''; ?> onchange="updateAccess(this, <?php print $sec->Access ?>, 'Content', <?php print $sec->ContentID; ?>)"/><label tabindex='40' accesskey='v' class='fieldLabel2' style='padding:2px;'><?php print $sec->Name ?></label></div>
               <?php
                              }
                           }
                        }
                     }
                  }
               ?>
               <script language='Javascript' type='text/javascript'>
                  function updateAccess(who, val, type) {
                     var ca = document.getElementById(type + 'Access');
                     if (ca) {
                        if (!ca.value) ca.value = 0;
                        if (who.checked && !(parseInt(ca.value) & parseInt(val))) {
                           ca.value = parseInt(ca.value) + parseInt(val);
                        } else if (!who.checked && (parseInt(ca.value) & parseInt(val))) {
                           ca.value = parseInt(ca.value) - parseInt(val);
                        }
                     } 
                     return true;
                  }
               </script>
               <?php 
               /*
               BREAK
               <div class='oda' style='margin-left:3em;'><input tabindex='40' type='checkbox' id='HomeAccess' value='2' <?php print (($current->Access & 2) || $in['x']=='new') ? "checked='checked'" : ''; ?> onchange="updateAccess(this, 2, 'Module')"/><label tabindex='40' accesskey='v' class='fieldLabel2' for='HomeAccess' style='padding:2px;'>Home</label></div>
               <div class='oda' style='margin-left:3em;'><input tabindex='40' type='checkbox' id='AdministrationAccess' value='4' <?php print (($current->Access & 4) || $in['x']=='new') ? "checked='checked'" : ''; ?> onchange="updateAccess(this, 4, 'Module')"/><label tabindex='40' accesskey='v' class='fieldLabel2' for='AdministrationAccess' style='padding:2px;'>Administration</label></div>
               <div class='oda' style='margin-left:6em;'><input tabindex='40' type='checkbox' id='ModuleAccessAdd' value='4' <?php print (($current->ProcessAccess & 4) || $in['x']=='new') ? "checked='checked'" : ''; ?> onchange="updateAccess(this, 4, 'Process')"/><label tabindex='40' accesskey='v' class='fieldLabel2' for='ModuleAccessAdd' style='padding:2px;'>Groups</label></div>
               <div class='oda' style='margin-left:6em;'><input tabindex='40' type='checkbox' id='ModuleAccessAdd' value='8' <?php print (($current->ProcessAccess & 8) || $in['x']=='new') ? "checked='checked'" : ''; ?> onchange="updateAccess(this, 8, 'Process')"/><label tabindex='40' accesskey='v' class='fieldLabel2' for='ModuleAccessAdd' style='padding:2px;'>Users</label></div>
               <div class='oda' style='margin-left:6em;'><input tabindex='40' type='checkbox' id='ModuleAccessAdd' value='32' <?php print (($current->ProcessAccess & 32) || $in['x']=='new') ? "checked='checked'" : ''; ?> onchange="updateAccess(this, 32, 'Process')"/><label tabindex='40' accesskey='v' class='fieldLabel2' for='ModuleAccessAdd' style='padding:2px;'>Publishing</label></div>
               <div class='oda' style='margin-left:6em;'><input tabindex='40' type='checkbox' id='ModuleAccessAdd' value='2048' <?php print (($current->ProcessAccess & 2048) || $in['x']=='new') ? "checked='checked'" : ''; ?> onchange="updateAccess(this, 2048, 'Process')"/><label tabindex='40' accesskey='v' class='fieldLabel2' for='ModuleAccessAdd' style='padding:2px;'>Templates</label></div>
               <div class='oda' style='margin-left:3em;'><input tabindex='40' type='checkbox' id='ContentManagementAccess' value='8' <?php print (($current->Access & 8) || $in['x']=='new') ? "checked='checked'" : ''; ?> onchange="updateAccess(this, 8, 'Module')"/><label tabindex='40' accesskey='v' class='fieldLabel2' for='ContentManagementAccess' style='padding:2px;'>Content Management</label></div>
               <div class='oda' style='margin-left:6em;'><input tabindex='40' type='checkbox' id='ModuleAccessAdd' value='4096' <?php print (($current->ProcessAccess & 4096) || $in['x']=='new') ? "checked='checked'" : ''; ?> onchange="updateAccess(this, 4096, 'Process')"/><label tabindex='40' accesskey='v' class='fieldLabel2' for='ModuleAccessAdd' style='padding:2px;'>Website</label></div>
               <?php
                  foreach($section as $val) {
               ?>
               <div class='oda' style='margin-left:9em;'><input tabindex='40' type='checkbox' value='<?php print$val->Access ?>' <?php print ((((int) $current->ContentAccess & (int) $val->Access) ==  $val->Access) || $in['x']=='new') ? "checked='checked'" : ''; ?> onchange="updateAccess(this, <?php print $val->Access ?>, 'Content')"/><label tabindex='40' accesskey='v' class='fieldLabel2' style='padding:2px;'><?php print $val->Name ?></label></div>
               <?php
                  }
               ?>
               <div class='oda' style='margin-left:6em;'><input tabindex='40' type='checkbox' id='ModuleAccessAdd' value='16' <?php print (($current->ProcessAccess & 16) || $in['x']=='new') ? "checked='checked'" : ''; ?> onchange="updateAccess(this, 16, 'Process')"/><label tabindex='40' accesskey='v' class='fieldLabel2' for='ModuleAccessAdd' style='padding:2px;'>Sections</label></div>
               <div class='oda' style='margin-left:6em;'><input tabindex='40' type='checkbox' id='ModuleAccessAdd' value='16384' <?php print (($current->ProcessAccess & 16384) || $in['x']=='new') ? "checked='checked'" : ''; ?> onchange="updateAccess(this, 16384, 'Process')"/><label tabindex='40' accesskey='v' class='fieldLabel2' for='ModuleAccessAdd' style='padding:2px;'>Article Manager</label></div>
               <div class='oda' style='margin-left:6em;'><input tabindex='40' type='checkbox' id='ModuleAccessAdd' value='32768' <?php print (($current->ProcessAccess & 32768) || $in['x']=='new') ? "checked='checked'" : ''; ?> onchange="updateAccess(this, 32768, 'Process')"/><label tabindex='40' accesskey='v' class='fieldLabel2' for='ModuleAccessAdd' style='padding:2px;'>Forms</label></div>
               <div class='oda' style='margin-left:3em;'><input tabindex='40' type='checkbox' id='AssetManagementAccess' value='16' <?php print (($current->Access & 16) || $in['x']=='new') ? "checked='checked'" : ''; ?> onchange="updateAccess(this, 16, 'Module')"/><label tabindex='40' accesskey='v' class='fieldLabel2' for='AssetManagementAccess' style='padding:2px;'>Asset Management</label></div>
               <div class='oda' style='margin-left:3em;'><input tabindex='40' type='checkbox' id='BackEndAccess' value='32' <?php print (($current->Access & 32) || $in['x']=='new') ? "checked='checked'" : ''; ?> onchange="updateAccess(this, 32, 'Module')"/><label tabindex='40' accesskey='v' class='fieldLabel2' for='BackEndAccess' style='padding:2px;'>Back End</label></div>
               <div class='oda' style='margin-left:6em;'><input tabindex='40' type='checkbox' id='ModuleAccessAdd' value='64' <?php print (($current->ProcessAccess & 64) || $in['x']=='new') ? "checked='checked'" : ''; ?> onchange="updateAccess(this, 64, 'Process')"/><label tabindex='40' accesskey='v' class='fieldLabel2' for='ModuleAccessAdd' style='padding:2px;'>Application Management</label></div>
               <div class='oda' style='margin-left:6em;'><input tabindex='40' type='checkbox' id='ModuleAccessAdd' value='128' <?php print (($current->ProcessAccess & 128) || $in['x']=='new') ? "checked='checked'" : ''; ?> onchange="updateAccess(this, 128, 'Process')"/><label tabindex='40' accesskey='v' class='fieldLabel2' for='ModuleAccessAdd' style='padding:2px;'>User Administration</label></div>
               <div class='oda' style='margin-left:6em;'><input tabindex='40' type='checkbox' id='ModuleAccessAdd' value='1024' <?php print (($current->ProcessAccess & 1024) || $in['x']=='new') ? "checked='checked'" : ''; ?> onchange="updateAccess(this, 1024, 'Process')"/><label tabindex='40' accesskey='v' class='fieldLabel2' for='ModuleAccessAdd' style='padding:2px;'>Support Tickets</label></div>
               <div class='oda' style='margin-left:3em;'><input tabindex='40' type='checkbox' id='LogoutAccess' value='1' <?php print (($current->Access & 1) || $in['x']=='new') ? "checked='checked'" : ''; ?> onchange="updateAccess(this, 1, 'Module')"/><label tabindex='40' accesskey='v' class='fieldLabel2' for='LogoutAccess' style='padding:2px;'>Log Out</label></div>
               */
               ?>
         </blockquote>
        </div>
      </div>
      <input tabindex='50' type='button' value='Cancel' style='float:right;margin-right:3em;' onclick="document.location.href='/cmd.php?t=Groups'" accesskey='c'/>
      <input tabindex='40' type='submit' value='Save' style='float:right;margin-right:1em;' accesskey='s'/>
      <script language='Javascript' type='text/javascript'>
         setTimeout("document.getElementById('Groups').select()", 500);
      </script>
<?php
   }
?>

