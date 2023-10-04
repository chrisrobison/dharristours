<?php
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/.env');
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/lib/auth.php');

    $in = $_REQUEST;
    $out = array();
    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");
    $perpage = 100;

    session_start();
    $busID = (array_key_exists('busID', $in)) ? $in['busID'] : $_SESSION['Login']->BusinessID;

    if (array_key_exists("BusinessID", $_SESSION)) {
        $busID = $_SESSION['BusinessID'];
    }
    $business = $boss->getObject("Business", $busID);
    
    $lastmonth = date("Y-m-d", strtotime("31 days ago"));
    $lastyear = date("Y-m-d", strtotime("365 days ago"));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>D Harris Tours | <?php print $heading; ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="/portal/assets/fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="stylesheet" href="/portal/assets/css/adminlte.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
    <link rel="stylesheet" href="/lib/css/bus-loader.css"/>
    <link rel="stylesheet" href="/portal/assets/animate.min.css"/>
    <style>
        th, td { color: #222; }
        .pagination li.page-item a.page-link {
            color: #00c;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.umd.min.js"></script>
    <script type="module" src="/portal/node_modules/@github/auto-complete-element/dist/bundle.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
</head>
<body class="hold-transition sidebar-mini iframe-mode">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><?php print $title; ?> for <?php print $business->Business; ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Account</a></li>
                                <li class="breadcrumb-item active">Invoices</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <form>
                <div class="row">
                    <div class="col-md-12">
                       <div class="card card-primary">
                          <div class="card-header">
                            <h3 class="card-title"><?php print $heading; ?></h3>
                            <div class="card-tools"></div>
                          </div>
                          <div class="card-body">
                              <table class="table" id="overdue">
                                <thead><tr><th>Company</th><th>Amount Due</th><th></th></tr></thead>
                                <tbody>

<?php

    if ($busID == 332) {
        $sql = "SELECT Business.Business, sum(Balance) as Due FROM Invoice, Job, Business  WHERE Job.BusinessID=Business.BusinessID AND Job.JobCancelled=0 AND Invoice.JobID=Job.JobID AND Job.BusinessID!=0 AND Job.JobDate<'".$lastmonth."' and Job.JobDate>'".$lastyear."' GROUP BY Business.Business WITH ROLLUP HAVING Due>0;";
    } else {
        $sql = "SELECT * FROM Invoice, Job  WHERE Job.JobCancelled=0 AND Job.BusinessID='$busID' AND Invoice.JobID=Job.JobID AND Job.BusinessID!=0 AND Job.JobDate<now() $xtra";
    }
    $results = mysqli_query($link, $sql);
    $overdue = [];
    while ($row = mysqli_fetch_object($results)) {
        $overdue[] = $row;
        $d = round($row->Due);
        $d = preg_replace("/(\d)(?=(\d{3})+$)/", "$1,", $d);
        print "<tr><td>".$row->Business."</td><td style='text-align:right'>$".$d."</td></tr>\n";
    }

?>
                                  </tbody>
                              </table>
                          </div>
                     </div>
                </div>
              <!-- /.card-header -->
              </form>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <strong>Copyright &copy; 2023 <a href="https://www.simpsf.com">Simple Software, Inc.</a>.</strong> All rights reserved.
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
    <script src="/portal/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/portal/assets/fontawesome-free-6.4.0-web/js/all.min.js"></script>
    <script src="/portal/assets/js/adminlte.min.js"></script>
    <script>
    <?php 
        print "let overdue = " . json_encode($overdue).";\n";
    ?>
    function sortTable() {
        let tb = document.querySelector("#overdue tbody");
        let rowcnt = <?php print count($overdue); ?>;
        let x, y;
        switching = true;
        while (switching) {
            switching = false;
            let rows = tb.rows;
            for (i=1; i < (rows.length -1 ); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[0];
                y = rows[i + 1].getElementsByTagName("TD")[0];
                 if (parseInt(x.innerHTML.replace(/\D/g, '')) < parseInt(y.innerHTML.replace(/\D/g, ''))) {
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }
    window.onload = sortTable();
    </script>
</body>

</html>
