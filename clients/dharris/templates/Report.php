<div class='tableGroup'>
   <div class='boxHeading'> Report ID: <?php print $current->ReportID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Report</span><input type='text' name='Report[<?php print $current->ReportID; ?>][Report]' id='Report' value='<?php print $current->Report; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Template</span><input type='text' name='Report[<?php print $current->ReportID; ?>][Template]' id='Template' value='<?php print $current->Template; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Query</span><textarea name='Report[<?php print $current->ReportID; ?>][Query]' id='Query' class='textBox' style='width:41em;height:5em;'><?php print $current->Query; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Function</span><input type='text' name='Report[<?php print $current->ReportID; ?>][Function]' id='Function' value='<?php print $current->Function; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='Report[<?php print $current->ReportID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
   </div>
</div>