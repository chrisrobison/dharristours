<div class='tableGroup'>
   <div class='boxHeading'> GuestBook ID: <?php print $current->GuestBookID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Guest Book</span><input type='text' name='GuestBook[<?php print $current->GuestBookID; ?>][GuestBook]' id='GuestBook' value='<?php print $current->GuestBook; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='GuestBook[<?php print $current->GuestBookID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Rating</span><input type='text' name='GuestBook[<?php print $current->GuestBookID; ?>][Rating]' id='Rating' value='<?php print $current->Rating; ?>' size='5' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Suggestions</span><textarea name='GuestBook[<?php print $current->GuestBookID; ?>][Suggestions]' id='Suggestions' class='textBox' style='width:41em;height:5em;'><?php print $current->Suggestions; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Name</span><input type='text' name='GuestBook[<?php print $current->GuestBookID; ?>][Name]' id='Name' value='<?php print $current->Name; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Email</span><input type='text' name='GuestBook[<?php print $current->GuestBookID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Contact Allowed</span><input type='text' name='GuestBook[<?php print $current->GuestBookID; ?>][ContactAllowed]' id='ContactAllowed' value='<?php print $current->ContactAllowed; ?>' size='25' class='boxValue' /></div>
      </span>
   </div>
</div>