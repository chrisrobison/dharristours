<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> Vendor ID: <?php print $current->VendorID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Vendor</label><input type='text' dbtype='varchar(100)' name='Vendor[<?php print $current->VendorID; ?>][Vendor]' id='Vendor' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Vendor[<?php print $current->VendorID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>

         <div class='contentField'><label>Vendor Num</label><input type='text' dbtype='varchar(100)' name='Vendor[<?php print $current->VendorID; ?>][VendorNum]' id='VendorNum' value='' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Contact</label><input type='text' dbtype='varchar(100)' name='Vendor[<?php print $current->VendorID; ?>][Contact]' id='Contact' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Phone</label><input type='text' dbtype='varchar(100)' name='Vendor[<?php print $current->VendorID; ?>][Phone]' id='Phone' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Fax</label><input type='text' dbtype='varchar(100)' name='Vendor[<?php print $current->VendorID; ?>][Fax]' id='Fax' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(100)' name='Vendor[<?php print $current->VendorID; ?>][Email]' id='Email' value='' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Vendor[<?php print $current->VendorID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>