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

    $current = $boss->getObject("Login", $_SESSION['LoginID']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>D Harris Tours | My Account</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../assets/fontawesome-free-6.4.0-web/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/css/adminlte.min.css">
  <link rel="icon" href="/files/favicon.png">
  <style>
    section.content {
        padding-left: 1rem;
    }

  </style>
</head>
<body class="hold-transition sidebar-collapse iframe-mode">
<div class="wrapper">
<form onsubmit="return false;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Account</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="input_FirstName">First Name</label>
                <input type="text" id="input_FirstName" class="form-control" value="<?php print $current->FirstName; ?>">
              </div>
              <div class="form-group">
                <label for="input_LastName">Last Name</label>
                <input type="text" id="input_LastName" class="form-control" value="<?php print $current->LastName; ?>">
              </div>
              <div class="form-group">
                <label for="input_Phone">Phone</label>
                <input type="text" id="input_Phone" class="form-control" value="<?php print $current->Phone; ?>">
              </div>
              <div class="form-group">
                <label for="input_HomePhone">Alt. Phone</label>
                <input type="text" id="input_HomePhone" class="form-control" value="<?php print $current->HomePhone; ?>">
              </div>
              <div class="form-group">
                <label for="input_Email">Email</label>
                <input type="text" id="input_Email" class="form-control" value="<?php print $current->Email; ?>">
              </div>
              <div class="form-group">
                <label for="input_Email">Alt. Email</label>
                <input type="text" id="input_AltEmail" class="form-control" value="<?php print $current->AltEmail; ?>">
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <div class="row">
            <div class="col-12">
              <a href="#" class="btn btn-secondary">Cancel</a>
              <input onclick="return doSave(event);" type="submit" value="Save Changes" class="btn btn-success">
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  </form>
</div>
<!-- ./wrapper -->

<script src="/portal/assets/jquery/jquery.min.js"></script>
<script src="/portal/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/portal/assets/fontawesome-free-6.4.0-web/js/all.min.js"></script>
<script src="/portal/assets/js/adminlte.min.js"></script>
<script>
    function doSave(evt) {
        evt.stopPropagation();
        evt.preventDefault();
        let rec = {};
        document.querySelectorAll(".form-control").forEach(item=> {
            if (matches = item.id.match(/input_(.*)/)) {
                rec[matches[1]] = item.value;
            }
        });
        let out = { profile: rec};

        fetch("/portal/api.php?action=saveLogin&profile="+JSON.stringify(rec)).then(r=>r.json()).then(data=>{
            console.log(`saveProfile`);
            console.dir(data);
        });
        return false;
    }
</script>
</body>
</html>
