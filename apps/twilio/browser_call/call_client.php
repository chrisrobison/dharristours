<?php
	// @start snippet
	include 'Services/Twilio/Capability.php';

	$accountSid = 'ACxxxxxxxxxxxxxxx';
	$authToken  = 'xxxxxxxxxxxxxxxxx';

	$token = new Services_Twilio_Capability($accountSid, $authToken);
	$token->allowClientOutgoing('APxxxxxxxxxxxxxxx');
	$token->allowClientIncoming($_REQUEST['name']);
	// @end snippet
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Twilio Client Call
		</title>
		<!-- @start snippet -->
		<script type="text/javascript" src="http://static.twilio.com/libs/twiliojs/1.0/twilio.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){

			Twilio.Device.setup("<?php echo $token->generateToken();?>");

			$("#call").click(function() {  
		        params =  { "client" : $("#client_to_call").val() };
		        Twilio.Device.connect(params);
			});
			$("#hangup").click(function() {  
				Twilio.Device.disconnectAll();
			});

			Twilio.Device.incoming(function (conn) {
				conn.accept();
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
			Who would you like to call?<br/>
			<input type="text" id="client_to_call" name="client_to_call"/>
			<input type="button" id="call" value="Start Call"/>
			<input type="button" id="hangup" value="Hangup Call" style="display:none;"/>
			<div id="status">
				Offline
			</div>
		</div>
		<!-- @end snippet -->

	</body>
</html>
