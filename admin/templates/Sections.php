<input type='hidden' name='Resource' value='Nav'/>
<input type='hidden' name='t' id='t' value='Sections'/>
<input type='hidden' name='x' id='x' value='<?php print (preg_match("/edit|new/", $in['x'])) ? 'update' : ''; ?>'/>
<input type='hidden' name='NavID' id='NavID' value='<?php print $in['NavID']; ?>'/>
<input type='hidden' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $current->NavID; ?>][Name]' id='NavName' value='<?php print $current->Name; ?>'/>
<input type='hidden' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $current->NavID; ?>][URL]' id='NavURL' value='<?php print $current->URL; ?>'/>
<input type='hidden' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $current->NavID; ?>][Target]' id='NavTarget' value='<?php print ($current->Target) ? $current->Target : 'content'; ?>'/>
<script language='Javascript' type='text/javascript'>
   function makeURL() {
      // First grab string user entered
      var txt = document.getElementById('Nav').value;
      
      // Eliminate any non-alphanumeric characters and saved into 'NavName' 
      // (for backend and client-side referencing and such)
      txt = txt.replace(/\W/g, '');
      var nameEl = document.getElementById('NavName');
      if (nameEl) nameEl.value = txt;
      
      // Build a default URL path using lowercased 'NavName'
      txt = txt.toLowerCase();
      var newurl = '/site/' + txt + '.php';
      var urlEl = document.getElementById('NavURL');
      if (urlEl) urlEl.value = newurl;
   } 
</script>
<h1>Section Manager</h1>
<?php

   if (!$in['NavID'] && $in['x']!='new') {
      $boss->db->addResource('Nav');
      $boss->db->Nav->getlist("TopLevel='1' ORDER BY Sequence");
      $nav = $boss->db->Nav->Nav;
      $nav = $boss->utility->buildNav($boss, 1);
?>
   <div style='position:relative;width:100%;'>
   <p style='position:relative;width:80%;'>The table below lists each section in the website.  You may create a new section by clicking the 'Add New Section' link. 
      To edit an existing section, click the 'edit' link to the right of the section you wish to edit.  To delete a section,
      click the 'delete' link associated with that section.</p>
      
      <div style='position:relative;width:80%;'>
         <div style='float:right;position:relative;margin:4px 1em 4px 1em;' onmouseover="this.style.backgroundColor='#ffffaa';" onmouseout="this.style.backgroundColor='transparent';"><a href='/oda.php?t=OrderSections'><img src='/img/orange_arrow.gif' border='0' style='float:left;margin-right:3px;position:relative;top:-2px;'/>Order Sections</a></div>
         <div style='float:left;position:relative;left:1em;' onmouseover="this.style.backgroundColor='#ffffaa';" onmouseout="this.style.backgroundColor='transparent';"><a href='#' onclick="document.form1.x.value='new';setTimeout(function() { document.form1.submit(); }, 250);return false;"><img src='/img/orange_arrow.gif' border='0' style='float:left;margin-right:3px;position:relative;top:-2px;'/>Add New Section</a></div>
      </div>
      <br clear='left'/><br/>
<?php
      $tfields = array('Section'=>'Nav', 'Page'=>'URL');
      $tbl = $boss->utility->buildODATable('Nav', $nav, 0, $tfields);
      print "<div style='position:relative;height:500px;width:800px;overflow:scroll;overflow-x:auto;overflow:-moz-scrollbars-vertical;overflow-y:scroll;'><table width='100%' border='0' cellpadding='0' cellspacing='0' class='navTable'>\n".$tbl."\n</table></div>\n";
?>
      </div>
<?php
   } else {
      $nav = $boss->utility->buildNav($boss, 0);
?>
   <div class='odaHead'><?php print ($in['x'] == 'new') ? 'Add New Section' : 'Edit Section'; ?></div><br/>
      <div class='odaRow'>
         <div class='odaFloat'><label class='fieldLabel' for='Nav' tabindex='10' accesskey='n'>Name</label><input tabindex='10' type='text' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $current->NavID; ?>][Nav]' id='Nav' value='<?php print $current->Nav; ?>' onchange="makeURL();"/></div>
         <div class='odaFloat'><label class='fieldLabel' for='Nav' tabindex='20' accesskey='q'>Sequence</label><input tabindex='20' type='text' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $current->NavID; ?>][Sequence]' id='Sequence' value='<?php print $current->Sequence; ?>'/></div>
      </div><br clear='left'/>
      <div class='odaRow'>
         <div class='odaFloat'><label tabindex='30' class='fieldLabel' for='ParentID' style='float:left;' accesskey='p'>Parent Section</label>
            <select tabindex='30' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $current->NavID; ?>][ParentID]' id='ParentID' style='width:150px;'>
               <?php print $boss->utility->buildODASelect('Nav', $nav, 0, array('Nav'), $current->ParentID); ?>
            </select>
         </div>
         <div class='odaFloat' style='margin-left:8em;'><input tabindex='40' type='checkbox' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $current->NavID; ?>][TopLevel]' id='TopLevel' value='1' <?php print ($current->TopLevel || $in['x']!='new') ? "checked='checked'" : ''; ?>/><label tabindex='40' accesskey='v' class='fieldLabel2' for='TopLevel' style='padding:2px;'>Top Level</label></div>
         <div class='odaFloat' style='margin-left:8em;'><input tabindex='40' type='checkbox' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $current->NavID; ?>][Active]' id='Active' value='1' <?php print ($current->Active || $in['x']=='new') ? "checked='checked'" : ''; ?>/><label tabindex='40' accesskey='v' class='fieldLabel2' for='Active' style='padding:2px;'>Visible</label></div>
         <input type='hidden' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $current->NavID; ?>][Display]' value='Active'/>
      </div>
      <input tabindex='50' type='button' value='Cancel' style='float:right;margin-right:4em;' onclick="document.location.href='/oda.php?t=Sections'" accesskey='c'/>
      <input tabindex='40' type='submit' value='Save' style='float:right;margin-right:1em;' accesskey='s'/>
      <?php
      if ($in['x'] == 'new') {
      ?>
      <script language='Javascript' type='text/javascript'>
         setTimeout("document.getElementById('Nav').select()", 500);
      </script>
      <?php
      }
      ?>
<?php
   }
?>

