<div class='tableGroup'>
   <div class='formHeading'>SuperRule ID: <?php print $current->SuperRuleID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Super Rule</label><input type='text' dbtype='varchar(100)' name='SuperRule[<?php print $current->SuperRuleID; ?>][SuperRule]' id='SuperRule' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='SuperRule[<?php print $current->SuperRuleID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>

      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Document</label><textarea dbtype='text' name='SuperRule[<?php print $current->SuperRuleID; ?>][Document]' id='Document' class='textBox'></textarea></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='SuperRule[<?php print $current->SuperRuleID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>