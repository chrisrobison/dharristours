<?php
   include($_SERVER['DOCUMENT_ROOT'] . '/.env');
   $in = $_REQUEST;
   $out = array();
   $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");

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
         case "suggestion":
            $out = getSuggestions($link, $in);
            break;
         case "reserve":
            $out = makeReservation($link, $in);
            break;
         case "updateColor":
            $out = updateColor($link, $in);
            break;
      }

      file_put_contents("/tmp/calapi.log", date("Y-m-d H:i:s") . ":" . $in['type'] . ": " . json_encode($in) . " : " .json_encode($out)."\n", FILE_APPEND);
      
      header("Content-type: application/json; charset=utf-8");
      print json_encode($out);
   }

   function updateColor($link, $in) {
      if ($in['color'] && $in['id']) {
         $sql = "update Job set Color='" . mysqli_real_escape_string($link, $in['color']) . "' where JobID='" . mysqli_real_escape_string($link, $in['id']) . "'";
         $results = mysqli_query($link, $sql); 
         if ($results) {
            $out = ["status"=>"ok"];
         }
         return $out;
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
      $colors = array('#e6194b', '#3cb44b', '#ffe119', '#4363d8', '#f58231', '#911eb4', '#46f0f0', '#f032e6', '#bcf60c', '#fabebe', '#008080', '#e6beff', '#9a6324', '#fffac8', '#800000', '#aaffc3', '#808000', '#ffd8b1', '#000075', '#808080', '#ffffff', '#000000');
      
      $out = array(); $cnt = 0;
   
      if ($in['jobdate']) {
         $now = date("Y-m-d", strtotime($in['jobdate']));
      } else {
         $now = date("Y-m-d");
      }
      $in = $_REQUEST;
      $threedays = date("Y-m-d", strtotime("+3 days"));
      $yesterday = date("Y-m-d", strtotime($in['start']));
      $first = date("Y-m-d", strtotime($in['start']));
      $last = date("Y-m-d", strtotime($in['end']));
      $sql = "SELECT JobID, Job.Job as Job, Job.JobDate as JobDate, PickupTime, DropOffTime, PickupLocation, DropOffLocation, NumberOfItems, Job.BusID as BusID, SpecialInstructions FROM Job where JobDate>='{$first}' AND JobDate<='{$last}' AND JobCancelled=0";
      $results = mysqli_query($link, $sql);
      
      while ($row = $results->fetch_assoc()) {
         $obj = new stdClass();
         $obj->id = $row['JobID'];
         $obj->title = $row['Job'];
         $obj->start = date("c", strtotime($row['JobDate'].' '.$row['PickupTime']));
         $obj->end = date("c", strtotime($row['JobDate'].' '.$row['DropOffTime']));
         $obj->resourceId = $row['BusNumber'];

	 $obj->color = $colors[$cnt];
         $obj->url = "/grid/view.php?rsc=Job&pid=335&id={$row['JobID']}";
         $cnt++;
	 if ($cnt > count($colors)) {
	 	$cnt = 0;
	}
         array_push($out, $obj);
      }

      return $out;
   }

   function getResources($link) {
      $colors = array('#e6194b', '#3cb44b', '#ffe119', '#4363d8', '#f58231', '#911eb4', '#46f0f0', '#f032e6', '#bcf60c', '#fabebe', '#008080', '#e6beff', '#9a6324', '#fffac8', '#800000', '#aaffc3', '#808000', '#ffd8b1', '#000075', '#808080', '#ffffff', '#000000');
      
      $out = array(); $cnt = 0;
      $results = mysqli_query($link, "SELECT * FROM Bus WHERE Active=1 order by BusNumber");
      
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
      $results = mysqli_query($link, "SELECT EmployeeID, concat(FirstName, ' ', LastName) as Driver, Email, Phone FROM Employee WHERE Active=1 and Driver=1");
      
      while ($row = $results->fetch_assoc()) {
         array_push($out, $row);
      }

      return $out;
   }
   
   function getSuggestions($link, $in) {
      $out = new stdClass();
      $out->results = array();
      
      $rsc = $in['rsc'];
      if ($rsc == 'customer') {
         $rsc = 'Business';
         
         $results = mysqli_query($link, "SELECT distinct(Business) from Business where Business like '" . $in['q'] . "%' order by Business limit 10");
         while ($row = $results->fetch_assoc()) {
            $match = preg_replace("/(".$in['q'].")/i", "<b>$1</b>", $row['Business']);
            $out->results[] = $match;
            // $out->results[] = $row['Business'];
         }
         
         if (count($out->results) < 10) {
            $results = mysqli_query($link, "SELECT distinct(Business) from Business where Business like '%" . $in['q'] . "%' order by Business limit 20");
            while ($row = $results->fetch_assoc()) {
               $match = preg_replace("/(".$in['q'].")/i", "<b>$1</b>", $row['Business']);
               if (!in_array($match, $out->results)) {
                  $out->results[] = $match;
                  //$out->results[] = $row['Business'];
               }
            }
         }

      } else if (($rsc == 'pickup') || ($rsc == 'dropoff')) {
         $rsc = 'Address';

         $results = mysqli_query($link, "SELECT * from Address where Nickname like '%" . $in['q'] . "%' order by Nickname limit 10");
         while ($row = $results->fetch_assoc()) {
            $match = preg_replace("/(".$in['q'].")/i", "<b>$1</b>", $row['Nickname'] . ' - ' . $row['Address'] . ', ' . $row['City']);
            $out->results[] = $match;
            //$out->results[] = $row['Address'] . ', ' . $row['City'];
         }

         if (count($out->results) < 10) {
            $results = mysqli_query($link, "SELECT * from Address where Address like '" . $in['q'] . "%' or city like '" . $in['q'] . "%' order by Address limit " . (10 - count($out->results)));
            while ($row = $results->fetch_assoc()) {
               $match = preg_replace("/(".$in['q'].")/i", "<b>$1</b>", $row['Address'] . ', ' . $row['City']);
               if (!in_array($match, $out->results)) {
                  $out->results[] = $match;
               }
            }
         }

         if (count($out->results) < 10) {
            $results = mysqli_query($link, "SELECT * from Address where Address like '%" . $in['q'] . "%' or city like '%" . $in['q'] . "%' order by Address limit " . (10 - count($out->results)));
            while ($row = $results->fetch_assoc()) {
               $match = preg_replace("/(".$in['q'].")/i", "<b>$1</b>", $row['Address'] . ', ' . $row['City']);
               if (!in_array($match, $out->results)) {
                  $out->results[] = $match;
               }
            }
         }
      }

      return $out;
   }

   function getBusinessID($link , $str) {
      $results = mysqli_query($link, "SELECT * FROM Business where Business='$str'");
      $row = $results->fetch_assoc();

      if ($row) {
         return $row['BusinessID'];
      }
   }

   function makeReservation($link, $in) {
      $obj = json_decode(urldecode($in['data']));

      if ($obj) {
         $sql = "INSERT INTO Job (Job, BusinessID, ContactName, ContactPhone, ContactEmail, JobDate, PickupTime, DropOffTime, PickupLocation, DropOffLocation)  VALUES (";
         $sql .= quote($obj->customer . ' trip to ' . $obj->dropoff, $link) . ", ";
         $sql .= quote(getBusinessID($link, $obj->customer), $link) . ", ";
         $sql .= quote($obj->cn, $link) . ", ";
         $sql .= quote($obj->cp, $link) . ", ";
         $sql .= quote($obj->ce, $link) . ", ";

         $start = date('H:i:s', strtotime($obj->from));
         $end = date('H:i:s', strtotime($obj->to));
         $date = date('Y-m-d', strtotime($obj->date));

         $sql .= quote($date, $link) . ", ";
         $sql .= quote($start, $link) . ", ";
         $sql .= quote($end, $link) . ", ";
         $sql .= quote($obj->pickup, $link) . ", ";
         $sql .= quote($obj->dropoff, $link) . ")";

         $results = mysqli_query($link, $sql);
         $out = new stdClass();
         $out->sql = $sql;
         $out->status = 'success';
         return $out;
      }


   }
   function quote($str, $link) {
      return "'" . mysqli_real_escape_string($link, $str) . "'";
   }
?>
