<?php
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/.env');
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/lib/auth.php');

    $in = $_REQUEST;
    $out = array();
    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");

    session_start();
    $busID = (array_key_exists('busID', $in)) ? $in['busID'] : $_SESSION['Login']->BusinessID;

    if (array_key_exists("BusinessID", $_SESSION)) {
        $busID = $_SESSION['BusinessID'];
    }
    $business = $boss->getObject("Business", $busID);
    
    if (array_key_exists("x", $_SESSION) && !array_key_exists("x", $in)) {
        $in['x'] = $_SESSION['x'];
    }
    if (array_key_exists("x", $in)) {
        if ($in['x'] == "due") {
            $xtra = " AND Balance>0";
            $heading = "Invoices Due";
            $title = "Invoices Due";
        } else if ($in['x'] == "paid") {
            $xtra = " AND Balance=0";
            $heading = "Paid Invoices";
            $title = "Invoices Paid";
        } else {
            $heading = "All Invoices";
            $title = "Account Billing History";
        }
        $_SESSION['x'] = $in['x'];
    } else {
        $heading = "All Invoices";
        $title = "Account Billing History";
    }

    $pagesize = 25;
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
        table td.tableTitle {
            border-top: 5px solid #06f;
        }
        table tr.secondLine td {
            background-color:#eee;
        }
        .jobname {
            display:inline-block;
            text-overflow:ellipsis;
            overflow:hidden;
        }

        @media (max-width: 600px) {
            .jobname {
                width: 12rem;
            }
        }
        .fa-credit-card {
            box-shadow: 1px 1px 0px #0009;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.umd.min.js"></script>
    <script type="module" src="/portal/node_modules/@github/auto-complete-element/dist/bundle.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
</head>
<body class="hold-transition sidebar-mini iframe-mode">
<?php
    $dueon = date("Y-m-d", strtotime("30 days ago"));
    $sql = "SELECT * from Invoice, Job WHERE Job.JobCancelled=0 AND Job.BusinessID='$busID' AND Invoice.JobID=Job.JobID AND Job.JobDate<'$dueon' AND Balance > 0 ORDER BY InvoiceDate DESC";
    $results = mysqli_query($link, $sql);
    $invcnt = mysqli_num_rows($results);
    $tot = 0;
    while ($row = mysqli_fetch_object($results)) {
       $tot += $row->Balance;
    }   

?>
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
                        <div class="col-sm-6" style="text-align: center;font-size: 1.4rem;background: #c00;text-shadow: 2px 2px 0px #0009;color: #fff;font-weight: bold">
                        <i style="color:#ff0;filter:drop-shadow(2px 2px 0px #000);" class="fa-solid fa-triangle-exclamation"></i>
                        <?php print "$".number_format($tot)." Due for $invcnt Trips"; ?>
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
                    <button onclick="app.makePayment()" class="btn btn-sm btn-success"><i class="fa-solid fa-credit-card"></i> Pay</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Job</th>
                      <th>Date</th>
                      <th style='text-align:right;'>Balance</th>
                      <th style='width: 8rem;'></th>
                    </tr>
                  </thead>
                  <tbody onclick="app.loadInvoice(event)">
<?php
    $sql = "SELECT * FROM Invoice, Job  WHERE Job.JobCancelled=0 AND Job.BusinessID='$busID' AND Invoice.JobID=Job.JobID and Invoice.Balance>0 $xtra ORDER BY InvoiceDate DESC LIMIT ".($curpage * 50).", 50 ;";
    $results = mysqli_query($link, $sql);
    $tot = 0;
    $invids = array();
   while ( $row = mysqli_fetch_object($results)) {
        if ($row->PaidAmt == $row->InvoiceAmt) {
            $paid = "<span class='badge bg-success'>PAID</span>";
        } else {
            $paid = "<span class='badge bg-danger'>DUE</span>";
        }
        $invids[] = $row->InvoiceID;
        $url = "/files/templates/print/InvoiceReport.php?z=".base64_encode("ID=".$row->InvoiceID);
        print "<tr data-id='{$row->InvoiceID}'><td>{$row->InvoiceID}</td><td style=\"white-space: nowrap;\"><span class='jobname' style=''>{$row->Job}</span></td><td>".date("M j", strtotime($row->InvoiceDate))."</td><td style='text-align:right;'>\$".number_format(round($row->Balance))."</td><td style='text-align:center;'><button style='text-shadow: 1px 1px 0px #000;' onclick=\"return app.makePayment([{$row->InvoiceID}], event)\" class='btn btn-sm btn-success'><i class='fa-solid fa-credit-card'></i> Test Pay Now</button></tr>";
        // print "<td style='width:4rem'><a target='_blank' onclick=\"parent.$('.content-wrapper').IFrame('createTab', 'Invoice {$row->InvoiceID}', '$url', 'invoice_{$row->InvoiceID}', true); return false;\" ";
        // print "href='{$url}'><i class='fa-solid fa-eye'></i></a></td></tr>";
//        print "<tr><td colspan='4'>{$row->Job}</td></tr>";
        $tot += $row->Balance;
    }
    print "<tr><td></td><td><button onclick=\"app.makePayment()\" class=\"btn btn-sm btn-success\"><i class=\"fa-solid fa-credit-card\"></i> Test Pay All </button></td><td style='font-size:1.2em;font-weight:bold;text-align:right;'>TOTAL DUE</td><td style='text-align:right;font-size:1.2em;'>\$".number_format($tot)."</td></tr>";
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
    (function() {
        app = {
            data: {
                invoices: [ <?php print join(", ", $invids); ?> ]
            },
            makePayment: function(ids, e) {
                if (e) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                let query = app.data.invoices.join(",");
                if (ids && ids.length) {
                    query = ids.join(",");
                }
                let url = "/portal/payments/pay.php?busID=<?php print $busID; ?>&invoices=" + query;
                window.open(url, "_blank");
                return false;
            },
            loadInvoice: function(e) {
                console.dir(e);
                let el = e.target;
console.log(`target: ${e.target.localName} ${e.target}`);
                while (el.nodeName !== "TR") {
                    el = el.parentElement;
                }
                let id = el.getAttribute("data-id");
                console.dir(el);
                console.log(`id: ${id}`);
                let url = "/files/templates/print/InvoiceReport.php?z=" + btoa("ID=" + id);
                parent.$('.content-wrapper').IFrame('createTab', `Invoice ${id}`, `${url}`, `invoice_${id}`, true);
                return false;
            }
        }

        window.app = app;
    })();
    </script>
</body>

</html>
