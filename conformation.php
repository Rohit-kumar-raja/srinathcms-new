<?php
include './Backend/connection.inc.php';
include './Backend/function.inc.php';
if (isset($_SESSION['email']) && ($_SESSION['email'] != '')) {
    $course_name1 = trim($_SESSION['course_name']);
    $course_name_query = "SELECT * FROM `tbl_course` WHERE `course_name`='$course_name1'";
    $course_name_result = mysqli_query($connection, $course_name_query);
    $course_name_data = mysqli_fetch_array($course_name_result);
    $ammout = $course_name_data['prospectus_rate'];


?>
    <html>

    <head>

        <title>Registration Payment</title>


        <link rel="icon" href="app-assets/images/logo/favicon-32x32.png" sizes="32x32">
        <link rel="icon" href="app-assets/images/logo/favicon-192x192.png" sizes="192x192">
        <link rel="apple-touch-icon" href="app-assets/images/logo/favicon-apple.png">

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- BEGIN VENDOR CSS-->
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/vendors.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/flag-icon/css/flag-icon.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/dropify/css/dropify.min.css">
        <!-- END VENDOR CSS-->
        <!-- BEGIN THEME  CSS-->
        <!-- END THEME  CSS-->
        <!-- BEGIN Page Level CSS-->
        <link rel="stylesheet" type="text/css" href="app-assets/css/themes/vertical-gradient-menu-template/materialize.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/themes/vertical-gradient-menu-template/style.css">
        <!-- END Page Level CSS-->
        <!-- BEGIN Custom CSS-->
        <link rel="stylesheet" type="text/css" href="app-assets/css/custom/custom.css">
        <!-- END Custom CSS-->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>

    <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-modern-menu" data-color="" data-col="2-columns">


        <!--
    //////////////////////////////////////////////////////////////////////////// -->
        <!-- START HEADER -->
        <header class="page-topbar" id="header">

            <nav class="whitenav">
                <div class="nav-wrapper">
                    <img width="220" src="./asset/img/logo.png" alt="Srinath logo">
                    <ul class="right">
                        <li><a class="dropdown-trigger whitenav" href="#!" data-target="dropdown1"><?php echo $_SESSION['name']; ?><i class="material-icons right">arrow_drop_down</i></a>
                            <div id="dropdown1" class="dropdown-content" tabindex="0">
                                <a href="./Backend/logout.php" class="whitenav" tabindex="0">Log Out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!--
            <div class="row">
                <div class="col s6 m6 l6 margin-left"><img src="app-assets/images/logo/logo.jpg" /></div>
            </div>
        -->
        </header>
        <!-- END HEADER -->
        <!-- START MAIN -->
        <div>
            <!-- START WRAPPER -->
            <div class="row">
                <section class="content-wrapper-before">
                    <!--start container-->
                    <div class="col s12">
                        <h4>Please pay for registration</h4>
                        <div class="row">
                            <div class="col s12">
                                <form action="./library/easebuzz.php?api_name=initiate_payment" id="payment_form" method="POST">
                                    <!-- here i hava to set the ammount for paying fee in sesssion  -->
                                    <?php $_SESSION['ammount'] = $ammout; ?>
                                    <table border="1">
                                        <tbody>
                                            <tr>
                                                <td>Course Name</td>
                                                <td><?php echo $_SESSION['course_name']; ?></td>
                                            </tr>

                                            <tr>
                                                <td>Payment</td>
                                                <td><?php echo $ammout; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Academic Session</td>
                                                <td><?php echo $_SESSION['course_session']; ?></td>
                                            </tr>

                                            <tr>
                                                <td>Name</td>
                                                <td><?php echo $_SESSION['name'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td><?php echo $_SESSION['email']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Mobile</td>
                                                <td><?php echo $_SESSION['phone']; ?></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <input type="submit" class="btn btn-primary" value="Continue">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- END CONTENT -->
                <!--
              //////////////////////////////////////////////////////////////////////////// -->
            </div>
            <!-- END WRAPPER -->
        </div>
        <!-- END MAIN -->
        <!--
      //////////////////////////////////////////////////////////////////////////// -->
        <!-- START FOOTER -->
        <footer class="page-footer footer footer-static footer-dark gradient-45deg-indigo-purple gradient-shadow navbar-border navbar-shadow"></footer>
        <!-- END FOOTER -->
        <!-- ================================================
      Scripts
      ================================================ -->
        <!-- END: Footer-->
        <!-- BEGIN VENDOR JS-->
        <script src="app-assets/js/vendors.min.js"></script>
        <!-- BEGIN VENDOR JS-->
        <!-- BEGIN PAGE VENDOR JS-->
        <script src="app-assets/vendors/dropify/js/dropify.min.js"></script>
        <script src="app-assets/vendors/jquery-validation/jquery.validate.min.js"></script>
        <!-- END PAGE VENDOR JS-->
        <!-- BEGIN THEME  JS-->
        <script src="app-assets/js/plugins.js"></script>
        <script src="app-assets/js/search.js"></script>
        <script src="app-assets/js/custom/custom-script.js"></script>
        <!-- END THEME  JS-->
        <!-- BEGIN PAGE LEVEL JS-->
        <script src="app-assets/js/scripts/form-file-uploads.js"></script>
        <script src="app-assets/js/scripts/form-validation.js"></script>
        <!-- END PAGE LEVEL JS-->


    </body>

    </html>
<?php } else {
    echo "<script>

    window.location.replace('./index.php');
</script>";
}
?>
<!-- here i hava to getting the data and seding the data in payment getway library page -->

<?php

?>