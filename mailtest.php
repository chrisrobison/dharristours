#!/usr/local/bin/php
<?php
$imap = imap_open("{pop.mail.yahoo.com:995/pop3/ssl/novalidate-cert}", "juanaharrisdht@att.net", "CANADA8bxx559");

$batchsize = 100;

if( $imap ) {
   
   $total = imap_num_msg($imap);

   print "$total total emails.\n";

   // $headers = imap_headers($imap);
   $messages = array();

   print "Fetching $batchsize emails...";
   for ($i=$total; $i>($total-$batchsize); $i--) {
      $msg = new stdClass();
      $msg->headers = imap_headerinfo($imap, $i);
//      $msg->body = imap_qprint(imap_body($imap, $i));
      $messages[] = $msg;
      $json = json_encode($msg);
      print ".";
      file_put_contents("/simple/clients/dharristours/incoming/$i-H.json", $json);
   }
   print "\n";
   imap_close($imap);

   print_r($messages);
}
?>
