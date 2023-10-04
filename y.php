<?php
   include("lib/boss_class.php");

   $boss = new boss("dharristours.simpsf.com");

   $results = $boss->getObjectRelated("Job", 30079);
print_r($results);


?>
