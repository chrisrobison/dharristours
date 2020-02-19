<div class='tableGroup'>
   <div class='formHeading'>Customers ID: <?php print $current->CustomersID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Customers</label><input type='text' dbtype='varchar(100)' name='Customers[<?php print $current->CustomersID; ?>][Customers]' id='Customers' value='<?php print $current->Customers; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Customers[<?php print $current->CustomersID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Address</label><input type='text' dbtype='varchar(100)' name='Customers[<?php print $current->CustomersID; ?>][Address]' id='Address' value='<?php print $current->Address; ?>' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Customers[<?php print $current->CustomersID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>