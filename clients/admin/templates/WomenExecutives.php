<div class='tableGroup'>
   <div class='formHeading'>WomenExecutives ID: <?php print $current->WomenExecutivesID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>First_Name</label><input type='text' dbtype='varchar(50)' name='WomenExecutives[<?php print $current->WomenExecutivesID; ?>][First_Name]' id='First_Name' value='<?php print $current->First_Name; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Last_Name</label><input type='text' dbtype='varchar(50)' name='WomenExecutives[<?php print $current->WomenExecutivesID; ?>][Last_Name]' id='Last_Name' value='<?php print $current->Last_Name; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Professional Title</label><input type='text' dbtype='varchar(100)' name='WomenExecutives[<?php print $current->WomenExecutivesID; ?>][ProfessionalTitle]' id='ProfessionalTitle' value='<?php print $current->ProfessionalTitle; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Organization</label><input type='text' dbtype='varchar(50)' name='WomenExecutives[<?php print $current->WomenExecutivesID; ?>][Organization]' id='Organization' value='<?php print $current->Organization; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>City</label><input type='text' dbtype='varchar(50)' name='WomenExecutives[<?php print $current->WomenExecutivesID; ?>][City]' id='City' value='<?php print $current->City; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>State</label><input type='text' dbtype='varchar(50)' name='WomenExecutives[<?php print $current->WomenExecutivesID; ?>][State]' id='State' value='<?php print $current->State; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='WomenExecutives[<?php print $current->WomenExecutivesID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>