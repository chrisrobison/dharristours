<?php
// $base = ($_SERVER['DOCUMENT_ROOT']) ?  $_SERVER['DOCUMENT_ROOT'] : "/simple.dev";
$base = ($_SERVER['DOCUMENT_ROOT']) ?  $_SERVER['DOCUMENT_ROOT'] : "/simple";
require($base . '/lib/boss_class.php'); 
// $server = "admin.dev.sscsf.com";
require 'Services/Twilio.php';
//require $base . '/src/twilio/twilio-twilio-php-3252c53/Services/Twilio.php';
$server = "dharristours.simpsf.com";
$boss= new boss($server);
$in = $_REQUEST;

// $id = $in['id'];

if ($in['Notify']) {
   $store['Notify'] = $in['Notify'];
   $newid = $boss->storeObject($store);
}

// Set our AccountSid and AuthToken
$sid = 'AC715921a3209c46399873e89058f0666d';
$token = '90781d3c3844396b0c38c933a8c583ca';

// Get list of phone numbers
// $numbers = $_REQUEST['phone'];
// $n = $boss->getObject("Notify", "`When`<=now() and MaxAttempts > Attempts and Response is NULL and (Until >=now() or Until is NULL)");//PATRICK check Until for cutoff
if ($newid) {
   $n = $boss->getObject("Notify", $newid);//PATRICK check Until for cutoff
} else { 
   $n = $boss->getObject("Notify", "`When`<=now() and MaxAttempts > Attempts and (Response = 'Delivered' or Response is NULL) and (Until >=now() or Until = '0000-00-00 00:00:00' or Until is NULL)");//PATRICK check Until for cutoff
}

if ($n->Notify) {
   $notify = $n->Notify;

   // Instantiate a client to Twilio's REST API
   $client = new Services_Twilio($sid, $token);

   foreach ($notify as $key=>$item) {
      if (!preg_match("/^_/", $key)) {
         $number = (($item->Attempts == $item->MaxAttempts) && ($item->BackupVoice)) ? $item->BackupVoice : $item->Voice;
         if ($item->MaxAttempts > $item->Attempts) {
            
            if ($item->Voice) {
               try {
                  $call = $client->account->calls->create(
                     $item->Caller, // Added for upgraded clients
                     $number,
                     'https://'.$server.'/apps/notify/notify.php?id=' . $item->NotifyID
                  );
                  $date =  date("Y-m-d H:i:s");
                  file_put_contents("/tmp/notify.log", $date . ":" . $number . ' | ' . 'https://'.$server.'/apps/notify/notify.php?id=' . $item->NotifyID ."\n", FILE_APPEND);
                  print "<pre>Call trans-op [$number]: $call->sid</pre>\n";

               } catch (Exception $e) {

                  print 'Error starting phone call: ' . $e->getMessage() . "\n";
               }
            }
         }

         if ($notify[$key]->SMS) {
         
         }

         if ($notify[$key]->Email) {

         }
      }
   }
} else {
   print date("Y-m-d H:i:s") . " No pending notifications.  I'll try again later.\n";
}
?>
