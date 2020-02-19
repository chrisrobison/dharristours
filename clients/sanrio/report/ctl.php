<?php
/*
** Connect to database:
*/
# putenv('TDSVER=70');

// Connect to the database (host, username, password)
$con = mssql_connect('localhost:1431','simple','simple1'); // or die("Error connecting to server");
$in = $_REQUEST;

$db = ($in['db']) ? $in['db'] : "Sanrio";
$in['x'] = ($in['x']) ? $in['x'] : 'get-tables';
$filename = "{$db}_{$in['tbl']}_{$in['x']}";

if (($in['db'] != "Sanrio") && file_exists("cache/$filename.json")) {
   if ((time() - filemtime("cache/$filename.json")) < (86400 * 30)) {
      $json = json_decode(file_get_contents("cache/$filename.json"));
      if (is_object($json)) {
         $json->_cached = time() - filemtime("cache/$filename.json");
      }
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
} else if ($in['x'] == "get-reports") {
   $dbs[$db] = get_reports($db, $in['filter']);
} else if ($in['x'] == "get-report") {
   $dbs[$db] = get_report($db, $in['id']);
}

if ($con) {
   mssql_close($con);
}

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
   mssql_select_db($db) or die('Could not select a database.');
   $sql = "exec sp_tables @table_type = \"'table', 'view'\"";
   $result = mssql_query($sql);
   $out = array();
   while ($row = mssql_fetch_object($result)) {
      $out[] = $row->TABLE_NAME;
   }
   
   return $out;
}

function get_tables($db) {
   mssql_select_db($db) or die('Could not select a database.');
   $sql = "exec sp_tables @table_type = \"'table', 'view'\"";
   $result = mssql_query($sql);
   $count = mssql_num_rows($result);
   // print "Found $count tables.\n";
   $out = array();
   while ($row = mssql_fetch_object($result)) {
      $out[$row->TABLE_NAME] = array();
   }
   
   foreach ($out as $tbl=>$vals) {
      $out[$tbl] = get_columns($tbl);
   }
   return $out;
}

function get_columns($db, $tbl) {
   mssql_select_db($db) or die('Could not select a database.');
   $sql = "exec sp_columns [$tbl]";
   $colres = mssql_query($sql);
   $count = mssql_num_rows($colres);
   // print "Found $count columns for $tbl.\n";
   $out = array();
   while ($row = mssql_fetch_object($colres)) {
      $out[$row->COLUMN_NAME] = new stdClass();
      $out[$row->COLUMN_NAME]->type = $row->TYPE_NAME;
      if ($row->LENGTH) $out[$row->COLUMN_NAME]->type .= "(" . $row->LENGTH . ")";
      if ($row->SCALE) $out[$row->COLUMN_NAME]->type = $row->TYPE_NAME . "(" . $row->LENGTH . ", " . $row->SCALE . ")";
      $out[$row->COLUMN_NAME]->field = $row->COLUMN_NAME;
      $out[$row->COLUMN_NAME]->null = $row->NULLABLE;
      $out[$row->COLUMN_NAME]->default = $row->COLUMN_DEF;
      $out[$row->COLUMN_NAME]->key = (preg_match("/identity/i", $row->TYPE_NAME)) ? "PRI" : "";
      $out[$row->COLUMN_NAME]->oem = $row;
   }
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

function get_report($db, $id) {
   $link = mysqli_connect("localhost", "mail", "activate", "SS_" . $db);
   /* check connection */
   if (mysqli_connect_errno()) {
       printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
   }

   $query = "SELECT * FROM Report";
   if ($id) {
      $query .= " WHERE ReportID='" . $id ."'";
   }
   
   $out = array();

   if ($result = mysqli_query($link, $query)) {
      
      /* fetch associative array */
      while ($row = mysqli_fetch_assoc($result)) {
         $out[] = $row;
      }

      /* free result set */
      mysqli_free_result($result);
   }

   /* close connection */
   mysqli_close($link);

   return $out;
}

function get_reports($db, $filter) {
   $link = mysqli_connect("localhost", "mail", "activate", "SS_" . $db);
   /* check connection */
   if (mysqli_connect_errno()) {
       printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
   }

   $query = "SELECT * FROM Report";
   if ($filter) {
      $query .= " WHERE " . preg_replace("/^\s*WHERE\s*/", '', $filter);
   }
   
   $out = array();

   if ($result = mysqli_query($link, $query)) {
      
      /* fetch associative array */
      while ($row = mysqli_fetch_assoc($result)) {
         $out[] = $row;
      }

      /* free result set */
      mysqli_free_result($result);
   }

   /* close connection */
   mysqli_close($link);

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
