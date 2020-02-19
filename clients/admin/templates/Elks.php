<div class='tableGroup'>
   <h1 class='boxHeading'> Elks ID: <?php print $current->ElksID; ?></h1>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Elks</label><input type='text' dbtype='varchar(100)' name='Elks[<?php print $current->ElksID; ?>][Elks]' id='Elks' value='<?php print $current->Elks; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?></div>
      </div>
      <div class='fieldcolumn'>
</div>
         <div class='contentField'><label>Notes</label><textarea dbtype='text' name='Elks[<?php print $current->ElksID; ?>][Notes]' id='Notes' class='textBox'></textarea></div>
</div>