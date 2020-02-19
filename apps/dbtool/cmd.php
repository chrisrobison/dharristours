<?php
   require_once(($_SERVER['DOCUMENT_ROOT']?$_SERVER['DOCUMENT_ROOT']: '../..').'/lib/auth.php');
   require_once("dbtool_class.php");

   $obj = $boss->db;
   $obj->addResource('Login');
   
   if (($in['x'] == 'add') || ($in['fieldName'] == 'new')) {
      $query = "alter table ".mysql_real_escape_string($in['tableName'])." add `".mysql_real_escape_string($in['colname'])."` ".mysql_real_escape_string($in['coltype']);
      if ($in['colattr']) $query .= "(".mysql_real_escape_string($in['colattr']).")";
      print "<!-- $query -->\n";
      $obj->Login->execute($query);
   } elseif ($in['x'] == 'delete') {
      $query = "alter table ".mysql_real_escape_string($in['tableName'])." drop ".mysql_real_escape_string($in['fieldName']);
      print "<!-- $query -->\n";
      $obj->Login->execute($query);
   } elseif ($in['x'] == 'update') {
      $query = "alter table ".mysql_real_escape_string($in['tableName'])." change `".mysql_real_escape_string($in['fieldName'])."` `".mysql_real_escape_string($in['colname'])."` ".mysql_real_escape_string($in['coltype']);
      if ($in['colattr']) $query .= "(".mysql_real_escape_string($in['colattr']).")";
      print "<!-- $query -->\n";
      $obj->Login->execute($query);
   } elseif ($in['x'] == 'truncate') {
      if ($in['tableName']) {
         $query = "truncate table ".$boss->q($in['tableName'], "`");
         $obj->Login->execute($query);
         print "<script>if (top.updateStatus) { top.updateStatus('Truncated table {$in['tableName']}'); }\napprise('Truncated table {$in['tableName']}');</script>";
      }
   } elseif ($in['x'] == 'drop') {
      if ($in['tableName']) {
         $query = "drop table ".$boss->q($in['tableName'], "`");
         $obj->Login->execute($query);
         print "<script>$('#table_{$in['tableName']}').remove(); if (top.updateStatus) { top.updateStatus('Dropped table {$in['tableName']}'); }\n</script>";
      }   
   } elseif ($in['x'] == 'copy') {
      if ($in['tableName']) {
         $query = "show create table ".$boss->q($in['tableName'], "`");
         $dbh = $obj->Login->execute($query);
         
         $obj = mysql_fetch_object($dbh);
         $row = (array)$obj;
         $sql = preg_replace("/".$in['tableName']."/", $in['newName'], $row["Create Table"]);
         $temp = tempnam("/var/tmp", "simple_");
         file_put_contents($temp, $sql);
         $cmd = "cat $temp | /usr/local/bin/mysql -upimp -ppimpin {$boss->app->DB}";
         $results = `$cmd`;
         print $results;
         print "<script>if (top.updateStatus) top.updateStatus('$cmd');window.location.reload();</script>";
      }
   } elseif ($in['x'] == 'rename') {
      if ($in['tableName'] && $in['newName']) {
         $query = "alter table " . $boss->q($in['tableName'], "`") . " rename " . $boss->q($in['newName'], "`");
         $obj->Login->execute($query);
         print "<script>if (top.updateStatus) top.updateStatus(\"Renamed table {$in['tableName']}' to '{$in['newName']}'\");</script>";
        
      }
   } elseif ($in['x'] == 'newtable') {
      // Add check for existing table here
      $tbl = $in['newtable'];
      $query = <<<EOT
CREATE TABLE {$tbl} (
{$tbl}ID INT(15) NOT NULL auto_increment,
{$tbl} VARCHAR(100) NOT NULL default '',
Description VARCHAR(200) NOT NULL default '',
Created TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
CreatedBy varchar(100) DEFAULT NULL,
LastModified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP on UPDATE CURRENT_TIMESTAMP,
LastModifiedBy varchar(100) DEFAULT NULL,
Notes TEXT,
PRIMARY KEY  ({$tbl}ID)
) ENGINE=InnoDB
EOT;
      $obj->Login->execute($query);
      $proc['Process']['new1'] = array('Process'=>$in['newtable'], 'ModuleID'=>$in['ModuleID'], 'Icon'=>$in['Icon']);
      $ids = $boss->storeObject($proc);
      $html = "<li><a rel='nav' title='".$in['Process']."' href='/grid/index.php?pid={$ids[0]}' class='nav'><div class='navIcon'><span class='simpleIcon icon-".$in['Icon']."'> </span></div>".$in['newtable']."</a></li>";
      $js .= "try { top.jQuery('#mid_".$in['ModuleID']."').append(\"".$html."\");} catch(e) { }\n";
   } else if ($in['x'] == 'newimport') {
      $uploads = $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets.'/imports';
      if (!file_exists($uploads)) mkdir($uploads, 0775);
      
      $in['rsc'] = $fname = preg_replace("/\W/", '', $in['newimport']); $ftype = '.txt';
      if (!$fname) list($fname, $ftype) = preg_split("/\./", $_FILES['importFile']['name']);

      $upload = $uploads.'/'.$fname.'_'.date("Ymdhi").'.txt';
      if ($in['newimportText']) {
         $in['data'] = $in['newimportText'];
         file_put_contents($upload, $in['data']);
      } else if ($_FILES['newimportFile']['size']) {
         // $in['data'] = file_get_contents($_FILES['newimportFile']['tmp_name']);
         move_uploaded_file($_FILES['newimportFile']['tmp_name'], $upload);
      }
      $exec = $_SERVER['DOCUMENT_ROOT'].'/tools/gentable -q -d '.$boss->app->DB.' '.$upload;
      
      $tblsql = "";
      
      /*
      $ph = popen($exec, 'r');
      while (!feof($ph)) { $tblsql .= fread($ph, 8192); }
      pclose($ph);
      */

      $tblsql = `$exec`;

      $obj->Login->execute($tblsql);

      $rows = $boss->importCSV($in['rsc'], $upload);
      
      // $ids = $boss->storeObject($importObj);
      $proc['Process']['new1'] = array('Process'=>$in['newimport'], 'ModuleID'=>$in['importModuleID'], 'Icon'=>$in['importIcon'], 'Resource'=>$in['rsc'], 'Buttons'=>'127', 'Access'=>'1', 'Form'=>'templates/'.preg_replace("/\W/", '', $in['newimport']).'.php');
      $ids = $boss->storeObject($proc);
      $id = array_shift($ids);
      $html = "<li><a rel='nav' title='".$in['Process']."' href='/grid/index.php?pid={$id}' class='nav'><div class='navIcon'><span class='simpleIcon icon-".$in['importIcon']."'> </span></div>".$in['newimport']."</a></li>";
      $js .= "<script>try {\ntop.jQuery('#mid_".$in['importModuleID']."').append(\"".$html."\"); } catch(e) { }\nsetTimeout(function() { parent.location.reload(); }, 2000);\n</script>";

   } else if ($in['x'] == 'getlinks') {
      $obj->addResource("Clamp");
      $obj->Clamp->getlist("RemoteID=0 AND LocalID=0");
      foreach ($obj->Clamp->Clamp as $item) {
         $relations[$item->Local][] = $item->Remote;
      }
      
   } else if ($in['x'] == 'clamp') {
      $boss->clampRecord($in['l'], '0', $in['r'], '0', false);
   } else if ($in['x'] == 'exportSQL') {
      $boss->headers('text/sql', true, array('Content-Disposition'=>'attachment; filename="'.preg_replace("/\W/", '', $in['rsc']).'.sql"'));
      $db = $boss->app->DB;
      $results = `/usr/local/bin/mysqldump -upimp -ppimpin {$db} {$in['rsc']}`;
      print $results;
      exit;
   }

   if ($js) {
//      header("Content-type: application/javascript");
      print $js;
   }
?>
