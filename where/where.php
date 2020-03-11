<?php
   $in = array();
   $in = $_REQUEST;


   if (!$in || !$in['date']) {
      $in['date'] = date("Y-m-d H:i:00");
   }

   if ($in['date']) {
      $out = getWhere($in['date']);
      header("Content-type: application/javascript");
      print json_encode($out);
   }
   exit;

   function getWhere($date="") {
      $link = mysqli_connect("localhost", "root", ")wsN5WNL%=nNd\$U6", "SS_DHarrisTours");
      /* check connection */
      if (mysqli_connect_errno()) {
          printf("Connect failed: %s\n", mysqli_connect_error());
          exit();
      }
      
      $mydate = strtotime($date);
      $earlier = date("Y-m-d H:i:00", strtotime("2 hours ago", $mydate));
      $now = date("Y-m-d H:i:00", $mydate);

      $sql = "SELECT * from WebfleetBus where Created>='".$earlier."' and Created<='".$now."' order by LastModified desc limit 60";
      $results = mysqli_query($link, $sql);
      
      if ($results) {
         $out = $results->fetch_assoc();

         if ($out) {
            $out['PickupTime'] = date("g:ia", strtotime($out['PickupTime']));
            $out['DropOffTime'] = date("g:ia", strtotime($out['DropOffTime']));
         } 
      }

      return $out;
   }
?>
