<?php
   include("/simple/lib/boss_class.php");

   $boss = new boss("dharristours.simpsf.com");

   $obj = $boss->getObjectRelated("Job", "JobDate='2024-05-23' AND JobCancelled=0");
print_r($obj);
//   $first = "2024-01-01";
//    $last = "2024-04-01";
   //$obj = $boss->getObjectRelated("Job", "JobDate>='{$first}' AND JobDate<='{$last}'");

//   $obj = new stdClass();
// $obj->Business = ["new1"=>[ "Business"=>"Testing" ]];
// $ids = $boss->storeObject($obj);
// $json = <<<EOT
// {"Invoice":{"19033":{"Balance":"0.00","PaidAmt":"2350"},"19102":{"Balance":"0.00","PaidAmt":"2950"},"19319":{"Balance":"0.00","PaidAmt":"750"},"19334":{"Balance":"0.00","PaidAmt":"900"},"19335":{"Balance":"0.00","PaidAmt":"1195"},"19356":{"Balance":"0.00","PaidAmt":"750"},"19382":{"Balance":"0.00","PaidAmt":"1100"}},"Payment":{"new1":{"Payment":"Received $$9,995.00 for WCCUSD - study trips","BusinessID":"336","InvoiceID":"19033","InvoiceIDs":["19319","19382","19334","19335","19356","19102","19033"],"JobIDs":["33913","34043","33551","33467","34250","33059","32532"],"CheckNum":"233603","CheckDate":"04/09/2024","Amount":"9995","Notes":"","ReceivedOn":"2024-04-15 15:55:22","ReceivedBy":"cdr@netoasis.net"}}}
//EOT;
//    $obj = json_decode($json);
//print_r($obj);
   //$obj = $boss->getObjectRelated("Job", 33046);
//print_r($ids);
//$then = date("Y-m-d", strtotime("2 weeks"));
//print $then."\n";

