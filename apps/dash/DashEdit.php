<div class='tableGroup'>
   <div class='formHeading'>Dashboard ID: <?php print $current->DashboardID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Entry Title</label><input type='text' dbtype='varchar(100)' name='Dashboard[<?php print $current->DashboardID; ?>][Dashboard]' id='Dashboard' value='<?php print $current->Dashboard; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Category</label><input type='text' dbtype='varchar(100)' name='Dashboard[<?php print $current->DashboardID; ?>][Category]' id='Category' value='<?php print $current->Category; ?>' size='50' class='boxValue' /></div>
      <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Dashboard[<?php print $current->DashboardID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Url</label><input type='text' dbtype='varchar(100)' name='Dashboard[<?php print $current->DashboardID; ?>][Url]' id='Url' value='<?php print $current->Url; ?>' size='50' style='width:25em' class='boxValue' /></div>
         <div class='contentField'><label>Type</label>
            <select name='Dashboard[<?php print $current->DashboardID; ?>][Type]' id='Type'>
               <option value=''>Default</option>
               <option value='image'>Image</option>
               <option value='iframe'>Iframe</option>
               <option value='link'>Link</option>
            </select>
            <!-- <input type='text' dbtype='varchar(100)' name='Dashboard[<?php print $current->DashboardID; ?>][Type]' id='Type' value='<?php print $current->Type; ?>' size='50' class='boxValue' /> -->
         
         <!-- </div>
         <div class='contentField'> -->
            <label>Sequence</label>
            <select name='Dashboard[][Sequence]' id='Sequence'>
               <?php for ($x=1; $x<100; $x++) { 
                        print "<option value='$x'>$x</option>";
                     }
               ?>
            </select>
            <!-- <input type='text' dbtype='int(15)' name='Dashboard[<?php print $current->DashboardID; ?>][Sequence]' id='Sequence' value='<?php print $current->Sequence; ?>' size='15' class='boxValue' /> -->
         </div> 
      </div>
      <div class='contentField'><label>Content</label><textarea dbtype='text' name='Dashboard[<?php print $current->DashboardID; ?>][Content]' id='Content' class='textBox'><?php print $current->Content; ?></textarea></div>
      <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Dashboard[<?php print $current->DashboardID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div>
   </div>
</div>
