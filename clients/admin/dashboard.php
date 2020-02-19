<?php
   if (!$boss) require_once($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');
   // I rock!
?>
<!DOCTYPE html> 
<html>
   <head>
   <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
   <link rel='stylesheet' type='text/css' href='/lib/css/core.css' />
<?php
   $sys = new obj("SS_System","pimp","pimpin","localhost");
   $sys->addResource("App");
   $rows = $sys->App->getlist("1=1 order by Created");
   $cnt = 0;
   $counts = array();
   foreach ($rows as $idx=>$row) {
      $cnt++;
      $darr = preg_split("/\-/", $row->Created);
      $key = $darr[0].'-'.$darr[1];
      $key = strtotime($key);
      $counts[$key] = (!$counts[$key]) ? $cnt : $counts[$key] + 1;
   }
   
   $chart = array();
   foreach ($counts as $iso=>$count) {
      $date = date("Y-m-d H:i:s", $iso);
      // print "$date [$iso]: $count<br>\n";
      $chart[] = array($iso . '000', $count);
   }
?>
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<script language="javascript" src="http://www.google.com/jsapi"></script>
   <style>
      body { }
      h1, h2, h3, h4, h5 { font-family: Quicksand, "Helvetica Neue", Optima, Verdana, sans-serif; }
      #main {
         position:relative;
         max-width:700px;
      }
      a { 
         color: #0000cc;
      }
      a:hover {
         color: #0000ff;
         text-decoration: underline;
      }
      a:active {
         color:red;
         position:relative;
         top:2px;
      }
      a:visited {
         color:#770099;
      }
      h1 { margin-bottom:.25em; }
      h2:before { font-size:1.2em; font-weight:normal; content: "\2295" " "; margin-left:.5em; color:#000; } 
      h2.open:before { font-size:1.2em; font-weight:normal; content: "\2297" " "; margin-left:.5em; color:#000; } 
      h2 { cursor:pointer; margin-bottom:0px;}
      h2 + ul { margin-left: 2em; }
      h2 + div.section { margin-left: 2em; }
      h3 { margin:4px 0; }
      h3 strong:before, h3.collapsible:before { content: "\2295" " "; margin-left:.5em; color:#000; } 
      h3.open strong:before { content: "\2297" " "; margin-left:.5em; color:#000; } 
      h3 strong { cursor:pointer;font-weight:normal;font-size:1.0em; }
      h3 + ul { margin: 0 0 0 0em; }
      h3 + ul li { list-style-type: circle; }
   </style>
   </head>
   <body>
   <div style="margin:2em;max-width:700px;">
   <div id="chart" style="height:200px;width:300px;"></div>

   <?php include("share/updates.php"); ?>
   <?php include("share/tools.html"); ?>
   <?php include("share/Best-Startup-Websites-List.html"); ?>
   </div>
   </body>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type="text/javascript" src="/lib/js/jquery.flot.min.js"></script>	
   <script type="text/javascript">
      $(function() {
         var d = <?php print json_encode($chart); ?>;
         $.plot($("#chart"), [d], { xaxis: { mode: "time" } });
      });
   </script>
   <script type='text/javascript'>
      $(document).ready(function() {
         $("h2").next("ul").hide("fast");
         $("h2").click(function(event) {
            $(this).toggleClass("open");
            $(this).next("div.section").slideToggle('fast');
            $(this).next("ul").slideToggle('fast');
            $(this).attr("unselectable", "on")
               .css("MozUserSelect", "none")
               .bind("selectstart.ui", function() { return false; }); 
            return false;
         });
         $("h2").next("div.section").hide("fast");
         $("h3").next("ul").hide("fast");
         $("h3").click(function(event) {
            $(this).toggleClass("open");
            $(this).next("ul").slideToggle('fast');
            $(this).attr("unselectable", "on")
               .css("MozUserSelect", "none")
               .bind("selectstart.ui", function() { return false; }); 
            return false;
         });
      });
   </script>
</html>
