<?php
   include($_SERVER['DOCUMENT_ROOT'] . '/lib/auth.php');
   if (!$boss) $boss = new boss();
   
   if (!$in['ReportID']) $in['ReportID'] = 1;
   $in['rid'] = ($in['rid']) ? $in['rid'] : $in['ReportID'];

   $report = $boss->getObjectRelated('Report', $in['ReportID']);
//   $current = $boss->getObject('Job', $in['JobID']);
//   print_r($current);
?>
<!DOCTYPE html>
<html>
   <head>
      <title><?php print $report->Report; ?></title>
      <link rel='stylesheet' type='text/css' href='/lib/css/core.css' />
      <link rel='stylesheet' type='text/css' href='/lib/css/default.css' />
      <link rel='stylesheet' type='text/css' href='/lib/css/ui.css' />
      <link rel='stylesheet' type='text/css' href='/lib/css/print2.css?ver=1.3' media='print' />
   </head>
   <body>
      <div class='report' style='margin: 2em;'>
      <h1 id='Report'><?php print $report->Report; ?></h1>
      <?php   
         if ($report->Template) {
            $pform = $boss->getFilePath($report->Template);
         
            if (!is_dir($pform) && file_exists($pform)) {
               include($pform);
            }
         } else {
            include("templates/GenericReport.php");
         }
      ?>
      </div>
   </body>
</html>
