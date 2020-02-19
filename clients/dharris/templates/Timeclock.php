<div class='tableGroup'>
   <div class='boxHeading'> Event ID: <?php print $current->EventID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Event</span><input type='text' name='Event[<?php print $current->EventID; ?>][Event]' id='Event' value='<?php print $current->Event; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Event Time</span><input type='text' name='Event[<?php print $current->EventID; ?>][EventTime]' id='EventTime' value='<?php print $current->EventTime; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Employee ID</span><select name='Event[<?php print $current->EventID; ?>][EmployeeID]' id='Event[<?php print $current->EventID; ?>][EmployeeID]' class='genSelect'><option value='2'>LT</option><option value='3'>Keys</option><option value='4'>Juana</option><option value='8'>Vincent</option><option value='9'>Amir</option></select></div>         <div class='contentField'><span class='fieldLabel'>Status Chg Ind</span><input type='text' name='Event[<?php print $current->EventID; ?>][StatusChgInd]' id='StatusChgInd' value='<?php print $current->StatusChgInd; ?>' size='4' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Status Chg To</span><input type='text' name='Event[<?php print $current->EventID; ?>][StatusChgTo]' id='StatusChgTo' value='<?php print $current->StatusChgTo; ?>' size='4' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Task ID</span><select name='Event[<?php print $current->EventID; ?>][TaskID]' id='Event[<?php print $current->EventID; ?>][TaskID]' class='genSelect'></select></div>         <div class='contentField'><span class='fieldLabel'>Task Event</span><input type='text' name='Event[<?php print $current->EventID; ?>][TaskEvent]' id='TaskEvent' value='<?php print $current->TaskEvent; ?>' size='5' class='boxValue' /></div>
      </span>
   </div>
</div>