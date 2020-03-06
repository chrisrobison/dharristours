#!/usr/local/bin/php
<?php
    $contents = file("https://csv.telematics.tomtom.com/extern?account=harris-tours&username=cdr&password=Simple1%21&apikey=2b6c8db8-071f-44c0-988f-d82718b1be29&lang=en&action=showObjectReportExtern&outputformat=json")[0];
    
    $newid = storeBuses($contents);

    if ($newid) {
      file_put_contents("/simple/where/latest.json", $contents);
    } else {
      $contents = file_get_contents("/simple/where/latest.json");
    }
    sendToFirebase();
   

    $obj = json_decode($contents);
    
    $busid = $_GET['bus'];
    if (!$busid) {
    	$busid = '3601';
    }
    if ($busid) {
        for ($i=0; $i<count($obj); $i++) {
            if ($obj[$i]->objectno == $busid) {
                $bus = $obj[$i];
            }
        }
    }

   function sendToFirebase() {
      $now = date("c");
      
/*      $cmd = 'curl -s -S -X PUT -d \'{"lastUpdate": "' . $now . '"}\' https://where-s-my-bus-5bb3d.firebaseio.com/.json';
      print $cmd."\n";
      system($cmd);
  */    
      $cmd = "curl -s -S -X PUT -d @/simple/where/latest.json https://where-s-my-bus-5bb3d.firebaseio.com/bus.json";
      print $cmd."\n";
      system($cmd);
      
   }
	function storeBuses($contents) {
      if (!$contents) {
         return false;
      }
	   $link = mysqli_connect("localhost", "root", ")wsN5WNL%=nNd\$U6", "SS_DHarrisTours");
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

