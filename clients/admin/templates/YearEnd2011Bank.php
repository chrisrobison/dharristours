<div class='tableGroup'>
   <div class='formHeading'>YearEnd2011Bank ID: <?php print $current->YearEnd2011BankID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Date</label><input type='text' dbtype='date' name='YearEnd2011Bank[<?php print $current->YearEnd2011BankID; ?>][Date]' id='Date' value='<?php print $current->Date; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(150)' name='YearEnd2011Bank[<?php print $current->YearEnd2011BankID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Amount</label><input type='text' dbtype='varchar(50)' name='YearEnd2011Bank[<?php print $current->YearEnd2011BankID; ?>][Amount]' id='Amount' value='<?php print $current->Amount; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Running Bal</label><input type='text' dbtype='varchar(50)' name='YearEnd2011Bank[<?php print $current->YearEnd2011BankID; ?>][RunningBal]' id='RunningBal' value='<?php print $current->RunningBal; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
<?php print $current->Notes; ?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='YearEnd2011Bank[<?php print $current->YearEnd2011BankID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>