<?php
   
   $xml = file_get_contents($_GET['url']);
//   $xml = html_entities_encode($xml);
   $obj = new SimpleXMLElement($xml);           // Parse XML doc into php object
   $json = json_encode($obj);                   // Covert php object into json format
   $json = preg_replace("/&gt;/", ">", preg_replace("/&lt;/", "<", $json));
   header("Content-type: application/json");
   print $json;

?>
