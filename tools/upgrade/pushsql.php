#!/usr/local/bin/php
<?php
   require("../../lib/boss_class.php");
   
   $boss = new boss("admin.dev.sscsf.com");
   $prg = array_shift($argv);
   
   $sql = file_get_contents($argv[0]);
   
   $boss->db->addResource('Login');
   $boss->db->Login->execute("show databases like 'SS_%'");
   while ($arr = mysql_fetch_array($boss->db->Login->result)) {
      $out .= "use ".$arr[0].";\n";
      $out .= $sql."\n";
   }

   print $out;
   //print_r($boss->db->Login);

?>
