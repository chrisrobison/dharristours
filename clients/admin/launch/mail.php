<?php
   require_once("../../../lib/boss_class.php");

   $boss = new boss("admin.dev.sscsf.com");

   $rcpts = $boss->getObject("Invites", "Unsub!=1");
   $msg = file_get_contents("invite4.txt");
   
   for ($i=0; $i<count($rcpts->Invites['_ids']); $i++) {
      $rec = $rcpts->Invites[$i];
   // foreach ($rcpts->Invites as $key=>$rec) {
   //   if ($key != "_ids") {
         $rec->Recipient = $rec->FirstName.' '.$rec->LastName.' <'.$rec->Email.'>';
         $out = preg_replace("/#(\w+)#/e", '$rec->{$1}', $msg);
         if (!$_SERVER['DOCUMENT_ROOT']) {
         //   $ph = popen("/usr/local/sbin/exim -t -i", "w");
         }
         fwrite($ph, $out);
         pclose($ph);
         print "Sent to ".$rec->Recipient."\n";
   //   }
   }
?>
