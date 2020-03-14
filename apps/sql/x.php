<?php
   require("../../lib/boss_class.php");
   
   $boss = new boss("admin.dev.sscsf.com");

   $tbls = $boss->db->dbobj->list_tables();

   print_r($boss->db->dbobj->tables);

   $fields = $boss->db->dbobj->getFields("Employee");
   print_r($fields);

?>
