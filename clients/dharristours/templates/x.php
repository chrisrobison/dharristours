#!/usr/local/bin/php
<?php

$time1 = strtotime("11:30:00");
$time2 = strtotime("16:30:00");

print date("H:ia", $time1)."\n";
print date("H:ia", $time2)."\n";
?>
