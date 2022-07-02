<?php

//header.php

include('database_connection.php');

session_start();

if (!isset($_SESSION["admin_id"])) {
  header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>SRINATH Student Attendance System </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" sizes="56x56" href="../img/icon/icon.png">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.dataTables.min.js"></script>
  <script src="../js/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

  <div class="jumbotron-small text-center" style="margin-bottom:0">
    <img src="../nsu_logo.png" style="height:120px;">
  </div>

  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <!-- <a class="navbar-brand" href="index.php">Home</a> -->

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link text-white" href="add_attendance.php">Attendance</a>
        </li>

      </ul>

    </div>
    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
    <a class="navbar-brand" href="profile.php"><i class="fa fa-user-circle-o"></i></a>
  </nav>