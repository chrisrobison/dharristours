<!--<div id='toolbar'>
   <?php
      require_once($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');

      $obj = new boss();
      $obj->db->addResource('Module');
      $obj->addProcess(null, $in['ProcessID']);
      $process = $obj->Process->Processes[0];

      $rsc = (isset($in['Resource']) && ($in['Resource'] != 'undefined') && ($in['Resource'] != '')) ? $in['Resource'] : null;
      //$newstyle = (($process->Buttons & 1) && ((!$_REQUEST[$rsc.'ID']) || ($_REQUEST[$rsc.'ID'] == 'New'))) ? 'display:block;' : 'display:none;';
      $newstyle = ($process->Buttons & 1) ? 'display:block;' : 'display:none;';
      // print "<input type='button' id='NewButton' value='New' onclick='javascript:doNew();' style='$newstyle' class='toolbarButton' />";

      $savestyle = (($process->Buttons & 2) && ($_REQUEST[$rsc.'ID'] != 'New')) ? 'display:block;' : 'display:none;';
      print "<input type='button' id='SaveButton' value='Save' onclick='javascript:doSave();' style='$savestyle' class='toolbarButton' />";

      $deletestyle = (($process->Buttons & 4) && ($_REQUEST[$rsc.'ID'])) ? 'display:block;' : 'display:none;';
      // print "<input type='button' id='DeleteButton' value='Delete' onclick='javascript:doRemove();' style='$deletestyle' class='toolbarButton' />";

    ?>
</div>-->
<script language='Javascript' type='text/javascript' src='/lib/js/tree.js'> </script>
<?php 
   $current = $user = $obj->getObject('Login', $_SESSION['UserID']);
   $obj->db->Module->getlist('(Access & '.$user->Access.') order by Sequence');
   
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

   $jsout = 'var sitetree = ' . json_encode($jsobj) . ";\n";

   $jsuser = 'var user = ' . json_encode($user) . ";\n";
?>
<div class='accessTree' style='z-index:999999;'>
   <div class='boxHeading'>Module &amp; Process Selection</div>
   <div id='tree_children'></div>
   <div id='tree' class='branch_open'></div>
</div>
<script language='Javascript' type='text/javascript'>
   <?php
      print $jsout;
      print $jsuser; 
   ?>
   jQuery(function($) {
      buildModulePrefTree('tree', sitetree, user);
   });
</script>
<input type='hidden' name='Login[<?php print $current->LoginID; ?>][ModulePref]' id='Access' value='<?php print $current->ModulePref; ?>' />
<input type='hidden' name='Login[<?php print $current->LoginID; ?>][ProcessPref]' id='ProcessAccess' value='<?php print $current->ProcessPref ? $current-ProcessPref : $current->ProcessAccess; ?>' />
<div class='tableGroup' style='height:100%;'>
   <div class='boxHeading'> User Preferences for <?php print $current->FirstName.' '.$current->LastName; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Name</span><input type='text' name='Login[<?php print $current->LoginID; ?>][FirstName]' id='FirstName' value='<?php print $current->FirstName; ?>' size='10' class='boxValue' style='position:relative;width:7.3em;' /><input type='text' name='Login[<?php print $current->LoginID; ?>][LastName]' id='LastName' value='<?php print $current->LastName; ?>' size='15' class='boxValue' style='position:relative;width:7.3em;' /></div>
         <div class='contentField'><span class='fieldLabel'>Passwd</span><input type='password' name='Login[<?php print $current->LoginID; ?>][Passwd]' id='Passwd' value='<?php print $current->Passwd; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Company</span><input type='text' name='Login[<?php print $current->LoginID; ?>][Company]' id='Company' value='<?php print $current->Company; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Email</span><input type='text' name='Login[<?php print $current->LoginID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>IM</span><input type='text' name='Login[<?php print $current->LoginID; ?>][JabberID]' id='JabberID' value='<?php print $current->JabberID; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Phone</span><input type='text' name='Login[<?php print $current->LoginID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='15' class='boxValue' style='position:relative;width:8em;' />
         <span>Ext.</span><input type='text' name='Login[<?php print $current->LoginID; ?>][Extension]' id='Extension' value='<?php print $current->Extension; ?>' size='5' class='boxValue' style='position:relative;width:5em;' /></div>
         <div class='contentField'><span class='fieldLabel'>Home Phone</span><input type='text' name='Login[<?php print $current->LoginID; ?>][HomePhone]' id='HomePhone' value='<?php print $current->HomePhone; ?>' size='25' class='boxValue' /></div><br/>
         <div class='contentField'><span class='fieldLabel'>&nbsp;</span><input type='checkbox' <?php print ($current->Alerts==1) ? "checked='checked'" : ''; ?> onclick="updateChecked(this, 'Alerts')"/><input type='hidden' id='Alerts' name='Login[<?php print $current->LoginID; ?>][Alerts]' value='<?php print $current->Alerts; ?>'/>  Display Javascript alert and confirmation dialogs</div>
         <div class='contentField'><span class='fieldLabel'>&nbsp;</span><input type='checkbox' <?php print ($current->ClockinReminder==1) ? " checked='checked'" : ''; ?> onclick="updateChecked(this, 'ClockinReminder')" /><input type='hidden' id='ClockinReminder' name='Login[<?php print $current->LoginID; ?>][ClockinReminder]' value='<?php print $current->ClockinReminder; ?>'/> Email login reminder if not clocked in by 9:15am.</div>
         <div class='contentField'><span class='fieldLabel'>&nbsp;</span><input type='checkbox' <?php print ($current->AutoLogin==1) ? " checked='checked'" : ''; ?> onclick="updateChecked(this, 'AutoLogin')" /><input type='hidden' id='AutoLogin' name='Login[<?php print $current->LoginID; ?>][AutoLogin]' value='<?php print $current->AutoLogin; ?>'/> Automatically clock me in when I sign in.</div>
      </span>
   </div>
</div>
