<div class='tableGroup'>
   <div class='boxHeading'> Company ID: <?php print $current->CompanyID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Company</span><input type='text' name='Company[<?php print $current->CompanyID; ?>][Company]' id='Company' value='<?php print $current->Company; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='Company[<?php print $current->CompanyID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
   </div>
</div>