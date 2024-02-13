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
                <div class="card-tools">
                  <ul class="pagination pagination-sm float-right">
<?php
    $curpage = (array_key_exists('page', $in)) ? $in['page'] : 0;
    $sql = "SELECT * FROM Invoice, Job  WHERE Job.JobCancelled=0 AND Job.BusinessID='$busID' AND Invoice.JobID=Job.JobID AND Job.BusinessID!=0 AND Job.JobDate<now() $xtra";
    $results = mysqli_query($link, $sql);

    $invoices = $boss->getObjectRelated("Invoice", "Balance>0 and InvoiceDate<'{$lastmonth}' and InvoiceDate>'{$lastyear}'");
    $rows = count($invoices->Invoice["_ids"]);

    if ($rows > $perpage) {
        print '<li class="page-item"><a class="page-link" href="?page=0">«</a></li>';
        $pages = ceil($rows / $perpage);
        $pages = ($pages > 5) ? 5 : $pages;
        $start = $curpage - 2;
        if ($start < 0) {
            $start = 0;
        }
        for ($i=$curpage; $i<$pages; $i++) {
            $active = ($curpage == $i) ? " style='background:#ff0;' " :"";
            print '<li class="page-item"><a class="page-link" '.$active.'href="?page='.$i.'">'.($i+1).'</a></li>';
        }
        print '<li class="page-item"><a class="page-link" href="?page='.ceil($rows / $perpage).'">»</a></li>';
    }
?>
                  </ul>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Job</th>
                      <th>Date</th>
                      <th>Balance</th>
                      <th>Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
<?php
    $lastmonth = date("Y-m-d", strtotime("30 days ago"));
    $lastyear = date("Y-m-d", strtotime("January 1"));
    $cond = "Balance>0 and InvoiceDate<'{$lastmonth}' and InvoiceDate>'{$lastyear}' ORDER BY InvoiceDate ASC"; // LIMIT ".($curpage * $perpage) .", {$perpage}";
    $invoices = $boss->getObjectRelated("Invoice", "Balance>0 and InvoiceDate<'{$lastmonth}' and InvoiceDate>'{$lastyear}' ORDER BY InvoiceDate ASC"); // LIMIT ".($curpage * $perpage) .", {$perpage};");
    //$sql = "SELECT * FROM Invoice, Job  WHERE Job.JobCancelled=0 AND Job.BusinessID='$busID' AND Invoice.JobID=Job.JobID AND Job.JobDate<now() $xtra ORDER BY InvoiceDate DESC LIMIT ".($curpage * 10).", 10 ;";
    //$results = mysqli_query($link, $sql);
    $count = count($invoices->Invoice["_ids"]);
    $perpage = ($count < $perpage) ? $count : $perpage;

for ($i=0; $i<$perpage; $i++) {
//   if ( $row = mysqli_fetch_object($results)) {
    $row = $invoices->Invoice[$i];
        if ($row->PaidAmt == $row->InvoiceAmt) {
            $paid = "<span class='badge bg-success'>PAID</span>";
        } else {
            $paid = "<span class='badge bg-danger'>DUE</span>";
        }
        $url = "/files/templates/print/InvoiceReport.php?z=".base64_encode("ID=".$row->InvoiceID);
        print "<tr><td>{$i}</td><td>{$row->related_Job[0]->Job}</td><td>".date("m/d/Y", strtotime($row->InvoiceDate))."</td><td>\${$row->Balance}</td><td>$paid</td>";
        print "<td><a target='_blank' onclick=\"parent.$('.content-wrapper').IFrame('createTab', 'Invoice {$row->InvoiceID}', '$url', 'invoice_{$row->InvoiceID}', true); return false;\"";
        print "href='{$url}'><i class='fa-solid fa-eye'></i></a></td></tr>\n";
//        print "<tr><td colspan='4'>{$row->Job}</td></tr>";
//    }
}
?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

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
    </script>
</body>

</html>
