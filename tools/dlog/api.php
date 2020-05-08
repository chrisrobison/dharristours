<?php
   include($_SERVER['DOCUMENT_ROOT'] . "/.env");

   $in = $_REQUEST;
   
   $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, $env->db->db);
   
   /* check connection */
   if (mysqli_connect_errno()) {
       printf("Connect failed: %s\n", mysqli_connect_error());
       exit();
   }
   
   if ($in['type']) {
      switch($in['type']) {
         case "events":
            $out = getEvents($link, $in);
            break;
         case "event":
            $out = getEvent($link, $in['id']);
            break;
         case "drivers":
            $out = getDrivers($link, $in);
            break;
         case "jobs":
            $out = getJobs($link, $in);
            break;
         case "resources":
            $out = getResources($link, $in);
            break;
         case "guessCity":
            $out = array(new stdClass());
            $out[0]->address = $in['addr'];
            $out[0]->city = guessCity($in['addr']);
            break;
         case "lookupZip":
            $out = lookupZip($link, $in['zip']);
      }

      if ($out) {
         header("Content-type: application/json");
         print json_encode($out);
      }
   }

   function getEvents($link, $in) {
      $colors = array('#e6194b', '#3cb44b', '#ffe119', '#4363d8', '#f58231', '#911eb4', '#46f0f0', '#f032e6', '#bcf60c', '#fabebe', '#008080', '#e6beff', '#9a6324', '#fffac8', '#800000', '#aaffc3', '#808000', '#ffd8b1', '#000075', '#808080', '#ffffff', '#000000');
      
      $out = array(); $cnt = 0;
   
      if ($in['jobdate']) {
         $now = date("Y-m-d", strtotime($in['jobdate']));
      } else {
         $now = date("Y-m-d");
      }

//       $in = $_REQUEST;
      $threedays = date("Y-m-d", strtotime("+3 days"));
      $yesterday = date("Y-m-d", strtotime($in['start']));

      if ($in['start']) {
         $first = date("Y-m-d", strtotime($in['start']));
      } else {
         $first = date("Y-m-d", strtotime('last week'));
      }
      if ($in['end']) {
         $last = date("Y-m-d", strtotime($in['end']));
      } else {
         $last = date("Y-m-d", strtotime('next week'));
      }
      
      $buses = array("1"=>"3801","18"=>"2302", "24"=>"4402", "26"=>"2502", "28"=>"4001", "31"=>"2802", "32"=>"3301", "33"=>"2503", "34"=>"3601", "22"=>"CANCELLED","27"=>"TBD");

      $sql = "SELECT JobID, Color, Job.Job as Job, Job.JobDate as JobDate, PickupTime, DropOffTime, PickupLocation, DropOffLocation, NumberOfItems, Job.BusID as BusID, SpecialInstructions, Job.EmployeeID as EmployeeID, JobCancelled FROM Job where JobDate>='{$first}' AND JobDate<='{$last}'";

      $results = mysqli_query($link, $sql);
      
      if ($results) {
         while ($row = $results->fetch_assoc()) {
            $obj = new stdClass();
            $obj->id = $row['JobID'];
            $obj->title = $row['Job'];
            $obj->start = date("c", strtotime($row['JobDate'].' '.$row['PickupTime']));
            $obj->end = date("c", strtotime($row['JobDate'].' '.$row['DropOffTime']));
            $obj->resourceId = $buses[$row['BusID']];
            $obj->color = $row['Color'];
            if ($row['JobCancelled']==1) {
               $obj->color = "#222222";
            }
         //   $obj->url = "/grid/view.php?rsc=Job&pid=335&id={$row['JobID']}";
         $obj->url = "javascript:handleClick('{$row['JobID']}')";
            $obj->extendedProps = new stdClass;
            $obj->extendedProps->EmployeeID = $row['EmployeeID'];

            $cnt++;
            if ($cnt > count($colors)) {
               $cnt = 0;
            }
            array_push($out, $obj);
         }
      }

      return $out;
   }
   
   function getEvent($link, $id) {
      $sql = "SELECT * from Job where JobID='".$id."'";

      $results = mysqli_query($link, $sql);
      
      if ($results) {
         $out = $results->fetch_assoc();
         $out['PickupTime'] = date("g:ia", strtotime($out['PickupTime']));
         $out['DropOffTime'] = date("g:ia", strtotime($out['DropOffTime']));
         
      }

      return $out;
   }

   function getJobs($link, $in) {
      $out = array(); $cnt = 0;
   
      if ($in['jobdate']) {
         $now = date("Y-m-d", strtotime($in['jobdate']));
      } else {
         $now = date("Y-m-d");
      }
      $in = $_REQUEST;
      $sql = "SELECT JobID, Job.Job as Job, Job.JobDate as JobDate, PickupTime, DropOffTime, PickupLocation, DropOffLocation, NumberOfItems, Job.BusID as BusID, Bus.BusNumber as BusNumber, SpecialInstructions FROM Job, Bus where Job.BusID=Bus.BusID AND JobDate='{$now}' AND JobCancelled=0 AND EmployeeID=".$in['EmployeeID'];
      $results = mysqli_query($link, $sql);
      
      while ($row = $results->fetch_assoc()) {
         $obj = new stdClass();
         $obj->id = $row['JobID'];
         $obj->title = $row['Job'];
         $obj->pickup = $row['PickupLocation'];
         $obj->dropoff = $row['DropOffLocation'];
         $obj->busnum = $row['BusNumber'];
         $obj->start = date("c", strtotime($row['JobDate'].' '.$row['PickupTime']));
         $obj->end = date("c", strtotime($row['JobDate'].' '.$row['DropOffTime']));

         array_push($out, $obj);
      }

      return $out;
   }

   function getResources($link) {
      $colors = array('#e6194b', '#3cb44b', '#ffe119', '#4363d8', '#f58231', '#911eb4', '#46f0f0', '#f032e6', '#bcf60c', '#fabebe', '#008080', '#e6beff', '#9a6324', '#fffac8', '#800000', '#aaffc3', '#808000', '#ffd8b1', '#000075', '#808080', '#ffffff', '#000000');
      
      $out = array(); $cnt = 0;
      $results = mysqli_query($link, "select BusID, Bus, BusNumber, Capacity, License, Year, Make, Model, VIN, Active from Bus where Active=1 and Capacity>0 order by BusNumber");
      
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
         $obj->capacity = $row['Capacity'];

         if (!$obj->capacity || $obj->capacity == "null") {
            $obj->capacity = $row['BusNumber'] ? substr($row['BusNumber'], 0, 2) : 0;
         }
         
         array_push($out, $obj);
      }

      return $out;
   }
   
   function getDrivers($link) {
      $out = array(); $cnt = 0;
      $results = mysqli_query($link, "SELECT EmployeeID, concat(FirstName, ' ', LastName) as Driver, Email, Phone FROM Employee WHERE Active=1 and Driver=1 and EmployeeID!=69 order by Driver");
      
      while ($row = $results->fetch_assoc()) {
         array_push($out, $row);
      }

      return $out;
   }

 function guessCity($addr) {
      $cities = array('South San Francisco', 'San Francisco', 'San Rafael', 'Vallejo', 'San Ramon', 'Castro Valley', 'Loma Mar', 'Alameda', 'Oakland', 'Sausalito', 'Elk Grove', 'Walnut Creek', 'Berkeley', 'Rocklin', 'Atherton', 'Brentwood', 'Folsom', 'Pacifica', 'Morgan Hill', 'Burlingame', 'Lagunita', 'El Cerrito', 'Richmond', 'Monterey', 'Montara', 'Concord', 'Pleasanton', 'Windsor', 'Corte Madera', 'Oakville', 'Mill Valley', 'Daly City', 'Vacaville', 'Union City', 'Merced', 'San Mateo', 'Palo Alto', 'Hayward', 'Livermore', 'Santa Clara', 'Sunnyvale', 'San Carlos', 'Redwood City', 'San Leandro', 'Pleasant Hill', 'Hercules', 'Eureka', 'Marin City', 'Danville', 'Alviso', 'Pittsburgh', 'Rohnert Park', 'San Lorenzo', 'Half Moon Bay', 'San Pablo', 'Dublin', 'Larkspur', 'Davis', 'Sacramento', 'Lafayette', 'Ross', 'Pittsburg', 'Menlo Park', 'Novato', 'Arbuckle', 'San Jose', 'Kentfield', 'Fremont', 'Piedmont', 'Boulder Creek', 'Healdsburg', 'Fairfax', 'Milpitas', 'Martinez', 'Aptos', 'Fairfield', 'Orinda', 'Antioch', 'Oakley', 'Pinole', 'Clayton', 'Greenbrae', 'Lotus', 'Dixon', 'Stockton', 'Albany', 'Emeryville', 'Cazadoro', 'El Sobrante', 'Oakhurst', 'Stanford', 'Nicasio', 'Suisun City', 'Napa', 'Tomales', 'Newark', 'Modesto', 'Santa Rosa', 'Turlock', 'Pescadero', 'Santa Cruz', 'Groveland', 'Tiburon', 'Crockett', 'Sonoma', 'Brisbane', 'Mountain House', 'Mt House', 'Tracy', 'Moraga', 'Los Altos', 'Fresno', 'San Bruno', 'Petaluma', 'Benecia', 'Gilroy', 'Sausilito', 'Stinson Beach', 'Felton', 'San Gregorio', 'Mountain View', 'Mt View', 'Mt. View', 'Millbrae', 'Milbrae', 'Rodeo', 'Clarksberg', 'Alamo', 'Marysville', 'Yuba City', 'Belmont', 'Inverness');

      $ccnt = count($cities);
      $city = "";
      for ($c=0; $c<$ccnt; $c++) {
         $matched = preg_grep("/".$cities[$c]."/i", $addr);
         if (count($matched) > 0) {
            $city = $cities[$c];
            //print "Found city '".$cities[$c]."'\n";
            $c = $ccnt + 1;
         }
      }

      if (!$city) {
         $city = "San Francisco";
      }

      return $city;
   }

   function lookupZip($link, $zip) {
      
      $results = mysqli_query($link, "SELECT * from ZipCode where ZipCode='".$zip."'");
      
      $row = $results->fetch_assoc();

      return $row;
   }


?>
