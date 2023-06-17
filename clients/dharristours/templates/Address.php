<div class='tableGroup'>
   <div class='formHeading'>Address ID: <?php print $current->AddressID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Address</label><input type='text' dbtype='varchar(200)' name='Address[<?php print $current->AddressID; ?>][Address]' id='Address' value='<?php print $current->Address; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>City</label><input type='text' dbtype='varchar(100)' name='Address[<?php print $current->AddressID; ?>][City]' id='City' value='<?php print $current->City; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>State</label><input type='text' dbtype='varchar(5)' name='Address[<?php print $current->AddressID; ?>][State]' id='State' value='<?php print $current->State; ?>' size='5' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Zip</label><input type='text' dbtype='varchar(15)' name='Address[<?php print $current->AddressID; ?>][Zip]' id='Zip' value='<?php print $current->Zip; ?>' size='15' class='boxValue' /></div>
         <div class='contentField'><label>Nickname</label><input type='text' dbtype='varchar(100)' name='Address[<?php print $current->AddressID; ?>][Nickname]' id='Nickname' value='<?php print $current->Nickname; ?>' size='50' class='boxValue' /></div>
</div>
</div>
</div>