#!/usr/local/bin/php
<?php
//    $contents = file("https://csv.webfleet.com/extern?account=harris-tours&username=cdr&password=Simple1%21&apikey=2b6c8db8-071f-44c0-988f-d82718b1be29&lang=en&action=showObjectReportExtern&outputformat=json")[0];
    $url = "https://csv.webfleet.com/extern?account=harris-tours&username=cdr&password=Simple1%21&apikey=2b6c8db8-071f-44c0-988f-d82718b1be29&lang=en&action=popQueueMessagesExtern&msgclass=0&outputformat=json&feature=video";
    //$url = "https://csv.webfleet.com/extern?account=harris-tours&username=cdr&password=Simple1%21&apikey=2b6c8db8-071f-44c0-988f-d82718b1be29&lang=en&action=ackQueueMessagesExtern&msgclass=0&outputformat=json&feature=video";
    $results = file_get_contents($url);
    print_r($results);

//    $contents = file("https://csv.webfleet.com/extern?account=harris-tours&username=cdr&password=Simple1%21&apikey=2b6c8db8-071f-44c0-988f-d82718b1be29&lang=en&action=showEventReportExtern&range_pattern=d0&outputformat=json")[0];
$now = date("Ymdhis"); 
    file_put_contents("/tmp/webfleet-results-$now.json", "// $url\n" . $results);   
    $obj = json_decode($results);

    header("Content-Type: application/json");
    print json_encode($obj);
    foreach ($obj as $item) {
        $url = "https://csv.webfleet.com/extern?account=harris-tours&username=cdr&password=Simple1%21&apikey=2b6c8db8-071f-44c0-988f-d82718b1be29&lang=en&action=getObjectFeatures&feature=video&outputformat=json";
 //       print $url."\n";
// print_r($item);
//        $results = file_get_contents($url);
 //       print_r($results);
    }
   function sendToFirebase() {
      $now = date("c");
      
/*      $cmd = 'curl -s -S -X PUT -d \'{"lastUpdate": "' . $now . '"}\' https://where-s-my-bus-5bb3d.firebaseio.com/.json';
      print $cmd."\n";
      system($cmd);
  */    
      $cmd = `cp /simple/where/latest.json /simple/where/last.json`;
      $cmd = "curl -s -S -X PUT -d @/simple/where/latest.json https://where-s-my-bus-5bb3d.firebaseio.com/bus.json";
      print $cmd."\n";
      system($cmd);
      
   }
	function storeBuses($contents) {
      if (!$contents) {
         return false;
      }
      include("/simple/.env");
      $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, $env->db->db);
	   /* check connection */
	   if (mysqli_connect_errno()) {
	       printf("Connect failed: %s\n", mysqli_connect_error());
		   exit();
	   }
	   mysqli_query($link, "update WebfleetBus set Active=0 where Active=1");
	   $sql = "INSERT INTO WebfleetBus values (null, '".mysqli_real_escape_string($link, $contents)."', now(), now(), 1)";
      $newid = mysqli_query($link, $sql);

	   /* close connection */
	   mysqli_close($link);
      return $newid;
	}
?>

