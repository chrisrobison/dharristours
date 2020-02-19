<?php
   include_once("../../lib/auth.php");

   $boss = new boss('admin.dev.sscsf.com');
   
   $boss->db->dbobj->execute("use SS_System");
   $apps = $boss->getObject("App", 309);
   print_r($apps);
  exit; 
   $sys = new obj('SS_System', 'pimp', 'pimpin', 'admin.simpsf.com');
   $sys->addResource("App");
   $sys->App->getlist();
   $prod = $sys->App->App;
   print_r($prod);
   
   exit;

   $boss->db->addResource('Login');
   print_r($boss->db->Login);
   
   print_r($_SESSION);

?>



