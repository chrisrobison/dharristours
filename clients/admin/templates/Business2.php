<div class='tableGroup'>
   <div class='formHeading'>Business2 ID: <?php print $current->Business2ID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Business2</label><input type='text' dbtype='varchar(100)' name='Business2[<?php print $current->Business2ID; ?>][Business2]' id='Business2' value='<?php print $current->Business2; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Category</label><input type='text' dbtype='varchar(50)' name='Business2[<?php print $current->Business2ID; ?>][Category]' id='Category' value='<?php print $current->Category; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Sub Category</label><input type='text' dbtype='varchar(50)' name='Business2[<?php print $current->Business2ID; ?>][SubCategory]' id='SubCategory' value='<?php print $current->SubCategory; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>AKA</label><input type='text' dbtype='varchar(50)' name='Business2[<?php print $current->Business2ID; ?>][AKA]' id='AKA' value='<?php print $current->AKA; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Contact</label><input type='text' dbtype='varchar(50)' name='Business2[<?php print $current->Business2ID; ?>][Contact]' id='Contact' value='<?php print $current->Contact; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Address</label><input type='text' dbtype='varchar(50)' name='Business2[<?php print $current->Business2ID; ?>][Address]' id='Address' value='<?php print $current->Address; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>City</label><input type='text' dbtype='varchar(50)' name='Business2[<?php print $current->Business2ID; ?>][City]' id='City' value='<?php print $current->City; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>ST</label><input type='text' dbtype='varchar(50)' name='Business2[<?php print $current->Business2ID; ?>][ST]' id='ST' value='<?php print $current->ST; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>ZIP</label><input type='text' dbtype='int(5)' name='Business2[<?php print $current->Business2ID; ?>][ZIP]' id='ZIP' value='<?php print $current->ZIP; ?>' size='5' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Phone</label><input type='text' dbtype='varchar(50)' name='Business2[<?php print $current->Business2ID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>FAX</label><input type='text' dbtype='varchar(50)' name='Business2[<?php print $current->Business2ID; ?>][FAX]' id='FAX' value='<?php print $current->FAX; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>License</label><input type='text' dbtype='int(6)' name='Business2[<?php print $current->Business2ID; ?>][License]' id='License' value='<?php print $current->License; ?>' size='6' class='boxValue' /></div>
         <div class='contentField'><label>Ethnicity</label><input type='text' dbtype='varchar(50)' name='Business2[<?php print $current->Business2ID; ?>][Ethnicity]' id='Ethnicity' value='<?php print $current->Ethnicity; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(50)' name='Business2[<?php print $current->Business2ID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Business2[<?php print $current->Business2ID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>