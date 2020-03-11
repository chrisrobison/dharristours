<?php
   $out = getDrivers();
   header("Content-type: application/json");
   print json_encode($out);

   function getDrivers() {
      $link = mysqli_connect("localhost", "root", ")wsN5WNL%=nNd\$U6", "SS_DHarrisTours");
      /* check connection */
      if (mysqli_connect_errno()) {
          printf("Connect failed: %s\n", mysqli_connect_error());
          exit();
      }

      $out = array(); $cnt = 0;
      $results = mysqli_query($link, "SELECT EmployeeID, concat(FirstName, ' ', LastName) as Driver, Email, Phone FROM Employee WHERE Active=1 and Driver=1");
      
      while ($row = $results->fetch_assoc()) {
         array_push($out, $row);
      }

      return $out;
   }
?>
