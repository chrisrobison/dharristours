<?php
   $in = array();
   $in = $_REQUEST;


   $out = getWhere($in['date'], $in['bus']);
   header("Content-type: application/javascript");
   print json_encode($out);
   exit;

   function getWhere($date="", $bus="") {
      $link = mysqli_connect("localhost", "root", ")wsN5WNL%=nNd\$U6", "SS_DHarrisTours");
      /* check connection */
      if (mysqli_connect_errno()) {
          printf("Connect failed: %s\n", mysqli_connect_error());
          exit();
      }
      
      if ($date) {
         $mydate = strtotime($date);
         $earlier = date("Y-m-d H:i:00", strtotime("2 hours ago", $mydate));
         $now = date("Y-m-d H:i:00", $mydate);

         $sql = "SELECT * from WebfleetBus where Created>='".$earlier."' and Created<='".$now."' order by Created desc limit 120";
      } else { 
         $sql = "SELECT * from WebfleetBus order by Created desc limit 120";
      }
      $results = mysqli_query($link, $sql);
      $out = array();      
      if ($results) {
         while ( $row = $results->fetch_assoc()) {

            if ($row) {

               $json = json_decode($row['JSON']);

               if ($bus) {
                  foreach ($json as $idx=>$obj) {
                     if ($obj->objectno == $bus) {
                        $out[$row['LastModified']] = $obj;
                     }
                  }
               } else {
                  $out[$row['LastModified']] = $json;
               }
               //$out['PickupTime'] = date("g:ia", strtotime($out['PickupTime']));
               //$out['DropOffTime'] = date("g:ia", strtotime($out['DropOffTime']));
            } 
         } 
      }

      return $out;
   }
?>
