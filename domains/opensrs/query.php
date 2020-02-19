<?php
   $now = microtime(true);
   require_once ("opensrs/openSRS_loader.php"); 
   
   $in = $_GET;
   $in['x'] = $in['x'] ? $in['x'] : 'suggestDomain';

   $callArray = array ( 
      "func" => $in['x'],
      //"func" => "lookupDomain",
      "data" => array ( 
         "domain" => $in['d'], 
         "selected" => ".com;.net;.org", 
         "alldomains" => ".com;.net;.org;.co;.biz;.info;.tv" 
      ) 
   ); 

   $results = processOpenSRS("json", json_encode($callArray)); 
   $out = new stdClass();
   $out->request = $in;
   $out->response = $results->resultRaw;
   $out->date = date("Y-m-d H:i:s");
   $out->querytime = (microtime(true) - $now);

   print json_encode($out);

?> 
