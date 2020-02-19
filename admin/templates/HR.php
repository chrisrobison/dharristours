<div class='tableGroup'>
   <div class='boxHeading'> HR ID: <?php print $current->HRID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>HR</span><input type='text' name='HR[<?php print $current->HRID; ?>][HR]' id='HR' value='<?php print $current->HR; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='HR[<?php print $current->HRID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Name</span><input type='text' name='HR[<?php print $current->HRID; ?>][Name]' id='Name' value='<?php print $current->Name; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Hire Date</span><input type='text' name='HR[<?php print $current->HRID; ?>][HireDate]' id='HireDate' value='<?php print $current->HireDate; ?>' size='25' class='boxValue' /></div>
      </span>
   </div>
</div>