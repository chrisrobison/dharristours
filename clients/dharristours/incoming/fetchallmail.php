#!/usr/bin/php
<?php
print "Commecting to IMAP mail server...";
$imap = imap_open("{imap.mail.yahoo.com:993/ssl/novalidate-cert}", "juanaharrisdht@att.net", "wajkxpoukaksgypj");
print "Connected.\n";
$batchsize = 200;
$emaildir = "/simple/clients/dharristours/incoming/";

if( $imap ) {
   
   $total = imap_num_msg($imap);

   print "$total total emails.\n";

   // $headers = imap_headers($imap);
   $messages = array();

   print "Fetching $batchsize emails...";
   
   $todo = $batchsize;
   $i = $total;

   while (($todo > 0) && ($i > 0)) {
//   for ($i=$total; $i>($total-$batchsize); $i--) {
      $uid = imap_uid($imap, $i);
      if (!file_exists($emaildir . "$uid-H.json")) {
         $msg = new stdClass();
         $msg->headers = imap_headerinfo($imap, $i);
         
         $json = json_encode($msg);
         file_put_contents($emaildir . "$uid-H.json", $json);
         file_put_contents($emaildir . "$uid-B.txt", imap_body($imap, $i));
         $messages[] = $msg;
         $todo--;
         $i--;
      } else if (file_exists($emaildir . "$uid-H.json") && (!file_exists($emaildir . "$uid-B.txt"))) {
	      $body = imap_qprint(imap_body($imap, $i));
         file_put_contents($emaildir . "$uid-B.txt", $body);
         
         $todo--;
         $i--;

      } else {
         $i--;
      }
      print ".";
   }
   print "\n";
   imap_close($imap);

   print_r($messages);
}
?>
