<?php
include './Backend/connection.inc.php';
// getting the all events name

$msg = '';
if (isset($_POST['submit'])) {
// echo "<pre>";
// print_r($_POST);
// exit;
  for ($i = 0; $i < count($_POST['student_name']); $i++) {
    // event info
    $event_id = $_POST['event'];
    // $event_name = $_POST['event_name'];
    // $event_name = json_encode($event_name);
    // college info
    $type = $_POST['type'];
    $board_name = $_POST['board'] . " " . $_POST['board_name'];
    $affiliated_name = $_POST['affiliated_name'];
    $college_name = $_POST['college_name'];
    $stu_mobile = $_POST['stu_mobile'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $s_department = $_POST['department'];
    $district = $_POST['district'];
    $pincode = $_POST['pincode'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];

    // student info

    $s_student_name = $_POST['student_name'][$i];
    $s_f_name = $_POST['f_name'][$i];
    $s_dob = $_POST['dob'][$i];
    $s_gender = $_POST['gender'][$i];
    $s_student_mobile = $_POST['student_mobile'][$i];
    $student_whatsapp = $_POST['student_whatsapp'][$i];
    $student_address = $_POST['student_address'][$i];
    $student_images = addslashes(file_get_contents($_FILES['student_images']['tmp_name'][$i]));

    $s_student_email = $_POST['student_email'][$i];
     $event_name = $_POST['activites'][$i];

    // getting the events total number of  limit for a colleges

    $event_limit = "SELECT COUNT(college_name) as college_name FROM `participants_list` WHERE college_name='nsu';";
    $e_result = mysqli_query($connection, $event_limit);
    $total_college_limit = mysqli_fetch_array($e_result)['college_name'];
    // getting the all events 
    $participants_limit = "SELECT * FROM `tbl_sub_events` WHERE  `name`='$event_name' ";
    $participants_result = mysqli_query($connection, $participants_limit);
    $total_participants_limit = mysqli_fetch_array($participants_result);
    $total_event_limit=$total_participants_limit['limit'];

    if ($total_event_limit >= $total_college_limit) {
      $insert_query="INSERT INTO `participants_list`(`s_name`, `s_department`, `s_f_name`, `s_dob`, `s_gender`, `s_mobile`, `s_email`, `s_whatsapp`, `s_address`, `s_imgages`, `type`, `board_name`, `affiliated_name`, `college_name`, `mobile`, `email`, `country`, `state`, `district`, `city`, `pincode`, `address1`, `address2`, `event_name`, `event_id`) VALUES
      ('$s_student_name','$s_department','$s_f_name','$s_dob','$s_gender','$s_student_mobile','$s_student_email','$student_whatsapp','$student_address','$student_images','$type','$board_name','$affiliated_name','$college_name','$mobile','$email','$country','$state','$district','$city','$pincode','$address1','$address2','$event_name','$event_id')";
          $insert_resutl = mysqli_query($connection, $insert_query);

    }
    else{
      echo" <script>
        alert('event is full')
        </script>";
      }
  }
  if ($insert_resutl) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success</strong> Your Data Successfully Added into the Database
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';

    echo "<script>
      setTimeout(function() {
          window.location.replace('printevent.php?ins=$college_name')
        }, 1000);

  </script>";
  } else {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Alert!</strong> Data Already Exits Please Check Your Input Data
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
  }
}


?>

<?php              $event_qury1 = "SELECT * FROM `tbl_sub_events` WHERE 1";
                  $result1 = mysqli_query($connection, $event_qury1); 


                  $event_qury2 = "SELECT * FROM `tbl_sub_events` WHERE 1";
                  $result3 = mysqli_query($connection, $event_qury2); 
                  
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
            <h3 class="card-title text-center text-white">५ वाँ श्रीनाथ हिन्दी महोत्सव, जमशेदपुर 2021</h3>


          </div>
          <!-- SELECT2 EXAMPLE -->
          <form action="" method="POST" enctype="multipart/form-data" >
            <div class="card card-default">

              <br>
              <div class="card un-color">
                <h5 class="card-title ml-5  text-white">1. संस्थान का विवरण (Details of Orgnization) </h5>
              </div>



              <div class="card-body">

                <div class="row">

                  <div class="col-sm-4  mt-3">
                    <form action="" method="POST">
                      <label> संस्थान का प्रकार : <br>
                      Type of Orgnization :</label>
                      <select onchange="change(this.value)" name="type" class="form-control">
                        <option selected disabled>संस्थान का प्रकार</option>
                        <option value="school">School</option>
                        <option value="college">College</option>
                        <option value="institution">Institution</option>
                        <option value="university">University</option>
                      </select>

                  </div>
                  <div class="col-sm-4  mt-3">
                    <label>विद्यालय/महावि़द्यालय/विश्वविद्यालय/संस्थान का नाम : <br>
                      Name of the School/College/Institution/University :</label>
                    <input type="text" name="college_name" value="" placeholder="विद्यालय/महावि़द्यालय/संस्थान का नाम" class="form-control">
                  </div>
                  <div id="board" style="display: none;" class="col-sm-4  mt-3">

                    <label>
                      बोर्ड का नाम चुनें : <br>
                      Choose the Board:</label>
                    <select onchange="change_board(this.value)" name="board" class="form-control">
                      <option selected disabled>बोर्ड का नाम चुनें</option>
                      <option value="CBSE">CBSE</option>
                      <option value="ICSE">ICSE</option>
                      <option value="CISCE">CISCE</option>
                      <option value="NIOS">NIOS</option>
                      <option value="IB">IB</option>
                      <option value="CIE">CIE</option>
                      <option value="others">Others</option>
                    </select>
                  </div>

                  <div id="board_name" style="display: none;" class="col-sm-4   mt-3">
                    <label>बोर्ड का नाम : <br>
                      Name of the Board :</label>
                    <input id="form_no" type="text" name="board_name" class="form-control" placeholder="बोर्ड का नाम :">
                  </div>

                  <div id="affiliated" style="display: none;" class="col-sm-4   mt-3">
                    <label>संबद्ध का नाम : <br>
                      Affiliated with/to :</label>
                    <input id="form_no" type="text" name="affiliated_name" class="form-control" placeholder="संबद्ध का नाम :">
                  </div>
                  <div class="col-sm-4  mt-3">
                    <label>विभाग : <br>
                      Department :</label>
                    <input type="text" name="department" class="form-control" value="" placeholder="विभाग">
                  </div>


                  <div class="col-sm-4  mt-3">
                    <label>संस्थान का मोबाईल नं. : <br>
                    Institute  Mobile No. :</label>
                    <input type="text" name="stu_mobile" placeholder="मोबाईल नं." class="form-control">
                  </div>
                  <div class="col-sm-4  mt-3">
                    <label>मोबाईल नं. : <br>
                      Mobile No. :</label>
                    <input type="text" name="mobile" placeholder="मोबाईल नं." class="form-control">
                  </div>
                  <div class="col-sm-4  mt-3">
                    <label>ई&मेल : <br>
                      E-mail :</label>
                    <input type="email" name="email" placeholder="ई&मेल" class="form-control">
                  </div>
                  <div class="col-sm-4  mt-3">
                    <label>पिन कोड
                      : <br>
                      Pin code :</label>
                    <input required onkeyup="pin(this.value)" type="text" name="pincode" placeholder="पिन कोड" class="form-control">
                  </div>
                  <div class="col-sm-4  mt-3">
                    <label>देश : <br>
                    Country :</label>
                    <input readonly id="country" type="text" name="country" placeholder="देश" class="form-control">
                  </div>
                  <div class="col-sm-4  mt-3">
                    <label>राज्य : <br>
                      State :</label>
                    <input readonly id="state" type="text" name="state" placeholder="राज्य " class="form-control">
                  </div>
                  <div class="col-sm-4  mt-3">
                    <label>जिला : <br>
                      District :</label>
                    <input readonly id="district" type="text" name="district" placeholder="जिला" class="form-control">
                  </div>
                  
                  <div class="col-sm-4  mt-3">
                    <label>शहर : <br>
                      City :</label>
                    <input id="city" type="text" name="city" placeholder="शहर" class="form-control">
                  </div>

                  <div class="col-sm-4  mt-3">
                    <label>पता - 1 : <br>
                      Address - 1 :</label>
                    <input type="text" name="address1" placeholder="पता - 1" class="form-control">
                  </div>
                  <div class="col-sm-4  mt-3">
                    <label>पता - 2 : <br>
                      Address - 2 :</label>
                    <input type="text" name="address2" placeholder="पता - 2 " class="form-control">
                  </div>

                </div>

              </div>

              <br>


              <div class="card un-color">
                <h5 class="card-title ml-5  text-white">2. प्रतिभागियों का विवरण ( Participants Details )</h5>
              </div>


              <div class="card-body">

             

           
                  <div class="container">


                    <div class="row" >
                    <?php


$event_qury = "SELECT * FROM `tbl_event` WHERE 1";
$result = mysqli_query($connection, $event_qury);
$date = mysqli_fetch_array($result);
// getting the all activities of the event
$event_qury1 = "SELECT * FROM `tbl_sub_events` WHERE 1";
$result1 = mysqli_query($connection, $event_qury1);

?>



<div class="col-4  mt-3">
    <label>
प्रतियोगिता का नाम : <br>
Competition Name :</label>
    <br>

</div>
<div class="col-2  mt-3">
    <label>प्रारंभ समय
        : <br>
        Started time :</label>
    <br>

</div>
<div class="col-2  mt-3">
    <label>समाप्त समय

        : <br>
        Ended time :</label>
    <br>

</div>
<div class="col-2  mt-3">
    <label>
        नियम व शर्तें

        : <br>
        Term and Conditions :</label>


</div>

<?php while ($row1 = mysqli_fetch_array($result1)) { ?>

<section>



    <!-- The Modal -->
    <div class="modal" id="myModal<?php echo $row1['id']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $row1['name']; ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <?php echo $row1['t&c']; ?> </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>


</section>
<div class="col-4  mt-3">
    <label class="la" for="">
        <input type="checkbox" name="event_name[]" value="<?php echo $row1['name']; ?>"> <?php echo $row1['name']; ?>
        :</label>
</div>

<div class="col-2  mt-3">
    <input type="hidden" name="start[]" value="<?php  $row1['start_time_doe']; ?>">
    <label class="la" for=""><?php echo date('d-m-Y',strtotime($row1['startsubdoe'])).' '. $row1['start_time_doe']; ?></label>
</div>

<div class="col-2  mt-3">
    <input type="hidden" name="end[]" value="<?php echo $row1['end_time_doe'].$row1['end_time_doe']; ?>">
    <label class="la" for=""><?php echo date('d-m-Y',strtotime($row1['endsubdoe'])).' ' . $row1['end_time_doe']; ?></label>
</div>
<div class="col-2  mt-3">
    <!-- Button to Open the Modal -->
    <a type="button" class="text-danger" data-toggle="modal" data-target="#myModal<?php echo $row1['id']; ?>">
        T&C
    </a>

</div>
<div class="col-12  mt-3">
    <!-- Button to Open the Modal -->
    <table class="table table-bordered table-responsive" id="dynamic_field<?php echo $row1['id']?>"
        style="overflow-y:auto;">
        <thead>

        </thead>
        <tbody>
            <tr>

                <td><button type="button" name="add" id="add<?php echo $row1['id'] ?>" class="btn btn-success"><i
                            class="fa fa-plus" aria-hidden="true">+</i></button></td>
            </tr>
        </tbody>
    </table>
</div>
<?php } ?>
                    </div>
                  </div>
              </div>

              <!-- <div class="card un-color">
                <h5 class="card-title ml-5  text-white">हिन्दी महोत्सव</h5>
              </div> -->


              <!-- <div class="card-body">

             
                <div class="row">
              
                
                  <div class="card-body"> -->
                    <!-- <table class="table table-bordered table-responsive" id="dynamic_field" style="overflow-y:auto;">
                      <thead> -->
                        <!-- <tr>
                          <th>S.NO</th>
                          <th> <label>प्रतिभागी का नाम : <br>
                              Participant’s Name :</label></th>
                          <th> <label>पिता का नाम : <br>
                              Father’s Name :</label></th>
                          <th> <label>जन्म तिथि : <br>
                              Date of Birth :</label></th>
                          <th> <label>लिंग : <br>
                              Sex :</label></th>
                          <th><label>मोबाईल नं. : <br>
                              Mobile No. :</label></th>
                          <th> <label>ई&मेल : <br>
                              E-mail :</label></th>
                          <th> <label>गतिविधियां : <br>
                              Activities :</label></th>


                          <th rowspan="2">Actions</th>
                        </tr> -->
                      <!-- </thead>
                      <tbody>
                        <tr> -->
                          <!-- <td width="5%"><input type="text" id="slno1" value="1" readonly class="form-control" style="border:none;" /></td>
                          <td> <input required type="text" name="student_name[]" class="form-control" required></td>
                          <td> <input required id="course" name="f_name[]" placeholder="पिता का नाम" class="form-control" required /></td>
                          <td> <input required id="dob" type="date" name="dob[]" placeholder="जन्म तिथि" class="form-control" required></td>
                          <td>
                            <select id="gender" name="gender[]" class="form-control">
                              <option value="0">Gender</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            </select>
                          </td>
                          <td> <input required type="text" name="student_mobile[]" placeholder="मोबाईल नं." class="form-control"></td>
                          <td> <input required type="email" name="student_email[]" placeholder="ई&मेल" class="form-control"></td>
                          <td> <select name="activites[]" placeholder="ई&मेल" class="form-control">
                              <option selected disabled> - select -</option>
                              <?php  while ($row1 = mysqli_fetch_array($result1)) { ?>
                                <option value="<?php echo $row1['name']; ?>"> <?php  echo $row1['name']; ?> </option>
                              <?php  } ?>
                            </select>
                          </td> -->
                          <!-- <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"> Add</i></button></td>
                        </tr>
                      </tbody>
                    </table> -->
                    <!-- <br>
                  </div>
                </div>
              </div> -->
            
            
            </div>

            <?php echo $msg; ?>
            <div class="col-md-12 mt-5 ">
              <label for="">
                <input type="checkbox" name="" id="" required> &nbsp; सामान्य नीति नियम एवं विशिष्ट निर्देश <a href="" class="text-un" data-toggle="modal" data-target="#exampleModal">Term & Conditions</a>
              </label>
            </div>
        
            <div class=" text-center">


              <button type="submit" name="submit" class="btn btn-success">&nbsp; &nbsp; Submit &nbsp; &nbsp;</button>

            </div>
          </form>
      </section>

      <!-- /.content -->
    </div>
    <section class="card mt-5 un-color">
      <img src="./asset/img/event/hindi1.png" class="img-fluid" alt="">
      <br>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content ">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"> सामान्य नीति नियम एवं विशिष्ट निर्देश </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="ml-2">

                • प्रतिभागियों एवं प्रतिनिधियों का प्रवेश तथा पंजीयन निशुल्क होगा | <br>
                • प्रत्येक विद्यालय तथा विश्वविद्यालय प्रतिभागियों एवं प्रतिनिधियों की सूची पास्पोर्ट आकार के फ़ोटो के साथ १० दिसम्बर २०२१ दिन शुक्रवार तक ई मेल info@srinathuniversity.in पर उपलब्ध कराएँगे | <br>
                • प्रत्येक विद्यालय/ महाविद्यालय प्रतिभागी सूची अपने अधिकारिक मेल द्वारा भेजना सुनिश्चित करेंगे | <br>
                • प्रतिभागियों एवं प्रतिनिधियों का प्रवेश आयोजन समिति द्वारा निर्गत “प्रवेश पत्र” द्वारा होगा | <br>
                • प्रतिभागी एवं प्रतिनिधि अपने महाविद्यालय / विद्यालय द्वारा निर्गत पहचान पत्र साथ लाएँगे | <br>
                • प्रतियोगिता में प्रयुक्त होने वाली सभी सामग्री प्रतिभागी स्वयं ले कर आएँगे | <br>
                • पूर्व सूचना दिए जाने पर प्रतिभागियों एवं प्रतिनिधियों के रहने की समुचित व्यवस्था निशुल्क की जाएगी | <br>
                • प्रत्येक प्रतियोगिता के लिए जो प्रतिभागी समय सीमा सुनिश्चित की गई है वह अपरिवर्तनीय तथा सर्वमान्य होगी | <br>
                • प्रत्येक महाविद्यालय का प्रतियोगिता के लिए चयन पहले पंजीयन कराने के आधार पर होगा | <br>
                • प्रतिभागी तथा शिक्षक प्रतिनिधि विश्वविद्यालय परिसर की स्वच्छता बनाए रखने में आयोजन समिति का सहयोग करेंगे | <br>
                • वाहनों के ठहराव स्थल पर वाहनों को सलीके से खड़ा करेंगे | <br>
                • विश्वविद्यालय के सम्पत्ति को किसी भी प्रकार का कोई नुक़सान नहीं पहुँचाएँगे | <br>
                • भोजन के समय पंक्तिबद्ध होकर भोजन का आनंद लेंगे | <br>
                • विश्वविद्यालय परिसर में किसी भी प्रकार की हिंसा तथा अपशब्दों का प्रयोग पूर्णतः वर्जित होगा | <br>
                • प्रतिभागी अपने समान की सुरक्षा स्वयं करेंगे | <br>
                • किसी भी प्रकार का भत्ता देय नहीं है | <br>
                • विस्तृत जानकारी srinathuniversity.in पर उपलब्ध है अथवा दूरभाष संख्या ७९०९०३३३१८ / ७००४२११४२६ / ८४३४०१३२४६ पर सम्पर्क कर सकते हैं | <br>
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary un-color" data-dismiss="modal">Close</button>

            </div>
          </div>
        </div>
      </div>

    </section>


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
<?php $event_qury1 = "SELECT * FROM `tbl_sub_events` WHERE 1";
$result1 = mysqli_query($connection, $event_qury1); 
while ($row1 = mysqli_fetch_array($result1)) {
?>
<script type="text/javascript">
  $(document).ready(function() {
    var i = 0;

    $('#add<?php echo $row1['id'] ?>').click(function() {
      i++;
      $('#dynamic_field<?php echo $row1['id'] ?>').append('<tr id="row' + i + '" class="dynamic-added" ><td width="1%"><input title=" "   type="text" id="slno' + i + '" value="' + i + '" readonly class="form-control form-control1" style="border:none;" /></td> </td><td> <input title=" प्रतिभागि का नाम " type="text" placeholder="प्रतिभागि का नाम" name="student_name[]" class="form-control" required></td> <td> <input title=" पिता का नाम " id="course" name="f_name[]" placeholder="पिता का नाम" class="form-control" required /></td>  <td> <input title=" जन्म तिथि " id="dob" type="date" name="dob[]" placeholder="जन्म तिथि" class="form-control" required></td>  <td> <select id="gender" name="gender[]" class="form-control">  <option selected disabled value="0">Gender</option>                            <option value="Male">Male</option>                      <option value="Female">Female</option>                  </select>        </td>                  <td> <input title=" मोबाईल नं. " type="text" name="student_mobile[]" placeholder="मोबाईल नं." class="form-control"></td>              <td> <input title=" व्हाट्स एप नं. " type="text" name="student_whatsapp[]" placeholder="व्हाट्स एप नं." class="form-control"></td>               <td> <input title=" पता " type="text" name="student_address[]" placeholder="पता" class="form-control"></td>               <td> <input title=" छात्र छवि (Student images) " type="file" name="student_images[]" placeholder="मोबाईल नं." class="form-control"></td>                 <td> <input title=" ई-मेल " type="text" name="student_email[]" placeholder="ई-मेल" class="form-control"></td>    <td class="d-none" > <input title=" " type="text"  name="activites[]" value="<?php echo $row1['name'] ?>" placeholder="activites" class="form-control" />             </td>  <td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
    });

    $(document).on('click', '.btn_remove', function() {
      var button_id = $(this).attr("id");
      $('#row' + button_id + '').remove();
    });

  });
</script>
<?php } ?>
</html>
