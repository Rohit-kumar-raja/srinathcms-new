<?php
if (empty(session_start()))
    session_start();
//DataBase Connectivity
include "include/config.php";
$msg = '';
$flag = 0;
$phone = '';
if (isset($_POST['forget'])) {
    $phone = $_POST['phone'];
    $forget_password = "SELECT * FROM `tbl_admission` WHERE `admission_mobile_student`='$phone'";
    $result = mysqli_query($con, $forget_password);
    $data = mysqli_fetch_array($result);
    $_SESSION['phone'] = $phone;
    if (isset($data['admission_mobile_student'])) {
        if ($phone == $data['admission_mobile_student']) {
            $_SESSION['email'] = $data['admission_emailid_student'];
            include "../Backend/function.inc.php";
            $otp = generate_otp($phone);
            $message = "Your OTP is " . $otp . ". Please do not share this OTP to anyone. Regards, Srinath University, JSR";
            sendsmsGET($phone, $message);
            $flag = 1;
        } else {
            $flag = 0;
            $msg = 1;
        }
    } else {
        $flag = 0;
        $msg = 1;
    }
}

if (isset($_POST['submit_otp']) && $_POST['otp'] != '') {
    $otp = $_POST['otp'];
    $phone = $_POST['phone'];
    $flag = 1;

    if ($otp == $_SESSION['otp'] && $phone == $_SESSION['phone']) {
        echo '<script>
    window.location.replace("confirmpassword");
        </script>';
    } else {
        $msg = 2;
    }
}

if (isset($_SESSION["logger_username1"]) && isset($_SESSION["logger_password1"])) {
    echo "<script> location.replace('dashboard'); </script>";
} else {

?>
    <!-- this the comments -->

    <head>
        <title> SRINATH UNIVERSITY FORGET PASSWORD</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="../app-assets/images/logo/favicon-32x32.png" sizes="32x32">
        <link rel="icon" href="../app-assets/images/logo/favicon-192x192.png" sizes="192x192">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

        <link href="dist/css/login.css" rel="stylesheet" id="bootstrap-css">
    </head>

    <body>


        <style type="text/css">
            body {
                background: url('images/img_bg_nsu.png') fixed;
                background-repeat: no-repeat;
                background-size: cover;
                padding: 0;
                margin: 0;

            }

            .img-title {
                margin-top: 5%;
                width: 300px;
            }

            .title {
                color: red;
                font-size: 30px;
                font-weight: 900;
                margin-top: 5%;
                margin-bottom: 10px;

            }

            .p-white {
                color: white;
            }

            @media (max-width: 768px) {

                .img-title {
                    margin-top: 84% !important;
                    width: 300px;
                }
            }
        </style>
        <div class="container">
            <center class="margin"> <img class="img-title" src="images/images.png">
                <p class="title">FORGET PASSWORD</p>
                <form method="POST" id="student_login_form">
                    <div id="error_section"></div>
                    <b class="p-white font-weight-700 mt-3 text-left "> Enter 10 digit mobile number :</b><input type="text" id="student_login_username" value="<?php echo $phone; ?>" name="phone" class="form-control" placeholder="Enter register 10  digit mobile number"></br>
                    <?php if ($flag == 1) { ?>
                        <b class=" text-success">Otp has been sended to <?php echo $phone ?> : </b><input type="text" id="student_login_password" name="otp" class="form-control" placeholder="Enter 6 digit otp">

                        </br>
                        <div class="col-4">
                            <button type="submit" name="submit_otp" class="btn btn-primary btn-block">Submit otp</button>
                        </div>

                    <?php } else { ?>
                        <div class="col-4">
                            <div class="col-4">
                                <button type="submit" name="forget" class="btn btn-primary btn-block">Reset password</button>
                            </div>
                            <div class="col-12" id="loader_section"></div>
                        </div>
                    <?php }
                    ?>
                    <br>
                    <?php if ($msg == 1) { ?>
                        <strong> <p class="text-danger text-light bg-white p-2"> <?php echo  $phone ?> is not match with our records <a href="index">back</a> </p>
                        </strong>
                    <?php  } elseif ($msg == 2) { ?>
                        <small class="text-danger text-light"> Please enter valid otp <?php echo  $otp ?> </small>

                    <?php           } ?>
                </form>
                <br><br>
            </center>
        </div>
        </div>

    </body>
    <style>
        .or {
            color: orangered !important;
        }

        .text-center {

            color: white;
            margin-top: 100px;
        }

        @media screen and (min-width: 560px) {
            .text-center {
                color: white;
            }
        }
    </style>
    <footer class=" footer text-center mt-5 mt-lg-5 p-5">
        <strong>
            <p>&copy; <?php echo date("Y"); ?> <a class="or" style="color: #a82b12;" target="_blank" href="https://www.srinathuniversity.in/">SRINATH UNIVERSITY </a> All Right Reserved. Powered By <a class="text-success" href="http://infinitenetsolutions.com/" target="_blank">Infinite Net Solutions</a></p>
    </footer>

    </html>
<?php } ?>
<!--  rtrt-->