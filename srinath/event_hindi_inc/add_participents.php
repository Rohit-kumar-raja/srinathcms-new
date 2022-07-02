<?php 
    $page_no = "16";
    $page_no_inside = "16_1";
    include "include/authentication.php"; 
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SRINATH UNIVERSITY | हिन्दी महोत्सव </title>
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
              <h1>हिन्दी महोत्सव</h1>
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
            <div class="card-header">
              <h3 class="card-title">हिन्दी महोत्सव</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
              </div>
            </div>

            <form role="form" action="include/controller.php" method="POST" id="add_admission_form" enctype="multipart/form-data">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12" id="error_section"></div>
                  <div class="col-4">

               
                    <label>Registration No</label>
                    <input type="text" name="add_admission_id"  class="form-control">

                  </div>
                  <div class="col-4">
                    <label>Enter Prospectus No</label>
                    <input id="form_no" type="text" name="add_admission_form_no" class="form-control" required>
                  </div>
                  <div class="col-4">
                    <label>Admission No</label>
                    <input type="text" name="add_admission_no" class="form-control" value="" readonly placeholder="Generate By University">
                  </div>

                  <div class="col-4">
                    <label>Title</label>
                    <select name="add_admission_title" class="form-control">
                      <option value="0">Select</option>
                      <option value="Master">Master</option>
                      <option value="Miss">Miss</option>
                      <option value="Mr">Mr</option>
                      <option value="Mrs">Mrs</option>
                    </select>
                  </div>

                  <div class="col-4">
                    <label>Full Name</label>
                    <!-- <input id="first_name" type="hidden" name="add_admission_first_name" class="form-control" required> -->
                    <input id="first_name" type="text" name="add_admission_first_name" class="form-control" required>
                  </div>

                  <!-- <div class="col-4">
                    <label>Middle Name</label>
                    <input type="text" name="add_admission_middle_name" class="form-control">
                  </div> -->

                  <!-- <div class="col-4">
                    <label>Last Name</label>
                    <input id="last_name" type="text" name="add_admission_last_name" class="form-control">
                  </div> -->

                  <div class="col-4">
                    <label>Course</label>
                    <select id="course" name="add_admission_course_name" class="form-control" required>
                      <option value="0">Select Course</option>
          
                    </select>
                  </div>



                  <div class="col-4">
                    <label>Session</label>
                    <select id="session_check" class="form-control" name="add_admission_session">
                      <option value="0">Select Academic Year</option>
                
                    </select>
                  </div>
                  <div class="col-4">
                    <label>Date Of Birth</label>
                    <input id="dob" type="date" name="add_admission_dob" class="form-control" required>
                  </div>

                  <div class="col-4">
                    <label>Nationality</label>
                    <input type="text" name="add_admission_nationality" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>Aadhar No</label>
                    <input type="text" name="add_admission_aadhar_no" class="form-control">
                  </div>

                  <div class="col-4">
                    <label>Date Of Admission</label>
                    <input type="date" name="add_date_of_admission" class="form-control" value="<?php echo date("Y-m-d"); ?>">
                  </div>
                  <div class="col-4">
                    <label>Category</label>
                    <select name="add_admission_category" class="form-control">
                      <option value="0">Select</option>
                      <option value="General">General</option>
                      <option value="SC">SC</option>
                      <option value="ST">ST</option>
                      <option value="OBC">OBC</option>
                    </select>
                  </div>
                  <div class="col-4">
                    <label>Gender</label>
                    <select id="gender" name="add_admission_gender" class="form-control">
                      <option value="0">Select</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>


                  <div class="col-md-4">
                    <label>Username</label>
                    <input type="text" name="add_admission_username" class="form-control" required>
                  </div>
                  <div class="col-4">
                    <label>Password</label>
                    <input type="password" name="add_admission_password" class="form-control" required>
                  </div>
                  <div class="col-4">
                    <label>Blood Group</label>
                    <input type="text" name="add_admission_blood_group" class="form-control">
                  </div>

                  <div class="col-4">
                    <label>Hostel</label>
                    <select name="add_admission_hostel" class="form-control">
                      <option value="No">No</option>
                      <option value="Yes">Yes</option>
                    </select>
                  </div>
                  <div class="col-4">
                    <label>Transport</label>
                    <select name="add_admission_transport" class="form-control">
                      <option value="No">No</option>
                      <option value="Yes">Yes</option>
                    </select>
                  </div>

                  <div class="col-4">

                  </div>
                  <div class="col-4">
                    <label>Image</label>
                    <input type="file" name="add_admission_profile_image" id="add_admission_profile_image" class="form-control">
                  </div>
                  <div class="col-4">
                    <img src="http://www.clipartpanda.com/clipart_images/user-66327738/download" id="photoBrowser" style="margin-top:17px;margin-left:4px;border:solid 1px lightgray" width="120" height="120">
                  </div>

                </div>
              </div>
          </div>

          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">PRESENT ADDRESS</h3>
            </div>

            <div class="card-body table-responsive p-0">
              <div class="card-body">
                <div class="row">
                  <div class="col-4">
                    <label>Residential Address</label>
                    <textarea id="address" name="add_admission_residential_address" class="form-control" style="height: 38px;"></textarea>
                  </div>
                  <div class="col-4">
                    <label>State</label>
                    <input id="state" type="text" name="add_admission_state" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>City</label>
                    <input id="city" type="text" name="add_admission_city" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>District</label>
                    <input type="text" name="add_admission_district" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>Pin Code</label>
                    <input id="postal_code" type="text" name="add_admission_pin_code" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>Home Landline no.</label>
                    <input type="text" name="add_admission_home_landlineno" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>Mobile No. (Student)</label>
                    <input id="mobile_no" type="text" name="add_admission_mobile_student" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>Father Phone No.</label>
                    <input type="text" name="add_admission_father_phoneno" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>Email Id (Father)</label>
                    <input type="email" name="add_admission_emailid_father" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>Email Id (Student)</label>
                    <input id="email_id" type="email" name="add_admission_emailid_student" class="form-control">
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Parent Details</h3>
            </div>

            <div class="card-body table-responsive p-0">
              <div class="card-body">
                <div class="row">
                  <div class="col-4">
                    <label>Father Name</label>
                    <input id="father_name" type="text" name="add_admission_father_name" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>Father Whatsapp No</label>
                    <input type="text" name="add_admission_father_whatsappno" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>Mother Name</label>
                    <input id="mother_name" type="text" name="add_admission_mother_name" class="form-control">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Academic Details</h3>
            </div>

            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Qualification</th>
                    <th>Board/University</th>
                    <th>School/College Name</th>
                    <th>Year Of Passing</th>
                    <th>Percentage or CGPA</th>
                    <th>Subjects</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>High School</td>
                    <td><input type="text" name="add_admission_high_school_board_university" size="15" value=""></td>
                    <td><input type="text" name="add_admission_high_school_college_name" size="15" value=""></td>
                    <td><input type="text" name="add_admission_high_school_passing_year" size="15" value=""></td>
                    <td><input type="text" name="add_admission_high_school_per" size="15" value=""></td>
                    <td><input type="text" name="add_admission_high_school_subjects" size="15" value=""></td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Intermediate</td>
                    <td><input type="text" name="add_admission_intermediate_board_university" size="15" value=""></td>
                    <td><input type="text" name="add_admission_intermediate_college_name" size="15" value=""></td>
                    <td><input type="text" name="add_admission_intermediate_passing_year" size="15" value=""></td>
                    <td><input type="text" name="add_admission_intermediate_per" size="15" value=""></td>
                    <td><input type="text" name="add_admission_intermediate_subjects" size="15" value=""></td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Graduation</td>
                    <td><input type="text" name="add_admission_graduation_board_university" size="15" value=""></td>
                    <td><input type="text" name="add_admission_graduation_college_name" size="15" value=""></td>
                    <td><input type="text" name="add_admission_graduation_passing_year" size="15" value=""></td>
                    <td><input type="text" name="add_admission_graduation_per" size="15" value=""></td>
                    <td><input type="text" name="add_admission_graduation_subjects" size="15" value=""></td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Post Graduation</td>
                    <td><input type="text" name="add_admission_post_graduation_board_university" size="15" value=""></td>
                    <td><input type="text" name="add_admission_post_graduation_college_name" size="15" value=""></td>
                    <td><input type="text" name="add_admission_post_graduation_others" size="15" value=""></td>
                    <td><input type="text" name="add_admission_post_graduation_per" size="15" value=""></td>
                    <td><input type="text" name="add_admission_post_graduation_subjects" size="15" value=""></td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>Others</td>
                    <td><input type="text" name="add_admission_others_board_university" size="15" value=""></td>
                    <td><input type="text" name="add_admission_others_college_name" size="15" value=""></td>
                    <td><input type="text" name="add_admission_others_passing_year" size="15" value=""></td>
                    <td><input type="text" name="add_admission_others_per" size="15" value=""></td>
                    <td><input type="text" name="add_admission_others_subjects" size="15" value=""></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>


          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Documents Required For Admission</h3>
            </div>

            <div class="card-body table-responsive p-0">
              <div class="card-body">
                <div class="row">
                  <div class="col-4">
                    <label>10th Marksheet</label>
                    <input type="file" name="add_admission_tenth_marksheet" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>10th Passing Certificate</label>
                    <input type="file" name="add_admission_tenth_passing_certificate" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>12th Marksheet</label>
                    <input type="file" name="add_admission_twelve_markesheet" class="form-control">
                  </div>

                  <div class="col-4">
                    <label>12th Passing Certificate</label>
                    <input type="file" name="add_admission_twelve_passing_certificate" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>Graduation Marksheet</label>
                    <input type="file" name="add_admission_graduation_marksheet" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>Recent Character Certificate</label>
                    <input type="file" name="add_admission_recent_character_certificate" class="form-control">
                  </div>

                  <div class="col-4">
                    <label>Other Certificate (If applicable)</label>
                    <input type="file" name="add_admission_other_certificate" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>Character Certificate (If applicable)</label>
                    <input type="file" name="add_admission_character_certificate" class="form-control">
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">TECHNICAL QUALIFICATION (IF ANY)</h3>
            </div>

            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Course</th>
                    <th>Board / University</th>
                    <th>Year Of Passing</th>
                    <th>Percentage or CGPA</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><input type="text" name="add_admission_course1" size="15" value=""></td>
                    <td><input type="text" name="add_admission_board_university1" size="15" value=""></td>
                    <td><input type="text" name="add_admission_year_of_passing1" size="15" value=""></td>
                    <td><input type="text" name="add_admission_percentage1" size="15" value=""></td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td><input type="text" name="add_admission_course2" size="15" value=""></td>
                    <td><input type="text" name="add_admission_board_university2" size="15" value=""></td>
                    <td><input type="text" name="add_admission_year_of_passing2" size="15" value=""></td>
                    <td><input type="text" name="add_admission_percentage2" size="15" value=""></td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td><input type="text" name="add_admission_course3" size="15" value=""></td>
                    <td><input type="text" name="add_admission_board_university3" size="15" value=""></td>
                    <td><input type="text" name="add_admission_year_of_passing3" size="15" value=""></td>
                    <td><input type="text" name="add_admission_percentage3" size="15" value=""></td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td><input type="text" name="add_admission_course4" size="15" value=""></td>
                    <td><input type="text" name="add_admission_board_university4" size="15" value=""></td>
                    <td><input type="text" name="add_admission_year_of_passing4" size="15" value=""></td>
                    <td><input type="text" name="add_admission_percentage4" size="15" value=""></td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td><input type="text" name="add_admission_course5" size="15" value=""></td>
                    <td><input type="text" name="add_admission_board_university5" size="15" value=""></td>
                    <td><input type="text" name="add_admission_year_of_passing5" size="15" value=""></td>
                    <td><input type="text" name="add_admission_percentage5" size="15" value=""></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title"> WORK EXPERIENCE (IF ANY)</h3>
            </div>

            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Name of organisation</th>
                    <th>Designation</th>
                    <th>Duration</th>

                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><input type="text" name="add_admission_name_of_org1" size="15"></td>
                    <td><input type="text" name="add_admission_designation1" size="15"></td>
                    <td><input type="text" name="add_admission_duration1" size="15"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="col-md-12">
            <div id="loader_section"></div>
          </div>
          <div class="col-md-6">
            <input type="hidden" name="action" value="add_admission" />
            <button type="submit" id="add_admission_button" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-primary">Reset</button>
          </div>
          </form>

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