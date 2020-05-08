<?php
   $q = $_REQUEST['q'];

   if ($q) {
      $q = urlencode(urldecode($q));
      $url = "https://csv.webfleet.com/extern?lang=en&account=harris-tours&username=cdr&password=Simple1%21&apikey=2b6c8db8-071f-44c0-988f-d82718b1be29&action=geocodeAddress&outputformat=json&freetext=" . $q;
      $json = file($url)[0];
   } else {
      $json = "{}";
   }
   header("Content-type: application/javascript");
   print $json;
?>
