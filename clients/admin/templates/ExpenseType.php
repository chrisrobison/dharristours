<div class='tableGroup'>
   <div class='formHeading'>ExpenseType ID: <?php print $current->ExpenseTypeID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Expense Type</label><input type='text' dbtype='varchar(100)' name='ExpenseType[<?php print $current->ExpenseTypeID; ?>][ExpenseType]' id='ExpenseType' value='<?php print $current->ExpenseType; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='ExpenseType[<?php print $current->ExpenseTypeID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
      </div>
      <div class='fieldcolumn'>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='ExpenseType[<?php print $current->ExpenseTypeID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>