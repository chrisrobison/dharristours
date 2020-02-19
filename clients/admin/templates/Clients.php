<div class='tableGroup'>
   <h1 class='boxHeading'> Client ID: <?php print $current->ClientID; ?></h1>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Client</label><input type='text' dbtype='varchar(50)' name='Client[<?php print $current->ClientID; ?>][Client]' id='Client' value='<?php print $current->Client; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Address</label><input type='text' dbtype='varchar(50)' name='Client[<?php print $current->ClientID; ?>][Address]' id='Address' value='<?php print $current->Address; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Address2</label><input type='text' dbtype='varchar(50)' name='Client[<?php print $current->ClientID; ?>][Address2]' id='Address2' value='<?php print $current->Address2; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>City</label><input type='text' dbtype='varchar(50)' name='Client[<?php print $current->ClientID; ?>][City]' id='City' value='<?php print $current->City; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>State</label><input type='text' dbtype='varchar(25)' name='Client[<?php print $current->ClientID; ?>][State]' id='State' value='<?php print $current->State; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Zip</label><input type='text' dbtype='varchar(25)' name='Client[<?php print $current->ClientID; ?>][Zip]' id='Zip' value='<?php print $current->Zip; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Phone</label><input type='text' dbtype='varchar(50)' name='Client[<?php print $current->ClientID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Fax</label><input type='text' dbtype='varchar(50)' name='Client[<?php print $current->ClientID; ?>][Fax]' id='Fax' value='<?php print $current->Fax; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Contact Name</label><input type='text' dbtype='varchar(50)' name='Client[<?php print $current->ClientID; ?>][ContactName]' id='ContactName' value='<?php print $current->ContactName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(50)' name='Client[<?php print $current->ClientID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Alt Email</label><input type='text' dbtype='varchar(50)' name='Client[<?php print $current->ClientID; ?>][AltEmail]' id='AltEmail' value='<?php print $current->AltEmail; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Location</label><input type='text' dbtype='varchar(50)' name='Client[<?php print $current->ClientID; ?>][Location]' id='Location' value='<?php print $current->Location; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Free Trial</label><input type='text' dbtype='tinyint(4)' name='Client[<?php print $current->ClientID; ?>][FreeTrial]' id='FreeTrial' value='<?php print $current->FreeTrial; ?>' size='4' class='boxValue' /></div>
         <div class='contentField'><label>Active</label><input type='text' dbtype='tinyint(4)' name='Client[<?php print $current->ClientID; ?>][Active]' id='Active' value='<?php print $current->Active; ?>' size='4' class='boxValue' /></div>
      </div>
   </div>
</div>