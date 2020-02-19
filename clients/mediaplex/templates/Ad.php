<?php 
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
   $in['Resource'] = $in['Resource'] ? $in['Resource'] : "Creative";
   $current = $boss->getObject($in['Resource'], $in['ID'], 'all');
?>         
<div class='tableGroup'>
   <div class='boxHeading'><div style="float:right;"><a href="/clients/mediaplex/ads/1/tabs.php?ID=<?php print $current->CreativeID; ?>" target="_blank">Preview Ad</a></div> Creative ID: <?php print $current->CreativeID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Creative</label><input type='text' name='Creative[<?php print $current->CreativeID; ?>][Creative]' id='Creative' value='<?php print $current->Creative; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Title</label><input type='text' name='Creative[<?php print $current->CreativeID; ?>][Title]' id='Title' value='<?php print $current->Title; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Mojo ID</label><input type='text' name='Creative[<?php print $current->CreativeID; ?>][MojoID]' id='MojoID' value='<?php print $current->MojoID; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><label>Type</label><input type='text' name='Creative[<?php print $current->CreativeID; ?>][Type]' id='Type' value='<?php print $current->Type; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Width</span><input type='text' name='Creative[<?php print $current->CreativeID; ?>][Width]' id='Width' value='<?php print $current->Width; ?>' size='5' class='boxValue' style="width:50px;" /> <span class='fieldLabel2'>Height</span><input type='text' name='Creative[<?php print $current->CreativeID; ?>][Height]' id='Height' value='<?php print $current->Height; ?>' size='5' style="width:50px;" class='boxValue' /> </div>
         <div class='contentField'><label>Stylesheet</label><input type='text' name='Creative[<?php print $current->CreativeID; ?>][Stylesheet]' id='Stylesheet' value='<?php print $current->Stylesheet; ?>' size='50' class='boxValue' /></div>
      </span>
      
      <div class="pane">
         <h2><a href="#" class='switch' rel='settings' title="Show/Hide Settings"><span class='arrow_closed'>&#x25BA;</span><span class='arrow_open hidden'>&#x25BC;</span> Settings</a></h2>
         <div id="settings" class="hidden">
            <div class='contentField'><label>Containers</label><textarea name='Creative[<?php print $current->CreativeID; ?>][Containers]' id='Containers' class='textBox'><?php print $current->Containers; ?></textarea></div>
            <div class='contentField'><label>Background</label><textarea name='Creative[<?php print $current->CreativeID; ?>][Background]' id='Background' class='textBox'><?php print $current->Background; ?></textarea></div>
            <div class='contentField'><label>Overlay</label><textarea name='Creative[<?php print $current->CreativeID; ?>][Overlay]' id='Overlay' class='textBox'><?php print $current->Overlay; ?></textarea></div>
            <div class='contentField'><label>Defaults</label><textarea name='Creative[<?php print $current->CreativeID; ?>][Defaults]' id='Defaults' class='textBox'><?php print $current->Defaults; ?></textarea></div>
            <div class='contentField'><label>Notes</label><textarea name='Creative[<?php print $current->CreativeID; ?>][Notes]' id='Notes' class='textBox'><?php print $current->Notes; ?></textarea></div>
         </div>
      </div>
   </div>
</div>
<script type='text/javascript'>
   $(document).ready(function() {
      $(".switch").click(function() {
         $(".arrow_closed", this).toggleClass("hidden");
         $(".arrow_open", this).toggleClass("hidden");
         var x = "#"+$(this).attr("rel");
         $(x).toggleClass("hidden");
      });
   });
</script>
