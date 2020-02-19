<div class='tableGroup'>
   <div class='formHeading'>BusDocs ID: <?php print $current->BusDocsID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Bus Docs</label><input type='text' dbtype='varchar(100)' name='BusDocs[<?php print $current->BusDocsID; ?>][BusDocs]' id='BusDocs' value='<?php print $current->BusDocs; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='BusDocs[<?php print $current->BusDocsID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
      </div>
      <div class='fieldcolumn'>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='BusDocs[<?php print $current->BusDocsID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>