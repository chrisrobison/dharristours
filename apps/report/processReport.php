<?php
   include($_SERVER['DOCUMENT_ROOT'] . '/lib/auth.php');
   if (!$boss) $boss = new boss();
   
   $in['pid'] = ($in['pid']) ? $in['pid'] : $in['ProcessID'];
   if (!$in['pid']) $in['pid'] = 1;

   $process = $boss->getObject('Process', $in['pid']);
   
   if ($process->OverviewQuery) {
      
   } 
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
