<?php
$page_no = "15";
$page_no_inside = "15_1";
$year = date('Y');
$start = '';
$end = '';
include "include/authentication.php";

include '../srinath/include/config.php';

$admin_email = $_SESSION['admin_email'];
if (isset($_POST['submit'])) {
    $start = $_POST['start'];
    $end = $_POST['end'];
    $admin_email = $_SESSION['admin_email'];
    $year = explode('-', $start)[0];
    $get_event = "SELECT * FROM `rebate`  WHERE rebate_date BETWEEN '$start' AND '$end' && `rebate_by_email`='$admin_email' ORDER BY id desc ";
    $event_result = mysqli_query($con, $get_event);

    // getting the data of approved amount
    $sql_approve = "SELECT SUM(approve_amount) as amount FROM `rebate` WHERE approve_date BETWEEN '$start' AND '$end' && `rebate_by_email`='$admin_email' ORDER BY id desc  ";
    $query = mysqli_query($con, $sql_approve);

    $row_approve = mysqli_fetch_array($query);

    // getting the total amount f rebate
    $sql_rebate = "SELECT SUM(rebate_amount) as amount FROM `rebate` WHERE rebate_date BETWEEN '$start' AND '$end' && `rebate_by_email`='$admin_email' ORDER BY id desc  ";
    $query = mysqli_query($con, $sql_rebate);
    $row_rebate = mysqli_fetch_array($query);
} else {
    $get_event = "SELECT * FROM `rebate` WHERE `rebate_by_email`='$admin_email' ORDER BY id desc ";
    $event_result = mysqli_query($con, $get_event);

    // getting the data of approved amount
    $sql_approve = "SELECT SUM(approve_amount) as amount FROM `rebate` WHERE `rebate_by_email`='$admin_email'  ";
    $query = mysqli_query($con, $sql_approve);

    $row_approve = mysqli_fetch_array($query);

    // getting the total amount f rebate
    $sql_rebate = "SELECT SUM(rebate_amount) as amount FROM `rebate` WHERE `rebate_by_email`='$admin_email' ";
    $query = mysqli_query($con, $sql_rebate);
    $row_rebate = mysqli_fetch_array($query);
}
?>
<!DOCTYPE html>
<html>

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

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper  ">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">

                            <h1 class="m-0 text-dark">Rebate</h1>

                        </div><!-- /.col -->
                        <!--<div class="col-sm-6">-->
                        <!--    <ol class="breadcrumb float-sm-right">-->
                        <!--        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>-->
                        <!--        <li class="breadcrumb-item active">Dashboard</li>-->
                        <!--    </ol>-->
                        <!--</div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">


            </section>

            <section class="content">
                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-body">
                                    <form action="" method="POST">
                                        <div class="container">
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <label for="year"></label>
                                                            <input name="start" value="<?php echo $start ?>" type="date" class="form-control">
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <label for="year"></label>
                                                            <input name="end" value="<?php echo $end ?>" type="date" class="form-control">
                                                        </div>
                                                        <div class="col-sm-2 mt-2 p-1">
                                                            <button name="submit" class="btn btn-success btn-sm ">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    </form>

                                </div>
                                <!-- /.card-header -->
                                <div class="table-responsive">
                                    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="th-sm">S.NO
                                                </th>
                                                <th class="th-sm">rebate_amount
                                                </th>
                                                <th class="th-sm">approve_amount
                                                </th>
                                                <th class="th-sm">
                                                    rebate_by_name </th>
                                                <th class="th-sm">
                                                    rebate_by_email </th>
                                                <th class="th-sm">student_email
                                                </th>
                                                <th class="th-sm">student_name
                                                </th>
                                                <th class="th-sm">rebate_date
                                                </th>
                                                <th class="th-sm">approve_date
                                                </th>
                                                <th class="th-sm">particular
                                                </th>
                                                <th class="th-sm">status
                                                </th>
                                                <th class="th-sm">document
                                                </th>
                                                <th class="th-sm">massage
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($get_row = mysqli_fetch_array($event_result)) {


                                            ?>
                                                <!-- Button trigger modal -->


                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal<?php echo $get_row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Term & Conditions</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?php echo $get_row['massage']; ?>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $get_row['rebate_amount']; ?></td>
                                                    <td><?php echo $get_row['approve_amount']; ?></td>
                                                    <td><?php echo $get_row['rebate_by_name'] ?></td>
                                                    <td><?php echo $get_row['rebate_by_email'] ?></td>
                                                    <td><?php echo $get_row['student_email']; ?></td>
                                                    <td><?php echo $get_row['student_name']; ?></td>
                                                    <td><?php echo $get_row['rebate_date']; ?></td>
                                                    <td><?php echo $get_row['approve_date']; ?></td>
                                                    <td><?php echo $get_row['particular']; ?></td>
                                                    <td>

                                                        <?php if ($get_row['status'] == 2) {
                                                        ?>
                                                            <!-- Example single danger button -->
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Reject
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item bg-success " href="rebate.update.php?status=success&&id=<?php echo $get_row['id']; ?> ">Success</a>
                                                                    <a class="dropdown-item bg-warning " href="rebate.update.php?status=pending&&id=<?php echo $get_row['id']; ?> ">Pending</a>

                                                                </div>
                                                            </div>
                                                        <?php
                                                        } elseif ($get_row['status'] == 1) {
                                                        ?>
                                                            <!-- Example single danger button -->
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Success
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item  bg-warning" href="rebate.update.php?status=pending&&id=<?php echo $get_row['id']; ?> ">Pending</a>
                                                                    <a class="dropdown-item bg-danger" href="rebate.update.php?status=reject&&id=<?php echo $get_row['id']; ?> ">Reject</a>

                                                                </div>
                                                            </div>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <!-- Example single danger button -->
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Pending
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item bg-success  " href="rebate.update.php?status=success&&id=<?php echo $get_row['id']; ?>">Success</a>
                                                                    <a class="dropdown-item bg-danger" href="rebate.update.php?status=reject&&id=<?php echo $get_row['id']; ?> ">Reject</a>

                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>

                                                    </td>

                                                    <td>
                                                        <a <?php echo ' href="data:image/jpeg;base64,' . base64_encode($get_row['attach']) . '"' ?> data-toggle="lightbox" data-title="Images">
                                                            <img height="30px" width="30px" <?php echo ' src="data:image/jpeg;base64,' . base64_encode($get_row['attach']) . '"' ?> class="img-fluid mb-2" alt="Slider Images" />
                                                        </a>
                                                    </td>
                                                    <td> <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal<?php echo $get_row['id']; ?>">
                                                            Read
                                                        </button></td>

                                                </tr>
                                            <?php $i++;
                                            } ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="th-sm"> T - <b class="text-warning"> <?php echo $i - 1; ?> </b>
                                                </th>
                                                <th class="th-sm "> Total - <b class="text-danger"> <?php echo $row_rebate['amount'] ?> </b>
                                                </th>
                                                <th class="th-sm "> Total - <b class="text-info">
                                                        <?php echo $row_approve['amount'] ?>
                                                    </b>
                                                </th>

                                                <th colspan="10" class="th-sm">
                                                </th>

                                            </tr>
                                            <tr>
                                                <th class="th-sm">Total
                                                </th>
                                                <th class="th-sm">rebate_amount
                                                </th>
                                                <th class="th-sm">approve_amount
                                                </th>
                                                <th class="th-sm">
                                                    rebate_by_name </th>
                                                <th class="th-sm">
                                                    rebate_by_email </th>
                                                <th class="th-sm">student_email
                                                </th>
                                                <th class="th-sm">student_name
                                                </th>
                                                <th class="th-sm">rebate_date
                                                </th>
                                                <th class="th-sm">approve_date
                                                </th>
                                                <th class="th-sm">particular
                                                </th>
                                                <th class="th-sm">status
                                                </th>
                                                <th class="th-sm">document
                                                </th>
                                                <th class="th-sm">massage
                                                </th>

                                            </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>

            <!-- /.content -->

        </div>


        <?php include 'include/footer.php'; ?>


        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

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

</html>
<!-- <script>
    document.getElementById("success").addEventListener("click", function() {
        console.log("hello success")
    });

    document.getElementById("reject").addEventListener("click", function() {
        console.log("hello reject")
    });
    document.getElementById("pending").addEventListener("click", function() {
        console.log("hello pending")
    });
</script> -->