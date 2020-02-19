<div class='tableGroup'>
   <div class='formHeading'>Sales ID: <?php print $current->SalesID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Sales</label><input type='text' dbtype='varchar(100)' name='Sales[<?php print $current->SalesID; ?>][Sales]' id='Sales' value='<?php print $current->Sales; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Sales[<?php print $current->SalesID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Amount</label><input type='text' dbtype='decimal(10,2)' name='Sales[<?php print $current->SalesID; ?>][Amount]' id='Amount' value='<?php print $current->Amount; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Quantity</label><input type='text' dbtype='int(15)' name='Sales[<?php print $current->SalesID; ?>][Quantity]' id='Quantity' value='<?php print $current->Quantity; ?>' size='15' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Sales[<?php print $current->SalesID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>