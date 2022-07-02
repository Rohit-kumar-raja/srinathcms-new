<?php
// Create connection
//$con = new mysqli("localhost", "", "", "");
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $con = new mysqli('localhost', 'root', '', 'srinath_cms');
} else {
    $con = new mysqli("localhost", "srinathuniversityerp_srinath_cms", "Rohit83013@#", "srinathuniversityerp_srinath_cms");
    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
}

// this connection for student attendance showing
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $con_attendance = new mysqli('localhost', 'root', '', 'srinath_atteandance');
} else {
    $con_attendance =new mysqli("localhost", "srinathuniversityerp_srinath_cms", "Rohit83013@#", "srinathuniversityerp_srinath_cms");
    // Check connection
}
