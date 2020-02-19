<?php
/*
** Connect to database:
*/
# putenv('TDSVER=70');

// Connect to the database (host, username, password)
$con = mssql_connect('localhost:1431','simple','simple1') or die('Could not connect to the server!');
 
// Select a database:
mssql_select_db('sanrio') 
    or die('Could not select a database.');
 
// Example query: (TOP 10 equal LIMIT 0,10 in MySQL)
$sql = "SELECT * FROM syscolumns";
$sql = "exec sp_tables @table_type = \"'table', 'view'\"";

// Execute query:
$result = mssql_query($sql) 
    or die('A error occured: ' . mysql_error());
 
// Get result count:
$count = mssql_num_rows($result);
print "Showing $count rows:<hr/>\n\n";
 
// Fetch rows:
while ($row = mssql_fetch_object($result)) {
 
    print_r($row);
 
}
 
mssql_close($con);
?>
