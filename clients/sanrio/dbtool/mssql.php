<?php
/*
** Connect to database:
*/
# putenv('TDSVER=70');

// Connect to the database (host, username, password)
$con = mssql_connect('localhost:1431','simple','simple1') or die('Could not connect to the server!');

$in = $_REQUEST;
$db = ($in['db']) ? $in['db'] : "Sanrio";

if (file_exists("cache/$db.json")) {
   $json = file_get_contents("cache/$db.json");
   header("Content-type: application/javascript");
   print $json;
   exit;
}
/*
$result = mssql_query("exec sp_databases");

while ($row = mssql_fetch_object($result)) {
   // print "Found DB:\t" . $row->DATABASE_NAME ."\n";
   $dbs[$row->DATABASE_NAME] = array();
}
*/
$dbs = array($db=>array());
foreach ($dbs as $dbname=>$vals) {
   // print "Fetching tables for:\t$db\n";
   $dbs[$db]['database'] = $dbname;
   $dbs[$db]['tables'] = get_tables($dbname);
}

mssql_close($con);

header("Content-type: application/javascript");
$json = json_encode($dbs[$db]);
file_put_contents("cache/$db.json", $json);
print $json;

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
      $out[$tbl]['fields'] = get_columns($tbl);
   }
   return $out;
}

function get_columns($tbl) {
   $sql = "exec sp_columns [$tbl]";
   $colres = mssql_query($sql);
   $count = mssql_num_rows($colres);
   // print "Found $count columns for $tbl.\n";
   $out = array();
   while ($row = mssql_fetch_object($colres)) {
      $out[$row->COLUMN_NAME] = new stdClass();
      $out[$row->COLUMN_NAME]->type = $row->TYPE_NAME;
      if ($row->LENGTH) $out[$row->COLUMN_NAME]->type .= "(" . $row->LENGTH . ")";
      $out[$row->COLUMN_NAME]->field = $row->COLUMN_NAME;
      $out[$row->COLUMN_NAME]->null = $row->NULLABLE;
      $out[$row->COLUMN_NAME]->default = $row->COLUMN_DEF;
      $out[$row->COLUMN_NAME]->key = (preg_match("/identity/i", $row->TYPE_NAME)) ? "PRI" : "";
      //$out[$row->COLUMN_NAME]->oem = $row;
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
