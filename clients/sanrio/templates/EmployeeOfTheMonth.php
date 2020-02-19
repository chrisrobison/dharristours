<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> EmployeeOfTheMonth ID: <?php print $current->EmployeeOfTheMonthID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
          <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='EmployeeOfTheMonth[<?php print $current->EmployeeOfTheMonthID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>

      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Month</label><input type='text' dbtype='datetime' name='EmployeeOfTheMonth[<?php print $current->EmployeeOfTheMonthID; ?>][Month]' id='Month' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Year</label><input type='text' dbtype='int(15)' name='EmployeeOfTheMonth[<?php print $current->EmployeeOfTheMonthID; ?>][Year]' id='Year' value='' size='15' class='boxValue' /></div>
         <div class='contentField'><label>Gift</label><input type='text' dbtype='varchar(100)' name='EmployeeOfTheMonth[<?php print $current->EmployeeOfTheMonthID; ?>][Gift]' id='Gift' value='' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='EmployeeOfTheMonth[<?php print $current->EmployeeOfTheMonthID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>