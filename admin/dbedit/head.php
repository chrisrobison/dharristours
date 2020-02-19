<?php
   require_once("obj_class.php");
   require_once("dbtool_class.php");
   require_once("lib/jsserialize.php");
   
   $in =& $_REQUEST;
      $sys = new obj('SS_System', 'pimp', 'pimpin', 'localhost');
      $domparts = preg_split("/\./", $_SERVER['SERVER_NAME']);
      $host = array_shift($domparts);
      $domain = join(".", $domparts);
      
      $sys->addResource('App');
      $sys->App->getlist("Host='".$host."' AND Domain='".$domain."'");

      $db = $sys->App->App[0]->DB;

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
create table {$tbl} (
{$tbl}ID int(15) NOT NULL auto_increment,
{$tbl} varchar(100) NOT NULL default '',
Created datetime default NULL,
LastModified timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
Notes text,
PRIMARY KEY  ({$tbl}ID)
) ENGINE=InnoDB
EOT;
      
      $obj->Login->execute($query);
   }

   $database = new database($db);

   $x = $obj->Login->execute("show tables");
   
   while ($row = mysql_fetch_array($x)) {
      $database->addTable($row[0]);

      $y = $obj->Login->execute("desc `".$row[0].'`');
      if (mysql_num_rows($y)) {
         while ($row2 = mysql_fetch_object($y)) {
            $database->tables[$row[0]]->addField($row2->Field, $row2->Type, $row2);
         }
      }
   }

   $js = "var schema =".js_serialize($database, true).";\n";

   $types = array('tinyint'=>'1', 'smallint'=>'1', 'mediumint'=>1, 'int'=>1, 'integer'=>1, 'bigint'=>1, 'real'=>1, 'double'=>1, 'float'=>1, 'decimal'=>1, 'numeric'=>1, 'date'=>0, 'time'=>0, 'timestamp'=>0, 'datetime'=>0, 'char'=>1, 'varchar'=>1, 'tinyblob'=>0, 'blob'=>0, 'mediumblob'=>0, 'longblob'=>0, 'tinytext'=>1, 'text'=>1, 'mediumtext'=>1, 'longtext'=>1, 'enum'=>1, 'set'=>1);

   $js .= "var coltypes = ".js_serialize($types, true).";\n";

?>
