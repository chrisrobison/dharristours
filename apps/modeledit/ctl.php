<?php
   require($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');

   if ($in['mid']) {
      if ($in['x'] == 'save') {
         $out['Model'][$in['mid']]['Config'] = $in['model'];
         $boss->storeObject($out);
      }
      $model = $boss->getObject("Model", $in['mid']);
      $json = $model->Config;
   }
   
   if ($in['x'] == 'get') {
      $results = $boss->getObject($in['rsc'], $in['id']);
      $json = json_encode($results);
   }

   if ($json) {
      header("Content-type: application/javascript");
      print $json;
   }
?>
