<?php
require($_SERVER['DOCUMENT_ROOT'] . '/lib/boss_class.php'); 
$base = ($_SERVER['DOCUMENT_ROOT']) ?  $_SERVER['DOCUMENT_ROOT'] : "/simple";
//require $base . '/src/twilio/twilio-twilio-php-3252c53/Services/Twilio.php';
require 'Services/Twilio.php';

$server = "dharristours.simpsf.com";
//$server = "admin.dev.sscsf.com";
$boss= new boss($server);
$in = $_REQUEST;

$response = new Services_Twilio_Twiml();

$gather = $response->gather(array(
	'action' => 'https://'.$server.'/apps/notify/log-response.php?id='.$_GET['id'], //cdr old
//	'action' => 'http://'.$server.'/apps/notify/log-response.php?id='.$in['NotifyID'],
	'method' => 'GET',
	'numDigits' => '1'
));

$notify = $boss->getObject("Notify", $_GET['id']); 
// $notify = $boss->getObject("Notify", $in['NotifyID']); //pmp new
file_put_contents("/tmp/notify.log", json_encode($notify)."\n", FILE_APPEND);

$out = array('Notify'=>array($_GET['id']=>array()));
$out['Notify'][$_GET['id']]['Status'] = "Called";
$out['Notify'][$_GET['id']]['Attempts'] = $notify->Attempts + 1;
$boss->storeObject($out);
   

$hour = date("H");
$greeting = "Good Morning, ".$notify->Name;
if ($hour > 12 ) $greeting = "Good Afternoon, ".$notify->Name;
if ($hour > 17 ) $greeting = "Good Evening, ".$notify->Name;

$gather->say("This is the Simple Software notification system. . . $greeting.  The following is an important notification from {$notify->CallerName}: ");

$out['Notify'][$_GET['id']]['Response'] = "Delivered";
$boss->storeObject($out);
  // Check to see if we have already reached our max attempts and have not 
  // received a valid response. Invalid responses are placed in Notes
if ($notify->Attempts >= $notify->MaxAttempts) { 
   if ($notify->Response) {
      $gather->say("Our records indicate a response has been received from ".$notify->Name." at ".$notify->Voice.". Of the choices given, their response was ".$notify->Response.". Thank you for your time.");
   } else {
      $gather->say("We did NOT receive a valid response from phone number ".$notify->Name." at ".$notify->Voice." after ".$notify->Attempts." attempts. Good Bye.");
   }   
} else {
   
   $gather->say("...Begin message...");
   $gather->say($notify->Notify);
   $gather->say("...End of message...");
   
   if ($notify->Response && $notify-> Response != "Delivered") {
      $gather->say("Our records indicate a response has already been received from ".$notify->Voice.". Of the choices given, their response was ".$notify->Response.". Thank you for your time.");
   } else {
      if ($notify->Choice) {
         $gather->say("This notification requires confirmation that it was received. Please choose from the following options:");
         $parts = preg_split("/\s*\,\s*/", $notify->Choice);
         foreach ($parts as $part) {
            list($key, $val) = preg_split("/\=/", $part);
            $choices[$key] = $val;
            $gather->say("Press $key for $val");
          }
      }
   }
   $out['Notify'][$notify->NotifyID]['Attempts'] = $notify->Attempts + 1;
   $boss->storeObject($out);
}
header('Content-Type: text/xml');
print $response;
?>
