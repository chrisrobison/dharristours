<?php
   require "../../lib/boss_class.php";
   $boss = new boss("admin.dev.sscsf.com");
   
   $in['debug'] = 1;

   $n = $boss->getObject("Notify", 1);

   print_r($n);
   
   $out['Notify'][1]['NotifyID'] = 1;
   $out['Notify'][1]['CallerName'] = "Yo mama!";
   $out['Notify'][1]['Attempts'] = $n->Attempts + 1;
   
   $newids = $boss->storeObject($out);

   $new = $boss->getObject("Notify", 1);
   print_r($new);

?>
