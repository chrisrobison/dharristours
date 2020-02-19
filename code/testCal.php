<?php
   require_once("boss_class.php");

   $boss = new boss();

   $boss->db->addResource('Calendar');
   $boss->db->Calendar->getlist();
   
   print "<pre>";
   print_r($boss->db->Calendar->Calendar);
   
   print "</pre>\n";

?>
