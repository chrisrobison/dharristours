<?php
   require_once("boss_class.php");

   $boss = new boss("admin.dev.sscsf.com");
   
   $input = "InvitesID\tFirstName\tLastName\tAltEmail\tOrigin\tTickets\n";
   $input .= "219\tMike\tGuerra\tmichael.guerra@zimbra.com\tChris\t2\n";
   $input .= "new1\tChris\tRobison\tcdr@cdr2.com\tChris\t2\n";


   $results = $boss->getObject('Invites', $boss->storeObject($boss->parseImport("Invites", $input)));
   print_r($results);


?>
