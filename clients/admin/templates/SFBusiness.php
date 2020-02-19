<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> Business ID: <?php print $current->BusinessID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Business</label><input type='text' dbtype='varchar(56)' name='Business[<?php print $current->BusinessID; ?>][Business]' id='Business' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Address</label><input type='text' dbtype='varchar(51)' name='Business[<?php print $current->BusinessID; ?>][Address]' id='Address' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>City</label><input type='text' dbtype='varchar(26)' name='Business[<?php print $current->BusinessID; ?>][City]' id='City' value='' size='26' class='boxValue' /></div>
         <div class='contentField'><label>State</label><input type='text' dbtype='varchar(3)' name='Business[<?php print $current->BusinessID; ?>][State]' id='State' value='' size='3' class='boxValue' /></div>
         <div class='contentField'><label>ZIP</label><input type='text' dbtype='int(9)' name='Business[<?php print $current->BusinessID; ?>][ZIP]' id='ZIP' value='' size='9' class='boxValue' /></div>
         <div class='contentField'><label>City State Zip</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][CityStateZip]' id='CityStateZip' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Salutation</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][Salutation]' id='Salutation' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Mailing Address</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][MailingAddress]' id='MailingAddress' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Mail City State Zip</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][MailCityStateZip]' id='MailCityStateZip' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Phone</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][Phone]' id='Phone' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Fax</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][Fax]' id='Fax' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Certification Type</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][CertificationType]' id='CertificationType' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Ownership Type</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][OwnershipType]' id='OwnershipType' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>HRCCertification Number</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][HRCCertificationNumber]' id='HRCCertificationNumber' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>HRCCertification Expiration Date</label><input type='text' dbtype='datetime' name='Business[<?php print $current->BusinessID; ?>][HRCCertificationExpirationDate]' id='HRCCertificationExpirationDate' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Vendor Number</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][VendorNumber]' id='VendorNumber' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>12BCompliant</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][12BCompliant]' id='12BCompliant' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Sal</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][Sal]' id='Sal' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>First Name</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][FirstName]' id='FirstName' value='' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Last Name</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][LastName]' id='LastName' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Certification Category1</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][CertificationCategory1]' id='CertificationCategory1' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Firm Size Cert1</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][FirmSizeCert1]' id='FirmSizeCert1' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Cert Category2</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][CertCategory2]' id='CertCategory2' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Firm Size Cert2</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][FirmSizeCert2]' id='FirmSizeCert2' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Cert Category3</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][CertCategory3]' id='CertCategory3' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Firm Size Cert3</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][FirmSizeCert3]' id='FirmSizeCert3' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Cert Category4</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][CertCategory4]' id='CertCategory4' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Firm Size Cert4</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][FirmSizeCert4]' id='FirmSizeCert4' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Cert Category5</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][CertCategory5]' id='CertCategory5' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Firm Size Cert5</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][FirmSizeCert5]' id='FirmSizeCert5' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Cert Category6</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][CertCategory6]' id='CertCategory6' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Firm Size Cert6</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][FirmSizeCert6]' id='FirmSizeCert6' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Cert Category7</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][CertCategory7]' id='CertCategory7' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Firm Size Cert7</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][FirmSizeCert7]' id='FirmSizeCert7' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Cert Category8</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][CertCategory8]' id='CertCategory8' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Firm Size Cert8</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][FirmSizeCert8]' id='FirmSizeCert8' value='' size='50' class='boxValue' /></div>
</div>
</div>
</div>