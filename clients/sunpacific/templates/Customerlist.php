<div class='tableGroup'>
   <div class='formHeading'>Customerlist ID: <?php print $current->CustomerlistID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Customerlist</label><input type='text' dbtype='varchar(100)' name='Customerlist[<?php print $current->CustomerlistID; ?>][Customerlist]' id='Customerlist' value='<?php print $current->Customerlist; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Customerlist[<?php print $current->CustomerlistID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
<?php print $current->Notes; ?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Customerlist[<?php print $current->CustomerlistID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>