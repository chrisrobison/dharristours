<div class='tableGroup'>
   <div class='boxHeading'> Leads ID: <?php print $current->LeadsID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Leads</span><input type='text' name='Leads[<?php print $current->LeadsID; ?>][Leads]' id='Leads' value='<?php print $current->Leads; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='Leads[<?php print $current->LeadsID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Company Name</span><input type='text' name='Leads[<?php print $current->LeadsID; ?>][CompanyName]' id='CompanyName' value='<?php print $current->CompanyName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Contact Last Name</span><input type='text' name='Leads[<?php print $current->LeadsID; ?>][ContactLastName]' id='ContactLastName' value='<?php print $current->ContactLastName; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Contact First Name</span><input type='text' name='Leads[<?php print $current->LeadsID; ?>][ContactFirstName]' id='ContactFirstName' value='<?php print $current->ContactFirstName; ?>' size='25' class='boxValue' /></div>
      </span>
   </div>
</div>