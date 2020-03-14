<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/boss_class.php');

$in = $_REQUEST;
$obj = new boss();

if ($in['ModuleID']) {
   $obj->addModule(null, $in['ModuleID']);
   $process = $obj->Module->Modules[0];
}

if ($in['ProcessID']) {
   $obj->addProcess(null, $in['ProcessID']);
   $process = $obj->Process->Processes[0];
}

$db = $obj->db;

$rsc = ($in['Resource']) ? $in['Resource'] : 'Nav';

$db->addResource($rsc);
$db->{$rsc}->getlist();

$util = $obj->utility;

if ($in['searchValue']) {
   $q = array();
   $q = preg_split("/\sand\s/i", $process->OverviewQuery);
   $lq = count($q) -1;
   $process->OverviewQuery = preg_replace("/and ".$q[$lq]."/i", '', $process->OverviewQuery);
   $process->OverviewQuery .= " AND ".$in['searchField'].(preg_match("/\%/", $in['searchValue']) ? ' LIKE ' : "=").$obj->db->dbobj->sql_quote($in['searchValue']);

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
//print "<h1 style='font-size:18px;font-weight:bold;'>".preg_replace("/s$/", '', $process->Process)." Manager</h1>\n";
if ($records && !$process->NoTable) {
//   print "<div id='overviewFake' style='height:21px;overflow:hidden;'>$records</div>\n";
   print "<div id='overviewTable'>$records</div>\n";
} else {
   $height = 0;
   $nosearch = 1;
}

$trackstyle = (!$_REQUEST[$rsc.'ID']) ? 'display:block' : 'display:none;';
$trackstyle = 'display:none;';
?>
<div id='frameBorder' onmousedown="startResize(event, 'frameBorder');"><span id='frameHandle'></span></div>
<?php
   if (!$process->NoToolbar) {
?>
<div id='toolbar'>
   <div id='timetrack' style='<?php print $trackstyle; ?>'>
      <span id='TrackLabel'> Time to complete:</span> <input type='text' id='TrackQuantity' name='Track[new1][Quantity]' size='3' class='timetrack' style='height: 16px;' /><select name='Track[new1][Unit]' style='height:20px;'><option>Minutes</option><option>Hours</option><option>Days</option></select>
      <input type='hidden' name='Track[new1][Email]' value='<?php print $_SESSION['Email']; ?>' />
   </div>
   <img src='/img/round_search.png' id='SearchImg' height='24' width='24' style='float:right;height:24px;width:24px;margin-left:4px;margin-right:4px;' onclick='javascript:doSearch();' tabindex='20' /><input type='text' name='searchValue' value='' style='float:right;height:16px;' onfocus='this.select();' onkeypress="return (event.keyCode==13)?doSearch():true;" tabindex='10' />
   <!-- <span style='float:right;'><?php print $in['Resource'].'ID:'; ?></span> -->
   <?php
      // print $util->buildSearchSelect($db, $process);
      $rsc = (isset($in['Resource']) && ($in['Resource'] != 'undefined') && ($in['Resource'] != '')) ? $in['Resource'] : null;
      $newstyle = (($process->Buttons & 1) && ((!$_REQUEST[$rsc.'ID']) || ($_REQUEST[$rsc.'ID'] == 'New'))) ? 'display:block;' : 'display:none;';
      $newstyle = ($process->Buttons & 1) ? 'display:block;' : 'display:none;';
      print "<input type='button' id='NewButton' value='New' onclick='javascript:doNew();' style='$newstyle' class='toolbarButton' />";

      $savestyle = (($process->Buttons & 2) && ($_REQUEST[$rsc.'ID']) && ($_REQUEST[$rsc.'ID'] != 'New')) ? 'display:block;' : 'display:none;';
      print "<input type='button' id='SaveButton' value='Save' onclick='javascript:doSave();' style='$savestyle' class='toolbarButton' />";

      $deletestyle = (($process->Buttons & 4) && ($_REQUEST[$rsc.'ID'])) ? 'display:block;' : 'display:none;';
      print "<input type='button' id='DeleteButton' value='Delete' onclick='javascript:doRemove();' style='$deletestyle' class='toolbarButton' />";
      $printstyle = (($process->Buttons & 8) && ($_REQUEST[$rsc.'ID'])) ? 'display:block;' : 'display:none;';
      print "<input type='button' id='PrintButton' value='Print' onclick='javascript:doPrint();' style='position:relative;z-index:99999;$printstyle' class='toolbarButton' />";
    ?>
</div>
<?php } ?>
<div id='formMain' style='position:relative;top:<?php print 0; ?>px;height:100%;background-color:#f0f0f0;<?php
   if ((!$in[$rsc.'ID'] && !$in['ID']) && (!$process->NoTable)) print "display:none;"; 
?>'>
<?php 
   if (($process->Form) && (file_exists($process->Form))) {
      include($process->Form);
   } else {
      $file = preg_replace("/\s/", '', $process->Process);
      $file .= '.php';

      if (!file_exists($file)) {
         $form = $obj->buildForm($rsc, $current, 1);

         $fh = fopen("templates/$file", 'w');
         if (!fwrite($fh, $form)) print "<h1>Error writing to file templates/$file</h1>";
         fclose($fh);
      } 
      
      $upd = array($in['type'].'ID'=>$in[$in['type'].'ID'], 'Form'=>"templates/$file");
      $db->addResource($in['type']);
      $db->Process->update($in[$in['type'].'ID'], $upd);
      
      include($upd['Form']);
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
