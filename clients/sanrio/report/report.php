<?php
   require($_SERVER['DOCUMENT_ROOT'] . '/lib/auth.php');
?><!DOCTYPE html> 
<html>
   <head>
      <meta charset="utf-8">
      <title></title>
      <style>
         table { border-collapse:collapse; }
         th { background-color:#114466; color:#fff; padding: 0px .5em; }
         td { white-space:nowrap; }
      </style>
  </head>
  <body>
<?php
$in = $_REQUEST;
$in['sql'] = preg_replace("/(drop|update|delete|truncate|create|into).*/", '', $in['sql']);
$reports = get_report('Sanrio', $in['id']);
$report = $reports[0];

if ($in['vars']) {
   foreach ($in['vars'] as $key=>$val) {
      $pattern = "/\\\$\\\$$key\\\$\\\$/";
      $x = $report['Query'] = preg_replace($pattern, $val, $report['Query']);
   }
}

$in['sql'] = $report['Query'];
$html = ""; // "<h1>Report for query:</h1><pre>" . $in['sql'] . "</pre><br>\n";

$db = ($in['db']) ? $in['db'] : $report['DB'];

if ($report['DBType'] == "mssql") {
   $con = mssql_connect($report['Host'],'simple','simple1') or die('Could not connect to the server!');

   mssql_query("SET ANSI_NULLS ON"); 
   mssql_query("SET ANSI_WARNINGS ON");
   
   mssql_select_db($db, $con) or die('Could not select a database.');

   $result = mssql_query($in['sql']);
   $html .= "<table id='report-table'>\n\t<thead>\n\t\t<tr>";
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
} else {
   $results = run_report($report);

   $html = "<table id='report-table'><thead><tr><th>" . implode(array_keys((array)$results[0]), '</th><th>') . "</th></tr></thead><tbody>";
   
   $cnt = count($results);
   for ($i=0; $i<$cnt; $i++) {
      $html .= "<tr><td>" . implode(array_values((array)$results[$i]), '</td><td>') ."</td></tr>";
   }
   $html .= "</tbody></table>";
}

print $html;
if ($msg) print "<h2 class='error'> *** ERROR: " . $msg . "</h2>";

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

function run_report($report) {
   $link = mysqli_connect($report['Host'], "mail", "activate", "SS_" . $report['DB']);
   /* check connection */
   if (mysqli_connect_errno()) {
       printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
   }

   $query = $report['Query'];
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

?>
</body>
</html>
