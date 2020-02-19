<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> Business ID: <?php print $current->BusinessID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Business</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][Business]' id='Business' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>District</label><input type='text' dbtype='varchar(150)' name='Business[<?php print $current->BusinessID; ?>][District]' id='District' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][Email]' id='Email' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Attn To</label><input type='text' dbtype='varchar(50)' name='Business[<?php print $current->BusinessID; ?>][AttnTo]' id='AttnTo' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Address1</label><input type='text' dbtype='varchar(50)' name='Business[<?php print $current->BusinessID; ?>][Address1]' id='Address1' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Address2</label><input type='text' dbtype='varchar(50)' name='Business[<?php print $current->BusinessID; ?>][Address2]' id='Address2' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>City</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][City]' id='City' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>State</label><input type='text' dbtype='char(2)' name='Business[<?php print $current->BusinessID; ?>][State]' id='State' value='' size='2' class='boxValue' /></div>
         <div class='contentField'><label>Zip</label><input type='text' dbtype='varchar(10)' name='Business[<?php print $current->BusinessID; ?>][Zip]' id='Zip' value='' size='10' class='boxValue' /></div>
         <div class='contentField'><label>Phone</label><input type='text' dbtype='varchar(20)' name='Business[<?php print $current->BusinessID; ?>][Phone]' id='Phone' value='' size='20' class='boxValue' /></div>
         <div class='contentField'><label>Fax</label><input type='text' dbtype='varchar(20)' name='Business[<?php print $current->BusinessID; ?>][Fax]' id='Fax' value='' size='20' class='boxValue' /></div>
         <div class='contentField'><label>Bill Attn To</label><input type='text' dbtype='varchar(50)' name='Business[<?php print $current->BusinessID; ?>][BillAttnTo]' id='BillAttnTo' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Bill Address1</label><input type='text' dbtype='varchar(50)' name='Business[<?php print $current->BusinessID; ?>][BillAddress1]' id='BillAddress1' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Bill Address2</label><input type='text' dbtype='varchar(50)' name='Business[<?php print $current->BusinessID; ?>][BillAddress2]' id='BillAddress2' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Bill City</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][BillCity]' id='BillCity' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Bill State</label><input type='text' dbtype='char(2)' name='Business[<?php print $current->BusinessID; ?>][BillState]' id='BillState' value='' size='2' class='boxValue' /></div>
         <div class='contentField'><label>Bill Zip</label><input type='text' dbtype='varchar(10)' name='Business[<?php print $current->BusinessID; ?>][BillZip]' id='BillZip' value='' size='10' class='boxValue' /></div>
         <div class='contentField'><label>Bill Phone</label><input type='text' dbtype='varchar(20)' name='Business[<?php print $current->BusinessID; ?>][BillPhone]' id='BillPhone' value='' size='20' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Bill Fax</label><input type='text' dbtype='varchar(20)' name='Business[<?php print $current->BusinessID; ?>][BillFax]' id='BillFax' value='' size='20' class='boxValue' /></div>
         <div class='contentField'><label>Ship Attn To</label><input type='text' dbtype='varchar(50)' name='Business[<?php print $current->BusinessID; ?>][ShipAttnTo]' id='ShipAttnTo' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Ship Address1</label><input type='text' dbtype='varchar(50)' name='Business[<?php print $current->BusinessID; ?>][ShipAddress1]' id='ShipAddress1' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Ship Address2</label><input type='text' dbtype='varchar(50)' name='Business[<?php print $current->BusinessID; ?>][ShipAddress2]' id='ShipAddress2' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Ship City</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][ShipCity]' id='ShipCity' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Ship State</label><input type='text' dbtype='char(2)' name='Business[<?php print $current->BusinessID; ?>][ShipState]' id='ShipState' value='' size='2' class='boxValue' /></div>
         <div class='contentField'><label>Ship Zip</label><input type='text' dbtype='varchar(10)' name='Business[<?php print $current->BusinessID; ?>][ShipZip]' id='ShipZip' value='' size='10' class='boxValue' /></div>
         <div class='contentField'><label>Ship Phone</label><input type='text' dbtype='varchar(20)' name='Business[<?php print $current->BusinessID; ?>][ShipPhone]' id='ShipPhone' value='' size='20' class='boxValue' /></div>
         <div class='contentField'><label>Ship Fax</label><input type='text' dbtype='varchar(20)' name='Business[<?php print $current->BusinessID; ?>][ShipFax]' id='ShipFax' value='' size='20' class='boxValue' /></div>
         <div class='contentField'><label>Cash Only</label><select dbtype='tinyint(4)' name='Business[<?php print $current->BusinessID; ?>][CashOnly]' id='CashOnly'><option value='0'>False</option><option value='1'>True</option></select></div>
         <div class='contentField'><label>Comments</label><input type='text' dbtype='varchar(250)' name='Business[<?php print $current->BusinessID; ?>][Comments]' id='Comments' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Credit Lock</label><select dbtype='tinyint(4)' name='Business[<?php print $current->BusinessID; ?>][CreditLock]' id='CreditLock'><option value='0'>False</option><option value='1'>True</option></select></div>
         <div class='contentField'><label>Locked By</label><input type='text' dbtype='int(11)' name='Business[<?php print $current->BusinessID; ?>][LockedBy]' id='LockedBy' value='' size='11' class='boxValue' /></div>
         <div class='contentField'><label>Last Updated</label><input type='text' dbtype='timestamp' name='Business[<?php print $current->BusinessID; ?>][LastUpdated]' id='LastUpdated' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Active</label><select dbtype='tinyint(4)' name='Business[<?php print $current->BusinessID; ?>][Active]' id='Active'><option value='0'>False</option><option value='1'>True</option></select></div>
         <div class='contentField'><label>Login ID</label><?php $boss->db->addResource("Login");$arr = $boss->db->Login->getlist();print $boss->utility->buildSelect($arr, $current->LoginID, "LoginID", "Login", "Business[$current->BusinessID][LoginID]")."</div>";?>
</div>
</div>
</div>