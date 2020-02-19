<?php 
   require_once('../../lib/auth.php');
   // require_once('obj_class.php'); 
   require_once('js_serialize.php'); 
   
   $obj = $boss->db;
   $obj->addResource('Login');

   function buildAccess($in) {
      $modtotal = 0;
      $proctotal = 0;

      foreach ($in as $key=>$val) {
         if (preg_match("/^Process/", $key)) {
            $proctotal += $val;
         } elseif (preg_match("/^Module/", $key)) {
            $modtotal += $val;
         }
      }
      $_REQUEST['ProcessAccess'] = $proctotal;
      $_REQUEST['Access'] = $modtotal;

      return array($modtotal, $proctotal);
   }
   
   if ($in['x']) {
      switch ($in['x']) {
         case 'new':
            $obj->Login->add($_REQUEST);

            break;
         case 'save':
            list($in['Access'], $in['ProcessAccess']) = buildAccess($in);
            $obj->Login->update($in['LoginID'], $in);
            $obj->addResource('Clamp');

            for ($g=0;$g<count($in['Groups']);$g++) {
               $obj->Clamp->get($in['LoginID'], 'LocalID', "Local='Login' AND Remote='Groups' AND RemoteID='".$in['Groups'][$g]."'");
               if ($obj->Clamp->Clamp[0]->LocalID != $in['LoginID']) {
                  $add = array('Local'=>'Login', 'LocalID'=>$in['LoginID'], 'Remote'=>'Groups', 'RemoteID'=>$in['Groups'][$g]);
                  $obj->Clamp->add($add);
               }
            }
            break;
         default:
            if ($in['LoginList']) {
               $obj->Login->linkResource('Clamp', 'LoginID', 'LocalID', "Local='Login' AND Remote='Groups'");
               $obj->Login->get($in['LoginList'], 'LoginID');

               foreach ($obj->Login->Login[0] as $key=>$val) {
                  $out[$key] = $val;
               }
            }
      }
   }
   // Build all our list boxes & tables   
   $obj->addResource('Login');
   $obj->Login->getlist();

   for ($u=0;$u<count($obj->Login->Login);$u++) {
      if ($in['LoginID'] == $obj->Login->Login[$u]->LoginID) {
         $s = ' SELECTED';
         $jsuser = 'var user = ' + js_serialize($obj->Login->Login[$u]) + ";\n";
      } else {
         $s = '';
      }
      $out['LoginList'] .= "<option value='".$obj->Login->Login[$u]->LoginID."'$s>".$obj->Login->Login[$u]->LastName.', '.$obj->Login->Login[$u]->FirstName."</option>\n";
   }
   
   /* $jsobj = $boss->utility->buildNav($boss); */
   
   $obj->addResource('Module');
   $obj->Module->getlist();
   
   $nav =& $obj->Module->Module;
   $jsobj = array();

   for ($n=0; $n<count($nav); $n++) {
      $jsobj[$nav[$n]->Module] = $nav[$n];
      $jsobj[$nav[$n]->Module]->_children = array();

      $obj->addResource('Process');
      $obj->Process->getlist("ModuleID=".$nav[$n]->ModuleID);

      foreach ($obj->Process->Process as $proc) {
         $jsobj[$nav[$n]->Module]->_children[] = $proc;
      }
   }
   
   $jsout = 'var sitetree = ' . js_serialize($jsobj, true) . ";\n";
/*
   $obj->addResource('Groups');
   $obj->Groups->getlist();

   for ($u=0;$u<count($obj->Groups->Groups);$u++) {
      $out['GroupsList'] .= "<option value='".$obj->Groups->Groups[$u]->GroupsID."'>".$obj->Groups->Groups[$u]->Groups."</option>\n";
   }
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
   <head>
      <title>iai Administration</title>
      <script language='Javascript' type='text/javascript' src='/lib/js/default.js'> </script>
      <script language='Javascript' type='text/javascript' src='/lib/js/tree.js'> </script>
      <script language='Javascript' type='text/javascript'> 
         <?php 
            print $jsout;
            //print $jsuser; 
         ?>
         function doSave() {
            if (document.admin.x.value != 'new') document.admin.x.value = 'save';
            setTimeout("document.admin.submit();", 100);
         }

         function doNew() {
            document.admin.x.value = 'new';
            document.admin.LoginID.value = '';
            var fields = new Array('Login', 'FirstName', 'LastName', 'Passwd', 'Email');
            for (var f=0;f<fields.length;f++) {
               document.admin[fields[f]].value = '';
            }
            document.admin.Login.focus();

         }
         
         function doCancel() {
            documeent.admin.reset();
         }

         function doView(who) {
            document.admin.x.value = 'view';
            document.admin.LoginID.value = who;
            setTimeout("document.admin.submit();", 100);
         }
      </script>
      <link rel='stylesheet' type='text/css' href='/lib/css/default.css' />
      <link rel='stylesheet' type='text/css' href='/lib/css/outliner.css' />
   </head>
   <body onload="buildModuleTree('tree', sitetree, user)">
      <form name='admin' id='admin' action='index.php' method='post'>
      <input type='hidden' name='x' value=''>
      <input type='hidden' name='LoginID' value='<?php print $out['LoginID'] ?>'>
      <div id='content'>
         <div id='topform'>
            <div id='userlist'>
               <select name='LoginList' size='20' class='userlist' onchange="doView(this.options[this.selectedIndex].value);">
                  <?php print $out['LoginList']; ?>
               </select>
            </div>
            <div id='bottomform'>
               <div class='branch_open' id='tree'></div>
               <div id='tree_children' style='position:absolute;z-index:99999;background-color:#ffffcc;top:22px;bottom:0px;right:0px;left:0px;'></div>
            </div>
            <div id='userdetail'>
               <span class='field'>Login:</span><input type='text' name='Login' value="<?php print $out['Login']; ?>" class='textbox'><br>
               <span class='field'>First Name:</span><input type='text' name='FirstName' value="<?php print $out['FirstName']; ?>" class='textbox'><br>
               <span class='field'>Last Name:</span><input type='text' name='LastName' value="<?php print $out['LastName']; ?>" class='textbox'><br>
               <span class='field'>Password:</span><input type='password' name='Passwd' value="<?php print $out['Passwd']; ?>" class='textbox'><br>
               <span class='field'>Email:</span><input type='text' name='Email' value="<?php print $out['Email']; ?>" class='textbox'><br>
               <span class='field'>Groups:</span><select name='Groups[]' size='3' class='listbox' MULTIPLE><?php print $out['GroupsList']; ?></select><br>
           </div>
         </div>
         <div id='btns'>
            <input type='button' value='Save' onclick='doSave();' class='btn'>
            <input type='button' value='Cancel' onclick='doCancel();' class='btn'>
            <input type='button' value='New' onclick='doNew();' class='btn'>
         </div>
      </div>
      </form>
   </body>
</html>
