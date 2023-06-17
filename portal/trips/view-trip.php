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
    <link rel="stylesheet" href="../assets/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/css/adminlte.min.css">
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
    .form-control {
        width: 38vw;
    }
    .form-group {
        display: flex;
        flex-direction: row;
    }
    .time {
        width: 6em;
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
                                <div class="form-group">
                                    <label for="input_title">Destination</label>
                                    <input type="text" id="input_DropOffLocation" class="form-control" value="<?php print $current->DropOffLocation; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="input_title">Final Dropoff</label>
                                    <input type="text" id="input_FinalDropOffLocation" class="form-control" value="<?php print $current->FinalDropOffLocation; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="input_location">ADA</label>
                                    <input type="checkbox" id="input_location" class="form-control" value="1"<?php print ($current->Wheelchair) ? " checked" : "";?>>
                                    <label for="input_location">SPAB</label>
                                    <input type="checkbox" id="input_location" class="form-control" value="1"<?php print ($current->SPAB) ? " checked" : "";?>>
                                    <label for="input_location">Cargo</label>
                                    <input type="checkbox" id="input_location" class="form-control" value="1"<?php print ($current->Cargo) ? " checked" : "";?>>
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
                                        <option>Unknown</option>
                                        <option>Quote Requested</option>
                                        <option>Waiting for Confirmation</option>
                                        <option>Confirmed</option>
                                        <option>Completed</option>
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
                                <!--div class="form-group">
                                    <label for="actionItems">Action Items</label><button type="button" class="btn btn-tool" data-todo-widget="add" title="Add"><i class="fas fa-plus"></i></button><button type="button" class="btn btn-tool" data-todo-widget="remove" title="Remove"><i class="fas fa-trash"></i></button>
                                    <ul data-widget="todo-list">
                                        <li>Make list</li>
                                    </ul>
                                </div-->
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Map</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0" style="position: relative;display:flex;flex-direction:row;">
                                <div id="map"></div>
<div class="info-box-content" style="margin-left:1em;margin-top:1em;">
                      <label class="info-box-text text-center text-muted">Pickup</label>
                      <span class="info-box-number text-center text-muted mb-0" id="pickup"><?php print $current->Pickup; ?></span><br>
                      <label class="info-box-text text-center text-muted">Drop Off</label>
                      <span class="info-box-number text-center text-muted mb-0" id="destination"><?php print $current->Destination; ?></span><br>
                      <label class="info-box-text text-center text-muted">Duration</label>
                      <span class="info-box-number text-center text-muted mb-0" id="duration"></span><br>
                      <label class="info-box-text text-center text-muted">Distance</label>
                      <span class="info-box-number text-center text-muted mb-0" id="distance"></span>
                    </div>
    <div id="overlay" style="display:none">
        <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
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
    <script src="/tools/quote/route.js"></script>
    <script>
(function() {
    window.app.map = L.map('map', { 
        attributionControl: false,
      zoomControl: false,
      fadeAnimation: false,
      zoomAnimation: false
    }).setView([37.8437122,-122.3491274], 10);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(app.map);

    app.getRoute('<?php print $current->PickupLocation; ?>', '<?php print $current->DropOffLocation; ?>');

})();
    </script>
    <script src="/portal/main.js"></script>
</body>

</html>
