#!/usr/local/bin/php
<?php
   require  "Services/Twilio.php";
   require "lib/boss_class.php";
   
   $in = $_REQUEST;

   $bible = `echo "select content from BibleVerses order by bookID, chapter, verse limit 20, 100" | mysql general`;
   $msgs = preg_split("/\n/s", $bible);
   array_pop($msgs); array_shift($msgs);

   $config = array(
      "from"   => "415-810-6991", 
      "sid"    => "AC715921a3209c46399873e89058f0666d", 
      "token"  => "90781d3c3844396b0c38c933a8c583ca"
   );

   $client = new Services_Twilio($config["sid"], $config["token"]);

   $rcpt = "+14153120670";

   foreach ($msgs as $verse) {
      if (strlen($verse) > 160) {
         $msg = substr($verse, 0, 159);
         $sms = $client->account->sms_messages->create($config["from"], $rcpt, $msg);
         
         $msg = substr($verse, 160, 159);
         $sms = $client->account->sms_messages->create($config["from"], $rcpt, $msg);

      } else {
         $sms = $client->account->sms_messages->create($config["from"], $rcpt, $verse);
      }
      print "Sent: $verse\n";
      sleep(1);
    }
?>

