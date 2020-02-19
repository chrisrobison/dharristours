<?php
   require_once('boss_class.php');
   require_once('calc_class.php');

   $boss = new boss('sys');
   $in = $_REQUEST;

   header("Content-type: text/javascript");
   
   if ($in['rsc'] && $in['id'] && $in['field']) {
      $upd[$in['rsc']][$in['id']][$in['field']] = $in['value'];
      $check = $boss->getObject($in['rsc'], $in['id']);
      if ($check->{$in['field']} != $in['value']) {
         $vids = $boss->storeObject($upd);
         print "showResult(\"Updated <b>{$in['rsc']}</b> ID <b>{$in['id']}</b>'s <b><em>".htmlspecialchars($in['field'])."</em></b> value to <b>".htmlspecialchars($in['value'])."</b>\");\n";
      }
   }
?>
