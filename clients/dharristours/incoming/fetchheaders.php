#!/usr/local/bin/php
<?php
$imap = imap_open("{pop.mail.yahoo.com:995/pop3/ssl/novalidate-cert}", "juanaharrisdht@att.net", "CANADA8bxx559");

$msgdir = "/simple/clients/dharristours/incoming/";

if ($imap) {
  
   $out = imap_headers($imap);
   $json = json_encode($out);

   file_put_contents($msgdir . "headers.json", $json);
   print $json."\n"; 
}
?>
