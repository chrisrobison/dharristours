<div class='tableGroup'>
   <div class='formHeading'> Business ID: <?php print $current->BusinessID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Business Name</span><input type='text' disabled='disabled' name='Business[<?php print $current->BusinessID; ?>][Business]' id='Business' value='<?php print $current->Business; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Phone</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='20' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Fax</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][Fax]' id='Fax' value='<?php print $current->Fax; ?>' size='20' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notify Email</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Attn To</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][AttnTo]' id='AttnTo' value='<?php print $current->AttnTo; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Address</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][Address1]' id='Address1' value='<?php print $current->Address1; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>City</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][City]' id='City' value='<?php print $current->City; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>State</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][State]' id='State' value='<?php print $current->State; ?>' size='2' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Zip</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][Zip]' id='Zip' value='<?php print $current->Zip; ?>' size='10' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Bill Address</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][BillAddress1]' id='BillAddress1' value='<?php print $current->BillAddress1; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Bill Address2</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][BillAddress2]' id='BillAddress2' value='<?php print $current->BillAddress2; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Bill City</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][BillCity]' id='BillCity' value='<?php print $current->BillCity; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Bill State</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][BillState]' id='BillState' value='<?php print $current->BillState; ?>' size='2' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Bill Zip</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][BillZip]' id='BillZip' value='<?php print $current->BillZip; ?>' size='10' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Bill Phone</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][BillPhone]' id='BillPhone' value='<?php print $current->BillPhone; ?>' size='20' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Bill Fax</span><input type='text' name='Business[<?php print $current->BusinessID; ?>][BillFax]' id='BillFax' value='<?php print $current->BillFax; ?>' size='20' class='boxValue' /></div>
      </span>
   </div>
</div>
