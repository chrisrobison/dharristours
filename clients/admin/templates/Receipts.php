<div class='tableGroup'>
   <div class='formHeading'>Receipts ID: <?php print $current->ReceiptsID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Receipts</label><input type='text' dbtype='varchar(100)' name='Receipts[<?php print $current->ReceiptsID; ?>][Receipts]' id='Receipts' value='<?php print $current->Receipts; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Employee </label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "Receipts[$current->ReceiptsID][EmployeeID]")."</div>";?>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Date</label><input type='text' dbtype='datetime' name='Receipts[<?php print $current->ReceiptsID; ?>][Date]' id='Date' value='<?php print $current->Date; ?>' size='25' class='boxValue date' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Amount</label><input type='text' dbtype='decimal(10,2)' name='Receipts[<?php print $current->ReceiptsID; ?>][Amount]' id='Amount' value='<?php print $current->Amount; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Tax</label><input type='text' dbtype='decimal(10,2)' name='Receipts[<?php print $current->ReceiptsID; ?>][Tax]' id='Tax' value='<?php print $current->Tax; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Tip</label><input type='text' dbtype='decimal(10,2)' name='Receipts[<?php print $current->ReceiptsID; ?>][Tip]' id='Tip' value='<?php print $current->Tip; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Misc</label><input type='text' dbtype='decimal(10,2)' name='Receipts[<?php print $current->ReceiptsID; ?>][Misc]' id='Misc' value='<?php print $current->Misc; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Expense Type </label><?php $boss->db->addResource("ExpenseType");$arr = $boss->db->ExpenseType->getlist();print $boss->utility->buildSelect($arr, $current->ExpenseTypeID, "ExpenseTypeID", "ExpenseType", "Receipts[$current->ReceiptsID][ExpenseTypeID]")."</div>";?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Receipts[<?php print $current->ReceiptsID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>