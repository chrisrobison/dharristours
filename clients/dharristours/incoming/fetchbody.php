#!/usr/local/bin/php
<?php
$imap = imap_open("{pop.mail.yahoo.com:995/pop3/ssl/novalidate-cert}", "juanaharrisdht@att.net", "CANADA8bxx559");

$batchsize = 100;
$msgdir = "/simple/clients/dharristours/incoming/";

$msgno = $_REQUEST['msg'] ? $_REQUEST['msg'] : "35436";

if( $imap ) {
  
   print "Logged into mail server.  Retrieving msg $msgno...";
   if ($msgno) {

      if (!file_exists($msgdir . "$msgno-B.txt")) {
         print "Retrieving msg $msgno body...";
         $out = imap_qprint(imap_body($imap, $msgno));
         file_put_contents($msgdir . $msgno . "-B.txt", $out);
         print "Done.\nWrote ".strlen($out). " bytes to $msgno-B.txt\n";
      } else { 
      	 print "Already have ".$msgdir . $msgno . "-B.txt\n";
         $out = file_get_contents($msgdir . "$msgno-B.txt");
      }

      print $out;
   }
}
?>
