<?php
   require "Services/Twilio.php";
   require ".auth.php";

   $in = $_REQUEST;
   
//   if ($in['msg']) {
      $in['msg'] = ($in['msg']) ? $in['msg'] : "Hey #name#! Monkey Party at 11PM. Bring Bananas!";

      $config = array(
         "from"   => "424-321-8687", 
         "sid"    => $twilio_auth->sid, 
         "token"  => $twilio_auth->token,
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
//   }
?>

