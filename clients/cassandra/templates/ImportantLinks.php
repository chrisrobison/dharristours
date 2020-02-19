<div class='tableGroup'>
   <div class='formHeading'>ImportantLinks ID: <?php print $current->ImportantLinksID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Important Links</label><input type='text' dbtype='varchar(100)' name='ImportantLinks[<?php print $current->ImportantLinksID; ?>][ImportantLinks]' id='ImportantLinks' value='<?php print $current->ImportantLinks; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='ImportantLinks[<?php print $current->ImportantLinksID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
      </div>
      <div class='fieldcolumn'>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='ImportantLinks[<?php print $current->ImportantLinksID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>