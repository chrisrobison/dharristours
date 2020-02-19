<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> Cigna ID: <?php print $current->CignaID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>30-MINUTE MEAL BREAK WAIVER
Cigna</label><input type='text' dbtype='varchar(100)' name='Cigna[<?php print $current->CignaID; ?>][Cigna]' id='Cigna' value='' size='50' class='boxValue' /></div>

         <div class='contentField'><label>Plan Name</label><input type='text' dbtype='varchar(100)' name='Cigna[<?php print $current->CignaID; ?>][PlanName]' id='PlanName' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>First Name</label><input type='text' dbtype='varchar(100)' name='Cigna[<?php print $current->CignaID; ?>][FirstName]' id='FirstName' value='' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Last Name</label><input type='text' dbtype='varchar(100)' name='Cigna[<?php print $current->CignaID; ?>][LastName]' id='LastName' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Employee Num</label><input type='text' dbtype='varchar(100)' name='Cigna[<?php print $current->CignaID; ?>][EmployeeNum]' id='EmployeeNum' value='' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Cigna[<?php print $current->CignaID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>