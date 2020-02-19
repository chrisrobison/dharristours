<!DOCTYPE html> 
<html>
   <head>
      <meta charset="utf-8">
      <title></title>
      <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
      <style>
         body { margin:1em;padding:0;font-size:14px;font-family:"Open Sans", "Helvetica Neue", Optima, Verdana, sans-serif; }
         h1, h2, h3, h4, h5 { font-family: Quicksand, "Helvetica Neue", Optima, Verdana, sans-serif; }
         a { text-decoration:none;color:#00c; }
         a:hover { text-decoration:underline; }
         a:visited { color:#006; }
         a:active { color:#e00;display:inline-block;top:2px; }
         #main { margin:1em; cursor: default; }
         .error { background-color: #aa0000; color:#ffffff; font-weight:bold; padding:1em .5em; border:1em solid rgba(205,255,255,.8); border-radius:2em 1em; margin:1em 2em; }
         table { border-collapse:collapse; border: 1px outset #999; box-shadow: 0px .5em 1em rgba(0,0,0,.35); }
         th { background-color:#114466; color:#fff; }
         td { white-space:nowrap; border:1px solid #eee; }
      </style>
  </head>
  <body>
<?php
$con = mssql_connect('localhost:1431','simple','simple1') or die('Could not connect to the server!');

mssql_query("SET ANSI_NULLS ON"); 
mssql_query("SET ANSI_WARNINGS ON");

$in = $_REQUEST;
$in['sql'] = preg_replace("/(drop|update|delete|truncate|create|into).*/", '', $in['sql']);
$html = "<h1>Report for query:</h1><pre>" . $in['sql'] . "</pre><br>\n";

$db = ($in['db']) ? $in['db'] : "Sanrio";
mssql_select_db($db, $con) or die('Could not select a database.');

$result = mssql_query($in['sql']);
$html .= "<table>\n\t<thead>\n\t\t<tr>";
$fnum = mssql_num_fields($result);
for ($i = 0; $i < $fnum; ++$i) {
   $f = mssql_field_name($result, $i);
   $html .= "<th>" . $f . "</th>";
   $fields[] = $f;
}
$html .= "\t\t</tr>\n\t</thead>\n\t<tbody>";

$out = array();

while ($row = mssql_fetch_row($result)) {
   $out[] = $row;
   
   // $html .= "<tr><td>" . join("</td><td>", $row) . "</td></tr>";
   
   $html .= "\t\t<tr>\n";
   for ($x = 0; $x < $fnum; $x++) {
      $html .= "\t\t\t<td>" . $row[$x] . "</td>\n";
   }
   $html .= "\t\t</tr>\n";
}
$html .= "\t</tbody>\n</table>";

$msg = mssql_get_last_message();

mssql_close($con);
print $html;
if ($msg) print "<h2 class='error'> *** ERROR: " . $msg . "</h2>";
?>
</body>
</html>
