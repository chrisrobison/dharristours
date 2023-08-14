<?php  
    if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php"); 
    $in = $_REQUEST;

    $now = date("Y-m-d H:i:s");
    $shortnow = date("Y-m-d");
    $yr = date("Y");
    $today = date("d");
    $tomonth = date("m");
    
    $busID = (array_key_exists('busID', $in)) ? $in['busID'] : $_SESSION['Login']->BusinessID;

    if (!$busID && $_SESSION['Login']->BusinessIDs) {
        $busID = explode(",", $_SESSION['Login']->BusinessIDs)[0];
    }

    if (array_key_exists("BusinessID", $_SESSION)) {
        $busID = $_SESSION['BusinessID'];
    }
    
    if ($busID==332) {
        $sql = "SELECT sum(NumberOfItems) as Pax, sum(TotalMileage) as Miles, sum(Hours) as Hours FROM Job WHERE JobDate>='$yr-01-01'";
    } else {
        $sql = "SELECT sum(NumberOfItems) as Pax, sum(TotalMileage) as Miles, sum(Hours) as Hours FROM Job WHERE BusinessID='{$busID}' and JobDate>='$yr-01-01'";
    }
    $boss->db->dbobj->execute($sql);
    $stats = $boss->db->dbobj->fetch_object();
    
    if ($busID==332) {
        $sql = "SELECT count(JobID) as Trips FROM Job WHERE (JobDate>='$yr-01-01' AND JobDate<now()) AND JobCancelled=0";
    } else {
        $sql = "SELECT count(JobID) as Trips FROM Job WHERE BusinessID='{$busID}' AND JobDate<now() AND JobCancelled=0";
    }
    $boss->db->dbobj->execute($sql);
    $trips = $boss->db->dbobj->fetch_object();
    $stats->Trips = $trips->Trips;

    //print_r($boss);
    //mysqli_query($boss->db->dbobj, );
    
    if ($busID==332) {
        $sql = "JobDate='{$shortnow}' and JobCancelled=0";
    } else {
        $sql = "BusinessID='{$busID}' and JobDate='{$shortnow}' and JobCancelled=0";
    }
    
    if ($busID==332) {
        $todaysJobs = $boss->getObject("Job", "JobDate='{$shortnow}' and JobCancelled=0");
    } else {
        $todaysJobs = $boss->getObject("Job", "BusinessID='{$busID}' and JobDate='{$shortnow}' and JobCancelled=0");
    }

    if ($busID==332) {
        $lastmonth = date("Y-m-d", strtotime("30 days ago"));
        $lastyear = date("Y-m-d", strtotime("365 days ago"));

        $invoices = $boss->getObjectRelated("Invoice", "Balance>0 and InvoiceDate<'{$lastmonth}' and InvoiceDate>'{$lastyear}'");
        $sql = "select sum(Balance) as PastDue from Invoice where Balance>0 and InvoiceDate<'{$lastmonth}' and InvoiceDate>'{$lastyear}'";
        $boss->db->dbobj->execute($sql);
        $pastdue = $boss->db->dbobj->fetch_object();
        $stats->OverdueInvoices = count($invoices->Invoice["_ids"]);

        $stats->PastDue = $pastdue->PastDue;
    }
    $business = $boss->getObject("Business", $busID);
    $bus = $boss->getObject("Bus", "Active=1");
    $buses = array(); 
    $pax = array();
    foreach ($bus->Bus as $obj) {
        $buses[$obj->BusID] = $obj->BusNumber;
        $pax[$obj->BusID] = $obj->Capacity;
    }

    $emps = $boss->getObject("Employee", "Active=1 and Driver=1");
    $employees = array();
    foreach ($emps->Employee as $emp) {
        if ($emp->EmployeeID) {
            $employees[$emp->EmployeeID] = $emp;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Customer Portal Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/fontawesome-free-6.4.0-web/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
  <link rel="stylesheet" href="/portal/node_modules/leaflet/dist/leaflet.css">
  <style>
    .map, #map {
        display:inline-block;
        height: 230px;
        width: 216px;
    }
    .map-form td {
        vertical-align: top;
    }
    .map-card {
        position: relative;
        display:flex;
        flex-direction:row;
    }
    .small-box .icon {
     display: inline-block; 
}

    @media only screen and (max-width:450px) {
        .map {
            width: 100%;
        }
        .map-card {
            flex-direction: column;

        }
    }
</style>
  <!-- Make sure you put this AFTER Leaflet's CSS -->
  <script src="/portal/node_modules/leaflet/dist/leaflet.js"></script>
  <script src="/portal/assets/dom-to-image.js"></script>
<script>
let buses;
fetch("/portal/api.php?type=resources").then(r=>r.json()).then(data=>{
    mybuses = data;
    console.log(mybuses);
});
</script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left:0px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">D Harris Tours Transit Portal</h1>
            <h2 class="m-0">For <?php print $business->Business; ?></h2>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?php print number_format($stats->Trips); ?></h3>

                    <p>Trips in <?php print date("Y"); ?></p>
                  </div>
                  <div class="icon">
                    <i class="fa-sharp fa-solid fa-bus-simple"></i>
                  </div>
                  <a onclick="parent.$('.content-wrapper').IFrame('createTab', 'Job Archive', '/portal/trips/archive.php', 'view-quote', true); return false;" href="/portal/trips/archive.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3><?php print number_format($stats->Pax); ?></h3>

                    <p>Passengers Driven</p>
                  </div>
                  <div class="icon">
                    <i class="fa-sharp fa-solid fa-users"></i>
                  </div>
                  <a onclick="parent.$('.content-wrapper').IFrame('createTab', 'Job Archive', '/portal/trips/archive.php', 'view-quote', true); return false;" href="/portal/trips/archive.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>            
<?php
if ($busID==336662) {
?>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3><?php print number_format($stats->OverdueInvoices); ?></h3>

                    <p>Invoices Past Due</p>
                  </div>
                  <div class="icon">
                    <i class="fa-sharp fa-solid fa-hand-holding-dollar"></i>
                  </div>
                  <a onclick="parent.$('.content-wrapper').IFrame('createTab', 'Invoices', '/portal/account/invoices.php', 'invoices', true); return false;" href="/portal/account/invoices.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>$<?php print number_format($stats->PastDue); ?></h3>
                    <p>in Unpaid Invoices</p>
                  </div>
                  <div class="icon">
                    <i class="fa-solid fa-money-bill-1-wave"></i>
                  </div>
                  <a onclick="parent.$('.content-wrapper').IFrame('createTab', 'Invoices', '/portal/account/invoices.php?x=due', 'invoices-due', true); return false;" href="/portal/account/invoices.php?x=due" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>


<?php

} else {
$overdue = date("Y-m-d", strtotime("30 days ago"));
$invoices = $boss->getObject("Invoice", "BusinessID='$busID' AND Balance>0 AND InvoiceDate<'$overdue'");
if (count($invoices->_ids)) {
?>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3><?php print number_format($stats->Miles); ?></h3>

                    <p>Miles Traveled</p>
                  </div>
                  <div class="icon">
                    <i class="fa-sharp fa-solid fa-road"></i>
                  </div>
                  <a onclick="parent.$('.content-wrapper').IFrame('createTab', 'Job Archive', '/portal/trips/archive.php', 'view-quote', true); return false;" href="/portal/trips/archive.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3><?php print count($invoices->_ids); ?></h3>
                    <p>Invoices Due</p>
                  </div>
                  <div class="icon">
                    <i class="fa-solid fa-money-bill-1-wave"></i>
                  </div>
                  <a onclick="parent.$('.content-wrapper').IFrame('createTab', 'Invoices', '/portal/account/invoices.php?x=due', 'invoices-due', true); return false;" href="/portal/account/invoices.php?x=due" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>


<?php
} else {
?>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3><?php print number_format($stats->Miles); ?></h3>

                    <p>Miles Traveled</p>
                  </div>
                  <div class="icon">
                    <i class="fa-sharp fa-solid fa-road"></i>
                  </div>
                  <a onclick="parent.$('.content-wrapper').IFrame('createTab', 'Job Archive', '/portal/trips/archive.php', 'view-quote', true); return false;" href="/portal/trips/archive.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                  <div class="inner">
                    <h3><?php print number_format($stats->Hours); ?></h3>

                    <p>Total Hours</p>
                  </div>
                  <div class="icon">
                    <i class="fa-solid fa-clock"></i>
                  </div>
                  <a onclick="parent.$('.content-wrapper').IFrame('createTab', 'Job Archive', '/portal/trips/archive.php', 'view-quote', true); return false;" href="/portal/trips/archive.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
<?php
}
}
?>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <h5 class="card-title">Today's Trips</h5>

                <p class="card-text">
<?php 
    $cnt = 0;
    foreach ($todaysJobs->Job as $job) {
    if ($job->JobID) {
        $starttime = date("g:ia", strtotime($job->PickupTime));
        $endtime = date("g:ia", strtotime($job->DropOffTime));
        $cardtype = "info";

        if (!$job->EmployeeID) {
            $cardtype = "danger";
        }
        if ($job->Confirmed!=1) {
            $cardtype = "warning";
        }
?>
<div class="card card-<?php print $cardtype; ?>">
                        <div class="card-header">
                            <h3 class="card-title">Bus <?php print $buses[$job->BusID] . " [" . $pax[$job->BusID] ." Passengers]" ; ?></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0 map-card" style="">
                            <div class="map" id="map<?php print $cnt; ?>"></div>
                            <div class="info-box-content" style="margin-left:1em;margin-top:1em;">
                                <table class='map-form'>
                                    <tr>
                                        <td><label class="info-box-text text-center text-muted">Driver</label></td>
                                        <td colspan='3'><span class="info-box-number text-center text-muted mb-0" id="driver<?php print $cnt; ?>"><?php print $employees[$job->EmployeeID]->FirstName . " " . $employees[$job->EmployeeID]->LastName . " [" . $employees[$job->EmployeeID]->Cell ."]"; ?></span></td>
                                    </tr>
                                    <tr>
                                        <td><label class="info-box-text text-center text-muted">Pickup</label></td>
                                        <td colspan='3'><span class="info-box-number text-center text-muted mb-0" id="pickup<?php print $cnt; ?>"><?php print preg_replace("/,/", ",<br>", preg_replace("/\(?\d\d\d\)?\s*\d\d\d\D\d\d\d\d/", '', $job->PickupLocation)) . ' - ' . $job->PickupTime; ?></span></td>
                                    </tr>
                                    <tr>
                                        <td><label class="info-box-text text-center text-muted">Drop Off</label></td>
                                        <td colspan='3'><span class="info-box-number text-center text-muted mb-0" id="destination<?php print $cnt; ?>"><?php print $job->DropOffLocation . " - " . $job->DropOffTime; ?></span></td>
                                    </tr>
                                    <tr>
                                        <td><label class="info-box-text text-center text-muted">Duration</label></td>
                                        <td style='width:5rem'><span class="info-box-number text-center text-muted mb-0" id="duration<?php print $cnt; ?>"></span></td>
                                        <td><label class="info-box-text text-center text-muted">Pickup Time</label></td>
                                        <td><span class="info-box-number text-center text-muted mb-0" id="PickupTime<?php print $cnt; ?>"><?php print $starttime; ?></span></td>
                                    </tr>
                                    <tr>
                                        <td><label class="info-box-text text-center text-muted">Distance</label></td>
                                        <td><span class="info-box-number text-center text-muted mb-0" id="distance<?php print $cnt; ?>"></span></td>
                                        <td><label class="info-box-text text-center text-muted">DropOff Time</label></td>
                                        <td><span class="info-box-number text-center text-muted mb-0" id="DropOffTime<?php print $cnt; ?>"><?php print $endtime; ?></span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class='overlay' id="overlay<?php print $cnt; ?>" style="display:none">
                                <div class="loader"></div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
<?php
    $cnt++;
    }
} ?>
                </p>
                <a onclick="parent.$('.content-wrapper').IFrame('createTab', 'Quote {{RequestID}}', '/portal/trips/view-trip.php?id=<?php print $job->JobID; ?>', 'view-quote', true); return false;" href="/portal/trips/view-trip.php?id=<?php print $job->JobID; ?>" class="card-link">Trip details</a>
              </div>
            </div><!-- /.card -->
          </div>
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Upcoming Trips for <?php print $business->Business; ?></h5>

                <p class="card-text">
               <?php
                    $now = date("Y-m-d");

                    if ($busID == 332) {
                        $results = $boss->getObject("Job", "JobDate>='$now' AND JobCancelled=0 AND ParentID=0 ORDER BY JobDate ASC LIMIT 10");
                    } else {
                        $results = $boss->getObject("Job", "JobDate>='$now' and BusinessID='$busID' AND JobCancelled!=1 AND ParentID=0 ORDER BY JobDate ASC LIMIT 10");
                    }
                    
                    if ($results->Job) {
                        foreach ($results->Job as $job) {
                           
                            if ($job->JobID) {
                                $place = $job->DropOffLocation;
                                if (preg_match("/\((.+?)\)/", $job->Job, $matches)) {
                                    $place = $matches[1];
                                }
                                $day = date("M j, Y", strtotime($job->JobDate));
                                print "<div><a style='color:#000;' href='/portal/trips/view-trip.php?id={$job->JobID}' onclick='parent.app.loadTab(\"/portal/trips/view-trip.php?id={$job->JobID}\", \"{$job->Job}\", \"job{$job->JobID}\", true); return false'>{$day}: <blockquote>".$job->PickupLocation."<br>".$place."<br>".$job->NumberOfItems." Passengers</blockquote></a></div>";
                            }
                        }
                    } else {
                        print "<div>No upcoming trips</div>";
                    }
               ?>

                </p>

                <a href="/portal/trips/" class="card-link">View more...</a>
              </div>
            </div>
            <!--div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Featured</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Special title treatment</h6>

                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div-->
        </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="assets/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>
    <script src="/portal/route.js"></script>
    <script>
(function() {
    
    if (!app.maps) {
        app.maps = [];
    } 
    if (!app.markers) {
        app.markers = [];
    }
    if (!buses) {
        buses = <?php print json_encode($buses); ?>;
    }
    app.jobs = <?php print json_encode($todaysJobs->Job); ?>;
    let keys = Object.keys(app.jobs);
    let tmpmap;
    
    app.where = [];
    fetch("/where/latest.json").then(r=>r.json()).then(data=>{
        console.log("bus positions");
        console.dir(data);
        data.forEach(item=>{
            app.where[item.objectname] = [item.latitude_mdeg/1000000, item.longitude_mdeg/1000000];
        });
        console.dir(app.where);
        updateMaps();
    });

    function updateMaps() {
        let busIcon = L.icon({
            iconUrl: "/portal/assets/bus4sm.png",
            iconSize: [40, 17],
            iconAnchor: [40, 17],
            popupAnchor: [0, 0]
        });
        let keys = Object.keys(app.jobs);
        let tmpmap, tmpmarker;
        keys.forEach((key, idx)=>{
            let job = app.jobs[key];

            if (job.JobID) {
                if (document.querySelector(`#map${idx}`)) {
                    tmpmap = L.map(document.querySelector(`#map${idx}`), {
                        center: [37.8437122, -122.3491274],
                        zoom: 10,
                          zoomControl: false,
                          fadeAnimation: false,
                          zoomAnimation: false
                        });
                    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', { attribution: '' }).addTo(tmpmap);
                    tmpmarker = L.marker(app.where[buses[job.BusID]], {icon: busIcon});
                    app.markers.push(app.where[buses[job.BusID]]);
                    try {
                        tmpmarker.addTo(tmpmap);

                        app.state.maps.push(tmpmap);
                        app.maps.push(tmpmap);
                        app.getRoute(job.PickupLocation, job.DropOffLocation, idx);
                    } catch(err) {
                        console.log("Caught error: " + err);
                        console.dir(err);
                    }
                }
            }
        });
    }
})();
    </script>
</body>
</html>
