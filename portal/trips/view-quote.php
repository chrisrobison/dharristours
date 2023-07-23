<?php  
    if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php"); 
    $in = $_REQUEST;
    if (array_key_exists("id", $in)) {
        $current = $boss->getObject("Request", $in['id']);
    }

    $busID = (array_key_exists('busID', $in)) ? $in['busID'] : $_SESSION['Login']->BusinessID;

    if (array_key_exists("BusinessID", $_SESSION)) {
        $busID = $_SESSION['BusinessID'];
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Request for Quote</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/portal/assets/fontawesome-free-6.4.0-web/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/portal/assets/css/adminlte.min.css">
    <link rel="icon" href="/files/favicon.png">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>

 <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
     integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
     crossorigin=""></script>
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
    #map {
        height: 300px;
        width: 400px;
    }
    label {
        width: 8em;
    }
    label.info-box-text {
        display: inline-block;
        width: 6em;
    }
    .form-control[readonly] {
        background: #fff;
    }
    .form-group {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }
        li[aria-selected=true] {
            background-color:#ff0;
            color: #000;
        }
        ul.acpopup {
            position: absolute;
            background: #fff;
            z-index: 9999;
            border: 1px outset #aaa;
            padding: 0px;
            height: 13em;
            overflow: scroll;
            box-shadow: 4px 4px 4px #0003;
            top: 2.1rem;
            width: 100%;
        }
    input[type="checkbox"] {
        width: 5rem;
    }
    .checks {
      width: 5rem;
      text-align: center;
   }
   legend {
    border-bottom: 1px solid #aaa;
   }

        ul.acpopup li {
            list-style-type: none;
            padding: 0px 1em;
            line-height: 2;
            cursor: pointer;
        }
        ul.acpopup li:hover {
            background-color: #ff0;
            cursor: pointer;
        }
.content-wrapper.iframe-mode .navbar-nav .nav-item {
    position: relative;
    background: #ccc;
    transform: translate(0px, 0.6em);
    border-right: 1px solid #444;
    border-left: 1px solid #fff;
    border-top-right-radius: 0.3vw;
    border-top-left-radius: 0.3vw;
}


.waypointMetrics {
    text-align: right;
    display: inline-block;
    width: 50%;
    position: relative;
    left: 50%;
    border-left: 2px solid #0006;
}
        .content-wrapper.iframe-mode .navbar-nav li.nav-item.active {
            transform: translate(0px, 0px);
            background: #f4f6f9;
        }
    #map, .map {
        height: 23rem;
        width: 26rem;
        display:inline-block;
    }
    .map-form td {
        vertical-align: top;
    }
    .map-card {
        position: relative;
        display:flex;
        flex-direction:column;
    }
    legend {
      font-size: 16px;
      font-weight: 700;
      padding-left: 0.5rem;
    }
.showval {
    display: inline-block;
    padding-left: 1rem;
    width: 100%;
}
    .val {
        display: inline-block;
        width: 10rem;
        height: 2rem;
    }
    .form-flex {
            display: flex;
        flex-direction: row;
        align-content: center;
        justify-content: flex-start;
        flex-wrap: wrap;
        border: 1px solid #0002;
        padding: 0.25rem 0.56rem;
    }
    .form-icon {
        text-align:center;
        height:38px;
        width:40px;
        padding-top:4px;
        padding-left:4px;
        background-color:#fff;
        border:none;
    }
    .input-group-icon {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-content: center;
        align-items: center;
    }
    @media only screen and (max-width:450px) {
        .map {
            width: 94vw;
        }
        .map-card {
            flex-direction: column;

        }
    }
    .row {
        margin-left: 0px;
    }
    .form-group {
        margin-left: 0px;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }
    .add-stop {
background-image: url('data:image/svg+xml,<svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="108.5px" height="123.5px"><path fill-rule="evenodd" fill="rgb(0, 0, 0)" d="M34.687,0.007 C54.129,-0.288 65.321,9.780 71.000,23.329 C73.014,28.132 75.128,36.698 73.313,43.648 C70.754,53.450 66.124,61.024 61.749,69.048 C57.741,76.399 54.699,84.193 50.415,91.215 C49.156,93.280 48.527,95.531 47.408,97.680 C45.148,102.021 42.743,106.484 40.469,110.842 C39.647,112.418 37.874,117.322 36.537,118.000 C36.090,116.147 34.808,114.645 33.993,113.151 C31.698,108.943 29.668,104.564 27.517,100.451 C23.478,92.726 19.693,84.949 15.721,77.361 C14.042,74.153 12.973,70.752 11.095,67.663 C8.400,63.229 5.302,57.647 3.231,52.885 C-2.015,40.819 -0.703,25.776 6.006,16.171 C10.581,9.621 17.263,4.568 25.435,1.624 C27.594,1.162 29.753,0.700 31.912,0.238 C32.870,0.025 34.031,0.414 34.687,0.007 ZM34.687,14.785 C33.198,15.698 29.898,15.672 28.211,16.402 C22.389,18.919 18.100,23.605 15.721,29.563 C14.785,31.908 14.147,35.899 14.796,38.799 C15.217,40.683 14.942,42.002 15.490,43.648 C17.759,50.477 22.421,54.797 28.905,57.503 C31.132,58.432 35.222,59.931 38.850,59.119 C47.991,57.074 54.027,53.217 57.354,45.496 C63.257,31.798 53.496,18.987 43.476,15.709 C40.897,14.865 38.004,14.762 34.687,14.785 Z"/><path fill-rule="evenodd" stroke="rgb(0, 0, 0)" stroke-width="9px" stroke-linecap="butt" stroke-linejoin="miter" fill="rgb(255, 255, 255)" d="M37.004,17.589 C48.232,17.589 57.334,26.691 57.334,37.919 C57.334,49.147 48.232,58.249 37.004,58.249 C25.776,58.249 16.674,49.147 16.674,37.919 C16.674,26.691 25.776,17.589 37.004,17.589 Z"/><path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M75.125,64.250 C89.968,64.250 102.000,76.282 102.000,91.125 C102.000,105.968 89.968,118.000 75.125,118.000 C60.282,118.000 48.250,105.968 48.250,91.125 C48.250,76.282 60.282,64.250 75.125,64.250 Z"/><path fill-rule="evenodd" fill="rgb(0, 0, 0)" d="M75.730,118.755 C60.554,118.755 48.207,106.408 48.207,91.232 C48.207,76.056 60.554,63.709 75.730,63.709 C90.908,63.709 103.257,76.056 103.257,91.232 C103.257,106.408 90.908,118.755 75.730,118.755 ZM75.730,66.234 C61.946,66.234 50.732,77.448 50.732,91.232 C50.732,105.016 61.946,116.230 75.730,116.230 C89.516,116.230 100.732,105.016 100.732,91.232 C100.732,77.448 89.516,66.234 75.730,66.234 ZM79.094,106.324 L72.367,106.324 L72.367,94.595 L60.638,94.595 L60.638,87.869 L72.367,87.869 L72.367,76.140 L79.094,76.140 L79.094,87.869 L90.820,87.869 L90.820,94.595 L79.094,94.595 L79.094,106.324 Z"/></svg>');
background-size: contain;
background-position: center;
background-repeat: no-repeat;
    height: 40px;
    width: 44px;
    display:inline-block;
    }
#updateRoutesButton {
}
@keyframes flash {
    0% {
        background-color: #f000;
    }
    50% {
        background-color: #f00f;
    }
    100% {
        background-color: #f000;
    }
}
    .waypoint-icon {
       text-align:center;height:38px;width:40px;padding-top:4px;padding-left:4px;background-color:#fff;border:1px solid #fff0; 
    }
    .waypoint-trash {
        font-size: 1.3rem;width: 2rem;text-align: center;color: #0005;
    }
    .timeline>div>.timeline-item {
        margin-left: 70px;
    }
    .timeline:before {
        left:33px;
    }
    .timeline>div>.fa, .timeline>div>.fab, .timeline>div>.fad, .timeline>div>.fal, .timeline>div>.far, .timeline>div>.fas, .timeline>div>.ion, .timeline>div>.svg-inline--fa {
        width: 20px;
        height: 20px;
    }
    .timeline>div>.timeline-item>.timeline-header {
        min-height: 2.4rem;
    }
    .waypoint-input {
        width: 79%;
    }
    input[type="checkbox"] {
        width: 8rem;
    }
    .info-box .info-box-number {
        font-size: 1.7em;
        text-align: center;
        font-weight: 500;
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
                            <h1>Trip Request [<?php print $current->RequestID; ?>]</h1>
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
            <form>
                <div class="row">
                    )<div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Trip Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="info-box">
                                          <span class="info-box-icon bg-info"><i class="far fa-calendar"></i></span>

                                          <div class="info-box-content">
                                            <span class="info-box-text">Trip Date</span>
                                            <span class="info-box-number"><?php print date("M j, Y", strtotime($current->Date)); ?></span>
                                          </div>
                                          <!-- /.info-box-content -->
                                        </div>

                                    </div>
                                    <div class="col-sm-4">
                                        <div class="info-box">
                                          <span class="info-box-icon bg-warning"><i class="fa-solid fa-users"></i></span>

                                          <div class="info-box-content">
                                            <span class="info-box-text">Passengers</span>
                                            <span class="info-box-number"><?php print $current->Pax; ?></span>
                                          </div>
                                          <!-- /.info-box-content -->
                                        </div>

                                    </div>
                                     <div class="col-sm-4">
                                       <div class="checks">
                                           <label for="input_RoundTrip">Round Trip</label>
                                           <input type="checkbox" id="input_RoundTrip" onchange="app.roundTrip(event)" class="form-control" value="1" <?php print ($current->RoundTrip)? "checked" : "" ?> disabled>
                                       </div>
                                    </div>
                                </div>
                                <div class="form-group input-group">

                                    <label for="jobLocation">Pickup</label>
                                    <div class="input-group-prepend">
                                        <div class="input-group-icon form-icon">
                                            <img src="/portal/assets/startingline2.svg" height="32" width="36" style="float: left; margin: 0.25rem;">
                                        </div>
                                    </div>
                                    <input type="text" name="Pickup" id="Pickup" class="form-control form-control-border" value="<?php print $current->Pickup; ?>" readonly>
                                </div>
                                <!--===================================================-->
                                <!-- >>>>> Dynamic waypoint inputs are added here <<<<<< -->
                                <!--===================================================-->
                                <div id="waypoints">
<?php
if ($current->Destination) {
    $dests = preg_split("/\|/", $current->Destination);

    foreach ($dests as $idx=>$dest) {
        $num = $idx + 1;
        print <<<EOT
                               <div class="form-group">
                                    <label for="jobLocation">Stop #$num</label>
                                    <div class="input-group-prepend"><div class="input-group-icon waypoint-icon"><img src="/portal/assets/mappin.svg"></div></div>
                                    <input type="text" name="Waypoint$num" id="Waypoint$num" class="form-control form-control-border waypoint-input" value="$dest" readonly >
                               </div>
EOT;
    }
}
?>
                               </div>
                               <div class="form-group">
                                    <label for="jobLocation">Final Dropoff</label>
                                    <div class="input-group-prepend">
                                        <div class="input-group-icon form-icon">
                                            <img src="/portal/assets/finishflag.svg" style="float: left; margin: 0.25rem;">
                                        </div>
                                    </div>
                                    <input type="text" name="FinalDropOff" id="FinalDropOff" class="form-control form-control-border waypoint-input" value="<?php print $current->Return; ?>" readonly >
                               </div>
                               <div class="row">
                                   <div class="col-sm-3">
                                       <div class="form-group">
                                           <label for="jobLocation">Pick-up Time</label>
                                           <input type="time" id="Start" name="Request[Start]" class="form-control form-control-border" style="width:8.5rem;" value="<?php print $current->Start; ?>" readonly >
                                       </div>
                                   </div>
                                   <div class="col-sm-3">
                                       <div class="form-group">
                                           <label for="jobLocation">Return Time</label>
                                           <input type="time" id="End" name="Request[End]" class="form-control form-control-border" style="width:8.5rem;" value="<?php print $current->End; ?>" readonly >
                                       </div>
                                   </div>
                                   <div class="col-sm-6">
                                       <fieldset style="display:flex;flex-direction:row;align-items:center;justify-content:space-around;width:100%;">
                                           <legend style="text-align:center;font-size:1.4rem;">Options</legend>
                                           <div class="checks">
                                               <input type="checkbox" id="input_ADA" class="form-control" value="1" <?php print (isset($current->ADA)) ? " CHECKED" : ""; ?> disabled>
                                               <label for="input_ADA">ADA</label>
                                           </div>
                                           <div class="checks">
                                               <input type="checkbox" id="input_SPAB" class="form-control" value="1" <?php print (isset($current->SPAB)) ? " CHECKED" : ""; ?> disabled >
                                               <label for="input_SPAB">SPAB</label>
                                           </div>
                                           <div class="checks">
                                               <input type="checkbox" id="input_Cargo" class="form-control" value="1" <?php print (isset($current->Cargo)) ? " CHECKED" : ""; ?> disabled >
                                               <label for="input_Cargo">Cargo</label>
                                           </div>
                                       </fieldset>

                                   </div>
                               </div>
                                <!-- /.row -->
                                <div class="form-group">
                                    <label for="inputDescription">Notes</label>
                                    <textarea id="Notes" name="Request[Notes]" class="form-control" rows="4" ></textarea>
                                </div>
                <div class="row">
                    <div class="col-12">
                        <?php
                            if ($current->quoteSent && !$current->ClientConfirmed) {
                                print '<button onclick="app.confirmJob()" type="button" class="btn btn-block btn-primary btn-lg">Confirm Trip</button>';
                            } else if (!$current->quoteSent && !$current->ClientConfirmed) {
                                print <<<EOT
<div class="alert alert-info alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h5><i class="icon fas fa-info"></i>Quote not yet available</h5>
  We're sorry, but we have not had a chance respond to your bus reservation request yet.<br>Please be assured that your trip is our top priority and we will be sending a quote for your trip shortly. <br><br> Thank you for choosing D Harris Tours!
</div>
EOT;
                            } else {
                                print "<h2>Waiting for job confirmation from D Harris Tours</h2>";
                            }

                        ?>
                    </div>
                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <a name="map"></a>
                    <div class="col-md-3">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Map</h3>

                                <div class="card-tools">
                                </div>
                            </div>
                            <div class="card-body p-0 map-card">
                                <div class="row">
                                    <div class="map" id="map0"></div>
                                    <div id="overlay0" class="overlay"></div>
                                </div>
                                <div class="timeline">
                                    <div class="time-label">
                                        <span class="bg-secondary showval" id="showDate">Route</span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fa-solid fa-flag bg-green"></i>
                                        <div class="timeline-item">
                                            <div style="display:inline-block;" class="time"><i class="fas fa-clock"></i> <span class="" id="pickup0Time"></span></div>
                                            <h3 class="timeline-header" id="pickup0"></h3>

                                            <div class="timeline-body" style="display:none;"> </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
<?php
   if ($current->Destination) {
    $dests = preg_split("/\|/", $current->Destination);

    foreach ($dests as $idx=>$dest) {
        $num = $idx + 1;
        print <<<EOT
<div class="waypoint">
    <i class="fas fa-location-dot bg-blue"></i>
    <div class="timeline-item">
        <span class="time"><i class="fas fa-clock"></i> <span id="wp-segment{$num}"></span></span>
        <h3 class="timeline-header no-border" id="Waypoint{$num}">{$dest}</h3>
    </div>
</div>
EOT;
    }
}
?>
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-flag-checkered bg-black"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i> <span id="WaypointFinalTime"></span></span>
                                            <h3 class="timeline-header no-border" id="destination0"></h3>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                </div>
                                 <div class="form-flex">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="jobTitle">Total Distance</label>
                                            <span class='val' id="distance0"></span>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="duration0">Total Duration</label>
                                            <span class='val' id='duration0'></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </section>
        </div>

    </div>
    <script src="/portal/assets/jquery/jquery.min.js"></script>
    <script src="/portal/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/portal/assets/fontawesome-free-6.4.0-web/js/all.min.js"></script>
    <script src="/portal/assets/js/adminlte.min.js"></script>
    <script src="/portal/route.js"></script>
    <script>
(function() {
    let current = <?php print json_encode($current);?>;

    window.app.map = map = L.map('map0', { 
        attributionControl: false,
      zoomControl: false,
      fadeAnimation: false,
      zoomAnimation: false
    }).setView([37.8437122,-122.3491274], 10);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(app.map);

    app.getRoute('<?php print $current->Pickup; ?>', '<?php print $current->Return; ?>');
    if (!app.maps) {
        app.maps = [];
    }
    app.maps.push(map);
    app.data.record = <?php print json_encode($current); ?>;
    app.getRouteMulti();
})();
    </script>
</body>

</html>
