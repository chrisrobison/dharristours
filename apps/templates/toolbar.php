<?php 
/**
 * Button bit definitions:
 *
 *       1  -  New / Copy
 *       2  -  Save
 *       4  -  Delete
 *       8  -  Print / Print Grid
 *       16 -  Import
 *       32 -  Export
 *       64 -  Relate
 * 
 **/
if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
if (!$process && $in['pid']) $process = $boss->getObject("Process", $in['pid']);
$trackstyle = 'display:none;';
?>
<div id='toolbar'>
   <?php if (!$process->NoTrack) { ?>
   <div id='timetrack' style='<?php print $trackstyle; ?>'>
      <span id='TrackLabel'> Time to complete:</span> <input type='text' id='TrackQuantity' name='Track[new1][Quantity]' size='3' class='timetrack' /><select name='Track[new1][Unit]'><option>Minutes</option><option>Hours</option><option>Days</option></select>
      <input type='hidden' name='Track[new1][Email]' value='<?php print $_SESSION['Email']; ?>' />
   </div>
   <?php } 
   
   if (!$nosearch && !$process->NoSearch) { ?>
<!--
<div id='searchField'>
      <img src='/img/round_search.png' id='SearchImg' height='24' width='24' tabindex='20' /><input type='text' name='searchValue' id='searchValue' value='Search' onfocus='this.select();this.color="#000"' onblur='this.color="#aaa"' onkeypress="if (event.keyCode==13) { return false;} else { setTimeout(function() { filterTable(document.forms[0].searchValue.value); }, 25); }" tabindex='10' />
</div>
-->
   <?php } 
      $rsc = $in['rsc'] ? $in['rsc'] : (isset($in['Resource']) && ($in['Resource'] != 'undefined') && ($in['Resource'] != '')) ? $in['Resource'] : null;
      $btn = $process->Buttons;
      
      // print "<a id='HelpButton' title='Help entry' class='simpleButton'><span class='ui-icon ui-icon-help'></span></a>";
      print "<a id='GridResetButton' title='Reset Grid Size' class='button'><span class='ui-icon ui-icon-carat-2-n-s'></span></a>";
      print "<a id='ToggleSearchButton' title='Toggle display of grid search boxes located at the top of the grid.' class='button'><span class='ui-icon ui-icon-search'></span></a>";
      print "<a style='display:none' id='GridOpenButton' title='Show Grid' class='button'><span class='ui-icon ui-icon-carat-1-s'></span></a>";
      print "<a style='display:none' id='FormOpenButton' title='Show Form' class='button'><span class='ui-icon ui-icon-carat-1-n'></span></a>";
      
      if (($btn & 1) || !$process) {
         $newstyle = ($btn & 1) ? 'display:block;' : 'display:none;';
         print "<a id='NewButton' title='New entry' class='simpleButton' style='$newstyle'><span class='ui-icon ui-icon-plus'> </span>New</a>";
      }
      if (($btn & 64) || !$process) {
         $savestyle = (($btn & 64) && ($_REQUEST[$rsc.'ID']) && ($_REQUEST[$rsc.'ID'] != 'New')) ? 'display:inline-block;' : 'display:none;';
         print "<a id='RelateButton' title='Relate records with each other' class='simpleButton' style='$savestyle'><span class='ui-icon ui-icon-transferthick-e-w'> </span>Relate</a>";
      }
      if (($btn & 2) || ($btn & 1) || !$process) {
   //      $savestyle = 'display:none;';
         print "<a id='SaveButton' title='Save changes to current entry' class='simpleButton disabled' style='$savestyle'><span class='ui-icon ui-icon-disk'> </span>Save</a>";
      }
      if (($btn & 4) || !$process) { 
         print "<a id='menuDelete'><span class='ui-icon ui-icon-trash'> </span></a>";
      }
    ?>
   <!-- <a id='SearchButton' title='Search for specific information' class='simpleButton'><span class='ui-icon ui-icon-search'> </span>Search</a> -->
   <div id='tbtnWrap'><a id='ToolsButton' rel='Tools' title='Tools to interact with your data' class='simpleButton buttonMenu'><span class='ui-icon ui-icon-wrench'> </span>Tools<span class='menuButton ui-icon ui-icon-triangle-1-s'> </span></a>
      <div id="ToolsMenu" class='menu toolsMenu'>
         <ul>
            <li id='menuSearch'><span class='ui-icon ui-icon-search'> </span> Search</li>
            <li class='divider'><hr /></li>
            <?php if (($btn & 128) || !$process) { ?>
            <li id='menuCopy'><span class='ui-icon ui-icon-copy'> </span> Copy</li>
            <?php } ?>
            <li class='divider'><hr /></li>
            <?php if (($btn & 8) || !$process) { ?>
            <li id='menuPrint'><span class='ui-icon ui-icon-print'> </span> Print Record</li>
            <li id='menuPrintGrid'><span class='ui-icon ui-icon-print'> </span> Print Grid</li>
            <?php } ?>
            <?php if (($btn & 16) || !$process) { ?>
            <li class='divider'><hr /></li>
            <li id='menuImport'><span class='ui-icon ui-icon-arrowthickstop-1-s'> </span> Import</li>
            <?php }
               if (($btn & 32) || !$process) { ?>
            <li id='menuExport'><span class='ui-icon ui-icon-arrowreturnthick-1-e'> </span> Export</li>
            <li id='menuReport'><span class='ui-icon ui-icon-extlink'> </span> Generate Report</li>
            <?php } ?>
         </ul>
      </div>
   </div>
   <div id='abtnWrap'><a id='ActionsButton' rel='Actions' title='More ways to interact with your data' class='simpleButton buttonMenu'><span class='ui-icon ui-icon-gear'> </span>Settings<span class='menuButton ui-icon ui-icon-triangle-1-s'> </span></a>
      <div id="ActionsMenu" class='menu actionMenu'>
         <ul>
            <!-- <li id='menuSearch'><span class='ui-icon ui-icon-search'> </span> Search</li> -->
            <li id='menuToggleSearch' title='Show/Hide the grid search toolbar'><span class='ui-icon ui-icon-zoomout'> </span> Toggle Search</li>
            <li id='menuColumns' title='Customize column order and visibility'><span class='ui-icon ui-icon-calculator'> </span> Columns</li>
            <li class='divider'><hr /></li>
            <li id='menuClearStorage' title='Remove all settings stored locally in your browser.\nThis will reset ALL settings and customizations you have made.'><span class='ui-icon ui-icon-trash'> </span> Clear Local Storage</li>
            <li class='divider'><hr /></li>
            <li id='menuGridExport' title='Save the current grid configuration for your login.'><span class='ui-icon ui-icon-extlink'> </span> Save Layout</li>
            <li id='menuResetLayout' title='Resets the grid layout settings for your account, restoring them to the grid defaults.'><span class='ui-icon ui-icon-refresh'> </span> Reset Layout</li>
            <li></li>
         </ul> 
      </div>
   </div>
</div>

