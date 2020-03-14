<?php 
   include("editor/fckeditor.php") ;
?>
<input type='hidden' name='Resource' id='Resource' value='Nav'/>
<input type='hidden' name='t' id='t' value='Website'/>
<input type='hidden' name='x' id='x' value='<?php print (preg_match("/edit|new/", $in['x'])) ? 'update' : ''; ?>'/>
<input type='hidden' name='NavID' id='NavID' value='<?php print $in['NavID']; ?>'/>
<h1>Website Manager</h1>
<?php

   if (!$in['ContentID'] && !$in['NavID'] && $in['x']!='new') {
      $nav = $boss->utility->buildNav($boss, 0, 1, 1);
?>
   <div style='position:relative;width:100%;'>
   <p style='position:relative;width:80%;'>The table below lists each section in the website.  You may create a new section by clicking the 'Add New Section' link. 
      To edit an existing section, click the 'edit' link to the right of the section you wish to edit.  To delete a section,
      click the 'delete' link associated with that section.</p>
      
      <div style='position:relative;width:80%;'>
         <div style='width:10em;float:left;position:relative;margin:4px 1em 4px 1em;' onmouseover="this.style.backgroundColor='#ffffaa';" onmouseout="this.style.backgroundColor='transparent';"><a href='/cmd.php?t=Website&x=new&Resource=Content'><img src='/img/orange_arrow.gif' border='0' style='float:left;margin-right:3px;position:relative;top:-2px;'/>Add New Page</a></div>
         <div style='float:left;position:relative;margin:4px 1em 4px 1em;' onmouseover="this.style.backgroundColor='#ffffaa';" onmouseout="this.style.backgroundColor='transparent';"><a href='/cmd.php?t=Articles&x=new&Resource=Article&From=Website'><img src='/img/orange_arrow.gif' border='0' style='float:left;margin-right:3px;position:relative;top:-2px;'/>Add New Article</a></div><br clear='left'/>
         <div style='width:10em;float:left;position:relative;margin:4px 1em 4px 1em;' onmouseover="this.style.backgroundColor='#ffffaa';" onmouseout="this.style.backgroundColor='transparent';"><a href='/cmd.php?t=Sections&x=new&Resource=Nav&From=Website'><img src='/img/orange_arrow.gif' border='0' style='float:left;margin-right:3px;position:relative;top:-2px;'/>Add New Section</a></div>
         <div style='float:left;position:relative;margin:4px 1em 4px 1em;' onmouseover="this.style.backgroundColor='#ffffaa';" onmouseout="this.style.backgroundColor='transparent';"><a href='/cmd.php?t=Forms&x=new&Resource=Form&From=Website'><img src='/img/orange_arrow.gif' border='0' style='float:left;margin-right:3px;position:relative;top:-2px;'/>Add New Form</a></div><br clear='left'/>
      </div>
      <br clear='left'/><br/>
<?php
      $tfields = array('Section'=>'Nav', 'Status'=>'Display');
      $tbl = $boss->utility->buildODATable('Nav', $nav, 0, $tfields, 'Nav', 2);
      print "<div style='position:relative;border:1px outset #606060;height:400px;width:80%;overflow:scroll;overflow-x:auto;overflow:-moz-scrollbars-vertical;overflow-y:scroll;'><table width='100%' border='0' cellpadding='0' cellspacing='0' class='navTable'>\n".$tbl."\n</table></div>\n";
?>
      </div>
<?php
   } else {
      $nav = $boss->utility->buildNav($boss, 0, 1, 1);

      if ($in['x'] != 'new') {
         $currentNav = $boss->getObject('Nav', $in['NavID']);
         $boss->db->addResource('Content');

         if (!$in['ContentID']) {
            $boss->db->Content->get($in['NavID'], 'NavID');
         } else {
            $boss->db->Content->get($in['ContentID'], 'ContentID');
         }
         if (!$boss->db->Content->Content[0]->ContentID) {
            $new['Content']['new1']['Name'] = $currentNav->Nav;
            $new['Content']['new1']['NavID'] = $currentNav->NavID;
            $new['Content']['new1']['ParentID'] = $currentNav->ParentID;
            $newid = $boss->storeObject($new);
         } 
         $current = $boss->db->Content->Content[0];
         $currentNav = $boss->getObject('Nav', $current->NavID);
         if (!$current->ContentID) $in['x'] = 'new';
      }
      
      $boss->db->dbobj->execute('select (max(Access) * 2) from Nav');
      $boss->db->dbobj->fetch_array();
      $nextAccess = $boss->db->dbobj->row[0];
?>
<input type='hidden' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $currentNav->NavID; ?>][Nav]' id='NavNav' value='<?php print $currentNav->Nav; ?>'/>
<input type='hidden' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $currentNav->NavID; ?>][NavID]' id='NavNavID' value='<?php print $currentNav->NavID; ?>'/>
<input type='hidden' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $currentNav->NavID; ?>][ParentID]' id='NavParentID' value='<?php print $currentNav->ParentID; ?>'/>
<input type='hidden' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $currentNav->NavID; ?>][Name]' id='NavName' value='<?php print htmlspecialchars($currentNav->Name, ENT_QUOTES); ?>'/>
<input type='hidden' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $currentNav->NavID; ?>][URL]' id='NavURL' value='<?php print $currentNav->URL; ?>'/>
<input type='hidden' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $currentNav->NavID; ?>][File]' id='NavFile' value='<?php print $currentNav->File; ?>'/>
<input type='hidden' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $currentNav->NavID; ?>][Target]' id='NavTarget' value='<?php print ($currentNav->Target) ? $currentNav->Target : 'content'; ?>'/>
<input type='hidden' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $currentNav->NavID; ?>][Access]' id='NavAccess' value='<?php print ($in['x']=='new') ? $nextAccess : $currentNav->Access; ?>'/>
<input type='hidden' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $currentNav->NavID; ?>][Active]' id='NavActive' value='<?php print ($in['x']=='new') ? 1 : $currentNav->Active; ?>'/>
<input type='hidden' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $currentNav->NavID; ?>][Display]' id='NavDisplay' value='<?php print $currentNav->Display; ?>'/>
<input type='hidden' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $currentNav->NavID; ?>][TopLevel]' id='NavTopLevel' value='<?php print $currentNav->TopLevel; ?>'/>

<script language='Javascript' type='text/javascript'>
   <?php print "var navTree = " . $boss->utility->js_serialize($nav, true) .";\n"; ?>
   function $() {
      var out;
      if (arguments.length>1) {
         out = new Array();

         for (var a in arguments) {
            out[out.length] = document.getElementById(arguments[a]);
         }
      } else {
         out = document.getElementById(arguments[0]);
      }
      return out;
   }
   
   function updateNavFields(who) {
      var pid;
      if (who && who.options) {
         var par = who.options[who.selectedIndex].value;
         var parNav = getNav(navTree, par);
         // var parparNav = getNav(navTree, parNav.ParentID);
         $('NavClassName').value = (parNav.ParentID == 1) ? 'branch_closed' : 'node';
         pid = who;
      }
      $('NavNav').value = $('ContentName').value;
      $('NavName').value = $('ContentName').value;
      if (!pid) pid = $('ParentID');
      if (pid && pid.options) {
         $('NavParentID').value = pid.options[pid.selectedIndex].value;
         $('NavTopLevel').value = (pid.options[pid.selectedIndex].value == 1) ? 1 : 0;
      }
      $('NavDisplay').value = 'Active';

      makeURL();
   }
   function makeURL() {
      // First grab string user entered
      var txt = $('ContentName').value;
      
      // Eliminate any non-alphanumeric characters and saved into 'NavName' 
      // (for backend and client-side referencing and such)
      $('NavName').value = txt.replace(/\W/g, '');

      // Build a default URL path using lowercased 'NavName'
      $('NavFile').value = '/site/' + txt.replace(/\W/g, '') + '.html';
   } 
</script>
   <input type='hidden' name='Content[<?php print ($in['x']=='new') ? 'new1' : $current->ContentID; ?>][URL]' id='ContentURL' value='<?php print $current->URL; ?>'/>
   <div class='odaHead'><?php print ($in['x'] == 'new') ? 'Add New Page' : 'Edit Page'; ?></div><br/>
      <div class='odaRow'>
      <input tabindex='50' type='button' value='Cancel' style='float:right;margin-right:4em;' onclick="document.location.href='/cmd.php?t=<?php print (!$in['t']) ? 'Website' : $in['t']; ?>'" accesskey='c'/>
      <input tabindex='40' type='submit' value='Save' style='float:right;margin-right:1em;' accesskey='s'/>
         <div class='odaFloat'><label class='fieldLabel' for='Content' tabindex='10' accesskey='n'>Name</label><input tabindex='10' type='text' name='Content[<?php print ($in['x']=='new') ? 'new1' : $current->ContentID; ?>][Name]' id='ContentName' value='<?php print htmlspecialchars($current->Name, ENT_QUOTES); ?>' onchange="updateNavFields(this)"/></div>
         <div class='odaFloat'><label class='fieldLabel' for='NavClass' tabindex='15' accesskey='n'>Nav CSS Class</label><input tabindex='15' type='text' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $currentNav->NavID; ?>][ClassName]' id='NavClassName' value='<?php print $currentNav->ClassName; ?>'/></div>
         <div class='odaFloat'><label tabindex='30' class='fieldLabel' for='ParentID' style='float:left;' accesskey='p'>Section</label>
            <select tabindex='30' name='Content[<?php print ($in['x']=='new') ? 'new1' : $current->ContentID; ?>][ParentID]' id='ParentID' style='width:150px;position:relative;z-index:99999;' onchange='updateNavFields(this)'>
               <?php print $boss->utility->buildODASelect('Nav', $nav, 0, array('Nav'), $current->ParentID); ?>
            </select>
         </div>
         <script>
            function updateActive(who) {
               $('Active').value = (this.checked) ? '1' : '0';
               $('NavActive').value = (this.checked) ? '1' : '0';
               $('NavDisplay').value = (this.checked) ? 'Active' : 'Not Active';
            }
         </script>
         <input type='hidden' name='Content[<?php print ($in['x']=='new') ? 'new1' : $current->ContentID; ?>][Active]' id='Active' value='<?php print ($in['x']=='new') ? '1' : $current->Active; ?>'/>
         <div class='oda' style='z-index:-1;position:relative;left:2em;'><input tabindex='40' type='checkbox' value='1' onclick="updateActive(this)" <?php print ($current->Active || $in['x']=='new') ? "checked='checked'" : ''; ?>/><label tabindex='40' accesskey='v' class='fieldLabel2' for='Active' style='padding:2px;'>Active</label></div>

      </div><br/>
      <div class='odaRow'>
         <div class='oda'><label class='fieldLabel' for='Content' tabindex='50' accesskey='p'>Page Content</label>
         <div style='float:left;width:80%;position:relative;'>
         <?php
            $sBasePath = '/editor/';
            $oFCKeditor = new FCKeditor('Content['.(($in['x']=='new') ? 'new1' : $current->ContentID) .'][Content]');
            $oFCKeditor->BasePath = $sBasePath ;
            $oFCKeditor->Config['SkinPath'] = $sBasePath . 'editor/skins/silver/' ;
            $oFCKeditor->ToolbarSet = 'Default';
            $oFCKeditor->Height = '300';
            $oFCKeditor->Value = $current->Content;
            $oFCKeditor->Create() ;
         ?>
         </div>
      </div><br clear='left'/><br/>
      <div class='odaRow'>
         <div class='oda'><label class='fieldLabel' for='MetaKeywords' tabindex='60' accesskey='k'>Meta Keywords &nbsp;</label><textarea tabindex='60' name='Content[<?php print ($in['x']=='new') ? 'new1' : $current->ContentID; ?>][MetaKeywords]' id='MetaKeywords' style='position:relative;left:-5px;width:80.75%;'><?php print $current->MetaKeywords; ?></textarea></div>
      </div>
      <div class='odaRow'>
         <div class='oda'><label class='fieldLabel' for='MetaDescription' tabindex='70' accesskey='k'>Meta Description &nbsp; </label><textarea tabindex='70' name='Content[<?php print ($in['x']=='new') ? 'new1' : $current->ContentID; ?>][MetaDescription]' id='MetaDescription' style='position:relative;left:-5px;width:80.75%;'><?php print $current->MetaDescription; ?></textarea></div>
      </div>
      <br clear='left'/>
      <div id='pictures'>
         <div class='picture'>
            <img src='<?php print $currentNav->Picture1; ?>' id='Picture1Img' onclick="chooseImage('Picture1')"/>
            <input type='hidden' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $currentNav->NavID; ?>][Picture1]' id='Picture1' value='<?php print $currentNav->Picture1; ?>'/>
            <input type='button' value='Choose Image' onclick="chooseImage('Picture1')" class='imgBtn' style='width:100px;'/>
         </div>
         <div class='picture'>
            <img src='<?php print $currentNav->Picture2; ?>' id='Picture2Img' onclick="chooseImage('Picture2')"/>
            <input type='hidden' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $currentNav->NavID; ?>][Picture2]' id='Picture2' value='<?php print $currentNav->Picture2; ?>'/>
            <input type='button' value='Choose Image' onclick="chooseImage('Picture2')" class='imgBtn' style='width:100px;'/>
         </div>
         <div class='bigpicture'>
            <img src='<?php print $currentNav->Picture3; ?>' id='Picture3Img' onclick="chooseImage('Picture3')"/>
            <input type='hidden' name='Nav[<?php print ($in['x']=='new') ? 'new1' : $currentNav->NavID; ?>][Picture3]' id='Picture3' value='<?php print $currentNav->Picture3; ?>'/>
            <input type='button' value='Choose Image' onclick="chooseImage('Picture3')" class='imgBtn' style='width:100px;'/>
         </div>
         <div class='bigpicture'>
            Flash: <textarea name='Nav[<?php print ($in['x']=='new') ? 'new1' : $currentNav->NavID; ?>][Flash]' id='Flash' rows='5' cols='100'><?php print $currentNav->Flash; ?></textarea>
         </div>
      </div>
      <br/>
      <input tabindex='50' type='button' value='Cancel' style='float:right;margin-right:4em;' onclick="document.location.href='/cmd.php?t=<?php print (!$in['t']) ? 'Website' : $in['t']; ?>'" accesskey='c'/>
      <input tabindex='40' type='submit' value='Save' onclick='updateNavFields()' style='float:right;margin-right:1em;' accesskey='s'/>
      <?php if ($in['x']=='new') { ?> <script type='text/javascript'> setTimeout("$('ContentName').select()", 500); </script> <?php } ?>
      <?php
   }
?>

