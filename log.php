<?php
   include($_SERVER["DOCUMENT_ROOT"] . "/lib/boss_class.php");

   $boss = new boss();

   $in = $_REQUEST;

   print_r($in);

   file_put_contents($_SERVER["DOCUMENT_ROOT"] . "log/simple.log", json_encode($in), FILE_APPEND);

?>
