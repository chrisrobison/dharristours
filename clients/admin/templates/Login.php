<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> Login ID: <?php print $current->LoginID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Login</label><input type='text' dbtype='varchar(100)' name='Login[<?php print $current->LoginID; ?>][Login]' id='Login' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Passwd</label><input type='password' dbtype='varchar(50)' name='Login[<?php print $current->LoginID; ?>][Passwd]' id='Passwd' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>First Name</label><input type='text' dbtype='varchar(75)' name='Login[<?php print $current->LoginID; ?>][FirstName]' id='FirstName' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Last Name</label><input type='text' dbtype='varchar(75)' name='Login[<?php print $current->LoginID; ?>][LastName]' id='LastName' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(75)' name='Login[<?php print $current->LoginID; ?>][Email]' id='Email' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Jabber </label><?php $boss->db->addResource("Jabber");$arr = $boss->db->Jabber->getlist();print $boss->utility->buildSelect($arr, $current->JabberID, "JabberID", "Jabber", "Login[$current->LoginID][JabberID]")."</div>";?>
         <div class='contentField'><label>Phone</label><input type='text' dbtype='varchar(25)' name='Login[<?php print $current->LoginID; ?>][Phone]' id='Phone' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Extension</label><input type='text' dbtype='varchar(25)' name='Login[<?php print $current->LoginID; ?>][Extension]' id='Extension' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Home Phone</label><input type='text' dbtype='varchar(25)' name='Login[<?php print $current->LoginID; ?>][HomePhone]' id='HomePhone' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Access</label><input type='text' dbtype='bigint(20)' name='Login[<?php print $current->LoginID; ?>][Access]' id='Access' value='' size='20' class='boxValue' /></div>
         <div class='contentField'><label>Process Access</label><input type='text' dbtype='bigint(20)' name='Login[<?php print $current->LoginID; ?>][ProcessAccess]' id='ProcessAccess' value='' size='20' class='boxValue' /></div>
         <div class='contentField'><label>Module Pref</label><input type='text' dbtype='bigint(20)' name='Login[<?php print $current->LoginID; ?>][ModulePref]' id='ModulePref' value='' size='20' class='boxValue' /></div>
         <div class='contentField'><label>Process Pref</label><input type='text' dbtype='bigint(20)' name='Login[<?php print $current->LoginID; ?>][ProcessPref]' id='ProcessPref' value='' size='20' class='boxValue' /></div>
         <div class='contentField'><label>Initial Process</label><input type='text' dbtype='int(11)' name='Login[<?php print $current->LoginID; ?>][InitialProcess]' id='InitialProcess' value='' size='11' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Alerts</label><input type='text' dbtype='varchar(25)' name='Login[<?php print $current->LoginID; ?>][Alerts]' id='Alerts' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Last Login</label><input type='text' dbtype='datetime' name='Login[<?php print $current->LoginID; ?>][LastLogin]' id='LastLogin' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Last Seen</label><input type='text' dbtype='datetime' name='Login[<?php print $current->LoginID; ?>][LastSeen]' id='LastSeen' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Logged In</label><select dbtype='tinyint(1)' name='Login[<?php print $current->LoginID; ?>][LoggedIn]' id='LoggedIn'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Clocked In</label><select dbtype='tinyint(4)' name='Login[<?php print $current->LoginID; ?>][ClockedIn]' id='ClockedIn'><option value='0'>No</option><option value='1'>Yes</option></select></div>

         <div class='contentField'><label>Employee </label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "Login[$current->LoginID][EmployeeID]")."</div>";?>
         <div class='contentField'><label>Business </label><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist();print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "Login[$current->LoginID][BusinessID]")."</div>";?>
         <div class='contentField'><label>Clockin Reminder</label><select dbtype='tinyint(1)' name='Login[<?php print $current->LoginID; ?>][ClockinReminder]' id='ClockinReminder'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Auto Login</label><select dbtype='tinyint(1)' name='Login[<?php print $current->LoginID; ?>][AutoLogin]' id='AutoLogin'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Timeclock Style</label><input type='text' dbtype='varchar(50)' name='Login[<?php print $current->LoginID; ?>][TimeclockStyle]' id='TimeclockStyle' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Nav Access</label><input type='text' dbtype='varchar(200)' name='Login[<?php print $current->LoginID; ?>][NavAccess]' id='NavAccess' value='' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Login[<?php print $current->LoginID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>