<?php
   require "Services/Twilio.php";
   
   $in = $_REQUEST;

   $in['msg'] = ($in['msg']) ? $in['msg'] : "Hey #name#, Monkey Party at 11PM. Bring Bananas!";

   $config = array(
      "from"   => "415-689-7675", 
      "sid"    => "AC715921a3209c46399873e89058f0666d", 
      "token"  => "90781d3c3844396b0c38c933a8c583ca",
      "msg"    => $in['msg']
   );

   $client = new Services_Twilio($config["sid"], $config["token"]);

   $people = array(
      "+14158106991" => "Chris",
      "+14159945077" => "Patrick"
   );

   foreach ($people as $number => $name) {
      $msg = preg_replace("/\#name\#/e", $name, $config["msg"]);

      $sms = $client->account->sms_messages->create($config["from"], $number, $msg);

      print "Sent message: $msg to $name";
    }
?>

