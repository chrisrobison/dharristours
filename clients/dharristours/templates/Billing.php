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
        background-color: #eee;
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
        height: 2em;
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

    dialog#email-dialog {
        width: 40vw;
        padding: 0;
        font-size: 18px;
        background: #eee;
    }

     dialog#payment {
        width: 40vw;
        padding: 0;
        font-size: 18px;
        background: #eee;
    }

    dialog label {
        width: 8rem;
        text-align: right;
    }
    dialog#email-dialog label {
        width: 7rem;
        padding-right: 1rem;
    }
    dialog#email-dialog select, dialog#email-dialog input {
        width: 23rem;
    }
    dialog#email-dialog textarea, #email-dialog input {
        font-weight: 300;
    }
    textarea::placeholder, input::placeholder {
        color: #ccc;
        font-style: italic;
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
        color: #222;
    }
    .dialog-body input {
        background-color: #fff;
    }
    .dialog-body label {
        color: #222;
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
    #pay-business {
        padding-left: 1em;
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
                                                <option value="all">All (Paid + Unpaid)</option>
                                                <option value="no-invoice">No Invoice</option>
                                                <option value="invoice-created">Invoice Created</option>
                                                <option value="invoice-sent">Invoice Sent</option>
                                                <option value="overdue">Unpaid Invoices</option>
                                                <option value="overdue30">30+ Days Overdue</option>
                                                <option value="overdue60">60+ Days Overdue</option>
                                                <option value="overdue90">90+ Days Overdue</option>
                                                <option value="paid">Paid Invoices</option>
                                                <option value="onlymaster">Master Invoices Only</option>
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
        $cond = "JobCancelled=0 and JobDate>'{$from2023}' AND NoInvoice=0 AND InvoiceSatisfied=0 AND BusinessID!='332' $xtra ORDER BY JobDate DESC"; 

    } else {
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
                                                    <th data-name="InvoiceID" data-type="numeric"><span data-name="InvoiceID" class="sorticon"></span> InvID</th>
                                                    <th data-name="JobID" data-type="numeric"><span data-name="JobID" class="sorticon"></span> JobID</th>
                                                    <th data-name="Business" data-type="business"><span data-name="Business" class="sorticon"></span> Business</th>
                                                    <th data-name="Job"><span data-name="Job" class="sorticon"></span> Job</th>
                                                    <th class="sort sort0" data-name="JobDate" data-type="date"><span data-name="JobDate" class="sorticon"></span> Date</th>
                                                    <th data-name="Balance" data-type="numeric"><span data-name="Balance" class="sorticon"></span> Balance</th>
                                                    <th data-name="Status"><span data-name="Status" data-type="string" class="sorticon"></span> Status</th>
                                                    <th></th>
                                                </tr>
                                                <tr id="searchbar">
                                                    <th><a href="#" onclick="app.toggleSearch(true);return false;">x</a></th>
                                                    <th class="searchField"><input type="text" class="InvoiceID" id="search-InvoiceID" width="5" style="width:3rem;" data-field="InvoiceID" oninput="app.filter(event, 'InvoiceID')"></th>
                                                    <th class="searchField"><input type="text" class="InvoiceID" id="search-JobID" width="5" style="width:3rem;" data-field="JobID" oninput="app.filter(event, 'JobID')"></th>
                                                    <th class="searchField"><input type="text" class="search-Business" id="search-Business" data-field="Business" oninput="app.filter(event, 'Business')"></th>
                                                    <th class="searchField"><input type="text" class="search-Job" id="search-Job" data-field="Job" oninput="app.filter(event, 'Job')"></th>
                                                    <th class="searchField"><input type="text" class="search-JobDate" id="search-JobDate" style="width:4rem;" data-field="JobDate" oninput="app.filter(event, 'JobDate')"></th>
                                                    <th class="searchField"><input type="text" class="search-Balance" id="search-Balance" style="width:4rem;" data-field="Balance" oninput="app.filter(event, 'Balance')"></th>
                                                    <th class="searchField"><input type="text" class="search-Status" id="search-Status" style="width:4rem;" data-field="Status" oninput="app.filter(event, 'Status')"></th>
                                                    <th data-field=""></th>
                                                </tr>
                                            </thead>
                                            <tbody id="placeholder"></tbody>
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
        <dialog id="email-dialog">
            <header><span>Send Email</span><a style="display:flex;align-items:center;justify-content:center;padding-bottom:3px;background:#eee;color:#000;border-radius:50%;height:1rem;width:1rem;" class='close-btn' href="#" onclick="document.querySelector('#email-dialog').close();return false;">⨯</a></header>
            <div class="dialog-body">
                <form method="dialog">
                    <div class="form-row" style="display:flex;justify-content:space-around;">
                        <div>Job ID: <span id="email-ids"></span></div>
                        <div>Invoice ID: <span id="email-invoice"></span></div>
                    </div>
                    <div class="form-row">for &nbsp; <span id="email-business"></span></div>
                    <hr>
                    <div class="form-row"><label for="email-document">Document</label> 
                        <select style="background-color:#fff;" id="email-document" name="email-document">
                            <option value="invoice">Invoice</option>
                            <option value="receipt">Payment Receipt</option>
                            <option value="reminder30">30-Day Reminder</option>
                            <option value="reminder60">60-Day Reminder</option>
                            <option value="reminder90">90-Day Reminder</option>
                            <option value="collections">Collections Notification</option>
                        </select>
                    </div>
                    <div class="form-row"><label for="email-to">Send to</label> <input type="text" id="email-to" name="email-to" placeholder="Email Recipient" ></div>
                    <div class="form-row"><label for="email-msg">Message</label> <textarea id="email-msg" name="email-msg" placeholder="A note to send along with the document" style="width:23rem;height:5rem;"></textarea></div>
                </form>
            </div>
            <div class="dialog-foot">
                <div><button onclick="app.previewMessage()"><i class="fa-solid fa-eye"></i> Preview Message</button></div>
                <div>
                    <button onclick="document.querySelector('#email-dialog').close();return false;">Cancel</button>&nbsp;
                    <button onclick="app.sendEmail();document.querySelector('#email-dialog').close();return false;">Send Email</button>
                </div>
            </div>
        </dialog>
        <dialog id="payment">
            <header><span>Receive Payment</span><a href="#"
                    onclick="document.querySelector('#payment').close();return false;">x</a></header>
            <div class="dialog-body">
                <form method="dialog">
                    <div class="form-row">Receive payment from: <span id="pay-business">BUSINESS</span></div>
                    <div class="form-row">for Job ID[s]: <span id="pay-ids"></span></div>
                    <div class="form-row">Total for Jobs: <span id="pay-amount"></span></div>
                    <div class='form-row'><label for="amount">Payment Amount $</label><input type="number" step="0.01" id="amount" name="amount" placeholder="0.00"></div>
                    <div class='form-row'><label for="checknum">Check / PO # </label><input type="text" id="checknum" name="checknum" ></div>
                    <div class='form-row'><label for="checkdate">Check / PO Date </label><input type="text" id="checkdate" name="checkdate" ></div>
                    <div class='form-row'><label for="Notes">Notes &nbsp;</label><textarea id="Notes" name="Notes"></textarea></div>
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
            <label id="sumlabel" style="width:fit-content;color:#333;padding:0;margin:0">Total Outstanding for Current View:</label>
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
    <script src="/lib/js/dom-to-image-more.min.js"></script>
    <script>
        allbusiness = <?php print json_encode($allbusiness); ?>;
    </script>
    <script src="/lib/js/billing.js"></script>
    <script>
        app.state.email = '<?= $_SESSION['Email'] ?>';
        app.state.name = '<?php print $_SESSION['LastName'].', '. $_SESSION['FirstName'] ?>';

        app.allbusiness = allbusiness;
        app.businessID = '<?php print $busID; ?>';
        app.businessName = '<?php print $mybusiness->Business; ?>';
    </script>
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
