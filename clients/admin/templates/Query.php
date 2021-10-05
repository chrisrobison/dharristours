<div class='tableGroup'>
   <div class='formHeading'>Query ID: <?php print $current->QueryID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Query</label><input type='text' dbtype='varchar(100)' name='Query[<?php print $current->QueryID; ?>][Query]' id='Query' value='<?php print $current->Query; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Query[<?php print $current->QueryID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>SQL</label><textarea dbtype='text' name='Query[<?php print $current->QueryID; ?>][SQL]' id='SQL' class='textBox'><?php print $current->SQL; ?></textarea></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Query[<?php print $current->QueryID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>