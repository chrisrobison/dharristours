<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> UserAccounts ID: <?php print $current->UserAccountsID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>User Accounts</label><input type='text' dbtype='varchar(100)' name='UserAccounts[<?php print $current->UserAccountsID; ?>][UserAccounts]' id='UserAccounts' value='' size='50' class='boxValue' /></div>

         <div class='contentField'><label>Domain ID</label><?php $boss->db->addResource("Domain");$arr = $boss->db->Domain->getlist();print $boss->utility->buildSelect($arr, $current->DomainID, "DomainID", "Domain", "UserAccounts[$current->UserAccountsID][DomainID]")."</div>";?>
         <div class='contentField'><label>Domain User</label><input type='text' dbtype='varchar(100)' name='UserAccounts[<?php print $current->UserAccountsID; ?>][DomainUser]' id='DomainUser' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Domain Pwd</label><input type='text' dbtype='varchar(100)' name='UserAccounts[<?php print $current->UserAccountsID; ?>][DomainPwd]' id='DomainPwd' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(100)' name='UserAccounts[<?php print $current->UserAccountsID; ?>][Email]' id='Email' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Email Pwd</label><input type='text' dbtype='varchar(100)' name='UserAccounts[<?php print $current->UserAccountsID; ?>][EmailPwd]' id='EmailPwd' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Distribution Lists</label><textarea dbtype='text' name='UserAccounts[<?php print $current->UserAccountsID; ?>][DistributionLists]' id='DistributionLists' class='textBox'></textarea></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Kitty User</label><input type='text' dbtype='varchar(100)' name='UserAccounts[<?php print $current->UserAccountsID; ?>][KittyUser]' id='KittyUser' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Kitty Pwd</label><input type='text' dbtype='varchar(100)' name='UserAccounts[<?php print $current->UserAccountsID; ?>][KittyPwd]' id='KittyPwd' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Online User</label><input type='text' dbtype='varchar(100)' name='UserAccounts[<?php print $current->UserAccountsID; ?>][OnlineUser]' id='OnlineUser' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Online Pwd</label><input type='text' dbtype='varchar(100)' name='UserAccounts[<?php print $current->UserAccountsID; ?>][OnlinePwd]' id='OnlinePwd' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Crystal User</label><input type='text' dbtype='varchar(100)' name='UserAccounts[<?php print $current->UserAccountsID; ?>][CrystalUser]' id='CrystalUser' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Crystal Pwd</label><input type='text' dbtype='varchar(100)' name='UserAccounts[<?php print $current->UserAccountsID; ?>][CrystalPwd]' id='CrystalPwd' value='' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='UserAccounts[<?php print $current->UserAccountsID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>