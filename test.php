<?php
   include("/simple/lib/boss_class.php");

   $boss = new boss("dharristours.simpsf.com");

    $first = "2024-01-01";
    $last = "2024-04-01";
   //$obj = $boss->getObjectRelated("Job", "JobDate>='{$first}' AND JobDate<='{$last}'");
   $obj = $boss->getObjectRelated("Job", 33046);
print_r($obj);
$then = date("Y-m-d", strtotime("2 weeks"));
print $then."\n";

