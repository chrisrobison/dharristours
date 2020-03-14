<?php
   include("../../lib/boss_class.php");

   $boss = new boss("admin.dev.sscsf.com");

   $boss->db->dbobj->execute("use SS_System");
   $boss->db->addResource("App");
   $results = $boss->db->App->getlist();
print_r($results);
print_r($boss->db);

   print_r($boss->db->dbobj->fields);

?>
