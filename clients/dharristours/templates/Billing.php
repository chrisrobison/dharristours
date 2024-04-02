<?php
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/.env');
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/lib/auth.php');
    global $env;
    $in = $_REQUEST;
    $out = "";
    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");

    session_start();
    
    if ($_SESSION['Login']->Admin==0) {
        header("Location: /403.shtml");
        exit;
    }
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
    <link
        href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@300;400;500;700;900&family=Lexend+Deca:wght@300;400;500;700;900&family=Lexend:wght@100;200;300;400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/portal/assets/fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="stylesheet" href="/portal/assets/css/adminlte.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <link rel="stylesheet" href="/lib/css/bus-loader.css" />
    <link rel="stylesheet" href="/portal/assets/animate.min.css" />
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
        background: #eee;
    }

    .pagination-sm .page-link {
        font-size: 12px;
    }

    th,
    td {
        color: #222;
    }

    .pagination li.page-item a.page-link {
        color: #00c;
    }

    .pagination {
        margin-left: 2rem;
    }

    .Job,
    .Business {
        display: inline-block;
        width: 17rem;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    input,
    select {
        background-color: #ddd;
    }

    input:focus {
        background-color: #fff;
    }

    footer.main-footer {
        display: flex;
        margin-left: 0px !important;
        width: 100vw;
        position: sticky;
        bottom: 0px;
        left: 0px;
        height: 10vh;
    }

    #jobview {
        position: fixed;
        height: 0px;
        top: 100vh;
        transition: all 300ms linear;
        background-color: #069;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        width: 98.4vw;
    }

    button.close {
        width: 2rem;
        float: right;
        color: #fff;
        text-shadow: 1px 1px 0px #000;
        border: 0;
    }

    button.close:hover {
        text-shadow: 1px 1px 0px #000;
        color: #fff;
    }

    #jobframe {
        height: 100%;
        width: 99vw;

    }

    button {
        border: 1px solid #000;
        background: #bbb;
        border-radius: 1rem;
        text-shadow: 1px 1px 0px #fff6;
        height: 1.8rem;
        transition: all 150ms linear;
        padding: 0.25em 1em;
    }

    .fa-icon {
        height: 1rem;
        color: #222;
        fill: currentColor;
        transition: all 150ms linear;
    }

    .nopad {
        padding: 0.25em 0.5em;
    }

    button:hover .fa-icon {
        color: #fff;
    }

    button:hover {
        background-color: #999;
        color: #fff;
        text-shadow: 1px 1px 0px #000;
    }

    table#jobs {
        border-collapse: collapse;
    }

    .scrollWrap {
        width: 100%;
        height: 76vh;
        overflow-y: scroll;
        overflow-x: auto;
        position: relative;
    }

    .content-wrapper>.content {
        padding: 0;

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

    .child td {}

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
        text-align: right;
    }

    .group {
        transition: all 200ms linear;
        height: 0px;
        overflow: hidden;
    }

    #jobs thead {
        background-color: #ddd;
    }

    thead {
        translate: 0px -2px;
    }

    .toolbar {
        background-color: #223;
        width: 100vw;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        color: #eee;
        font-size: 14px;
    }

    .content-header {
        height: 9vh;
        background: #111;
        color: #ddd;
    }

    label {
        display: inline-block;
        width: 7rem;
        color: #ddd;
        text-align: right;
    }

    label.viewing {
        width: 10rem;
        white-space: nowrap;
    }

    #jobs thead th.searchField {
        background: #eee;
        outline: 1px solid #0009;
    }

    #jobs thead th.searchField:focus {
        background: #fff;
        outline: 2px solid #009;
        border: 1px solid #900;
    }

    th[contenteditable] {
        border: 1px solid #0009;
        background: #fff;
    }

    tr.selected td {
        background-color: #06c;
        color: #fff;
    }

    tr.selected td a {
        color: #fff;
    }

    tr.selected td a:active {
        color: #c00;
    }

    tr.selected td a:visited {
        color: #ccc;
    }

    td:nth-child(1),
    th:nth-child(1) {
        width: 2rem;
    }

    dialog#payment {
        width: 40vw;
        padding: 0;
        font-size: 18px;
    }

    dialog label {
        width: 12rem;
        text-align: right;
    }

    .dialog-foot {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        align-items: center;
        padding: 0.5rem 1rem;
    }

    dialog input {
        font-size: 18px;
        height: 24px;
    }

    dialog>header {
        padding: 0.25rem 1rem;
        font-size: 1.2rem;
        display: flex;
        color: #ddd;
        background: #069;
        align-items: center;
        justify-content: space-between;
    }

    .dialog-body {
        padding: 1rem;
    }

    dialog>header a {
        color: #ff0;
        text-decoration: none;
    }

    .form-row {
        display: flex;
        align-items: flex-start;
        justify-content: center;
    }

    #searchbar {
        height: 0;
        transform: scaleY(0);
        display: none;
        transform-orgin: center top;
        transition: all 300ms linear;
    }

    #searchbar.showsearch {
        height: auto;
        display: table-row;
        transform: scaleY(1);
    }

    #searchbar th {
        border-top: 2px solid #333;
        border-left: 2px solid #333;
        border-right: 2px solid #fff;
        border-bottom: 2px solid #fff;
        background: #eee;

    }

    ::backdrop {
        background: #0006;
    }

    #daterange {
        width: 12rem;
    }

    select {
        height: 1.5rem;
    }

    .card-header {
        background: #000;
    }

    .invoice-toolbar {
        background: rgb(62, 78, 93);
        background: linear-gradient(180deg, #ccc5 0%, #222 25%, #000 70%, #222 100%);
        border-bottom: 1px outset #fff3;
        border-top: 1px solid #fff6;
        width: 98.6vw;
        height: 3em;
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        color: #fff;
        font-size: 14px;
        align-items: center;
    }

    th {
        white-space: nowrap;
    }

    .card-header label {
        width: fit-content;
    }

    .sorticon {
        display: inline-block;
        width: 0.9em;
        height: 0.9em;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='15.716 -4 54.503 95.03' xmlns='http://www.w3.org/2000/svg' xmlns:bx='https://boxy-svg.com'%3E%3Cdefs%3E%3ClinearGradient id='color-0' gradientUnits='userSpaceOnUse' bx:pinned='true'%3E%3Cstop style='stop-color: rgb(0, 0, 0)'%3E%3C/stop%3E%3C/linearGradient%3E%3ClinearGradient id='color-1' gradientUnits='userSpaceOnUse' bx:pinned='true'%3E%3Cstop style='stop-color: rgb(255, 255, 255)'%3E%3C/stop%3E%3C/linearGradient%3E%3C/defs%3E%3Cpath d='M 39.093 2.888 Q 42.968 -2.888 46.843 2.888 L 64.928 29.843 Q 68.803 35.619 61.052 35.619 L 24.883 35.619 Q 17.133 35.619 21.008 29.843 Z' style='stroke: rgb(0, 0, 0); stroke-width: 5px; fill: url(%23color-1);' bx:shape='triangle 17.133 -2.888 51.67 38.507 0.5 0.15 1@fafc8eae'%3E%3C/path%3E%3Cpath d='M 39.093 54.299 Q 42.968 48.523 46.843 54.299 L 64.928 81.254 Q 68.803 87.03 61.052 87.03 L 24.883 87.03 Q 17.133 87.03 21.008 81.254 Z' style='transform-box: fill-box; transform-origin: 50%25 50%25; stroke: rgb(0, 0, 0); stroke-width: 5px; fill: url(%23color-0);' transform='matrix(-1, 0, 0, -1, 0, 0)' bx:shape='triangle 17.133 48.523 51.67 38.507 0.5 0.15 1@dd895820'%3E%3C/path%3E%3C/svg%3E");
        background-size: contain;
        background-repeat: no-repeat;
        transition: transform 200ms linear;
        transform-origin: center center;
    }

    table#jobs th {
        transition: all 200ms linear;
        cursor: default;
    }

    table#jobs th>span.sorticon {
        transition: all 200ms linear;
        opacity: 0.25;
    }

    table#jobs th.sort>span.sorticon {
        transition: all 200ms linear;
        opacity: 1;
    }

    table#jobs th.sort.sort0>span.sorticon {
        transition: all 200ms linear;
        transform: rotate(0deg);
    }

    table#jobs th.sort.sort1>span.sorticon {
        transition: all 200ms linear;
        transform: rotate(180deg);
    }
    .progresswrap {
        width: 500px;
        height: 3rem;
        background-color: #aaa;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: flex-start;
    }
    .progressbar {
        display: inline-block;
        height: 2rem;
        width: 0px;
        background-color: #069;
        animation: 9s linear 0s infinite running progress;
    }
    @keyframes progress {
        0% { width: 0px;}
        10% { width: 150px;}
        25% { width: 200px;}
        50% { width: 300px;}
        60% { width: 320px;}
        82% { width: 400px;}
        95% { width: 470px;}
        100% { width: 500px; }
    }
    /* HTML: <div class="loader"></div> */
    .loading {
        position: absolute;
        left: 4px;
        bottom: 4px;
        height: 40px;
        width: 40px;
        aspect-ratio: 1;
        border-radius: 50%;
        padding: 6px;
        background:
        conic-gradient(from 135deg at top,currentColor 90deg, #0000 0) 0 calc(50% - 4px)/17px 8.5px,
        radial-gradient(farthest-side at bottom left,#0000 calc(100% - 4px),currentColor calc(100% - 3px) 99%,#0000) top right/50%  50% content-box content-box,
        radial-gradient(farthest-side at top        ,#0000 calc(100% - 4px),currentColor calc(100% - 3px) 99%,#0000) bottom   /100% 50% content-box content-box;
        background-repeat: no-repeat;
    }
    .loading.run {
        animation: l11 1s infinite linear;
    }
    @keyframes l11{ 
      100%{transform: rotate(1turn)}
    }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.umd.min.js"></script>
    <script type="module" src="/portal/node_modules/@github/auto-complete-element/dist/bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.umd.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
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
                        <div class="col-sm-6">
                            <label for="BusinessID">Business</label>
                            <select style="width:20rem;font-size:12px" id="BusinessID"
                                oninput="app.switchBusiness(this.value)">
                                <?php
    $businesses = $boss->get("Business", "1=1 ORDER BY Business");
    $allbusiness = array();

    foreach ($businesses as $business) {
        $selected = ($_SESSION['BusinessID'] == $business->BusinessID) ? " SELECTED" : "";
        print "<option data-id='{$business->BusinessID}' value='{$business->BusinessID}'$selected>{$business->Business} [{$business->BusinessID}]</option>";
        $allbusiness[$business->BusinessID] = new stdClass();
        $allbusiness[$business->BusinessID]->Business = $business->Business;
        $allbusiness[$business->BusinessID]->BusinessID = $business->BusinessID;
    }
?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="InvoiceParentID">Master Invoices </label> <select
                                style="width:20rem;font-size:12px" id="InvoiceParentID"
                                onchange="app.selectInvoiceReport(this.value)">
                                <option> -- Select to View --</option>
                                <?php
    $reports = $boss->get("InvoiceParent");
    foreach ($reports as $report) {
        print "<option value='".$report->InvoiceParentID."'>[{$report->InvoiceParentID}] ".$report->InvoiceParent."</option>";
    }
    $masterlist = json_encode($reports);
?>
                            </select>
                            <button onclick="app.viewMasterInvoice(); return false;">View Master</button>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content" style="background:#000">
                <div class="invoice-toolbar">
                    <button class='nopad' title="Toggle Search Toolbar" onclick="app.toggleSearch();return false;"><svg
                            class='fa-icon' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                        </svg></button>
                    <button class='nopad' title="Reset Table"
                        onclick="location.href=location.origin + location.pathname"><svg class='fa-icon'
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M463.5 224H472c13.3 0 24-10.7 24-24V72c0-9.7-5.8-18.5-14.8-22.2s-19.3-1.7-26.2 5.2L413.4 96.6c-87.6-86.5-228.7-86.2-315.8 1c-87.5 87.5-87.5 229.3 0 316.8s229.3 87.5 316.8 0c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0c-62.5 62.5-163.8 62.5-226.3 0s-62.5-163.8 0-226.3c62.2-62.2 162.7-62.5 225.3-1L327 183c-6.9 6.9-8.9 17.2-5.2 26.2s12.5 14.8 22.2 14.8H463.5z" />
                        </svg></button>
                    <button title="Group together selected invoices into one Master Invoice"
                        onclick="app.newMasterInvoice(); return false;"><svg class='fa-icon'
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M208 80c0-26.5 21.5-48 48-48h64c26.5 0 48 21.5 48 48v64c0 26.5-21.5 48-48 48h-8v40H464c30.9 0 56 25.1 56 56v32h8c26.5 0 48 21.5 48 48v64c0 26.5-21.5 48-48 48H464c-26.5 0-48-21.5-48-48V368c0-26.5 21.5-48 48-48h8V288c0-4.4-3.6-8-8-8H312v40h8c26.5 0 48 21.5 48 48v64c0 26.5-21.5 48-48 48H256c-26.5 0-48-21.5-48-48V368c0-26.5 21.5-48 48-48h8V280H112c-4.4 0-8 3.6-8 8v32h8c26.5 0 48 21.5 48 48v64c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V368c0-26.5 21.5-48 48-48h8V288c0-30.9 25.1-56 56-56H264V192h-8c-26.5 0-48-21.5-48-48V80z" />
                        </svg> New Master Invoice</button>
                    <button title="Creates invoices for all selected Jobs"
                        onclick="app.makeInvoice(); return false;"><svg class='fa-icon'
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM64 80c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm128 72c8.8 0 16 7.2 16 16v17.3c8.5 1.2 16.7 3.1 24.1 5.1c8.5 2.3 13.6 11 11.3 19.6s-11 13.6-19.6 11.3c-11.1-3-22-5.2-32.1-5.3c-8.4-.1-17.4 1.8-23.6 5.5c-5.7 3.4-8.1 7.3-8.1 12.8c0 3.7 1.3 6.5 7.3 10.1c6.9 4.1 16.6 7.1 29.2 10.9l.5 .1 0 0 0 0c11.3 3.4 25.3 7.6 36.3 14.6c12.1 7.6 22.4 19.7 22.7 38.2c.3 19.3-9.6 33.3-22.9 41.6c-7.7 4.8-16.4 7.6-25.1 9.1V440c0 8.8-7.2 16-16 16s-16-7.2-16-16V422.2c-11.2-2.1-21.7-5.7-30.9-8.9l0 0 0 0c-2.1-.7-4.2-1.4-6.2-2.1c-8.4-2.8-12.9-11.9-10.1-20.2s11.9-12.9 20.2-10.1c2.5 .8 4.8 1.6 7.1 2.4l0 0 0 0 0 0c13.6 4.6 24.6 8.4 36.3 8.7c9.1 .3 17.9-1.7 23.7-5.3c5.1-3.2 7.9-7.3 7.8-14c-.1-4.6-1.8-7.8-7.7-11.6c-6.8-4.3-16.5-7.4-29-11.2l-1.6-.5 0 0c-11-3.3-24.3-7.3-34.8-13.7c-12-7.2-22.6-18.9-22.7-37.3c-.1-19.4 10.8-32.8 23.8-40.5c7.5-4.4 15.8-7.2 24.1-8.7V232c0-8.8 7.2-16 16-16z" />
                        </svg> Make Invoice</button>
                    <button onclick="app.addPayment(); return false;"><svg class='fa-icon'
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M64 0C46.3 0 32 14.3 32 32V96c0 17.7 14.3 32 32 32h80v32H87c-31.6 0-58.5 23.1-63.3 54.4L1.1 364.1C.4 368.8 0 373.6 0 378.4V448c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V378.4c0-4.8-.4-9.6-1.1-14.4L488.2 214.4C483.5 183.1 456.6 160 425 160H208V128h80c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H64zM96 48H256c8.8 0 16 7.2 16 16s-7.2 16-16 16H96c-8.8 0-16-7.2-16-16s7.2-16 16-16zM64 432c0-8.8 7.2-16 16-16H432c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm48-168a24 24 0 1 1 0-48 24 24 0 1 1 0 48zm120-24a24 24 0 1 1 -48 0 24 24 0 1 1 48 0zM160 344a24 24 0 1 1 0-48 24 24 0 1 1 0 48zM328 240a24 24 0 1 1 -48 0 24 24 0 1 1 48 0zM256 344a24 24 0 1 1 0-48 24 24 0 1 1 0 48zM424 240a24 24 0 1 1 -48 0 24 24 0 1 1 48 0zM352 344a24 24 0 1 1 0-48 24 24 0 1 1 0 48z" />
                        </svg> Receive Payment</button>
                </div>

                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header" style="background:#111;display:flex;">
                                    <div class="card-tools" style="float:left;">
                                        <div style="margin-right: 1rem;display:inline-block;">
                                            <label title="Filter Jobs based on status" for="view">View</label> <select
                                                id="view" onchange="app.changeView(this.value)">
                                                <option value="all">All</option>
                                                <option value="overdue30">30+ Days Overdue</option>
                                                <option value="overdue60">60+ Days Overdue</option>
                                                <option value="overdue90">90+ Days Overdue</option>
                                                <option value="overdue">All Jobs/Invoices with Balance</option>
                                                <option value="paid">Paid</option>
                                                <option value="no-invoice">No Invoice</option>
                                                <option value="onlymaster">Master Invoice Only</option>
                                                <option value="completed" <?php
                                if (array_key_exists("complete", $in)) {
                                    print " SELECTED";
                                }
                            ?>>Trip Completed</option>
                                            </select>
                                        </div>
                                        <div style="display:inline-block;margin-right: 2rem;">
                                            <input type="checkbox" id="current" name="current"
                                                oninput="app.showCurrentJobs(this.checked)"> <label
                                                style="width:fit-content;" for="current">View Current</label>
                                        </div>
                                        <div style="display:inline-block;">
                                            <label title="Show only jobs completed between these dates"
                                                for="startdate">Dates</label> <input type="date"
                                                title="Show only jobs completed after this date" id="startdate"
                                                placeholder="Select Start Date" <?php
if (array_key_exists("start", $in)) {
    print "value='" . $in['start']. "' ";
} else {
    print "value='" . date("Y-m-d", strtotime("4 weeks ago"))."' ";
}
                        ?> onchange="app.filterDates()" />
                                            -
                                            <input type="date" title="Show only jobs completed after this date"
                                                id="enddate" placeholder="Select End Date" <?php
if (array_key_exists("end", $in)) {
    print "value='" . $in['end']. "' ";
} else {
    print "value='" . date("Y-m-d", strtotime("yesterday"))."' ";
}

                        ?> onchange="app.filterDates()" />
                                        <button onclick="app.filterDates();return false;">Go</button>
                                        </div>
                                        <div style="margin-right: 1rem;display:inline-block;">
                                            <label title="Limit the maximum number of records viewed per page"
                                                for="count">View Count</label>
                                            <select id="count" oninput="app.changeCount(this.value)">
                                                <option value="10" <?php print ($perpage==10) ? "SELECTED" : ""; ?>>10
                                                </option>
                                                <option value="25" <?php print ($perpage==25) ? "SELECTED" : ""; ?>>25
                                                </option>
                                                <option value="50" <?php print ($perpage==50) ? "SELECTED" : ""; ?>>50
                                                </option>
                                                <option value="100" <?php print ($perpage==100) ? "SELECTED" : ""; ?>>
                                                    100</option>
                                                <option value="250" <?php print ($perpage==250) ? "SELECTED" : ""; ?>>
                                                    250</option>
                                                <option value="1000" <?php print ($perpage==1000) ? "SELECTED" : ""; ?>>
                                                    1000</option>
                                                <option value="100000"
                                                    <?php print ($perpage==100000) ? "SELECTED" : ""; ?>>all</option>
                                            </select>
                                        </div>
                                        <div style="display:inline-block" class="page-nav"></div>
                                        <?php
    $lastmonth = date("Y-m-d", strtotime("30 days ago"));
    $lastquarter = date("Y-m-d", strtotime("3 months ago"));
    $lastyear = date("Y-m-d", strtotime("1 year ago"));
    $from2023 = date("Y-m-d", strtotime("2023-01-01"));
    $now = date("Y-m-d");
    
    $curpage = (array_key_exists('page', $in)) ? $in['page'] : 0;

    if ($busID == 332) {
        $xtra = "";
        if (array_key_exists("range", $in)) {
            $dates = preg_split("/\s\-\s/", $in['range']);

            $xtra = " AND ((JobDate > '{$dates[0]}') AND (JobDate < '{$dates[1]}')) ";
        }
        if (array_key_exists("complete", $in)) {
            $xtra .= " AND (JobDate < '{$now}') ";
        }
         //$cond = "JobCancelled=0 and JobDate<'{$now}' and JobDate>'{$lastquarter}' AND NoInvoice=0 AND InvoiceSatisfied=0 AND BusinessID!='$busID' ORDER BY JobDate DESC"; 
        $cond = "JobCancelled=0 and JobDate>'{$from2023}' AND NoInvoice=0 AND InvoiceSatisfied=0 AND BusinessID!='332' $xtra ORDER BY JobDate DESC"; 

    } else {
        //$cond = "JobCancelled=0 and JobDate<'{$now}' and JobDate>'{$lastyear}' AND NoInvoice=0 AND InvoiceSatisfied=0 AND BusinessID='$busID' ORDER BY JobDate DESC"; 
        $xtra = "";
        if (array_key_exists("range", $in)) {
            $dates = preg_split("/\s\-\s/", $in['range']);

            $xtra = " AND ((JobDate > '{$dates[0]}') AND (JobDate < '{$dates[1]}')) ";
        }
        if (array_key_exists("complete", $in)) {
            $xtra .= " AND (JobDate < '{$now}') ";
        }
        $cond = "JobCancelled=0 AND JobDate>'{$lastyear}' AND NoInvoice=0 AND InvoiceSatisfied=0 AND BusinessID='$busID' $xtra ORDER BY JobDate DESC"; 
    }

//    $jobsObj = $boss->getObjectRelated("Job", $cond);
//    $jobs = $jobsObj->Job;
?>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="scrollWrap">
                                        <table class="table" id="jobs">
                                            <thead>
                                                <tr onclick="app.doSort(event)">
                                                    <th><input type='checkbox' id='all-jobs' oninput="app.checkAll()">
                                                    </th>
                                                    <th data-name="InvoiceID" data-type="numeric"><span
                                                            data-name="InvoiceID" class="sorticon"></span> InvID</th>
                                                    <th data-name="JobID" data-type="numeric"><span data-name="JobID"
                                                            class="sorticon"></span> JobID</th>
                                                    <th data-name="Business" data-type="business"><span
                                                            data-name="Business" class="sorticon"></span> Business</th>
                                                    <th data-name="Job"><span data-name="Job" class="sorticon"></span>
                                                        Job</th>
                                                    <th class="sort sort0" data-name="JobDate" data-type="date"><span
                                                            data-name="JobDate" class="sorticon"></span> Date</th>
                                                    <th data-name="Balance" data-type="numeric"><span
                                                            data-name="Balance" class="sorticon"></span> Balance</th>
                                                    <th>Status</th>
                                                    <th></th>
                                                </tr>
                                                <tr id="searchbar">
                                                    <th><a href="#" onclick="app.toggleSearch(true);return false;">x</a>
                                                    </th>
                                                    <th class="searchField"><input type="text" class="InvoiceID"
                                                            id="search-InvoiceID" width="5" style="width:3rem;"
                                                            data-field="InvoiceID"
                                                            onchange="app.filter(event, 'InvoiceID')"></th>
                                                    <th class="searchField"><input type="text" class="InvoiceID"
                                                            id="search-JobID" width="5" style="width:3rem;"
                                                            data-field="JobID" onchange="app.filter(event, 'JobID')">
                                                    </th>
                                                    <th class="searchField"><input type="text" class="search-Business"
                                                            id="search-Business" data-field="Business"
                                                            onchange="app.filter(event, 'Business')"></th>
                                                    <th class="searchField"><input type="text" class="search-Job"
                                                            id="search-Job" data-field="Job"
                                                            onchange="app.filter(event, 'Job')"></th>
                                                    <th class="searchField"><input type="text" class="search-JobDate"
                                                            id="search-JobDate" style="width:4rem;" data-field="JobDate"
                                                            onchange="app.filter(event, 'JobDate')"></th>
                                                    <th class="searchField"><input type="text" class="search-Balance"
                                                            id="search-Balance" style="width:4rem;" data-field="Balance"
                                                            onchange="app.filter(event, 'Balance')"></th>
                                                    <th class="searchField"><input type="text" class="search-Status"
                                                            id="search-Status" style="width:4rem;" data-field="Status"
                                                            onchange="app.filter(event, 'Status')"></th>
                                                    <th data-field=""></th>
                                                </tr>
                                            </thead>
                                            <tbody id="placeholder"></tbody>
                                            <?php

//    $jobs = $jobsObj; 
?>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>

                </form>
            </section>
            <section id="jobview">
                <div id="resize">=</div>
                <div class="toolbar">
                    <div id="viewer-title"></div><button class='close' onclick="app.hideJob()">x</button>
                </div>
                <iframe id="jobframe"></iframe>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <dialog id="payment">
            <header><span>Receive Payment</span><a href="#"
                    onclick="document.querySelector('#payment').close();return false;">x</a></header>
            <div class="dialog-body">
                <form method="dialog">
                    <div class="form-row">Receive payment from <span id="pay-business">BUSINESS</span></div>
                    <div class="form-row">for Job ID&apos;s: <span id="pay-ids"></span></div>
                    <div class='form-row'><label for="amount">Payment Amount: $</label><input type="number" step="0.01"
                            id="amount" name="amount" value="0.00"></div>
                    <div class='form-row'><label for="Notes">Notes: &nbsp;</label><textarea id="Notes"
                            name="Notes"></textarea></div>
                </form>
            </div>
            <div class="dialog-foot">
                <button onclick="document.querySelector('#payment').close();return false;">Cancel</button>&nbsp;
                <button onclick="app.savePayment();document.querySelector('#payment').close();return false;">Save
                    Payment</button>
            </div>
        </dialog>
        <footer class="main-footer" style="display:flex;justify-content:flex-end;align-items:center;height:6vh;">
            <div class="loading run"></div>
            
            <label id="quotesumlabel" style="width:fit-content;color:#333;padding:0;margin:0">Quoted Total:</label>
            <div id="quotesumtotal"
                style="width:10rem;display:inline-block;font-size:20px;color:#c00;text-align:center;padding:0.25rem;">
            </div>
            <label id="sumlabel" style="width:fit-content;color:#333;padding:0;margin:0">Total for Current View:</label>
            <div id="sumtotal"
                style="width:10rem;display:inline-block;font-size:20px;color:#c00;text-align:center;padding:0.25rem;">
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <div id="overlay" style="display:flex;">
        <h2>D Harris Tours</h2>
        <div class="loader"></div>
        <h2>Loading...<span id="loading"></span></h2>
        <div class="progresswrap"><div class="progressbar"></div></div>
    </div>
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
            body: [],
            config: {

                perpage: <?php print ($perpage == "all") ? 100000 : $perpage; ?>,
            },
            async filter(evt, col) {
                let txt = evt.target.value;
                let newjobs = [];
                app.state.focus = evt.target;
                app.state.searchValue = txt;
                app.state.searchField = col;
                if (txt) {
                    app.jobs.forEach(job => {
                        if (job) {
                            if (txt) {
                                let re = new RegExp(txt, "i");
                                if (job[col].match(re)) {
                                    newjobs.push(JSON.parse(JSON.stringify(job)));
                                }
                            }
                        }
                    });
                    if (newjobs.length) {
                        await app.renderJobs(newjobs);
                    }

                    setTimeout(function() {
                        document.querySelector(`#search-${app.state.searchField}`).value = app.state
                            .searchValue;
                        document.querySelector(`#search-${app.state.searchField}`).focus();
                    }, 100);
                } else {
                    app.currentJobs = [];
                    app.jobs.forEach(job => {
                        app.currentJobs.push(JSON.parse(JSON.stringify(job)))
                    });
                    app.renderJobs(app.currentJobs);
                }
            },
            async init() {
                $("#overlay").style.display = "flex";
                app.worker = new Worker("/files/worker.js");
                app.worker.onmessage = app.handleMessage;

                let sd = app.getConfig("startdate");
                let ed = app.getConfig("enddate");
                if (sd) $("#startdate").value = sd.substring(0, 10);
                if (ed) $("#enddate").value = ed.substring(0, 10);

                let tmpcnt = app.getConfig("count");
                if (tmpcnt && tmpcnt > 9) {
                    app.config.perpage = tmpcnt;
                    $("#count").value = tmpcnt;
                }
                $("#resize").addEventListener("mousedown", app.doDown);
                document.addEventListener("keydown", app.doKey);
                //app.initCalendar();
                // app.currentJobs = JSON.parse(JSON.stringify(app.jobs));
                
                let startdate = $("#startdate").value;
                let enddate = $("#enddate").value;
                app.fetchJobs(startdate, enddate);
/*
                app.jobs = await app.fetchJobs(startdate, enddate);
                for (let i = 0; i < app.jobs.length; i++) {
                    if (app.jobs[i]) {
                        $("#loading").innerHTML = `Updating Job ${i} of ${app.jobs.length}`;
                        app.jobs[i].Business = app.allbusiness[app.jobs[i].BusinessID].Business;
                    }
                }
                app.currentJobs = app.jobs;
                app.renderJobs(app.currentJobs);
                $("#overlay").style.display = "none";
*/
            },
            handleMessage(evt) {
                console.log("handling message");
                console.dir(evt);

                let data = evt.data;

                if (data.results && data.cb) {
                    app[data.cb](data.results);
                }
            },
            async receiveJobs(data, doani=0) {
                console.log(`receiveJobs results`);
                console.dir(data);
                if (data.results) {
                    app.jobs = data.results;
                    localStorage.setItem('jobs', JSON.stringify(data.results));

                    for (let item of app.jobs) {
                        if (item) {
                            item.Business = app.allbusiness[item.BusinessID];
                        }
                    }
                }
                app.currentJobs = app.jobs;
                await app.renderJobs(app.currentJobs);
                if (doani) {
                    $(".loading").classList.add("run");
                } else {
                    $(".loading").classList.remove("run");
                }
            },
            async fetchJobs(start, end) {
                $("#overlay").style.display = "flex";
                $("#loading").innerHTML = `...`;
                $(".loading").classList.remove("run");

                let cache = JSON.parse(localStorage.getItem('jobs'));

                if (cache) {
                    app.receiveJobs({results: cache}, 1);
                }
                let now = new Date().getTime();
                if (!start) {
                    start = new Date("2023-01-01").getTime();
                }
                if (!end) end = now + 1209600000;

                let sdate = new Date(start).toISOString().substring(0, 10);
                let edate = new Date(end).toISOString().substring(0, 10);
                app.worker.postMessage({action: "fetchJobs", args: [sdate, edate], cb: "receiveJobs"});
            /*
            let cond =
                    `JobCancelled=0 and JobDate>'${sdate}' AND JobDate<'${edate}' AND NoInvoice=0 AND InvoiceSatisfied=0 AND BusinessID!='332' ORDER BY JobDate DESC`;

                const rawResponse = await fetch(
                    `/portal/api.php?type=listJobs&cond=${encodeURIComponent(cond)}`);
                let out = await rawResponse.json();
                if (out) {
                    for (let i = 0; i < out.length; i++) {
                        out[i].Business = app.allbusiness[out[i].BusinessID];
                        $("#loading").innerHTML = `${i} / ${out.length}`;
                    }
                }
                console.log("fetchJobs");
                console.dir(out);
                $("#overlay").style.display = "none";

                app.data.Job = out;

                return out;
            */
            },
            formatCurrency(val) {
                return Intl.NumberFormat("en-US", {
                    style: 'currency',
                    currency: 'USD'
                }).format(val);
            },
            initCalendar() {
                app.picker = new easepick.create({
                    element: "#startdate",
                    css: [
                        "https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.css"
                    ],
                    zIndex: 99999,
                    plugins: [
                        "RangePlugin",
                        "PresetPlugin",
                        "KbdPlugin"
                    ],
                    setup(picker) {
                        picker.on("select", (e) => {
                            app.filterDates(e.detail.start, e.detail.end);
                        });
                    },
                    onClickCalendarDay: function() {
                        let start = app.picker.getStartDate();
                        let end = app.picker.getEndDate();

                        if (start && end) {
                            app.filterDates(start + ' - ' + end);
                        }
                    }
                })
            },
            validDate(d) {
                return d instanceof Date && !isNaN(d);             
            },
            async filterDates(startDate, endDate) {
                if (!startDate) {
                    startDate = $("#startdate").value;
                }
                if (!endDate) {
                    endDate = $("#enddate").value;
                }
                $("#overlay").style.display = "flex";

                if (!endDate) endDate = startDate;
                if (typeof(startDate) === "string") {
                    startDate = new Date(startDate);
                }
                if (typeof(endDate) === "string") {
                    endDate = new Date(endDate);
                }
                
                if (app.validDate(startDate) && app.validDate(endDate)) {
                    console.log(
                        `Filtering dates for ${startDate.toISOString()} - ${endDate.toISOString()}`);
                    let start = startDate.getTime();
                    let end = endDate.getTime();
                    let range = startDate.toISOString() + ' - ' + endDate.toISOString();
                    let search = location.search.replace(/^\?/, '');
                    if (search) search = '&' + search;
                    app.storeConfig("startdate", startDate);
                    app.storeConfig("enddate", endDate);

                    // document.location.href = document.location.origin + document.location.pathname + '?range=' + encodeURIComponent(range) + search;
                    let filteredJobs = [];
                    let newjobs = await app.fetchJobs(startDate, endDate);
                    /*
                    app.jobs.forEach(job=>{
                        if (job) {
                            let jobdate = new Date(job.JobDate).getTime();
                            console.log(`start: ${start}  end: ${end}  jobdate: ${jobdate}`);
                            if ((jobdate > start) && (jobdate < end)) {
                                filteredJobs.push(job);
                            }
                        }
                    });
                    */

                    app.currentJobs = newjobs;
                    app.renderJobs(app.currentJobs);
                    $("#overlay").style.display = "none";
                }
            },
            doCheckbox(e) {
                console.log("doCheckbox");
                console.dir(e);

                if ((e.shiftKey) && (app.lastCheck)) {
                    let row = e.target.closest("tr");
                    let lastrow = app.lastCheck.closest("tr");

                    let lastrowidx = parseInt(lastrow.dataset.index);
                    let rowidx = parseInt(row.dataset.index);

                    if (lastrowidx < rowidx) {
                        let currow = lastrow.nextElementSibling;
                        for (let i = lastrowidx; i < rowidx - 2; i++) {
                            currow.querySelector(".job-select").setAttribute("checked", true);
                            currow = currow.nextElementSibling;
                        }
                    } else {
                        let currow = lastrow.previousElementSibling;
                        for (let i = lastrowidx; i > rowidx; i--) {
                            currow.querySelector(".job-select").setAttribute("checked", true);
                            currow = currow.previousElementSibling;

                        }
                    }
                }
                $("#all-jobs").checked = true;
                app.lastCheck = e.target;
                setTimeout(function() {
                    app.sumCheckbox();
                }, 10);
            },
            sumCheckbox() {
                let sum = 0;
                let boxes = $$(".job-select:checked");
                if (!boxes.length) {
                    app.sumCurrentView();
                }
                $$(".job-select").forEach(chkbox => {
                    if (chkbox.checked) {
                        let tr = chkbox.closest("tr");
                        if (tr.dataset.jobid) {
                            let job = app.jobs.find(el => el.JobID == tr.dataset.jobid);
                            let inv = job.related_Invoice;

                            if (inv && inv[0]) {
                                let invtot = parseFloat(inv[0].Balance);
                                if (!isNaN(invtot)) sum += invtot;
                            }

                        }
                    }
                });
                $("#sumtotal").innerHTML = new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD'
                }).format(sum);
                $("#sumlabel").innerHTML = "Total for Selected Invoices";
                return sum;
            },
            toggleSearch(forceHide) {
                if (!forceHide) {
                    $("#searchbar").classList.toggle("showsearch");
                } else {
                    $("#searchbar").classList.remove("showsearch");
                }

                if (!$("#searchbar").classList.contains("showsearch")) {
                    app.currentJobs = [];
                    app.jobs.forEach(job => {
                        app.currentJobs.push(JSON.parse(JSON.stringify(job)))
                    });
                    app.renderJobs(app.currentJobs);
                }
            },
            selectRow(e) {
                let row = e.target.closest("tr");
                let rowrect = row.getBoundingClientRect();
                if (row) {
                    $$(".selected").forEach(el => el.classList.remove("selected"));
                    row.classList.add("selected");
                    setTimeout(function() {
                        row.scrollIntoView(true);
                        setTimeout(function() {

                            row.closest(".scrollWrap").scrollBy(0, -rowrect.height);
                        }, 300);
                    }, 600);
                }
            },
            doKey(e) {
                console.log(`Keydown: ${e.key}`);

                switch (e.key) {
                    case "Escape":
                        app.hideJob();
                        break;
                    default:
                }
            },
            doDown(e) {
                let frame = document.querySelector("#jobframe");

                document.addEventListener("mousemove", app.doMove);
                document.addEventListener("mouseup", app.doUp);
                let rect = $("#jobview").getBoundingClientRect();

                app.state.resize = {
                    y: rect.y
                };
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
                let t = app.getConfig("viewerTop") || window.innerHeight / 2;
                $("#viewer-title").innerHTML = title;
                $("#jobview").style.top = t + 'px';
                $("#jobview").style.height = `calc( 100vh - ${t}px )`;
                $("#jobview").classList.add("open");
            },
            show(url, title = "Viewer") {
                app.showViewer(title);
                $("#jobframe").src = url;
            },
            showParent(id) {
                app.showViewer("Master Invoice");
                $("#jobframe").src = `/files/templates/MasterInvoice.php?id=${id}`;
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
            showCurrentJobs(checked) {
                let now = new Date();
                let newjobs = [];
                if (checked) {
                    app.jobs.forEach(job => {
                        if (job) {
                            let then = new Date(job.JobDate);
                            if (then.getTime() < now.getTime()) {
                                newjobs.push(JSON.parse(JSON.stringify(job)));
                            }
                        }
                    });
                } else {
                    newjobs = app.jobs;
                }
                app.currentJobs = newjobs;
                app.renderJobs(newjobs);
            },
            showCompleted() {
                location.href = location.origin + location.pathname + '?complete=1' + location.search.replace(
                    /^\?/, '');

            },
            // Resets view (shows all records)
            resetView() {
                $$("#jobs tbody tr").forEach(el => el.classList.remove('hidden'));
            },
            hideAll() {
                $$("#jobs tbody tr").forEach(el => el.classList.add("hidden"));
            },
            showAll() {
                $("#loading").innerHTML = `Loading ${app.jobs.length} records...`;
                app.currentJobs = app.jobs;
                if ($("#current").checked) {
                    app.showCurrentJobs(true);
                } else {
                    app.renderJobs(app.jobs);
                }
 
            },
            showNoInvoice() {
                let noinv = [];
                let cnt = 0;
                let tot = app.jobs.length;
                for (const job of app.jobs) {
                    if (job) {
                        if ((job.InvoiceID == 0) && (!(job.related_Invoice))) {
                            ++cnt;
                            $("#loading").innerHTML = `Found ${cnt} in ${tot} records...`;
                            noinv.push(job);
                        }
                    }
                }
                app.currentJobs = noinv;
                app.renderJobs(app.currentJobs);
            },
            changeView(view) {
                app.resetView();
                let cnt = 0, tot = 0;
                switch (view) {
                    case "unpaid":
                        let unpaid = [];
                        app.jobs.forEach(job => {
                            if (job) {
                                if (job.related_Invoice && job.related_Invoice[0] && job
                                    .related_Invoice[0].Balance > 0) {
                                    unpaid.push(job);
                                }
                            }
                        });
                        app.currentJobs = unpaid;
                        app.renderJobs(unpaid);
                        break;
                    case "all":
                        $("#overlay").style.display = "flex";
                        $("#loading").innerHTML = `Loading ${app.jobs.length} records...`;

                        app.showAll();
                        
                        $("#overlay").style.display = "none";
                        break;
                    case "no-invoice":
                        $("#overlay").style.display = "flex";
                        
                        app.showNoInvoice();

                        $("#overlay").style.display = "none";

                        break;
                    case "paid":
                        cnt = 0;
                        tot = app.jobs.length;
                        app.jobs.forEach(job => {
                            if (job) {
                                if (job.related_Invoice && job.related_Invoice[0] && (job.related_Invoice[0].Balance==0)) {
                                    ++cnt;
                                    $("#loading").innerHTML = `Found ${cnt} PAID in ${tot} records...`;
                                    noinv.push(job);
                                }
                            }
                        });
                        app.currentJobs = noinv;
                        app.renderJobs(app.currentJobs);
                        
                        break;
                    case "unassigned":
                        app.hideAll();
                        $$(".unassigned").forEach(el => el.classList.remove('hidden'));
                        break;
                    case "assigned":
                        app.hideAll();
                        $$(".assigned").forEach(el => el.classList.remove('hidden'));
                        break;
                    case "completed":
                        app.showCompleted();
                        break;
                    case "overdue30":
                        app.showPastDue(30);
                        break;
                    case "overdue60":
                        app.showPastDue(60);
                        break;
                    case "overdue90":
                        app.showPastDue(90);
                        break;
                    case "overdue":
                        app.showPastDue();
                        break;
                    case "onlymaster":
                        app.showMasterInvoices();
                        break;
                }
            },
            jobs: [],
            async switchBusiness(id) {
                $("#overlay").style.display = "flex";
                let jobs;
                if (id==332) {
                    jobs = await app.fetchJobs();
                } else {
                    jobs = await app.getBusinessJobs(id);
                }
                $("#overlay").style.display = "none";
            },
            checkAll() {
                let checked = (document.querySelector("#all-jobs").checked);
                if (checked) {
                    document.querySelectorAll(".job-select").forEach(el => {
                        el.setAttribute("checked", true);
                        el.checked = true;
                    });
                } else {
                    document.querySelectorAll(".job-select").forEach(el => {
                        el.removeAttribute("checked");
                        el.checked = false;
                    });

                }
            },
            async getMasterInvoice(id) {
                let out;

                // First check if we have the job in memory
                app.masterInvoice.forEach(inv => {
                    if (inv && inv.invID == id) out = inv;
                });

                // If not, check the general app.cache
                if (!out) {
                    if (app.cache[`InvoiceParent_${id}`]) {
                        return app.cache[`InvoiceParent_${id}`];
                    }

                    // Otherwise, fetch it from the server and save for later
                    console.log(`Fetching InvoiceParent ID ${id}`);
                    const rawResponse = await fetch(`/portal/api.php?type=getMasterInvoice&id=${id}`);
                    out = await rawResponse.json();
                    app.masterInvoice.push(out);
                    app.cache[`InvoiceParent_${id}`] = out;
                }
                return out;
            },
            async getBusinessJobs(id) {
                console.log(`Fetching jobs for business id ${id}`);
                let startdate = $("#startdate").value;
                let enddate = $("#enddate").value;
                let query = '';
                if (startdate) {
                    query += "&start=" + encodeURIComponent(startdate);
                }
                if (enddate) {
                    query += "&end=" + encodeURIComponent(enddate);
                }
                const rawResponse = await fetch(`/portal/api.php?type=getBusinessJobs&bid=${id}${query}`);
                out = await rawResponse.json();
                console.log("results for getBusinessJobs for id " + id);
                console.dir(out);
                app.jobs = out;
                app.currentJobs = out;
                app.renderJobs(app.currentJobs);
                
                return out;
            },
            // get Job by id using any means possible
            async getJob(id) {
                let out;

                // First check if we have the job in memory
                for (const job of app.jobs) {
                    if (job && job.JobID == id) return job;
                }

                // If not, check the general app.cache
                if (!out) {
                    if (app.cache[`Job_${id}`]) {
                        return app.cache[`Job_${id}`];
                    }

                    // Otherwise, fetch it from the server and save for later
                    console.log(`Fetching job id ${id}`);
                    const rawResponse = await fetch(`/portal/api.php?type=getJob&id=${id}`);
                    out = await rawResponse.json();
                    app.jobs.push(out);
                    app.cache[`Job_${id}`] = out;
                }
                return out;
            },
            addPayment() {
                let selected = $$(".job-select:checked");
                let ids = [];

                if (selected) {
                    selected.forEach((item) => {
                        ids.push(item.id.replace(/^\D*/g, ''));

                    });
                    $("#pay-ids").innerHTML = ids.join(", ");
                    let bn = "";
                    app.jobs.forEach(job => {
                        if (job && job.JobID == ids[0]) {
                            bn = job.Business;
                        }
                    });
                    $("#pay-business").innerHTML = bn;
                    $("#payment").showModal();
                }
            },
            savePayment() {
                let amt = $("#amount").value;
                let notes = $("#Notes").value;

                /**
                 * TODO: Need to iterate over selected jobs/invoices 
                 *       and apply payment value to their balances.
                 *       If more than one job is selected, balance is applied
                 *       to each job in the order they are displayed
                 *       potentially leaving some checked jobs without any
                 *       change to their balance. The idea is to be able to
                 *       receive a check for many jobs and apply its 
                 *       value to invoice balance (accounts payable)
                 *       this payment can be done at any time before or 
                 *       after the trip has been complteted, preferably 
                 *       before.
                 *
                 *      So build up a simple update object for job invoices
                 *      with adjusted balances as well as a new Receivable 
                 *      record with the payment notes and amount and BusinessID, etc
                 */
                let out = {};

                let sel = $$(".job-select:checked");
                if (sel) {
                    sel.forEach(item => {
                        let id = item.closest("tr")?.id.replace(/^\D*/g, '');

                    });
                }
                //fetch("/grid/ctl.php
            },
            makePageNav(jobs, curpage) {
                let jobcnt = jobs.length;

                let totpages = Math.ceil(jobcnt / app.config.perpage);
                let pages = (totpages > 5) ? 5 : totpages;
                let start = curpage - 2;
                let perpage = app.config.perpage;

                if (start < 0) start = 0;

                let startrec = (curpage * parseInt(app.config.perpage)) + 1;
                let endrec = (curpage * parseInt(app.config.perpage)) + parseInt(app.config.perpage);
                if (endrec > jobcnt) endrec = jobcnt;

                let out = "";
                if (jobcnt > perpage) {
                    out += ` <label class='viewing'>Viewing: ${startrec}-${endrec}/${jobcnt} </label> `;
                    out += `<ul class="pagination pagination-sm float-right">`;

                    if (curpage > 0) {
                        out +=
                            `<li class="page-item"><a onclick="return app.goto(0, event);" class="page-link" href="?page=0">«</a></li>`;
                        out +=
                            `<li class="page-item"><a onclick="return app.goto(${Math.abs(curpage - 1)}, event);" class="page-link" href="?page=${Math.abs(curpage - 1)}">‹</a></li>`;
                    }
                    for (let i = start; i < start + pages; i++) {
                        if (i <= totpages) {
                            active = (curpage == i) ? " style='background:#ff0;' " : "";
                            out +=
                                `<li class="page-item"><a onclick="return app.goto(${i}, event);" class="page-link" ${active} href="?page=${i}">${i+1}</a></li>`;
                        }
                    }
                    // Add ... if we span any numbers, show if more than 5 pages
                    if (pages > 5) {
                        out +=
                            `<li class="page-item"><a onclick="return app.goto(${Math.ceil(jobcnt / perpage)}, event);" class="page-link" href="?page=${Math.ceil(jobcnt /perpage)}">...</a></li>`;
                        out +=
                            `<li class="page-item"><a onclick="return app.goto(${Math.ceil(jobcnt / perpage)}, event);" class="page-link" href="?page=${Math.ceil(jobcnt /perpage)}">${Math.ceil(jobcnt/perpage)}</a></li>`;
                    }
                    if (totpages > curpage) {
                        out +=
                            `<li class="page-item"><a onclick="return app.goto(${curpage + 1}, event);" class="page-link" href="?page=${curpage + 1}">›</a></li>`;
                        out +=
                            `<li class="page-item"><a onclick="return app.goto(${Math.ceil(jobcnt / perpage) - 1}, event);" class="page-link" href="?page=${Math.ceil(jobcnt / perpage) - 1}">»</a></li>`;
                    }
                } else {
                    out += ` <label class='viewing'>Viewing: 1-${jobcnt}</label> `;
                }
                $(".page-nav").innerHTML = out;
            },
            sumCurrentView() {
                let sum = 0;
                let quotesum = 0;
                app.currentJobs.forEach(job => {
                    if (job) {
                        if (job.related_Invoice && job.related_Invoice[0]) {
                            let val = parseInt(job.related_Invoice[0].Balance);
                            if (val && !isNaN(val)) {
                                sum += val;
                            }
                        } else if (job.QuoteAmount) {
                            let qval = parseInt(job.QuoteAmount);
                            if (qval && !isNaN(job.QuoteAmount)) {
                                quotesum += qval;
                            }
                        }
                    }
                });

                $("#quotesumlabel").innerHTML = "Uninvoiced (Quotes) Total";
                $("#quotesumtotal").innerHTML = new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD'
                }).format(quotesum);
                $("#sumlabel").innerHTML = "Total for Current View";
                $("#sumtotal").innerHTML = new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD'
                }).format(sum);
            },
            async showPastDue(lateness = 0) {
                $("#overlay").style.display = "flex";
                let overdue = [];
                let now = new Date().getTime();
                let invoices = await app.getInvoices();
                let myjobs = [];
                let sum = 0;
                $("#loading").innerHTML = `[1/${invoices.length}]`;
                if (invoices && invoices.length) {
                    for (var i = 0; i < invoices.length; i++) {
                        $("#loading").innerHTML = `[${i}/${invoices.length}]`;
                        let inv = invoices[i];
                        if (inv) {
                            let then = new Date(inv.InvoiceDate).getTime();
                            let elapsed = Math.floor(((((now - then) / 1000) / 60) / 60) / 24);

                            if (elapsed > lateness) {
                                if (inv.JobID) {
                                    let job = await app.getJob(inv.JobID);
                                    if (job) {
                                        job.related_Invoice = [inv];
                                        if ((job.InvoiceSatisfied == 0) && (job.NoInvoice == 0) && (job.JobCancelled == 0)) { 
                                            sum += inv.Balance;
                                            myjobs.push(job);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                app.pastdue = myjobs;
                app.currentJobs = myjobs;
                console.log("past due");
                console.dir(app.pastdue);
                await app.renderJobs(app.pastdue);

            },
            async renderJobs(jobs, page = 0) {
                if (!jobs) return;
                $("#overlay").style.display = "flex";
                let cnt;
                cnt = jobs.length;
                let perpage = (cnt < app.config.perpage) ? cnt : parseInt(app.config.perpage);
                let start = page * perpage;
                let end = parseInt(start) + parseInt(perpage);

                // buckets
                let allinvoices = [];
                let bucket = [];

                let idx = 0;
                let out = "";
                $("#loading").innerHTML = `[1/${perpage}]`;
                app.makePageNav(jobs, page);
                $(".viewing").innerHTML = `Viewing: ${start+1}-${end} / ${cnt}`;
                let now = new Date();
                for (let i = start; i < (start + perpage); i++) {
                    $("#loading").innerHTML = `[${idx}/${start+perpage}]`;
                    let row = jobs[i];
                    if (row && row.NoInvoice!=1) {
                        let status = '',
                            balance = 0,
                            noinvoice = 0,
                            toolurl = "https://dharristours.simpsf.com/clients/dharristours/templates/JobToPrint.php?z=" + btoa("ID=" + row.JobID) + "#Invoice";
                        let tmp, iid;
                        if (row) {
                            if ((row.InvoiceParentID !== undefined) && !app.body[row.InvoiceParentID]) {
                                app.body[row.InvoiceParentID] = document.createElement("tbody");
                                app.body[row.InvoiceParentID].dataset.pid = row.InvoiceParentID;
                            }
                            row.Business = app.allbusiness[row.BusinessID].Business;
                            let invoicedate = new Date(row.JobDate);
                            let elapsed = Math.floor(((((now.getTime() - invoicedate.getTime()) / 1000) /
                                60) / 60) / 24);

                            let overdue = '';
                            if (elapsed > 30) {
                                overdue = `<span class='badge-danger'>PAST DUE ${elapsed - 30} DAYS</span>`;
                            }

                            if (row.related_Invoice) {
                                if ((row.related_Invoice[0].InvoiceSent == 1) && (row.related_Invoice[0]
                                        .Balance > 0)) {
                                    status += "<span class='badge bg-info'>INVOICE SENT</span>";
                                } else if (row.related_Invoice[0].Balance > 0 && elapsed > 30) {
                                    status +=
                                        `<span class='badge bg-danger'>${elapsed - 30} DAYS OVERDUE</span>`;
                                } else if (row.related_Invoice[0].Balance > 0) {
                                    status += "<span class='badge bg-warning'>INVOICE CREATED</span>";
                                    balance = row.related_Invoice[0].Balance;
                                }
                                if (row.related_Invoice[0].Balance == 0) {
                                    status += "<span class='badge bg-success'>PAID</span>";
                                }
                                balance = row.related_Invoice[0].Balance;
                            } else {
                                status = "<span class='badge bg-danger'>NO INVOICE</span>";
                                balance = row.QuoteAmount;
                                noinvoice = 1;
                            }
                            let noinv, currentpid, pid, hasBalance, date, stats, due;

                            if (balance || noinvoice) {
                                hasBalance = (row.related_Invoice && row.related_Invoice[0] && row
                                    .related_Invoice[0].Balance) ? 'hasBalance' : 'noBalance';
                                noinv = (noinvoice) ? "no-invoice" : "has-invoice";

                                pid = (row.related_Invoice && row.related_Invoice[0] && row.related_Invoice[
                                    0].InvoiceParentID) ? row.related_Invoice[0].InvoiceParentID : 0;
                                iid = (row.related_Invoice && row.related_Invoice[0] && row.related_Invoice[
                                    0].InvoiceID) ? row.related_Invoice[0].InvoiceID : 0;
                                date = new Date(row.JobDate).toISOString().substring(0, 10);


                                // Separate items with parentid into their own tbody's
                                let mstatus = "";
                                if (pid && (!app.body[pid]) && (pid != 0)) {
                                    stats = await app.getParentInfo(pid);

                                    if (stats.date) {
                                        pdate = new Date(stats.date).toISOString().substring(0, 10);
                                    }
                                    if (stats.total == 0) {
                                        mstatus = "<span class='badge bg-success'>PAID</span>";
                                    } else if (overdue) {
                                        mstatus = overdue;
                                    } else {
                                        mstatus = "<span class='badge bg-warning'>HAS INVOICES</span>";
                                    }
                                    due = stats.total;
                                    currentpid = pid;
                                    let masterurl = "https://dharristours.simpsf.com/clients/dharristours/templates/JobToPrint.php?z=" + btoa("ID=" + row.JobID) + "#MasterInvoice";
                                    let mtr = document.createElement("tr");
                                    mtr.className = `parent ${hasBalance}`;
                                    mtr.dataset.pid = pid;

                                    tmp = `
                                    <td><a href="#" class='toggle closed' onclick="this.classList.toggle('closed');app.toggleGroup(${pid});return false;">▶</a></td>
                                    <td>${pid}</td>
                                    <td></td>
                                    <td><span data-bid="${row.BusinessID}" class="Business">${row.Business}</span></td>
                                    <td><span class="Job">Invoice Parent ID: ${pid} (${stats.count} Invoices)</span></td>
                                    <td>${pdate}</td>
                                    <td class='balance' id='balance_${pid}'>${app.formatCurrency(due)}</td>
                                    <td class='status' id='status_${pid}'>${mstatus}</td>
                                    <td><a href="/files/templates/InvoiceMaster.php?id=${pid}" onclick="app.showParent(${pid}); app.selectRow(event); return false;" target="_blank"><i class="fas fa-file-invoice"></i> Master Invoice | <a href="${masterurl}" title="Invoice Tool" target="_blank"><i class="fa-solid fa-screwdriver-wrench"></i></a></a>
                                    </td>`;
                                    mtr.innerHTML = tmp;
                                    if (pid && !app.body[pid]) {
                                        app.body[pid] = document.createElement("tbody");
                                        app.body[pid].dataset.pid = pid; 
                                    }
                                    if (pid) app.body[pid].append(mtr);
                                }

                                let tr = document.createElement("tr");
                                // Markup for each row of invoice data
                                let xtra = (pid && pid !== "0") ? " hidden child" : "";
                                let showpid = (pid) ? pid : "";
                                due = balance;
                                row.Balance = due;
                                idx++;
                                tr.id = `job_${row.JobID}`;
                                tr.dataset.index = idx;
                                tr.dataset.parent = pid;
                                tr.dataset.jobid = row.JobID;
                                tr.dataset.businessid = row.BusinessID;
                                tr.dataset.invoiceid = iid;
                                tr.className = `${hasBalance} ${noinv} ${xtra}`;

                                tmp = `<td><input type='checkbox' onclick="app.doCheckbox(event)" id='job_${row.JobID}' class='job-select'></td><td class="InvID">${iid}</td><td>${row.JobID}</td><td><span class="Business">${row.Business}</span></td><td><span class="Job">${row.Job}</span></td><td>${date}</td><td class="balance">${app.formatCurrency(due)}</td><td class="status">${status}</td>`;

                                toolurl = "https://dharristours.simpsf.com/clients/dharristours/templates/JobToPrint.php?z=" + btoa("ID=" + row.JobID) + "#Invoice";

                                if (!noinvoice) {
                                    let url = "/files/templates/print/InvoiceReport.php?z=" + btoa( `ID=${iid}`);
                                    tmp +=
                                        `<td class='rowlinks'><a target='_blank' title="View Invoice" onclick='app.show("${url}", "Invoice ${iid}");app.selectRow(event);return false;' href='${url}'><i class='fa-solid fa-eye'></i> Invoice</a> | <a href='#' title="View Job" onclick='app.showJob(${row.JobID});return false;'><i class='fas fa-bus'></i> Job</a> | <a href="${toolurl}" target="_blank"><i class="fa-solid fa-screwdriver-wrench"></i></a></td>`;
                                } else {
                                    tmp +=
                                        `<td class='rowlinks'><a target='invoice' title="Create Invoice" href='/files/invoices/${pid}.pdf' onclick='app.makeInvoice("${row.JobID}");return false;'><i class='fa-solid fa-file-invoice'></i> Invoice</a> | <a href='#' title="View Job" onclick='app.showJob(${row.JobID});return false;'><i class='fas fa-bus'></i> Job</a> | <a href="${toolurl}" title="Invoice Tool" target="_blank"><i class="fa-solid fa-screwdriver-wrench"></i></a></td>`;
                                }
                                tr.innerHTML = tmp;
                                if (!pid) pid = 0;
                                if (!app.body[pid]) {
                                    app.body[pid] = document.createElement("tbody");
                                    app.body[pid].dataset.pid = pid;
                                }
                                app.body[pid].append(tr);
                            }
                        }
                    }
                }
                //print out;
                $$("#jobs tbody").forEach(el => {
                    el.parentElement.removeChild(el);
                });
                if (app.body) {
                    out = "";
                    for (const tbody of app.body) {
                        $("#jobs").append(tbody);
                    }
                }
                $("#overlay").style.display = "none";
                app.sumCurrentView();
                app.body = [];

            },
            makeInvoice(id) {
                let job_ids = [];
                if (id) job_ids.push(id);

                $$("input[type='checkbox']:checked").forEach(el => {
                    if (el.id.match(/^job_/)) {
                        let job_id = el.id.replace(/^job_/i, '');
                        job_ids.push(job_id);
                    }
                    el.checked = false;
                });
                console.log(`makeInvoice: making invoices for jobs: ${job_ids.join(',')}`);
                fetch("/files/templates/JobToPrint.php?x=massinvoice&JobIDs=" + JSON.stringify(
                    job_ids)).then(r => r.json()).then(data => {
                    console.log("JobToPrint massinvoice results:");
                    console.dir(data);
                    if (data.results && data._ids) {
                        data._ids.forEach(obj => {
                            let row = $(`#job_${obj.JobID}`);
                            if (row) {
                                let rowlinks = row.querySelector(".rowlinks");
                                if (rowlinks) {
                                    let url =
                                        "/files/templates/print/InvoiceReport.php?z=" +
                                        btoa(`ID=${obj.InvoiceID}`);
                                    rowlinks.innerHTML =
                                        `<a target='_blank' onclick='app.show(\"${url}\", \"Invoice ${obj.InvoiceID}");app.selectRow(event);return false;' href='${url}'><i class='fa-solid fa-eye'></i> Invoice</a> | <a href='showJob?id=${obj.JobID}' onclick='app.showJob(${obj.JobID});return false;'><i class='fas fa-bus'></i> Job</a> | <a href="${toolurl}" target="_blank"><i class="fa-solid fa-screwdriver-wrench"></i></a>`;
                                }
                                let rowstatus = row.querySelector(".status");
                                if (rowstatus) {
                                    rowstatus.innerHTML =
                                        "<span class='badge bg-warning'>INVOICE CREATED</span>";
                                }
                                let invid = row.querySelector(".InvID");
                                if (invid) {
                                    invid.innerHTML = obj.InvoiceID;
                                }
                            }
                        });

                        let s = (data.results.length > 1) ? 's' : '';
                        setTimeout(function() {
                            alert(
                                `${data.results.length} invoice${s} processed:\n\t${data.results.join("\n\t")}\n`
                            );
                        }, 10);
                    }
                    $(".selected")?.classList.remove("selected");
                });
            },
            newMasterInvoice() {
                let ids = [],
                    job_ids = [];
                $$("input[type='checkbox']:checked").forEach(el => {
                    let job_id = el.id.replace(/^job_/i, '');
                    let job = app.jobs.find(function(el) {
                        if (el) {
                            return el.JobID == job_id;
                        } else {
                            return false;
                        }
                    });
                    if (job) {
                        job_ids.push(job.JobID);
                        if (job && job.related_Invoice) {
                            ids.push(job.related_Invoice[0].InvoiceID);
                        }
                    }
                });
                console.log(`job ids: `);
                console.dir(ids);
                let tmpjob = app.getJob(job_ids[0]);
                let bid;
                if (tmpjob) {
                    bid = tmpjob.BusinessID;
                }

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

                ids.forEach(id => {
                    obj.InvoiceParent['new1'].Invoice[id] = {
                        InvoiceID: id
                    }
                });

                (async () => {
                    const rawResponse = await fetch(
                        '/grid/ctl.php?x=save&rsc=InvoiceParent&json2=true', {
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
                    let mid = content.id;
                    let upd = {
                        Invoice: []
                    };
                    ids.forEach(inv_id => {
                        upd.Invoice[inv_id] = {
                            InvoiceID: inv_id
                        };
                        upd.Invoice[inv_id].InvoiceParentID = newid;
                    });
                    const newResponse = await fetch(
                        "/grid/ctl.php?x=save&rsc=Invoice&json2=true", {
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

                    alert(`New Master Invoice ID ${mid} created`);
                    location.reload();
                })();
            },
            goto(page, event) {
                if (event) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                app.renderJobs(app.currentJobs, page);

                return false;
            },
            doSort(evt) {
                console.log("doSort");
                console.dir(evt);
                $("#overlay").style.display = "flex";
                $("#loading").innerHTML = `Sorting ${app.currentJobs.length} Job records.<br>Please be patient...`;
                $(".loading").classList.add("run");
                let tgt = evt.target;
                let th = evt.target.closest("th");
                if (tgt.dataset.name) {
                    let sortBy = tgt.dataset.name;
                    let typ = th.dataset.type ? th.dataset.type : 'string';

                    if (app.state.sort == sortBy) {
                        app.state.sortDir ^= 1;
                    }
                    $(`.sort`).classList.remove(`sort`);
                    app.state.sort = sortBy;
                    th.classList.add(`sort`);
                    
                    if (typ === "string") {
                        app.currentJobs.sort((a, b) => {
                            if (a && b) {
                                if (a[sortBy].toLowerCase().replace(/\W/g, '') < b[sortBy]
                                    .toLowerCase().replace(/\W/g, '')) {
                                    return -1;
                                } else if (a[sortBy].toLowerCase().replace(/\W/g, '') > b[
                                        sortBy].toLowerCase().replace(/\W/g, '')) {
                                    return 1;
                                } else {
                                    return 0;
                                }
                            } else if (a === b) {
                                return 0;
                            } else if (a === null) {
                                return -1;
                            } else if (b === null) {
                                return 1;
                            } else {
                                return 0;
                            }
                        });
                    } else if (typ === 'numeric') {
                        app.currentJobs.sort((a, b) => {
                            if (a && b) {
                                return parseInt(a[sortBy]) - parseInt(b[sortBy]);
                            } else if (a === null) {
                                return -1;
                            } else if (b === null) {
                                return 1;
                            }
                            return 0;
                        });
                    } else if (typ === 'date') {
                        app.currentJobs.sort((a, b) => {
                            if (a && b) {
                                return ((new Date(a.JobDate).getTime()) - (new Date(b.JobDate).getTime()))
                            } else {
                                return 0;
                            }
                        });

                    } else if (typ === "business") {
                        app.currentJobs.sort((a, b) => {
                            if (a && b) {
                                if (!a.Business) a.Business = app.allbusiness[a.BusinessID]
                                    .Business || "";
                                if (!b.Business) b.Business = app.allbusiness[b.BusinessID]
                                    .Business || "";
                                a.Business = a.Business.toLowerCase().replace(/\W/g, '');
                                b.Business = b.Business.toLowerCase().replace(/\W/g, '');
                                if (a.Business < b.Business) {
                                    return -1;
                                } else if (a.Business > b.Business) {
                                    return 1;
                                } else {
                                    return 0;
                                }
                            } else {
                                return 0;
                            }
                        });
                    }
                    if (app.state.sortDir) {
                        app.currentJobs.reverse();
                    }
                    setTimeout(function() {
                        $(`.sort > span.sorticon`).style.transform =
                            `rotateX(${app.state.sortDir * 180}deg)`;
                    }, 10);
                    app.renderJobs(app.currentJobs);
                }
                $(".loading").classList.remove("run");
            },
            cache: {

            },
            async getInvoices() {
                let cond = encodeURIComponent("Balance > 0");
                const rawResponse = await fetch(
                    `/portal/api.php?type=getInvoices&cond=${cond}`);
                const content = await rawResponse.json();
                app.invoices = content;

                return content;
            },
            async getParentInfo(pid) {
                if (pid !== 0) {
                    if (!app.cache[pid]) {
                        const rawResponse = await fetch(
                            '/portal/api.php?type=sumInvoices&pid=' + pid);
                        const content = await rawResponse.json();
                        app.cache[pid] = content;
                        return content;
                    } else {
                        return app.cache[pid];
                    }
                }
            },
            viewMasterInvoice(id) {
                if (app.state.masterInvoiceID) {
                    let url = "InvoiceMaster.php?id=" + app.state.masterInvoiceID;
                    window.open(url, "masterinvoice");

                }
            },
            showMasterInvoices() {
                let out = [];
                for (let i = 0; i < app.jobs.length; i++) {
                    if (app.jobs[i] && app.jobs[i].related_Invoice && app.jobs[i]
                        .related_Invoice[0].InvoiceParentID > 0) {
                        out.push(JSON.parse(JSON.stringify(app.jobs[i])));
                    }
                }
                app.currentJobs = out;
                app.currentJobs.sort((a, b) => {
                    if (a.related_Invoice[0].InvoiceParentID < b.related_Invoice[0]
                        .InvoiceParentID) {
                        return -1;
                    } else if (a.related_Invoice[0].InvoiceParentID > b
                        .related_Invoice[0].InvoiceParentID) {
                        return 1;
                    } else {
                        return 0;
                    }
                });
                console.log("showMasterInvoices");
                console.dir(app.currentJobs);

                app.renderJobs(app.currentJobs);
            },
            changeCount(num) {
                if (num == "all") {
                    num = 1000000;
                }
                app.storeConfig("count", num);
                app.config.perpage = num;
                app.renderJobs(app.currentJobs, 0);

                //window.location.href = window.location.origin + location.pathname +'?count=' + num;    
            },
            async selectInvoiceReport(id) {
                $$("input[type='checkbox']:checked").forEach(el => el.removeAttribute(
                    'checked'));
                //$$("tr").forEach(el=>el.style.display = 'none');
                let report = app.invoiceReports.find(function(el) {
                    if (el) {
                        return (el.InvoiceParentID == id);
                    } else {
                        return false;
                    }
                });

                if (!report) {
                    report = await app.getMasterInvoice(id);
                }
                if (report) {
                    let ids = report.InvoiceIDs.split(/\,/);
                    let job_ids = report.JobIDs.split(/\,/);
                    let newlist = [];
                    if (job_ids) {
                        for (const item of job_ids) {
                            let job = await app.getJob(item);
                            if (job) {
                                newlist.push(job);
                            }
                            /* let el = $(`#job_${item}`);
                            if (el) {
                                el.setAttribute("checked", true);
                                el.closest("tr").style.display = "table-row";
                            }
                            */
                        }
                        app.jobs = newlist;
                        app.data.Job = {
                            Job: newlist
                        };
                        app.renderJobs(app.jobs);
                    }
                } else {

                }
                $("#view").selectedIndex = 1;
                app.state.masterInvoiceID = id;
            },
            state: {
                sort: "JobDate",
                sortDir: 0
            },
            toggleGroup(pid) {
                $$(`tr[data-parent='${pid}']`).forEach(el => {
                    el.classList.toggle("hidden");
                });
            },
            businessID: '<?php print $busID; ?>',
            businessName: '<?php print $mybusiness->Business; ?>',
            allbusiness: <?php print json_encode($allbusiness); ?>,
            masterInvoice: [],
            invoiceReports: [],
            //        invoices: <?php print json_encode($invoices); ?>,
            data: {}
            <?php
            //print json_encode($jobs);
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
?>
