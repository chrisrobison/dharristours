<div class='tableGroup'>
   <h1 class='boxHeading'> SugarDaddy ID: <?php print $current->SugarDaddyID; ?></h1>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Sugar Daddy</label><input type='text' dbtype='varchar(100)' name='SugarDaddy[<?php print $current->SugarDaddyID; ?>][SugarDaddy]' id='SugarDaddy' value='<?php print $current->SugarDaddy; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?></div>
         <div class='contentField'><label>Phone</label><input type='text' dbtype='varchar(100)' name='SugarDaddy[<?php print $current->SugarDaddyID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Salary</label><input type='text' dbtype='decimal(10,2)' name='SugarDaddy[<?php print $current->SugarDaddyID; ?>][Salary]' id='Salary' value='<?php print $current->Salary; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Rank</label><input type='text' dbtype='int(15)' name='SugarDaddy[<?php print $current->SugarDaddyID; ?>][Rank]' id='Rank' value='<?php print $current->Rank; ?>' size='15' class='boxValue' /></div>
         <div class='contentField'><label>City</label><input type='text' dbtype='varchar(100)' name='SugarDaddy[<?php print $current->SugarDaddyID; ?>][City]' id='City' value='<?php print $current->City; ?>' size='50' class='boxValue' /></div>
</div>
         <div class='contentField'><label>Notes</label><textarea dbtype='text' name='SugarDaddy[<?php print $current->SugarDaddyID; ?>][Notes]' id='Notes' class='textBox'></textarea></div>
</div>