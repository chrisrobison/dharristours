<?php  
   include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/.env');
   include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/lib/auth.php');

    $busID = (array_key_exists('busID', $in)) ? $in['busID'] : $_SESSION['Login']->BusinessID;
    $now = date("Y-m-d H:i:s");
    $shortnow = date("Y-m-d");
    $yr = date("Y");

    if (array_key_exists("BusinessID", $_SESSION)) {
        $busID = $_SESSION['BusinessID'];
    }
    $business = $boss->getObject("Business", $busID);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>D Harris Tours Customer Portal | Trips</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/portal/assets/fontawesome-free-6.4.0-web/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/portal/assets/css/adminlte.min.css">
  <style>
    table.table td { vertical-align: top; }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left:0;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Trip Archive for <?php print $business->Business; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Trips</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Trips</h3>

          <div class="card-tools">
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th></th>
                      <th>#</th>
                      <th>Trip Date</th>
                      <th>Pax</th>
                      <th>Buses</th>
                      <th></th>
                  </tr>
              </thead>
              <tbody>
<?php

$tpl = <<<EOT
<tr>
    <td colspan="6" style="border-top:4px solid #0077ff;padding-left:0.25rem;">{{Job}}</td>
</tr>
<tr id="rowTemplate">
    <td style="width:20%"></td>
    <td>{{JobID}}</td>
    <td style="white-space:nowrap;">{{JobDate}}</td>
    <td>{{NumberOfItems}}</td>
    <td>{{BusCount}}</td>
    <td class="project-actions text-right">
        <a class="btn btn-primary btn-sm" onclick="parent.app.loadTab('/portal/trips/view-trip.php?id={{JobID}}','Trip {{JobID}}', 'trip_{{JobID}}', true); return false;" href="view-trip.php?id={{JobID}}"><i class="fas fa-up-right-from-square"></i></a>
    </td>
</tr>
EOT;

$now = date("Y-m-d H:i:s");
$trips = $boss->getObject("Job", "BusinessID={$_SESSION['BusinessID']} and JobDate<'$now' AND JobCancelled=0 AND ParentID=0 ORDER BY JobDate DESC LIMIT 100");

$cnt = count($trips->Job);
for ($i=0; $i<$cnt; $i++) {
    if ($trips->Job[$i]->JobID) {
        $job = $trips->Job[$i];

        $trips->Job[$i]->BusCount = ceil($job->NumberOfItems / 45);
        $prettyDate = date("M j, Y", strtotime($job->JobDate));
        $out = preg_replace_callback("/\{\{([^\}]+)\}\}/s", function($matches) {
            global $job;
            global $prettyDate;
            if ($matches[1] == "JobDate") {
                return $prettyDate;
            }
            return $job->{$matches[1]};
        }, $tpl);
        print $out;
    }
}
?>
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.3.0
    </div>
    <strong>Copyright &copy; 2023 <a href="https://cdr2.com">Simple Software, Inc.</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/portal/assets/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/portal/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/portal/assets/js/adminlte.min.js"></script>
</body>
</html>
