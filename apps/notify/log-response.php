<?php
   require($_SERVER['DOCUMENT_ROOT'] . '/lib/boss_class.php'); 

$base = ($_SERVER['DOCUMENT_ROOT']) ?  $_SERVER['DOCUMENT_ROOT'] : "/simple";
// $server = "admin.dev.sscsf.com";
//require $base . '../src/twilio/twilio-twilio-php-3252c53/Services/Twilio.php';
require 'Services/Twilio.php';
//require 'Services/Twilio/Twimi.php';
require 'Twilio/Twiml.php';
   
   $server = "dharristours.simpsf.com";
   $boss= new boss($server);
   $in = $_REQUEST;
   $in['id'] = $id = $_GET['id'];

file_put_contents("/tmp/notify.log", "Passed in from log-response.php\n---------------------\n", FILE_APPEND);   
file_put_contents("/tmp/notify.log", json_encode($in), FILE_APPEND);   
file_put_contents("/tmp/notify.log", "---------------------\n", FILE_APPEND);   
	$digit = isset($_REQUEST['Digits']) ? $_REQUEST['Digits'] : null;
	$choices = array(
		'1' => 'Yes',
		'2' => 'No'
	);
   
   $notify = $boss->getObject("Notify", $in['id']);
   if ($notify->Choice) {
      $parts = preg_split("/\s*\,\s*/", $notify->Choice);
      foreach ($parts as $part) {
         list($key, $val) = preg_split("/\=/", $part);
         $choices[$key] = $val;
      }
   }

	if ($choices[$digit]) {
      $out = array();
      $out['Notify'][$in['id']]['Response'] = $digit;
      $out['Notify'][$in['id']]['Notes'] = $notify->Notes . "\n---Response received " . date("m/d/Y H:i:s") .": [" . $digit . "] " . $choices[$digit] ."\n";
      $boss->storeObject($out);
      
      // Get full Notify object in preparation for move to Notified table
      $notify = $boss->getObject("Notify", $in['id']);
      
      $notified = array();
      $notified['Notified']['new1'] = $notify;
//      $notified['Notified']['new1']['Notified'] = $notify->Notify;
      $newids = $boss->storeObject($notified);
      $newid = array_shift($newids);

      $out = array();
      $out['Notify'][$in['id']]['NotifiedID'] = $newid;
      $boss->storeObject($out);

//      $boss->db->dbobj->execute("delete from Notify where NotifyID=" . $boss->q($in['id']));

      file_put_contents("/tmp/notify.log", "Recorded response of '$digit' or '{$choices[$digit]}' for Notify ID {$in['id']}\n", FILE_APPEND);
      $say = 'Thank you. Your response of ' . $choices[$digit] . ' has been noted.';
	} else {
		$notify = $boss->getObject('Notify', $_GET['id']);
      $notify->Notes = $digit; // We should check if a valid response was received before calling

      $out['Notify'][$in['id']] = $notify;
      $boss->storeObject($out);
      file_put_contents("/tmp/notify.log", "Invalid response '$digit' for Notify ID {$in['id']}\n", FILE_APPEND);
      $say = "I find your inability to follow instructions disturbing and have noted your behavior. I may give you one more chance and call you back.";
	}
	
   $response = new Services_Twilio_Twiml();
	$response->say($say);
	$response->hangup();
	header('Content-Type: text/xml');
	print $response;
	
?>
