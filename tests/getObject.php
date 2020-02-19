<?php
   include_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
   

   $in['rsc'] = $in['rsc'] ? $in['rsc'] : "Client";
   // $in['id'] = $in['id'] ? $in['id'] : 2;

   $search['Employee']['Jenny']['ToDo']['ToDoID'] = 58;
   $search['Employee']['Jenny']['JennyID'] = 1;

   $results = $boss->searchObject('Employee', $search);
   
   print_r($results);

   foreach ($results as $id) {
      $emp[] = $boss->getObject('Employee', $id);
   }
   print_r($emp);

   print $results->Login[0]->Email;
?>



