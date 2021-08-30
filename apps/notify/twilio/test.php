<?php
require __DIR__ . '/twilio-php/src/Twilio/autoload.php';
use Twilio\Rest\Client;
// In production, these should be environment variables.
$account_sid = 'AC715921a3209c46399873e89058f0666d';
$auth_token = '158bed38ae821be977910248246af782';
$twilio_number = "+14243218687"; // Twilio number you own
$client = new Client($account_sid, $auth_token);
// Below, substitute your cell phone
$client->messages->create(
    '+14158106991',  
    [
        'from' => $twilio_number,
        'body' => 'This message is a test of the emergency broadcast system.'
    ] 
);
?>
