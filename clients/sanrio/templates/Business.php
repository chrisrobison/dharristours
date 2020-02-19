<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> Business ID: <?php print $current->BusinessID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Business</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][Business]' id='Business' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Business[<?php print $current->BusinessID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>

         <div class='contentField'><label>Address</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][Address]' id='Address' value='' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>City</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][City]' id='City' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>State</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][State]' id='State' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Zip</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][Zip]' id='Zip' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Phone</label><input type='text' dbtype='varchar(100)' name='Business[<?php print $current->BusinessID; ?>][Phone]' id='Phone' value='' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Business[<?php print $current->BusinessID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>