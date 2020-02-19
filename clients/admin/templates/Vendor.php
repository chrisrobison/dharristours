<div class='tableGroup'>
   <div class='formHeading'>Vendor ID: <?php print $current->VendorID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Vendor</label><input type='text' dbtype='varchar(100)' name='Vendor[<?php print $current->VendorID; ?>][Vendor]' id='Vendor' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Vendor[<?php print $current->VendorID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>

         <div class='contentField'><label>Address</label><input type='text' dbtype='varchar(100)' name='Vendor[<?php print $current->VendorID; ?>][Address]' id='Address' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>City</label><input type='text' dbtype='varchar(100)' name='Vendor[<?php print $current->VendorID; ?>][City]' id='City' value='' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>State</label><input type='text' dbtype='varchar(100)' name='Vendor[<?php print $current->VendorID; ?>][State]' id='State' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Zip</label><input type='text' dbtype='varchar(100)' name='Vendor[<?php print $current->VendorID; ?>][Zip]' id='Zip' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Phone</label><input type='text' dbtype='varchar(100)' name='Vendor[<?php print $current->VendorID; ?>][Phone]' id='Phone' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Fax</label><input type='text' dbtype='varchar(100)' name='Vendor[<?php print $current->VendorID; ?>][Fax]' id='Fax' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(100)' name='Vendor[<?php print $current->VendorID; ?>][Email]' id='Email' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Contact Name</label><input type='text' dbtype='varchar(100)' name='Vendor[<?php print $current->VendorID; ?>][ContactName]' id='ContactName' value='' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Vendor[<?php print $current->VendorID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>