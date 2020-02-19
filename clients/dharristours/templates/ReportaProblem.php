<div class='tableGroup'>
   <div class='boxHeading'> Bug ID: <?php print $current->BugID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Title</span><input type='text' name='Bug[<?php print $current->BugID; ?>][Title]' id='Title' value='<?php print $current->Title; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Bug</span><textarea name='Bug[<?php print $current->BugID; ?>][Bug]' id='Bug' class='textBox' style='width:41em;height:5em;'><?php print $current->Bug; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Resource</span><input type='text' name='Bug[<?php print $current->BugID; ?>][Resource]' id='Resource' value='<?php print $current->Resource; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Notes</span><textarea name='Bug[<?php print $current->BugID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Status</span><input type='text' name='Bug[<?php print $current->BugID; ?>][Status]' id='Status' value='<?php print $current->Status; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Owner</span><input type='text' name='Bug[<?php print $current->BugID; ?>][Owner]' id='Owner' value='<?php print $current->Owner; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Assigned By</span><input type='text' name='Bug[<?php print $current->BugID; ?>][AssignedBy]' id='AssignedBy' value='<?php print $current->AssignedBy; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Category</span><input type='text' name='Bug[<?php print $current->BugID; ?>][Category]' id='Category' value='<?php print $current->Category; ?>' size='20' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Priority</span><input type='text' name='Bug[<?php print $current->BugID; ?>][Priority]' id='Priority' value='<?php print $current->Priority; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Module</span><input type='text' name='Bug[<?php print $current->BugID; ?>][Module]' id='Module' value='<?php print $current->Module; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Process</span><input type='text' name='Bug[<?php print $current->BugID; ?>][Process]' id='Process' value='<?php print $current->Process; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Object</span><textarea name='Bug[<?php print $current->BugID; ?>][Object]' id='Object' class='textBox' style='width:41em;height:5em;'><?php print $current->Object; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Section</span><input type='text' name='Bug[<?php print $current->BugID; ?>][Section]' id='Section' value='<?php print $current->Section; ?>' size='50' class='boxValue' /></div>
      </span>
   </div>
</div>