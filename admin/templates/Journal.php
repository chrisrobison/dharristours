<div class='tableGroup'>
   <div class='boxHeading'><span style='float:right'>User: <?php print $current->Email; ?></span> Journal ID: <?php print $current->JournalID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Title</span><input type='text' name='Journal[<?php print $current->JournalID; ?>][Journal]' id='Journal' value='<?php print $current->Journal; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Category</span><input type='text' name='Journal[<?php print $current->JournalID; ?>][Category]' id='Category' value='<?php print $current->Category; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Entry</span><textarea name='Journal[<?php print $current->JournalID; ?>][Entry]' id='Entry' class='textBox' style='width:41em;height:20em;'><?php print $current->Entry; ?></textarea></div>
      </span>
   </div>
</div>
