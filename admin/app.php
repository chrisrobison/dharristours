<?php
   require_once('../lib/boss_class.php');
   
   $in = $_REQUEST;
   $boss = new boss();
   
   if ($in['json']) $in['data'] = json_decode($in['json']);

   if ($in['x']) {
      switch ($in['x']) {
         case 'save':
            $ids = $boss->storeObject($in);
            $vals = array_values($ids);
            $id = $vals[0];
            header("Content-type: application/x-javascript");
            $obj = $boss->getObject($in['rsc'], $id);
            print json_encode($obj);
            break;
         case 'get':
            $current = $boss->getObject($in['rsc'], $in['id']);
            break;
         case 'genform':
            $form = $boss->buildForm($in['rsc']);
            break;
         default:
      }
   }

   if (isset($in['t'])) {
      include('templates/default.php');
   }
?>
