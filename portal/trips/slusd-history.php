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
  <style>
    th, td.center { text-align: center; }
    td.right { text-align: right; }
    #myChart {
        width: 100vw;
        height: auto;
    }
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
            <h1>SLUSD Trips &amp; Mileage Report</h1>
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
    <div>
      <canvas id="myChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
          <table class="table table-striped projects" style="max-width:40em;margin:0 auto;border:2px solid #3335;">
              <thead>
                  <tr>
                      <th style="width: 1%">Year</th>
                      <th>Month</th>
                      <th>Trips</th>
                      <th>Time</th>
                      <th>Miles</th>
                  </t>
              </thead>
              <tbody>
<?php
$tpl = <<<EOT
<tr id="rowTemplate">
    <td>{{Year}}</td>
    <td>{{Month}}</td>
    <td class="center">{{Trips}}</td>
    <td class="center">{{TotalTime}} hours</td>
    <td class="right">{{TotalMiles}} miles</td>
</tr>
EOT;

$now = date("Y-m-d H:i:s");
$sql = " select year(StartTime) Year, month(StartTime) Month, count(LogBookID) Trips, sum(Distance) TotalMiles,sum(round(((EndTime - StartTime)/60)/60, 1)) TotalTime from LogBook where Departure like '%san leandro%' or Arrival like '%san leandro%' group by year(StartTime), month(StartTime) with rollup";
$results = mysqli_query($link, $sql);
$miles = [];
$trips = [];
$times = [];

while ($rec = mysqli_fetch_object($results)) {
    if ($rec->Month) {
        $miles[] = $rec->TotalMiles;
        $trips[] = $rec->Trips;
        $times[] = $rec->TotalTime;

    }

    $out = preg_replace_callback("/\{\{([^\}]+)\}\}/s", function($matches) {
        global $rec;
        if (($matches[1] == "Month") && ($rec->Month)) {
            $rec->MonthName = date("F", strtotime($rec->Year."-".$rec->Month."-1"));
            return $rec->MonthName;
        } 
        if ($matches[1] == "TotalMiles") {
            return number_format($rec->{$matches[1]}, 1, ".", ",");
        }
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
  <script>
      const ctx = document.getElementById('myChart');
      const labels = ['Jan 2022','Feb 2022','Mar 2022','Apr 2022','May 2022','Jun 2022','Jul 2022','Aug 2022','Sep 2022','Oct 2022','Nov 2022', 'Dec 2022', 'Jan 2023','Feb 2023','Mar 2023','Apr 2023','May 2023','Jun 2023'];
      new Chart(ctx, {
        data: {
          labels: labels,
          datasets: [{
            type: 'bar',
            label: 'Miles',
            data: [<?php print join(",", $miles); ?>],
            borderWidth: 1,
            yAxisID: 'y',
             backgroundColor:"#00f9"

          }, 
          {
            type: "line",
            label: 'Trips',
            data: [<?php print join(",", $trips); ?>],
            borderWidth: 1,
            yAxisID: 'y1',
            borderColor: "#0009",
            backgroundColor:"#0f69",
            fill:true
          },
          {
            type: "line",
            label: 'Time',
            data: [<?php print join(",", $times); ?>],
            borderWidth: 1,
            yAxisID: 'y1',
            backgroundColor:"#ff03",
            borderColor:"#000",
            fill: true
          }
          ]
        },
        options: {
          stacked: false,
          responsive: true,
          scales: {
            y: {
              type: 'linear',
              position: 'left',
              beginAtZero: true
            },
            y1: {
                type: 'linear',
                position: 'right',
                display: true,
                grid: {
                    drawOnChartArea: false
                }
            }
          }
        }
      });
    </script>
     

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
