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
  <title>NSU Student Attendance System </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" sizes="56x56" href="../img/icon/icon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>!-->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.dataTables.min.js"></script>
  <script src="../js/dataTables.bootstrap4.min.js"></script>

</head>

<body>

  <div class="jumbotron-small text-center" style="margin-bottom:0">
    <img src="../nsu_logo.png" style="height:120px;">
  
  </div>

  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
   
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
      <li class="nav-item">
      <a class="navbar-brand" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="grade.php">Semester</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="teacher.php">Teacher</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="student.php">Student</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add_attendance.php">Take Attendance / Report</a>
        </li>
        <!--
      <li class="nav-item">
        <a class="nav-link" href="attendance.php">Attendance Report</a>
      </li>
-->

     
      </ul>
    </div>
    <a class="nav-item" style="color:aliceblue" title="log out button" href="logout.php"><i class="fa fa-power-off" aria-hidden="true"></i>
        </a>

  </nav>