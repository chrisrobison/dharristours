<div class='tableGroup'>
   <div class='formHeading'> Business ID: <?php print $current->BusinessID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
      <fieldset class='jobstatus' title="General">
         <legend>General Information</legend>
         <div class='contentField'><label>Active</label><select dbtype='tinyint(4)' name='Business[<?php print $current->BusinessID; ?>][Active]' id='Active'><option value='1'>Yes</option><option value='0'>No</option></select></div>
         <div class='contentField'><span class='fieldLabel'>Business Name</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][Business]' id='Business' value='<?php print $current->Business; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Category</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][Category]' id='Category' value='<?php print $current->Category; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Website</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][Website]' id='Website' value='<?php print $current->Website; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Attn To</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][AttnTo]' id='AttnTo' value='<?php print $current->AttnTo; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Address1</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][Address1]' id='Address1' value='<?php print $current->Address1; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Address2</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][Address2]' id='Address2' value='<?php print $current->Address2; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>City</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][City]' id='City' value='<?php print $current->City; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>State</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][State]' id='State' value='<?php print $current->State; ?>' size='2' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Zip</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][Zip]' id='Zip' value='<?php print $current->Zip; ?>' size='10' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Phone</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='20' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Fax</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][Fax]' id='Fax' value='<?php print $current->Fax; ?>' size='20' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Email</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
      </fieldset>
      <fieldset class='jobstatus' title="Access">
      <legend>System Settings</legend>
         <div class='contentField'><span class='fieldLabel'>Login Access</span><?php $boss->db->addResource("Login");$arr = $boss->db->Login->getlist();print $boss->utility->buildSelect($arr, $current->LoginID, "LoginID", "Email", "Business[$current->BusinessID][LoginID]");?></div>
         <div class='contentField'><label>Cash Only</label><select dbtype='tinyint(4)' name='Business[<?php print $current->BusinessID; ?>][CashOnly]' id='CashOnly'><option value='1'>Yes</option><option value='0'>No</option></select></div>
         <div class='contentField'><span class='fieldLabel'>Comments</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][Comments]' id='Comments' value='<?php print $current->Comments; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Credit Lock</label><select dbtype='tinyint(4)' name='Business[<?php print $current->BusinessID; ?>][CreditLock]' id='CreditLock'><option value='1'>Yes</option><option value='0'>No</option></select></div>
         <div class='contentField'><span class='fieldLabel'>Locked By</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][LockedBy]' id='LockedBy' value='<?php print $current->LockedBy; ?>' size='11' class='boxValue' /></div>
      </fieldset>
      </span>
      <span class='fieldcolumn'>
      <fieldset class='jobstatus' title="Billing">
      <legend>Billing</legend>
         <div class='contentField'><span class='fieldLabel'>Attn To</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][BillAttnTo]' id='BillAttnTo' value='<?php print $current->BillAttnTo; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Address1</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][BillAddress1]' id='BillAddress1' value='<?php print $current->BillAddress1; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Address2</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][BillAddress2]' id='BillAddress2' value='<?php print $current->BillAddress2; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>City</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][BillCity]' id='BillCity' value='<?php print $current->BillCity; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>State</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][BillState]' id='BillState' value='<?php print $current->BillState; ?>' size='2' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Zip</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][BillZip]' id='BillZip' value='<?php print $current->BillZip; ?>' size='10' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Phone</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][BillPhone]' id='BillPhone' value='<?php print $current->BillPhone; ?>' size='20' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Fax</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][BillFax]' id='BillFax' value='<?php print $current->BillFax; ?>' size='20' class='boxValue' /></div>
      </fieldset>
      <fieldset class='jobstatus' title="Shipping">
         <legend>Shipping</legend>
         <div class='contentField'><span class='fieldLabel'>Attn To</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][ShipAttnTo]' id='ShipAttnTo' value='<?php print $current->ShipAttnTo; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Address1</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][ShipAddress1]' id='ShipAddress1' value='<?php print $current->ShipAddress1; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Address2</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][ShipAddress2]' id='ShipAddress2' value='<?php print $current->ShipAddress2; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>City</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][ShipCity]' id='ShipCity' value='<?php print $current->ShipCity; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>State</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][ShipState]' id='ShipState' value='<?php print $current->ShipState; ?>' size='2' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Zip</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][ShipZip]' id='ShipZip' value='<?php print $current->ShipZip; ?>' size='10' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Phone</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][ShipPhone]' id='ShipPhone' value='<?php print $current->ShipPhone; ?>' size='20' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Fax</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][ShipFax]' id='ShipFax' value='<?php print $current->ShipFax; ?>' size='20' class='boxValue' /></div>
      </fieldset>
      </span>
   </div>
</div>
