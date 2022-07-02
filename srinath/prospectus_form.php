<?php
include './framwork/main.php';
$page_no = "4";
$page_no_inside = "4_1";
include "include/authentication.php";
$id = $_GET['id'];
$url = 'prospectus_view';
$prospectus = "SELECT * FROM `tbl_prospectus` WHERE `id`=$id";
$prospectus_result = mysqli_query($con, $prospectus);
$row = mysqli_fetch_array($prospectus_result);
if (isset($_POST['prospectus_applicant_name'])) {
  $result = updateAll('tbl_prospectus', $_POST, '`id`=' . $id);
  if ($result == 'success') {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Data successfully updated.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <script>
  setTimeout(function() {  window.location.replace("' . $url . '") },1000);
  </script>
  ';
  } else {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Warning!</strong> ' . $result . '
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
 
  ';
  }
}

$explode_date = explode('-', $row['prospectus_session']);
if (strlen($explode_date[0]) > 5) {
  $start_year = explode('/', $explode_date[0])[2];
  $end_year = explode('/', $explode_date[1])[2];
  $start_year = $start_year;
  $end_year = $end_year;
} else {
  $start_year = $explode_date[0];
  $end_year = $explode_date[1];
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SRINATH UNIVERSITY | Prospectus </title>
  <link rel="icon" href="images/logo.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include 'include/navbar.php'; ?>
    <?php include 'include/aside.php'; ?>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Prospectus Form</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              </ol>
            </div>
          </div>
        </div>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <!-- SELECT2 EXAMPLE -->
          <div class="card card-default">


            <form role="form" action="" method="POST" id="prospectus_form">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12" id="error_section"></div>
                  <div class="col-4">

                    <label>Prospectus No.</label>
                    <input readonly type="text" value="<?php echo $row['prospectus_no'] ?>" id="prospectus_no" name="prospectus_no" class="form-control" required>
                  </div>
                  <div class="col-4">

                    <label>Prospectus Price </label>
                    <input readonly type="text" value="<?php echo $row['prospectus_rate'] ?>" id="prospectus_rate" name="prospectus_rate" class="form-control" required>
                  </div>

                  <div class="col-4">

                    <label> Payment mode </label>
                    <input readonly type="text" value="<?php echo $row['prospectus_payment_mode'] ?>" id="prospectus_payment_mode" name="prospectus_payment_mode" class="form-control" required>
                  </div>

                  <div class="col-4">
                    <label>Applicant Name</label>
                    <input type="text" value="<?php echo $row['prospectus_applicant_name'] ?>" id="prospectus_applicant_name" name="prospectus_applicant_name" class="form-control" required>
                  </div>

                  <div class="col-4">
                    <label>Gender</label>
                    <select id="prospectus_gender" name="prospectus_gender" class="form-control">
                      <option value="<?php echo $row['prospectus_gender'] ?>"><?php echo $row['prospectus_gender'] ?></option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>

                  <div class="col-4">
                    <label>Father Name</label>
                    <input type="text" value="<?php echo $row['prospectus_father_name'] ?>" id="prospectus_father_name" name="prospectus_father_name" class="form-control" required>
                  </div>

                  <div class="col-4">
                    <label>Mother Name</label>
                    <input type="text" value="<?php echo $row['prospectus_mother_name'] ?>" id="prospectus_mother_name" name="prospectus_mother_name" class="form-control" required>
                  </div>
                  <div class="col-4">
                    <label>Address</label>
                    <textarea id="prospectus_address" name="prospectus_address" class="form-control" style="height:38px;"><?php echo $row['prospectus_address'] ?></textarea>
                  </div>
                  <div class="col-4">
                    <label>Country</label>
                    <select id="prospectus_country" name="prospectus_country" class="form-control">
                      <option value="India">India</option>
                    </select>
                  </div>
                  <div class="col-4">
                    <label>State</label>
                    <input type="text" value="<?php echo $row['prospectus_state'] ?>" id="prospectus_state	" name="prospectus_state" class="form-control" required>

                  </div>
                  <div class="col-4">
                    <label>City</label>
                    <input type="text" value="<?php echo $row['prospectus_city'] ?>" id="prospectus_city" name="prospectus_city" class="form-control" required>
                  </div>

                  <div class="col-4">
                    <label>Postal Code</label>
                    <input value="<?php echo $row['prospectus_postal_code'] ?>" type="text" id="prospectus_postal_code" name="prospectus_postal_code" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>DOB</label>
                    <input value="<?php echo $row['prospectus_dob'] ?>" type="date" id="prospectus_dob" name="prospectus_dob" class="form-control" required>
                  </div>
                  <div class="col-4">
                    <label>Email ID</label>
                    <input value="<?php echo $row['prospectus_emailid'] ?>" type="email" id="prospectus_emailid" name="prospectus_emailid" class="form-control" required>
                  </div>


                  <div class="col-4">
                    <label>Mobile No</label>
                    <input value="<?php echo $row['mobile'] ?>" type="text" id="mobile" name="mobile" class="form-control" required>
                  </div>
                  <div class="col-4">
                    <label> Revert By</label>
                    <input value="<?php echo $row['revert_by'] ?>" type="text" id="revert_by" name="revert_by" class="form-control" required>
                  </div>

                  <div class="col-4">
                    <label>Course</label>
                    <select id="prospectus_course_name" name="prospectus_course_name" class="form-control">
                      <option value="<?php echo $row['prospectus_course_name'] ?>"><?php echo $row['prospectus_course_name'] ?></option>
                      <?php
                      $sql = "select * from tbl_course";
                      $query = mysqli_query($con, $sql);
                      while ($row2 = mysqli_fetch_array($query)) {
                      ?>
                        <option value="<?php echo $row2['course_name']; ?>"><?php echo $row2['course_name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-4">
                    <label> Session </label>
                    <select id="prospectus_session" name="prospectus_session" class="form-control">

                      <option value="<?php echo $start_year . '-' . $end_year; ?>"><?php echo $start_year . '-' . $end_year; ?>
                      <option>
                        <?php
                        $sql = "select * from tbl_university_details where 1";
                        $query = mysqli_query($con, $sql);
                        while ($row1 = mysqli_fetch_array($query)) {

                          $explode_date1 = explode('-', $row1['university_details_academic_start_date']);
                          $explode_date2 = explode('-', $row1['university_details_academic_end_date']);

                            $start_year = $explode_date1[0];
                            $end_year = $explode_date2[0];
                          


                        ?>
                      <option value="<?php echo $start_year . '-' . $end_year; ?>"><?php echo $start_year . '-' . $end_year; ?>
                      <option>
                      <?php } ?>
                    </select>
                  </div>


                </div>
                <div class="col-md-12">
                  <div id="loader_section"></div>
                </div>
                <div class="col-md-6 mt-4">
                  <input type="submit" id="prospectus_form_button" class="btn btn-primary" value="Submit">
                  <button type="reset" class="btn btn-primary">Reset</button>
                </div>
              </div>

            </form>
          </div>

        </div>
      </section>
      <!-- /.content -->
    </div>

    <?php include 'include/footer.php'; ?>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>

  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="plugins/select2/js/select2.full.min.js"></script>
  <!-- Bootstrap4 Duallistbox -->
  <script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
  <!-- InputMask -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
  <!-- date-range-picker -->
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap color picker -->
  <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Bootstrap Switch -->
  <script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- Page script -->

</body>

</html>