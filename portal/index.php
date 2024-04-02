<?php  if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="D Harris Tours">
    <link rel="apple-touch-icon" href="touch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/portal/assets/touch-icon-152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/portal/assets/touch-icon-180.png">
    <link rel="apple-touch-icon" sizes="167x167" href="/portal/assets/touch-icon-167.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/portal/assets/touch-icon-120.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/portal/assets/touch-icon-114.png">
      <link rel="apple-touch-icon" sizes="87x87" href="/portal/assets/touch-icon-87.png">
      <link rel="apple-touch-icon" sizes="80x80" href="/portal/assets/touch-icon-80.png">
    
    <title>D Harris Tours Customer Portal</title>
	
	<link rel="icon" type="image/png" href="/clients/dharristours/img/bus-logo-white.png" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/fontawesome-free-6.4.0-web/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="assets/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="/lib/css/bus-loader.css">
    <link rel="stylesheet" href="assets/css/notifications.css">
    <style>
    body {
        height:100vh;
        width: 100vw;
        overscroll-behavior: none;
        touch-action: none;
        overflow: hidden;
        position: fixed;
    }
    #overlay {
        position: absolute;
        z-index: 99999;
        top: 0px;
        left: 0px;
        height: 100vh;
        width: 100vw;
        background-color: #0002;
        display:none;
    }
    #loader {
        position: absolute;
        z-index: 99999;
        top: 50%;
        left: 50%;
    }
    #Business {
        width: 12em;
    }
    label {
        color: #eee;
    }
    .main-footer {
    }

    .navbar-nav[role=tablist] .nav-item {
        border-right: 1px solid #0006;
        border-left: 1px solid #fff6;
        background: #0002;
        border-top-left-radius: 1rem;
        position: relative;
        border-top-right-radius: 1rem;
        top: 0.6rem;
    }
    .navbar-nav[role=tablist] .nav-item.active {
        background: #f9f9f9;
        top: 5px;
        box-shadow: -2px 0px 2px #0003;
        z-index: 999;
    }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed" data-panel-auto-height-mode="height">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-black navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/portal/" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/portal/contact.html" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge notification-count"></span>
                    </a>
                    <div id="notificationList" class="dropdown-menu dropdown-menu-lg dropdown-menu-right ">
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">Notifications</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">5</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">5 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 3 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 2 new trips 
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/portal/" class="brand-link">
                <img src="/clients/dharristours/img/bus-logo.png" alt="Job Hunt Logo" class="brand-image" style="opacity: .8;filter:invert(1);">
                <span class="brand-text font-weight-light">D Harris Tours</span>

            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="flex-direction:column;">
                    <div style="display:flex;flex-direction:row;">
                        <div class="user" style="background:#ccc;color:#000;font-weight:bold;font-family:'Lexend',sans-serif;padding:0;display:flex;width:2em;height:2em;border-radius:50%;align-items:center;justify-content:center;margin-right:0.5rem;">
                        <!--img src="assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"-->
                       <?php print $_SESSION['Login']->FirstName[0] . $_SESSION['Login']->LastName[0]; ?> 
                        </div>
                        <a href="#" class="d-block"><?php print $_SESSION['Login']->FirstName." ".$_SESSION['Login']->LastName; ?></a>
                    </div>
                    <div class="info">
                        <?php
                            if ($_SESSION['Login']->Admin == 1) {
                               print '<label for="SwitchUser">Switch Login</label><br><select id="SwitchUser" onchange="app.switchUser(event, this.options[this.selectedIndex].value)">';
                               $logins = $boss->get("Login", "Active=1");
                               foreach ($logins as $login) {
                                    $sel = ($_SESSION['Login']->LoginID == $login->LoginID) ? " SELECTED" : "";

                                    print "<option value='{$login->Email}'$sel>{$login->LastName}, {$login->FirstName}</option>\n";
                               }
                               print "</select><br>";
                               print '<label for="Business">Business</label><br><select id="Business" onchange="app.override(this.options[this.selectedIndex].value)">';
                                
                                $businesses = $boss->get("Business", "1=1  ORDER BY Business");
                                foreach ($businesses as $business) {
                                    $selected = ($_SESSION['BusinessID'] == $business->BusinessID) ? " SELECTED" : "";
                                        
                                    print "<option value='{$business->BusinessID}'$selected>{$business->Business}</option>\n";
                                }

                                print '</select>';
                            } else if ($_SESSION['Login']->BusinessIDs) {
                                $bids = explode(",", $_SESSION['Login']->BusinessIDs);

                                if ($_SESSION['Login']->Admin == 1) {
                                    $sql = "";
                                } else {
                                    $sql = "BusinessID='" . implode("' OR BusinessID='", $bids) . "' ORDER BY Business";
                                }
                               print '<label for="Business">Business</label><br><select id="Business" onchange="app.override(this.options[this.selectedIndex].value)">';
                                $businesses = $boss->get("Business", "$sql");
                                foreach ($businesses as $business) {
                                    $selected = ($_SESSION['Login']->BusinessID == $business->BusinessID) ? " SELECTED" : "";
                                        
                                    print "<option value='{$business->BusinessID}'$selected>{$business->Business}</option>\n";
                                }

                                print '</select>';
                            }



                        ?>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav id='sidemenu' class="mt-2">
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="false">
            <div class="nav navbar navbar-expand navbar-white navbar-light border-bottom p-0">
                <!--a class="nav-link bg-light" href="#" data-widget="iframe-scrollleft"><i class="fas fa-angle-double-left"></i></a-->
                <ul class="navbar-nav" role="tablist">
                    <li class="nav-item active" role="presentation"><a class="nav-link active" data-toggle="row" id="tab-index" href="#panel-index" role="tab" aria-controls="panel-index" aria-selected="true">Home</a></li>
                </ul>
                <!--a class="nav-link bg-light" href="#" data-widget="iframe-scrollright"><i class="fas fa-angle-double-right"></i></a-->
                <a class="nav-link bg-light" href="#" data-widget="iframe-fullscreen"><i class="fas fa-expand"></i></a>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active show" id="panel-index" role="tabpanel" aria-labelledby="tab-index"><iframe id='home-iframe' src="home.php" style="height: 84vh;"></iframe></div>
                <div class="tab-empty">
                    <h2 class="display-4">No tab selected!</h2>
                </div>
                <div class="tab-loading">
                    <div>
                        <h2 class="display-4">Tab is loading <i class="fa fa-sync fa-spin"></i></h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
<div id="overlay"><div class="loader" id="loader"></div></div>
    <!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- jQuery UI 1.11.4 -->
    <!--script src="assets/jquery-ui/jquery-ui.min.js"></script-->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <!--script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

	<!-- overlayScrollbars -->
    <script src="assets/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
	<script src="assets/js/adminlte.min.js"></script>
    <script src="main.js"></script>
    <script src="assets/js/pages/notifications.js"></script>
    <script>
        app.init(app.getNav);
            document.querySelector("#overlay").style.display = "block";
            setTimeout(function() { document.querySelector("#overlay").style.display = "none"; }, 3000);
    </script>
</body>

</html>
