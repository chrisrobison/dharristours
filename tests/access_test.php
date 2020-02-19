<?php
   include_once("lib/auth.php");

   $pid = $in['pid'] = 235;
   $process = $boss->getObject("Process", $in['pid']);
   print "Process Access: ".$process->Access."\n<br>";
   print "User Access: ".$_SESSION['ProcessAccess']."\n<br>";
   print "Bitwise AND results: ".($process->Access & $_SESSION['ProcessAccess'])."<br>\n";
   print_r($boss->app);
   $results = $boss->getObject("Model", "ProcessID='235'");
print_r($_SESSION);
   print_r($results);
?>



