<div class='tableGroup'>
   <div class='formHeading'>Location ID: <?php print $current->LocationID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Location</label><input type='text' dbtype='varchar(100)' name='Location[<?php print $current->LocationID; ?>][Location]' id='Location' value='<?php print $current->Location; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Address</label><input type='text' dbtype='varchar(100)' name='Location[<?php print $current->LocationID; ?>][Address]' id='Address' value='<?php print $current->Address; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>City</label><input type='text' dbtype='varchar(100)' name='Location[<?php print $current->LocationID; ?>][City]' id='City' value='<?php print $current->City; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>State</label><input type='text' dbtype='varchar(100)' name='Location[<?php print $current->LocationID; ?>][State]' id='State' value='<?php print $current->State; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Zip Code</label><input type='text' dbtype='varchar(100)' name='Location[<?php print $current->LocationID; ?>][ZipCode]' id='ZipCode' value='<?php print $current->ZipCode; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Latitude</label><input type='text' dbtype='varchar(100)' name='Location[<?php print $current->LocationID; ?>][Latitude]' id='Latitude' value='<?php print $current->Latitude; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Longitude</label><input type='text' dbtype='varchar(100)' name='Location[<?php print $current->LocationID; ?>][Longitude]' id='Longitude' value='<?php print $current->Longitude; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(100)' name='Location[<?php print $current->LocationID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Location[<?php print $current->LocationID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>