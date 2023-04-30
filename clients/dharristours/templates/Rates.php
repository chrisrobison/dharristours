<div class='tableGroup'>
   <div class='formHeading'>Rates ID: <?php print $current->RatesID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Rates</label><input type='text' dbtype='varchar(100)' name='Rates[<?php print $current->RatesID; ?>][Rates]' id='Rates' value='<?php print $current->Rates; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Rates[<?php print $current->RatesID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
<?php print $current->Notes; ?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Rates[<?php print $current->RatesID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>