<div class='tableGroup'>
   <div class='formHeading'>MFX ID: <?php print $current->MFXID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>MFX</label><input type='text' dbtype='varchar(100)' name='MFX[<?php print $current->MFXID; ?>][MFX]' id='MFX' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='MFX[<?php print $current->MFXID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>

      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Document</label><textarea dbtype='text' name='MFX[<?php print $current->MFXID; ?>][Document]' id='Document' class='textBox'></textarea></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='MFX[<?php print $current->MFXID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>