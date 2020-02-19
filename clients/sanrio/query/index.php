<?php
   require($_SERVER['DOCUMENT_ROOT'] . '/lib/auth.php');
?><!DOCTYPE html> 
<html>
   <head>
      <meta charset="utf-8">
      <title></title>
      <link href='//fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
      <link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
      <style>
         body { margin:0;padding:0;font-size:14px;font-family:"Open Sans", "Helvetica Neue", Optima, Verdana, sans-serif; }
         h1, h2, h3, h4, h5 { font-family: Quicksand, "Helvetica Neue", Optima, Verdana, sans-serif; }
         a { text-decoration:none;color:#00c; }
         a:hover { text-decoration:underline; }
         a:visited { color:#006; }
         a:active { color:#e00;display:inline-block;top:2px; }
         #main { margin:1em; cursor: default; }
         th { vertical-align: top; text-align:right;}
      </style>
  </head>
   <body>
      <div id='main'>
         <h1 class='heading'>Sanrio Query Reporting Tool</h1>
         <form target='report' action='report.php' method='POST'>
            <table>
               <tbody>
                  <tr>
                     <th>Database</th>
                     <td>
                        <select id='db' name='db'></select>
                        <button>Execute</button>
                     </td>
                  </tr>
                  <tr>
                     <th>Report Query</th>
                     <td><textarea id='sql' name='sql' rows='4' cols='80'></textarea></td>
                  </tr>
                  <tr>
                     <th>Report</th>
                     <td>
                        <iframe name='report' id='report' style="width:100%;height:700px;border:1px inset #ccc;"></iframe>
                     </td>
                  </tr>
               </tbody>
            </table>
         </form>
      </div>
   </body>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type='text/javascript'>
      $(document).ready(function() {
         $.getJSON("/files/query/dblist.json", function(data) {
            var items = [];
            $.each(data, function(key, val) {
               items.push("<option value='" + val + "'>" + val + "</option>");
            });
            $("#db").append(items.join(''));
         });
         $("form").submit(function(e) {
            /*
            $.post("report.php", { db: $("#db").val(), sql: $("#query").val() }, function(data) {
               $("#report").html(data);
            });
            return false;
            */
         });
      });
   </script>
</html>
