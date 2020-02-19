<?php
   include('whois.main.php');

   header("Content-type: application/javascript");

   $start = microtime(true);
   
   $whois = new Whois();
   $query = $_GET['d'];
   $result = $whois->Lookup($query,false);
   $out = new stdClass();
   $out->result = $result;
   $out->request = $_GET; 
   $out->time = sprintf("%.2f", microtime(true) - $start);
   
   print json_encode($out);

?>
