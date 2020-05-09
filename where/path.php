<?php
   include($_SERVER['DOCUMENT_ROOT'] . "/.env");
   $in = array();
   $in = $_REQUEST;

   $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, $env->db->db);
   if (mysqli_connect_errno()) {
       printf("Connect failed: %s\n", mysqli_connect_error());
       exit();
   }
         
   if ($in['bus']) {
      $buses = preg_split("/\:/", $in['bus']);
   }

   $out = getWhere($link, $in['date'], $in['end'], $buses);

   header("Content-type: application/javascript; charset=utf-8");
   print json_encode($out);
   
   mysqli_close($link);

   exit;

   function getWhere($link, $date="", $enddate="", $buses=array()) {
      /* check connection */

      if ($date && $enddate) {
         // $mydate = strtotime($date);
         // $earlier = date("Y-m-d H:i:00", strtotime("2 hours ago", $mydate));
         //$now = date("Y-m-d H:i:00", $mydate);

         $sql = "SELECT * from WebfleetBus where Created>='".$date."' and Created<='".$enddate."' order by Created desc";
      } else { 
         $sql = "SELECT * from WebfleetBus order by Created desc limit 1440";
      }
      $results = mysqli_query($link, $sql);
      $out = array();     
      $gps = array();
      if ($results) {
         while ( $row = $results->fetch_assoc()) {

            if ($row) {

               $json = json_decode($row['JSON']);

               if (count($buses) && $buses[0] != "") {
                  foreach ($json as $idx=>$obj) {
                     if (in_array($obj->objectno, $buses)) {
                        $coord = new stdClass();
                        $coord->lat = $obj->latitude_mdeg / 1000000;
                        $coord->lng = $obj->longitude_mdeg / 1000000;
                        $coord->date = $row['Created']; //$obj->pos_time;
                        $out[$obj->objectno][] = $coord;
                     }
                  }
               } else {
                  foreach ($json as $idx=>$obj) {
                     $coord = new stdClass();
                     $coord->lat = $obj->latitude_mdeg / 1000000;
                     $coord->lng = $obj->longitude_mdeg / 1000000;
                     $coord->date = $row['Created']; // $obj->pos_time;
                     $out[$obj->objectno][] = $coord;
                  }
               }
               //$out['PickupTime'] = date("g:ia", strtotime($out['PickupTime']));
               //$out['DropOffTime'] = date("g:ia", strtotime($out['DropOffTime']));
            } 
         } 
      }

      return $out;
   }
?>
