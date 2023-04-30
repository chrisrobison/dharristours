<?php
header("Content-type: application/json; charset=utf-8");

// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

include($_SERVER['DOCUMENT_ROOT'] . '/.env');
$in = $_REQUEST;
$out = array();
$link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");

/* check connection */
if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

if(isset($in['start'])){
  $out = getEvents($link, $in);
  print json_encode($out);
}

class Availability{
  public $morningCount = 0;
  public $eveningCount = 0;
}

function getEvents($link, $in)
{

  $MORNING_END_TIME = "1500";
  $EVENING_START_TIME = "1400";

  $out = array();

  $startTime = $in['start'] ? strtotime($in['start']) : strtotime('first day of this month');
  $startDate = date("Y-m-d", $startTime);
  $endDate = isset($in['end']) ? date("Y-m-d", strtotime($in['end'])) : date("Y-m-t", $startTime);
  $sql = "SELECT JobID, Job.Job as Job, JobDate, PickupTime, DropOffTime, BusId, JobCancelled  FROM Job "
      ." WHERE JobDate>='{$startDate}' AND JobDate<='{$endDate}'";

  $results = mysqli_query($link, $sql);

  if ($results) {
    for ($i = 1; $i <= date('t', $startTime); $i++) $out[$i] = new Availability();

    while ($row = $results->fetch_assoc()) {
      $isQuote = mb_stripos($row['Job'], 'quote', 0, 'UTF-8') === false ? false : true;
      $isCancelled = $row['JobCancelled'] === 1;
      $jobValue = 1 * calcJobWeight($row['BusId'], $isCancelled, $isQuote);

      $jobDate = $row['JobDate'];
      $jobStart = date("Gi", strtotime($jobDate . ' ' . $row['PickupTime']) );
      $jobEnd = date("Gi", strtotime($jobDate . ' ' . $row['DropOffTime']) );

      $isMorningEvent = $jobStart <= $EVENING_START_TIME;
      $isEveningEvent = $jobStart >= $EVENING_START_TIME || $jobEnd >= $MORNING_END_TIME;

      $dayIndex = date("j", strtotime($jobDate));
// if($dayIndex == 24) echo " > ".$row['JobID']." - $jobStart - $jobEnd - $eveningStart - $isEveningEvent - $jobValue ... ";

      if ($isMorningEvent) $out[$dayIndex]->morningCount += $jobValue;
      if ($isEveningEvent) $out[$dayIndex]->eveningCount += $jobValue;
    }
  }

  return $out;
}

/*
+----------+---------------+-----------+-----+
|        1 | 38 (3801)     |         1 |  48 |
|       18 | 23 (2302) ADA |         1 |  26 |
|       24 | 44 (4402)     |         1 | 116 |
|       33 | 25 (2503) ADA |         1 |  23 |
|       28 | 40 (4001)     |         1 |  94 |
|       31 | 28 (2802)     |         1 | 111 |
|       36 | 35 (3501)     |         1 | 113 |
|       34 | 36 (3601) ADA |         1 | 100 |
|       37 | 44 (4403)     |         1 | 104 |
|       23 | Van/Car       |         1 |   3 |
+----------+---------------+-----------+-----+
*/
function calcJobWeight($busId, $isCancelled, $isQuote) {
  $TBD_RESOURCE = 'TBD';
  $CANCELLED_RESOURCE = 'CANCELLED';
  $BUSES = array(
      "18"=>"2302",
      "33"=>"2503",
      "31"=>"2802",
      "36"=>"3501",
      "38"=>"3502",
      "34"=>"3601",
      "1" =>"3801",
      "28"=>"4001",
      "24"=>"4402",
      "37"=>"4403",
      "22"=>$CANCELLED_RESOURCE,
      "27"=>$TBD_RESOURCE);

  if(!isset($BUSES[$busId])) return 0;
  
  $resource = $BUSES[$busId];
  return $isCancelled === 1 ? 0
      : ($resource === $CANCELLED_RESOURCE ? 0
          : ($resource === $TBD_RESOURCE ? .5
              : ($isQuote === true ? .75
                  : 1) ) );
}

?>

