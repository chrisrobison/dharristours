<style>
label { text-align:left; font-size:1.1em; font-weight:bold;}
.display { background:#fff; padding:1em;margin:1em;}

</style>
<h1 class='formHeading'>ColFormat ID: <?php print $current->ColFormatID; ?></h1>
<div class='tableGroup'>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Col Format</label><input type='text' dbtype='varchar(50)' name='ColFormat[<?php print $current->ColFormatID; ?>][ColFormat]' id='ColFormat' value='' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
      </div>
   </div>
</div>
<div style='clear:left'>
   <label>Options</label>
   <!--input type='text' dbtype='varchar(101)' name='ColFormat[<?php print $current->ColFormatID; ?>][Options]' id='Options' value='' size='50' class='boxValue' /-->
   <div id='Options' class='display'></div>
   
   <label>Description</label>
   <!--<textarea dbtype='text' name='ColFormat[<?php print $current->ColFormatID; ?>][Description]' id='Description' class='textBox'></textarea>-->
   <div id='Description' class='display'></div>
</div>
