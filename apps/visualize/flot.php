<?php 
   require($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');

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
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<title>Simple Applications</title>
	<link href="/lib/css/basic.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type="text/javascript" src="/lib/js/jquery.flot.min.js"></script>	
	<script type="text/javascript">
      $(function() {
         var d = <?php print json_encode($chart); ?>;
         $.plot($("#chart"), [d], { xaxis: { mode: "time" } });
      });
   </script>
</head>
<body>
   <div id='chart' style="width:600px;height:300px"> </div>
</body>
</html>
