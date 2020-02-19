<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> DisciplinaryNote ID: <?php print $current->DisciplinaryNoteID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Disciplinary Note</label><input type='text' dbtype='varchar(100)' name='DisciplinaryNote[<?php print $current->DisciplinaryNoteID; ?>][DisciplinaryNote]' id='DisciplinaryNote' value='' size='50' class='boxValue' /></div>

      </div>
      <div class='fieldcolumn'>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='DisciplinaryNote[<?php print $current->DisciplinaryNoteID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>