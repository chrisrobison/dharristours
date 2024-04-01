<?php
   include("lib/boss_class.php");

   $boss = new boss("dharristours.simpsf.com");

    $data = file_get_contents("SFUSD_Sports_NovDec.txt");
    $obj = $boss->parseImport("Request", $data);
print_r($obj);


?>
