<?php
   include('/simple/.env');
   $in = $_REQUEST;
   $out = array();
   $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");

   /* check connection */
   if (mysqli_connect_errno()) {
       printf("Connect failed: %s\n", mysqli_connect_error());
       exit();
   }

   $sql = "SELECT * FROM Invoice where InvoiceDate>'2011' ORDER BY InvoiceDate";

   $results = mysqli_query($link, $sql);

   // $slices defines the time slices we want to capture along with the date format string to use as key
   $slices = array("day"=>"Y-m-d", "month"=>"Y-m", "year"=>"Y", "week"=>"Y W");
   
   // $tally will capture totals
   $tally = array("day"=>array(), "month"=>array(), "year"=>array(), "week"=>array());
   
   if ($results) {
      while ($row = $results->fetch_assoc()) {
         foreach ($slices as $key=>$slice) {
            $val = date($slice, strtotime($row['InvoiceDate']));
            $tally[$key][$val] = (!array_key_exists($val, $tally[$key])) ? $row['InvoiceAmt'] : $tally[$key][$val] + $row['InvoiceAmt']; 
         }
      }
   }
   foreach ($slices as $key=>$slice) {
      ksort($tally[$key], SORT_NATURAL);
   }
  
   // Preformat data for use with chartjs (array of objects with x/y keys)
   $out = array();

   foreach ($slices as $key=>$slice) {
      $out[$key] = array();
      foreach ($tally[$key] as $date=>$amt) {
         $out[$key][] = array("x"=>$date, "y"=>sprintf("%01.2f", $amt));
      }
   }
   header("Content-type: application/json; charset=utf-8");

   if ($_GET['slice']) {
      print json_encode($out[$_GET['slice']]);
   } else {
      print json_encode($out);
   } 
?>