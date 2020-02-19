<div class='tableGroup'>
   <div class='formHeading'>UserAccounts ID: <?php print $current->UserAccountsID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>User Accounts</label><input type='text' dbtype='varchar(100)' name='UserAccounts[<?php print $current->UserAccountsID; ?>][UserAccounts]' id='UserAccounts' value='<?php print $current->UserAccounts; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Domain </label><?php $boss->db->addResource("Domain");$arr = $boss->db->Domain->getlist();print $boss->utility->buildSelect($arr, $current->DomainID, "DomainID", "Domain", "UserAccounts[$current->UserAccountsID][DomainID]")."</div>";?>
         <div class='contentField'><label>Domain User</label><input type='text' dbtype='varchar(100)' name='UserAccounts[<?php print $current->UserAccountsID; ?>][DomainUser]' id='DomainUser' value='<?php print $current->DomainUser; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Domain Pwd</label><input type='text' dbtype='varchar(100)' name='UserAccounts[<?php print $current->UserAccountsID; ?>][DomainPwd]' id='DomainPwd' value='<?php print $current->DomainPwd; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(100)' name='UserAccounts[<?php print $current->UserAccountsID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Email Pwd</label><input type='text' dbtype='varchar(100)' name='UserAccounts[<?php print $current->UserAccountsID; ?>][EmailPwd]' id='EmailPwd' value='<?php print $current->EmailPwd; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Distribution Lists</label><textarea dbtype='text' name='UserAccounts[<?php print $current->UserAccountsID; ?>][DistributionLists]' id='DistributionLists' class='textBox'><?php print $current->DistributionLists; ?></textarea></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Kitty User</label><input type='text' dbtype='varchar(100)' name='UserAccounts[<?php print $current->UserAccountsID; ?>][KittyUser]' id='KittyUser' value='<?php print $current->KittyUser; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Kitty Pwd</label><input type='text' dbtype='varchar(100)' name='UserAccounts[<?php print $current->UserAccountsID; ?>][KittyPwd]' id='KittyPwd' value='<?php print $current->KittyPwd; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Online User</label><input type='text' dbtype='varchar(100)' name='UserAccounts[<?php print $current->UserAccountsID; ?>][OnlineUser]' id='OnlineUser' value='<?php print $current->OnlineUser; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Online Pwd</label><input type='text' dbtype='varchar(100)' name='UserAccounts[<?php print $current->UserAccountsID; ?>][OnlinePwd]' id='OnlinePwd' value='<?php print $current->OnlinePwd; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Crystal User</label><input type='text' dbtype='varchar(100)' name='UserAccounts[<?php print $current->UserAccountsID; ?>][CrystalUser]' id='CrystalUser' value='<?php print $current->CrystalUser; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Crystal Pwd</label><input type='text' dbtype='varchar(100)' name='UserAccounts[<?php print $current->UserAccountsID; ?>][CrystalPwd]' id='CrystalPwd' value='<?php print $current->CrystalPwd; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(100)' name='UserAccounts[<?php print $current->UserAccountsID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='UserAccounts[<?php print $current->UserAccountsID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>