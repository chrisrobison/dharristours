<div class='tableGroup'>
   <div class='formHeading'>PayrollAdvance ID: <?php print $current->PayrollAdvanceID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Payroll Advance</label><input type='text' dbtype='varchar(100)' name='PayrollAdvance[<?php print $current->PayrollAdvanceID; ?>][PayrollAdvance]' id='PayrollAdvance' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='PayrollAdvance[<?php print $current->PayrollAdvanceID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>

      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Amount</label><input type='text' dbtype='decimal(10,2)' name='PayrollAdvance[<?php print $current->PayrollAdvanceID; ?>][Amount]' id='Amount' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Paid Date</label><input type='text' dbtype='datetime' name='PayrollAdvance[<?php print $current->PayrollAdvanceID; ?>][PaidDate]' id='PaidDate' value='' size='25' class='boxValue date' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='PayrollAdvance[<?php print $current->PayrollAdvanceID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>