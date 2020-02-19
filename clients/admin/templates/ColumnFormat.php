<div class='tableGroup'>
   <div class='formHeading'>ColFormat ID: <?php print $current->ColFormatID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Col Format</label><input type='text' dbtype='varchar(50)' name='ColFormat[<?php print $current->ColFormatID; ?>][ColFormat]' id='ColFormat' value='<?php print $current->ColFormat; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Options</label><input type='text' dbtype='varchar(101)' name='ColFormat[<?php print $current->ColFormatID; ?>][Options]' id='Options' value='<?php print $current->Options; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Description</label><textarea dbtype='text' name='ColFormat[<?php print $current->ColFormatID; ?>][Description]' id='Description' class='textBox'><?php print $current->Description; ?></textarea></div>
</div>
</div>
</div>