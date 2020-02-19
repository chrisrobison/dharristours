<?php
require 'Services/Twilio.php';
$response = new Services_Twilio_Twiml();
$gather = $response->gather(array(
	'action' => 'http://cdr2.com/twilio/phonepoll/process_poll.php',
	'method' => 'GET',
	'numDigits' => '1'
));
$gather->say("Greetings and Congratulations! You have been specially selected to participate in the first annual recreational drug preference poll.");
$gather->say("Please listen to the following options and select the item you prefer the most.");
$gather->say("If your drug of choice is Marijuana, Press 1.");
$gather->say("If are a total coke head, Press 2.");
$gather->say("If staying up all night on Meth is your thing, Press 3.");
$gather->say("If are addicted to Heroine, Press 4.");
$gather->say("If are strung out on opium, Press 5.");
$gather->say("If you prefer alcohol, please press 6.");
$gather->say("If you like tripping balls on acid, Press 7.");
$gather->say("Press 8 if rolling on e is more your thing.");

header('Content-Type: text/xml');
print $response;
?>
