<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> Invites ID: <?php print $current->InvitesID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>First Name</label><input type='text' dbtype='varchar(50)' name='Invites[<?php print $current->InvitesID; ?>][FirstName]' id='FirstName' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Last Name</label><input type='text' dbtype='varchar(50)' name='Invites[<?php print $current->InvitesID; ?>][LastName]' id='LastName' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Title</label><input type='text' dbtype='varchar(100)' name='Invites[<?php print $current->InvitesID; ?>][Title]' id='Title' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Company</label><input type='text' dbtype='varchar(100)' name='Invites[<?php print $current->InvitesID; ?>][Company]' id='Company' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Address</label><input type='text' dbtype='varchar(100)' name='Invites[<?php print $current->InvitesID; ?>][Address]' id='Address' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>City</label><input type='text' dbtype='varchar(100)' name='Invites[<?php print $current->InvitesID; ?>][City]' id='City' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>State</label><input type='text' dbtype='varchar(10)' name='Invites[<?php print $current->InvitesID; ?>][State]' id='State' value='' size='10' class='boxValue' /></div>
         <div class='contentField'><label>Postal Code</label><input type='text' dbtype='varchar(25)' name='Invites[<?php print $current->InvitesID; ?>][PostalCode]' id='PostalCode' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(100)' name='Invites[<?php print $current->InvitesID; ?>][Email]' id='Email' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Alt Email</label><input type='text' dbtype='varchar(100)' name='Invites[<?php print $current->InvitesID; ?>][AltEmail]' id='AltEmail' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Phone</label><input type='text' dbtype='varchar(25)' name='Invites[<?php print $current->InvitesID; ?>][Phone]' id='Phone' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Alt Phone</label><input type='text' dbtype='varchar(25)' name='Invites[<?php print $current->InvitesID; ?>][AltPhone]' id='AltPhone' value='' size='25' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Website</label><input type='text' dbtype='varchar(100)' name='Invites[<?php print $current->InvitesID; ?>][Website]' id='Website' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Origin</label><input type='text' dbtype='varchar(100)' name='Invites[<?php print $current->InvitesID; ?>][Origin]' id='Origin' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Origin Name</label><input type='text' dbtype='varchar(100)' name='Invites[<?php print $current->InvitesID; ?>][OriginName]' id='OriginName' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Attend</label><input type='text' dbtype='varchar(25)' name='Invites[<?php print $current->InvitesID; ?>][Attend]' id='Attend' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Tickets</label><input type='text' dbtype='int(3)' name='Invites[<?php print $current->InvitesID; ?>][Tickets]' id='Tickets' value='' size='3' class='boxValue' /></div>

         <div class='contentField'><label>Invites</label><input type='text' dbtype='varchar(100)' name='Invites[<?php print $current->InvitesID; ?>][Invites]' id='Invites' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Hash</label><input type='text' dbtype='varchar(10)' name='Invites[<?php print $current->InvitesID; ?>][Hash]' id='Hash' value='' size='10' class='boxValue' /></div>
         <div class='contentField'><label>Unsub</label><select dbtype='tinyint(1)' name='Invites[<?php print $current->InvitesID; ?>][Unsub]' id='Unsub'><option value='0'>False</option><option value='1'>True</option></select></div>
         <div class='contentField'><label>Test</label><select dbtype='tinyint(1)' name='Invites[<?php print $current->InvitesID; ?>][Test]' id='Test'><option value='0'>False</option><option value='1'>True</option></select></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Invites[<?php print $current->InvitesID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>