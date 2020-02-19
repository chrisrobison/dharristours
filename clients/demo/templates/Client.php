<div class='tableGroup'>
   <div class='boxHeading'> Client ID: <?php print $current->ClientID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Client</span><input type='text' name='Client[<?php print $current->ClientID; ?>][Client]' id='Client' value='<?php print $current->Client; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Address</span><input type='text' name='Client[<?php print $current->ClientID; ?>][Address]' id='Address' value='<?php print $current->Address; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Address2</span><input type='text' name='Client[<?php print $current->ClientID; ?>][Address2]' id='Address2' value='<?php print $current->Address2; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>City</span><input type='text' name='Client[<?php print $current->ClientID; ?>][City]' id='City' value='<?php print $current->City; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>State</span><input type='text' name='Client[<?php print $current->ClientID; ?>][State]' id='State' value='<?php print $current->State; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Zip</span><input type='text' name='Client[<?php print $current->ClientID; ?>][Zip]' id='Zip' value='<?php print $current->Zip; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Phone</span><input type='text' name='Client[<?php print $current->ClientID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Fax</span><input type='text' name='Client[<?php print $current->ClientID; ?>][Fax]' id='Fax' value='<?php print $current->Fax; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Contact Name</span><input type='text' name='Client[<?php print $current->ClientID; ?>][ContactName]' id='ContactName' value='<?php print $current->ContactName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Email</span><input type='text' name='Client[<?php print $current->ClientID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Alt Email</span><input type='text' name='Client[<?php print $current->ClientID; ?>][AltEmail]' id='AltEmail' value='<?php print $current->AltEmail; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Location</span><input type='text' name='Client[<?php print $current->ClientID; ?>][Location]' id='Location' value='<?php print $current->Location; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Free Trial</span><input type='text' name='Client[<?php print $current->ClientID; ?>][FreeTrial]' id='FreeTrial' value='<?php print $current->FreeTrial; ?>' size='4' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Active</span><input type='text' name='Client[<?php print $current->ClientID; ?>][Active]' id='Active' value='<?php print $current->Active; ?>' size='4' class='boxValue' /></div>
      </span>
   </div>
</div>