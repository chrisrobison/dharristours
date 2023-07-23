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
    $current = $boss->getObject("Business", $busID);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>D Harris Tours Customer Portal</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../assets/fontawesome-free-6.4.0-web/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/css/adminlte.min.css">
  <link rel="icon" href="/files/favicon.png">
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
              <li class="breadcrumb-item active">Profile</li>
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
                <label for="input_Business">Organization</label>
                <input type="text" id="input_Business" class="form-control" value="<?php print $current->Business; ?>">
              </div>
              <div class="form-group">
                <label for="input_Name">Contact Name</label>
                <input type="text" id="input_Name" class="form-control" value="<?php print $current->Contact; ?>">
              </div>
              <div class="form-group">
                <label for="input_Address">Address</label>
                <input type="text" id="input_Address1" class="form-control" value="<?php print $current->Address1; ?>">
              </div>
              <div class="form-group">
                <label for="input_Address">Address 2</label>
                <input type="text" id="input_Address2" class="form-control" value="<?php print $current->Address2; ?>">
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="input_City">City</label>
                    <input type="text" id="input_City" class="form-control" value="<?php print $current->City; ?>">
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="input_Phone">State</label>
                        <select class="form-control custom-select">
                          <option selected disabled>-Select One-</option>
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AS">American Samoa</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA" SELECTED>California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="DC">District Of Columbia</option>
                            <option value="FM">Federated States Of Micronesia</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="GU">Guam</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MH">Marshall Islands</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="MP">Northern Mariana Islands</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PW">Palau</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="PR">Puerto Rico</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VI">Virgin Islands</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming"</option>                        
                        </select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="input_Zip">Postal Code</label>
                    <input type="text" id="input_Zip" class="form-control" value="<?php print $current->Zip; ?>">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="input_Email">Email</label>
                <input type="text" id="input_Email" class="form-control" value="<?php print $current->Email; ?>">
              </div>
              <div class="form-group">
                <label for="input_Phone">Phone</label>
                <input type="text" id="input_Phone" class="form-control" value="<?php print $current->Phone; ?>">
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Settings</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputEstimatedBudget">Receive Notification Emails</label>
                <input type="checkbox" id="input_Notifications" class="form-control" checked>
              </div>
              <div class="form-group">
                <label for="input_Notes">Notes</label>
                <textarea id="input_Notes" class="form-control" rows="4"><?php print $current->Notes; ?></textarea>
              </div>
            </div>
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

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../assets/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/js/adminlte.min.js"></script>
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

        fetch("api.php?action=saveProfile&profile="+JSON.stringify(rec)).then(r=>r.json()).then(data=>{
            console.log(`saveProfile`);
            console.dir(data);
        });
        return false;
    }
</script>
</body>
</html>
