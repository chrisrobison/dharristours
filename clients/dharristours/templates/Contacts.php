<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> Contacts ID: <?php print $current->ContactsID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Contacts</label><input type='text' dbtype='varchar(100)' name='Contacts[<?php print $current->ContactsID; ?>][Contacts]' id='Contacts' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Contacts[<?php print $current->ContactsID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>

      </div>
      <div class='fieldcolumn'>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Contacts[<?php print $current->ContactsID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>