<div class='tableGroup'>
   <div class='boxHeading'> Nav ID: <?php print $current->NavID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Nav ID</span><input type='text' name='Nav[<?php print $current->NavID; ?>][NavID]' id='NavID' value='<?php print $current->NavID; ?>' size='15' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Nav</span><input type='text' name='Nav[<?php print $current->NavID; ?>][Nav]' id='Nav' value='<?php print $current->Nav; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Name</span><input type='text' name='Nav[<?php print $current->NavID; ?>][Name]' id='Name' value='<?php print $current->Name; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>URL</span><input type='text' name='Nav[<?php print $current->NavID; ?>][URL]' id='URL' value='<?php print $current->URL; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Class</span><input type='text' name='Nav[<?php print $current->NavID; ?>][Class]' id='Class' value='<?php print $current->Class; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>JS</span><input type='text' name='Nav[<?php print $current->NavID; ?>][JS]' id='JS' value='<?php print htmlspecialchars($current->JS, ENT_QUOTES); ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Target</span><input type='text' name='Nav[<?php print $current->NavID; ?>][Target]' id='Target' value='<?php print $current->Target; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Has Child</span><input type='text' name='Nav[<?php print $current->NavID; ?>][HasChild]' id='HasChild' value='<?php print $current->HasChild; ?>' size='1' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Sequence</span><input type='text' name='Nav[<?php print $current->NavID; ?>][Sequence]' id='Sequence' value='<?php print $current->Sequence; ?>' size='4' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Parent ID</span><input type='text' name='Nav[<?php print $current->NavID; ?>][ParentID]' id='ParentID' value='<?php print $current->ParentID; ?>' size='15' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Active</span><input type='text' name='Nav[<?php print $current->NavID; ?>][Active]' id='Active' value='<?php print $current->Active; ?>' size='1' class='boxValue' /></div>
      </span>
   </div>
</div>
