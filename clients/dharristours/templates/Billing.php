<?php
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/.env');
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/lib/auth.php');

    $in = $_REQUEST;
    $out = "";
    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");


    session_start();
    
    $perpage = (isset($in['count'])) ? $in['count'] : 50;
    if (isset($_GET['count'])) {
        $_COOKIE['count'] = $_GET['count'];
        $in['count'] = $_GET['count'];
        setcookie("count", "", time() - (86400 * 9999), "/"); // 86400 = 1 day
        setcookie("count", $_GET['count'], time() + (86400 * 9999), "/"); // 86400 = 1 day
        $perpage = $_GET['count'];
    }
    
    if (isset($_COOKIE['count']) && !isset($_GET['count'])) {
        $perpage = $_COOKIE['count'];
    }
    
    if (isset($in) && array_key_exists("busID", $in)) {
       $busID = $in['busID'];
       $_SESSION['BusinessID'] = $busID;
    } else {
        $busID = $_SESSION['Login']->BusinessID;
    }
    
    if (array_key_exists("BusinessID", $_SESSION)) {
        $busID = $_SESSION['BusinessID'];
    }
    $mybusiness = $boss->getObject("Business", $busID);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>D Harris Tours | <?php print $heading; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@300;400;500;700;900&family=Lexend+Deca:wght@300;400;500;700;900&family=Lexend:wght@100;200;300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/portal/assets/fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="stylesheet" href="/portal/assets/css/adminlte.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
    <link rel="stylesheet" href="/lib/css/bus-loader.css"/>
    <link rel="stylesheet" href="/portal/assets/animate.min.css"/>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: "Lexend", sans-serif;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            font-size: 12px;
        }
        .pagination-sm .page-link {
            font-size: 12px;
        }
        th, td { color: #222; }
        .pagination li.page-item a.page-link {
            color: #00c;
        }
        .pagination {
            margin-left: 2rem;
        }
        .Job, .Business {
            display: inline-block;
            width: 17rem;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        #jobview {
            position: fixed;
            height: 0px;
            top: 100vh;
            transition: all 300ms linear;
            background-color: #069;
            display: flex;
            flex-direction: column;
            align-items:flex-end;
            width: 98.4vw;
        }
        button.close {
            width: 2rem;
            float: right;
            color: #fff;
            text-shadow: 1px 1px 0px #000;
            border:0;
        }
        button.close:hover {
            text-shadow: 1px 1px 0px #000;
            color:#fff;
        }
        #jobframe {
            height: 100%;
            width: 99vw;
            
        }
        button {
            border: 1px solid #000;
            background: #ccc;
            border-radius:1rem;
            text-shadow: 1px 1px 0px #fff;
            height: 2rem;
        }
        button:hover {
            background-color:#666;
            color:#fff;
            text-shadow: 1px 1px 0px #000;
        }
        table#jobs {
            border-collapse: collapse;
        }
        .scrollWrap {
            width: 100%;
            height: 77vh;
            overflow-y: scroll;
            overflow-x: auto;
            position: relative;
        }
        #jobs thead {
            position: sticky;
            top: 0px;
            left: 0px;
            box-shadow: 0px 3px 3px #0006;
            z-index: 9999;
        }
        #jobs thead th {
            background: #ddd;
        }
        tbody td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
       .child {
            transform: translateX(1rem);
        }
        .hidden {
            display: none;
        }
        .child td {
        }
        .child {
            background: #0691;
        }
        .toggle {
            display: inline-block;
            transform: rotate(90deg);
            transition: all 200ms linear;
        }
        .toggle.closed {
            transform: rotate(0deg);

        }
        #resize {
            height: 1rem;
            width: 100vw;
            display: block;
            background-color: #ccc;
            cursor: ns-resize;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .balance {
            text-align:right;
        }
        .group {
            transition: all 200ms linear;
            height: 0px;
            overflow: hidden;
        }
        #jobs thead {
        background-color:#ddd;
        }
        thead { translate: 0px -2px; }
        .toolbar { 
            background-color: #223;
            width: 98.6vw;
            display: flex;
            flex-direction:row;
            justify-content:space-between;
            color:#fff;
            font-size: 14px;
        }
        .content-header {
            height: 13vh;
        }
        label {
            display: inline-block;
            width: 7rem;
            text-align: right;
        }
        label.viewing {
            width: 8rem;
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
        <div class="content-wrapper" style="overflow:hidden;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <label for="BusinessID">Business</label>
                            <select style="width:20rem;font-size:12px" id="BusinessID" oninput="app.switchBusiness(this.value)">
<?php
    $businesses = $boss->get("Business", "1=1 ORDER BY Business");
    $allbusiness = array();

    foreach ($businesses as $business) {
        $selected = ($_SESSION['BusinessID'] == $business->BusinessID) ? " SELECTED" : "";
        print "<option data-id='{$business->BusinessID}' value='{$business->BusinessID}'$selected>{$business->Business}</option>";
        $allbusiness[$business->BusinessID] = $business;
    }
?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-8">
                            <label for="InvoiceParentID">Master Invoices </label> <select style="width:20rem;font-size:12px" id="InvoiceParentID" onchange="app.selectInvoiceReport(this.value)">
                            <option> -- Select to View --</option>
<?php
    $reports = $boss->get("InvoiceParent");
    foreach ($reports as $report) {
        print "<option value='".$report->InvoiceParentID."'>".$report->InvoiceParent."</option>";
    }
    $masterlist = json_encode($reports);
?>
</select>
<button onclick="app.viewMasterInvoice(); return false;">View Master</button>
                        </div>
                        <div class="col-sm-4">
                        </div>
                    </div>
               </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content" >
                <form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
              <div class="card-header">
                <button onclick="app.newMasterInvoice(); return false;">New Master Invoice</button>
                <div class="card-tools">
                    <div style="margin-right: 2rem;display:inline-block;">
                        <label for="view">View</label> <select id="view" onchange="app.changeView(this.value)">
                            <option value="all">All</option>
                            <option value="report">Report</option>
                            <option value="assigned">Assigned</option>
                            <option value="unassigned">Unassigned</option>
                            <option value="invoice">Has Invoice</option>
                            <option value="no-invoice">No Invoice</option>
                            <option value="no-invoice">Paid</option>
                            <option value="unpaid">Unpaid</option>
                        </select>
                    </div>
                    <div style="margin-right: 2rem;display:inline-block;">
                    <label for="count">View Count</label>
                    <select id="count" oninput="app.changeCount(this.value)">
                        <option value="10"<?php print ($perpage==10) ? "SELECTED" : ""; ?>>10</option>
                        <option value="25"<?php print ($perpage==25) ? "SELECTED" : ""; ?>>25</option>
                        <option value="50"<?php print ($perpage==50) ? "SELECTED" : ""; ?>>50</option>
                        <option value="100"<?php print ($perpage==100) ? "SELECTED" : ""; ?>>100</option>
                        <option value="250"<?php print ($perpage==250) ? "SELECTED" : ""; ?>>250</option>
                        <option value="1000"<?php print ($perpage==1000) ? "SELECTED" : ""; ?>>1000</option>
                        <option value="all"<?php print ($perpage=="all") ? "SELECTED" : ""; ?>>all</option>
                    </select>
                    </div>

<?php
    $lastmonth = date("Y-m-d", strtotime("30 days ago"));
    $lastquarter = date("Y-m-d", strtotime("3 months ago"));
    $lastyear = date("Y-m-d", strtotime("1 year ago"));
    $now = date("Y-m-d");
    
    $curpage = (array_key_exists('page', $in)) ? $in['page'] : 0;
//    $sql = "SELECT * from Job where BusinessID='$busID' AND JobCancelled=0 AND BusinessID!=0 AND JobDate<now() and JobDate>'$lastyear' $xtra";

    if ($busID == 332) {
        $cond = "JobCancelled=0 and JobDate<'{$now}' and JobDate>'{$lastquarter}' AND NoInvoice=0 AND InvoiceSatisfied=0 AND BusinessID!='$busID' ORDER BY JobDate DESC"; 

    } else {
        $cond = "JobCancelled=0 and JobDate<'{$now}' and JobDate>'{$lastyear}' AND NoInvoice=0 AND InvoiceSatisfied=0 AND BusinessID='$busID' ORDER BY JobDate DESC"; 
    }

    $jobsObj = $boss->getObjectRelated("Job", $cond);
    $jobs = $jobsObj->Job;
/*
$results = mysqli_query($link, $sql);
    $jobs = array();
    while ($row = mysqli_fetch_object($results)) {
        $jobs[] = $row;
    }
*/
    $rows = count($jobsObj->Job["_ids"]);
    if ($rows > $perpage) {
        $totpages = $pages = ceil($rows / $perpage);
        $pages = ($pages > 5) ? 5 : $pages;
        $start = $curpage - 2;
        
        if ($start < 0) {
            $start = 0;
        }
        $startrec = $curpage * $perpage + 1;
        $endrec = ($curpage*$perpage) + $perpage;
        if ($endrec > $rows) $endrec = $rows;
        print " <label class='viewing'>Viewing: {$startrec}-{$endrec}/$rows </label> ";
        print '<ul class="pagination pagination-sm float-right">';

        if ($curpage > 0) { 
            print '<li class="page-item"><a class="page-link" href="?page=0">«</a></li>';
            print '<li class="page-item"><a class="page-link" href="?page='.abs($curpage - 1).'">‹</a></li>';
        }

        for ($i=$start; $i<$start+$pages; $i++) {
            $active = ($curpage == $i) ? " style='background:#ff0;' " :"";
            print '<li class="page-item"><a class="page-link" '.$active.'href="?page='.$i.'">'.($i+1).'</a></li>';
        }
        // Add ... if we span any numbers, show if more than 5 pages
        if ($pages > 5) {
            print '<li class="page-item"><a class="page-link" href="?page='.ceil($rows /$perpage ).'">...</a></li>';
            print '<li class="page-item"><a class="page-link" href="?page='.ceil($rows /$perpage ).'">'.ceil($rows/$perpage).'</a></li>';
        }
        if ($totpages != ($curpage + 1)) {
            print '<li class="page-item"><a class="page-link" href="?page='.($curpage + 1).'">›</a></li>';
            print '<li class="page-item"><a class="page-link" href="?page='.ceil($rows / $perpage).'">»</a></li>';
        }
    }

?>
                  </ul>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="scrollWrap">
                <table class="table" id="jobs">
                  <thead>
                    <tr>
                      <th><input type='checkbox' id='all-jobs' oninput="app.checkAll()"></th>
                      <th>InvID</th>
                      <th>JobID</th>
                      <th>Business</th>
                      <th>Job</th>
                      <th>Date</th>
                      <th>Balance</th>
                      <th>Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
<?php
    // $cond = "JobCancelled=0 and JobDate<'{$now}' and JobDate>'{$lastyear}' AND BusinessID='$busID' ORDER BY JobDate DESC"; 

    $jobs = $jobsObj; // $boss->getObjectRelated("Job", $cond);
    $count = count($jobs->Job["_ids"]);
    $perpage = ($count < $perpage) ? $count : $perpage;
    $allinvoices = array();
    $buckets = array();
    $startfrom = (isset($in['page'])) ? $in['page'] * $perpage: 0;
    for ($i=$startfrom; $i<($startfrom+$perpage); $i++) {
        $row = $jobs->Job[$i];
        if ($row) {
        $noinvoice = 0;
        $row->Business = $allbusiness[$row->BusinessID]->Business;

        if ($row->related_Invoice && ($row->related_Invoice[0]->Balance>0)) {
            $status = "<span class='badge bg-warning'>HAS INVOICE</span>";
            // $invrel = $boss->getObjectRelated("Invoice", $row->related_Invoice[0]->InvoiceID);
            // $allinvoices[] = $invrel;
            $balance = sprintf("%.02f", $row->related_Invoice[0]->Balance);
        } else if ($row->related_Invoice && ($row->related_Invoice[0]->Balance==0)) {
            $status = "<span class='badge bg-success'>PAID</span>";
            $balance = sprintf("%.02f", $row->related_Invoice[0]->Balance);
        } else {
            $status = "<span class='badge bg-danger'>NO INVOICE</span>";
            $balance = sprintf("%.02f", $row->QuoteAmount);
            $noinvoice = 1;
        }
        
        $url = "/files/templates/print/InvoiceReport.php?z=".base64_encode("ID=".$row->related_Invoice[0]->InvoiceID);
        
        if ($balance || $noinvoice) {
            $hasBalance = ( $row->related_Invoice[0]->Balance) ? 'hasBalance' : 'noBalance';
            $noinv = ($noinvoice) ? "no-invoice" : "has-invoice";
            //$hasreport = (isset($row->related_
            $disabled = (!$noinvoice) ? "" : " DISABLED";

            
            $pid = ($row->related_Invoice[0]->InvoiceParentID) ? $row->related_Invoice[0]->InvoiceParentID : 0;
            $date = date("m/d", strtotime($row->JobDate));
            if ($pid != $currentpid) {
                unset($currentpid);
                $out .= "</tbody><tbody class='group' id='group-{$pid}' data-pid='{$pid}'>";
            }

            if ($pid && !isset($currentpid)) {
                $stats = getParentInfo($pid);
                $pdate = date("m/d", strtotime($stats->date));
                if ($stats->total == 0) {
                    $status = "<span class='badge bg-success'>PAID</span>";
                } else {
                    $status = "<span class='badge bg-warning'>INVOICED</span>";
                }
                $due = number_format($stats->total, 2);
                $currentpid = $pid;
                $tmp = <<<EOT
<tr class='parent {$hasBalance}' data-pid='{$pid}'>
    <td><a href="#" class='toggle closed' onclick="this.classList.toggle('closed');app.toggleGroup({$pid});return false;">▶</a></td>
    <td>{$pid}</td>
    <td></td>
    <td><span class="Business">{$row->Business}</span></td>
    <td><span class="Job">Invoice Parent ID: {$pid} ({$stats->count} Invoices)</span></td>
    <td>{$pdate}</td>
    <td class='balance' id='balance_{$pid}'>\${$due}</td>
    <td class='status' id='status_{$pid}'>{$status}</td>
    <td><a href="/files/templates/InvoiceMaster.php?id={$pid}" onclick="app.showParent($pid); return false;" target="_blank"><i class="fas fa-file-invoice"></i> View Master Invoice</a>
    </td>
</tr>
EOT;
                if (!isset($bucket[$pid])) {
                    $bucket[$pid] = array();
                    $bucket[$pid][] = $tmp;
                }
                $out .= $tmp;
            }
            $xtra = ($pid && $pid !== "0") ? " hidden child" : "";
            $due = number_format($balance, 2);
            $showpid = ($pid) ? $pid : "";
            $tmp = <<<EOT
<tr data-parent='{$pid}' class='{$hasBalance} {$noinv}{$xtra}'>
    <td><input type='checkbox' id='job_{$row->JobID}' class='job-select'{$disabled}></td>
    <td>{$row->related_Invoice[0]->InvoiceID}</td>
    <td>{$row->JobID}</td>
    <td><span class="Business">{$row->Business}</span></td>
    <td><span class="Job">{$row->Job}</span></td>
    <td>{$date}</td>
    <td class="balance">\${$due}</td>
    <td>$status</td>
EOT;

$toolurl = "https://dharristours.simpsf.com/clients/dharristours/templates/JobToPrint.php?z=".base64_encode("ID=".$row->JobID)."#Invoice";
            if (!$noinvoice) {
                $tmp .= "<td><a target='_blank' onclick='app.show(\"{$url}\", \"Invoice {$row->related_Invoice[0]->InvoiceID}\");return false;' href='{$url}'><i class='fa-solid fa-eye'></i> View Invoice</a></td></tr>\n";
            } else {
                $tmp .= "<td><a target='invoice' href='/files/invoices/{$pid}.pdf' onclick='app.show(\"{$toolurl}\",\"Invoice Tool\");return false;'><i class='fa-solid fa-file-invoice'></i> Invoice</a> | <a href='#' onclick='app.showJob({$row->JobID});return false;'><i class='fas fa-bus'></i> Job</a></td></tr>\n";
            }
            $bucket[$pid][] = $tmp;
            $out .= $tmp;
        }
    }
    }
    //print $out;
    if ($bucket) {
        krsort($bucket); 
        foreach ($bucket as $key=>$rows) {
            print "<tbody class='group' id='group-{$key}' data-pid='{$key}'>";
            print join("\n", $rows);
            print "</tbody>";
        }
    }
?>
                  </tbody>
                </table>
                </div>
              </div>
              <!-- /.card-body -->
            </div>

                </form>
            </section>
            <section id="jobview">
                <div id="resize">=</div>
                <div class="toolbar"><div id="viewer-title"></div><button class='close' onclick="app.hideJob()">x</button></div>
                <iframe id="jobframe"></iframe>
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
    const $ = str => document.querySelector(str);
    const $$ = str => document.querySelectorAll(str);

    let app = {
        init() {
            $("#resize").addEventListener("mousedown", app.doDown);
            document.addEventListener("keydown", app.doKey);
            let keys = Object.keys(app.data.Job);
            for (let i=0; i<keys.length; i++) {
                app.jobs.push( app.data.Job[i]);
            }
        },
        doKey(e) {
            console.log(`Keydown: ${e.key}`);

            switch(e.key) {
                case "Escape":
                    $("#viewer").classList.remove("show");
                    break;
                default:
            }
        },
        doDown(e) {
            let frame = document.querySelector("#jobframe");
/*
            domtoimage.toPng(frame).then((dataUri) => { 
                let img = new Image();
                img.src = dataUri;
                document.body.appendChild(img);
            });
*/
            document.addEventListener("mousemove", app.doMove);
            document.addEventListener("mouseup", app.doUp);
            let rect = $("#jobview").getBoundingClientRect();

            app.state.resize = { y: rect.y };
            app.state.jobview = document.querySelector("#jobview");
            app.state.jobview.style.transitionDuration = "0ms";
            
            $("#jobframe").style.display = "none";
            
            app.state.jobview.style.top = e.clientY + 'px';
            app.state.jobview.style.height = window.innerHeight - e.clientY + 'px';
            
            $("#jobframe").style.height = window.innerHeight - e.clientY + 'px';
            console.dir(e);
        },
        doMove(e) {
            app.state.resize.y += e.movementY;
            app.state.jobview.style.top = e.clientY + 'px';
            app.state.jobview.style.height = window.innerHeight - e.clientY + 'px';
            $("#jobframe").style.height = window.innerHeight - e.clientY + 'px';

            e.preventDefault();
        },
        doUp(e) {
            document.removeEventListener("mousemove", app.doMove);
            document.removeEventListener("mouseup", app.doUp);
            $("#jobframe").style.display = "block";
            app.state.viewerTop = e.y;
            app.state.viewerHeight = window.innerHeight - e.y;
            app.storeConfig("viewerHeight", app.state.viewerHeight);
            app.storeConfig("viewerTop", app.state.viewerTop);
        },
        storeConfig(key, val) {
            localStorage.setItem(key, JSON.stringify(val));
        },
        getConfig(key) {
            return JSON.parse(localStorage.getItem(key));
        },
        showViewer(title) {
            let h = app.getConfig("viewerHeight") || window.innerHeight - (window.innerHeight / 2);
            let t = app.getConfig("viewerTop") || window.innerHeight / 2;
            $("#viewer-title").innerHTML = title;
            $("#jobview").style.top = t + 'px';
            $("#jobview").style.height = h + 'px';
            $("#jobview").classList.add("open");
        },
        show(url, title="Viewer") {
            app.showViewer(title);
            $("#jobframe").src = url;
        },
        showParent(id) {
            app.showViewer("Master Invoice");
            $("#jobframe").src = `/files/templates/InvoiceMaster.php?id=${id}`;
        },
        showJob(id) {
            app.showViewer("Job ID: " + id);
            $("#jobframe").src = `view.php?rsc=Job&id=${id}&tpl=Jobs6_2.php`;
        },
        hideJob() {
            $("#jobview").style.top = "100vh";
            $("#jobview").style.height = "0";
            $("#jobview").classList.remove("open");
        },
        // Resets view (shows all records)
        resetView() {
            $$("#jobs tbody tr").forEach(el=>el.classList.remove('hidden'));
        },
        hideAll() {
            $$("#jobs tbody tr").forEach(el=>el.classList.add("hidden"));
        },
        changeView(view) {
            app.resetView();

            switch (view) {
                case "unpaid":
                    $$(".noBalance").forEach(el=>el.classList.add('hidden'));
                    break;
                case "all": 
                    $$(".hidden").forEach(el=>el.classList.remove('hidden'));
                    break;
                case "no-invoice":
                    $$(".no-invoice").forEach(el=>el.classList.remove('hidden'));
                    $$(".has-invoice").forEach(el=>el.classList.add('hidden'));
                    break;
                case "paid":
                    $$(".hasBalance").forEach(el=>el.classList.add('hidden'));
                    break;
                case "unassigned":
                    app.hideAll();
                    $$(".unassigned").forEach(el=>el.classList.remove('hidden'));
                    break;
                case "assigned":
                    app.hideAll();
                    $$(".assigned").forEach(el=>el.classList.remove('hidden'));
                    break;
            }
        },
        jobs: [],
        switchBusiness(id) {
            document.location.href = location.pathname + '?busID=' + id;
        },
        checkAll() {
            let checked = (document.querySelector("#all-jobs").checked);
            if (checked) {
                document.querySelectorAll(".job-select").forEach(el=>{
                    el.setAttribute("checked", true);
                });
            } else {
                document.querySelectorAll(".job-select").forEach(el=>{
                    el.removeAttribute("checked");
                });

            }
        },
        newMasterInvoice() {
            let ids = [], job_ids = [];
            $$("input[type='checkbox']:checked").forEach(el=>{
                let job_id = el.id.replace(/^job_/i, '')
                let job = app.jobs.find(function(el) { if (el) { return el.JobID == job_id; } else { return false; } });
                job_ids.push(job.JobID);
                if (job && job.related_Invoice) {
                    ids.push(job.related_Invoice[0].InvoiceID);
                } 
            });
            console.log(`job ids: `);
            console.dir(ids);
            let now = new Date();
            obj = {
                InvoiceParent: {
                    "new1": {
                        JobIDs: job_ids.join(','),
                        InvoiceIDs: ids.join(','),
                        BusinessID: app.businessID,
                        InvoiceParent: `Master Invoice for ${app.businessName} - ${now.getMonth()+1}/${now.getDate()}/${now.getFullYear()}`
                    }
                }
            };
            obj.InvoiceParent['new1'].Invoice = [];

            ids.forEach(id=>{
                obj.InvoiceParent['new1'].Invoice[id] = {InvoiceID: id}
            });
                        
            (async () => {
              const rawResponse = await fetch('/grid/ctl.php?x=save&rsc=InvoiceParent&json2=true', {
                method: 'POST',
                headers: {
                  'Accept': 'application/json',
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify(obj)
              });
              const content = await rawResponse.json();

              let newid = content.id;
              console.log("new master invoice");
              console.dir(content);
              
              let upd = { Invoice: [] };
              ids.forEach(inv_id=>{
                upd.Invoice[inv_id] = { InvoiceID: inv_id };
                upd.Invoice[inv_id].InvoiceParentID = newid;
              });
              const newResponse = await fetch("/grid/ctl.php?x=save&rsc=Invoice&json2=true", {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(upd)
              });
              const newcontent = await newResponse.json();
console.log("Updated invoices");
console.dir(newcontent);
            })();       
        },
        viewMasterInvoice(id) {
            if (app.state.masterInvoiceID) {
                let url = "InvoiceMaster.php?id=" + app.state.masterInvoiceID;
                window.open(url, "masterinvoice");

            }
        },
        changeCount(num) {
            app.storeConfig("count", num);
            window.location.href = window.location.href +'&count=' + num;    
        },
        selectInvoiceReport(id) {
            $$("input[type='checkbox']:checked").forEach(el=>el.removeAttribute('checked'));
            $$("tr").forEach(el=>el.style.display = 'none');
            let report = app.invoiceReports.find(function(el) { if (el) { return (el.InvoiceParentID==id);} else { return false; } });
            if (report) {
                let ids = report.InvoiceIDs.split(/\,/);
                let job_ids = report.JobIDs.split(/\,/);
                if (job_ids) {
                    job_ids.forEach(item=>{
                        let el = $(`#job_${item}`);
                        if (el) {
                            el.setAttribute("checked", true);
                            el.closest("tr").style.display = "table-row";
                        }
                    });
                }
            }
            $("#view").selectedIndex = 1;
            app.state.masterInvoiceID = id; 
        },
        state: {
        },
        toggleGroup(pid) {
            $$(`tr[data-parent='${pid}']`).forEach(el=>{ el.classList.toggle("hidden"); });
        },
        businessID: '<?php print $busID; ?>',
        businessName: '<?php print $mybusiness->Business; ?>',
        invoiceReports: <?php print json_encode($reports); ?>,
//        invoices: <?php print json_encode($invoices); ?>,
        data: 
        <?php
            print json_encode($jobs);
        ?>
       


    };
    app.init();
    window.app = app;
})();
    </script>
    <script src="/lib/js/dom-to-image-more.min.js"></script>
</body>

</html>
<?php
function getParentInfo($pid) {
    global $link;
    $sql = "select InvoiceParent.Date as date, count(InvoiceID) as count, sum(Invoice.Balance) as total from InvoiceParent, Invoice where Invoice.InvoiceParentID=InvoiceParent.InvoiceParentID and InvoiceParent.InvoiceParentID=".$pid;
    $results = mysqli_query($link, $sql);
    $row = mysqli_fetch_object($results);
    
    return $row;
}
