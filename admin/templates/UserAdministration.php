<script language='Javascript' type='text/javascript' src='/lib/js/tree.js'> </script>
<script language='Javascript' type='text/javascript' src='/lib/js/default.js'> </script>
<?php 
   $obj->db->addResource('Module');
   $obj->db->Module->getlist('1=1 order by Sequence');
   
   $nav =& $obj->db->Module->Module;
   $jsobj = array();

   for ($n=0; $n<count($nav); $n++) {
      $jsobj[$nav[$n]->Module] = $nav[$n];
      $jsobj[$nav[$n]->Module]->_children = array();

      $obj->db->addResource('Process');
      $obj->db->Process->getlist("ModuleID=".$nav[$n]->ModuleID.' order by Sequence');

      foreach ($obj->db->Process->Process as $proc) {
         $jsobj[$nav[$n]->Module]->_children[] = $proc;
      }
   }

   $jsout = 'var sitetree = ' . js_serialize($jsobj, true) . ";\n";

   $user = $obj->getObject('Login', $in['ID']);

   if ($user->EmployeeID == 0) {
      $obj->db->addResource('Employee');
      $obj->db->Employee->getlist("Email='".mysql_real_escape_string($user->Email)."'");
      if (count($obj->db->Employee->Employee)) {
         $upd['Login'][$in['ID']]['EmployeeID'] = $obj->db->Employee->Employee[0]->EmployeeID;
         $obj->storeObject($upd, 'Login');
      }
   }
   $jsuser = 'var user = ' . js_serialize($user) . ";\n";
?>
<div class='accessTree'>
   <div id='tree' class='branch_open'>Inter@ctivate</div>
   <div id='tree_children'></div>
</div>

<script language='Javascript' type='text/javascript'>
   <?php
      print $jsout;
      print $jsuser; 
   ?>
   setTimeout( function() { buildModuleTree('tree', sitetree, user) }, 1000);
</script>
<input type='hidden' name='Login[<?php print $current->LoginID; ?>][Access]' id='Access' value='<?php print $current->Access; ?>' />
<input type='hidden' name='Login[<?php print $current->LoginID; ?>][ProcessAccess]' id='ProcessAccess' value='<?php print $current->ProcessAccess; ?>' />
<input type='hidden' name='Login[<?php print $current->LoginID; ?>][LoginID]' id='LoginID' value='<?php print $current->LoginID; ?>' />
<div class='tableGroup' style='height:100%;'>
   <div class='boxHeading'> Login ID: <span id='mainID'><?php print $current->LoginID; ?></span></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>First Name</span><input type='text' name='Login[<?php print $current->LoginID; ?>][FirstName]' id='FirstName' value='<?php print $current->FirstName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Last Name</span><input type='text' name='Login[<?php print $current->LoginID; ?>][LastName]' id='LastName' value='<?php print $current->LastName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Email</span><input type='text' name='Login[<?php print $current->LoginID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Password</span><input type='password' name='Login[<?php print $current->LoginID; ?>][Passwd]' id='Passwd' value='<?php print $current->Passwd; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Jabber ID</span><input type='text' name='Login[<?php print $current->LoginID; ?>][JabberID]' id='JabberID' value='<?php print $current->JabberID; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Phone</span><input type='text' name='Login[<?php print $current->LoginID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Extension</span><input type='text' name='Login[<?php print $current->LoginID; ?>][Extension]' id='Extension' value='<?php print $current->Extension; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Home Phone</span><input type='text' name='Login[<?php print $current->LoginID; ?>][HomePhone]' id='HomePhone' value='<?php print $current->HomePhone; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='Login[<?php print $current->LoginID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
   </div>
</div>
