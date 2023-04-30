#!/usr/bin/php
<?php
print "Connecting to IMAP server...";
$imap = imap_open("{imap.mail.yahoo.com:993/ssl/novalidate-cert}", "juanaharrisdht@att.net", "wajkxpoukaksgypj");
print "CONNECTED\n";

$batchsize = 10;

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
      if (!file_exists("/simple/clients/dharristours/incoming/$i-H.json")) {
         $msg = new stdClass();
         $msg->headers = imap_headerinfo($imap, $i);
   //      $msg->body = imap_qprint(imap_body($imap, $i));
         $messages[] = $msg;
         $json = json_encode($msg);
         file_put_contents("/simple/clients/dharristours/incoming/$i-H.json", $json);
         print "Fetched msg $i. $todo left to fetch...\n";
         $todo--;
         $i--;
      } else {
         $msg = new stdClass();
         $msg->headers = imap_headerinfo($imap, $i);

         print "Already fetched msg $i. Skipping...\n";
         $existing = file_get_contents("/simple/clients/dharristours/incoming/$i-H.json");
         print "Existing: \n\t".$existing;
         print "\n\nNew:\n\t".json_encode($msg->headers);
         $i--;
      }
   }
   print "\n";
   imap_close($imap);

   print_r($messages);
}
?>
