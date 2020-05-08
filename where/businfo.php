<?php

$bus = preg_replace("/\D/", '', $_REQUEST['bus']);
// $bus = '3302';

$date = date('Y-m-d');
$time = date('H:i:s');

if ($bus != '') {
   $sql = "SELECT Job.JobID as JobID, Job.Job, Job.JobDate as JobDate, Job.PickupTime as PickupTime, Job.DropoffTime as DropoffTime, Job.PickupLocation as PickupFrom, Job.DropoffLocation as DropoffTo, concat(Employee.FirstName, ' ', Employee.LastName) as Driver, Bus.BusID, Bus.BusNumber from Job, Bus, Employee where Job.JobDate='{$date}' AND Job.BusID=Bus.BusID AND Job.EmployeeID=Employee.EmployeeID AND Bus.BusNumber='{$bus}' AND Job.JobCancelled=0 order by PickupTime"; // and (Job.PickupTime<'{$time}' and Job.DropoffTime>'{$time}')";
} else {
   $sql = "SELECT Job.JobID as JobID, Job.Job, Job.JobDate as JobDate, Job.PickupTime as PickupTime, Job.DropoffTime as DropoffTime, Job.PickupLocation as PickupFrom, Job.DropoffLocation as DropoffTo, concat(Employee.FirstName, ' ', Employee.LastName) as Driver, Bus.BusID, Bus.BusNumber from Job, Bus, Employee where Job.JobDate='{$date}' AND Job.BusID=Bus.BusID AND Job.EmployeeID=Employee.EmployeeID AND Job.JobCancelled=0 order by PickupTime"; // and (Job.PickupTime<'{$time}' and Job.DropoffTime>'{$time}')";
}

//print $sql . "\n";
include($_SERVER['DOCUMENT_ROOT'] . "/.env");
$link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, $env->db->db);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$results = mysqli_query($link, $sql);
$out = array();

while ($obj = mysqli_fetch_assoc($results)) {
   $obj['DropoffTime'] = date("g:ia", strtotime($obj['DropoffTime']));
   $obj['PickupTime'] = date("g:ia", strtotime($obj['PickupTime']));
   $out[] = $obj;
}

print json_encode($out);

mysqli_free_result($results);
mysqli_close($link);

