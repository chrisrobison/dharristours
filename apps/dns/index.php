<?php
   require($_SERVER['DOCUMENT_ROOT'] . "/lib/boss_class.php");
   $sys = new boss();
   $sys->db->dbobj->execute("use SS_System");
   $sys->db->dbobj->db = "SS_System";

   $cond = "App like '%._%' AND Email=".$boss->q($_SESSION['Email']);
   $apps = $sys->getObject("App", $cond);

   $boss = new boss();
   $cnt = count($apps->App['_ids']);
   for ($i=0; $i < $cnt; $i++) {
      if ($boss->db->dbobj->db!='SS_Api') {
         // $boss->db->dbobj->execute("delete from DNS where Zone='{$apps->App[$i]->App}'");   
         $sql = "insert into {$boss->app->DB}.DNS select * from SS_Api.DNS where SS_Api.DNS.Zone='{$apps->App[$i]->App}'";
         //print $sql."\n";
         $boss->db->dbobj->execute($sql);
      }
   }

?>
<!DOCTYPE html> 
<html>
   <head>
      <meta charset="utf-8">
      <title></title>
      <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
      <style>
         body { margin:0;padding:0;font-size:14px;font-family:Georgia, Times, serif; }
         h1, h2, h3, h4, h5 { font-family: Quicksand, "Helvetica Neue", Optima, Verdana, sans-serif; }
         a { text-decoration:none;color:#00c; }
         a:hover { text-decoration:underline; }
         a:visited { color:#006; }
         a:active { color:#e00;display:inline-block;top:2px; }
         #main { margin:1em; }
      </style>
  </head>
   <body>
      <div id='main'>
         
      </div>
   </body>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type='text/javascript'>
      $(document).ready(function() {
         
      });
   </script>
</html>
