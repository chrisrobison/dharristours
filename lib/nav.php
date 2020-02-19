<?php
   require_once("boss_class.php");
   session_start();

   $cs = new boss();
   $cs->addModule();  //if no ID is specified, all modules in table are returned
   $cs->boss->addProcess();  

   $modules = $cs->boss->Modules;
   header("Content-type: text/javascript");

   $js = "var modules = ".$cs->utility->js_serialize($cs->boss->Modules).";\n";
   print "// Modules\n";
   print $js."\n";
?>
