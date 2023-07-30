<?php  
    if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php"); 
    $in = $_REQUEST;
    if (array_key_exists("id", $in)) {
        $current = $boss->getObject("Job", $in['id']);
        $business = $boss->getObject("Business", $current->BusinessID);
        $current->ContactName = ($current->ContactName) ? $current->ContactName : $business->AttnTo;
        $current->ContactPhone = ($current->ContactPhone) ? $current->ContactPhone : $business->Phone;
        $current->ContactEmail = ($current->ContactEmail) ? $current->ContactEmail : $business->Email;
    }
    
    $busID = (array_key_exists('busID', $in)) ? $in['busID'] : $_SESSION['Login']->BusinessID;
    $now = date("Y-m-d H:i:s");
    $shortnow = date("Y-m-d");
    $yr = date("Y");
     
    if (array_key_exists("BusinessID", $_SESSION)) {
        $busID = $_SESSION['BusinessID'];
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trip Details</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/portal/assets/fontawesome-free-6.4.0-web/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/portal/assets/css/adminlte.min.css">
    <link rel="icon" href="/files/favicon.png">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
<link rel="stylesheet" href="/lib/css/bus-loader.css"/>
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
 <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.js"></script>
<style>
	footer {
		display:none;
	}
	.wrapper {
		display: flex;
		flex-direction: column;
	}
	.content-wrapper {
		min-height: 100%;
		flex:1;
		display:flex;
		flex-direction: column;
		justify-content: flex-start;
	    margin-left:0px;
        margin-top: 0px;
    }
    #map, .map {
        height: 200px;
        width: 300px;
    }
    label {
        width: 8rem;
    }
    label.info-box-text {
        display: inline-block;
        width: 6rem;
    }
    .form-control {
        width: 38vw;
    }
    .form-group {
        display: flex;
        flex-direction: row;
    }
    .time {
        width: 6rem;
    }
    .overlay {
        position: absolute;
        top:0px;
        left:0px;
        width: 300px;
        height: 200px;
        display: flex;
        background-color: #0003;
        z-index: 9999;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }
    .checks label {
        width: 4rem;
    }
    .checks {
        width: 10rem;
        text-align: center;
    }
    input[type="checkbox"] {
        width: 10rem;
    }
    .map-form td {
        vertical-align: top;
    }
    @media only screen and (max-width:450px) {
        input[type="checkbox"] {
            width: 6rem;
        }
        .form-control {
            width: 100%;
        }
    }
</style>
</head>

<body class="hold-transition sidebar-collapse">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Trip Details [<?php print $current->JobID; ?>]</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Trip Details</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">General</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="input_location">Trip Date</label>
                                    <input type="text" id="input_Date" class="form-control" value="<?php print $current->JobDate; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="input_company">Pickup Time</label>
                                    <input type="time" id="input_PickupTime" class="form-control time" value="<?php print $current->PickupTime; ?>">
                                    <label for="input_company">Return Time</label>
                                    <input type="time" id="input_DropOffTime" class="form-control time" value="<?php print $current->DropOffTime; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="input_location"># Passengers</label>
                                    <input type="text" id="input_NumberOfItems" class="form-control" value="<?php print $current->NumberOfItems; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="input_title">Origin</label>
                                    <input type="text" id="input_PickupLocation" class="form-control" value="<?php print $current->PickupLocation; ?>">
                                </div>
<?php
    $stops = preg_split("/\|/", $current->DropOffLocation);
    foreach ($stops as $idx=>$stop) {
?>
                                <div class="form-group">
                                    <label for="input_title">Stop #<?php print $idx + 1; ?></label>
                                    <input type="text" id="input_Stop<?php print $idx + 1; ?>" class="form-control" value="<?php print $stop; ?>">
                                </div>

<?php
    }
?>
                                <div class="form-group">
                                    <label for="input_title">Final Dropoff</label>
                                    <input type="text" id="input_FinalDropOffLocation" class="form-control" value="<?php print $current->FinalDropOffLocation; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Options</label>
                                    <div class="checks">
                                        <input type="checkbox" id="input_location" class="form-control" value="1"<?php print ($current->Wheelchair) ? " checked" : "";?>>
                                        <label for="input_location">ADA</label>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" id="input_location" class="form-control" value="1"<?php print ($current->SPAB) ? " checked" : "";?>>
                                        <label for="input_location">SPAB</label>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" id="input_location" class="form-control" value="1"<?php print ($current->Cargo) ? " checked" : "";?>>
                                        <label for="input_location">Cargo</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input_contact">Contact</label>
                                    <input type="text" id="input_Name" class="form-control" value="<?php print $current->ContactName; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="input_contact">Phone</label>
                                    <input type="text" id="input_Name" class="form-control" value="<?php print $current->ContactPhone; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="input_contact">Email</label>
                                    <input type="text" id="input_Name" class="form-control" value="<?php print $current->ContactEmail; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="input_status">Status</label>
                                    <select id="input_status" class="form-control custom-select">
                                        <?php 
                                            $confirmed = (strtotime($current->JobDate) < time()) ? " SELECTED" : "";
                                            $completed = (strtotime($current->JobDate) > time()) ? " SELECTED" : "";
                                        ?>
                                        <option>Unknown</option>
                                        <option>Quote Requested</option>
                                        <option>Waiting for Confirmation</option>
                                        <option<?php print $confirmed; ?>>Confirmed</option>
                                        <option<?php print $completed; ?>>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Notes</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="input_Notes">Notes</label>
                                    <textarea id="input_Notes" class="form-control" rows="4"><?php print $current->Notes; ?></textarea>
                                </div>
                                <div class="form-group">
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
<?php
    $todaysJobs = $boss->getObject("Job", "BusinessID='{$busID}' and (JobID='{$in['id']}' OR ParentID='{$in['id']}') and JobCancelled=0");
    
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
<?php 
    $cnt = 0;
    foreach ($todaysJobs->Job as $job) {
    if ($job->JobID) {
        $starttime = date("g:ia", strtotime($job->PickupTime));
        $endtime = date("g:ia", strtotime($job->DropOffTime));

?>
<div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Bus <?php print $buses[$job->BusID] . " [" . $pax[$job->BusID] ." Passengers]" ; ?></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0 map-card">
                            <div class="map" id="map<?php print $cnt; ?>"></div>
                            <div class="info-box-content" style="margin-left:1em;margin-top:1em;">
                                <table class='map-form'>
                                    <tr>
                                        <td><label class="info-box-text text-center text-muted">Driver</label></td>
                                        <td colspan='3'><span class="info-box-number text-center text-muted mb-0" id="driver<?php print $cnt; ?>"><?php print $employees[$job->EmployeeID]->FirstName . " " . $employees[$job->EmployeeID]->LastName . " - " . $employees[$job->EmployeeID]->Cell; ?></span></td>
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

                        <!--div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Map</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0 map-card">
                                <div class="map" id="map"></div>
                                <div class="info-box-content" style="margin-left:1em;margin-top:1em;">
                                    <table class='map-form'>
                                        <tr>
                                            <td><label class="info-box-text text-center text-muted">Pickup</label></td>
                                            <td><span class="info-box-number text-center text-muted mb-0" id="pickup"><?php print preg_replace("/,/", ",<br>", preg_replace("/\(?\d\d\d\)?\s*\d\d\d\D\d\d\d\d/", '', $current->PickupLocation)); ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><label class="info-box-text text-center text-muted">Drop Off</label></td>
                                            <td><span class="info-box-number text-center text-muted mb-0" id="destination"><?php print $current->DropOffLocation; ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><label class="info-box-text text-center text-muted">Duration</label></td>
                                            <td><span class="info-box-number text-center text-muted mb-0" id="duration"></span></td>
                                        </tr>
                                        <tr>
                                            <td><label class="info-box-text text-center text-muted">Distance</label></td>
                                            <td><span class="info-box-number text-center text-muted mb-0" id="distance"></span></td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="overlay" style="display:none">
                                    <div class="loader"></div>
                                </div>
                            </div>
                        </div>
                    </div-->
                </div>
                <div class="row">
                    <div class="col-12">
                        <!--button onclick="app.confirmJob(<?php print $in['id']; ?>)" type="button" class="btn btn-block btn-primary btn-lg">Confirm Trip</button-->
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../assets/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <!--script src="../assets/js/adminlte.min.js"></script-->
    <script src="/portal/route.js"></script>
    <script>
(function() {
    if (!app.maps) {
        app.maps = [];
    } 

    app.jobs = <?php print json_encode($todaysJobs->Job); ?>;
    let keys = Object.keys(app.jobs);
    let tmpmap;

    keys.forEach((key, idx)=>{
        let job = app.jobs[key];

        if (job.JobID) {
            tmpmap = L.map(document.querySelector(`#map${idx}`), {
                center: [37.8437122, -122.3491274],
                zoom: 10,
                  zoomControl: false,
                  fadeAnimation: false,
                  zoomAnimation: false
                });
            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '<b></b>'
}).addTo(tmpmap);
            app.maps.push(tmpmap);
            
            app.getRoute(job.PickupLocation, job.DropOffLocation, idx);
        }
    });


})();
    </script>
</body>

</html>
