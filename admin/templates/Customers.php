<div class='tableGroup'>
   <div class='boxHeading'> Contact ID: <?php print $current->ContactID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Contact ID</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][ContactID]' id='ContactID' value='<?php print $current->ContactID; ?>' size='15' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Contact</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][Contact]' id='Contact' value='<?php print $current->Contact; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='Contact[<?php print $current->ContactID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>First Name</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][FirstName]' id='FirstName' value='<?php print $current->FirstName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Last Name</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][LastName]' id='LastName' value='<?php print $current->LastName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Title</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][Title]' id='Title' value='<?php print $current->Title; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Company Name</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][CompanyName]' id='CompanyName' value='<?php print $current->CompanyName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Account Num</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][AccountNum]' id='AccountNum' value='<?php print $current->AccountNum; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Login ID</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][LoginID]' id='LoginID' value='<?php print $current->LoginID; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Login Pass</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][LoginPass]' id='LoginPass' value='<?php print $current->LoginPass; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Login Pass Hint</span><textarea name='Contact[<?php print $current->ContactID; ?>][LoginPassHint]' id='LoginPassHint' class='textBox' style='width:41em;height:5em;'><?php print $current->LoginPassHint; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Status</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][Status]' id='Status' value='<?php print $current->Status; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Contract</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][Contract]' id='Contract' value='<?php print $current->Contract; ?>' size='1' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Terms</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][Terms]' id='Terms' value='<?php print $current->Terms; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Newsletter</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][Newsletter]' id='Newsletter' value='<?php print $current->Newsletter; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Staff</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][Staff]' id='Staff' value='<?php print $current->Staff; ?>' size='1' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Category</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][Category]' id='Category' value='<?php print $current->Category; ?>' size='20' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Email</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Active</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][Active]' id='Active' value='<?php print $current->Active; ?>' size='10' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Cat Bank Newsletter</span><input type='text' name='Contact[<?php print $current->ContactID; ?>][CatBankNewsletter]' id='CatBankNewsletter' value='<?php print $current->CatBankNewsletter; ?>' size='1' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Comments</span><textarea name='Contact[<?php print $current->ContactID; ?>][Comments]' id='Comments' class='textBox' style='width:41em;height:5em;'><?php print $current->Comments; ?></textarea></div>
      </span>
   </div>
</div>