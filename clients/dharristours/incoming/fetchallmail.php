#!/usr/bin/php
<?php
$imap = imap_open("{pop.mail.yahoo.com:995/pop3/ssl/novalidate-cert}", "juanaharrisdht@att.net", "CANADA8bxx559");

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
      if (!file_exists($emaildir . "$i-H.json")) {
         $msg = new stdClass();
         $msg->headers = imap_headerinfo($imap, $i);
         
	 $json = json_encode($msg);
         file_put_contents($emaildir . "$i-H.json", $json);
         print "Retrieved msg $i headers.  Grabbing body...";

	 $msg->body = imap_qprint(imap_body($imap, $i));
         file_put_contents($emaildir . "$i-B.txt", $msg->body);
         print "Done. \nFetched msg $i. $todo left to fetch...\n";
         $messages[] = $msg;
         $todo--;
         $i--;
      } else if (file_exists($emaildir . "$i-H.json") && (!file_exists($emaildir . "$i-B.txt"))) {
         print "Already fetched headers.  Grabbing body for msg $i...";
	 $body = imap_qprint(imap_body($imap, $i));
         file_put_contents($emaildir . "$i-B.txt", $body);
         print "Done. \nFetched msg $i. $todo left to fetch...\n";
         
	 $todo--;
         $i--;

      } else {
         print "Already fetched msg $i. Skipping...\n";
         $i--;
      }
   }
   print "\n";
   imap_close($imap);

   print_r($messages);
}
?>
