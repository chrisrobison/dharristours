<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> Domain ID: <?php print $current->DomainID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Domain</label><input type='text' dbtype='varchar(100)' name='Domain[<?php print $current->DomainID; ?>][Domain]' id='Domain' value='' size='50' class='boxValue' /></div>

      </div>
      <div class='fieldcolumn'>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Domain[<?php print $current->DomainID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>