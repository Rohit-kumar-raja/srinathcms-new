<?php
include './Backend/connection.inc.php';
// getting the all events name
$institute_name = $_GET['ins'];
$get_event = "SELECT * FROM `participants_list` WHERE `college_name`='$institute_name' ";
$event_result = mysqli_query($connection, $get_event);
$row = mysqli_fetch_array($event_result);

$get_event1 = "SELECT * FROM `participants_list` WHERE `college_name`='$institute_name' ";
$event_result1 = mysqli_query($connection, $get_event1);


$teacher_event = "SELECT * FROM `event_teachers` WHERE  `college_name`='$institute_name' ";
$teacher_result = mysqli_query($connection, $teacher_event);
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SRINATH UNIVERSITY | हिन्दी महोत्सव </title>
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./asset/css/event.css">
    <link rel="icon" href="app-assets/images/logo/favicon-32x32.png" sizes="32x32">
    <link rel="icon" href="app-assets/images/logo/favicon-192x192.png" sizes="192x192">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">



        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header bg-header un-color">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 class="text-center text-white"></h1>
                            <img class="img-fluid" src="./asset/img/event/hindi.png" alt="">
                        </div>

                    </div>
                </div>
            </section>



            <!-- Main content -->

            <section class="content">

                <div class="container-fluid">

                    <div class="card-header un-color">
                        <h3 class="card-title text-center text-white">५ वाँ अंतर्राष्ट्रीय श्रीनाथ हिन्दी महोत्सव, जमशेदपुर २०२१</h3>

                    </div>
                    <!-- SELECT2 EXAMPLE -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="card card-default">

                            <br>
                            <div class="card un-color">
                                <h5 class="card-title ml-5  text-white">1. संस्थान का विवरण (Details of the Organization) </h5>
                            </div>



                            <div class="card-body">

                                <div class="row">


                                    <div class="col-sm-3  mt-3">
                                        <label><?php echo ucwords($row['type']) ?> का नाम : <br>
                                            Name of the <?php echo $row['type'] ?> :</label>
                                        <input disabled type="text" name="college_name" value="<?php echo $row['college_name'] ?>" placeholder="विद्यालय/महावि़द्यालय/संस्थान का नाम" class="form-control">
                                    </div>





                                    <div class="col-sm-3  mt-3">
                                        <label>विभाग : <br>
                                            Department :</label>
                                        <input disabled type="text" value="<?php echo $row['s_department'] ?>" name="department" class="form-control" value="" placeholder="विभाग">
                                    </div>


                                    <div class="col-sm-3  mt-3">
                                        <label>मोबाईल नं. : <br>
                                            Mobile No. :</label>
                                        <input disabled type="text" value="<?php echo $row['mobile'] ?>" name="stu_mobile" placeholder="मोबाईल नं." class="form-control">
                                    </div>
                                    <div class="col-sm-3  mt-3">
                                        <label>फ़ोन नं. : <br>
                                            Phone No. :</label>
                                        <input disabled type="text" value="<?php echo $row['mobile'] ?>" name="mobile" placeholder="मोबाईल नं." class="form-control">
                                    </div>
                                    <div class="col-sm-3  mt-3">
                                        <label>ई-मेल : <br>
                                            E-mail :</label>
                                        <input disabled type="email" value="<?php echo $row['email'] ?>" name="email" placeholder="ई-मेल" class="form-control">
                                    </div>
                                    <div class="col-sm-3  mt-3">
                                        <label>पिन कोड
                                            : <br>
                                            Pin code :</label>
                                        <input disabled required onkeyup="pin(this.value)" value="<?php echo $row['pincode'] ?>" type="text" name="pincode" placeholder="पिन कोड" class="form-control">
                                    </div>
                                    <div class="col-sm-3  mt-3">
                                        <label>देश : <br>
                                            Country :</label>
                                        <input disabled readonly id="country" value="<?php echo $row['country'] ?>" type="text" name="country" placeholder="देश" class="form-control">
                                    </div>
                                    <div class="col-sm-3  mt-3">
                                        <label>राज्य : <br>
                                            State :</label>
                                        <input disabled readonly id="state" value="<?php echo $row['state'] ?>" type="text" name="state" placeholder="राज्य " class="form-control">
                                    </div>
                                    <div class="col-sm-3  mt-3">
                                        <label>जिला : <br>
                                            District :</label>
                                        <input disabled readonly id="district" value="<?php echo $row['district'] ?>" type="text" name="district" placeholder="शहर" class="form-control">
                                    </div>

                                    <div class="col-sm-3  mt-3">
                                        <label>शहर : <br>
                                            City :</label>
                                        <input disabled id="city" type="text" value="<?php echo $row['s_department'] ?>" name="city" placeholder="शहर" class="form-control">
                                    </div>

                                    <div class="col-sm-3  mt-3">
                                        <label>पता - 1 : <br>
                                            Address - 1 :</label>
                                        <input disabled type="text" name="address1" value="<?php echo $row['address1'] ?>" placeholder="पता - 1" class="form-control">
                                    </div>
                                    <div class="col-sm-3  mt-3">
                                        <label>पता - 2 : <br>
                                            Address - 2 :</label>
                                        <input disabled type="text" name="address2" value="<?php echo $row['address2'] ?>" placeholder="पता - 2 " class="form-control">
                                    </div>

                                </div>

                            </div>

                            <br>
                            <!-- here to started the representetives Detailss -->
                            <div class="card un-color">
                            <h5 class="card-title ml-5  text-white">2. संस्थान प्रतिनिधि का विवरण ( Details of Organization's Representatives )</h5>
                            </div>


                            <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-3  mt-3">
                                        <label>नाम : <br>
                                            Name :</label>
                                        <input disabled id="" type="hidden" name="t_name[]" placeholder="नाम" class="form-control">
                                    </div>

                                    <div class="col-sm-3  mt-3">
                                        <label>मोबाईल नं. : <br>
                                            Mobile No. :</label>
                                        <input disabled type="hidden" name="t_mobile[]" placeholder="मोबाईल नं." class="form-control">
                                    </div>
                                    <div class="col-sm-3  mt-3">
                                        <label>ई-मेल : <br>
                                            E-mail :</label>
                                        <input disabled type="hidden" name="t_email[]" placeholder="ई-मेल" class="form-control">
                                    </div>
                                    <div class="col-sm-3  mt-3">
                                        <label> पहचान पत्र : <br>
                                            Identity Card
                                            :</label>
                                        <input disabled type="hidden" name="t_idimg[]" placeholder=" पहचान पत्र " class="form-control">
                                    </div>
                                    <?php while ($row3 = mysqli_fetch_array($teacher_result)) {
                                        if ($row3['name'] != '') {
                                    ?>
                                            <div class="col-sm-3  mt-3">

                                                <input disabled id="" value="<?php echo $row3['name'] ?>" type="text" name="t_name[]" placeholder="नाम" class="form-control">
                                            </div>

                                            <div class="col-sm-3  mt-3">

                                                <input disabled type="text" value="<?php echo $row3['phone'] ?>" name="t_mobile[]" placeholder="मोबाईल नं." class="form-control">
                                            </div>
                                            <div class="col-sm-3  mt-3">

                                                <input disabled type="email" value="<?php echo $row3['email'] ?>" name="t_email[]" placeholder="ई-मेल" class="form-control">
                                            </div>
                                            <div class="col-sm-3  mt-3">

                                                <img width="60" class="img-fluid mini" src=<?php echo  ' "data:image/jpeg;base64,' . base64_encode($row3["images"]) . '" ' ?>>
                                            </div>
                                    <?php }
                                    } ?>
                                </div>

                            </div>
                            <br>
                            <br>

                            <div class="card un-color">
                                <h5 class="card-title ml-5  text-white">3. प्रतिभागियों का विवरण ( Participant's Detail )</h5>
                            </div>


                            <div class="card-body">






                                <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="th-sm"> प्रतिभागी का नाम
                                            </th>
                                            <th class="th-sm">पिता का नाम
                                            </th>
                                            <th class="th-sm">जन्म तिथि
                                            </th>
                                            <th class="th-sm">लिंग
                                            </th>
                                            <th class="th-sm">मोबाईल नं.
                                            </th>
                                            <th class="th-sm">व्हाट्स एप नं.
                                            </th>

                                            <th class="th-sm">ई-मेल
                                            </th>

                                            <th class="th-sm">पता
                                            </th>

                                            <th class="th-sm">प्रतियोगिता
                                            </th>
                                            <th class="th-sm">छात्र छवि
                                            </th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($event_result1)) { ?>
                                            <tr>

                                                <td><?php echo $row['s_name']; ?></td>


                                                <td><?php echo $row['s_f_name']; ?></td>

                                                <td><?php echo $row['s_dob']; ?></td>

                                                <td><?php echo $row['s_gender']; ?></td>

                                                <td><?php echo $row['s_mobile']; ?></td>
                                                <td><?php echo $row['s_whatsapp']; ?></td>
                                                <td><?php echo $row['s_email']; ?></td>
                                                <td><?php echo $row['s_address']; ?></td>
                                                <td><?php echo $row['event_name']; ?></td>


                                                <td>

                                                    <img width="60" class="img-fluid mini" src=<?php echo  ' "data:image/jpeg;base64,' . base64_encode($row["s_imgages"]) . '" ' ?>>


                                                </td>



                                            </tr>
                                        <?php } ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>


                </div>


                <div class="col-md-12 mt-5 ">

                </div>

                <div class=" text-center">


                    <button type="button" id="prin" onclick="hidebutton()" name="submit" class="btn btn-success">&nbsp; &nbsp; Print &nbsp; &nbsp;</button>

                </div>
                </form>
            </section>

            <!-- /.content -->
        </div>



    </div>
    <div class="bg-dark p-1 mt-5">
        <footer class="text-center mt-3 text-white ">
            <?php include './srinath/include/footer.php'; ?>
        </footer>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./asset/js/event.js"></script>

<script>
    function hidebutton() {
        document.getElementById("prin").style.display = "none";
        print()
    }
</script>

</html>