<?php
   $in = $_REQUEST;
   $out = getEvents();

   print json_encode($out);

   function getEvents() {
      $link = mysqli_connect("localhost", "root", ")wsN5WNL%=nNd\$U6", "SS_DHarrisTours");
      /* check connection */
      if (mysqli_connect_errno()) {
          printf("Connect failed: %s\n", mysqli_connect_error());
          exit();
      }

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
?>
