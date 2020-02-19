<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> OfficeSpace ID: <?php print $current->OfficeSpaceID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Post</label><input type='text' dbtype='varchar(100)' name='OfficeSpace[<?php print $current->OfficeSpaceID; ?>][Post]' id='Post' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Sq Feet</label><input type='text' dbtype='int(3)' name='OfficeSpace[<?php print $current->OfficeSpaceID; ?>][SqFeet]' id='SqFeet' value='' size='3' class='boxValue' /></div>
         <div class='contentField'><label>Rent</label><input type='text' dbtype='varchar(50)' name='OfficeSpace[<?php print $current->OfficeSpaceID; ?>][Rent]' id='Rent' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Title</label><input type='text' dbtype='varchar(100)' name='OfficeSpace[<?php print $current->OfficeSpaceID; ?>][Title]' id='Title' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><textarea dbtype='text' name='OfficeSpace[<?php print $current->OfficeSpaceID; ?>][Description]' id='Description' class='textBox'></textarea></div>
         <div class='contentField'><label>District</label><input type='text' dbtype='varchar(50)' name='OfficeSpace[<?php print $current->OfficeSpaceID; ?>][District]' id='District' value='' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Address</label><input type='text' dbtype='varchar(50)' name='OfficeSpace[<?php print $current->OfficeSpaceID; ?>][Address]' id='Address' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Contact</label><input type='text' dbtype='varchar(50)' name='OfficeSpace[<?php print $current->OfficeSpaceID; ?>][Contact]' id='Contact' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Email</label><input type='text' dbtype='char(50)' name='OfficeSpace[<?php print $current->OfficeSpaceID; ?>][Email]' id='Email' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Phone</label><input type='text' dbtype='varchar(50)' name='OfficeSpace[<?php print $current->OfficeSpaceID; ?>][Phone]' id='Phone' value='' size='50' class='boxValue' /></div>
</div>
</div>
</div>