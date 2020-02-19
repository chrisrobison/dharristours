<?php
   require_once($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');
   require_once($_SERVER['DOCUMENT_ROOT'].'/lib/obj_class.php');
   require_once("lib/dbtool_class.php");
   require_once("lib/jsserialize.php");
   
   $in = $_REQUEST;
      $sys = new obj('SS_System', 'pimp', 'pimpin', 'localhost');
      $domparts = preg_split("/\./", $_SERVER['SERVER_NAME']);
      $host = array_shift($domparts);
      $domain = join(".", $domparts);
      
      $sys->addResource('App');
      $sys->App->getlist("Host='".$host."' AND Domain='".$domain."'");
      
      $db = $sys->App->App[0]->DB;
      
      $sys->addResource('SystemTables');
      $sys->SystemTables->getlist();
      
      $forbidden = array();
      foreach ($sys->SystemTables->SystemTables as $systbl) {
         $forbidden[] = $systbl->SystemTables;
      }

   $obj = new obj($db, 'pimp', 'pimpin');
   $obj->addResource('Login');
   
   if (($in['x'] == 'add') || ($in['fieldName'] == 'new')) {
      $query = "alter table ".mysql_real_escape_string($in['tableName'])." add ".mysql_real_escape_string($in['colname'])." ".mysql_real_escape_string($in['coltype']);
      if ($in['colattr']) $query .= "(".$in['colattr'].")";
      print "<!-- $query -->\n";
      $obj->Login->execute($query);
   } elseif ($in['x'] == 'delete') {
      $query = "alter table ".mysql_real_escape_string($in['tableName'])." drop ".mysql_real_escape_string($in['colname']);
      print "<!-- $query -->\n";
      $obj->Login->execute($query);
   } elseif ($in['x'] == 'update') {
      $query = "alter table ".mysql_real_escape_string($in['tableName'])." change `".mysql_real_escape_string($in['fieldName'])."` `".mysql_real_escape_string($in['colname'])."` ".mysql_real_escape_string($in['coltype']);
      if ($in['colattr']) $query .= "(".$in['colattr'].")";
      print "<!-- $query -->\n";
      $obj->Login->execute($query);
   } elseif ($in['x'] == 'newtable') {
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
      $proc['Process']['new1'] = array('Process'=>$in['newtable'], 'Resource'=>$in['newtable'], 'ModuleID'=>$in['ModuleID'], 'Icon'=>$in['Icon'], 'Access'=>'1', 'Buttons'=>'127');
      $ids = $boss->storeObject($proc);
      $newid = array_shift($ids);
      $html = "<li><a rel='nav' title='".$in['newtable']."' href='/grid/index.php?pid={$newid}' class='nav'><div class='navIcon'><span class='simpleIcon icon-".$in['Icon']."'> </span></div>".$in['newtable']."</a></li>";
      $jsup .= "top.jQuery('#mid_".$in['ModuleID']."').append(\"".$html."\");\n";
   }

   $database = new database($db);

/*
   $x = $obj->Login->execute("show tables");
   
   while ($row = mysql_fetch_array($x)) {
      if (!in_array($row[0], $forbidden)) { 
         $database->addTable($row[0]);

         $y = $obj->Login->execute("desc `".$row[0].'`');
         if (mysql_num_rows($y)) {
            while ($row2 = mysql_fetch_object($y)) {
               $database->tables[$row[0]]->addField($row2->Field, $row2->Type, $row2);
            }
         }
      }
   }
*/
   $x = $boss->getTables(true);
   
   foreach ($x as $tbl) {
      $database->addTable($tbl);
      $y = $obj->Login->execute("desc `".$tbl.'`');
      if (mysql_num_rows($y)) {
         while ($row2 = mysql_fetch_object($y)) {
            if (!preg_match("/CreatedBy|LastModifiedBy|Created|LastModified/", $row2->Field)) {
               $database->tables[$tbl]->addField($row2->Field, $row2->Type, $row2);
            }
         }
      }
   }

   $database->tables['_count'] = count($database->tables);
   $protocols = array("80"=>"http://", "443"=>"https://");
   $dbjson = file_get_contents($protocols[$_SERVER['SERVER_PORT']] . $_SERVER['SERVER_NAME'] . '/files/dbtool/mssql.php');
   // $js = "var schema =".json_encode($database).";\n";
   $js = "var schema =".$dbjson.";\n";

   $types['advanced'] = array('tinyint'=>'1', 'smallint'=>'1', 'mediumint'=>1, 'int'=>1, 'integer'=>1, 'bigint'=>1, 'real'=>1, 'double'=>1, 'float'=>1, 'decimal'=>1, 'numeric'=>1, 'date'=>0, 'time'=>0, 'timestamp'=>0, 'datetime'=>0, 'char'=>1, 'varchar'=>1, 'tinyblob'=>0, 'blob'=>0, 'mediumblob'=>0, 'longblob'=>0, 'tinytext'=>1, 'text'=>1, 'mediumtext'=>1, 'longtext'=>1, 'enum'=>1, 'set'=>1);
   $types['simple'] = array('Short Text'=>'varchar(100)', 'Long Text'=>'text', 'Number'=>'int(15)', 'Decimal'=>'dec(15,4)', 'Currency'=>'dec(10,2)', 'Checkbox'=>'bool', 'Date & Time'=>'datetime', 'Date'=>'date','Time'=>'time','Timestamp'=>'timestamp', 'File'=>'blob');

   $js .= 'var coltypes = '.json_encode($types).";\n";

   $obj->addResource("Clamp");
   $obj->Clamp->getlist("RemoteID=0 AND LocalID=0");
   foreach ($obj->Clamp->Clamp as $item) {
      $relations[$item->Local][] = $item->Remote;
   }
   
   $js .= "var relations = ".json_encode($relations).";\n";
?>
