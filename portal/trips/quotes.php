<?php  
    if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php"); 
    
    $in = $_REQUEST;

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
  <title>D Harris Tours Customer Portal | Trips</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/css/adminlte.min.css">
  <style>
        table.table td {
            vertical-align: top;
        }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left:0px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quotes for <?php print $business->Business; ?></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <!--div class="card-header">
          <h3 class="card-title">Trip Quotes for <?php print $business->Business; ?></h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div-->
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th>ID</th>
                      <!--th>Date</th-->
                      <th>Trip Date</th>
                      <th>Origin</th>
                      <th>Destination</th>
                      <th>Pax</th>
                      <!--th>Pickup</th>
                      <th>Return</th-->
                      <th>Round Trip</th>
                      <th>ADA</th>
                  </tr>
              </thead>
              <tbody>
<?php
    $tpl = <<<EOT
<tr>
    <td data-id="{{RequestID}}" data-rsc="Request" data-field="RequestID">
      {{RequestID}}
    </td>
    <!--td>{{RequestDate}}</td-->
    <td>{{Date}}</td>
    <td><a>{{Pickup}}</a></td>
    <td><a>{{Destination}}</a></td>
    <td>{{Pax}}</td>
    <!--td>{{Start}}</td>
    <td>{{End}}</td-->
    <td style="text-align:center;"><input type='checkbox' data-id="{{RequestID}}" data-field="RoundTrip"{{RoundTrip}}></td>
    <td style="text-align:center;"><input type='checkbox' data-id="{{RequestID}}" data-field="ADA"{{ADA}}></td>

    <td class="project-actions text-right">
      <a class="btn btn-primary btn-sm" onclick="parent.$('.content-wrapper').IFrame('createTab', 'Quote {{RequestID}}', '/portal/trips/view-quote.php?id={{RequestID}}', 'view-quote', true); return false;" href="view-quote.php?id={{RequestID}}"><i class="fas fa-folder"></i> View</a>
    </td>
</tr>
EOT;

    $results = $boss->getObject("Request", "Completed!=1 AND BusinessID='{$busID}' ORDER BY RequestDate DESC");
   
    $cnt = count($results->Request);
    $out = "";
    for ($i=0; $i<$cnt; $i++) {
        $item = $results->Request[$i];

        if ($item) {
            $start = date("g:ia", strtotime($item->Start));
            $end = date("g:ia", strtotime($item->End));
            $item->Start = $start;
            $item->End = $end;
            $item->RoundTrip = ($item->RoundTrip) ? " CHECKED": "";
            $item->ADA = ($item->ADA) ? " CHECKED": "";
            $item->Date = date("M j", strtotime($item->Date)); 
            $item->RequestDate = date("M j", strtotime($item->RequestDate)); 
            $out .= preg_replace_callback("/\{\{(.+?)\}\}/s", function ($matches) {
                global $item;
                return $item->{$matches[1]};
            }, $tpl);
        }
    }
    print $out;
?>
                  <!--tr>
                      <td data-id="12" data-rsc="Request" data-field="RequestID">
                          12
                      </td>
                      <td><a>Ulloa Elementary, 2650 42nd Ave, SF</a></td>
                      <td><a>California State Capitol Museum</a></td>
                      <td>32</td>
                      <td>May 22, 2023</td>
                      <td>7:00am</td>
                      <td>5:30pm</td>
                      <td>Yes</td>
                      <td>No</td>
                      
                      <td class="project-actions text-right">
                          <a class="btn btn-primary btn-sm" href="view-job.html?id=12">
                              <i class="fas fa-folder">
                              </i>
                              View
                          </a>
                          <a class="btn btn-info btn-sm" href="edit-job.html?id=12">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          <a class="btn btn-danger btn-sm" href="delete-job.html?id=12">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </a>
                      </td>
                  </tr-->
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
<script>
(function() {
    app = {
        init: function() {

        },
        state: {

        }
    }
    window.app = app;
    app.init();
})();
</script>
</body>
</html>
