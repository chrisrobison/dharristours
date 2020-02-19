<?php
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");

   $in['Resource'] = "Quote";
   $in['ID'] = $in['ID'] ? $in['ID'] : 1;
   $current = $boss->getObject($in['Resource'], $in['ID']);
   
   // Get new object using ID
   $record = $boss->getObject($in['Resource'], $in['ID']);
   
   // Call a stored procedure passing in the ID of the record just created
   $boss->db->Quote->execute("CALL QuoteToJob({$in['ID']},'{$_SESSION['Login']->Email}',@JobID)");//QuoteToJob($id,$_SESSION['Login']->Email,$results['JobID']);
   $boss->db->Quote->execute("SELECT @JobID");
   
   $result = $boss->db->Quote->fetch_array();
   
   print_r("New Job created ID: ");
   print_r($result[0]);

/*
$mysqli = new mysqli(  "localhost", "pimp", "pimpin", "SS_DHarrisTours" );

$ivalue=1;
$res = $mysqli->multi_query( "CALL QuoteToJob($ivalue,'juana',@x);SELECT @x" );
print_r($res);
*/
   //print_r($boss);
   //$job = $boss->getObject('Job',$new);
  // print_r($new);

?>



