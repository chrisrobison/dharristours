<div class='tableGroup'>
   <div class='boxHeading'> Clamp ID: <?php print $current->ClampID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Local</span><input type='text' name='Clamp[<?php print $current->ClampID; ?>][Local]' id='Local' value='<?php print $current->Local; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Local ID</span><select name='Clamp[<?php print $current->ClampID; ?>][LocalID]' id='Clamp[<?php print $current->ClampID; ?>][LocalID]' class='genSelect'></select></div>         <div class='contentField'><span class='fieldLabel'>Remote</span><input type='text' name='Clamp[<?php print $current->ClampID; ?>][Remote]' id='Remote' value='<?php print $current->Remote; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Remote ID</span><select name='Clamp[<?php print $current->ClampID; ?>][RemoteID]' id='Clamp[<?php print $current->ClampID; ?>][RemoteID]' class='genSelect'></select></div>      </span>
   </div>
</div>