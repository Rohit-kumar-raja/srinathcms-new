<?php
$page_no = "5";
$page_no_inside = "5_1";
include "./Backend/connection.inc.php";
$con = $connection;



// $_SESSION['emailid'] = 'rohit83015@gmail.com';
if (isset($_SESSION['emailid']) && ($_SESSION['emailid'] != '')) {
    $course_name = "SELECT * FROM `tbl_course` WHERE 1";
    $course_name_result = mysqli_query($connection, $course_name);
    $email = $_SESSION['emailid'];
  // showing the data if avaible in the database

  $user_data_query = "SELECT * FROM `tbl_prospectus` WHERE `mobile`='$email'";
  $propactus_details = mysqli_query($connection, $user_data_query);
  $row = mysqli_fetch_array($propactus_details);
  $prospectus_emailid = $row['prospectus_emailid'];
  // course details
//  
  // address details
   $status = $row['status'];

  $status_admission_query = "SELECT `stud_status` FROM `tbl_admission` WHERE `admission_emailid_student`='$prospectus_emailid'";
  $status_update_result = mysqli_query($connection, $status_admission_query);
  $row = mysqli_fetch_array($status_update_result);
  if ($row['stud_status'] != 1) {
?>
    <!DOCTYPE html>
    <html>

    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>SRINATH UNIVERSITY | Admission Attachment Form </title>
      <link rel="icon" href="images/logo.png" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <?php include './srinath.inc/foot.php'; ?>
      <?php include './srinath.inc/head.php'; ?>
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

      <link rel="stylesheet" href="./srinath/dist/css/adminlte.min.css">
      <!-- Google Font: Source Sans Pro -->
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
      <link rel="stylesheet" href="./asset/css/admission.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <?php include './srinath.inc/header.php'; ?>

    <body class="hold-transition sidebar-mini">
          <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Admission Form Attachments</h1>
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
              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Documents Required For Admission</h3>
                </div>

                <form role="form" method="POST" id="add_admission_form" enctype="multipart/form-data">
                  <div class="card-body table-responsive p-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-4">
                        <label>10th Marksheet<span class="text-danger">*</span><small class="text-danger">(Max 100KB)</small>  </label>
                        <input required type="file" accept="image/*" name="add_admission_tenth_marksheet" class="form-control">
                      </div>
                      <div class="col-4">
                        <label>10th Passing Certificate<span class="text-danger">*</span><small class="text-danger">(Max 100KB)</small>  </label>
                        <input type="file" accept="image/*" name="add_admission_tenth_passing_certificate" class="form-control">
                      </div>
                      <div class="col-4">
                        <label>12th Marksheet <small class="text-danger">(Max 100KB)</small> </label>
                        <input  type="file" accept="image/*" name="add_admission_twelve_markesheet" class="form-control">
                      </div>

                      <div class="col-4">
                        <label>12th Passing Certificate <small class="text-danger">(Max 100KB)</small> </label>
                        <input type="file" accept="image/*" name="add_admission_twelve_passing_certificate" class="form-control">
                      </div>
                      <div class="col-4">
                        <label>Graduation Marksheet <small class="text-danger">(Max 100KB)</small> </label>
                        <input type="file" accept="image/*" name="add_admission_graduation_marksheet" class="form-control">
                      </div>
                      <div class="col-4">
                        <label>Recent Character Certificate <small class="text-danger">(Max 100KB)</small> </label>
                        <input type="file" accept="image/*" name="add_admission_recent_character_certificate" class="form-control">
                      </div>

                      <div class="col-4">
                        <label>Other Certificate (If applicable) <small class="text-danger">(Max 100KB)</small> </label>
                        <input type="file" accept="image/*" name="add_admission_other_certificate" class="form-control">
                      </div>
                      <div class="col-4">
                        <label>Character Certificate (If applicable) <small class="text-danger">(Max 100KB)</small> </label>
                        <input type="file" accept="image/*" name="add_admission_character_certificate" class="form-control">
                      </div>

                    </div>
                  </div>
                </div>
              </div>

              </div>
                </div>
              </div>
              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Decleration For Admission</h3>
                </div>

                <div class="card-body table-responsive p-0">
                  <div class="card-body">
                    <div class="row">

                      <div class="col-12">
                        <label>
                          <input required readonly type="checkbox" name="tandc" class="">
                          i have to accepts all the terms and conditions for taking the admission </label>
                      </div>


                    </div>
                  </div>
                </div>
              </div>



              <div class="col-md-12">
                <div id="loader_section"></div>
              </div>
              <div class="col-md-6">
                <!-- <input required required type="hidden" name="action" value="add_admission" /> -->
                <button type="submit" name="add_admission_button" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-primary">Reset</button>
              </div>
              </form>

            </div>
          </section>
          <!-- /.content -->
        </div>

        <?php include './srinath.inc/footer.php'; ?>

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
<?php
  } else {
    echo "<script>
  window.location.replace('./thankyou.php')
</script>";
  }
} else {
  echo "<script>
       window.location.replace('admission_login.php')
      
      </script>";
}
?>

<?php
// here i have to reicivig the data of the user from the from
if (isset($_POST['add_admission_button'])) {
  echo "<pre>";
  print_r($_FILES);
  //educational details of the student who is appling for the admisssion
  

  // here i have to storing the data of image in variable and sending the data into the database
  
  // $add_admission_tenth_marksheet = addslashes(file_get_contents($_FILES['add_admission_tenth_marksheet']['tmp_name']));

  // $add_admission_tenth_passing_certificate = addslashes(file_get_contents($_FILES['add_admission_tenth_passing_certificate']['tmp_name']));

  // $add_admission_twelve_markesheet = addslashes(file_get_contents($_FILES['add_admission_twelve_markesheet']['tmp_name']));

  // $add_admission_twelve_passing_certificate = addslashes(file_get_contents($_FILES['add_admission_twelve_passing_certificate']['tmp_name']));

  // $add_admission_graduation_marksheet = addslashes(file_get_contents($_FILES['add_admission_graduation_marksheet']['tmp_name']));

  // $add_admission_recent_character_certificate = addslashes(file_get_contents($_FILES['add_admission_recent_character_certificate']['tmp_name']));

  // $add_admission_other_certificate = addslashes(file_get_contents($_FILES['add_admission_other_certificate']['tmp_name']));

  // $add_admission_character_certificate = addslashes(file_get_contents($_FILES['add_admission_character_certificate']['tmp_name']));

  //$admission_query = "INSERT INTO `tbl_admission`(`admission_tenth_marksheet`, `admission_tenth_passing_certificate`, `admission_twelve_markesheet`, `admission_twelve_passing_certificate`, `admission_graduation_marksheet`, `admission_recent_character_certificate`, `admission_other_certificate`, `admission_character_certificate`) VALUES 
                                                // ('$add_admission_tenth_marksheet','$add_admission_tenth_passing_certificate','$add_admission_twelve_markesheet','$add_admission_twelve_passing_certificate','$add_admission_graduation_marksheet', '$add_admission_recent_character_certificate','$add_admission_other_certificate','$add_admission_character_certificate')";

 // $result = mysqli_query($connection, $admission_query);
// image update


  if(!empty($_FILES['add_admission_tenth_marksheet']['tmp_name'])){
   $add_admission_tenth_marksheet = addslashes(file_get_contents($_FILES['add_admission_tenth_marksheet']['tmp_name']));
  
  
  $update_admission_query1 = "UPDATE `tbl_admission` SET `admission_tenth_marksheet`='$add_admission_tenth_marksheet',`admission_tenth_marksheet`='$add_admission_tenth_marksheet' where  `admission_emailid_student`='$prospectus_emailid'";
  $update_admission_result1 = mysqli_query($con, $update_admission_query1);
  if ($update_admission_result1) {
  $msg="data update succesfully";
  }
  else{
  echo "data not be updated";
  }
  }
 
 
  if(!empty($_FILES['add_admission_tenth_passing_certificate']['tmp_name'])){
  $add_admission_tenth_passing_certificate = addslashes(file_get_contents($_FILES['add_admission_tenth_passing_certificate']['tmp_name'])); 
  
  
  $update_admission_query1 = "UPDATE `tbl_admission` SET `admission_tenth_passing_certificate`='$add_admission_tenth_passing_certificate',`admission_tenth_marksheet`='$add_admission_tenth_marksheet' where  `admission_emailid_student`='$prospectus_emailid'";
  $update_admission_result1 = mysqli_query($con, $update_admission_query1);
  if ($update_admission_result1) {
  $msg="data update succesfully";
  }
  else{
  echo "data not be updated";
  }
  }
  if(!empty($_FILES['add_admission_twelve_markesheet']['tmp_name'])){
  $add_admission_twelve_markesheet = addslashes(file_get_contents($_FILES['add_admission_twelve_markesheet']['tmp_name'])); 
  
  
  $update_admission_query1 = "UPDATE `tbl_admission` SET `admission_twelve_markesheet`='$add_admission_twelve_markesheet',`admission_tenth_marksheet`='$add_admission_tenth_marksheet' where  `admission_emailid_student`='$prospectus_emailid'";
  $update_admission_result1 = mysqli_query($con, $update_admission_query1);
  if ($update_admission_result1) {
  $msg="data update succesfully";
  }
  else{
  echo "data not be updated";
  }
  }
 
 
  if(!empty($_FILES['add_admission_twelve_passing_certificate']['tmp_name'])){
  $add_admission_twelve_passing_certificate = addslashes(file_get_contents($_FILES['add_admission_twelve_passing_certificate']['tmp_name']));
  
  
  $update_admission_query1 = "UPDATE `tbl_admission` SET `admission_twelve_passing_certificate`='$add_admission_twelve_passing_certificate',`admission_tenth_marksheet`='$add_admission_tenth_marksheet' where  `admission_emailid_student`='$prospectus_emailid'";
  $update_admission_result1 = mysqli_query($con, $update_admission_query1);
  if ($update_admission_result1) {
  $msg="data update succesfully";
  }
  else{
  echo "data not be updated";
  }
  }

  if(!empty($_FILES['add_admission_graduation_marksheet']['tmp_name'])){
  $add_admission_graduation_marksheet = addslashes(file_get_contents($_FILES['add_admission_graduation_marksheet']['tmp_name'])); 
    
  $update_admission_query1 = "UPDATE `tbl_admission` SET `admission_graduation_marksheet`='$add_admission_graduation_marksheet',`admission_tenth_marksheet`='$add_admission_tenth_marksheet' where  `admission_emailid_student`='$prospectus_emailid'";
  $update_admission_result1 = mysqli_query($con, $update_admission_query1);
  if ($update_admission_result1) {
  $msg="data update succesfully";
  }
  else{
  echo "data not be updated";
  }
  }
 
 
  if(!empty($_FILES['add_admission_recent_character_certificate']['tmp_name'])){
   $add_admission_recent_character_certificate = addslashes(file_get_contents($_FILES['add_admission_recent_character_certificate']['tmp_name'])); 
  
  
  $update_admission_query1 = "UPDATE `tbl_admission` SET `admission_recent_character_certificate`='$add_admission_recent_character_certificate',`admission_tenth_marksheet`='$add_admission_tenth_marksheet' where  `admission_emailid_student`='$prospectus_emailid'";
  $update_admission_result1 = mysqli_query($con, $update_admission_query1);
  if ($update_admission_result1) {
  $msg="data update succesfully";
  }
  else{
  echo "data not be updated";
  }
  }
  if(!empty($_FILES['add_admission_other_certificate']['tmp_name'])){
 $add_admission_other_certificate = addslashes(file_get_contents($_FILES['add_admission_other_certificate']['tmp_name']));
  
  
  $update_admission_query1 = "UPDATE `tbl_admission` SET `admission_other_certificate`='$add_admission_other_certificate',`admission_tenth_marksheet`='$add_admission_tenth_marksheet' where  `admission_emailid_student`='$prospectus_emailid'";
  $update_admission_result1 = mysqli_query($con, $update_admission_query1);
  if ($update_admission_result1) {
  $msg="data update succesfully";
  }
  else{
  echo "data not be updated";
  }
  }
 
 
  if(!empty($_FILES['add_admission_character_certificate']['tmp_name'])){
   $add_admission_character_certificate = addslashes(file_get_contents($_FILES['add_admission_character_certificate']['tmp_name'])); 
  
  
  $update_admission_query1 = "UPDATE `tbl_admission` SET `admission_character_certificate`='$add_admission_character_certificate',`admission_tenth_marksheet`='$add_admission_tenth_marksheet' where  `admission_emailid_student`='$prospectus_emailid'";
  $update_admission_result1 = mysqli_query($con, $update_admission_query1);
  if ($update_admission_result1) {
  $msg="data update succesfully";
  }
  else{
  echo "data not be updated";
  }
  }
 
  
  if ($msg !='') {
    $update_admission_query1 = "UPDATE `tbl_admission` SET `stud_status`='1' where  `admission_emailid_student`='$prospectus_emailid'";
  $update_admission_result1 = mysqli_query($con, $update_admission_query1);
    echo "<script>
    window.location.replace('./thankyou.php')
  </script>";
  }
}


?>