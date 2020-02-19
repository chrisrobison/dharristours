<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> YahooContacts ID: <?php print $current->YahooContactsID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Yahoo Contacts</label><input type='text' dbtype='varchar(100)' name='YahooContacts[<?php print $current->YahooContactsID; ?>][YahooContacts]' id='YahooContacts' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='YahooContacts[<?php print $current->YahooContactsID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>

      </div>
      <div class='fieldcolumn'>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='YahooContacts[<?php print $current->YahooContactsID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>