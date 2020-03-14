<div class='tableGroup'>
   <div class='boxHeading'> HR_NoteToSupervisor ID: <?php print $current->HR_NoteToSupervisorID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Note Title</span><input type='text' name='HR_NoteToSupervisor[<?php print $current->HR_NoteToSupervisorID; ?>][HR_NoteToSupervisor]' id='HR_NoteToSupervisor' value='<?php print $current->HR_NoteToSupervisor; ?>' size='50' class='boxValue' /></div>
         <input type='hidden' name='HR_NoteToSupervisor[<?php print $current->HR_NoteToSupervisorID; ?>][EmployeeID]' value='<?php print $_SESSION['Employee']->EmployeeID; ?>'/>
         <input type='hidden' name='HR_NoteToSupervisor[<?php print $current->HR_NoteToSupervisorID; ?>][SupervisorID]' value='<?php print $_SESSION['Employee']->SupervisorID; ?>'/>
        <div class='contentField'><span class='fieldLabel'>Note</span><textarea name='HR_NoteToSupervisor[<?php print $current->HR_NoteToSupervisorID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
      <span class='fieldcolumn'>
      </span>
   </div>
</div>
