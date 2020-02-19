<?php
   require_once("lib/boss_class.php");
   
   $boss = new boss();
   
   $sys = new obj('SS_System', 'pimp', 'pimpin', 'localhost');
   $sys->addResource('App');
   $sys->App->getlist();

   $apps = $sys->App->App;

   $out = print_r($apps, true);
   
   file_put_contents("/tmp/abc.txt", $out);

?>
