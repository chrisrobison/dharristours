<?php
require_once(($_SERVER['DOCUMENT_ROOT']?$_SERVER['DOCUMENT_ROOT']: '../..').'/lib/auth.php');
require_once("dbtool_class.php");

$obj = $boss->db;
$obj->addResource('Login');

if (isset($in['x'])) {
    switch ($in['x']) {
        case "add":
            $out = addField();
            break;

        case "delete":
            $out = dropField();
            break;

        case "update":
            $out = alterTable();
            break;

        case "newtable":
            $out = newTable();
            break;

        case "getlinks":
            $out = getLinks();
            break;

        case "clamp":
            $out = clamp();
            break;
   }
}

header("Content-Type: application/javascript");
print $out;

exit();

function addField() {
    global $in;
    global $boss;
    
    $out = new stdClass();
    if (isset($in['tableName']) && isset($in['colname']) && isset($in['coltype'])) {
        $query = "alter table ".mysql_real_escape_string($in['tableName'])." add `".mysql_real_escape_string($in['colname'])."` ".mysql_real_escape_string($in['coltype']);
        if ($in['colattr']) $query .= "(".mysql_real_escape_string($in['colattr']).")";
        $obj->Login->execute($query);
        $out->status = "ok";
        $out->msg = "Added field {$in['colname']} to table {$in['tableName']}";
    }

    return $out;
}

function dropField() {
    global $in;
    global $boss;
    
    $out = new stdClass();

    if (isset($in['tableName']) && isset($in['fieldName'])) {
        $query = "alter table ".mysql_real_escape_string($in['tableName'])." drop ".mysql_real_escape_string($in['fieldName']);
        $obj->Login->execute($query);
        
        $out->status = "ok";
        $out->msg = "Dropped field '{$in['fieldName']}' from table '{$in['tableName']}'";
    }

    return $out;
}

function alterTable() {
    global $in;
    global $boss;

    $out = new stdClass();
    
    if (isset($in['tableName']) && isset($in['fieldName']) && isset($in['colname']) && isset($in['coltype'])) {
        $query = "alter table ".mysql_real_escape_string($in['tableName'])." change `".mysql_real_escape_string($in['fieldName'])."` `".mysql_real_escape_string($in['colname'])."` ".mysql_real_escape_string($in['coltype']);
        if ($in['colattr']) $query .= "(".mysql_real_escape_string($in['colattr']).")";
        
        $obj->Login->execute($query);
        $out->status = "ok";
        $out->msg = "Changed '{$in['fieldName']}' to '{$in['colname']}' defined as '{$in['coltype']}'";
    }
    return $out;
 
}

function newTable() {
    global $in;
    global $boss;

    $out = new stdClass();
    
    if (isset($in['newtable'])) {
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
      $js .= "top.jQuery('#mid_".$in['ModuleID']."').append(\"".$html."\");\n";
      
      $out->status = "ok";
      $out->msg = "Created new table '{$tbl}'";
    }

    return $out;
}

function getLinks() {
    global $in;
    global $boss;

    $out = new stdClass();

    $obj->addResource("Clamp");
    $obj->Clamp->getlist("RemoteID=0 AND LocalID=0");
    
    foreach ($obj->Clamp->Clamp as $item) {
       $relations[$item->Local][] = $item->Remote;
    }
    $out->status = "ok";
    $out->msg = "Found {$cnt} linked tables";
    $out->data = $relations;

    return $out;
}

function clamp() {
    global $in;
    global $boss;

    $out = new stdClass();

    if (isset($in['l']) && isset($in['r'])) {
        $boss->clampRecord($in['l'], '0', $in['r'], '0', false);
        $out->status = "ok";
        $out->msg = "Clamped tables {$in['l']} and {$in['r']}";
    }

    return $out;
}
/*
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
      $js .= "top.jQuery('#mid_".$in['ModuleID']."').append(\"".$html."\");\n";
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
      $ph = popen($exec, 'r');
      while (!feof($ph)) { $tblsql .= fread($ph, 8192); }
      pclose($ph);
      $obj->Login->execute($tblsql);

      $rows = $boss->importCSV($in['rsc'], $upload);
      
      // $ids = $boss->storeObject($importObj);
      $proc['Process']['new1'] = array('Process'=>$in['newimport'], 'ModuleID'=>$in['importModuleID'], 'Icon'=>$in['importIcon'], 'Resource'=>$in['rsc'], 'Buttons'=>'127', 'Access'=>'1', 'Form'=>'templates/'.preg_replace("/\W/", '', $in['newimport']).'.php');
      $ids = $boss->storeObject($proc);
      $html = "<li><a rel='nav' title='".$in['Process']."' href='/grid/index.php?pid={$ids[0]}' class='nav'><div class='navIcon'><span class='simpleIcon icon-".$in['importIcon']."'> </span></div>".$in['newimport']."</a></li>";
      $js .= "top.jQuery('#mid_".$in['importModuleID']."').append(\"".$html."\");window.reload();\n";

   } else if ($in['x'] == 'getlinks') {
      $obj->addResource("Clamp");
      $obj->Clamp->getlist("RemoteID=0 AND LocalID=0");
      foreach ($obj->Clamp->Clamp as $item) {
         $relations[$item->Local][] = $item->Remote;
      }
      
   } else if ($in['x'] == 'clamp') {
      $boss->clampRecord($in['l'], '0', $in['r'], '0', false);
   }

   if ($js) {
      header("Content-type: application/javascript");
      print $js;
   }
*/
