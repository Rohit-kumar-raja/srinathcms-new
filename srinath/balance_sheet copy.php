<?php
$page_no = "8";
$page_no_inside = "8_4";
include "include/authentication.php";
$visible = md5("visible");

$query = "SELECT * FROM `tbl_income` ORDER BY received_date DESC";
$results = mysqli_query($con, $query) or die("database error:" . mysqli_error($con));
$allOrders = array();
while ($order = mysqli_fetch_assoc($results)) {
  $no = 1;
  $allOrders[] = $order;
}


if (isset($_SESSION['start_date'])) {
  $income_start_date = $_SESSION['start_date'];
  $income_end_date = $_SESSION['end_date'];
}else{
  $income_start_date =date('Y-m-d');
  $income_end_date = date('Y-m-d');
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SRINATH UNIVERSITY | Balance Sheet</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
  <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
  <script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include 'include/navbar.php'; ?>
    <?php include 'include/aside.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Income and Expenditure Account</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Balance Sheet</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
              <h5 style="color: #17a2b7;"><b>Admission Income</b></h5>
              <div class="info-box">
                <span class="info-box-icon bg-info" style="padding: 0px;"></span>

                <div class="info-box-content">
                  <?php
                  $sql = "select * from tbl_fee_paid  WHERE `status` = '$visible'";
                  $query = mysqli_query($con, $sql);
                  $sum1 = 0;
                  while ($row = mysqli_fetch_array($query)) {
                    $sum1 = $sum1 + array_sum(explode(",", $row["paid_amount"]));
                  } ?>
                  <span class="info-box-text">Total Admission Income : <b><?php echo $sum1; ?></b></span>
                  <?php
                  $sum2 = 0;
                  $sql = "select * from tbl_fee_paid WHERE payment_mode='Cash' &&  `status` = '$visible'";
                  $query = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_array($query)) {
                    $sum2 = $sum2 + array_sum(explode(",", $row["paid_amount"]));
                  }
                  ?>
                  <span class="info-box-text">Cash Payment : <b><?php echo $sum2; ?></b></span>
                  <?php
                  $sum3 = 0;
                  $sql = "select * from tbl_fee_paid WHERE payment_mode='Cheque' &&  `status` = '$visible'";
                  $query = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_array($query)) {
                    $sum3 = $sum3 + array_sum(explode(",", $row["paid_amount"]));
                  }
                  ?>
                  <span class="info-box-text">Cheque Payment : <b><?php echo $sum3; ?></b></span>
                  <?php
                  $sum4 = 0;
                  $sql = "select * from tbl_fee_paid WHERE payment_mode='DD' &&  `status` = '$visible'";
                  $query = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_array($query)) {
                    $sum4 = $sum4 + array_sum(explode(",", $row["paid_amount"]));
                  }
                  ?>
                  <span class="info-box-text">DD Payment : <b><?php echo $sum4; ?></b></span>
                  <?php
                  $sum5 = 0;
                  $sql = "select * from tbl_fee_paid WHERE payment_mode='Online' &&  `status` = '$visible'";
                  $query = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_array($query)) {
                    $sum5 = $sum5 + array_sum(explode(",", $row["paid_amount"]));
                  }
                  ?>
                  <span class="info-box-text">Online Payment : <b><?php echo $sum5; ?></b></span>
                  <?php
                  $sum6 = 0;
                  $sql = "select * from tbl_fee_paid WHERE payment_mode='NEFT/IMPS/RTGS' &&  `status` = '$visible'";
                  $query = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_array($query)) {
                    $sum6 = $sum6 + array_sum(explode(",", $row["paid_amount"]));
                  }
                  ?>
                  <span class="info-box-text">NEFT/IMPS/RTGS Payment : <b><?php echo $sum6; ?></b></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
              <h5 style="color: #28a745;"><b>Prospectus Income</b></h5>
              <div class="info-box">

                <span class="info-box-icon bg-success" style="padding: 0px;"></span>

                <div class="info-box-content">
                  <?php
                  $sql = "select * from tbl_income WHERE  income_from = 'Prospectus'";
                  $query = mysqli_query($con, $sql);
                  $sum7 = 0;
                  while ($row = mysqli_fetch_array($query)) {
                    $sum7 = $sum7 + array_sum(explode(",", $row["amount"]));
                  } ?>
                  <span class="info-box-text">Total Prospectus Income : <b><?php echo $sum7; ?></b></span>
                  <?php
                  $sum8 = 0;
                  $sql = "select * from tbl_income WHERE payment_mode='Cash' &&  income_from = 'Prospectus'";
                  $query = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_array($query)) {
                    $sum8 = $sum8 + array_sum(explode(",", $row["amount"]));
                  }
                  ?>
                  <span class="info-box-text">Cash Payment : <b><?php echo $sum8; ?></b></span>
                  <?php
                  $sum9 = 0;
                  $sql = "select * from tbl_income WHERE payment_mode='Cheque' &&  income_from = 'Prospectus'";
                  $query = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_array($query)) {
                    $sum9 = $sum9 + array_sum(explode(",", $row["amount"]));
                  }
                  ?>
                  <span class="info-box-text">Cheque Payment : <b><?php echo $sum9; ?></b></span>
                  <?php
                  $sum10 = 0;
                  $sql = "select * from tbl_income WHERE payment_mode='DD' &&  income_from = 'Prospectus'";
                  $query = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_array($query)) {
                    $sum10 = $sum10 + array_sum(explode(",", $row["amount"]));
                  }
                  ?>
                  <span class="info-box-text">DD Payment : <b><?php echo $sum10; ?></b></span>
                  <?php
                  $sum11 = 0;
                  $sql = "select * from tbl_income WHERE payment_mode='Online' &&  income_from = 'Prospectus'";
                  $query = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_array($query)) {
                    $sum11 = $sum11 + array_sum(explode(",", $row["amount"]));
                  }
                  ?>
                  <span class="info-box-text">Online Payment : <b><?php echo $sum11; ?></b></span>
                  <?php
                  $sum12 = 0;
                  $sql = "select * from tbl_income WHERE payment_mode='NEFT/IMPS/RTGS' &&  income_from = 'Prospectus'";
                  $query = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_array($query)) {
                    $sum12 = $sum12 + array_sum(explode(",", $row["amount"]));
                  }
                  ?>
                  <span class="info-box-text">NEFT/IMPS/RTGS Payment : <b><?php echo $sum12; ?></b></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
              <h5 style="color: #ffc107;"><b>Extra Income</b></h5>
              <div class="info-box">
                <span class="info-box-icon bg-warning" style="padding: 0px;"></span>
                <div class="info-box-content">
                  <?php
                  $sql = "select * from tbl_extra_income WHERE  `status` = '$visible'";
                  $query = mysqli_query($con, $sql);
                  $sum13 = 0;
                  while ($row = mysqli_fetch_array($query)) {
                    $sum13 = $sum13 + array_sum(explode(",", $row["amount"]));
                  } ?>
                  <span class="info-box-text">Total Extra Income : <b><?php echo $sum13; ?></b></span>
                  <?php
                  $sum14 = 0;
                  $sql = "select * from tbl_extra_income WHERE payment_mode='Cash' &&  `status` = '$visible'";
                  $query = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_array($query)) {
                    $sum14 = $sum14 + array_sum(explode(",", $row["amount"]));
                  }
                  ?>
                  <span class="info-box-text">Cash Payment : <b><?php echo $sum14; ?></b></span>
                  <?php
                  $sum15 = 0;
                  $sql = "select * from tbl_extra_income WHERE payment_mode='Cheque' &&  `status` = '$visible'";
                  $query = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_array($query)) {
                    $sum15 = $sum15 + array_sum(explode(",", $row["amount"]));
                  }
                  ?>
                  <span class="info-box-text">Cheque Payment : <b><?php echo $sum15; ?></b></span>
                  <?php
                  $sum16 = 0;
                  $sql = "select * from tbl_extra_income WHERE payment_mode='DD' &&  `status` = '$visible'";
                  $query = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_array($query)) {
                    $sum16 = $sum16 + array_sum(explode(",", $row["amount"]));
                  }
                  ?>
                  <span class="info-box-text">DD Payment : <b><?php echo $sum16; ?></b></span>
                  <?php
                  $sum17 = 0;
                  $sql = "select * from tbl_extra_income WHERE payment_mode='Online' &&  `status` = '$visible'";
                  $query = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_array($query)) {
                    $sum17 = $sum17 + array_sum(explode(",", $row["amount"]));
                  }
                  ?>
                  <span class="info-box-text">Online Payment : <b><?php echo $sum17; ?></b></span>
                  <?php
                  $sum18 = 0;
                  $sql = "select * from tbl_extra_income WHERE payment_mode='NEFT/RTGS/IMPS' &&  `status` = '$visible'";
                  $query = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_array($query)) {
                    $sum18 = $sum18 + array_sum(explode(",", $row["amount"]));
                  }
                  ?>
                  <span class="info-box-text">NEFT/IMPS/RTGS Payment : <b><?php echo $sum18; ?></b></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <h5 style="color: #dc3545;"><b>Expenditure</b></h5>
              <div class="info-box">
                <span class="info-box-icon bg-danger" style="padding: 0px;"></span>

                <div class="info-box-content">
                  <?php
                  $sql = "select * from tbl_expenses WHERE  `status` = '$visible'";
                  $query = mysqli_query($con, $sql);
                  $sum19 = 0;
                  while ($row = mysqli_fetch_array($query)) {
                    $sum19 = $sum19 + array_sum(explode(",", $row["amount"]));
                  } ?>
                  <span class="info-box-text">Total Expenditure : <b><?php echo $sum19; ?></b></span>
                  <?php
                  $sum20 = 0;
                  $sql = "select * from tbl_expenses WHERE payment_mode='Cash' &&  `status` = '$visible'";
                  $query = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_array($query)) {
                    $sum20 = $sum20 + array_sum(explode(",", $row["amount"]));
                  }
                  ?>
                  <span class="info-box-text">Cash Payment : <b><?php echo $sum20; ?></b></span>
                  <?php
                  $sum21 = 0;
                  $sql = "select * from tbl_expenses WHERE payment_mode='Cheque' &&  `status` = '$visible'";
                  $query = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_array($query)) {
                    $sum21 = $sum21 + array_sum(explode(",", $row["amount"]));
                  }
                  ?>
                  <span class="info-box-text">Cheque Payment : <b><?php echo $sum21; ?></b></span>
                  <?php
                  $sum22 = 0;
                  $sql = "select * from tbl_expenses WHERE payment_mode='DD' &&  `status` = '$visible'";
                  $query = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_array($query)) {
                    $sum22 = $sum22 + array_sum(explode(",", $row["amount"]));
                  }
                  ?>
                  <span class="info-box-text">DD Payment : <b><?php echo $sum22; ?></b></span>
                  <?php
                  $sum23 = 0;
                  $sql = "select * from tbl_expenses WHERE payment_mode='Online' &&  `status` = '$visible'";
                  $query = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_array($query)) {
                    $sum23 = $sum23 + array_sum(explode(",", $row["amount"]));
                  }
                  ?>
                  <span class="info-box-text">Online Payment : <b><?php echo $sum23; ?></b></span>
                  <?php
                  $sum24 = 0;
                  $sql = "select * from tbl_expenses WHERE payment_mode='NEFT/RTGS/IMPS' &&  `status` = '$visible'";
                  $query = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_array($query)) {
                    $sum24 = $sum24 + array_sum(explode(",", $row["amount"]));
                  }
                  ?>
                  <span class="info-box-text">NEFT/IMPS/RTGS Payment : <b><?php echo $sum24; ?></b></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>
        </div>
      </section>
      <!-- /.row -->

      <section class="content">
        <div class="container-fluid">
          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <div class="row">
              <!-- accepted payments column -->
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-3 mt-4">
                    <?php $sum_total =  $sum1 + $sum7 + $sum13; ?>
                    <h5 style="font-size:16px;"><b class="bg-primary p-2">Opening Balance : <?php $closing_bal = $sum_total - $sum19; ?>
                        <i class="fa fa-inr" aria-hidden="true"></i> <?php echo $closing_bal; ?></b></h5>
                  </div>
                  <div class="col-md-3 mt-4">
                    <h5 style="font-size:16px;"><b class="bg-danger p-2">Closing Balance : <?php $closing_bal = $sum_total - $sum19; ?>
                        <i class="fa fa-inr" aria-hidden="true"></i> <?php echo $closing_bal; ?></b></h5>
                  </div>
                  <div class="col-md-3 mt-4">
                    <h5 style="font-size:16px;"><b class="bg-warning p-2">Total Expenditure : <i class="fa fa-inr" aria-hidden="true"></i> <?php echo $sum19; ?></b></h5>
                  </div>
                  <div class="col-md-3 mt-4">
                    <h5 style="font-size:16px;"><b class="bg-success p-2">Total Income : <?php $sum_total =  $sum1 + $sum7 + $sum13; ?>
                        <i class="fa fa-inr" aria-hidden="true"></i> <?php echo $sum_total; ?></b></h5>
                  </div>
                </div>
                <div class="col-md-12 mt-4">
                  <form action="export_income.php" method="post" name="export_excel">
                    <div class="control-group">
                      <div class="controls">
                        <div class="row">
                          <div class="col-md-2">
                            <div class="field">
                              <label>Start date</label>
                              <div class="ui calendar" id="rangestart">
                                <div class="ui input left icon">
                                  <i class="calendar icon"></i>
                                  <input type="text" placeholder="Start Date" name="startDate" style="width:100%" readonly value="<?php echo date("Y-m-d"); ?>">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="field">
                              <label>End date</label>
                              <div class="ui calendar" id="rangeend">
                                <div class="ui input left icon">
                                  <i class="calendar icon"></i>
                                  <input type="text" placeholder="End Date" name="endDate" style="width:100%" readonly value="<?php echo date("Y-m-d"); ?>">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-8"></div>
                          <div class="col-md-4 mt-4">
                            <input type="hidden" name="totalExpence" value="<?php echo $sum19 ?>" />
                            <input type="hidden" name="totalIncome" value="<?php echo $sum_total ?>" />
                            <button type="submit" id="export" name="export" class="btn btn-warning button-loading" data-loading-text="Loading..."><i class="fa fa-download"></i> Export In Excel</button>
                            <button type="submit" id="show" name="show" class="btn btn-info button-loading ml-5" data-loading-text="Loading..."><i class="fa fa-info-circle"></i> Show full data </button>

                          </div>
                          <!-- /.input group -->
                        </div>
                      </div>
                    </div>
                  </form>
                </div>



              </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- /.invoice -->

        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

      <div class="card card-body">

        <table id="dtHorizontalExample" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Date</th>
              <th>Reg No/Form No</th>
              <th>Name</th>
              <th>Course</th>
              <th>Session</th>
              <th>Particulars</th>
              <th>Amount</th>
              <th>Payment Mode</th>
              <th>Cheque/DD/Online No</th>
              <th>Payment Date</th>
              <th>Bank Name</th>
              <th>Remarks</th>
            </tr>
          </thead>
          <tbody>
            <?php $s_no = 1;
            foreach ($allOrders as $order) {
              if ($order["amount"] != "") {
            ?>
                <tr>
                  <td><?php echo $s_no; ?></td>
                  <td><?php echo date("d-m-Y", strtotime($order["post_at"])); ?></td>
                  <td>
                    <?php
                    if (strpos($order["reg_no"], "Extra Income") === false)
                      echo $order["reg_no"];
                    else
                      echo "Extra Income";
                    ?>

                  </td>
                  <?php
                  if (strpos($order["reg_no"], "Extra Income") === false) {
                    $remove_admission = str_replace("(Reg No)", "", $order["reg_no"]);
                    $sql_name = "SELECT * FROM `tbl_admission` WHERE `admission_id` = '" . $remove_admission . "' ";
                    $result_name = $con->query($sql_name);
                    if ($result_name->num_rows > 0) {
                      $row_name = $result_name->fetch_assoc();
                  ?>
                      <td><?php echo strtoupper($row_name["admission_first_name"]) . " " . strtoupper($row_name["admission_middle_name"]) . " " . strtoupper($row_name["admission_last_name"]); ?></td>
                    <?php

                    } else {
                      $remove_prospectus = str_replace("(Form No)", "", $order["reg_no"]);
                      $sql_name1 = "SELECT * FROM `tbl_prospectus` WHERE `prospectus_no` = '" . $remove_prospectus . "' ";
                      $result_name1 = $con->query($sql_name1);
                      $row_name1 = $result_name1->fetch_assoc();
                    ?>
                      <td><?php echo strtoupper($row_name1["prospectus_applicant_name"]); ?></td>
                  <?php
                    }
                  } else {
                    echo "<td> " . strtoupper("From " . str_replace("Extra Income", "", str_replace(")", "", str_replace("(", "", $order["reg_no"])))) . " </td>";
                  }
                  ?>

                  <?php
                  $sql_course = "SELECT * FROM `tbl_course` WHERE `course_id` = '" . $order["course"] . "' ";
                  $result_course = $con->query($sql_course);
                  $row_course = $result_course->fetch_assoc();
                  ?>
                  <td><?php echo $row_course["course_name"]; ?></td>
                  <?php
                  $sql_session = "SELECT * FROM `tbl_university_details` WHERE `university_details_id` = '" . $order["academic_year"] . "' ";
                  $result_session = $con->query($sql_session);
                  $row_session = $result_session->fetch_assoc();
                  ?>
                  <td><?php echo intval($row_session["university_details_academic_start_date"]) . " - " . intval($row_session["university_details_academic_end_date"]); ?></td>
                  <td><?php
                      if (strpos($order["reg_no"], "Extra Income") === false)
                        echo strtoupper($order["particulars"]);
                      else
                        echo " " . $order["particulars"] . " From " . str_replace("Extra Income", "", str_replace(")", "", str_replace("(", "", $order["reg_no"])));
                      ?>

                  </td>
                  <td><?php echo $order["amount"]; ?></td>
                  <td><?php echo $order["payment_mode"]; ?></td>
                  <td><?php echo  $order["check_no"]; ?></td>
                  <td><?php echo date("d-m-Y", strtotime($order["received_date"])); ?></td>
                  <td><?php echo $order["bank_name"]; ?></td>
                  <td><?php echo $row["remarks"]; ?></td>

                </tr>
            <?php
                $s_no++;
              }
            }

            ?>
          </tbody>
          <?php
          $sum170 = 0;
          $sql = "select * from tbl_income WHERE 1";
          $query = mysqli_query($con, $sql);
          while ($row = mysqli_fetch_array($query)) {
            $sum170 = $sum170 + array_sum(explode(",", $row["amount"]));
          }
          ?>
          <tfoot>
            <tr>
              <th>
                Overall Total Income- <?php echo $sum170 ?> </th>
            </tr>
          </tfoot>
        </table>

      </div>
    </div>
    <!-- /.content-wrapper -->
    <?php include 'include/footer.php'; ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <!-- jQuery -->
  <script>
    $('#example1').calendar();
    $('#example2').calendar({
      type: 'date'
    });
    $('#example3').calendar({
      type: 'time'
    });
    $('#rangestart').calendar({
      type: 'date',
      endCalendar: $('#rangeend')
    });
    $('#rangeend').calendar({
      type: 'date',
      startCalendar: $('#rangestart')
    });
    $('#example4').calendar({
      startMode: 'year'
    });
    $('#example5').calendar();
    $('#example6').calendar({
      ampm: false,
      type: 'time'
    });
    $('#example7').calendar({
      type: 'month'
    });
    $('#example8').calendar({
      type: 'year'
    });
    $('#example9').calendar();
    $('#example10').calendar({
      on: 'hover'
    });
    var today = new Date();
    $('#example11').calendar({
      minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - 5),
      maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() + 5)
    });
    $('#example12').calendar({
      monthFirst: false
    });
    $('#example13').calendar({
      monthFirst: false,
      formatter: {
        date: function(date, settings) {
          if (!date) return '';
          var day = date.getDate();
          var month = date.getMonth() + 1;
          var year = date.getFullYear();
          return day + '/' + month + '/' + year;
        }
      }
    });
    $('#example14').calendar({
      inline: true
    });
    $('#example15').calendar();
  </script>

  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <script src="plugins/datatables/jquery.dataTables.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <script>
    $(document).ready(function() {
      $('#dtHorizontalExample').DataTable({
        "scrollX": true
      });
      $('.dataTables_length').addClass('bs-select');
    });
  </script>
</body>

</html>