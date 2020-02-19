<?php

   if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/core.php");
   if (!$in['ReportID']) $in['ReportID'] = 1;
   
   $report = $boss->getObject('Report', $in['ReportID']);
   $current = $boss->getObject('Job', $in['JobID']);
//   print_r($current);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
   <head>
      <title><?php print $report->Report; ?></title>
      <link rel='stylesheet' type='text/css' href='lib/css/default.css' />
      <link rel='stylesheet' type='text/css' href='lib/css/ui.css' />
   </head>
   <body>
      <div class='report' style='margin: 2em;'>
      <h1><?php print $report->Report; ?></h1>
      <?php   
   $pform = $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets."/".$report->Template;
      include($pform);
      ?>
      </div>
   </body>
</html>
