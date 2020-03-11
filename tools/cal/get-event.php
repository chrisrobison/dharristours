<?php
   $in = $_REQUEST;
   if ($in['id']) {
      $out = getEvent($in['id']);
      header("Content-type: application/javascript");
      print json_encode($out);
   }
   exit;

   function getEvent($id) {
      $link = mysqli_connect("localhost", "root", ")wsN5WNL%=nNd\$U6", "SS_DHarrisTours");
      /* check connection */
      if (mysqli_connect_errno()) {
          printf("Connect failed: %s\n", mysqli_connect_error());
          exit();
      }

      $sql = "SELECT * from Job where JobID='".$id."'";

      $results = mysqli_query($link, $sql);
      
      if ($results) {
         $out = $results->fetch_assoc();
         $out['PickupTime'] = date("g:ia", strtotime($out['PickupTime']));
         $out['DropOffTime'] = date("g:ia", strtotime($out['DropOffTime']));
         
      }

      return $out;
   }
?>
