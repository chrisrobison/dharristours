<?php
   include($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");   
  
   $boss = new boss();
   if ($in['mid']) {
      $model = $boss->getObject("Model", $in['mid']);
   } else if ($in['pid']) {
      $pid = ($in['pid']) ? $in['pid'] : 235;
      
      $model = $boss->getModel($pid, $in['force']);
   } else if ($in['rsc']) {
      $model = $boss->genTableModel($in['rsc'], false);
   }

   header("Content-type: application/javascript");

   if ($in['full']) {
      $obj = json_decode($model->Config);
      $model->Config = $obj;
      print json_encode($model);
   } else {
      print $model->Config;
   }
?>
