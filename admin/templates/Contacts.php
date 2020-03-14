<div class='tableGroup'>
   <div class='boxHeading'> Contact ID: <?php print $current->ContactID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Contact</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][Contact]' id='Contact' value='<?php print $current->Contact; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>First Name</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][FirstName]' id='FirstName' value='<?php print $current->FirstName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Last Name</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][LastName]' id='LastName' value='<?php print $current->LastName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Title</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][Title]' id='Title' value='<?php print $current->Title; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Company</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][Company]' id='Company' value='<?php print $current->Company; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Email</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Status</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][Status]' id='Status' value='<?php print $current->Status; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Category</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][Category]' id='Category' value='<?php print $current->Category; ?>' size='20' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Active</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][Active]' id='Active' value='<?php print $current->Active; ?>' size='10' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Comments</span><textarea name='Contact[<?php print $current->ContactID; ?>][Comments]' id='Comments' class='textBox' style='width:41em;height:5em;'><?php print $current->Comments; ?></textarea></div>
      </span>
   </div>
</div>
