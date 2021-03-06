<?php
//Starting Session
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//error_reporting(0);

//   echo"<pre>"; print_r($_POST); //exit();


if (empty(session_start()))
    session_start();
//DataBase Connectivity
include "config.php";
include "db_class.php";
// Setting Time Zone in India Standard Timing
$random_number = rand(111111, 999999); // Random Number
$visible = md5("visible");
$trash = md5("trash");
date_default_timezone_set("Asia/Calcutta");
$date_variable_today_month_year_with_timing = date("d M, Y. h:i A");
//All File Directries Start
$university_logos_dir = "../images/university_logos";
$admission_profile_image_dir = "../images/student_images";
$certificates = "../images/student_certificates";
$nssImageDir = "../images/nss/";
//Creating Object NSUNIV
$objectDefault = new DBEVAL();
$objectDefault->sql = "";
$objectDefault->hostName = "";
$objectDefault->userName = "";
$objectDefault->password = "";
$objectDefault->dbName =   "";
// $objectDefault->new_db("localhost", "nsucms_demo_nsuniv", "4rp5NsX7", "nsucms_demo_nsuniv");
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $objectDefault->new_db("localhost", "root", "", "srinath_demo_cms");
}
// if the database in the server
else {
    $objectDefault->new_db("localhost", "srinathuniversity_demo_cms", "Rohit83013@#", "srinathuniversity_demo_cms");
}
//Creating Object NSUCMS
$objectSecond = new DBEVAL();
$objectSecond->sql = "";
$objectSecond->hostName = "";
$objectSecond->userName = "";
$objectSecond->password = "";
$objectSecond->dbName =   "";
// $objectSecond->new_db("localhost", "nsucms_cms", "wpNnnOv5", "nsucms_cms");
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $objectSecond->new_db("localhost", "root", "", "srinath_cms");
}
// if the database in the server
else {
    $objectSecond->new_db("localhost", "srinathuniversityerp_srinath_cms", "Rohit83013@#", "srinathuniversityerp_srinath_cms");
}

//All File Directries End
if (isset($_POST["action"])) {

    //Action Section Start
    /* ---------- All Admin(Backend) Codes Start ---------- */
    //Login Section Start With Ajax
    if ($_POST["action"] == "admin_login") {
        $admin_login_username = $_POST["admin_login_username"];
        $admin_login_password = md5($_POST["admin_login_password"]);
        if (!empty($admin_login_username && $admin_login_password)) {
            $sql = "SELECT * FROM `tbl_admin`
                        WHERE `admin_username` = '$admin_login_username' && `admin_password` = '$admin_login_password' && `status` = '$visible'
                        ";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($row["admin_type"] == "superadmin") {
                    $_SESSION["logger_type"] = "admin";
                    $_SESSION["admin_name"] = $row["admin_name"];
                } else {
                    $_SESSION["logger_type"] = "subadmin";
                    $_SESSION["authority"] = $row["admin_permission"];
                    $_SESSION["admin_name"] = $row["admin_name"];
                }
                $_SESSION["admin_email"] = $row["admin_email"];

                $_SESSION["logger_username"] = $admin_login_username;
                $_SESSION["logger_password"] = $admin_login_password;
                $_SESSION["logger_time"] = time();
                echo '
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                            <i class="icon fas fa-check"></i> You have logged in Successfully!!!
                        </div>';
                echo "<script> location.replace('dashboard') </script>";
            } else
                echo '
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                            <i class="icon fas fa-ban"></i> Incorrect Credential, Please try again!!!
                        </div>';
        } else {
            echo '
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                        <i class="icon fas fa-exclamation-triangle"></i>  Please fill out Username and Password!!!
                    </div>';
        }
    }
    //Login Section End With Ajax
    //Change Password Section Start With Ajax
    if ($_POST["action"] == "sendOtpForPassword") {
        if (isset($_SESSION["logger_username"])) {
            $sql = "SELECT * FROM `tbl_admin`
                        WHERE `admin_username` = '" . $_SESSION["logger_username"] . "' && `admin_password` = '" . $_SESSION["logger_password"] . "' && `status` = '$visible'
                        ";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (isset($_SESSION["OTP_REAR"]))
                    unset($_SESSION["OTP_REAR"]);
                $_SESSION["OTP_REAR"] = $random_number;
                $message = "Your OTP for Change password $random_number, Please do not share this OTP to anyone.\n\n Regards,\nSrinath University, JSR";
                $objectSecond->send_otp($row["admin_mobile"], $message);
                echo "success";
            }
        }
    }
    if ($_POST["action"] == "checkOtpForPassword") {
        if (isset($_SESSION["OTP_REAR"])) {
            if ($_SESSION["OTP_REAR"] == $_POST["checkOTPForPass"]) {
                echo "success";
                unset($_SESSION["OTP_REAR"]);
            } else
                echo "Incorrect OTP, Please try again with correct OTP...";
        } else
            echo "Something went wrong plase try again...";
    }
    if ($_POST["action"] == "changeForPassword") {
        if (isset($_SESSION["logger_username"])) {
            $sql = "UPDATE `tbl_admin` SET `admin_password` = '" . md5($_POST["changePassOne"]) . "'
                        WHERE `admin_username` = '" . $_SESSION["logger_username"] . "' && `admin_password` = '" . $_SESSION["logger_password"] . "' && `status` = '$visible'
                        ";
            if ($con->query($sql))
                echo "success";
            else
                echo "Something went wrong please try agian...";
        } else
            echo "Something went wrong please try agian...";
    }
    //Change Password Section End With Ajax
    //Add University Details Start
    if ($_POST["action"] == "add_university_details") {
        $add_university_details_financial_start_date = $_POST["add_university_details_financial_start_date"];
        $add_university_details_financial_end_date = $_POST["add_university_details_financial_end_date"];
        $add_university_details_academic_start_date = $_POST["add_university_details_academic_start_date"];
        $add_university_details_academic_end_date = $_POST["add_university_details_academic_end_date"];
        $add_university_details_university_name = $_POST["add_university_details_university_name"];
        $add_university_details_affiliation_details = $_POST["add_university_details_affiliation_details"];
        $add_university_details_address = $_POST["add_university_details_address"];
        $add_university_details_email = $_POST["add_university_details_email"];
        $add_university_details_contact = $_POST["add_university_details_contact"];
        $add_university_details_logo_image = $_FILES["add_university_details_logo_image"]["name"];
        $add_university_details_website_url = $_POST["add_university_details_website_url"];
        if (!empty($add_university_details_financial_start_date && $add_university_details_financial_end_date && $add_university_details_academic_start_date && $add_university_details_academic_end_date && $add_university_details_university_name && $add_university_details_affiliation_details && $add_university_details_address && $add_university_details_email && $add_university_details_contact && $add_university_details_logo_image && $add_university_details_website_url)) {
            $add_university_details_logo_image_rand = $random_number . "_" . $add_university_details_logo_image;
            if (move_uploaded_file($_FILES["add_university_details_logo_image"]["tmp_name"], "$university_logos_dir/$add_university_details_logo_image_rand")) {
                // $sql = "INSERT INTO `tbl_university_details`
                //         (`university_details_id`, `university_details_financial_start_date`, `university_details_financial_end_date`, `university_details_academic_start_date`, `university_details_academic_end_date`, `university_details_university_name`, `university_details_affiliation_details`, `university_details_address`, `university_details_email`, `university_details_contact`, `university_details_logo_image`, `university_details_website_url`, `status`) 
                //         VALUES 
                //         ('','$add_university_details_financial_start_date','$add_university_details_financial_end_date','$add_university_details_academic_start_date','$add_university_details_academic_end_date','$add_university_details_university_name','$add_university_details_affiliation_details','$add_university_details_address','$add_university_details_email','$add_university_details_contact','$add_university_details_logo_image_rand','$add_university_details_website_url','$visible')
                //         ";
                echo "<pre>";
                echo       $sql = "INSERT INTO `tbl_university_details`
                (`university_details_financial_start_date`, `university_details_financial_end_date`, `university_details_academic_start_date`, `university_details_academic_end_date`, `university_details_university_name`, `university_details_affiliation_details`, `university_details_address`, `university_details_email`, `university_details_contact`, `university_details_logo_image`, `university_details_website_url`, `status`) 
                VALUES 
                ('$add_university_details_financial_start_date','$add_university_details_financial_end_date','$add_university_details_academic_start_date','$add_university_details_academic_end_date','$add_university_details_university_name','$add_university_details_affiliation_details','$add_university_details_address','$add_university_details_email','$add_university_details_contact','$add_university_details_logo_image_rand','$add_university_details_website_url','$visible')
                ";

                if ($con->query($sql)) {
                    echo "<script>
                            alert('University details added successfully!!!');
                            location.replace('../add_university_details');
                        </script>";
                } else
                    echo "<script>
                            alert('Something went wrong please try again!!!');
                            location.replace('../add_university_details');
                        </script>";
            } else
                echo "<script>
                            alert('Something went wrong please try again!!!');
                            location.replace('../add_university_details');
                        </script>";
        } else {
            echo "<script>
                        alert('Please fill out all required fields!!!');
                        location.replace('../add_university_details');
                    </script>";
        }
    }
    //Add University Details End
    //Add Courses Start With Ajax
    if ($_POST["action"] == "add_courses") {
        $add_course_name = $_POST["add_course_name"];
        $prospectus_fee = $_POST['prospectus_fee'];
        $duration = $_POST['prospectus_duration'];
        if (!empty($add_course_name)) {
            $sql = "SELECT * FROM `tbl_course`
                        WHERE `status` = '$visible' && `course_name` = '$add_course_name'
                        ";
            $result = $con->query($sql);
            if ($result->num_rows > 0)
                echo '
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                            <i class="icon fas fa-exclamation-triangle"></i> This Course already exsits!!!
                        </div>';
            else {
                $sql = "INSERT INTO `tbl_course`(`course_name`, `prospectus_rate`, `course_duration`, `course_time`, `status`, `course_type_id`) VALUES 
                ('$add_course_name','$prospectus_fee','$duration','$date_variable_today_month_year_with_timing','$visible','0')";



                // "INSERT INTO `tbl_course`
                //             (`course_id`, `course_name`, `prospectus_rate`,`course_time`, `status`) 
                //             VALUES 
                //             (NULL,'$add_course_name','$prospectus_fee','$date_variable_today_month_year_with_timing','$visible')
                //             ";
                if ($con->query($sql))
                    echo '
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                                <i class="icon fas fa-check"></i> Course added successfully!!!
                            </div>';
                else
                    echo '
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                                <i class="icon fas fa-ban"></i> Something went wrong please try again!!!
                            </div>';
            }
        } else
            echo '
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                        <i class="icon fas fa-exclamation-triangle"></i>  Please fill out Course Name!!!
                    </div>';
    }
    //Add Courses End With Ajax

    //Edit Examination Fee Details Start With Ajax
    if ($_POST["action"] == "edit_examfees") {
        if (isset($_POST["edit_examfee_status"])) {
            $edit_examfee_status = $_POST["edit_examfee_status"];
            $edit_examfee_id = $_POST["edit_examfee_id"];
            if (!empty($edit_examfee_id && $edit_examfee_status)) {
                if ($edit_examfee_status == "Inactive")
                    $sql = "UPDATE `tbl_examination_fee` 
                                SET 
                                `exfee_astatus`='Active'
                                WHERE `status` = '$visible' && `exfee_id` = '$edit_examfee_id';
                                ";
                if ($edit_examfee_status == "Active")
                    $sql = "UPDATE `tbl_examination_fee` 
                            SET 
                            `exfee_astatus`='Inactive'
                            WHERE `status` = '$visible' && `exfee_id` = '$edit_examfee_id';
                            ";
                if ($con->query($sql))
                    echo 'success';
                else
                    echo 'error';
            } else
                echo 'empty';
        } else {
            $edit_examfee_id = $_POST["edit_examfee_id"];
            $edit_examfee_course_name = $_POST["edit_examfee_course_name"];
            $edit_examfee_particulars = $_POST["edit_examfee_particulars"];
            $edit_examfee_amount = $_POST["edit_examfee_amount"];
            $edit_examfee_fine = $_POST["edit_examfee_fine"];
            $edit_examfee_latedate = $_POST["edit_examfee_latedate"];
            if (!empty($edit_examfee_id && $edit_examfee_course_name && $edit_examfee_particulars && $edit_examfee_amount)) {
                $sql = "UPDATE `tbl_examination_fee` 
                            SET 
                            `course_id`='$edit_examfee_course_name', `exfee_particulars`='$edit_examfee_particulars', `exfee_amount`='$edit_examfee_amount', `exfee_time`='$date_variable_today_month_year_with_timing', `exfee_fine` = '$edit_examfee_fine', `exfee_lastdate` = '$edit_examfee_latedate'
                            WHERE `status` = '$visible' && `exfee_id` = '$edit_examfee_id';
                            ";
                if ($con->query($sql))
                    echo 'success';
                else
                    echo 'error';
            } else
                echo 'empty';
        }
    }
    //Edit Examination  Fee Details End With Ajax



    //Delete Examination Fee Details Start With Ajax
    if ($_POST["action"] == "delete_examfees") {
        $delete_examfee_id = $_POST["delete_examfee_id"];
        if (!empty($delete_examfee_id)) {
            $sql = "UPDATE `tbl_examination_fee` 
                        SET 
                        `status` = '$trash', `exfee_time` = '$date_variable_today_month_year_with_timing' 
                        WHERE `status` = '$visible' && `exfee_id` = '$delete_examfee_id';
                        ";
            if ($con->query($sql))
                echo 'success';
            else
                echo 'error';
        } else
            echo 'empty';
    }
    //Delete Examination Fee Details End With Ajax



    //Edit Courses Start With Ajax
    if ($_POST["action"] == "edit_courses") {

           $edit_course_name = $_POST["edit_course_name"];
           $edit_course_id = $_POST["edit_course_id"];
           $edit_course_duration = $_POST['edit_course_duration'];
           $edit_course_fee = $_POST['edit_course_fee'];
        if (!empty($edit_course_name && $edit_course_id)) {           
                $sql = "UPDATE `tbl_course` 
                            SET 
                            `course_name` = '$edit_course_name',`prospectus_rate`='$edit_course_fee', `course_time` = '$date_variable_today_month_year_with_timing' ,`course_duration`='$edit_course_duration' 
                            WHERE `status` = '$visible' && `course_id` = '$edit_course_id';
                            ";
                if ($con->query($sql))
                    echo 'success';
                else
                    echo 'error';
            
        } else
            echo 'empty';
    }
    //Edit Courses End With Ajax
    //Delete Courses Start With Ajax
    if ($_POST["action"] == "delete_courses") {
        $delete_course_id = $_POST["delete_course_id"];
        if (!empty($delete_course_id)) {
            $sql = "UPDATE `tbl_course` 
                        SET 
                        `status` = '$trash', `course_time` = '$date_variable_today_month_year_with_timing' 
                        WHERE `status` = '$visible' && `course_id` = '$delete_course_id';
                        ";
            if ($con->query($sql))
                echo 'success';
            else
                echo 'error';
        } else
            echo 'empty';
    }
    //Delete Courses End With Ajax
    //Add Subject Start With Ajax
    if ($_POST["action"] == "add_subjects") {
        $add_subject_course_name = $_POST["add_subject_course_name"];
        $add_subject_code = $_POST["add_subject_code"];
        $add_subject_name = $_POST["add_subject_name"];
        if (!empty($add_subject_name && $add_subject_code) && ($add_subject_course_name != "select")) {
            $sql = "SELECT * FROM `tbl_subject`
                        WHERE `status` = '$visible' && `subject_code` = '$add_subject_code' && `subject_course_name` = '$add_subject_course_name'
                        ";
            $result = $con->query($sql);
            if ($result->num_rows > 0)
                echo '
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                            <i class="icon fas fa-exclamation-triangle"></i> This Subject Code already exsits in ' . $add_subject_course_name . ' Course!!!
                        </div>';
            else {
                $sql = "INSERT INTO `tbl_subject`
                            (`subject_id`, `subject_course_name`, `subject_code`, `subject_name`, `subject_time`, `status`) 
                            VALUES 
                            (NULL,'$add_subject_course_name','$add_subject_code','$add_subject_name','$date_variable_today_month_year_with_timing','$visible')
                            ";
                if ($con->query($sql))
                    echo '
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                                <i class="icon fas fa-check"></i> Subject added successfully!!!
                            </div>';
                else
                    echo '
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                                <i class="icon fas fa-ban"></i> Something went wrong please try again!!!
                            </div>';
            }
        } else
            echo '
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                        <i class="icon fas fa-exclamation-triangle"></i>  Please fill out all required fields!!!
                    </div>';
    }
    //Add Subject End With Ajax
    //Edit Subject Start With Ajax
    if ($_POST["action"] == "edit_subjects") {
        $edit_subject_course_name = $_POST["edit_subject_course_name"];
        $edit_subject_code = $_POST["edit_subject_code"];
        $edit_subject_name = $_POST["edit_subject_name"];
        $edit_subject_id = $_POST["edit_subject_id"];
        if (!empty($edit_subject_name && $edit_subject_id)) {
            $sql = "SELECT * FROM `tbl_subject`
                        WHERE `status` = '$visible' && `subject_code` = '$edit_subject_code' && `subject_course_name` = '$edit_subject_course_name' && `subject_name` = '$edit_subject_name';
                        ";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                echo 'exsits';
            } else {
                $sql = "UPDATE `tbl_subject` 
                            SET 
                            `subject_course_name` = '$edit_subject_course_name', `subject_code` = '$edit_subject_code', `subject_name` = '$edit_subject_name', `subject_time` = '$date_variable_today_month_year_with_timing' 
                            WHERE `status` = '$visible' && `subject_id` = '$edit_subject_id';
                            ";
                if ($con->query($sql))
                    echo 'success';
                else
                    echo 'error';
            }
        } else
            echo 'empty';
    }
    //Edit Subject End With Ajax
    //Delete Subject Start With Ajax
    if ($_POST["action"] == "delete_subjects") {
        $delete_subject_id = $_POST["delete_subject_id"];
        if (!empty($delete_subject_id)) {
            $sql = "UPDATE `tbl_subject` 
                        SET 
                        `status` = '$trash', `subject_time` = '$date_variable_today_month_year_with_timing' 
                        WHERE `status` = '$visible' && `subject_id` = '$delete_subject_id';
                        ";
            if ($con->query($sql))
                echo 'success';
            else
                echo 'error';
        } else
            echo 'empty';
    }
    //Delete Subject End With Ajax
    //Restore From Trash Start With Ajax
    if ($_POST["action"] == "trash_restore") {
        $action_tbl = $_POST["action_tbl"];
        $restore_id = $_POST["restore_id"];
        $id_name = "";
        if (!empty($action_tbl && $restore_id)) {
            switch ($action_tbl) {
                case "tbl_admin":
                    $id_name = "admin_id";
                    break;
                case "tbl_course";
                    $id_name = "course_id";
                    break;
                case "tbl_subject":
                    $id_name = "subject_id";
                    break;
                case "tbl_university_details";
                    $id_name = "university_details_id";
                    break;
                case "tbl_prospectus";
                    $id_name = "id";
                    break;
                default:
                    $id_name = "";
                    break;
            }
            if (!empty($id_name)) {
                $sql = "UPDATE `$action_tbl` 
                            SET 
                            `status` = '$visible'
                            WHERE `$id_name` = '$restore_id' && `status` = '$trash'
                            ";
                if ($con->query($sql))
                    echo 'success';
                else
                    echo 'error';
            } else
                echo 'error';
        } else
            echo 'empty';
    }
    //Restore From Trash End With Ajax
    //Delete From Trash Start With Ajax
    if ($_POST["action"] == "trash_delete") {
        echo    $action_tbl = $_POST["action_tbl"];
        echo  $delete_id = $_POST["delete_id"];
        $id_name = "";

        if (!empty($action_tbl && $delete_id)) {
            switch ($action_tbl) {
                case "tbl_admin":
                    $id_name = "admin_id";
                    break;
                case "tbl_course";
                    $id_name = "course_id";
                    break;
                case "tbl_subject":
                    $id_name = "subject_id";
                    break;
                case "tbl_university_details";
                    $id_name = "university_details_id";
                    break;
                case "tbl_prospectus";
                    $id_name = "id";
                    break;
                default:
                    $id_name = "";
                    break;
            }
            if (!empty($id_name)) {
                echo   $sql = "DELETE FROM `$action_tbl` 
                            WHERE `$id_name` = '$delete_id' && `status` = '$trash'
                            ";
                if ($con->query($sql))
                    echo 'success';
                else
                    echo 'error';
            } else
                echo 'error';
        } else
            echo 'empty';
    }
    //Delete From Trash End With Ajax
    //Add Fee Start With Ajax
    if ($_POST["action"] == "add_fees") {

        $fee_type = $_POST["fee_type"];
        $course_id = $_POST["course_id"];
        $academic_year = $_POST["academic_year"];
        $particulars = $_POST["particulars"];
        $amount = $_POST["amount"];
        $fine = $_POST["fine"];
        $lastdate = $_POST["lastdate"];
        $astatus = $_POST["astatus"];

        //echo $fee_type;
        //ADD FEE START
        if ($fee_type == 'Examination Fee') {

            if (!empty($fee_type && $course_id && $academic_year) && $particulars[0] != "" && $amount[0] != "" && $fine[0] != "" && $lastdate[0] != "" && $astatus[0] != "") {
                $allParticulars = count($particulars);
                $allAmount = count($amount);
                //$allFee = count($fee);
                //$allLastdate = count($lastdate);
                //$allAstatus = count($astatus);
                if ($course_id == "all") {
                    $sql = "SELECT * FROM `tbl_course`
                            WHERE `status` = '$visible'
                            ";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                        $sql = "";
                        while ($row = $result->fetch_assoc()) {
                            $course_id_all = $row["course_id"];
                            for ($i = 0; $i < $allParticulars; $i++) {
                                $sql_check = "SELECT * FROM `tbl_examination_fee`
                                             WHERE `status` = '$visible' && `course_id` = '$course_id_all' && `exfee_academic_year` = '$academic_year' && `exfee_particulars` = '$particulars[$i]';
                                             ";
                                $result_check = $con->query($sql_check);
                                if ($result_check->num_rows > 0) {
                                    $row_check = $result_check->fetch_assoc();
                                    $sql .= "UPDATE `tbl_examination_fee` 
                                            SET `exfee_amount`='$amount[$i]',`exfee_time`='$date_variable_today_month_year_with_timing'
                                            WHERE `exfee_id` = '" . $row_check['exfee_id'] . "';
                                            ";
                                } else {
                                    $sql .= "INSERT INTO `tbl_examination_fee`
                                            (`exfee_id`, `course_id`, `exfee_academic_year`, `exfee_particulars`, `exfee_amount`, `exfee_fine`,`exfee_lastdate`,`exfee_astatus`,`exfee_time`, `status`) 
                                            VALUES 
                                            (NULL,'$course_id_all','$academic_year','$particulars[$i]','$amount[$i]','$fine[$i]','$lastdate[$i]','$astatus[$i]','$date_variable_today_month_year_with_timing','$visible');
                                            ";
                                }
                            }
                        }
                        if ($con->multi_query($sql))
                            echo 'success';
                        else
                            echo 'error1';
                    } else
                        echo 'courseempty';
                } else {
                    $sql = "";
                    for ($i = 0; $i < $allParticulars; $i++) {
                        $sql_check = "SELECT * FROM `tbl_examination_fee`
                                     WHERE `status` = '$visible' && `course_id` = '$course_id' && `exfee_academic_year` = '$academic_year' && `exfee_particulars` = '$particulars[$i]';
                                     ";
                        $result = $con->query($sql_check);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $sql .= "UPDATE `tbl_examination_fee` 
                                    SET `exfee_amount`='$amount[$i]',`exfee_time`='$date_variable_today_month_year_with_timing'
                                    WHERE `status` = '$visible' && `course_id` = '$course_id' && `exfee_academic_year` = '$academic_year' && `exfee_particulars` = '$particulars[$i]';
                                    ";
                        } else {
                            $sql .= "INSERT INTO `tbl_examination_fee`
                                    (`exfee_id`, `course_id`, `exfee_academic_year`, `exfee_particulars`, `exfee_amount`,`exfee_fine`,`exfee_lastdate`,`exfee_astatus`, `exfee_time`, `status`) 
                                    VALUES 
                                    (NULL,'$course_id','$academic_year','$particulars[$i]','$amount[$i]','$fine[$i]','$lastdate[$i]','$astatus[$i]','$date_variable_today_month_year_with_timing','$visible');
                                    ";
                        }
                    }
                    if ($con->multi_query($sql))
                        echo 'success';
                    else
                        echo 'error2';
                }
            } else
                echo 'empty';
        }

        //ADD FEE END


        //ADD EXAM FEE START

        else {

            //echo 'working1242';  exit;

            if (!empty($fee_type && $course_id && $academic_year) && $particulars[0] != "" && $amount[0] != "" && $fine[0] != "" && $lastdate[0] != "" && $astatus[0] != "") {
                $allParticulars = count($particulars);
                $allAmount = count($amount);
                //$allFee = count($fee);
                //$allLastdate = count($lastdate);
                //$allAstatus = count($astatus);
                if ($course_id == "all") {
                    $sql = "SELECT * FROM `tbl_course`
                            WHERE `status` = '$visible'
                            ";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                        $sql = "";
                        while ($row = $result->fetch_assoc()) {
                            $course_id_all = $row["course_id"];
                            for ($i = 0; $i < $allParticulars; $i++) {
                                $sql_check = "SELECT * FROM `tbl_fee`
                                             WHERE `status` = '$visible' && `course_id` = '$course_id_all' && `fee_academic_year` = '$academic_year' && `fee_particulars` = '$particulars[$i]';
                                             ";
                                $result_check = $con->query($sql_check);
                                if ($result_check->num_rows > 0) {
                                    $row_check = $result_check->fetch_assoc();
                                    $sql .= "UPDATE `tbl_fee` 
                                            SET `fee_amount`='$amount[$i]',`fee_time`='$date_variable_today_month_year_with_timing'
                                            WHERE `fee_id` = '" . $row_check['fee_id'] . "';
                                            ";
                                } else {
                                    $sql .= "INSERT INTO `tbl_fee`
                                            (`fee_id`, `course_id`, `fee_academic_year`, `fee_particulars`, `fee_amount`, `fee_fine`,`fee_lastdate`,`fee_astatus`,`fee_time`, `status`) 
                                            VALUES 
                                            (NULL,'$course_id_all','$academic_year','$particulars[$i]','$amount[$i]','$fine[$i]','$lastdate[$i]','$astatus[$i]','$date_variable_today_month_year_with_timing','$visible');
                                            ";
                                }
                            }
                        }
                        if ($con->multi_query($sql))
                            echo 'success';
                        else
                            echo 'error';
                    } else
                        echo 'courseempty';
                } else {
                    $sql = "";
                    for ($i = 0; $i < $allParticulars; $i++) {
                        $sql_check = "SELECT * FROM `tbl_fee`
                                     WHERE `status` = '$visible' && `course_id` = '$course_id' && `fee_academic_year` = '$academic_year' && `fee_particulars` = '$particulars[$i]';
                                     ";
                        $result = $con->query($sql_check);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $sql .= "UPDATE `tbl_fee` 
                                    SET `fee_amount`='$amount[$i]',`fee_time`='$date_variable_today_month_year_with_timing'
                                    WHERE `status` = '$visible' && `course_id` = '$course_id' && `fee_academic_year` = '$academic_year' && `fee_particulars` = '$particulars[$i]';
                                    ";
                        } else {
                            $sql .= "INSERT INTO `tbl_fee`
                                    (`fee_id`, `course_id`, `fee_academic_year`, `fee_particulars`, `fee_amount`,`fee_fine`,`fee_lastdate`,`fee_astatus`, `fee_time`, `status`) 
                                    VALUES 
                                    (NULL,'$course_id','$academic_year','$particulars[$i]','$amount[$i]','$fine[$i]','$lastdate[$i]','$astatus[$i]','$date_variable_today_month_year_with_timing','$visible');
                                    ";
                        }
                    }
                    if ($con->multi_query($sql))
                        echo 'success';
                    else
                        echo 'error';
                }
            } else
                echo 'empty';
        }

        //END EXAM FEE START

    }
    //Add Fee End With Ajax


    //Edit Fee Details Start With Ajax
    if ($_POST["action"] == "edit_fees") {
        if (isset($_POST["edit_fee_status"])) {
            $edit_fee_status = $_POST["edit_fee_status"];
            $edit_fee_id = $_POST["edit_fee_id"];
            if (!empty($edit_fee_id && $edit_fee_status)) {
                if ($edit_fee_status == "Inactive")
                    $sql = "UPDATE `tbl_fee` 
                                SET 
                                `fee_astatus`='Active'
                                WHERE `status` = '$visible' && `fee_id` = '$edit_fee_id';
                                ";
                if ($edit_fee_status == "Active")
                    $sql = "UPDATE `tbl_fee` 
                            SET 
                            `fee_astatus`='Inactive'
                            WHERE `status` = '$visible' && `fee_id` = '$edit_fee_id';
                            ";
                if ($con->query($sql))
                    echo 'success';
                else
                    echo 'error';
            } else
                echo 'empty';
        } else {
            $edit_fee_id = $_POST["edit_fee_id"];
            $edit_fee_course_name = $_POST["edit_fee_course_name"];
            $edit_fee_particulars = $_POST["edit_fee_particulars"];
            $edit_fee_amount = $_POST["edit_fee_amount"];
            $edit_fee_fine = $_POST["edit_fee_fine"];
            $edit_fee_latedate = $_POST["edit_fee_latedate"];
            if (!empty($edit_fee_id && $edit_fee_course_name && $edit_fee_particulars && $edit_fee_amount)) {
                $sql = "UPDATE `tbl_fee` 
                            SET 
                            `course_id`='$edit_fee_course_name', `fee_particulars`='$edit_fee_particulars', `fee_amount`='$edit_fee_amount', `fee_time`='$date_variable_today_month_year_with_timing', `fee_fine` = '$edit_fee_fine', `fee_lastdate` = '$edit_fee_latedate'
                            WHERE `status` = '$visible' && `fee_id` = '$edit_fee_id';
                            ";
                if ($con->query($sql))
                    echo 'success';
                else
                    echo 'error';
            } else
                echo 'empty';
        }
    }
    //Edit Fee Details End With Ajax
    //Delete Fee Details Start With Ajax
    if ($_POST["action"] == "delete_fees") {
        $delete_fee_id = $_POST["delete_fee_id"];
        if (!empty($delete_fee_id)) {
            $sql = "UPDATE `tbl_fee` 
                        SET 
                        `status` = '$trash', `fee_time` = '$date_variable_today_month_year_with_timing' 
                        WHERE `status` = '$visible' && `fee_id` = '$delete_fee_id';
                        ";
            if ($con->query($sql))
                echo 'success';
            else
                echo 'error';
        } else
            echo 'empty';
    }
    //Delete Fee Details End With Ajax
    //Add late Fee Start With Ajax
    if ($_POST["action"] == "add_latefees") {
        $fine_amount = $_POST["fine_amount"];
        if (!empty($fine_amount)) {
            $sql = "SELECT * FROM `tbl_latefee`
                        WHERE `status` = '$visible';
                        ";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                $sql = "Update `tbl_latefee`
                            SET `latefee_fine`='$fine_amount',`latefee_time`='$date_variable_today_month_year_with_timing',`status`='$visible' 
                            WHERE `status` = '$visible';
                            ";
                if ($con->query($sql))
                    echo 'update';
                else
                    echo 'error';
            } else {
                $sql = "INSERT INTO `tbl_latefee`
                            (`latefee_id`, `latefee_fine`, `latefee_time`, `status`) 
                            VALUES 
                            (NULL,'$fine_amount','$date_variable_today_month_year_with_timing','$visible');
                            ";
                if ($con->query($sql))
                    echo 'success';
                else
                    echo 'error';
            }
        } else
            echo 'empty';
    }
    //Add Late Fee End With Ajax
    //Add Due Date Start With Ajax
    if ($_POST["action"] == "add_duedates") {
        $academic_year = $_POST["academic_year"];
        $april_date = $_POST["april_date"];
        $may_date = $_POST["may_date"];
        $june_date = $_POST["june_date"];
        $july_date = $_POST["july_date"];
        $august_date = $_POST["august_date"];
        $september_date = $_POST["september_date"];
        $october_date = $_POST["october_date"];
        $november_date = $_POST["november_date"];
        $december_date = $_POST["december_date"];
        $january_date = $_POST["january_date"];
        $february_date = $_POST["february_date"];
        $march_date = $_POST["march_date"];
        $month_array = array("April", "May", "June", "July", "August", "September", "October", "November", "December", "January", "February", "March");
        $month_date = array("$april_date", "$may_date", "$june_date", "$july_date", "$august_date", "$september_date", "$october_date", "$november_date", "$december_date", "$january_date", "$february_date", "$march_date");
        if ($academic_year != "select" && ($april_date || $may_date || $june_date || $july_date || $august_date || $september_date || $october_date || $november_date || $december_date || $january_date || $february_date || $march_date)) {
            $imploded_month_array = implode(",", $month_array);
            $imploded_month_date = implode(",", $month_date);
            $sql = "SELECT * FROM `tbl_fee_due_date`
                        WHERE `status` = '$visible' && `fee_due_date_academic_year` = '$academic_year';
                        ";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $sql = "UPDATE `tbl_fee_due_date` 
                            SET `fee_due_date_month_array`='$imploded_month_array', `fee_due_date_month_date`='$imploded_month_date', `fee_due_date_time`='$date_variable_today_month_year_with_timing'
                            WHERE `fee_due_date_id` = '" . $row["fee_due_date_id"] . "' && `fee_due_date_academic_year` = '$academic_year';
                            ";
                if ($con->query($sql))
                    echo 'update';
                else
                    echo 'error';
            } else {
                $sql = "INSERT INTO `tbl_fee_due_date`
                            (`fee_due_date_id`, `fee_due_date_academic_year`, `fee_due_date_month_array`, `fee_due_date_month_date`, `fee_due_date_time`, `status`) 
                            VALUES 
                            (NULL,'$academic_year','$imploded_month_array','$imploded_month_date','$date_variable_today_month_year_with_timing','$visible');
                            ";
                if ($con->query($sql))
                    echo 'success';
                else
                    echo 'error';
            }
        } else
            echo 'empty';
    }
    //Add Due Date End With Ajax
    //Edit Student Details Start With Ajax
    if ($_POST["action"] == "edit_student_lists") {
        $edit_admission_id = $_POST["edit_admission_id"];
        $edit_student_list_reg_no = $_POST["edit_student_list_reg_no"];
        $edit_student_list_admission_no = $_POST["edit_student_list_admission_no"];
        $edit_student_list_course_name = $_POST["edit_student_list_course_name"];
        $edit_student_list_session = $_POST["edit_student_list_session"];
        $edit_student_list_first_name = $_POST["edit_student_list_first_name"];
        $edit_student_list_last_name = $_POST["edit_student_list_last_name"];
        $edit_student_list_contact_no = $_POST["edit_student_list_contact_no"];
        $edit_student_list_email = $_POST["edit_student_list_email"];
        $edit_student_list_father_name = $_POST["edit_student_list_fathers_name"];
        $edit_student_list_fathers_contact = $_POST["edit_student_list_fathers_contact"];
        $edit_student_list_hostel = $_POST["edit_student_list_hostel"];
        $edit_student_list_transport = $_POST["edit_student_list_transport"];
        $edit_student_list_username = $_POST["edit_student_list_username"];
        $edit_student_list_password = $_POST["edit_student_list_password"];
        if (!empty($edit_student_list_first_name && $edit_student_list_last_name && $edit_student_list_contact_no && $edit_student_list_fathers_contact && $edit_student_list_username && $edit_student_list_password) && $edit_student_list_father_name != "") {
            $sql = "UPDATE `tbl_admission` 
                        SET 
                        `admission_course_name` = '$edit_student_list_course_name', `admission_session` = '$edit_student_list_session', `admission_first_name` = '$edit_student_list_first_name', `admission_last_name` = '$edit_student_list_last_name', `admission_mobile_student` = '$edit_student_list_contact_no', `admission_emailid_student` = '$edit_student_list_email', `admission_father_name` = '$edit_student_list_father_name', `admission_father_phoneno` = '$edit_student_list_fathers_contact', `admission_hostel` = '$edit_student_list_hostel', `admission_transport` = '$edit_student_list_transport', `admission_username` = '$edit_student_list_username', `admission_password` = '$edit_student_list_password'
                        WHERE `status` = '$visible' && `admission_id` = '$edit_admission_id';
                        ";
            if ($con->query($sql))
                echo 'success';
            else
                echo 'error';
        } else
            echo 'empty';
    }
    //Edit Student Details End With Ajax
    //Delete Student Details Start With Ajax
    if ($_POST["action"] == "delete_student_lists") {
        $delete_admission_id = $_POST["delete_admission_id"];
        if (!empty($delete_admission_id)) {
            $sql = "DELETE FROM `tbl_admission`
                        WHERE `status` = '$visible' && `admission_id` = '$delete_admission_id';
                        ";
            if ($con->query($sql))
                echo 'success';
            else
                echo 'error';
        } else
            echo 'empty';
    }
    //Delete Student Details End With Ajax
    //Edit Fee Paid Status Start With Ajax
    if ($_POST["action"] == "change_Fee_Status") {
        $feepaid_id = $_POST["feepaid_id"];
        $status = $_POST["status"];
        if (!empty($feepaid_id && $status)) {
            $sql = "UPDATE `tbl_fee_paid` 
                        SET 
                        `payment_status` = '$status'
                        WHERE `status` = '$visible' && `feepaid_id` = '$feepaid_id';
                        ";
            if ($con->query($sql)) {
                if ($status == "pending") {
                    $completeResult[] = '<span class="bg-warning">PENDING</span>';
                    $completeResult[] = "#ffffed";
                } else if ($status == "bounced") {
                    $completeResult[] = '<span class="bg-danger">BOUNCED</span>';
                    $completeResult[] = "#ffcccb";
                } else if ($status == "refunded") {
                    $completeResult[] = '<span class="bg-danger">REFUNDED</span>';
                    $completeResult[] = "#ffa7a7";
                } else {
                    $completeResult[] = '<span class="">CLEARED</span>';
                    $completeResult[] = "";
                }
                $results = implode(",", $completeResult);
                echo $results;
            } else
                echo 'error';
        } else
            echo 'empty';
    }
    //Edit Fee Paid Status End With Ajax
    /* ----------------- Priti Mam Start ----------------------- */

    //Add prospectus Start With Ajax
    if ($_POST["action"] == "add_prospectus") {
        // start the prospectus number getting
        include './config.php';
        $getmaxid = "SELECT COUNT(prospectus_no) as id FROM `tbl_prospectus` WHERE  `payment_status`='success'";
        $getmaxid_result = mysqli_query($con, $getmaxid);
        $getmaxid_data = mysqli_fetch_array($getmaxid_result);
        $prosprectus_number = $getmaxid_data['id'];

        $add_prospectus_no =  ('SU/P/' . ($prosprectus_number + 1));

        // ending the prospectus number getting
        $add_prospectus_applicant_name = $_POST["add_prospectus_applicant_name"];
        $add_prospectus_gender = $_POST["add_prospectus_gender"];
        $add_prospectus_father_name = $_POST["add_prospectus_father_name"];
        $add_prospectus_mother_name = $_POST["add_prospectus_mother_name"];
        $add_prospectus_address1 = $_POST["add_prospectus_address"];
        $add_prospectus_address2 = $_POST["add_prospectus_address1"];
        $all_address = array("permanet" => $add_prospectus_address1, "crosspodens" => $add_prospectus_address2);
        $add_prospectus_address = json_encode($all_address);
        $add_prospectus_country = $_POST["add_prospectus_country"];
        $add_prospectus_state = $_POST["add_prospectus_state"];
        $add_prospectus_city = $_POST["add_prospectus_city"];
        $add_prospectus_postal_code = $_POST["add_prospectus_postal_code"];
        $add_prospectus_dob = $_POST["add_prospectus_dob"];
        $add_prospectus_emailid = $_POST["add_prospectus_emailid"];
        $mobile = $_POST["mobile"];
        $add_prospectus_course_name = $_POST["add_prospectus_course_name"];

        // course id to getting the course name
        $course_getting_query = "SELECT * FROM `tbl_course` WHERE `course_id`='$add_prospectus_course_name'";
        $course_getting_result = mysqli_query($con, $course_getting_query);
        $course_getting_data = mysqli_fetch_array($course_getting_result);
        $add_prospectus_course_name = $course_getting_data['course_name'];
        $course_session = $course_getting_data['course_duration'];
        $add_prospectus_session = $_POST["add_prospectus_session"];
        if ($course_session == 2) {
            $add_prospectus_session = date('Y') . '-' . date('Y', strtotime('+2 year'));
        } elseif ($course_session == 3) {
            $add_prospectus_session = date('Y') . '-' . date('Y', strtotime('+3 year'));
        } else {
            $add_prospectus_session = date('Y') . '-' . date('Y', strtotime('+4 year'));
        }
        // end the getting course name

        $add_prospectus_rate = $_POST["add_prospectus_rate"];
        $add_prospectus_payment_mode = $_POST["add_prospectus_payment_mode"];
        $cashDepositTo = $_POST["cashDepositTo"];
        $add_bank_name = $_POST["add_bank_name"];
        $add_transaction_no = rand(100000000000, 9999999999);
        $add_transaction_date = $_POST["add_transaction_date"];
        $date = date_create()->format('yy-m-d');

        // getting the current time and store into the table
        $timing = date("Y/m/d   h:i:sa");
        // ending the fetching the data
        if (!empty($add_prospectus_no && $add_prospectus_applicant_name && $add_prospectus_gender && $add_prospectus_address && $add_prospectus_emailid && $mobile && $add_prospectus_course_name && $add_prospectus_session && $add_prospectus_rate && $add_prospectus_payment_mode)) {

            $sql = "INSERT INTO `tbl_prospectus`
                            (`id`, `prospectus_no`, `prospectus_applicant_name`, `prospectus_gender`, `prospectus_father_name`, `prospectus_mother_name`, `prospectus_address`, `prospectus_country`, `prospectus_state`, `prospectus_city`, `prospectus_postal_code`, `prospectus_dob`, `prospectus_emailid`,`mobile`,`prospectus_course_name`,`prospectus_session`,`payment_status`,`prospectus_rate`,`prospectus_payment_mode`,`prospectus_deposit_to`,`bank_name`,`transaction_no`,`transaction_date`,`post_at`, `type`,`easebuzz_id`,`transaction_id`,`status`) 
                            VALUES 
                            (NULL,'$add_prospectus_no','$add_prospectus_applicant_name','$add_prospectus_gender','$add_prospectus_father_name','$add_prospectus_mother_name','$add_prospectus_address','$add_prospectus_country','$add_prospectus_state','$add_prospectus_city','$add_prospectus_postal_code','$add_prospectus_dob','$add_prospectus_emailid','$mobile','$add_prospectus_course_name','$add_prospectus_session','success','$add_prospectus_rate','$add_prospectus_payment_mode','$cashDepositTo','$add_bank_name','$add_transaction_no','$add_transaction_date','$timing','','','','$visible')
                            ";

            $course_getting_query = "SELECT * FROM `tbl_course` WHERE `course_name`='$add_prospectus_course_name'";
            $course_getting_result = mysqli_query($con, $course_getting_query);
            $course_getting_data = mysqli_fetch_array($course_getting_result);
            $add_prospectus_course_name = $course_getting_data['course_id'];
            $course_session = $course_getting_data['course_duration'];
            $add_prospectus_session = $_POST["add_prospectus_session"];

            $sql_prospectus = "INSERT INTO `tbl_income`
                    				(`id`, `reg_no`,`course`,`academic_year`,`received_date`, `particulars`, `amount`, `payment_mode`,`check_no`,`bank_name`,`income_from`,`post_at`) 
                    				VALUES 
                    				(NULL,'$add_prospectus_no(Form No)','$add_prospectus_course_name','$course_session','$add_transaction_date','Prospectus','$add_prospectus_rate','$add_prospectus_payment_mode','','$add_bank_name','Prospectus','" . date("Y-m-d") . "')
                    				";
            $query = mysqli_query($con, $sql_prospectus);


            if ($con->query($sql)) {
                $pro_session = '';
                if ($course_session == 2) {
                    $pro_session = date('Y') . '-' . date('Y', strtotime("+2 year"));
                } elseif ($course_session == 3) {
                    $pro_session = date('Y') . '-' . date('Y', strtotime("+3 year"));
                } else {
                    $pro_session = date('Y') . '-' . date('Y', strtotime("+4 year"));
                }
                // in the add_propectus_course stored the course id so i have to retring the course name
                $course_name_qury = "SELECT * FROM `tbl_course` WHERE `course_id`='$add_prospectus_course_name'";
                $course_name_result = mysqli_query($con, $course_name_qury);
                $course_name_data = mysqli_fetch_array($course_name_result);
                $course_name = $course_name_data['course_name'];
                include '../../Backend/sendprospectus.php';

                prospectus_mail($add_prospectus_emailid, $add_prospectus_no, $add_prospectus_rate, $course_name, $pro_session, $add_prospectus_applicant_name);



                $add_prospectus_payment_mode = "Cash";
                $message = "Dear $add_prospectus_applicant_name, Thank you for the payment of Rs. $add_prospectus_rate through Cash towards your Prospectus of selected Course $course_name. Regards Srinath University";
                $objectSecond->send_prospectus($mobile, $message);

                $_SESSION['email'] = $add_prospectus_emailid;
                echo "<script>
                               
                                location.replace('../print.php');
                            </script>";
            } else
                echo "<script>
                                alert('Something went wrong please try again!!!');
                                location.replace('prospectus_view');
                            </script>";
            /*} else
                    echo "<script>
                                alert('Something went wrong please try again!!!');
                                location.replace('../add_university_details');
                            </script>";*/
        } else {
            echo "<script>
                            alert('Please fill out all required fields!!!');
                            location.replace('prospectus_view');
                        </script>";
        }
    }
    //Add prospectus End With Ajax

    //Edit prospectus Start With Ajax
    if ($_POST["action"] == "edit_prospectus") {
        $edit_prospectus_no = $_POST["edit_prospectus_no"];
        $edit_prospectus_applicant_name = $_POST["edit_prospectus_applicant_name"];
        $edit_prospectus_gender = $_POST["edit_prospectus_gender"];
        $edit_prospectus_father_name = $_POST["edit_prospectus_father_name"];
        $edit_prospectus_address = $_POST["edit_prospectus_address"];
        $edit_prospectus_country = $_POST["edit_prospectus_country"];
        $edit_prospectus_state = $_POST["edit_prospectus_state"];
        $edit_prospectus_city = $_POST["edit_prospectus_city"];
        $edit_prospectus_postal_code = $_POST["edit_prospectus_postal_code"];
        $edit_prospectus_dob = $_POST["edit_prospectus_dob"];
        $edit_prospectus_emailid = $_POST["edit_prospectus_emailid"];
        $edit_mobile = $_POST["edit_mobile"];
        $edit_prospectus_course_name = $_POST["edit_prospectus_course_name"];
        $edit_prospectus_session = $_POST["edit_prospectus_session"];
        $edit_prospectus_rate = $_POST["edit_prospectus_rate"];
        $edit_prospectus_payment_mode = $_POST["edit_prospectus_payment_mode"];
        $edit_bank_name = $_POST["edit_bank_name"];
        $edit_transaction_no = $_POST["edit_transaction_no"];
        $add_transaction_date = $_POST["edit_transaction_date"];
        $edit_id = $_POST["edit_id"];
        if (!empty($edit_prospectus_no && $edit_id)) {
            $sql = "SELECT * FROM `tbl_prospectus`
                        WHERE `status` = '$visible' && `prospectus_no` = '$edit_prospectus_no';
                        ";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                echo 'exsits';
            } else {
                $sql = "UPDATE `tbl_prospectus` 
                            SET 
                            `prospectus_no` = '$edit_prospectus_no',`prospectus_applicant_name` = '$edit_prospectus_applicant_name',`prospectus_gender` = '$edit_prospectus_gender',`prospectus_father_name` = '$edit_prospectus_father_name',`prospectus_address` = '$edit_prospectus_address',`prospectus_country` = '$edit_prospectus_country',`prospectus_state` = '$edit_prospectus_state',`prospectus_city` = '$edit_prospectus_city',`prospectus_postal_code` = '$edit_prospectus_postal_code',`prospectus_dob` = '$edit_prospectus_dob',`prospectus_emailid` = '$edit_prospectus_emailid',`mobile` = '$edit_mobile',`prospectus_course_name` = '$edit_prospectus_course_name',`prospectus_session` = '$edit_prospectus_session',`prospectus_rate` = '$edit_prospectus_rate',`prospectus_payment_mode` = '$edit_prospectus_payment_mode',`bank_name` = '$edit_bank_name',`transaction_no` = '$edit_transaction_no',`transaction_date` = '$edit_transaction_date'
                             WHERE `status` = '$visible' && `id` = '$edit_id';
                            ";
                if ($con->query($sql))
                    echo 'success';
                else
                    echo 'error';
            }
        } else
            echo 'empty';
    }
    //Edit prospectus End With Ajax
    //Delete prospectus Start With Ajax
    if ($_POST["action"] == "delete_prospectus") {
        $delete_id = $_POST["delete_id"];
        if (!empty($delete_id)) {
            $sql = "UPDATE `tbl_prospectus` 
                        SET 
                        `status` = '$trash' 
                        WHERE `status` = '$visible' && `id` = '$delete_id';
                        ";
            if ($con->query($sql))
                echo 'success';
            else
                echo 'error';
        } else
            echo 'empty';
    }
    //Delete prospectus End With Ajax
    //Add Admission Form Start
    if ($_POST["action"] == "add_admission") {
        $add_admission_id = $_POST['add_admission_id'];
        $add_admission_form_no = $_POST['add_admission_form_no'];
        $add_admission_no = $_POST['add_admission_no'];
        $add_admission_title = $_POST['add_admission_title'];
        $add_admission_first_name = $_POST['add_admission_first_name'];
        $add_admission_middle_name = $_POST['add_admission_middle_name'];
        $add_admission_last_name = $_POST['add_admission_last_name'];
        $add_admission_course_name = $_POST['add_admission_course_name'];
        $add_admission_session = $_POST['add_admission_session'];
        $add_admission_dob = $_POST['add_admission_dob'];
        $add_admission_nationality = $_POST['add_admission_nationality'];
        $add_admission_aadhar_no = $_POST['add_admission_aadhar_no'];
        $add_date_of_admission = $_POST['add_date_of_admission'];
        $add_admission_category = $_POST['add_admission_category'];
        $add_admission_gender = $_POST['add_admission_gender'];
        $add_admission_username = $_POST['add_admission_username'];
        $add_admission_password = $_POST['add_admission_password'];
        $add_admission_blood_group = $_POST['add_admission_blood_group'];
        $add_admission_hostel = $_POST['add_admission_hostel'];
        $add_admission_transport = $_POST['add_admission_transport'];
        $add_admission_profile_image = $_FILES["add_admission_profile_image"]["name"];

        $add_admission_residential_address = $_POST['add_admission_residential_address'];
        $add_admission_state = $_POST['add_admission_state'];
        $add_admission_city = $_POST['add_admission_city'];
        $add_admission_district = $_POST['add_admission_district'];
        $add_admission_pin_code = $_POST['add_admission_pin_code'];
        $add_admission_home_landlineno = $_POST['add_admission_home_landlineno'];
        $add_admission_mobile_student = $_POST['add_admission_mobile_student'];
        $add_admission_father_phoneno = $_POST['add_admission_father_phoneno'];
        $add_admission_emailid_father = $_POST['add_admission_emailid_father'];
        $add_admission_emailid_student = $_POST['add_admission_emailid_student'];
        $add_admission_father_name = $_POST['add_admission_father_name'];
        $add_admission_father_whatsappno = $_POST['add_admission_father_whatsappno'];
        $add_admission_mother_name = $_POST['add_admission_mother_name'];

        $add_admission_high_school_board_university = $_POST['add_admission_high_school_board_university'];
        $add_admission_high_school_college_name = $_POST['add_admission_high_school_college_name'];
        $add_admission_high_school_passing_year = $_POST['add_admission_high_school_passing_year'];
        $add_admission_high_school_per = $_POST['add_admission_high_school_per'];
        $add_admission_high_school_subjects = $_POST['add_admission_high_school_subjects'];
        $add_admission_intermediate_board_university = $_POST['add_admission_intermediate_board_university'];
        $add_admission_intermediate_college_name = $_POST['add_admission_intermediate_college_name'];
        $add_admission_intermediate_passing_year = $_POST['add_admission_intermediate_passing_year'];
        $add_admission_intermediate_per = $_POST['add_admission_intermediate_per'];
        $add_admission_intermediate_subjects = $_POST['add_admission_intermediate_subjects'];
        $add_admission_graduation_board_university = $_POST['add_admission_graduation_board_university'];
        $add_admission_graduation_college_name = $_POST['add_admission_graduation_college_name'];
        $add_admission_graduation_passing_year = $_POST['add_admission_graduation_passing_year'];
        $add_admission_graduation_per = $_POST['add_admission_graduation_per'];
        $add_admission_graduation_subjects = $_POST['add_admission_graduation_subjects'];
        $add_admission_post_graduation_board_university = $_POST['add_admission_post_graduation_board_university'];
        $add_admission_post_graduation_college_name = $_POST['add_admission_post_graduation_college_name'];
        $add_admission_post_graduation_others = $_POST['add_admission_post_graduation_others'];
        $add_admission_post_graduation_per = $_POST['add_admission_post_graduation_per'];
        $add_admission_post_graduation_subjects = $_POST['add_admission_post_graduation_subjects'];
        $add_admission_others_board_university = $_POST['add_admission_others_board_university'];
        $add_admission_others_college_name = $_POST['add_admission_others_college_name'];
        $add_admission_others_passing_year = $_POST['add_admission_others_passing_year'];
        $add_admission_others_per = $_POST['add_admission_others_per'];
        $add_admission_others_subjects = $_POST['add_admission_others_subjects'];

        $add_admission_tenth_marksheet = $_FILES["add_admission_tenth_marksheet"]["name"];
        $add_admission_tenth_passing_certificate = $_FILES["add_admission_tenth_passing_certificate"]["name"];
        $add_admission_twelve_markesheet = $_FILES["add_admission_twelve_markesheet"]["name"];
        $add_admission_twelve_passing_certificate = $_FILES["add_admission_twelve_passing_certificate"]["name"];
        $add_admission_graduation_marksheet = $_FILES["add_admission_graduation_marksheet"]["name"];
        $add_admission_recent_character_certificate = $_FILES["add_admission_recent_character_certificate"]["name"];
        $add_admission_other_certificate = $_FILES["add_admission_other_certificate"]["name"];
        $add_admission_character_certificate = $_FILES["add_admission_character_certificate"]["name"];

        $add_admission_course1 = $_POST['add_admission_course1'];
        $add_admission_board_university1 = $_POST['add_admission_board_university1'];
        $add_admission_year_of_passing1 = $_POST['add_admission_year_of_passing1'];
        $add_admission_percentage1 = $_POST['add_admission_percentage1'];
        $add_admission_course2 = $_POST['add_admission_course2'];
        $add_admission_board_university2 = $_POST['add_admission_board_university2'];
        $add_admission_year_of_passing2 = $_POST['add_admission_year_of_passing2'];
        $add_admission_percentage2 = $_POST['add_admission_percentage2'];
        $add_admission_course3 = $_POST['add_admission_course3'];
        $add_admission_board_university3 = $_POST['add_admission_board_university3'];
        $add_admission_year_of_passing3 = $_POST['add_admission_year_of_passing3'];
        $add_admission_percentage3 = $_POST['add_admission_percentage3'];
        $add_admission_course4 = $_POST['add_admission_course4'];
        $add_admission_board_university4 = $_POST['add_admission_board_university4'];
        $add_admission_year_of_passing4 = $_POST['add_admission_year_of_passing4'];
        $add_admission_percentage4 = $_POST['add_admission_percentage4'];
        $add_admission_course5 = $_POST['add_admission_course5'];
        $add_admission_board_university5 = $_POST['add_admission_board_university5'];
        $add_admission_year_of_passing5 = $_POST['add_admission_year_of_passing5'];
        $add_admission_percentage5 = $_POST['add_admission_percentage5'];

        $add_admission_name_of_org1 = $_POST['add_admission_name_of_org1'];
        $add_admission_designation1 = $_POST['add_admission_designation1'];
        $add_admission_duration1 = $_POST['add_admission_duration1'];


        // getting data for admin approve 

        $rebate_amount = $_POST['rebate_amount'];



        /*$add_admission_location1=$_POST['add_admission_location1'];
			$add_admission_name_of_org2=$_POST['add_admission_name_of_org2'];
			$add_admission_designation2=$_POST['add_admission_designation2'];
			$add_admission_duration2=$_POST['add_admission_duration2'];
			$add_admission_location2=$_POST['add_admission_location2'];*/

        /* if(!empty($add_admission_form_no && 
			$add_admission_no && 
			$add_admission_title && 
			$add_admission_first_name && 
			$add_admission_middle_name && 
			$add_admission_last_name && 
			$add_admission_course_name && 
			$add_admission_session && 
			$add_admission_dob && 
			$add_admission_nationality && 
			$add_admission_aadhar_no &&
			$add_date_of_admission &&
			$add_admission_category && 
			$add_admission_gender && 
			$add_admission_username && 
			$add_admission_password && 
			$add_admission_blood_group && 
			$add_admission_hostel && 
			$add_admission_transport && 
			$add_admission_high_school_board_university && 
			$add_admission_high_school_college_name && 
			$add_admission_high_school_passing_year &&
			$add_admission_high_school_per &&
			$add_admission_high_school_subjects && 
			$add_admission_intermediate_board_university && 
			$add_admission_intermediate_college_name && 
			$add_admission_intermediate_passing_year && 
			$add_admission_intermediate_per && 
			$add_admission_intermediate_subjects && 
			$add_admission_graduation_board_university && 
			$add_admission_graduation_college_name && 
			$add_admission_graduation_passing_year && 
			$add_admission_graduation_per &&
			$add_admission_graduation_subjects &&
			$add_admission_post_graduation_board_university && 
			$add_admission_post_graduation_college_name && 
			$add_admission_post_graduation_others && 
			$add_admission_post_graduation_per && 
			$add_admission_post_graduation_subjects && 
			$add_admission_others_board_university && 
			$add_admission_others_college_name && 
			$add_admission_others_passing_year && 
			$add_admission_others_per && 
			$add_admission_others_subjects && 
			$add_admission_course1 && 
			$add_admission_board_university1 && 
			$add_admission_year_of_passing1 && 
			$add_admission_percentage1 && 
			$add_admission_course2 && 
			$add_admission_board_university2 &&
			$add_admission_year_of_passing2 &&
			$add_admission_percentage2 && 
			$add_admission_course3 && 
			$add_admission_board_university3 && 
			$add_admission_year_of_passing3 && 
			$add_admission_percentage3 && 
			$add_admission_course4 &&
			$add_admission_board_university4 && 
			$add_admission_year_of_passing4 && 
			$add_admission_percentage4 && 
			$add_admission_course5 && 
			$add_admission_board_university5 && 
			$add_admission_year_of_passing5 && 
			$add_admission_percentage5 && 
			$add_admission_name_of_org1 && 
			$add_admission_designation1 && 
			$add_admission_duration1 &&
			$add_admission_location1 &&
			$add_admission_name_of_org2 && 
			$add_admission_designation2 && 
			$add_admission_duration2 && 
			$add_admission_location2)){*/

        // if (!empty($_FILES["add_admission_profile_image"]["name"])) {
        //     $add_admission_profile_image_rand = $random_number . "_" . $add_admission_profile_image;
        //     move_uploaded_file($_FILES["add_admission_profile_image"]["tmp_name"], "$admission_profile_image_dir/$add_admission_profile_image_rand");
        // } else {
        //     $add_admission_profile_image_rand = "";
        // }

        // $add_admission_tenth_marksheet_rand = $random_number . "_" . $add_admission_tenth_marksheet;
        // move_uploaded_file($_FILES["add_admission_tenth_marksheet"]["tmp_name"], "$certificates/$add_admission_tenth_marksheet_rand");

        // $add_admission_tenth_passing_certificate_rand = $random_number . "_" . $add_admission_tenth_passing_certificate;
        // move_uploaded_file($_FILES["add_admission_tenth_passing_certificate"]["tmp_name"], "$certificates/$add_admission_tenth_passing_certificate_rand");

        // $add_admission_twelve_markesheet_rand = $random_number . "_" . $add_admission_twelve_markesheet;
        // move_uploaded_file($_FILES["add_admission_twelve_markesheet"]["tmp_name"], "$certificates/$add_admission_twelve_markesheet_rand");

        // $add_admission_twelve_passing_certificate_rand = $random_number . "_" . $add_admission_twelve_passing_certificate;
        // move_uploaded_file($_FILES["add_admission_twelve_passing_certificate"]["tmp_name"], "$certificates/$add_admission_twelve_passing_certificate_rand");

        // $add_admission_graduation_marksheet_rand = $random_number . "_" . $add_admission_graduation_marksheet;
        // move_uploaded_file($_FILES["add_admission_graduation_marksheet"]["tmp_name"], "$certificates/$add_admission_graduation_marksheet_rand");

        // $add_admission_recent_character_certificate_rand = $random_number . "_" . $add_admission_recent_character_certificate;
        // move_uploaded_file($_FILES["add_admission_recent_character_certificate"]["tmp_name"], "$certificates/$add_admission_recent_character_certificate_rand");

        // $add_admission_other_certificate_rand = $random_number . "_" . $add_admission_other_certificate;
        // move_uploaded_file($_FILES["add_admission_other_certificate"]["tmp_name"], "$certificates/$add_admission_other_certificate_rand");

        // $add_admission_character_certificate_rand = $random_number . "_" . $add_admission_character_certificate;
        // move_uploaded_file($_FILES["add_admission_character_certificate"]["tmp_name"], "$certificates/$add_admission_character_certificate_rand");



        // image check 



        $add_admission_profile_image = addslashes(file_get_contents($_FILES['add_admission_profile_image']['tmp_name']));

        $add_admission_tenth_marksheet = addslashes(file_get_contents($_FILES['add_admission_tenth_marksheet']['tmp_name']));

        $add_admission_tenth_passing_certificate = addslashes(file_get_contents($_FILES['add_admission_tenth_passing_certificate']['tmp_name']));

        $add_admission_twelve_markesheet = addslashes(file_get_contents($_FILES['add_admission_twelve_markesheet']['tmp_name']));

        $add_admission_twelve_passing_certificate = addslashes(file_get_contents($_FILES['add_admission_twelve_passing_certificate']['tmp_name']));

        $add_admission_graduation_marksheet = addslashes(file_get_contents($_FILES['add_admission_graduation_marksheet']['tmp_name']));

        $add_admission_recent_character_certificate = addslashes(file_get_contents($_FILES['add_admission_recent_character_certificate']['tmp_name']));

        $add_admission_other_certificate = addslashes(file_get_contents($_FILES['add_admission_other_certificate']['tmp_name']));

        $add_admission_character_certificate = addslashes(file_get_contents($_FILES['add_admission_character_certificate']['tmp_name']));

        $student_signature = addslashes(file_get_contents($_FILES['student_sing']['tmp_name']));

        $parent_signature = addslashes(file_get_contents($_FILES['parent_sing']['tmp_name']));


        $sql = "INSERT INTO `tbl_admission`
                            ( `admission_form_no`, `admission_no`, `admission_title`, `admission_first_name`, `admission_middle_name`, `admission_last_name`, `admission_course_name`, `admission_session`, `admission_dob`, `admission_nationality`, `admission_aadhar_no`,`date_of_admission`,`admission_category`,`admission_gender`,`admission_username`,`admission_password`,`admission_blood_group`,`admission_hostel`,`admission_transport`,`admission_profile_image`,`student_signature`,`parent_signature`,`admission_residential_address`,`admission_state`,`admission_city`,`admission_district`,`admission_pin_code`,`admission_home_landlineno`,`admission_mobile_student`,`admission_father_phoneno`,`admission_emailid_father`,`admission_emailid_student`,`admission_father_name`,`admission_father_whatsappno`,`admission_mother_name`,`admission_high_school_board_university`,`admission_high_school_college_name`,`admission_high_school_passing_year`,`admission_high_school_per`,`admission_high_school_subjects`,`admission_intermediate_board_university`,`admission_intermediate_college_name`,`admission_intermediate_passing_year`,`admission_intermediate_per`,`admission_intermediate_subjects`,`admission_graduation_board_university`,`admission_graduation_college_name`,`admission_graduation_passing_year`,`admission_graduation_per`,`admission_graduation_subjects`,`admission_post_graduation_board_university`,`admission_post_graduation_college_name`,`admission_post_graduation_others`,`admission_post_graduation_per`,`admission_post_graduation_subjects`,`admission_others_board_university`,`admission_others_college_name`,`admission_others_passing_year`,`admission_others_per`,`admission_others_subjects`,`admission_tenth_marksheet`,`admission_tenth_passing_certificate`,`admission_twelve_markesheet`,`admission_twelve_passing_certificate`,`admission_graduation_marksheet`,`admission_recent_character_certificate`,`admission_other_certificate`,`admission_character_certificate`,`admission_course1`,`admission_board_university1`,`admission_year_of_passing1`,`admission_percentage1`,`admission_course2`,`admission_board_university2`,`admission_year_of_passing2`,`admission_percentage2`,`admission_course3`,`admission_board_university3`,`admission_year_of_passing3`,`admission_percentage3`,`admission_course4`,`admission_board_university4`,`admission_year_of_passing4`,`admission_percentage4`,`admission_course5`,`admission_board_university5`,`admission_year_of_passing5`,`admission_percentage5`,`admission_name_of_org1`,`admission_designation1`,`admission_duration1`,`post_at`,`type`,`approval`,`transactionid`,`easebuzzid`, `status`) 
                            VALUES 
                            ('$add_admission_form_no','$add_admission_no','$add_admission_title','$add_admission_first_name', '$add_admission_middle_name', '$add_admission_last_name', '$add_admission_course_name','$add_admission_session','$add_admission_dob', '$add_admission_nationality', '$add_admission_aadhar_no','$add_date_of_admission','$add_admission_category', '$add_admission_gender', '$add_admission_username', '$add_admission_password', '$add_admission_blood_group', '$add_admission_hostel','$add_admission_transport', '$add_admission_profile_image','$student_signature','$parent_signature','$add_admission_residential_address','$add_admission_state','$add_admission_city','$add_admission_district','$add_admission_pin_code','$add_admission_home_landlineno','$add_admission_mobile_student','$add_admission_father_phoneno','$add_admission_emailid_father','$add_admission_emailid_student','$add_admission_father_name','$add_admission_father_whatsappno','$add_admission_mother_name','$add_admission_high_school_board_university', '$add_admission_high_school_college_name', '$add_admission_high_school_passing_year','$add_admission_high_school_per','$add_admission_high_school_subjects', '$add_admission_intermediate_board_university', '$add_admission_intermediate_college_name', '$add_admission_intermediate_passing_year', '$add_admission_intermediate_per', '$add_admission_intermediate_subjects', '$add_admission_graduation_board_university', '$add_admission_graduation_college_name', '$add_admission_graduation_passing_year', '$add_admission_graduation_per','$add_admission_graduation_subjects','$add_admission_post_graduation_board_university', '$add_admission_post_graduation_college_name', '$add_admission_post_graduation_others', '$add_admission_post_graduation_per', '$add_admission_post_graduation_subjects', '$add_admission_others_board_university', '$add_admission_others_college_name', '$add_admission_others_passing_year', '$add_admission_others_per', '$add_admission_others_subjects','$add_admission_tenth_marksheet','$add_admission_tenth_passing_certificate','$add_admission_twelve_markesheet','$add_admission_twelve_passing_certificate','$add_admission_graduation_marksheet','$add_admission_recent_character_certificate',	'$add_admission_other_certificate','$add_admission_character_certificate',	'$add_admission_course1', '$add_admission_board_university1', '$add_admission_year_of_passing1', '$add_admission_percentage1', '$add_admission_course2', '$add_admission_board_university2','$add_admission_year_of_passing2','$add_admission_percentage2', '$add_admission_course3', '$add_admission_board_university3', '$add_admission_year_of_passing3', '$add_admission_percentage3', '$add_admission_course4','$add_admission_board_university4', '$add_admission_year_of_passing4', '$add_admission_percentage4', '$add_admission_course5', '$add_admission_board_university5', '$add_admission_year_of_passing5', '$add_admission_percentage5', '$add_admission_name_of_org1','$add_admission_designation1', '$add_admission_duration1','$date_variable_today_month_year_with_timing','','','','','$visible')
                            ";

        include('../../Backend/rebate.php');
        if ($con->query($sql)) {

            if ($rebate_amount > 0) {
                $NotesByAdmin = 'Student admission rebate fee approval related';
                $rebate_by_email = $_POST['admin_email'];
                $rebate_by_name = $_POST['admin_name'];
                $getting_student_name = $add_admission_first_name;

                $getting_student_email_id = $add_admission_emailid_student;
                $date = date('Y-m-d');
                $approve_attach = $_POST['attach_doc'];
                $department_email = $_SESSION['admin_email'];
                $insert_rebate = "INSERT INTO `rebate`(`rebate_amount`, `approve_amount`, `rebate_by_name`, `rebate_by_email`, `student_email`, `student_name`, `rebate_date`, `approve_date`, `department`, `particular`, `massage`, `attach`, `status`) VALUES
                ('$rebate_amount','0','$rebate_by_name','$rebate_by_email','$getting_student_email_id','$getting_student_name','$date','','$department_email','Admission','$NotesByAdmin','$approve_attach','0')";

                $rebate_result = mysqli_query($con, $insert_rebate);

                $getting_latst_rebate_id = "SELECT MAX(id) as id FROM `rebate` WHERE 1";
                $getting_last_rebate_resutl = mysqli_query($con, $getting_latst_rebate_id);
                $getting_last_rebate_result_data = mysqli_fetch_array($getting_last_rebate_resutl);
                $student_id = $getting_last_rebate_result_data['id'];

                // getting the course name from the database 

                $getting_course_name1 = "SELECT * FROM `tbl_course` WHERE course_id=$add_admission_course_name";
                $getting_course_name_result = mysqli_query($con, $getting_course_name1);
                $getting_course_name_result_data = mysqli_fetch_array($getting_course_name_result);
                $add_admission_course_name1 = $getting_course_name_result_data['course_name'];
                $date = date('Y') + $add_admission_session;
                $add_admission_session = date('Y') . ' - ' . $date;

                if ($rebate_result) {
                    sendmassageforupdate($NotesByAdmin, $getting_student_email_id, $getting_student_name, $add_admission_course_name1, $add_admission_session, $student_id, 'Addmission', $rebate_amount, $rebate_by_email);
                }
            }



            echo "<script>
                                alert('Added successfully!!!');
                                location.replace('../admission_form');
                            </script>";
        } else {
            echo "<script>
                                alert('Student Already Exits got to the Admission Enquiry and Edit the form');
                                location.replace('../admission_form');
                            </script>";
        }
        /*} else{
						echo "<script>
									alert('Please fill out all required fields!!!');
									location.replace('../admission_form');
								</script>";
					}*/
    }
    //Add Admission Form End
    //Add Pay Fee Start
    if ($_POST["action"] == "add_feepaid") {
        $student_id = $_POST["student_id"];
        $getdata = "SELECT * FROM `tbl_admission`
                            WHERE `status` = '$visible' && `admission_id` = '$student_id' 
                            ";
        $getResult =  $con->query($getdata);
        $getRows = $getResult->fetch_assoc();

        $getRe = "SELECT `feepaid_id` FROM `tbl_fee_paid`
						WHERE `status` = '$visible'
						";
        $receipt_no_gen = 0;
        $getReResult =  $con->query($getRe);
        while ($getReRow = $getReResult->fetch_assoc())
            $receipt_no_gen = $getReRow["feepaid_id"];
        $receipt_no_gen++;

        $admission_id = $_POST["student_id"];
        $course_id = $getRows["admission_course_name"];
        $allPaid = implode(",", $_POST["paidFor"]);
        $allPerticularsFor = $_POST["allPerticularsFor"];
        //echo $allPerticularsFor." ".$allPaid;

        $paid_amount = $_POST["paid_amount"];
        $rebate_amount = $_POST["rebate_amount"];
        $fine = $_POST["fine"];
        $balance = $_POST["balance"];
        $payment_mode = $_POST["payment_mode"];
        $cash_deposit_to = $_POST["cash_deposit_to"];
        $cash_date = $_FILES["cash_date"];
        $notes = $_POST["notes"];
        $receipt_date = $_POST["receipt_date"];
        $bank_name = $_POST["bank_name"];
        $transaction_no = $_POST["transaction_no"];
        $transaction_date = $_POST["transaction_date"];
        $receipt_no = $_POST["receipt_no"];
        $paid_on = date('Y-m-d');
        $university_details_id = $getRows["admission_session"];
        $sql = "INSERT INTO `tbl_fee_paid`
                            (`feepaid_id`, `student_id`, `course_id`, `particular_id`, `paid_amount`, `rebate_amount`, `fine`, `balance`, `payment_mode`, `cash_deposit_to`, `cash_date`, `notes`,`receipt_date`,`bank_name`,`transaction_no`,`transaction_date`,`receipt_no`,`paid_on`,`university_details_id`,`fee_paid_time`, `status`) 
                            VALUES 
                            (NULL,'$admission_id','$course_id','$allPerticularsFor','$allPaid','$rebate_amount','$fine','$balance','$payment_mode','$cash_deposit_to','$cash_date','$notes','$receipt_date','$bank_name','$transaction_no','$transaction_date','SU_$receipt_no_gen','$paid_on','$university_details_id','$fee_paid_time','$visible')
                            ";
        if ($con->query($sql)) {

            echo "<script>
                                alert('Inserted successfully!!!');
                                location.replace('../payfee');
                            </script>";
        } else

            echo "<script>
                                alert('Something went wrong please try again!!!');
                                location.replace('../payfee');
                            </script>";
    }
    //Add Pay Fee End


    //Pay Fee Start
    if ($_POST["action"] == "pay_fees") {

        $registrationNumber = $_POST["registrationNumber"];
        $academicYear = $_POST["academicYear"];
        $courseId = $_POST["courseId"];
        $particular_paid_id = $_POST["particular_paid_id"];
        $particular_paid_amount = $_POST["particular_paid_amount"];
        $fine_amount = $_POST["fine_amount"];
        $rebate_amount = $_POST["rebate_amount"];
        $rebate_from = $_POST["particular_paid_id"];
        $total_amount = $_POST["total_amount"];
        $remaining_amount = $_POST["remaining_amount"];
        $PaymentMode = $_POST["PaymentMode"];
        $cashDepositTo = $_POST["cashDepositTo"];
        $bankName = $_POST["bankName"];
        $chequeAndOthersNumber = $_POST["chequeAndOthersNumber"];
        $paidDate = $_POST["paidDate"];
        $paymentDate = $_POST["paymentDate"];
        $NotesByAdmin = $_POST["NotesByAdmin"];
        $FeeStatus = "cleared";
        $fee_particular_id =   $particular_paid_id[0];
        // gettig the fee particualr name 
        // $particular_paid_name = "SELECT * FROM `tbl_fee` WHERE  `fee_id`='$fee_particular_id'";
        // $particular_paid_name_result = mysqli_query($con, $particular_paid_name);
        // $particular_paid_name_data = mysqli_fetch_array($particular_paid_name_result);
        // $particular_paid_particular_name = $particular_paid_name_data['fee_particulars'];

        $particular_paid_particular_name = 'Fine';




        if ($rebate_amount > 0) {
            if ($rebate_from == "") {
                echo '<div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                            <i class="icon fas fa-ban"></i> Please select Rebate From!!!
                          </div>';
                exit();
            } else
                // inserting the data into the rebate form table for how much rebate will come into the colleage
            //     $rebate_by_name = $_SESSION['admin_name'];
            // $rebate_by_email = $_SESSION['admin_email'];
            // $approve_attach = addslashes(file_get_contents($_FILES['img_approve']['tmp_name']));

            // $getting_student_email = "SELECT * FROM `tbl_admission` WHERE `admission_id`='$registrationNumber'";
            // $getting_student_result = mysqli_query($con, $getting_student_email);
            // $getting_student_email_data = mysqli_fetch_array($getting_student_result);
            // $getting_student_email_id = $getting_student_email_data['admission_emailid_student'];
            // $getting_student_name = $getting_student_email_data['admission_first_name'];
            // $student_id = $registrationNumber;
            // $department_email = $_SESSION['admin_email'];
            // $date = date('Y-m-d');
            // if ($rebate_from == 647) {
            //     $rebate_particular = '1st semester';
            // } else {
            //     $rebate_particular = $rebate_from;
            // }
            // $insert_rebate = "INSERT INTO `rebate`(`rebate_amount`, `approve_amount`, `rebate_by_name`, `rebate_by_email`, `student_email`, `student_name`, `rebate_date`, `approve_date`, `department`, `particular`, `massage`, `attach`, `status`) VALUES
            // ('$rebate_amount','$rebate_amount','$rebate_by_name','$rebate_by_email','$getting_student_email_id','$getting_student_name','$date','$date','$department_email','Fine','$NotesByAdmin','$approve_attach','1')";

            // $rebate_result = mysqli_query($con, $insert_rebate);




            include('../../Backend/rebate.php');

            // if ($rebate_result) {

            //     $getting_course_name1 = "SELECT * FROM `tbl_course` WHERE course_id=$courseId";
            //     $getting_course_name_result = mysqli_query($con, $getting_course_name1);
            //     $getting_course_name_result_data = mysqli_fetch_array($getting_course_name_result);
            //     $add_admission_course_name1 = $getting_course_name_result_data['course_name'];
            //     $add_admission_session = $getting_course_name_result_data['course_duration'];

            //     $date = date('Y') + $add_admission_session;
            //     $add_admission_session = date('Y') . ' - ' . $date;

            //     sendmassageforupdate($NotesByAdmin, $getting_student_email_id, $getting_student_name, $add_admission_course_name1, $add_admission_session, $student_id, $particular_paid_particular_name, $rebate_amount, $rebate_by_email);
            // }


            $implodedRebate = $rebate_amount . "," . $rebate_from;
        } else
            $implodedRebate = "";
            $flag=0;


            echo "<pre>";
            print_r($_POST);
        if (!empty($registrationNumber && $academicYear && $courseId) && (count($particular_paid_id) != 0) && (count($particular_paid_amount) != 0) && !empty($total_amount)) {
            if (($PaymentMode != "0" && $cashDepositTo != "0") || ($PaymentMode != "0" && !empty($chequeAndOthersNumber))) {
                if ($fine_amount >= 0 && $rebate_amount >= 0 && $total_amount >= 0 && $remaining_amount >= 0) {
                    $getRe = "SELECT `feepaid_id` FROM `tbl_fee_paid`
                                  WHERE `status` = '$visible'
                                 ";
                    $receipt_no_gen = 0;
                    $getReResult =  $con->query($getRe);

                    while ($getReRow = $getReResult->fetch_assoc())
                        $receipt_no_gen = $getReRow["feepaid_id"];
                    $receipt_no_gen++;
                  
                    if (isset($_POST["extra_fine"]) && !empty($_POST["extra_fine"])) {
                        $complete_extra_fine = $_POST["extra_fine"] + "|separator|" + htmlspecialchars($_POST["extra_fine_description"], ENT_QUOTES);
                        $add_extra_income = "INSERT INTO `tbl_extra_income`(`id`, `received_date`, `particulars`, `amount`, `payment_mode`, `account_number`, `bank_name`, `branch_name`, `ifsc_code`, `transaction_no`, `received_from`, `remarks`, `post_at`, `status`) VALUES
                                                                         (NULL,'" . date('Y-m-d') . "','Extra Fine','$complete_extra_fine','$PaymentMode','$cashDepositTo','$bankName',' ','','$chequeAndOthersNumber','Extra Fine','$NotesByAdmin','" . date('Y-m-d') . "','$visible')";
                        $extra_fine_result = mysqli_query($con, $add_extra_income);
                    } else {
                        $complete_extra_fine = "";
                        if ($PaymentMode == "Cheque")
                            $FeeStatus = "pending";
                    }

                    if($particular_paid_amount>0){
                        $implodedId =  $particular_paid_id;
                        $implodedAmount =  $particular_paid_amount;

                         $sql = "INSERT INTO `tbl_fee_paid`
                        (`feepaid_id`, `student_id`, `course_id`, `particular_id`, `paid_amount`, `rebate_amount`, `fine`, `extra_fine`, `balance`, `payment_mode`, `cash_deposit_to`, `cash_date`, `notes`, `receipt_date`, `bank_name`, `transaction_no`, `transaction_date`, `receipt_no`, `paid_on`, `university_details_id`, `fee_paid_time`, `payment_status`, `status`) 
                        VALUES 
                        (NULL, '$registrationNumber', '$courseId', '$implodedId', '$implodedAmount', '$implodedRebate', '$fine_amount', '$complete_extra_fine', '$remaining_amount', '$PaymentMode', '$cashDepositTo', '$paymentDate', '$NotesByAdmin', '$paidDate', '$bankName', '$chequeAndOthersNumber', '$paymentDate', 'SU_$receipt_no_gen', '$paymentDate', '$academicYear', '$date_variable_today_month_year_with_timing', '$FeeStatus', '$visible')
                        ";
                    }else{
                     echo    $implodedId =  ",".$particular_paid_id;
                        $implodedAmount = ",0";

                         $sql = "INSERT INTO `tbl_fee_paid`
                                (`feepaid_id`, `student_id`, `course_id`, `particular_id`, `paid_amount`, `rebate_amount`, `fine`, `extra_fine`, `balance`, `payment_mode`, `cash_deposit_to`, `cash_date`, `notes`, `receipt_date`, `bank_name`, `transaction_no`, `transaction_date`, `receipt_no`, `paid_on`, `university_details_id`, `fee_paid_time`, `payment_status`, `status`) 
                                VALUES 10,000
                                (NULL, '$registrationNumber', '$courseId', '$implodedId', '$implodedAmount', '$implodedRebate', '$fine_amount', '$complete_extra_fine', '$remaining_amount', '$PaymentMode', '$cashDepositTo', '$paymentDate', '$NotesByAdmin', '$paidDate', '$bankName', '$chequeAndOthersNumber', '$paymentDate', 'SU_$receipt_no_gen', '$paymentDate', '$academicYear', '$date_variable_today_month_year_with_timing', '$FeeStatus', '$visible')
                                ";

                    }




                
                    // getting the last inserted data of the fee paid
                    $table_id_fee_paid = "SELECT * FROM `tbl_fee_paid` WHERE 1";
                    $table_result = mysqli_query($con, $table_id_fee_paid);
                    $table_feepaid_id_data = mysqli_fetch_array($table_result)['feepaid_id'];

                    //insert into tbl_income
                    $sql_course = "SELECT * FROM `tbl_course`
						WHERE `status` = '$visible' &&  `course_id` = '" . $getRows["admission_course_name"] . "'
						";
                    $result_course = $con->query($sql_course);
                    $row_course = $result_course->fetch_assoc();

                    $perticulars = explode(",", $implodedId);
                    $amounts = explode(",", $implodedAmount);

                    if (isset($_POST["fine_amount"]) && ($_POST["fine_amount"] != '')) {
                        $amount_extra =  $_POST["fine_amount"];
                        $sql_inc = "INSERT INTO `tbl_income`
            				(`id`,`reg_no`,	`course`, `academic_year`,`received_date`, `particulars`, `amount`, `payment_mode`,`check_no`,`bank_name`,`income_from`,`post_at`,`table_name`,`table_id`) 
            				VALUES
            				(NULL,'$registrationNumber(Reg No)','$courseId',$academicYear,'$paidDate','Fine','$amount_extra','$PaymentMode','$chequeAndOthersNumber','$bankName','Fee','" . date("Y-m-d") . "','tbl_fee_paid','$table_feepaid_id_data')
            				";
                        $query = mysqli_query($con, $sql_inc);
                    }


                    for ($i = 0; $i < count($perticulars); $i++) {
                        $sql_fee = "SELECT * FROM `tbl_fee`
            						WHERE `status` = '$visible' && `fee_id` = '" . $perticulars[$i] . "'
            						";
                        $result_fee = $con->query($sql_fee);
                        $row_fee = $result_fee->fetch_assoc();

                        $sql_inc = "INSERT INTO `tbl_income`
            				(`id`,`reg_no`,	`course`, `academic_year`,`received_date`, `particulars`, `amount`, `payment_mode`,`check_no`,`bank_name`,`income_from`,`post_at`,`table_name`,`table_id`) 
            				VALUES
            				(NULL,'$registrationNumber(Reg No)','$courseId',$academicYear,'$paidDate','" . $row_fee["fee_particulars"] . "','$amounts[$i]','$PaymentMode','$chequeAndOthersNumber','$bankName','Fee','" . date("Y-m-d") . "','tbl_fee_paid','$table_feepaid_id_data')
            				";
                        $query = mysqli_query($con, $sql_inc);
                    }
                    //end tbl_income

                    if ($con->query($sql)) {
                        // $thanksMessage = " \n\nRegards,\nNetaji Subhas University, \nJamshedpur. ";
                        // $objectSecond->send_otp($mobileNumberOfStudent, $thanksMessage);
                        echo '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                             <i class="icon fas fa-check-circle"></i> Fee Successfully paid 
                             </div>';
                    } else
                        echo '<div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                                    <i class="icon fas fa-ban"></i> Something Went Wrong Please Try Again!!!
                                  </div>';
                } else
                    echo '<div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                                <i class="icon fas fa-ban"></i> Cannot calculate Fees with <b>Negative</b> values!!!
                              </div>';
            } else
                echo '<div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                            <i class="icon fas fa-exclamation-triangle"></i> Please Fill out Payment Details!!!
                          </div>';
        } else
            echo '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                        <i class="icon fas fa-ban"></i> Please Fill Out Fee Amounts!!!
                      </div>';
    }
    //Pay Fee End

    //Delete Print Receipt Start With Ajax
    if ($_POST["action"] == "delete_print_receipts") {
        $delete_feepaid_id = $_POST["delete_feepaid_id"];
        if (!empty($delete_feepaid_id)) {
            $sql = "UPDATE `tbl_fee_paid` 
                        SET 
                        `status` = '$trash'
                        WHERE `status` = '$visible' && `feepaid_id` = '$delete_feepaid_id';
                        ";
            if ($con->query($sql))
                echo 'success';
            else
                echo 'error';
        } else
            echo 'empty';
    }
    //Delete Print Receipt End With Ajax

    //Add Extra Income Start With Ajax
    if ($_POST["action"] == "add_extra_income") {
        $received_date = $_POST["received_date"];
        $particulars = $_POST["particulars"];
        $amount = $_POST["amount"];
        $payment_mode = $_POST["payment_mode"];
        $account_number = $_POST["account_number"];
        $bank_name = $_POST["bank_name"];
        $branch_name = $_POST["branch_name"];
        $ifsc_code = $_POST["ifsc_code"];
        $transaction_no = $_POST["transaction_no"];
        $received_from = $_POST["received_from"];
        $remarks = $_POST["remarks"];

        if (!empty($received_date && $particulars && $amount && $payment_mode && $received_from && $remarks)) {

            $sql = "INSERT INTO `tbl_extra_income`
                            (`id`, `received_date`, `particulars`, `amount`, `payment_mode`,`account_number`,`bank_name`,`branch_name`,`ifsc_code`,`transaction_no`, `received_from`,`remarks`, `status`) 
                            VALUES 
                            (NULL,'$received_date','$particulars','$amount','$payment_mode','$account_number','$bank_name','$branch_name',
                            '$ifsc_code','$transaction_no','$received_from','$remarks','$visible')
                            ";


            if ($con->query($sql)) {


                $get_last_id = "SELECT MAX(id) as id FROM tbl_extra_income";
                $get_extra_income_id = mysqli_query($con, $get_last_id);
                $extra_income_id = mysqli_fetch_array($get_extra_income_id)['id'];

                $sql_inc = "INSERT INTO `tbl_income`
                    (`id`,`reg_no`,`course`,`received_date`, `academic_year`,`particulars`, `amount`, `payment_mode` ,`check_no`,`bank_name`,`income_from`,`post_at`,`table_name`,`table_id`) 
                    VALUES 
                    (NULL,'(Extra Income)$received_from','','$received_date','','$particulars','$amount','$payment_mode','$account_number','$bank_name','Extra Income','" . date("Y-m-d") . "','tbl_extra_income','$extra_income_id')
                    ";
                $query = mysqli_query($con, $sql_inc);

                echo '
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                                <i class="icon fas fa-check"></i> Added successfully!!!
                            </div>';
            } else
                echo '
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                                <i class="icon fas fa-ban"></i> Something went wrong please try again!!!
                            </div>';
        } else
            echo '
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                        <i class="icon fas fa-exclamation-triangle"></i>  Please fill out all Fields!!!
                    </div>';
    }
    //Add Extra Income End With Ajax		
    //Edit Extra Income Start With Ajax
    if ($_POST["action"] == "edit_extra_income") {
        $received_date = $_POST["received_date"];
        $particulars = $_POST["particulars"];
        $amount = $_POST["amount"];
        $payment_mode = $_POST["payment_mode"];
        $account_number = $_POST["account_number"];
        $bank_name = $_POST["bank_name"];
        $branch_name = $_POST["branch_name"];
        $ifsc_code = $_POST["ifsc_code"];
        $transaction_no = $_POST["transaction_no"];
        $received_from = $_POST["received_from"];
        $remarks = $_POST["remarks"];
        $edit_id = $_POST["edit_id"];
        if (!empty($received_date && $particulars && $amount && $payment_mode && $received_from && $remarks && $edit_id)) {

            $sql = "UPDATE `tbl_extra_income` 
                            SET 
                            `received_date` = '$received_date',`particulars` = '$particulars',`amount` = '$amount',`payment_mode` = '$payment_mode',`account_number` = '$account_number',`bank_name` = '$bank_name',`branch_name` = '$branch_name',`ifsc_code` = '$ifsc_code',`transaction_no` = '$transaction_no',`received_from` = '$received_from',`remarks` = '$remarks'
                             WHERE `status` = '$visible' && `id` = '$edit_id';
                            ";
            $income_sql = "UPDATE `tbl_income` SET `particulars`='$particulars',`amount`='$amount',`payment_mode`='$payment_mode',`bank_name`='$bank_name',`income_from`='Extra Income' WHERE `table_name`='tbl_extra_income' && `table_id`='$edit_id' ";
            $con->query($income_sql);
            if ($con->query($sql))
                echo 'success';
            else
                echo 'error';
        }
    }
    //Edit Extra Income End With Ajax

    //Delete Extra Income Start With Ajax
    if ($_POST["action"] == "delete_extra_income") {
        $delete_id = $_POST["delete_id"];
        if (!empty($delete_id)) {
            $sql = "UPDATE `tbl_extra_income` 
                        SET 
                        `status` = '$trash' 
                        WHERE `status` = '$visible' && `id` = '$delete_id';
                        ";


              $get_last_id = "SELECT * FROM tbl_extra_income WHERE `id`='$delete_id'";
            $get_extra_income_id = mysqli_query($con, $get_last_id);
            $extra_income = mysqli_fetch_array($get_extra_income_id);
            $received_from = $extra_income['reg_no'];
            $received_date = $extra_income['received_date'];
            $particulars = $extra_income['particulars'];
            $amount = '-' . $extra_income['amount'];
            $payment_mode = $extra_income['payment_mode'];
            $account_number = $extra_income['account_number'];
            $bank_name = $extra_income['bank_name'];


            $sql_inc = "INSERT INTO `tbl_income`
    (`id`,`reg_no`,`course`,`received_date`, `academic_year`,`particulars`, `amount`, `payment_mode` ,`check_no`,`bank_name`,`income_from`,`post_at`,`table_name`,`table_id`) 
    VALUES 
    (NULL,'(Extra Income deleted)$received_from','','$received_date','','$particulars','$amount','$payment_mode','$account_number','$bank_name','Extra Income','" . date("Y-m-d") . "','tbl_extra_income','$delete_id')
    ";
            $query = mysqli_query($con, $sql_inc);

            if ($con->query($sql))

                echo 'success';
            else
                echo 'error';
        } else
            echo 'empty';
    }
    //Delete Extra Income End With Ajax

    //Add Expenses Start With Ajax
    if ($_POST["action"] == "add_expenses") {
        $payment_date = $_POST["payment_date"];
        $particulars = $_POST["particulars"];
        $amount = $_POST["amount"];
        $payment_mode = $_POST["payment_mode"];
        $account_number = $_POST["account_number"];
        $bank_name = $_POST["bank_name"];
        $branch_name = $_POST["branch_name"];
        $ifsc_code = $_POST["ifsc_code"];
        $transaction_no = $_POST["transaction_no"];
        $paid_to = $_POST["paid_to"];
        $remarks = $_POST["remarks"];

        if (!empty($payment_date && $particulars && $amount && $payment_mode)) {

            $sql = "INSERT INTO `tbl_expenses`
                            (`id`, `payment_date`, `particulars`,`amount`, `payment_mode`,`account_number`,`bank_name`,`branch_name`,`ifsc_code`,`transaction_no`, `paid_to`, `remarks`, `status`) 
                            VALUES 
                            (NULL,'$payment_date','$particulars','$amount','$payment_mode','$account_number','$bank_name','$branch_name','$ifsc_code','$transaction_no','$paid_to','$remarks','$visible')
                            ";
            if ($con->query($sql)) {


                echo '
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                                <i class="icon fas fa-check"></i> Added successfully!!!
                            </div>';
            } else
                echo '
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                                <i class="icon fas fa-ban"></i> Something went wrong please try again!!!
                            </div>';
        } else
            echo '
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                        <i class="icon fas fa-exclamation-triangle"></i>  Please fill out all Fields!!!
                    </div>';
    }
    //Add Expenses End With Ajax		
    //Edit Expenses Start With Ajax
    if ($_POST["action"] == "edit_expenses") {
        $payment_date = $_POST["payment_date"];
        $particulars = $_POST["particulars"];
        $amount = $_POST["amount"];
        $payment_mode = $_POST["payment_mode"];
        $bank_name = $_POST["bank_name"];
        $transaction_no = $_POST["transaction_no"];
        $paid_to = $_POST["paid_to"];
        $remarks = $_POST["remarks"];
        $edit_id = $_POST["edit_id"];

        if (!empty($payment_date && $particulars && $amount && $payment_mode && $paid_to && $remarks)) {

            $sql = "UPDATE `tbl_expenses` 
                            SET 
                            `payment_date` = '$payment_date',`particulars` = '$particulars',`amount` = '$amount',`payment_mode` = '$payment_mode',`account_number` = '$account_number',`bank_name` = '$bank_name',`branch_name` = '$branch_name',`ifsc_code` = '$ifsc_code',`transaction_no` = '$transaction_no',`paid_to` = '$paid_to',`remarks` = '$remarks'
                             WHERE `status` = '$visible' && `id` = '$edit_id';
                            ";
            if ($con->query($sql))
                echo 'success';
            else
                echo 'error';
        }
    }
    //Edit Expenses End With Ajax
    //Delete Expenses Start With Ajax
    if ($_POST["action"] == "delete_expenses") {
        $delete_id = $_POST["delete_id"];
        if (!empty($delete_id)) {
            $sql = "UPDATE `tbl_expenses` 
                        SET 
                        `status` = '$trash' 
                        WHERE `status` = '$visible' && `id` = '$delete_id';
                        ";
            if ($con->query($sql))
                echo 'success';
            else
                echo 'error';
        } else
            echo 'empty';
    }
    //Delete Expenses End With Ajax
    //Add admin Start With Ajax
    if ($_POST["action"] == "add_admin") {
        //echo "<pre>";
        //print_r($_POST); EXIT;
        $admin_name = $_POST["admin_name"];
        $admin_username = $_POST["admin_username"];
        $admin_password = md5($_POST["admin_password"]);
        //$retype_password = $_POST["retype_password"];
        $admin_email = $_POST["admin_email"];
        $admin_mobile = $_POST["admin_mobile"];
        $admin_type = $_POST["admin_type"];
        if (!empty($admin_name && $admin_username && $admin_password)) {
            if (count($_POST["permission_3"]) >= 1) {
                $permission_3 = implode("||", $_POST["permission_3"]);
            } else
                $permission_3 = "";
            if (count($_POST["permission_4"]) >= 1) {
                $permission_4 = implode("||", $_POST["permission_4"]);
            } else
                $permission_4 = "";
            if (count($_POST["permission_5"]) >= 1) {
                $permission_5 = implode("||", $_POST["permission_5"]);
            } else
                $permission_5 = "";
            if (count($_POST["permission_6"]) >= 1) {
                $permission_6 = implode("||", $_POST["permission_6"]);
            } else
                $permission_6 = "";
            if (count($_POST["permission_7"]) >= 1) {
                $permission_7 = implode("||", $_POST["permission_7"]);
            } else
                $permission_7 = "";
            if (count($_POST["permission_8"]) >= 1) {
                $permission_8 = implode("||", $_POST["permission_8"]);
            } else
                $permission_8 = "";
            if (count($_POST["permission_9"]) >= 1) {
                $permission_9 = implode("||", $_POST["permission_9"]);
            } else
                $permission_9 = "";
            if (count($_POST["permission_11"]) >= 1) {
                $permission_11 = implode("||", $_POST["permission_11"]);
            } else
                $permission_11 = "";
            if (count($_POST["permission_12"]) >= 1) {
                $permission_12 = implode("||", $_POST["permission_12"]);
            } else
                $permission_12 = "";
            if (count($_POST["permission_13"]) >= 1) {
                $permission_13 = implode("||", $_POST["permission_13"]);
            } else
                $permission_13 = "";
            if (count($_POST["permission_14"]) >= 1) {
                $permission_14 = implode("||", $_POST["permission_14"]);
            } else
                $permission_14 = "";

            if (count($_POST["permission_15"]) >= 1) {
                $permission_15 = implode("||", $_POST["permission_15"]);
            } else
                $permission_15 = "";

            $allPermissions = array(
                "3"          =>       $permission_3,
                "4"          =>       $permission_4,
                "5"          =>       $permission_5,
                "6"          =>       $permission_6,
                "7"          =>       $permission_7,
                "8"          =>       $permission_8,
                "9"          =>       $permission_9,
                "11"         =>       $permission_11,
                "12"         =>       $permission_12,
                "13"         =>       $permission_13,
                "14"         =>       $permission_14,
                "15"         =>       $permission_15,

            );
            $sql = "INSERT INTO `tbl_admin`
                            (`admin_id`, `admin_name`, `admin_username`, `admin_password`, `admin_email`, `admin_mobile`, `admin_type`, `admin_permission`, `status`) 
                            VALUES 
                            (NULL,'$admin_name','$admin_username','$admin_password','$admin_email','$admin_mobile','$admin_type','" . json_encode($allPermissions) . "','$visible')
                            ";

            if ($con->query($sql)) {

                echo '
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                            <i class="icon fas fa-check"></i> Added successfully!!!
                        </div>';
            } else
                echo '
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                            <i class="icon fas fa-ban"></i> Something went wrong please try again!!!
                        </div>';
        } else
            echo '
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                        <i class="icon fas fa-exclamation-triangle"></i>  Fill out all required fields!!!
                    </div>';
    }
    //Add admin End With Ajax
    //Edit Admin Start With Ajax
    if ($_POST["action"] == "edit_admin") {
        $edit_admin_name = $_POST["edit_admin_name"];
        // $edit_permissions = $_POST["edit_permissions"];
        $edit_admin_username = $_POST["edit_admin_username"];
        //$edit_admin_password = $_POST["edit_admin_password"];
        $edit_admin_email = $_POST["edit_admin_email"];
        $edit_admin_mobile = $_POST["edit_admin_mobile"];
        $edit_admin_id = $_POST["edit_admin_id"];
        if (!empty($edit_admin_name && $edit_admin_id)) {
            if ($_POST["permission_3"] != "") {
                $permission_3 = $_POST["permission_3"];
            } else
                $permission_3 = "";
            if ($_POST["permission_4"] != "") {
                $permission_4 = $_POST["permission_4"];
            } else
                $permission_4 = "";
            if ($_POST["permission_5"] != "") {
                $permission_5 = $_POST["permission_5"];
            } else
                $permission_5 = "";
            if ($_POST["permission_6"] != "") {
                $permission_6 = $_POST["permission_6"];
            } else
                $permission_6 = "";
            if ($_POST["permission_7"] != "") {
                $permission_7 = $_POST["permission_7"];
            } else
                $permission_7 = "";
            if ($_POST["permission_8"] != "") {
                $permission_8 = $_POST["permission_8"];
            } else
                $permission_8 = "";
            if ($_POST["permission_9"] != "") {
                $permission_9 = $_POST["permission_9"];
            } else
                $permission_9 = "";
            if ($_POST["permission_11"] != "") {
                $permission_11 = $_POST["permission_11"];
            } else
                $permission_11 = "";
            if ($_POST["permission_12"] != "") {
                $permission_12 = $_POST["permission_12"];
            } else
                $permission_12 = "";
            if ($_POST["permission_13"] != "") {
                $permission_13 = $_POST["permission_13"];
            } else
                $permission_13 = "";

            if ($_POST["permission_14"] != "") {
                $permission_14 = $_POST["permission_14"];
            } else
                $permission_14 = "";
            if ($_POST["permission_15"] != "") {
                $permission_15 = $_POST["permission_15"];
            } else
                $permission_15 = "";

            $allPermissions = array(
                "3"          =>       $permission_3,
                "4"          =>       $permission_4,
                "5"          =>       $permission_5,
                "6"          =>       $permission_6,
                "7"          =>       $permission_7,
                "8"          =>       $permission_8,
                "9"          =>       $permission_9,
                "11"         =>       $permission_11,
                "12"         =>       $permission_12,
                "13"         =>       $permission_13,
                "14"         =>       $permission_14,
                "15"         =>       $permission_15,

            );
            $sql = "UPDATE `tbl_admin` 
                        SET 
                        `admin_name` = '$edit_admin_name', `admin_email` = '$edit_admin_email', `admin_mobile` = '$edit_admin_mobile', `admin_permission` = '" . json_encode($allPermissions) . "'
                        WHERE `status` = '$visible' && `admin_id` = '$edit_admin_id';
                        ";
            if ($con->query($sql))
                echo 'success';
            else
                echo 'error';
        } else
            echo 'empty';
    }
    //Edit Admin End With Ajax
    //Delete Admin Start With Ajax
    if ($_POST["action"] == "delete_admin") {
        $delete_admin_id = $_POST["delete_admin_id"];
        if (!empty($delete_admin_id)) {
            $sql = "UPDATE `tbl_admin` 
                        SET 
                        `status` = '$trash'
                        WHERE `status` = '$visible' && `admin_id` = '$delete_admin_id';
                        ";
            if ($con->query($sql))
                echo 'success';
            else
                echo 'error';
        } else
            echo 'empty';
    }
    //Delete Admin End With Ajax

    //Delete University Home Start With Ajax
    if ($_POST["action"] == "delete_university_home_enquiry") {
        $delete_id = $_POST["delete_id"];
        if (!empty($delete_id)) {
            $check = $objectDefault->update("admission_enquiry_tbl", "`is_deleted` = '1' WHERE `id`='$delete_id'");
            if ($check == 1)
                echo 'success';
            else
                echo 'error';
        } else
            echo 'empty';
    }
    //Delete University Home End With Ajax
    //Delete University Prospectus Start With Ajax
    if ($_POST["action"] == "delete_university_prospectus_enquiry") {
        echo  $delete_id = $_POST["delete_id"];
?>

<?php
        if (!empty($delete_id)) {
            $query = "UPDATE `tbl_prospectus` SET `status` = '$trash' where `id`='$delete_id' ";
            $check = $con->query($query);
            if ($check == 1)
                echo 'success';
            else
                echo 'error';
        } else
            echo 'empty';
    }
    //Delete University Prospectus End With Ajax

    //Delete University Get Enquiry Start With Ajax
    if ($_POST["action"] == "delete_university_get_enquiry") {
        $delete_id = $_POST["delete_id"];
        if (!empty($delete_id)) {
            $check = $objectDefault->update("admission_enquiry_tbl", "`is_deleted` = '1' WHERE `id`='$delete_id'");
            if ($check == 1)
                echo 'success';
            else
                echo 'error';
        } else
            echo 'empty';
    }
    //Delete University Get Enquiry End With Ajax

    //Delete University Prospectus Start With Ajax
    if ($_POST["action"] == "update_prospectus_enquiry") {
        $prosprectus_number = $_POST["prosprectus_number"];
        $prosprectus_id = $_POST["prosprectus_id"];

        // getting the all data from the data base of the student
        $prospectus_student_datails = "SELECT * FROM `tbl_prospectus` WHERE `id`='$prosprectus_id'";
        $prospectus_student_result = mysqli_query($con, $prospectus_student_datails);
        $prospectus_student_data = mysqli_fetch_array($prospectus_student_result);
        $add_prospectus_email = $prospectus_student_data['prospectus_emailid'];
        $prospectus_applicant_name = $prospectus_student_data['prospectus_applicant_name'];
        $prospectus_mobile = $prospectus_student_data['mobile'];
        $prospectus_course_name1 = $_POST["prospectus_course_name"];
        $prospectus_session = $_SESSION["prospectus_session"];
        $prospectus_rate = $_POST["prospectus_rate"];
        $post_at = $_POST["post_at"];
        $name = $_SESSION['prospectus_applicant_name'];
        include '../../Backend/sendprospectus.php';



        if (!empty($prosprectus_number && $prosprectus_id)) {
            // $objectSecond->select("tbl_prospectus");
            // $objectSecond->where("`status` = '$visible' && `prospectus_no` = '$prosprectus_number'");
            // $result = $objectSecond->get();
            $exist_check = "SELECT * FROM `tbl_prospectus` WHERE `prospectus_no` = '$prosprectus_number' && `status`='$visible'";


            $result = $con->query($exist_check);
            if ($result->num_rows < 0) {



                echo 'exists';
            } else {
                $prospectus_rate_amount = "SELECT * FROM `tbl_course` WHERE `course_name`='$prospectus_course_name1'";
                $prospectus_rate_amount_result = mysqli_query($con, $prospectus_rate_amount);
                $prospectus_rate_amount_data = mysqli_fetch_array($prospectus_rate_amount_result);
                $prospectus_rate = $prospectus_rate_amount_data['prospectus_rate'];
                $prospectus_course_name = $prospectus_rate_amount_data['course_id'];
                $prospectus_session1 = $prospectus_rate_amount_data['course_duration'];

                $add_prospectus_email_data = mysqli_fetch_array($result);
                $add_prospectus_email = $add_prospectus_email_data['prospectus_emailid'];

                $getmaxid = "SELECT COUNT(prospectus_no) as id FROM `tbl_prospectus` WHERE  `payment_status`='success'";
                $getmaxid_result = mysqli_query($con, $getmaxid);
                $getmaxid_data = mysqli_fetch_array($getmaxid_result);
                $prosprectus_number = $getmaxid_data['id'];

                $prosprectus_number =  ('SU/P/' . ($prosprectus_number + 1));
                $objectSecond->sql = "";
                $update_query = "UPDATE `tbl_prospectus` SET `prospectus_no`='$prosprectus_number' , `payment_status`='success' , `prospectus_payment_mode`='Cash', `prospectus_deposit_to`='University Office' ,`prospectus_rate`='$prospectus_rate' ,`status`='$visible'  WHERE `id`='$prosprectus_id'";
                $check = $con->query($update_query);
                // $check = $objectSecond->update("tbl_prospectus", "`prospectus_no` = '$prosprectus_number'  WHERE `id`='$prosprectus_id'");

                if ($check == 1) {
                    prospectus_mail($add_prospectus_email, $prosprectus_number, $prospectus_rate, $prospectus_course_name1, $prospectus_session, $name);
                    $date = date_create()->format('yy-m-d');


                    $sql_prospectus = "INSERT INTO `tbl_income`
                         (`id`, `reg_no`,`course`,`academic_year`,`received_date`, `particulars`, `amount`, `payment_mode`,`check_no`,`bank_name`,`income_from`,`post_at`) 
                            VALUES 
                          (NULL,'$prosprectus_number(Form No)','$prospectus_course_name','$prospectus_session1','" . date("Y-m-d") . "','Prospectus','$prospectus_rate','Cash','NULL','NULL','Prospectus','" . date("Y-m-d") . "')
                               ";
                    $query = mysqli_query($con, $sql_prospectus);
                    // here to start the sending email and massage to the student
                    if ($query) {
                        $pro_session = '';
                        if ($prospectus_session1 == 2) {
                            $pro_session = date('Y') . '-' . date('Y', strtotime("+2 year"));
                        } elseif ($prospectus_session1 == 3) {
                            $pro_session = date('Y') . '-' . date('Y', strtotime("+3 year"));
                        } else {
                            $pro_session = date('Y') . '-' . date('Y', strtotime("+4 year"));
                        }
                        // in the add_propectus_course stored the course id so i have to retring the course name
                        $course_name_qury = "SELECT * FROM `tbl_course` WHERE `course_id`='$prospectus_course_name'";
                        $course_name_result = mysqli_query($con, $course_name_qury);
                        $course_name_data = mysqli_fetch_array($course_name_result);
                        $course_name = $course_name_data['course_name'];

                        $add_prospectus_payment_mode = 'Cash';

                        $message = "Dear $prospectus_applicant_name, Thank you for the payment of Rs. $prospectus_rate through Cash towards your Prospectus of selected Course $prospectus_course_name1. Regards Srinath University";
                        $objectSecond->send_prospectus($prospectus_mobile, $message);
                        echo 'success';
                    }
                } else
                    echo 'error';
            }
        } else
            echo 'empty';
    }
    //Delete University Prospectus End With Ajax


    /* NSUNIV Notification Section */
    //Delete Notification Start With Ajax
    if ($_POST["action"] == "delete_university_notification") {
        $delete_id = $_POST["delete_id"];
        if (!empty($delete_id)) {
            $check = $objectDefault->update("notification_tbl", "`status` = '$trash' WHERE `id`='$delete_id'");
            if ($check == 1)
                echo 'success';
            else
                echo 'error';
        } else
            echo 'empty';
    }
    //Delete Notification End With Ajax
    //Notification Of NSUNIV Start With Ajax
    if ($_POST["action"] == "addNotification") {
        $ThemeColor = $_POST["ThemeColor"];
        $notification = str_replace("'", "&#39;", $_POST["notification"]);
        if (!empty($ThemeColor && $notification)) {
            $check = $objectDefault->insert("notification_tbl", "(`theme`, `notification`, `visibility`, `timing`, `status`) VALUES ('$ThemeColor', '$notification', 'active', '$date_variable_today_month_year_with_timing', '$visible')");
            if ($check == 1)
                echo 'success';
            else
                echo '<span style="color:red;">Something went wrong please try again!!!<br/></span>';
        } else
            echo '<span style="color:red;">Please complete both fields!!!<br/></span>';
    }
    //Notification Of NSUNIV End With Ajax
    //Add Semester Start With Ajax
    if ($_POST["action"] == "add_semester") {
        $course_id = $_POST["course_id"];
        $academic_year = $_POST["academic_year"];
        $semester = str_replace("'", "&#39;", $_POST["semester"]);
        $exam_fee = str_replace("'", "&#39;", $_POST["exam_fee"]);
        $exam_fine = str_replace("'", "&#39;", $_POST["exam_fine"]);
        $exam_fee_last_date = $_POST["exam_fee_last_date"];
        $fee_status = $_POST["fee_status"];
        $examname = str_replace("'", "&#39;", $_POST["examname"]);
        $name_of_school = str_replace("'", "&#39;", $_POST["name_of_school"]);
        $examination_month = str_replace("'", "&#39;", $_POST["examination_month"]);
        $date_of_result     = $_POST["date_of_result"];
        if (!empty($course_id && $academic_year) && $semester[0] != "" && $examname[0] != "") {
            $allSemester = count($semester);
            $allExamname = count($examname);
            if ($course_id == "all") {
                echo  $sql = "SELECT * FROM `tbl_course`
                            WHERE `status` = '$visible'
                            ";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    $sql = "";
                    while ($row = $result->fetch_assoc()) {
                        $course_id_all = $row["course_id"];
                        for ($i = 0; $i < $allSemester; $i++) {
                            $sql_check = "SELECT * FROM `tbl_semester`
                                             WHERE `status` = '$visible' && `course_id` = '$course_id_all' && `fee_academic_year` = '$academic_year' && `semester` = '$semester[$i]';
                                             ";
                            $result_check = $con->query($sql_check);
                            if ($result_check->num_rows > 0) {
                                $row_check = $result_check->fetch_assoc();
                                $sql .= "UPDATE `tbl_semester` 
                                            SET `examname`='$examname[$i]',`add_time`='$date_variable_today_month_year_with_timing'
                                            WHERE `semester_id` = '" . $row_check['semester_id'] . "';
                                            ";
                            } else {
                                $sql .= "INSERT INTO `tbl_semester`
                                            ( `course_id`, `fee_academic_year`, `semester`,`exam_fee`,`exam_fine`,`exam_fee_last_date`,`fee_status`, `examname`,`name_of_school`,`examination_month`,`date_of_result`,`add_time`, `status`) 
                                            VALUES 
                                            ('$course_id_all','$academic_year','$semester[$i]','$exam_fee[$i]','$exam_fine[$i]','$exam_fee_last_date[$i]','$fee_status[$i]','$examname[$i]','$name_of_school[$i]','$examination_month[$i]','$date_of_result[$i]','$date_variable_today_month_year_with_timing','$visible');
                                            ";
                            }
                        }
                    }
                    if ($con->multi_query($sql))
                        echo 'success';
                    else
                        echo 'error';
                } else
                    echo 'courseempty';
            } else {
                $sql = "";
                for ($i = 0; $i < $allSemester; $i++) {
                    $sql_check = "SELECT * FROM `tbl_semester`
                                     WHERE `status` = '$visible' && `course_id` = '$course_id' && `fee_academic_year` = '$academic_year' && `semester` = '$semester[$i]';
                                     ";
                    $result = $con->query($sql_check);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $sql .= "UPDATE `tbl_semester` 
                                    SET `examname`='$examname[$i]',`add_time`='$date_variable_today_month_year_with_timing'
                                    WHERE `status` = '$visible' && `course_id` = '$course_id' && `fee_academic_year` = '$academic_year' && `semester` = '$semester[$i]';
                                    ";
                    } else {
                        $sql .= "INSERT INTO `tbl_semester`
                                    ( `course_id`, `fee_academic_year`, `semester`,`exam_fee`,`exam_fine`,`exam_fee_last_date`,`fee_status`, `examname`,`name_of_school`,`examination_month`,`date_of_result`, `add_time`, `status`) 
                                    VALUES 
                                    ('$course_id','$academic_year','$semester[$i]','$exam_fee[$i]','$exam_fine[$i]','$exam_fee_last_date[$i]','$fee_status[$i]','$examname[$i]','$name_of_school[$i]','$examination_month[$i]','$date_of_result[$i]','$date_variable_today_month_year_with_timing','$visible');
                                    ";
                    }
                }
                if ($con->multi_query($sql))
                    echo 'success';
                else
                    echo 'error';
            }
        } else
            echo 'empty';
    }
    //Add Semester End With Ajax
    //Edit Semester Start With Ajax
    if ($_POST["action"] == "edit_semester_list") {
        $course_id = $_POST["course_id"];
        $semester = $_POST["semester"];
        $fee_academic_year = $_POST["fee_academic_year"];
        $exam_fee = str_replace("'", "&#39;", $_POST["exam_fee"]);
        $exam_fine = str_replace("'", "&#39;", $_POST["exam_fine"]);
        $exam_fee_last_date = $_POST["exam_fee_last_date"];
        $fee_status = $_POST["fee_status"];
        $examname = str_replace("'", "&#39;", $_POST["examname"]);
        $name_of_school = str_replace("'", "&#39;", $_POST["name_of_school"]);
        $examination_month = str_replace("'", "&#39;", $_POST["examination_month"]);
        $date_of_result = $_POST["date_of_result"];
        $exam_reporting_time = $_POST["exam_reporting_time"];
        $time_of_examination = $_POST["time_of_examination"];
        $edit_id = $_POST["edit_id"];
        if (!empty($course_id && $fee_academic_year)) {

            $sql = "UPDATE `tbl_semester` 
                            SET 
                            `course_id` = '$course_id',`semester` = '$semester',`fee_academic_year` = '$fee_academic_year',
							`exam_fee` = '$exam_fee',`exam_fine` = '$exam_fine',`exam_fee_last_date` = '$exam_fee_last_date',
							`fee_status` = '$fee_status',`examname` = '$examname',`name_of_school` = '$name_of_school',
							`examination_month` = '$examination_month',`date_of_result` = '$date_of_result',`exam_reporting_time` = '$exam_reporting_time',`time_of_examination` = '$time_of_examination',`add_time` = '$date_variable_today_month_year_with_timing' 
                             WHERE `status` = '$visible' && `semester_id` = '$edit_id';
                            ";
            if ($con->query($sql))
                echo 'success';
            else
                echo 'error';
        }
    }
    //Edit Semester End With Ajax
    //Delete Semester Start With Ajax
    if ($_POST["action"] == "delete_get_semester") {
        $semester_id = $_POST["semester_id"];
        if (!empty($semester_id)) {
            $sql = "UPDATE `tbl_semester` 
                        SET 
                        `status` = '$trash', `add_time` = '$date_variable_today_month_year_with_timing' 
                        WHERE `status` = '$visible' && `semester_id` = '$semester_id';
                        ";
            if ($con->query($sql))
                echo 'success';
            else
                echo 'error';
        } else
            echo 'empty';
    }
    //Delete Semester End With Ajax
    //Add new subject Start With Ajax
    if ($_POST["action"] == "add_sub") {
        $course_id = $_POST["course_id"];
        $semester_id = $_POST["semester_id"];
        $academic_year = $_POST["academic_year"];
        $subject_name = str_replace("'", "&#39;", $_POST["subject_name"]);
        $subject_code = str_replace("'", "&#39;", $_POST["subject_code"]);
        $full_marks = $_POST["full_marks"];
        $pass_marks = $_POST["pass_marks"];
        if (!empty($course_id && $academic_year) && $subject_name[0] != "" && $subject_code[0] != ""  && $full_marks[0] != "" && $pass_marks[0] != "") {
            $allParticulars = count($subject_name);

            $sql = "";
            for ($i = 0; $i < $allParticulars; $i++) {
                $sql_check = "SELECT * FROM `tbl_subjects`
                                     WHERE `status` = '$visible' && `course_id` = '$course_id' && `fee_academic_year` = '$academic_year' && `subject_name` = '$subject_name[$i]';
                                     ";
                $result = $con->query($sql_check);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $sql .= "UPDATE `tbl_subjects` 
                                    SET `subject_code`='$subject_code[$i]',`add_time`='$date_variable_today_month_year_with_timing'
                                    WHERE `status` = '$visible' && `course_id` = '$course_id' && `fee_academic_year` = '$academic_year' && `subject_name` = '$subject_name[$i]';
                                    ";
                } else {
                    $sql .= "INSERT INTO `tbl_subjects`
                                    (`subject_id`, `course_id`,`semester_id`, `fee_academic_year`, `subject_name`, `subject_code`,`full_marks`,`pass_marks`, `add_time`, `status`) 
                                    VALUES 
                                    (NULL,'$course_id','$semester_id','$academic_year','$subject_name[$i]','$subject_code[$i]','$full_marks[$i]','$pass_marks[$i]','$date_variable_today_month_year_with_timing','$visible');";
                }
            }
            if ($con->multi_query($sql))
                echo 'success';
            else
                echo 'error';
        } else
            echo 'empty';
    }
    //Add new Subject End With Ajax	 
    //Edit Subject Start With Ajax
    if ($_POST["action"] == "edit_subject_list") {
        $course_id = $_POST["course_id"];
        $semester_id = $_POST["semester_id"];
        $fee_academic_year = $_POST["fee_academic_year"];
        $subject_name = str_replace("'", "&#39;", $_POST["subject_name"]);
        $subject_code = str_replace("'", "&#39;", $_POST["subject_code"]);
        $date_of_examination = $_POST["date_of_examination"];
        $full_marks = $_POST["full_marks"];
        $pass_marks = $_POST["pass_marks"];
        $edit_id = $_POST["edit_id"];
        if (!empty($course_id && $fee_academic_year)) {

            $sql = "UPDATE `tbl_subjects` 
                            SET 
                            `course_id` = '$course_id',`semester_id` = '$semester_id',`fee_academic_year` = '$fee_academic_year',`subject_name` = '$subject_name',`subject_code` = '$subject_code',`date_of_examination` = '$date_of_examination',`full_marks` = '$full_marks',`pass_marks` = '$pass_marks'
                             WHERE `status` = '$visible' && `subject_id` = '$edit_id';
                            ";
            if ($con->query($sql))
                echo 'success';
            else
                echo 'error';
        }
    }
    //Edit Subject End With Ajax
    //Delete Subject Start With Ajax
    if ($_POST["action"] == "delete_get_subject") {
        $subject_id = $_POST["subject_id"];
        if (!empty($subject_id)) {
            $sql = "UPDATE `tbl_subjects` 
                        SET 
                        `status` = '$trash', `add_time` = '$date_variable_today_month_year_with_timing' 
                        WHERE `status` = '$visible' && `subject_id` = '$subject_id';
                        ";
            if ($con->query($sql))
                echo 'success';
            else
                echo 'error';
        } else
            echo 'empty';
    }
    //Delete Get subject End With Ajax
    //Add marks Start With Ajax
    if ($_POST["action"] == "add_marks") {
        $course_id = $_POST["course_id"];
        $semester_id = $_POST["semester_id"];
        $fee_academic_year = $_POST["fee_academic_year"];
        $subject_id = $_POST["subject_id"];
        $reg_no = $_POST["reg_no"];
        $internal_marks = $_POST["internal_marks"];
        $external_marks = $_POST["external_marks"];

        $allParticulars = count($internal_marks);

        for ($i = 0; $i < $allParticulars; $i++) {

            $sql_check = "SELECT * FROM `tbl_marks` WHERE `subject_id` = '$subject_id' ";
            $result = $con->query($sql_check);

            if ($result) {
                if ($result->num_rows > 0) {

                    $sql_update = "UPDATE `tbl_marks` SET  `course_id` = '$course_id',`semester_id` = '$semester_id',`fee_academic_year`= '$fee_academic_year', `internal_marks` = '$internal_marks[$i]', `external_marks` = '$external_marks[$i]' ,`add_time` = '$date_variable_today_month_year_with_timing'  WHERE `reg_no` = '$reg_no[$i]' && `subject_id` = '$subject_id' ";
                    $con->query($sql_update);
                } else {

                    $sql .= "INSERT INTO `tbl_marks`
                                    (`marks_id`, `course_id`,`semester_id`, `fee_academic_year`, `subject_id`, `reg_no`,`internal_marks`,`external_marks`, `add_time`, `status`) 
                                    VALUES 
                                    (NULL,'$course_id','$semester_id','$fee_academic_year','$subject_id','$reg_no[$i]','$internal_marks[$i]','$external_marks[$i]','$date_variable_today_month_year_with_timing','$visible');";
                }
            }
        }

        $con->multi_query($sql);
        echo 'success';
    }
    //Add marks End With Ajax  
    //Add semester to student Start With Ajax
    if ($_POST["action"] == "add_sem") {
        $admission_id = $_POST["admission_id"];
        $course_id = $_POST["course_id"];
        $academic_year = $_POST["academic_year"];
        $semester_id = $_POST["semester_id"];

        $all = count($semester_id);

        for ($i = 0; $i < $all; $i++) {

            $sql .= "INSERT INTO `tbl_allot_semester`
                                    (`allot_id`, `admission_id`,`course_id`, `academic_year`, `semester_id`, `status`) 
                                    VALUES 
                                    (NULL,'$admission_id','$course_id','$academic_year','$semester_id[$i]','$visible');";
        }
        if ($con->multi_query($sql))
            echo 'success';
        else
            echo 'error';
    }
    //Add semester to student End With Ajax 
    //Add Get Student Start With Ajax
    if ($_POST["action"] == "add_student") {
        $course_id = $_POST["course_id"];
        $university_details_id = $_POST["university_details_id"];
        $semester_id = $_POST["semester_id"];
        $serial_no = str_replace("'", "&#39;", $_POST["serial_no"]);
        $reg_no = str_replace("'", "&#39;", $_POST["reg_no"]);
        $roll_no = str_replace("'", "&#39;", $_POST["roll_no"]);
        $student_name = str_replace("'", "&#39;", $_POST["student_name"]);
        $father_name = str_replace("'", "&#39;", $_POST["father_name"]);
        $type = str_replace("'", "&#39;", $_POST["type"]);
        if (!empty($course_id && $university_details_id && $semester_id && $reg_no && $roll_no && $student_name && $father_name)) {

            $sql = "INSERT INTO `tbl_student`
                            (`student_id`, `course_id`, `university_details_id`,`semester_id`,`serial_no`, `reg_no`,`roll_no`,`student_name`,`father_name`,`type`, `create_time`,`status`) 
                            VALUES 
                            (NULL,'$course_id','$university_details_id','$semester_id','$serial_no','$reg_no','$roll_no','$student_name','$father_name','$type','$date_variable_today_month_year_with_timing','$visible')
                            ";
            if ($con->query($sql)) {

                echo '
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                                <i class="icon fas fa-check"></i> Added successfully!!!
                            </div>';
            } else
                echo '
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                                <i class="icon fas fa-ban"></i> Something went wrong please try again!!!
                            </div>';
        } else
            echo '
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                        <i class="icon fas fa-exclamation-triangle"></i>  Please fill out all Fields!!!
                    </div>';
    }
    //Add Get Student End With Ajax
    //Edit Get Student Start With Ajax
    if ($_POST["action"] == "edit_get_student") {
        $student_id = $_POST["student_id"];
        $course_id = $_POST["course_id"];
        $university_details_id = $_POST["university_details_id"];
        $semester_id = $_POST["semester_id"];
        $serial_no = str_replace("'", "&#39;", $_POST["serial_no"]);
        $reg_no = str_replace("'", "&#39;", $_POST["reg_no"]);
        $roll_no = str_replace("'", "&#39;", $_POST["roll_no"]);
        $student_name = str_replace("'", "&#39;", $_POST["student_name"]);
        $father_name = str_replace("'", "&#39;", $_POST["father_name"]);
        $type = str_replace("'", "&#39;", $_POST["type"]);
        if (!empty($course_id && $university_details_id && $semester_id && $reg_no && $roll_no && $student_name && $father_name)) {

            $sql = "UPDATE `tbl_student` 
                            SET 
                            `course_id` = '$course_id', `university_details_id` = '$university_details_id', `semester_id` = '$semester_id',`serial_no` = '$serial_no',`reg_no` = '$reg_no', `roll_no` = '$roll_no',`student_name` = '$student_name',`father_name` = '$father_name',`type` = '$type',`create_time` = '$date_variable_today_month_year_with_timing' 
                            WHERE `status` = '$visible' && `student_id` = '$student_id';
                            ";
            if ($con->query($sql))
                echo 'success';
            else
                echo 'error';
        } else
            echo 'empty';
    }
    //Edit Get Student End With Ajax
    //Delete Get Student Start With Ajax
    if ($_POST["action"] == "delete_get_student") {
        $student_id = $_POST["student_id"];
        if (!empty($student_id)) {
            $sql = "UPDATE `tbl_student` 
                        SET 
                        `status` = '$trash', `create_time` = '$date_variable_today_month_year_with_timing' 
                        WHERE `status` = '$visible' && `student_id` = '$student_id';
                        ";
            if ($con->query($sql))
                echo 'success';
            else
                echo 'error';
        } else
            echo 'empty';
    }
    //Delete Get Student End With Ajax
    //Nss Updation Start With Ajax
    if ($_POST["action"] == "updateNss") {
        $description = htmlentities($_POST["description"]);
        $video = htmlentities($_POST["video"]);
        $aboutVideo = htmlentities($_POST["aboutVideo"]);
        $imagesImplode = "";
        $images = $_FILES["images"]["name"];
        if (!empty($images)) {
            $imagesImplode = implode(",", $_FILES["images"]["name"]);
            for ($i = 0; $i < count($images); $i++) {
                if (move_uploaded_file($_FILES["images"]["tmp_name"][$i], $nssImageDir . $images[$i]))
                    $uploaded = 1;
                else
                    $uploaded = 0;
            }
        }
        $completeDescription = array(
            "description"   => $description,
            "video"         => $video,
            "aboutVideo"    => $aboutVideo,
            "images"        => $imagesImplode
        );
        if (!empty($description)) {
            $check = $objectDefault->update("tbl_files", "`description` = '" . json_encode($completeDescription) . "' WHERE `id`='1'");
            if ($check == 1)
                echo 'success';
            else
                echo 'Something Went Wrong Please Try Again';
        } else
            echo 'Connot Go With Empty Data...';
    }
    //Nss Updation Start With Ajax
    // dues, no dues update start
    if ($_POST["action"] == "checkStatus") {
        if (isset($_POST["admission_id"])) {
            $admission_id = $_POST["admission_id"];
            $particular_id = $_POST["particular_id"];
            $course_id = $_POST["course_id"];
            $academic_year = $_POST["academic_year"];
            if (!empty($admission_id && $particular_id && $course_id && $academic_year)) {
                $sqlTblFeeStatus = "SELECT *
										 FROM `tbl_fee_status`
										 WHERE `particular_id` = '" . $particular_id . "' AND `admission_id` = '" . $admission_id . "' AND `course_id` = '" . $course_id . "' AND `academic_year` = '" . $academic_year . "'
										 ";
                $resultTblFeeStatus = $con->query($sqlTblFeeStatus);
                if ($resultTblFeeStatus->num_rows > 0) {
                    $rowTblFeeStatus = $resultTblFeeStatus->fetch_assoc();
                    if (strtolower($rowTblFeeStatus["fee_status"]) == "dues") {
                        //uPDATE nO dUES
                        $sql_update = "UPDATE `tbl_fee_status` 
                            SET 
                            `fee_status` = 'No Dues'
                            WHERE `particular_id` = '" . $particular_id . "' && `admission_id` = '" . $admission_id . "' && `course_id` = '" . $course_id . "' && `academic_year` = '" . $academic_year . "';
                            ";
                        if ($con->query($sql_update))
                            echo "success";
                        else
                            echo "error";
                    } else {
                        //uPDATE dUES
                        $sql = "UPDATE `tbl_fee_status` 
                            SET 
                            `fee_status` = 'Dues'
                            WHERE `particular_id` = '" . $particular_id . "' && `admission_id` = '" . $admission_id . "' && `course_id` = '" . $course_id . "' && `academic_year` = '" . $academic_year . "';
                            ";
                        if ($con->query($sql))
                            echo "success";
                        else
                            echo "error";
                    }
                } else {
                    //iNSERT nO dUES
                    $sql_insert = "INSERT INTO `tbl_fee_status`
                            (`fee_status_id`, `admission_id`,`course_id`,`academic_year`, `particular_id`,`fee_status`) 
                            VALUES 
                            (NULL,'$admission_id','$course_id','$academic_year','$particular_id','No Dues')
                            ";
                    if ($con->query($sql_insert))
                        echo "success";
                    else
                        echo "error";
                }
            } else
                echo 'empty';
        }
    }
    //dues nodues end
    //exam status approve start
    if ($_POST["action"] == "examStatus") {
        if (isset($_POST["fee_status_id"])) {
            $admission_id = $_POST["admission_id"];
            $fee_status_id = $_POST["fee_status_id"];
            $exam_status = $_POST["exam_status"];
            var_dump($_POST);
            if (!empty($exam_status)) {
                $sqlTblFeeStatus = "SELECT *
										 FROM `tbl_fee_status`
										 WHERE  `fee_status_id` = '$fee_status_id'
										 ";
                $resultTblFeeStatus = $con->query($sqlTblFeeStatus);
                if ($resultTblFeeStatus->num_rows > 0) {
                    $rowTblFeeStatus = $resultTblFeeStatus->fetch_assoc();
                    if ($rowTblFeeStatus["exam_status"] == "Approve")
                        $sql_update = "UPDATE `tbl_fee_status` 
											SET 
											`exam_status` = 'Not Approve'
											WHERE  `admission_id` = '$admission_id';
											";
                    else
                        $sql_update = "UPDATE `tbl_fee_status` 
											SET 
											`exam_status` = 'Approve'
											WHERE   `admission_id` = '$admission_id';
											";
                    if ($con->query($sql_update))
                        echo "success";
                    else
                        echo "error";
                } else
                    echo 'empty';
            }
        }
    }
    //exam status approve end
    //Delete Complaint Start With Ajax
    if ($_POST["action"] == "delete_complaint") {
        $delete_id = $_POST["delete_id"];
        if (!empty($delete_id)) {
            $sql = "UPDATE `tbl_complaint` 
                        SET 
                        `status` = '$trash' 
                        WHERE `status` = '$visible' && `complaint_id` = '$delete_id';
                        ";
            if ($con->query($sql))
                echo 'success';
            else
                echo 'error';
        } else
            echo 'empty';
    }
    //Delete Complaint End With Ajax
    //admit card status approve start
    if ($_POST["action"] == "admitcardStatus") {
        if (isset($_POST["allot_id"])) {
            $allot_id = $_POST["allot_id"];
            $admitcard_status = $_POST["admitcard_status"];
            //var_dump($_POST); exit;
            if (!empty($admitcard_status)) {
                $sqlTblFeeStatus = "SELECT *
										 FROM `tbl_allot_semester`
										 WHERE  `allot_id` = '$allot_id'
										 ";
                $resultTblFeeStatus = $con->query($sqlTblFeeStatus);
                if ($resultTblFeeStatus->num_rows > 0) {
                    $rowTblFeeStatus = $resultTblFeeStatus->fetch_assoc();
                    if ($rowTblFeeStatus["admitcard_status"] == "Approve")
                        $sql_update = "UPDATE `tbl_allot_semester` 
											SET 
											`admitcard_status` = 'Not Approve'
											WHERE  `allot_id` = '$allot_id';
											";
                    else
                        $sql_update = "UPDATE `tbl_allot_semester` 
											SET 
											`admitcard_status` = 'Approve'
											WHERE  `allot_id` = '$allot_id';
											";
                    if ($con->query($sql_update))
                        echo "success";
                    else
                        echo "error";
                } else
                    echo 'empty';
            }
        }
    }
    //admit card status approve end
    /* ---------- All Admin(Backend) Codes End ---------- */


    //student status change
    if ($_POST['action'] == 'student_status_update') {
        //   print_r($_POST); EXIT;
        $admission_id = $_POST['id'];
        $stud_status = $_POST['status'];

        // echo  $admission_id;
        // echo  $stud_status;   exit;

        if ($stud_status == 1) {
            $sql = "UPDATE `tbl_admission` 
                                SET 
                                `stud_status` = 0
                                WHERE `status` = '$visible' && `admission_id` = '$admission_id' && `stud_status` = '$stud_status';
                                ";
            if ($con->query($sql))

                echo 'success';
            else
                echo 'error';
        } else {
            $sql = "UPDATE `tbl_admission` 
                                SET 
                                `stud_status` = 1
                                WHERE `status` = '$visible' && `admission_id` = '$admission_id' && `stud_status` = '$stud_status';
                                ";
            if ($con->query($sql)) {
                echo 'success';
            } else {
                echo 'error';
            }
        }
    }

    //Action Section End   
}
