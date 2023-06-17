<?php  if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>D Harris Tours Customer Portal | Trips</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/css/adminlte.min.css">
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
            <h1>Trips</h1>
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
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Trips</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">Job ID</th>
                      <th>Job</th>
                      <th>Trip Date</th>
                      <th>Drop off</th>
                      <th></th>
                  </tr>
              </thead>
              <tbody>
<?php
$tpl = <<<EOT
<tr id="rowTemplate">
    <td>{{JobID}}</td>
    <td>{{Job}}</td>
    <td>{{JobDate}}</td>
    <td>{{DropOffLocation}}</td>
    <td class="project-actions text-right">
        <a class="btn btn-primary btn-sm" onclick="parent.app.loadTab('/portal/trips/view-trip.php?id={{JobID}}', 'Trip {{JobID}}', 'trip_{{JobID}}', true); return false;" href="/portal/trips/view-trip.php?id={{JobID}}"><i class="fas fa-folder"></i> View</a>
    </td>
</tr>
EOT;

$now = date("Y-m-d H:i:s");
$trips = $boss->getObject("Job", "BusinessID={$_SESSION['BusinessID']} and JobDate>'$now' AND JobCancelled=0");
$cnt = count($trips->Job);
for ($i=0; $i<$cnt; $i++) {
    $job = $trips->Job[$i];
    $out = preg_replace_callback("/\{\{([^\}]+)\}\}/s", function($matches) {
        global $job;
        return $job->{$matches[1]};
    }, $tpl);
    print $out;
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
<script src="../assets/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/js/adminlte.min.js"></script>
</body>
</html>
