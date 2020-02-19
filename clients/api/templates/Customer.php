<div class='tableGroup'>
   <div class='formHeading'>Customer ID: <?php print $current->CustomerID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Customer</label><input type='text' dbtype='varchar(100)' name='Customer[<?php print $current->CustomerID; ?>][Customer]' id='Customer' value='<?php print $current->Customer; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(100)' name='Customer[<?php print $current->CustomerID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Company Name</label><input type='text' dbtype='varchar(100)' name='Customer[<?php print $current->CustomerID; ?>][CompanyName]' id='CompanyName' value='<?php print $current->CompanyName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Address1</label><input type='text' dbtype='varchar(100)' name='Customer[<?php print $current->CustomerID; ?>][Address1]' id='Address1' value='<?php print $current->Address1; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Address2</label><input type='text' dbtype='varchar(100)' name='Customer[<?php print $current->CustomerID; ?>][Address2]' id='Address2' value='<?php print $current->Address2; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Phone</label><input type='text' dbtype='varchar(100)' name='Customer[<?php print $current->CustomerID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Fax</label><input type='text' dbtype='varchar(100)' name='Customer[<?php print $current->CustomerID; ?>][Fax]' id='Fax' value='<?php print $current->Fax; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>City</label><input type='text' dbtype='varchar(100)' name='Customer[<?php print $current->CustomerID; ?>][City]' id='City' value='<?php print $current->City; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>State</label><input type='text' dbtype='varchar(100)' name='Customer[<?php print $current->CustomerID; ?>][Region]' id='Region' value='<?php print $current->Region; ?>' size='10' class='boxValue' /></div>
         <div class='contentField'><label>Zip</label><input type='text' dbtype='varchar(100)' name='Customer[<?php print $current->CustomerID; ?>][PostalCode]' id='PostalCode' value='<?php print $current->PostalCode; ?>' size='20' class='boxValue' /></div>
         <div class='contentField'><label>Country</label><input type='text' dbtype='varchar(100)' name='Customer[<?php print $current->CustomerID; ?>][CountryCode]' id='CountryCode' value='<?php print $current->CountryCode; ?>' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Customer[<?php print $current->CustomerID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>
