<?php
   $out = getResources();

   print json_encode($out);

   function getResources() {
      $link = mysqli_connect("localhost", "root", ")wsN5WNL%=nNd\$U6", "SS_DHarrisTours");
      /* check connection */
      if (mysqli_connect_errno()) {
          printf("Connect failed: %s\n", mysqli_connect_error());
          exit();
      }

      $colors = array('#e6194b', '#3cb44b', '#ffe119', '#4363d8', '#f58231', '#911eb4', '#46f0f0', '#f032e6', '#bcf60c', '#fabebe', '#008080', '#e6beff', '#9a6324', '#fffac8', '#800000', '#aaffc3', '#808000', '#ffd8b1', '#000075', '#808080', '#ffffff', '#000000');
      
      $out = array(); $cnt = 0;
      $results = mysqli_query($link, "SELECT * FROM Bus WHERE Active=1");
      
      while ($row = $results->fetch_assoc()) {
         $obj = new stdClass();
         if ($row['BusNumber']) {
            $obj->id = $row['BusNumber'];
            $obj->busID = $row['BusID'];
            $obj->title = '#' . $row['BusNumber'];
         } else {
            $obj->id = $row['Bus'];
            $obj->busID = $row['BusID'];
            $obj->title = $row['Bus'];
         }
         $obj->capacity = $row['capacity'];
         
         array_push($out, $obj);
      }

      return $out;
   }
?>
