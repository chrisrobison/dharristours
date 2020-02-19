<div class='tableGroup'>
   <div class='formHeading'>Subscriber ID: <?php print $current->SubscriberID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Subscriber</label><input type='text' dbtype='varchar(100)' name='Subscriber[<?php print $current->SubscriberID; ?>][Subscriber]' id='Subscriber' value='<?php print $current->Subscriber; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Subscriber[<?php print $current->SubscriberID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(100)' name='Subscriber[<?php print $current->SubscriberID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Name</label><input type='text' dbtype='varchar(100)' name='Subscriber[<?php print $current->SubscriberID; ?>][Name]' id='Name' value='<?php print $current->Name; ?>' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Subscriber[<?php print $current->SubscriberID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>