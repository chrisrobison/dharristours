<?php 
if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
session_start();
if (!$process) $process = $boss->getObject("Process", $in['pid']);
$trackstyle = ($_REQUEST[$rsc.'ID']) ? 'display:block' : 'display:none;';
$trackstyle = 'display:none;';
if ($process->NoTrack) $trackstyle = 'display:none;';

?>
<div id='toolbar'>
   <?php if (!$process->NoTrack) { ?>
   <div id='timetrack' style='<?php print $trackstyle; ?>'>
      <span id='TrackLabel'> Time to complete:</span> <input type='text' id='TrackQuantity' name='Track[new1][Quantity]' size='3' class='timetrack' /><select name='Track[new1][Unit]'><option>Minutes</option><option>Hours</option><option>Days</option></select>
      <input type='hidden' name='Track[new1][Email]' value='<?php print $_SESSION['Email']; ?>' />
   </div>
   <?php } 
   
   if (!$nosearch && !$process->NoSearch) { ?>
   <div id='searchField'>
      <img src='/img/round_search.png' id='SearchImg' height='24' width='24' tabindex='20' /><input type='text' name='searchValue' id='searchValue' value='Search' onfocus='this.select();this.color="#000"' onblur='this.color="#aaa"' onkeypress="if (event.keyCode==13) { return false;} else { setTimeout(function() { filterTable(document.forms[0].searchValue.value); }, 25); }" tabindex='10' />
   </div>
   <?php } 
      $rsc = $in['rsc'] ? $in['rsc'] : (isset($in['Resource']) && ($in['Resource'] != 'undefined') && ($in['Resource'] != '')) ? $in['Resource'] : null;
      $btn = $process->Buttons;
      
      if ($btn & 1) {
         $newstyle = ($btn & 1) ? 'display:block;' : 'display:none;';
         print "<a id='NewButton' title='New entry' class='simpleButton' style='$newstyle'><span class='ui-icon ui-icon-plus'> </span>New</a>";
      }
      if ($btn & 1) {
         $copystyle = (($btn & 1) && ($_REQUEST[$rsc.'ID'] || $_REQUEST['ID'])) ? 'display:block;' : 'display:none;';
         print "<a id='CopyButton' title='Copy entry' class='simpleButton' style='$copystyle'><span class='ui-icon ui-icon-copy'> </span>Copy</a>";
      }

      if ($btn & 2) {
         $savestyle = (($btn & 2) && ($_REQUEST[$rsc.'ID']) && ($_REQUEST[$rsc.'ID'] != 'New')) ? 'display:block;' : 'display:none;';
         print "<a id='SaveButton' title='Save changes to current entry' class='simpleButton' style='$savestyle'><span class='ui-icon ui-icon-disk'> </span>Save</a>";
      }

      if ($btn & 4) {
         $deletestyle = (($btn & 4) && ($_REQUEST[$rsc.'ID'])) ? 'display:block;' : 'display:none;';
         print "<a id='DeleteButton' title='Delete current entry' class='simpleButton' style='$deletestyle'><span class='ui-icon ui-icon-trash'> </span>Delete</a>";
      }

      if ($btn & 8) {
         $printstyle = (($btn & 8) && ($_REQUEST[$rsc.'ID'])) ? 'display:block;' : 'display:none;';
         print "<a id='PrintButton' title='Print current entry' class='simpleButton' style='$printstyle'><span class='ui-icon ui-icon-print'> </span>Print</a>";
      }
      
      if ($btn & 16)  {
         $columnsstyle = ($btn & 16) ? 'display:block;' : 'display:none;';
         print "<a id='ColumnsButton' title='Select which columns to display in the overview table' class='simpleButton' style='$columnsstyle'><span class='ui-icon ui-icon-newwin'> </span>Columns</a>";
      }

      if ($btn & 32)  {
         $exportstyle = ($btn & 32) ? 'display:block;' : 'display:none;';
         print "<a id='ExportButton' title='Export data associated with current view' class='simpleButton' style='$exportstyle'><span class='ui-icon ui-icon-extlink'> </span>Export</a>";
      }
 
    ?>
</div>

