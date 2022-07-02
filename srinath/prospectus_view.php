<?php
$page_no = "4";
$page_no_inside = "4_1";
include "include/authentication.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SRINATH UNIVERSITY | Prospectus </title>
    <!-- Fav Icon -->
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <link rel="stylesheet" href="../css/pagination.css">
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
                            <h1>Prospectus List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Prospectus</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="float-sm-right">
                                    <button type="button" class="btn btn-success" onclick="document.getElementById('add_prospectus').style.display='block'">Add Prospectus</button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" id="data_table">

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>

            <!-- Button trigger modal -->


            <!-- Modal -->

            <!-- /.content -->

            <div class="card table-responsive p-3 ">
                <div class="row">
                    <div class="col-sm-10">

                    </div>
                    <div class="col-sm-2">
                        <input type="text" onkeyup="searchData(this.value)" placeholder="Search.." class="form-control form-control-sm">

                    </div>
                </div>
                <table id="example1" class="table table-bordered table-striped mt-2">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Prospectus No</th>
                            <th>Course</th>
                            <th>Session</th>
                            <th>Name</th>
                            <th>Phone No</th>
                            <th>Referred By</th>
                            <th>Payment Status</th>
                            <th>Payment Mode</th>
                            <th>Timing</th>
                            <th>Action1 </th>
                            <th>Action 2</th>
                            <th>Admit Card</th>

                        </tr>
                    </thead>
                    <tbody id="data">
                        <?php
                        $limit = 10;
                        if (isset($_GET["page"])) {
                            $page  = $_GET["page"];
                        } else {
                            $page = 1;
                        };

                        $start_from = ($page - 1) * $limit;
                        $s_no = $start_from + 1;
                        $trash = md5("trash");
                        $tbl_prospectus = "SELECT * FROM `tbl_prospectus` WHERE `status`!='$trash' && `payment_status`='success' ORDER BY `prospectus_no` ASC LIMIT $start_from, $limit   ";

                        $result = $con->query($tbl_prospectus);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $id = $row['id'];
                        ?>
                                <tr>
                                    <td><?php echo $s_no; ?></td>
                                    <td style="color:#8a0410;"><b><?php if ($row["prospectus_no"] != "") echo $row["prospectus_no"];
                                                                    else echo "Please Give Prospectus No"; ?></b></td>
                                    <?php
                                    //   i heve to check prospectus course name value interger or charater
                                    if (strlen($row["prospectus_course_name"]) <= 2) {
                                        $prospectus_course_name = $row["prospectus_course_name"];
                                        $course_no_query = "SELECT * FROM `tbl_course` WHERE `course_id`='$prospectus_course_name'";
                                        $course_no_result = mysqli_query($con, $course_no_query);
                                        $data_row1 = mysqli_fetch_array($course_no_result);
                                        $prospectus_course = $data_row1['course_name'];
                                    } else {
                                        $prospectus_course = $row["prospectus_course_name"];
                                    }

                                    $explode_date = explode('-', $row['prospectus_session']);
                                    if (strlen($explode_date[0]) > 5) {
                                      $start_year = explode('/', $explode_date[0])[2];
                                      $end_year = explode('/', $explode_date[1])[2];
                                      $start_year = $start_year ;
                                      $end_year = $end_year ;
                                    } else {
                                      $start_year = $explode_date[0] ;
                                      $end_year = $explode_date[1] ;
                                    }
                                    ?>

                                    <div class="modal fade" id="exampleModal<?php echo $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-center">
                                                    <div class="text-center">
                                                        <h6 class="modal-title " id="exampleModalLabel"> <strong> Move To Trash</strong></h6>

                                                    </div>
                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5 class="modal-title text-danger " id="exampleModalLabel"> <strong><i class="fas fa-exclamation-triangle"></i> Are you sure ?</strong></h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                    <a type="button" href="./include/status/delete_prospectus?delete=<?php echo $id ?>" class="btn btn-danger">Yes</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <td><?php echo $prospectus_course  ?></td>
                                    <td><?php echo $start_year.'-'.$end_year ?></td>
                                    <td><?php echo $row["prospectus_applicant_name"] ?></td>
                                    <td><?php echo $row["mobile"] ?></td>
                                    <td><?php echo $row["revert_by"] ?></td>
                                    <td><?php echo $row["payment_status"] ?></td>
                                    <td><?php echo $row["prospectus_payment_mode"] ?></td>
                                    <td><?php echo $row["post_at"] ?></td>
                                    <td>
                                        <a type="button" class="btn btn-warning" href="prospectus_form?id=<?php echo $id ?>">
                                        <i class="fas fa-edit"></i>
                                            </i> </a>
                                    </td>
                                    <td>

                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $id ?>">
                                            <i class="fas fa-trash">
                                            </i> </button>

                                    </td>

                                    <td>
                                        <a type="button" class="btn btn-success" href="admit_card_print?id=<?php echo $id ?>">
                                        <i class="fas fa-print"></i>
                                            </i> </a>
                                    </td>
                                 


                                </tr>
                        <?php
                                $s_no++;
                            }
                        } else
                            echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                                </div>';
                        ?>
                    </tbody>
                </table>
                <?php
                $result_db = mysqli_query($con, "SELECT COUNT(id) FROM tbl_prospectus where `payment_status`='success'  ");
                $row_db = mysqli_fetch_row($result_db);
                $total_records = $row_db[0];
                $total_pages = $total_records;
                $num_results_on_page = $limit;

                /* echo  $total_pages; */ ?>
                <div class="ml-3">
                    <?php if (ceil($total_pages / $num_results_on_page) > 0) : ?>
                        <ul class="pagination">
                            <?php if ($page > 1) : ?>
                                <li class="prev page-item"><a href="prospectus_view?page=<?php echo $page - 1 ?>">Prev</a></li>
                            <?php endif; ?>

                            <?php if ($page > 3) : ?>
                                <li class="start"><a href="prospectus_view?page=1">1</a></li>
                                <li class="dots">...</li>
                            <?php endif; ?>

                            <?php if ($page - 2 > 0) : ?><li class="page"><a href="prospectus_view?page=<?php echo $page - 2 ?>"><?php echo $page - 2 ?></a></li><?php endif; ?>
                            <?php if ($page - 1 > 0) : ?><li class="page"><a href="prospectus_view?page=<?php echo $page - 1 ?>"><?php echo $page - 1 ?></a></li><?php endif; ?>

                            <li class="currentpage"><a href="prospectus_view?page=<?php echo $page ?>"><?php echo $page ?></a></li>

                            <?php if ($page + 1 < ceil($total_pages / $num_results_on_page) + 1) : ?><li class="page"><a href="prospectus_view?page=<?php echo $page + 1 ?>"><?php echo $page + 1 ?></a></li><?php endif; ?>
                            <?php if ($page + 2 < ceil($total_pages / $num_results_on_page) + 1) : ?><li class="page"><a href="prospectus_view?page=<?php echo $page + 2 ?>"><?php echo $page + 2 ?></a></li><?php endif; ?>

                            <?php if ($page < ceil($total_pages / $num_results_on_page) - 2) : ?>
                                <li class="dots">...</li>
                                <li class="end"><a href="prospectus_view?page=<?php echo ceil($total_pages / $num_results_on_page) ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
                            <?php endif; ?>

                            <?php if ($page < ceil($total_pages / $num_results_on_page)) : ?>
                                <li class="next"><a href="prospectus_view?page=<?php echo $page + 1 ?>">Next</a></li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>
                </div>


            </div>
        </div>

        <?php include 'include/footer.php'; ?>

        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <?php
    include '../srinath/include/config.php';
    $getmaxid = "SELECT COUNT(prospectus_no) as id1 FROM `tbl_prospectus` WHERE  `payment_status`='success'";
    $getmaxid_result = mysqli_query($con, $getmaxid);
    $getmaxid_data = mysqli_fetch_array($getmaxid_result);
    $prosprectus_number = $getmaxid_data['id1'];

    $add_prospectus_no =  'SU/P/' . (($prosprectus_number) + 1);

    ?>
    <!-- ./wrapper -->
    <!-- Add prospectus Modal Start-->
    <div id="add_prospectus" class="w3-modal" style="z-index:2020;">
        <div class="w3-modal-content w3-animate-top w3-card-4" style="width:55%">
            <header class="w3-container" style="background:#343a40; color:white;">
                <span onclick="document.getElementById('add_prospectus').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                <h2 align="center">Add Prospectus</h2>
            </header>
            <form id="add_prospectus_form" role="form" method="POST">
                <div class="card-body">
                    <div class="col-md-12" id="error_section"></div>
                    <div class="row">
                        <div class="col-md-12" id="error_section"></div>
                        <div class="col-4">
                            <label>Prospectus No.</label>
                            <input readonly type="text" id="add_prospectus_no" name="add_prospectus_no" class="form-control" value="<?php echo $add_prospectus_no ?>" required>
                        </div>

                        <div class="col-4">
                            <label>Applicant Name</label>
                            <input type="text" id="add_prospectus_applicant_name" name="add_prospectus_applicant_name" class="form-control" required>
                        </div>

                        <div class="col-4">
                            <label>Gender</label>
                            <select id="add_prospectus_gender" name="add_prospectus_gender" class="form-control">
                                <option value="0">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="col-4">
                            <label>Father Name</label>
                            <input type="text" id="add_prospectus_father_name" name="add_prospectus_father_name" class="form-control">
                        </div>
                        <div class="col-4">
                            <label>Mother Name</label>
                            <input type="text" id="add_prospectus_mother_name" name="add_prospectus_mother_name" class="form-control">
                        </div>

                        <div class="col-4">
                            <label>Address 1</label>
                            <textarea id="add_prospectus_address" name="add_prospectus_address" class="form-control" style="height:38px;"></textarea>
                        </div>
                        <div class="col-4">
                            <label>Address 2</label>
                            <textarea id="add_prospectus_address1" name="add_prospectus_address1" class="form-control" style="height:38px;"></textarea>
                        </div>
                        <div class="col-4">
                            <label>Country</label>
                            <select id="add_prospectus_country" name="add_prospectus_country" class="form-control">
                                <option value="India">India</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label>State</label>
                            <input type="text" id="add_prospectus_state" name="add_prospectus_state" class="form-control" required>
                            <!-- <select id="add_prospectus_state" name="add_prospectus_state"  class="form-control" >-->
                            <!--<option value="0">Select State</option>-->
                            <!--<option value="Jharkhand">Jharkhand</option>-->
                            <!--</select>				  -->
                        </div>
                        <div class="col-4">
                            <label>City</label>
                            <input type="text" id="add_prospectus_city" name="add_prospectus_city" class="form-control" required>
                            <!--<select id="add_prospectus_city" name="add_prospectus_city"  class="form-control" >-->
                            <!--	<option value="0">Select City</option>					-->
                            <!--	<option value="Jamshedpur">Jamshedpur</option>-->
                            <!--	<option value="Ranchi">Ranchi</option>-->
                            <!--	</select>-->
                        </div>

                        <div class="col-4">
                            <label>Postal Code</label>
                            <input type="text" id="add_prospectus_postal_code" name="add_prospectus_postal_code" class="form-control">
                        </div>
                        <div class="col-4">
                            <label>Email ID</label>
                            <input type="email" id="add_prospectus_emailid" name="add_prospectus_emailid" class="form-control" required>
                        </div>

                        <div class="col-4">
                            <label>DOB</label>
                            <input type="date" id="add_prospectus_dob" name="add_prospectus_dob" class="form-control" required>
                        </div>
                        <div class="col-4">
                            <label>Mobile No</label>
                            <input type="text" id="mobile" name="mobile" class="form-control" required>
                        </div>

                        <div class="col-4">
                            <label>Course</label>
                            <select id="add_prospectus_course_name" name="add_prospectus_course_name" class="form-control" onchange="showdesg(this.value)">
                                <option value="0">Select Course</option>
                                <?php
                                $sql = "select * from tbl_course";
                                $query = mysqli_query($con, $sql);
                                while ($row = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $row['course_id']; ?>"><?php echo $row['course_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Academic Year</label>
                                <select class="form-control" id="s_academic_year" name="add_prospectus_session" id="add_prospectus_session">

                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <label>Prospectus Rate</label>
                            <select class="form-control" name="add_prospectus_rate" id="add_prospectus_rate" onchange="show(this.value)">
                                <option>Select</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label>Payment Mode</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <select id="add_prospectus_payment_mode" name="add_prospectus_payment_mode" class="form-control" onchange="PaymentModeSelect(this.value);">
                                        <option value="0">Select</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Cheque">Cheque</option>
                                        <option value="DD">DD</option>
                                        <option value="Online">Online</option>
                                        <option value="NEFT/IMPS/RTGS">NEFT/IMPS/RTGS</option>
                                    </select>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-4" id="bankName_div" style="display:none">
                            <label>Bank Name</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input id="add_bank_name" name="add_bank_name" type="text" class="form-control" />
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-4" id="chequeNo_div" style="display:none">
                            <label>Cheque/DD/NEFT No</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input id="add_transaction_no" name="add_transaction_no" type="text" class="form-control" />
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-4" id="cashDepositTo_div" style="display:none">
                            <label>Cash Deposit To</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <select id="cashDepositTo" name="cashDepositTo" class="form-control">
                                        <option value="0">Select</option>
                                        <option value="University Office">University Office</option>
                                        <option value="Deposit to Bank">Deposit to Bank</option>
                                        <option value="City Office">City Office</option>
                                    </select>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>

                        <div class="col-4" id="receiptDate_div" style="display:none">
                            <label>Cash/Cheque/DD/NEFT Date</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input id="add_transaction_date" name="add_transaction_date" type="date" class="form-control" value="<?php echo date("Y-m-d"); ?>" />
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>


                    </div>
                    <input type='hidden' name='action' value='add_prospectus' />
                    <div class="col-md-12" id="loader_section"></div>
                    <button type="button" id="add_prospectus_button" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Add Prospectus Modal End -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->
    <script>
        $(function() {
            $('#example1').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
    <script>
        function PaymentModeSelect(PaymentMode) {
            var bankName_div = document.getElementById('bankName_div');
            var chequeNo_div = document.getElementById('chequeNo_div');
            var receiptDate_div = document.getElementById('receiptDate_div');
            var cashDepositTo_div = document.getElementById('cashDepositTo_div');
            if (PaymentMode == "Cash") {
                // cash_div.style.display = "block";
                bankName_div.style.display = "none";
                chequeNo_div.style.display = "none";
                receiptDate_div.style.display = "block";
                cashDepositTo_div.style.display = "block";
            } else if (PaymentMode == "Cheque" || PaymentMode == "DD" || PaymentMode == "Online" || PaymentMode == "NEFT/IMPS/RTGS") {
                bankName_div.style.display = "block";
                chequeNo_div.style.display = "block";
                receiptDate_div.style.display = "block";
                cashDepositTo_div.style.display = "none";
            } else {
                bankName_div.style.display = "none";
                chequeNo_div.style.display = "none";
                receiptDate_div.style.display = "none";
                cashDepositTo_div.style.display = "block";
            }
        }
    </script>
    <script>
        $(function() {

            $('#add_prospectus_button').click(function() {
                $('#loader_section').append('<center id = "loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>');
                $('#add_prospectus_button').prop('disabled', true);
                $.ajax({
                    url: 'include/controller.php',
                    type: 'POST',
                    data: $('#add_prospectus_form').serializeArray(),
                    success: function(result) {
                        $('#response').remove();
                        $('#add_prospectus_form')[0].reset();
                        $('#error_section').append('<div id = "response">' + result + '</div>');
                        $('#loading').fadeOut(500, function() {
                            $(this).remove();
                        });
                        $('#add_prospectus_button').prop('disabled', false);
                    }

                });
                $.ajax({
                    url: 'include/view.php?action=get_prospectus',
                    type: 'GET',
                    success: function(result) {
                        $("#data_table").html(result);
                    }
                });

            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $('#data_table').html('<center><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>');
            $.ajax({
                url: 'include/view.php?action=get_prospectus',
                type: 'GET',
                success: function(result) {
                    $("#data_table").html(result);
                }
            });
            //            $('#add_course_button').click(function(){
            //                $.ajax({
            //                    url: 'include/view.php?action=get_courses',
            //                    type: 'GET',
            //                    success: function(result) {
            //                        $("#data_table").html(result);
            //                    }
            //                });
            //            });
        });
    </script>
    <script>

    </script>

    <script>
        function searchData(data) {
            $.ajax({
                url: 'include/ajax/prospectus_enquiry.php?data=' + data,
                type: 'GET',
                success: function(result) {
                    $("#data").html(result);
                }
            });

        }

        function showdesg(semester) {

            $.ajax({
                url: 'ajaxdata1.php',
                type: 'POST',
                data: {
                    depart: semester
                },
                success: function(data) {
                    $("#add_prospectus_rate").html(data);
                },
            });

            $.ajax({
                url: 'include/ajax/add_semester.php',
                type: 'POST',
                data: {
                    'data': semester
                },
                success: function(result) {
                    document.getElementById('s_academic_year').innerHTML = result;
                }

            });
        }
    </script>
</body>

</html>