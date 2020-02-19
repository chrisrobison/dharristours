<div class='tableGroup'>
   <div class='boxHeading'> Address ID: <?php print $current->AddressID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Address1</span><input type='text' name='Address[<?php print $current->AddressID; ?>][Address1]' id='Address1' value='<?php print $current->Address1; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Address2</span><input type='text' name='Address[<?php print $current->AddressID; ?>][Address2]' id='Address2' value='<?php print $current->Address2; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Category</span><input type='text' name='Address[<?php print $current->AddressID; ?>][Category]' id='Category' value='<?php print $current->Category; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Active</span><input type='text' name='Address[<?php print $current->AddressID; ?>][Active]' id='Active' value='<?php print $current->Active; ?>' size='1' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>City</span><input type='text' name='Address[<?php print $current->AddressID; ?>][City]' id='City' value='<?php print $current->City; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>State</span><input type='text' name='Address[<?php print $current->AddressID; ?>][State]' id='State' value='<?php print $current->State; ?>' size='4' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Postal Code</span><input type='text' name='Address[<?php print $current->AddressID; ?>][PostalCode]' id='PostalCode' value='<?php print $current->PostalCode; ?>' size='15' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Country</span><input type='text' name='Address[<?php print $current->AddressID; ?>][Country]' id='Country' value='<?php print $current->Country; ?>' size='50' class='boxValue' /></div>
      </span>
   </div>
</div>
