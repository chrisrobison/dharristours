<?php
   $conf['prod'] = array("root"=>"/simple",
                         "host"=>"dharristours.simpsf.com",
                         "db"=>"SS_DHarrisTours");
   
$myenv = "prod";
   
   print_r($conf);
   print_r($conf[$myenv]);
   require($conf[$myenv]["root"] . "/lib/boss_class.php");
   

   print $conf[$myenv]["host"]."\n";
   $boss = new boss($conf[$myenv]["host"]);

?>
