<?php  
    include($_SERVER['DOCUMENT_ROOT'] . '/.env');
    include($_SERVER['DOCUMENT_ROOT'] . '/lib/auth.php');

   $in = $_REQUEST;
   $out = array();
   $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>D Harris Tours Customer Portal | Trip Report</title>

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
                      <th style="width: 1%">Year</th>
                      <th>Month</th>
                      <th>Vehicle</th>
                      <th>Trips</th>
                      <th>Miles</th>
                  </tr>
              </thead>
              <tbody>
<?php
$tpl = <<<EOT
<tr id="rowTemplate">
    <td>{{Year}}</td>
    <td>{{Month}}</td>
    <td>{{Vehicle}}</td>
    <td>{{Trips}}</td>
    <td>{{Miles}}</td>
</tr>
EOT;

$now = date("Y-m-d H:i:s");
$sql = " select Vehicle, count(LogBookID) Trips, sum(Distance) Miles, year(StartTime) Year, month(StartTime) Month from LogBook group by year(StartTime), month(StartTime), Vehicle with rollup;";
$results = mysqli_query($link, $sql);

while ($rec = mysqli_fetch_object($results)) {
    $out = preg_replace_callback("/\{\{([^\}]+)\}\}/s", function($matches) {
        global $rec;
        return $rec->{$matches[1]};
    }, $tpl);
    print $out;
}
mysqli_close($link);
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
