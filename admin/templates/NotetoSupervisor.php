<div class='tableGroup'>
   <div class='boxHeading'> NoteToSupervisor ID: <?php print $current->NoteToSupervisorID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Note Title</span><input type='text' name='NoteToSupervisor[<?php print $current->NoteToSupervisorID; ?>][NoteToSupervisor]' id='NoteToSupervisor' value='<?php print $current->NoteToSupervisor; ?>' size='50' class='boxValue' /></div>
         <input type='hidden' name='NoteToSupervisor[<?php print $current->NoteToSupervisorID; ?>][EmployeeID]' value='<?php print $_SESSION['Employee']->EmployeeID; ?>'/>
         <input type='hidden' name='NoteToSupervisor[<?php print $current->NoteToSupervisorID; ?>][SupervisorID]' value='<?php print $_SESSION['Employee']->SupervisorID; ?>'/>
        <div class='contentField'><span class='fieldLabel'>Note</span><textarea name='NoteToSupervisor[<?php print $current->NoteToSupervisorID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
      </span>
      <span class='fieldcolumn'>
      </span>
   </div>
</div>
