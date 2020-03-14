<?php
   require("../lib/auth.php");
   
   print_r($_SESSION);

   $boss->addModule();

   $modules = $boss->boss->Modules;
   $boss->addResource("Process");
   
   foreach ($modules as $idx=>$mod) {
      $arr = $boss->db->Process->getlist("ModuleID='".$mod->ModuleID."'");
      $modules[$idx]->Processes = $arr;
   }
   print_r($modules);
?>
