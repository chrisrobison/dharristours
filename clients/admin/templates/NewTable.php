<div class='tableGroup'>
   <div class='formHeading'>NewTable ID: <?php print $current->NewTableID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Cool Table</label><input type='text' dbtype='varchar(100)' name='NewTable[<?php print $current->NewTableID; ?>][NewTable]' id='NewTable' value='<?php print $current->NewTable; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='NewTable[<?php print $current->NewTableID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Amount</label><input type='text' dbtype='decimal(10,2)' name='NewTable[<?php print $current->NewTableID; ?>][Amount]' id='Amount' value='<?php print $current->Amount; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Quantity</label><input type='text' dbtype='int(15)' name='NewTable[<?php print $current->NewTableID; ?>][Quantity]' id='Quantity' value='<?php print $current->Quantity; ?>' size='15' class='boxValue' /></div>
         <div class='contentField'><label>Size</label><input type='text' dbtype='varchar(100)' name='NewTable[<?php print $current->NewTableID; ?>][Size]' id='Size' value='<?php print $current->Size; ?>' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='NewTable[<?php print $current->NewTableID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>