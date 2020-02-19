<?php

if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");


if ($in['ModuleID']) {
   $boss->addModule(null, $in['ModuleID']);
   $process = $boss->Module->Modules[0];
}

if ($in['ProcessID']) {
   $boss->addProcess(null, $in['ProcessID']);
   $process = $boss->Process->Processes[0];
}

$db = $boss->db;

$rsc = ($in['Resource']) ? $in['Resource'] : 'Login';
if ($in['ID'] && !$in[$rsc.'ID']) $in[$rsc.'ID'] = $in['ID'];

$db->addResource($rsc);
$db->$rsc->getlist();

$util = $boss->utility;

if ($in['searchValue'] && $in['searchField']) {
   $q = array();
   $q = preg_split("/\sand\s/i", $process->OverviewQuery);
   $lq = count($q) -1;
   $process->OverviewQuery = preg_replace("/and ".$q[$lq]."/i", '', $process->OverviewQuery);
   $process->OverviewQuery .= " AND ".$in['searchField'].(preg_match("/\%/", $in['searchValue']) ? ' LIKE ' : "=").$boss->db->dbobj->sql_quote($in['searchValue']);

   $records = $util->buildTableFromQuery($db->dbobj, $in[$in['type'].'ID'], $rsc, $process->OverviewQuery, $in['Sort'], $in['SortDir']);
} elseif ($process->OverviewFunction) {
   $records = $util->{$process->OverviewFunction}();
} elseif ($process->OverviewQuery) {
   if ($in['Sort']) {
      $process->OverviewQuery = preg_replace("/Order by.*/i", '', $process->OverviewQuery);
      $process->OverviewQuery .= ' order by `'.$in['Sort'].'` '.$in['SortDir'];
   }
   $records = $util->buildTableFromQuery($db->dbobj, $in[$in['type'].'ID'], $rsc, $process->OverviewQuery, $in['Sort'], $in['SortDir']);
} else {
   $records = $util->buildTable($db->$rsc->$rsc, $in[$in['type'].'ID'], $rsc);
}

/**
 * Setup the height of the overview table with either the value stored in the
 * db for this process, the 'ot' cookie (user set), or 200 pixels.
 **/
if (!$process->OverviewHeight) $process->OverviewHeight = '200';

$height = preg_replace("/\D/", '', $process->OverviewHeight);
if ($_COOKIE['ot']) {
   $height = $_COOKIE['ot'] + 22;
}

if ($records && (!$process->NoTable) && (!$in['notable'])) {
   // print "<div id='overviewFake' style='height:21px;overflow:hidden;'>".preg_replace("/id=\'oviewTable\'/", "id='oviewFake'", $records)."</div>\n";
   print "<div id='overviewTable' style='height:".($height)."px;'>$records</div>\n";
} else {
   $height = 0;
   $nosearch = 1;
}

$trackstyle = ($_REQUEST[$rsc.'ID']) ? 'display:block' : 'display:none;';
$trackstyle = 'display:none;';
if ($process->NoTrack) $trackstyle = 'display:none;';
?>
<div id='frameBorder' onmousedown="startResize(event, 'frameBorder');"><span id='frameHandle'></span></div>
<div id='toolbar'>
   <div id='timetrack' style='<?php print $trackstyle; ?>'>
      <span id='TrackLabel'> Time to complete:</span> <input type='text' id='TrackQuantity' name='Track[new1][Quantity]' size='3' class='timetrack' style='height: 16px;' /><select name='Track[new1][Unit]' style='height:20px;'><option>Minutes</option><option>Hours</option><option>Days</option></select>
      <input type='hidden' name='Track[new1][Email]' value='<?php print $_SESSION['Email']; ?>' />
   </div>
   <div style="float:right;position:relative;top:4px;height:24px;margin-right:2em;">
   <?php if (!$nosearch && !$process->NoSearch) { ?>
   <img src='/img/round_search.png' id='SearchImg' height='24' width='24' tabindex='20' /><input type='text' name='searchValue' id='searchValue' value='' style='height:16px;' onfocus='this.select();' onkeypress="if (event.keyCode==13) { return false;} else { setTimeout(function() { filterTable(document.forms[0].searchValue.value); }, 25); }" tabindex='10' />
   <?php } ?>
   </div>
   <!-- <span style='float:right;'><?php print $in['Resource'].'ID:'; ?></span> -->
   <?php
       // print $util->buildSearchSelect($db, $process);
      $rsc = (isset($in['Resource']) && ($in['Resource'] != 'undefined') && ($in['Resource'] != '')) ? $in['Resource'] : null;
      //$newstyle = (($process->Buttons & 1) && ((!$_REQUEST[$rsc.'ID']) || ($_REQUEST[$rsc.'ID'] == 'New'))) ? 'display:block;' : 'display:none;';
      $newstyle = ($process->Buttons & 1) ? 'display:block;' : 'display:none;';
      $copystyle = (($process->Buttons & 1) && ($_REQUEST[$rsc.'ID'])) ? 'display:block;' : 'display:none;';
      print "<a id='NewButton' title='New' onclick='javascript:doNew();' class='ui-state-default ui-corner-all' style='$newstyle'><span class='ui-icon ui-icon-plus'> </span>New</a>";
      print "<a id='CopyButton' title='Copy' onclick='javascript:doCopy();' class='ui-state-default ui-corner-all' style='$copystyle'><span class='ui-icon ui-icon-copy'> </span>Copy</a>";

      $savestyle = (($process->Buttons & 2) && ($_REQUEST[$rsc.'ID']) && ($_REQUEST[$rsc.'ID'] != 'New')) ? 'display:block;' : 'display:none;';
      print "<a id='SaveButton' title='Save' onclick='javascript:doSave();' class='ui-state-default ui-corner-all' style='$savestyle'><span class='ui-icon ui-icon-disk'> </span>Save</a>";
      

      $deletestyle = (($process->Buttons & 4) && ($_REQUEST[$rsc.'ID'])) ? 'display:block;' : 'display:none;';
      print "<a id='DeleteButton' title='Delete' onclick='javascript:doRemove();' class='ui-state-default ui-corner-all' style='$deletestyle'><span class='ui-icon ui-icon-trash'> </span>Delete</a>";
      
      $printstyle = (($process->Buttons & 8) && ($_REQUEST[$rsc.'ID'])) ? 'display:block;' : 'display:none;';
      print "<a id='PrintButton' title='Print' onclick='javascript:doPrint();' class='ui-state-default ui-corner-all' style='$printstyle'><span class='ui-icon ui-icon-print'> </span>Print</a>";
    ?>
</div>
<div id='formMain' style='position:absolute;top:<?php print $height + 40; ?>px;bottom:0px;<?php
   if (!$in[$rsc.'ID'] && !$in['ID']) print "display:none;"; 
?>'>
<?php 
   $cpform = $_SERVER['DOCUMENT_ROOT']."/apps/".$process->Form;
   $pform = $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets."/".$process->Form;
   if (!file_exists($pform) && file_exists($cpform)) { $pform = $cpform; }
   if (($pform) && (file_exists($pform)) && (!is_dir($pform)) && (!$in['genform'])) {
      include($pform);
   } else {
      $pname = $file = preg_replace("/\s/", '', $process->Process);
      $file .= '.php';
      $gfile = "/apps/templates/".$file;
      $file = $boss->app->Assets."/templates/".$file;
      
      if (!file_exists($_SERVER['DOCUMENT_ROOT'].$file)) {
         $form = $boss->buildForm($rsc, $current, 1);

         $fh = fopen($_SERVER['DOCUMENT_ROOT'].$file, 'w');
         if (!fwrite($fh, $form)) print "<h1>Error writing to file templates/$file</h1>";
         fclose($fh);
         
         $form = $boss->buildForm($rsc, $current);
         print eval("?>".$form);
      }

      $upd = array($in['type'].'ID'=>$in[$in['type'].'ID'], 'Form'=>'templates/'.$pname.'.php');
      $db->addResource($in['type']);
      $db->Process->update($in[$in['type'].'ID'], $upd);
      
      include($_SERVER['DOCUMENT_ROOT'].$upd['Form']);
   }

?>
</div>
<div id='mainHelp' style='margin:1em;position:absolute;top:<?php print $height + 34; ?>px;bottom:0px;<?php if ($in[$rsc.'ID']) print "display:none;"; ?>'>
   <?php 
      $file = preg_replace("/\s/", '', $process->Process);
      $file .= '.php';

      if (file_exists('help/'.$file)) {
         include('help/'.$file);
      }
   ?>
</div>
