<div class='tableGroup'>
   <div class='boxHeading'> Statistics ID: <?php print $current->StatisticsID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Statistics</span><input type='text' name='Statistics[<?php print $current->StatisticsID; ?>][Statistics]' id='Statistics' value='<?php print $current->Statistics; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='Statistics[<?php print $current->StatisticsID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Percentage</span><input type='text' name='Statistics[<?php print $current->StatisticsID; ?>][Percentage]' id='Percentage' value='<?php print $current->Percentage; ?>' size='25' class='boxValue' /></div>
      </span>
   </div>
</div>