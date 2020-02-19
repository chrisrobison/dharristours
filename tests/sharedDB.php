<?php
   require_once("../lib/boss_class.php");

   $boss = new boss("admin.dev.sscsf.com");
   $boss->share->addResource("StaticList");
   $boss->share->StaticList->getlist();

   $lists = $boss->share->StaticList->StaticList;

   print_r($lists);

?>
