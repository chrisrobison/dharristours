<?php
   require($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');

   if ($in['pid']) {
      $process = $boss->getObject('Process', $in['pid']);
      $in['rsc'] = $process->Resource;
   }

   if ($in['rsc']) {
      $results = $boss->getObject($in['rsc'], $in['id']);
   }

   if ($results) {
      header("Content-type: application/json; charset=utf-8");
      print json_encode($results);
   }

   
?>
