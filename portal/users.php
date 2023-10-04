<?php
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/.env');

    $in = $_REQUEST;
    $out = array();
    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>D Harris Tours Customer Portal</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="assets/fontawesome-free-6.4.0-web/css/all.min.css">
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
  <style>
    body { background: #333;}
    
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content" data-widget="iframe">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 style="color:#eee;text-transform:uppercase;font-weight:bold;" class="m-0">D Harris Tours<br>Employee Login</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <form oninput="return filterEmployees(event)" autocomplete="off">
                <div class="input-group">
                    <input id="search" type="search" class="form-control form-control-lg" placeholder="Start typing your name here" autocomplete="off">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-lg btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row" style="justify-content: space-evenly;">
        
<?php
    $sql = "SELECT * from Employee WHERE Active=1 AND LastName!='' ORDER BY LastName";
    $results = mysqli_query($link, $sql);
    $cnt = array();
    $cnt['male'] = 1;
    $cnt['female'] = 1;
    $emps = [];
    while ($row = mysqli_fetch_object($results)) {
        $pic = sprintf("{$row->Gender}_%02d", $cnt[$row->Gender]);
        $cnt[$row->Gender]++;
        $idname = $row->idname = preg_replace("/\W/", "", $row->LastName.$row->FirstName);
        $emps[] = $row;
        
        print <<<EOT
            <div id="{$idname}" class="card card-primary">
              <div class="card-header">
                <h5 class="m-0">{$row->LastName}, {$row->FirstName}</h5>
              </div>
              <div class="card-body" style="display:flex;">
                <div style="display:inline-block;width: 10rem;">
                    <img src="/portal/assets/profile_pics/{$pic}.svg" width="100">
                </div>
                <div style="display:inline-block;width: 10rem;">
                    <h2 class="card-title" style="font-size:2rem">{$row->LastName}, {$row->FirstName}</h2>
                    <p class="card-text">Phone: {$row->Phone}</p>
                    <a href="#" class="btn btn-primary">Login</a>
                </div>
              </div>
            </div>
EOT;
    }
?>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2023 <a href="https://www.simpsf.com">Simple Software, Inc.</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="assets/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>
<script>
    const employees = <?php print json_encode($emps); ?>;
    function filterEmployees(e) {
        let str = document.querySelector("#search").value;
        for (const employee of employees) {
           let name = employee.LastName + employee.FirstName;
           let re = new RegExp(str, "i");
           if (!name.match(re)) {
               document.querySelector(`#${employee.idname}`).style.display = "none";
           } else {
               document.querySelector(`#${employee.idname}`).style.display = "flex";
                
           }
        }
    }
</script>
</body>
</html>
