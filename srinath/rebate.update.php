<?php
$page_no = "15";
$page_no_inside = "15_1";
$year = date('Y');
$start = '';
$end = '';
include "include/authentication.php";

include 'include/config.php';
if (isset($_SESSION['admin_email'])) {
    $status = $_GET['status'];
    $id = $_GET['id'];
    $admin_email = $_SESSION['admin_email'];
    $admin_name = $_SESSION['admin_name'];
    $date = date('Y-m-d');

    $get_all_data = "SELECT * FROM `rebate` WHERE `id`='$id'";
    $result_all_data = mysqli_query($con, $get_all_data);
    $data_all_student = mysqli_fetch_array($result_all_data);
    $amount = $data_all_student['rebate_amount'];
    $approve_amount    = $data_all_student['approve_amount'];
    $rebate_by_name = $data_all_student['rebate_by_name'];
    $rebate_by_email = $data_all_student['rebate_by_email'];
    $student_email = $data_all_student['student_email'];
    $student_name = $data_all_student['student_name'];
    $department = $data_all_student['department'];
    $particular = $data_all_student['particular'];
    $massage = $data_all_student['massage'];
    $attach = $data_all_student['attach'];

    if (isset($_POST['yes'])) {
        $amount = $_POST['amount'];
        $status = $_POST['status'];
        $msg = $_POST['msg'];
        echo $sql = "UPDATE  `rebate` SET `approve_amount`='$amount',`rebate_by_name`='$admin_name',`rebate_by_email`='$admin_email', `approve_date`='$date',`massage`='$msg',`status`='$status' WHERE `id`='$id' ";
        $sql_update = mysqli_query($con, $sql);
        if ($sql_update) {
            echo "<script>
        window.location.replace('rebate.php')
    </script>";
        }
    }

?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SRINATH UNIVERSITY | Event </title>
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
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <link rel="stylesheet" href="./event_hindi_inc/css/main.css">

    </head>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">

            <?php include 'include/navbar.php'; ?>
            <?php include 'include/aside.php'; ?>
            <?php
            if ($status == "success") {
            ?>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="container">
                            <div class="row">

                                <div class="col-sm-4">

                                </div>
                                <div class="col-sm-6">


                                    <h3>Do You Want to Edit Amount</h3>


                                    <div class="col-sm-6">

                                        <label for="year">Amount</label>
                                        <input type="hidden" name="status" value="1">
                                        <input name="amount" value="<?php echo $amount ?>" placeholder="Enter Amount" type="input" class="form-control">
                                    </div>
                                    <div class=" mt-5 mb-3">
                                        <label for="year"> Massage</label>
                                        <textarea cols="10" rows="10" name="msg" class="form-control">
                                    <?php echo $massage .  ' ------------------------------- ' . $admin_name . ' Write Massage-------------------------' ?>
                                </textarea>
                                    </div>
                                    <div class="col-sm-7 p-1">
                                        <button name="yes" type="submit" class="btn btn-success btn-sm ">Yes</button>
                                        <button name="yes" type="submit" class="btn btn-warning btn-sm ">no</button>
                                    </div>
                                </div>
                            </div>

                    </form>

                </div>
            <?php
            } elseif ($status == "reject") {

            ?>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-4">

                                </div>
                                <div class="col-sm-8">

                                    <h3>Why Reject the Amount</h3>

                                    <div class="col-sm-10 mt-5 mb-3">
                                        <input type="hidden" name="status" value="2">

                                        <label for="year"> Massage</label>
                                        <textarea name="msg" cols="10" rows="10" name="msg" class="form-control">
                                    <?php echo $massage .  ' ------------------------------- ' . $admin_name . ' Write Massage-------------------------' ?>
                                </textarea>
                                    </div>
                                    <div class="col-sm-10 p-1">
                                        <button name="yes" type="submit" class="btn btn-danger btn-sm ">Reject</button>
                                        <button name="yes" type="submit" class="btn btn-warning btn-sm ">no</button>
                                    </div>

                                </div>
                            </div>

                    </form>

                </div>



        </div>

        <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
        <?php include './include/footer.php'; ?>
        <script src="./plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables -->
        <script src="./plugins/datatables/jquery.dataTables.js"></script>
        <script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
        <!-- AdminLTE App -->
        <script src="./dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="./dist/js/demo.js"></script>
        <script src="./event_hindi_inc/js/main.js"></script>
        <!-- page script -->
        <script>
            $(function() {
                $("#example1").DataTable();
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                });
            });
        </script>

    </body>
    <!-- jQuery -->

    </html>

<?php
            } else if ($status == "pending") {
                echo $sql = "UPDATE  `rebate` SET `approve_amount`=' ',`rebate_by_name`='$admin_name',`rebate_by_email`='$admin_email', `approve_date`='$date',`status`='0' WHERE `id`='$id' ";
                $sql_update = mysqli_query($con, $sql);
                if ($sql_update) {
                    echo "<script>
        window.location.replace('rebate.php')
    </script>";
                }
            }
        }
?>