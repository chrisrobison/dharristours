<?php
   include_once("lib/auth.php");

   $results = $boss->getObject("Model", "ProcessID='235'");
print_r($_SESSION);
   print_r($results);
?>



