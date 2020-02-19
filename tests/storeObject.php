<?php
   include_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
   
   
   // Sample data object to be stored
   $in['Client']['new1']['Client'] = "John and Jane Smith";
   $in['Client']['new1']['Email'] = "client@example.com";
   $in['Client']['new1']['Child']['new1']['Child'] = "Aiden Smith";
   $in['Client']['new1']['Child']['new1']['Birthday'] = "2008-10-15";
   $in['Client']['new1']['Child']['new2']['Child'] = "Brittney Smith";
   $in['Client']['new1']['Child']['new2']['Birthday'] = "2010-04-15";

   // Store new Client object
   $ids = $boss->storeObject($in);
   print_r($ids);
   
   // Get new ID of stored object
   $id = array_shift($ids);
   
   // Get new object using ID
   $record = $boss->getObject('Client', $id);
   print_r($record);

   // Call a stored procedure passing in the ID of the record just created
   // $boss->db->Client->PROC($id);

   print_r($boss);

?>



