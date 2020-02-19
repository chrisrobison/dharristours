<?php
   include($_SERVER['DOCUMENT_ROOT'] . '/lib/auth.php');
   
   $in['o'] = $in['o'] ? $in['o'] : "LastDeployed";
   $local = new obj('SS_System', 'pimp', 'pimpin', 'localhost');
   $local->addResource('App');
   $local->App->getlist("1=1 ORDER BY {$in['o']}");
   $apps = $local->App->App;

?>
<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title>Simple Software Application Deployment</title>
      <style>
         body { margin:0;padding:0;font-size:12px;font-family:"Helvetica Neue",Optima,Verdana,sans-serif; }
         div#main a { text-decoration:none;color:#eee; }
         div#main a:hover { text-decoration:underline; }
         div#main a:visited { color:#eee; }
         div#main a:active { color:#e00;display:inline-block;top:2px; }
         div#main { margin:0px; overflow-x:auto; overflow-y:scroll; }
         div#main table td { border-right: 1px solid #ccc; padding:.5em 1em; white-space:nowrap; }
         th { padding: .5em 1em; }
         table { border-collapse:collapse; margin:1em auto;}
         tr:nth-child(2n+1) { background-color: #eefaff; }
         th { background-color:#333; color:#fff; }
         td:first-child { border-left:1px solid #aaa; }
         tr { border-bottom: 1px solid #e0e0e0; }
         .deployed { background-color:#990000 !important; color:#fff !important; }
         .right { text-align:right; }
         div#main table td.noborder { border-right: 0px; }
      </style>
      <link rel='stylesheet' type='text/css' href='/lib/css/core.css'>
  </head>
   <body>
      <div id='main'>
         <form method="POST" action="deploy.php">
         <table>
            <tr><th></th><th><a id='TH-App' href='?o=App'>App Name</a></th><th><a id='TH-Host' href='?o=Host'>Host</a></th>
            <!--th>Domain</th-->
            <th><a id='TH-DB' href='?o=DB'>DB Name</a></th><th colspan='2'><a id='TH-Created' href='?o=Created'>Created On</a></th><th colspan='2'><a id='TH-LastDeployed' href='?o=LastDeployed'>Last Deployed</a></th><th>Actions</th></tr>
         <?php 
            foreach ($apps as $app) {  
               $cls = ($app->Deployed) ? "deployed" : "demo";
               print "<tr class='$cls'>";
               print "<td></td><td>".$app->App."</td><td>".$app->Host."</td>";
               // print "<td>".$app->Domain."</td>";
               print "<td>".$app->DB."</td><td class='right noborder'>".date("m/d/y", strtotime($app->Created)) . "</td><td class='right'>" . date("g:ia", strtotime($app->Created))."</td><td class='right noborder'>";
               if ($app->LastDeployed) {
                  print date("m/d/y", strtotime($app->LastDeployed)) . "</td><td class='right'>";
                  print date("g:ia", strtotime($app->LastDeployed));
               } else {
                  print "</td><td>";
               }
               print "</td><td style='text-align:center'>";
               if (!$app->Deployed) {
                  print "<button class='deploy' id='deploy_{$app->AppID}'>Deploy</button>";
               } else {   
                  print "<button class='deploy-files' id='files_{$app->AppID}' rel='{$app->Host}'>Sync Files</button>";
                  print "<button class='deploy-data' id='data_{$app->AppID}' rel='{$app->DB}'>Sync Data</button>";
               }

               if ($app->Deployed) print "<button class='sync-dev' id='sync_{$app->AppID}' rel='{$app->DB}'>Sync to dev</button>";
               print "</td></tr>\n";
            }
         ?>
         </table>
         </form>
      </div>
   </body>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type='text/javascript'>
      $(document).ready(function() {
         $("button").click(function(e) {
            var me = $(this), cls = me.attr("class"), id = me.attr("id").replace(/^\D*/, ''), rel = me.attr("rel");
            $.get("deploy.php", { "AppID":id, "x":cls, "rel":rel }, function(data) {
               $("body").append(data);
            });
            return false;
         });
         $("#TH-<?php print preg_replace("/\s.*/", '', $in['o']); ?>").css({ "color": "#ff6", "text-decoration":"underline"}).addClass('selected');
      });
   </script>
</html>
