<div class='tableGroup'>
   <div class='formHeading'>App ID: <?php print $current->AppID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>App</label><input type='text' dbtype='varchar(100)' name='App[<?php print $current->AppID; ?>][App]' id='App' value='<?php print $current->App; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Logo</label><input type='text' dbtype='varchar(100)' name='App[<?php print $current->AppID; ?>][Logo]' id='Logo' value='<?php print $current->Logo; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Animated Logo</label><input type='text' dbtype='varchar(100)' name='App[<?php print $current->AppID; ?>][AnimatedLogo]' id='AnimatedLogo' value='<?php print $current->AnimatedLogo; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>CSS</label><input type='text' dbtype='varchar(100)' name='App[<?php print $current->AppID; ?>][CSS]' id='CSS' value='<?php print $current->CSS; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Client </label><?php $boss->db->addResource("Client");$arr = $boss->db->Client->getlist();print $boss->utility->buildSelect($arr, $current->ClientID, "ClientID", "Client", "App[$current->AppID][ClientID]")."</div>";?>
         <div class='contentField'><label>DBHost</label><input type='text' dbtype='varchar(50)' name='App[<?php print $current->AppID; ?>][DBHost]' id='DBHost' value='<?php print $current->DBHost; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>DB</label><input type='text' dbtype='varchar(100)' name='App[<?php print $current->AppID; ?>][DB]' id='DB' value='<?php print $current->DB; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>DBUser</label><input type='text' dbtype='varchar(50)' name='App[<?php print $current->AppID; ?>][DBUser]' id='DBUser' value='<?php print $current->DBUser; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>DBPwd</label><input type='text' dbtype='varchar(50)' name='App[<?php print $current->AppID; ?>][DBPwd]' id='DBPwd' value='<?php print $current->DBPwd; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Login Count</label><input type='text' dbtype='int(11)' name='App[<?php print $current->AppID; ?>][LoginCount]' id='LoginCount' value='<?php print $current->LoginCount; ?>' size='11' class='boxValue' /></div>
         <div class='contentField'><label>Host</label><input type='text' dbtype='varchar(100)' name='App[<?php print $current->AppID; ?>][Host]' id='Host' value='<?php print $current->Host; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Domain</label><input type='text' dbtype='varchar(150)' name='App[<?php print $current->AppID; ?>][Domain]' id='Domain' value='<?php print $current->Domain; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Assets</label><input type='text' dbtype='varchar(150)' name='App[<?php print $current->AppID; ?>][Assets]' id='Assets' value='<?php print $current->Assets; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Active</label><select dbtype='tinyint(1)' name='App[<?php print $current->AppID; ?>][Active]' id='Active'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->Active; ?></select></div>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(250)' name='App[<?php print $current->AppID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Passwd</label><input type='password' dbtype='varchar(100)' name='App[<?php print $current->AppID; ?>][Passwd]' id='Passwd' value='<?php print $current->Passwd; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Name</label><input type='text' dbtype='varchar(250)' name='App[<?php print $current->AppID; ?>][Name]' id='Name' value='<?php print $current->Name; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Address</label><textarea dbtype='text' name='App[<?php print $current->AppID; ?>][Address]' id='Address' class='textBox'><?php print $current->Address; ?></textarea></div>
         <div class='contentField'><label>Phone</label><input type='text' dbtype='varchar(100)' name='App[<?php print $current->AppID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Website</label><input type='text' dbtype='varchar(100)' name='App[<?php print $current->AppID; ?>][Website]' id='Website' value='<?php print $current->Website; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Source IP</label><input type='text' dbtype='varchar(50)' name='App[<?php print $current->AppID; ?>][SourceIP]' id='SourceIP' value='<?php print $current->SourceIP; ?>' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='App[<?php print $current->AppID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>