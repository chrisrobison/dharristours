<?php
// @start snippet
include 'Services/Twilio/Capability.php';

$accountSid = 'AC715921a3209c46399873e89058f0666d';
$authToken  = '90781d3c3844396b0c38c933a8c583ca';

$capability = new Services_Twilio_Capability($accountSid, $authToken);
$capability->allowClientOutgoing('APxxxxxxxxxxxxxxx');
// @end snippet
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Twilio Client Click to Call
		</title>
		<!-- @start snippet -->
		<script type="text/javascript" src="//static.twilio.com/libs/twiliojs/1.1/twilio.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){

			Twilio.Device.setup("<?php echo $capability->generateToken();?>");

			$("#call").click(function() {
				Twilio.Device.connect();
			});
			$("#hangup").click(function() {
				Twilio.Device.disconnectAll();
			});

			Twilio.Device.ready(function (device) {
				$('#status').text('Ready to start call');
			});

			Twilio.Device.offline(function (device) {
				$('#status').text('Offline');
			});

			Twilio.Device.error(function (error) {
				$('#status').text(error);
			});

			Twilio.Device.connect(function (conn) {
				$('#status').text("Successfully established call");
				toggleCallStatus();
			});

			Twilio.Device.disconnect(function (conn) {
				$('#status').text("Call ended");
				toggleCallStatus();
			});

			function toggleCallStatus(){
				$('#call').toggle();
				$('#hangup').toggle();
			}

		});
		</script>
		<!-- @end snippet -->
	</head>
	<body>
		<!-- @start snippet -->
		<div align="center">
			<input type="button" id="call" value="Start Call"/>
			<input type="button" id="hangup" value="Disconnect Call" style="display:none;"/>
			<div id="status">
				Offline
			</div>
		</div>
		<!-- @end snippet -->
	</body>
</html>
