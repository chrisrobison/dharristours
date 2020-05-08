#!/usr/local/bin/php
<?php
    $contents = file("https://csv.telematics.tomtom.com/extern?account=harris-tours&username=cdr&password=Simple1%21&apikey=2b6c8db8-071f-44c0-988f-d82718b1be29&lang=en&action=showObjectReportExtern&outputformat=json")[0];
    
    print_r($contents); 
    storeBuses($contents);

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


	function storeBuses($contents) {
      include($_SERVER['DOCUMENT_ROOT'] . "/.env");
      $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, $env->db->db);
	   /* check connection */
	   if (mysqli_connect_errno()) {
	       printf("Connect failed: %s\n", mysqli_connect_error());
		   exit();
	   }
	   mysqli_query($link, "update WebfleetBus set Active=0");
	   $sql = "INSERT INTO WebfleetBus values (null, '".mysqli_real_escape_string($link, $contents)."', now(), now(), 1)";
print $sql."\n";
$newid = mysqli_query($link, $sql);
print_r($newid);
	   /* close connection */
	   mysqli_close($link);

	}
?>

