<?php
require 'Services/Twilio.php';

// Set our AccountSid and AuthToken
$sid = 'AC715921a3209c46399873e89058f0666d';
$token = '90781d3c3844396b0c38c933a8c583ca';

// @start snippet
// List of phone numbers
$numbers = $_REQUEST['phone'];
// @end snippet
// @start snippet
// Instantiate a client to Twilio's REST API
$client = new Services_Twilio($sid, $token);

foreach ($numbers as $number) {
	try {
		$call = $client->account->calls->create(
			'415-810-6991',									// Caller ID
			$number,												// Your friend's number
			'http://cdr2.com/twilio/phonepoll/poll.php'	 // Location of your TwiML
		);
		echo "<pre>Call trans-op [$number]: $call->sid</pre>\n";
	} catch (Exception $e) {
		echo 'Error starting phone call: ' . $e->getMessage() . "\n";
	}
}
// @end snippet
?>
