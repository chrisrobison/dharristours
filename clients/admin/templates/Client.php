<div class='tableGroup'>
   <div class='formHeading'>Client ID: <?php print $current->ClientID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Client</label><input type='text' dbtype='varchar(50)' name='Client[<?php print $current->ClientID; ?>][Client]' id='Client' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Address</label><input type='text' dbtype='varchar(50)' name='Client[<?php print $current->ClientID; ?>][Address]' id='Address' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Address2</label><input type='text' dbtype='varchar(50)' name='Client[<?php print $current->ClientID; ?>][Address2]' id='Address2' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>City</label><input type='text' dbtype='varchar(50)' name='Client[<?php print $current->ClientID; ?>][City]' id='City' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>State</label><input type='text' dbtype='varchar(25)' name='Client[<?php print $current->ClientID; ?>][State]' id='State' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Zip</label><input type='text' dbtype='varchar(25)' name='Client[<?php print $current->ClientID; ?>][Zip]' id='Zip' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Phone</label><input type='text' dbtype='varchar(50)' name='Client[<?php print $current->ClientID; ?>][Phone]' id='Phone' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Fax</label><input type='text' dbtype='varchar(50)' name='Client[<?php print $current->ClientID; ?>][Fax]' id='Fax' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Contact Name</label><input type='text' dbtype='varchar(50)' name='Client[<?php print $current->ClientID; ?>][ContactName]' id='ContactName' value='' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(50)' name='Client[<?php print $current->ClientID; ?>][Email]' id='Email' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Alt Email</label><input type='text' dbtype='varchar(50)' name='Client[<?php print $current->ClientID; ?>][AltEmail]' id='AltEmail' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Location</label><input type='text' dbtype='varchar(50)' name='Client[<?php print $current->ClientID; ?>][Location]' id='Location' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Free Trial</label><select dbtype='tinyint(4)' name='Client[<?php print $current->ClientID; ?>][FreeTrial]' id='FreeTrial'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Active</label><select dbtype='tinyint(4)' name='Client[<?php print $current->ClientID; ?>][Active]' id='Active'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Version</label><input type='text' dbtype='varchar(100)' name='Client[<?php print $current->ClientID; ?>][Version]' id='Version' value='' size='50' class='boxValue' /></div>
</div>
</div>
</div>