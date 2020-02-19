<?php
	require 'Services/Twilio.php';
	require 'Services/Twilio/Twiml.php';
   // Connect to MySQL, and connect to the Database
	mysql_connect('localhost', 'pimp', 'pimpin') or die(mysql_error());
	mysql_select_db('twilio') or die(mysql_error());

	// @start snippet
	// Check if values have been entered
	$digit = isset($_REQUEST['Digits']) ? $_REQUEST['Digits'] : null;
	$choices = array(
		'1' => 'Marijuana',
		'2' => 'Cocaine',
		'3' => 'Methamphetamine',
		'4' => 'Heroine',
		'5' => 'Opium',
		'6' => 'Alcohol',
		'7' => 'Acid',
		'8' => 'Ecstasy'
	);
	if (isset($choices[$digit])) {
		mysql_query("INSERT INTO `results` (`choice`) VALUES ('" . $choices[$digit] . "')");
		$say = 'Thank you. Your preference has been noted.';
	} else {
		$say = "Sorry, I don't have that drug right now.";
	}
	// @end snippet
	// @start snippet
	$response = new Services_Twilio_Twiml();
	$response->say($say);
	$response->hangup();
	header('Content-Type: text/xml');
	print $response;
	// @end snippet
?>
