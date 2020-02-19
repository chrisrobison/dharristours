<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> MonthlyBills ID: <?php print $current->MonthlyBillsID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Monthly Bills</label><input type='text' dbtype='varchar(100)' name='MonthlyBills[<?php print $current->MonthlyBillsID; ?>][MonthlyBills]' id='MonthlyBills' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='MonthlyBills[<?php print $current->MonthlyBillsID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>

      </div>
      <div class='fieldcolumn'>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='MonthlyBills[<?php print $current->MonthlyBillsID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>