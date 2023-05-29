<?php
   include("lib/boss_class.php");

   $boss = new boss("dharristours.simpsf.com");

   $boss->db->addResource("Job");
   $results = $boss->getObjectRelated("Login", 51, "all");
print_r($results);
print_r($boss->db);

   print_r($boss->db->dbobj->fields);

?>
