<?php
   require("lib/boss_class.php");
   $boss = new boss("sanrio.simpsf.com");

   $out = $boss->getObjectRelated("HelpDesk", 589);

   print_r($out);

?>
