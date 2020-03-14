<?php
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");

   if (!$in['id']) die("<h1>Invalid Record ID</h1>");
   if (!$in['pid']) die("<h1>Invalid Process ID</h1>");
   
   $process = $boss->getObject("Process", $in['pid']);
   $current = $boss->getObject($process->Resource, $in['id']);
?>
<!DOCTYPE html>
<html>
   <head>
      <title><?php print $process->Resource . " Record " . $in['id']; ?></title>
      <link rel='stylesheet' type='text/css' href='/lib/css/core.css' />
      <link rel='stylesheet' type='text/css' href='/lib/css/ui.css' />
      <link rel='stylesheet' type='text/css' href='/lib/css/print.css' />
   </head>
   <body>
      <div class='report' style='margin: 2em;'>
      <h1><?php print $process->Resource.":  ".$current->{$process->Resource}; ?></h1>
      <hr />
      <?php   
         $pform = $boss->getPath( ($process->PrintTemplate) ? $process->PrintTemplate : $process->Form );
         
         if ($pform) {
            if ($process->PrintTemplate) {
               $page = file_get_contents($pform);
               print preg_replace("/\#(.+?)\#/e", "\$current[$1]", $page);
            } else {
               include($pform);
            }
         }      
      ?>
      </div>
   </body>
</html>
