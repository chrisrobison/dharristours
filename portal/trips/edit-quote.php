<?php  
    if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php"); 
    $in = $_REQUEST;
    if (array_key_exists("id", $in)) {
        $current = $boss->getObject("Request", $in['id']);
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
     <script src="/tools/quote/route.js"></script>
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
		justify-content: center;
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
        width: 50vw;
    }
    .form-group {
        display: flex;
        flex-direction: row;
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
                            <h1>Trip Details</h1>
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
                                    <input type="text" id="input_Date" class="form-control" value="<?php print $current->Date; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="input_location"># Passengers</label>
                                    <input type="text" id="input_Pax" class="form-control" value="<?php print $current->Pax; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="input_title">Pickup Location</label>
                                    <input type="text" id="input_Pickup" class="form-control" value="<?php print $current->Pickup; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="input_company">Pickup Time</label>
                                    <input type="time" id="input_Start" class="form-control" value="<?php print $current->Start; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="input_title">Destination</label>
                                    <input type="text" id="input_Destination" class="form-control" value="<?php print $current->Destination; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="input_company">Return Time</label>
                                    <input type="time" id="input_End" class="form-control" value="<?php print $current->End; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="input_location">ADA</label>
                                    <input type="checkbox" id="input_location" class="form-control" value="1"<?php print ($current->ADA) ? " checked" : "";?>>
                                </div>
                                <div class="form-group">
                                    <label for="input_contact">Contact</label>
                                    <input type="text" id="input_Name" class="form-control" value="<?php print $current->Name; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="input_status">Status</label>
                                    <select id="input_status" class="form-control custom-select">
                                        <option>Quote Requested</option>
                                        <option>Requires Confirmation</option>
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
    <script src="../assets/js/adminlte.min.js"></script>
    <script>
(function() {
    app.map = L.map('map', { 
        attributionControl: false,
      zoomControl: false,
      fadeAnimation: false,
      zoomAnimation: false
    }).setView([37.8437122,-122.3491274], 10);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(app.map);

    app.getRoute('<?php print $current->Pickup; ?>', '<?php print $current->Destination; ?>');

})();
    </script>
</body>

</html>
