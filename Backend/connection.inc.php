<?php

session_start();
if($_SERVER['HTTP_HOST']=="localhost"){
    $connection=mysqli_connect("localhost","root","","srinath_cms");
}
else{
    $connection=mysqli_connect("localhost","srinathuniversityerp_srinath_cms","Rohit83013@#","srinathuniversityerp_srinath_cms");
}

?>