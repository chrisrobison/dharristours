<?php
   require($_SERVER['DOCUMENT_ROOT'] . "/lib/boss_class.php");

   $boss = new boss();

   $out['Subscriber'] = $_REQUEST['Subscriber'];
   if ($_REQUEST['x'] == "save") {
      $ids = $boss->storeObject($out);
   }

   print '{"results":"Created ID '.$ids[0].'", "status":"OK"}';
?>
