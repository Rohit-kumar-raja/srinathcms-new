<?php
//Pay Fee Start
    if ($_POST["action"] == "pay_fees") {

        $registrationNumber = $_POST["registrationNumber"];
        $academicYear = $_POST["academicYear"];
        $courseId = $_POST["courseId"];
        $particular_paid_id = $_POST["particular_paid_id"];
        $particular_paid_amount = $_POST["particular_paid_amount"];
        $fine_amount = $_POST["fine_amount"];
        $rebate_amount = $_POST["rebate_amount"];
        $rebate_from = $_POST["rebate_from"];
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
        $particular_fine_for_database=$_POST['particular_fine_for_database'];
        // gettig the fee particualr name 
        // $particular_paid_name = "SELECT * FROM `tbl_fee` WHERE  `fee_id`='$fee_particular_id'";
        // $particular_paid_name_result = mysqli_query($con, $particular_paid_name);
        // $particular_paid_name_data = mysqli_fetch_array($particular_paid_name_result);
        // $particular_paid_particular_name = $particular_paid_name_data['fee_particulars'];

        $particular_paid_particular_name = 'Fine';




        if ($rebate_amount > 0) {
            if ($rebate_from == "") {
                echo '<div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="icon fas fa-ban"></i> Please select Rebate From!!!
                          </div>';
                exit();
            } else
                // inserting the data into the rebate form table for how much rebate will come into the colleage
            $rebate_by_name = $_SESSION['admin_name'];
            $rebate_by_email = $_SESSION['admin_email'];
            $approve_attach = addslashes(file_get_contents($_FILES['img_approve']['tmp_name']));

            $getting_student_email = "SELECT * FROM `tbl_admission` WHERE `admission_id`='$registrationNumber'";
            $getting_student_result = mysqli_query($con, $getting_student_email);
            $getting_student_email_data = mysqli_fetch_array($getting_student_result);
            $getting_student_email_id = $getting_student_email_data['admission_emailid_student'];
            $getting_student_name = $getting_student_email_data['admission_first_name'];
            $student_id = $registrationNumber;
            $department_email = $_SESSION['admin_email'];
            $date = date('Y-m-d');
            if ($rebate_from == 647) {
                $rebate_particular = '1st semester';
            } else {
                $rebate_particular = $rebate_from;
            }
            $insert_rebate = "INSERT INTO `rebate`(`rebate_amount`, `approve_amount`, `rebate_by_name`, `rebate_by_email`, `student_email`, `student_name`, `rebate_date`, `approve_date`, `department`, `particular`, `massage`, `attach`, `status`) VALUES
            ('$rebate_amount','$rebate_amount','$rebate_by_name','$rebate_by_email','$getting_student_email_id','$getting_student_name','$date','$date','$department_email','Fine','$NotesByAdmin','$approve_attach','1')";

            $rebate_result = mysqli_query($con, $insert_rebate);




            include('../../Backend/rebate.php');

            if ($rebate_result) {

                $getting_course_name1 = "SELECT * FROM `tbl_course` WHERE course_id=$courseId";
                $getting_course_name_result = mysqli_query($con, $getting_course_name1);
                $getting_course_name_result_data = mysqli_fetch_array($getting_course_name_result);
                $add_admission_course_name1 = $getting_course_name_result_data['course_name'];
                $add_admission_session = $getting_course_name_result_data['course_duration'];

                $date = date('Y') + $add_admission_session;
                $add_admission_session = date('Y') . ' - ' . $date;

                sendmassageforupdate($NotesByAdmin, $getting_student_email_id, $getting_student_name, $add_admission_course_name1, $add_admission_session, $student_id, $particular_paid_particular_name, $rebate_amount, $rebate_by_email);
            }


            $implodedRebate = $rebate_amount . "," . $rebate_from;
        } else
            $implodedRebate = "";
            $flag=0;
            echo "<pre>";
            print_r($_POST);
        // if (!empty($registrationNumber && $academicYear && $courseId) && !empty($total_amount)) {
        //     if (($PaymentMode != "0" && $cashDepositTo != "0") || ($PaymentMode != "0" && !empty($chequeAndOthersNumber))) {
        //         if ($fine_amount >= 0 && $rebate_amount >= 0 && $total_amount >= 0 && $remaining_amount >= 0) {
                    $getRe = "SELECT `feepaid_id` FROM `tbl_fee_paid`
                                  WHERE `status` = '$visible'
                                 ";
                    $receipt_no_gen = 0;
                    $getReResult =  $con->query($getRe);

                    while ($getReRow = $getReResult->fetch_assoc())
                        $receipt_no_gen = $getReRow["feepaid_id"];
                    $receipt_no_gen++;
                    $implodedId = implode(",", $particular_paid_id);
                    $implodedAmount = implode(",", $particular_paid_amount);
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

                    echo "<pre>";

                    // checking the fine exits or not into  the post variable
           

                    for($i=0;$i<count($particular_paid_id);$i++){

                    if($particular_paid_amount[$i]!=='' ){
                          $fine_remaining_amount= $particular_fine_for_database[$particular_paid_id[$i]];

                            $flag=1;

                        }
                }
                    if($flag===1){
                         $sql = "INSERT INTO `tbl_fee_paid`
                        (`feepaid_id`, `student_id`, `course_id`, `particular_id`, `paid_amount`, `rebate_amount`, `fine`,`remaining_fine`, `extra_fine`, `balance`, `payment_mode`, `cash_deposit_to`, `cash_date`, `notes`, `receipt_date`, `bank_name`, `transaction_no`, `transaction_date`, `receipt_no`, `paid_on`, `university_details_id`, `fee_paid_time`, `payment_status`, `status`) 
                        VALUES 
                        (NULL, '$registrationNumber', '$courseId', '$implodedId', '$implodedAmount', '$implodedRebate', '$fine_amount', '$fine_remaining_amount','$complete_extra_fine', '$remaining_amount', '$PaymentMode', '$cashDepositTo', '$paymentDate', '$NotesByAdmin', '$paidDate', '$bankName', '$chequeAndOthersNumber', '$paymentDate', 'SU_$receipt_no_gen', '$paymentDate', '$academicYear', '$date_variable_today_month_year_with_timing', '$FeeStatus', '$visible')
                        ";
                    }else{
                         $implodedId =  ",".$_POST['fine_from'];
                        $implodedAmount = ",0";
                     echo   $fine_remaining_amount= $particular_fine_for_database[$_POST['fine_from']];


                         $sql = "INSERT INTO `tbl_fee_paid`
                                (`feepaid_id`, `student_id`, `course_id`, `particular_id`, `paid_amount`, `rebate_amount`, `fine`,`remaining_fine`, `extra_fine`, `balance`, `payment_mode`, `cash_deposit_to`, `cash_date`, `notes`, `receipt_date`, `bank_name`, `transaction_no`, `transaction_date`, `receipt_no`, `paid_on`, `university_details_id`, `fee_paid_time`, `payment_status`, `status`) 
                                VALUES 
                                (NULL, '$registrationNumber', '$courseId', '$implodedId', '$implodedAmount', '$implodedRebate', '$fine_amount','$fine_remaining_amount', '$complete_extra_fine', '$remaining_amount', '$PaymentMode', '$cashDepositTo', '$paymentDate', '$NotesByAdmin', '$paidDate', '$bankName', '$chequeAndOthersNumber', '$paymentDate', 'SU_$receipt_no_gen', '$paymentDate', '$academicYear', '$date_variable_today_month_year_with_timing', '$FeeStatus', '$visible')
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
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                             <i class="icon fas fa-check-circle"></i> Fee Successfully paid 
                             </div>';
                    } else
                        echo '<div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fas fa-ban"></i> Something Went Wrong Please Try Again!!!
                                  </div>';
        //         } else
        //             echo '<div class="alert alert-danger alert-dismissible">
        //                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        //                         <i class="icon fas fa-ban"></i> Cannot calculate Fees with <b>Negative</b> values!!!
        //                       </div>';
        //     } else
        //         echo '<div class="alert alert-warning alert-dismissible">
        //                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        //                     <i class="icon fas fa-exclamation-triangle"></i> Please Fill out Payment Details!!!
        //                   </div>';
        // } else
        //     echo '<div class="alert alert-danger alert-dismissible">
        //                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        //                 <i class="icon fas fa-ban"></i> Please Fill Out Fee Amounts!!!
        //               </div>';
    }
    //Pay Fee End
    ?>