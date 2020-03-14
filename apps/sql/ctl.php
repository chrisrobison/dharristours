<?php

require($_SERVER['DOCUMENT_ROOT'] . '/lib/auth.php');

$db = $boss->app->DB;
$in['x'] = ($in['x']) ? $in['x'] : 'get-tables';
$filename = "{$db}_{$in['tbl']}_{$in['x']}";

if (file_exists("cache/$filename.json")) {
   if ((time() - filemtime("cache/$filename.json")) < (86400)) {
      $json = json_decode(file_get_contents("cache/$filename.json"));
      $json->_cached = time() - filemtime("cache/$filename.json");
      header("Content-type: application/javascript");
      print json_encode($json);
      exit;
   }
}
  
if ($in['x'] == "get-tables") {
 
   $dbs = array($db=>array());
   foreach ($dbs as $dbname=>$vals) {
      $dbs[$dbname] = get_tables($dbname);
   }
} else if ($in['x'] == "get-dbs") {
   $db = "dblist";
   $dbs['dblist'] = get_dbs();
} else if ($in['x'] == "get-table-list") {
   $dbs[$db] = get_table_list($db);
} else if ($in['x'] == "get-column-list") {
   $dbs[$db] = get_column_list($db, $in['tbl']);
} else if ($in['x'] == "get-columns") {
   $dbs[$db] = get_columns($db, $in['tbl']);
}

mssql_close($con);

header("Content-type: application/javascript");
$json = json_encode($dbs[$db]);
file_put_contents("cache/{$filename}.json", $json);
print $json;

function get_dbs() {
   $result = mssql_query("exec sp_databases");
   $list = array();
   while ($row = mssql_fetch_object($result)) {
      // print "Found DB:\t" . $row->DATABASE_NAME ."\n";
      // $dbs[$row->DATABASE_NAME] = array();
      $list[] = $row->DATABASE_NAME;
   }
   return $list;
}

function get_table_list($db) {
   $boss->db->dbobj->list_tables();
   $tbls = $boss->db->dbobj->tables;
  
   return $tbls;
}

function get_tables() {
   global $boss;
   $boss->db->dbobj->list_tables();
   $tbls = $boss->db->dbobj->tables;
   $count = count($tbls);
   print "Found $count tables.\n";
   
   return $tbls;
}

function get_columns($rsc) {
   global $boss;
   $sys = $boss->db;
   $sys->addResource($rsc);
   $defs = $sys->dbobj->execute("desc `".mysql_real_escape_string($rsc)."`");

   $fields = array();
   while ($row = mysql_fetch_object($defs)) {
      $obj = new stdClass;
      foreach ($row as $key=>$val) {
         $obj->{$key} = $val;
      }
      if (preg_match("/[\(\)]/", $obj->Type)) {
         $obj->Length = preg_replace("/\w*\((.*)\)/", "$1", $obj->Type);
         $obj->Type = preg_replace("/\(.*\)/", "", $obj->Type);
         $obj->Args = preg_split("/\,\s*/", $obj->Length);
      }

      $fields[$obj->Field] = $obj;
   }
   // print_r($fields);

   /*
   $out[$row->COLUMN_NAME] = new stdClass();
   $out[$row->COLUMN_NAME]->type = $row->TYPE_NAME;
   if ($row->LENGTH) $out[$row->COLUMN_NAME]->type .= "(" . $row->LENGTH . ")";
   if ($row->SCALE) $out[$row->COLUMN_NAME]->type = $row->TYPE_NAME . "(" . $row->LENGTH . ", " . $row->SCALE . ")";
   $out[$row->COLUMN_NAME]->field = $row->COLUMN_NAME;
   $out[$row->COLUMN_NAME]->null = $row->NULLABLE;
   $out[$row->COLUMN_NAME]->default = $row->COLUMN_DEF;
   $out[$row->COLUMN_NAME]->key = (preg_match("/identity/i", $row->TYPE_NAME)) ? "PRI" : "";
   $out[$row->COLUMN_NAME]->oem = $row;
   */ 
   return $out;

}
function get_column_list($db, $tbl) {
   mssql_select_db($db) or die('Could not select a database.');
   $colres = mssql_query("exec sp_columns [$tbl]");
   $out = array();
   while ($row = mssql_fetch_object($colres)) {
      $out[] = $row->COLUMN_NAME;
      /*
      $out[$row->COLUMN_NAME] = new stdClass();
      $out[$row->COLUMN_NAME]->type = $row->TYPE_NAME;
      if ($row->LENGTH) $out[$row->COLUMN_NAME]->type .= "(" . $row->LENGTH . ")";
      if ($row->SCALE) $out[$row->COLUMN_NAME]->type = $row->TYPE_NAME . "(" . $row->LENGTH . ", " . $row->SCALE . ")";
      $out[$row->COLUMN_NAME]->field = $row->COLUMN_NAME;
      $out[$row->COLUMN_NAME]->null = $row->NULLABLE;
      $out[$row->COLUMN_NAME]->default = $row->COLUMN_DEF;
      $out[$row->COLUMN_NAME]->key = (preg_match("/identity/i", $row->TYPE_NAME)) ? "PRI" : "";
      $out[$row->COLUMN_NAME]->oem = $row;
      */
   }
   return $out;

}

exit;
/*
mssql_select_db('sanrio') or die('Could not select a database.');
 
// Example query: (TOP 10 equal LIMIT 0,10 in MySQL)
$sql = "SELECT * FROM syscolumns";
$sql = "exec sp_tables @table_type = \"'table', 'view'\"";

// Execute query:
$result = mssql_query($sql) or die('A error occured: ' . mysql_error());
 
// Get result count:
$count = mssql_num_rows($result);
print "Showing $count rows:<hr/>\n\n";
 
// Fetch rows:
while ($row = mssql_fetch_object($result)) {
 
    print_r($row);
 
}
*/ 
?>
