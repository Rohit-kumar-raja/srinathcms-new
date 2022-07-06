<?php
include "include/authentication.php";
error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <meta name="description" content="School Management 	" />
  <meta name="keywords" content="School Management   " />
  <title> SRINATH UNIVERSITY : Admit Card</title>
  <style type="text/css">
    @font-face {
      font-family: Belwec;
      src: url('includes/fonts/Belwec.ttf');
    }

    .narmal {
      font-family: tahoma;
      padding: 2px;
      font-size: 14px;
      font-weight: normal;
      text-decoration: none;
      color: #000000;
    }

    txt_01 {
      font-family: verdaba;
      font-size: 14px;
      font-weight: 400;
    }

    .style1 {
      font-size: 40px;
      margin-left: -100px;
      /*font-family: Verdana, Arial, Helvetica, sans-serif;
	font-family:Belwec;*/
      font-weight: bold;
    }

    .border1 {
      border-bottom: #000000;
      border-top: #000000;
    }

    .admin {
      font-family: tahoma;
      font-size: 14px;
      font-weight: bold;
      color: #0d1065;
      text-decoration: none;
    }

    .bgcolor_2 {
      background-color: #0d1065;
      color: #0d1065;
      text-align: left;
      font-weight: normal;
      font-family: Tahoma;
      font-size: 12px;
      text-decoration: none;
    }

    .admin-logo {
      height: 84px;
      margin-top: 16px;
      width: 182px;
    }

    .size-50 {
      font-size: 15px;
      margin-left: -120px;
    }
  </style>
  <link href="../student/dist/css/violet.css" rel="stylesheet" type="text/css" />
</head>

<body class="body_pop" style="color:#0d1065;">
  <p style="position: fixed;right: 3%;">
    <a href="" id="printbutton" value="&nbsp;Print" onclick="return printing();"><img src="images/print.jpg" style="height: 80px;"></a>
  </p>]
  <input type="text" id="reg_no_value" onkeyup="reg_no(this.value)" placeholder="Enter Roll number">
  <input type="text" id="roll_no_value" onkeyup="roll_no(this.value)" placeholder="Enter registration number">
  <table width="740" border="0" align="center" class="tb2_grid" style="background-image: url('images/admit_card_watermark.jpg') ; background-repeat: no-repeat;
    background-position: center;
    background-size: cover;">

    <tr>
      <td align="right" valign="top">
        <table width="100%" border="0">
          <td width="8%" rowspan="4" align="center" valign="top"><img class="admin-logo" src="./images/logo1.png" width="150" height="40" alt="Image" border="0" title="Images">&nbsp;</td>
          <tr>
            <td align="center" valign="top"><span class="style1" style="color:#c70013;font-weight:900;"><u>SRINATH UNIVERSITY <br> <span class="size-50"> JAMSHEDPUR</span></u>
                <!--"CENTRAL PROVINCIAL SCHOOL"-->
              </span></td>
          </tr>
        </table>
    </tr>
    <tr>
      <td height="93" colspan="3">

        <script type="text/javascript">
          function popup_letter(url) {
            var width = 700;
            var height = 500;
            var left = (screen.width - width) / 2;
            var top = (screen.height - height) / 2;
            var params = 'width=' + width + ', height=' + height;
            params += ', top=' + top + ', left=' + left;
            params += ', directories=no';
            params += ', location=no';
            params += ', menubar=no';
            params += ', resizable=no';
            params += ', scrollbars=yes';
            params += ', status=no';
            params += ', toolbar=no';
            newwin = window.open(url, 'windowname5', params);
            if (window.focus) {
              newwin.focus()
            }
            return false;
          }
        </script>
        <script type="text/javascript">
          /************ Checking Browsers ***********/
          function GetXmlHttpObject(handler) {
            var objXmlHttp = null

            if (navigator.userAgent.indexOf("Opera") >= 0) {
              alert("This Site doesn't work in Opera")
              return
            }
            if (navigator.userAgent.indexOf("MSIE") >= 0) {
              var strName = "Msxml2.XMLHTTP"
              if (navigator.appVersion.indexOf("MSIE 5.5") >= 0) {
                strName = "Microsoft.XMLHTTP"
              }
              try {
                objXmlHttp = new ActiveXObject(strName)
                objXmlHttp.onreadystatechange = handler
                return objXmlHttp
              } catch (e) {
                alert("Error. Scripting for ActiveX might be disabled")
                return
              }
            }
            if (navigator.userAgent.indexOf("Mozilla") >= 0) {
              objXmlHttp = new XMLHttpRequest()
              objXmlHttp.onload = handler
              objXmlHttp.onerror = handler
              return objXmlHttp
            }
          }

          /** Completed checking Browser.. **/
          /************ Get List of Districts ***********/
          function getsubjects(countryid, selval) {

            url = "?pid=95&action=getposts&es_departmentsid=" + countryid + "&selval=" + selval;
            url = url + "&sid=" + Math.random();

            xmlHttp1 = GetXmlHttpObject(countryChanged);
            xmlHttp1.open("GET", url, true);
            xmlHttp1.send(null);
          }

          function countryChanged() {
            if (xmlHttp1.readyState == 4 || xmlHttp1.readyState == "complete") {
              document.getElementById("subjectselectbox").innerHTML = xmlHttp1.responseText
            }
          }

          function getallsubjects(countryid, getselected) {

            url = "?pid=95&action=getstaff&cid=" + countryid + "&selval=" + getselected;
            url = url + "&sid=" + Math.random();
            xmlHttp = GetXmlHttpObject(countryChanged2);
            xmlHttp.open("GET", url, true);
            xmlHttp.send(null);
          }

          function countryChanged2() {
            if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
              document.getElementById("subject2selectbox").innerHTML = xmlHttp.responseText
            }
          }
        </script>
        <script type="text/javascript">
          var gblvar7 = 1;

          function AddRow7() //This function will add extra row to provide another file
          {

            var prevrow = document.getElementById("uplimg7");
            var tmpvar = gblvar7;
            var newrow = prevrow.insertRow(prevrow.rows.length);
            newrow.id = newrow.uniqueID; // give row its own ID

            var newcell; // an inserted row has no cells, so insert the cells
            newcell = newrow.insertCell(0);
            newcell.id = newcell.uniqueID;
            newcell.innerHTML = "<table width='100%' border='0' cellspacing='0' cellpadding='0'><TR height='25'><td align='left' ><input name='newimage[]' type='file'><input type='hidden' name='filecount[]' value='1' ></TD></TR></table>";

            gblvar7 = tmpvar + 1;
          }

          function DelRow7() //This function will delete the last row
          {
            if (gblvar7 == 1)
              return;

            var prevrowas = document.getElementById("uplimg7");
            //alert(gblvar);
            prevrowas.deleteRow(prevrowas.rows.length - 1);
            gblvar7 = gblvar7 - 1;
          }
        </script>



        <script type="text/javascript">
          document.title = "SRINATH UNIVERSITY :  Admit Card";
        </script>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">

          <?php
          $id = $_GET['id'];
          $sql = "SELECT * FROM `tbl_prospectus` WHERE `id`=$id";
          $result = $con->query($sql);
          $row = $result->fetch_assoc();

          $sql_course = "SELECT * FROM `tbl_course`
					   WHERE `status` = '$visible' && `course_name` = '" . $row["prospectus_course_name"] . "';
					   ";
          $result_course = $con->query($sql_course);
          $row_course = $result_course->fetch_assoc();

          $sql_semester = "SELECT * FROM `tbl_semester`
						 WHERE `status` = '$visible' && `semester_id` = '" . $row["semester_id"] . "';
					    ";
          $result_semester = $con->query($sql_semester);
          $row_semester = $result_semester->fetch_assoc();

          // getting the session name from university details page
          $explode_date = explode('-', $row['prospectus_session']);
          if (strlen($explode_date[0]) > 5) {
            $start_year = explode('/', $explode_date[0])[2];
            $end_year = explode('/', $explode_date[1])[2];
            $start_year = $start_year . '-04-01';
            $end_year = $end_year . '-03-31';
          } else {
            $start_year = $explode_date[0] . '-04-01';
            $end_year = $explode_date[1] . '-03-31';
          }

          $sql_session = "SELECT * FROM `tbl_university_details` WHERE `university_details_academic_start_date`='$start_year' && `university_details_academic_end_date`='$end_year' ";

          $result_session = $con->query($sql_session);
          $row_session = $result_session->fetch_assoc();

          ?>
          <tr>
            <td colspan="3" class="" align="center">&nbsp;&nbsp;<span class="admin">
                <ul style="margin-top: -30px;font-size: 16px;"><?= '1st Semester' ?> Examination - <?php echo date('Y'); ?></ul>
              </span></td>
          </tr>
          <tr>
            <td colspan="3" class="" align="center">&nbsp;&nbsp;<span class="admin">
                <ul style="margin-top:-80px;"><u>ADMIT CARD</u>
              </span></td>
          </tr>
          <tr>
            <td height="25" colspan="3" class="tb1_grid">&nbsp;&nbsp;<span class="admin" style="	word-spacing: -1px;">REGN NO: <span id="reg_no_data"></span> &nbsp;&nbsp;&nbsp; COURSE : <?php
                                                                                                                                                                                            if (($row_course["course_name"]) == "BBA") {
                                                                                                                                                                                              echo "BACHELOR OF BUSINESS ADMINISTRATION";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "MBA") {
                                                                                                                                                                                              echo "MASTER OF BUSINESS ADMINISTRATION";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "B.COM") {
                                                                                                                                                                                              echo "BACHELOR OF COMMERCE";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "M.COM") {
                                                                                                                                                                                              echo "MASTER OF COMMERCE";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "BCA") {
                                                                                                                                                                                              echo "BACHELOR OF  COMPUTER APPLICATION";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "MCA") {
                                                                                                                                                                                              echo "MASTER OF  COMPUTER APPLICATION";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "B.SC(IT)") {
                                                                                                                                                                                              echo "BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "M.SC(IT)") {
                                                                                                                                                                                              echo "MASTER OF SCIENCE IN INFORMATION TECHNOLOGY";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "B.PHARM") {
                                                                                                                                                                                              echo "BACHELOR OF PHARMACY";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "D.PHARM") {
                                                                                                                                                                                              echo "DIPLOMA OF PHARMACY";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "B.ED") {
                                                                                                                                                                                              echo "BACHELOR OF EDUCATION";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "B.Sc in Hotel Management") {
                                                                                                                                                                                              echo "B.SC IN HOTEL MANAGEMENT";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "B.Sc IN Travel & Tourism Management") {
                                                                                                                                                                                              echo "B.Sc IN Travel & Tourism Management";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "LLB") {
                                                                                                                                                                                              echo "BACHELOR OF LEGISLATIVE LAW";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "BBA LLB") {
                                                                                                                                                                                              echo "BACHELOR OF BUSINESS ADMINISTRATION AND BACHELOR OF LAWS";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "B.Sc (BOTANY)") {
                                                                                                                                                                                              echo "BACHELOR OF SCIENCE - BOTANY";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "B.Sc (ZOOLOGY)") {
                                                                                                                                                                                              echo "BACHELOR OF SCIENCE - ZOOLOGY";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "B.Sc (MATHEMATICS)") {
                                                                                                                                                                                              echo "BACHELOR OF SCIENCE - MATHEMATICS";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "B.SC (PHYSICS)") {
                                                                                                                                                                                              echo "BACHELOR OF SCIENCE - PHYSICS";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "B.SC (CHEMISTRY)") {
                                                                                                                                                                                              echo "BACHELOR OF SCIENCE - CHEMISTRY";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "M.Sc (BOTANY)") {
                                                                                                                                                                                              echo "MASTER OF SCIENCE - BOTANY";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "M.Sc (ZOOLOGY)") {
                                                                                                                                                                                              echo "MASTER OF SCIENCE - ZOOLOGY";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "M.Sc (MATHEMATICS)") {
                                                                                                                                                                                              echo "MASTER OF SCIENCE - MATHEMATICS";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "M.SC (PHYSICS)") {
                                                                                                                                                                                              echo "MASTER OF SCIENCE - PHYSICS";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "M.SC (CHEMISTRY)") {
                                                                                                                                                                                              echo "MASTER OF SCIENCE - CHEMISTRY";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "B.TECH") {
                                                                                                                                                                                              echo "B.TECH";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "POLYTECHNIC") {
                                                                                                                                                                                              echo "POLYTECHNIC";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "B.A") {
                                                                                                                                                                                              echo "BACHELOR OF ARTS";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "M.A") {
                                                                                                                                                                                              echo "MASTER OF ARTS";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "Event Management") {
                                                                                                                                                                                              echo "Event Management";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "B.A IN JOURNALISM & MASS COMM.") {
                                                                                                                                                                                              echo "BACHELOR OF ARTS IN JOURNALISM & MASS COMMUNICATION";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "M.A IN JOURNALISM & MASS COMM.") {
                                                                                                                                                                                              echo "MASTER OF ARTS IN JOURNALISM & MASS COMMUNICATION";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "FASHION DESIGNING") {
                                                                                                                                                                                              echo "FASHION DESIGNING";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "INTERIOR DESIGNING") {
                                                                                                                                                                                              echo "INTERIOR DESIGNING";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "PHD") {
                                                                                                                                                                                              echo "PHD";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "B.A (Economics)") {
                                                                                                                                                                                              echo "BACHELOR OF ARTS - ECONOMIC (HONS.)";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "B.A (Geography)") {
                                                                                                                                                                                              echo "BACHELOR OF ARTS - GEOGRAPHY (HONS.)";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "B.A (Political Science)") {
                                                                                                                                                                                              echo "BACHELOR OF ARTS - POLITICAL SCIENCE (HONS.)";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "B.A (English)") {
                                                                                                                                                                                              echo "BACHELOR OF ARTS - ENGLISH (HONS.)";
                                                                                                                                                                                            } else if (($row_course["course_name"]) == "Diploma in Engineering") {
                                                                                                                                                                                              echo "DIPLOMA IN ENGINEERING";
                                                                                                                                                                                            } else {
                                                                                                                                                                                              echo ($row_course["course_name"]);
                                                                                                                                                                                            }
                                                                                                                                                                                            ?>&nbsp;&nbsp;&nbsp;&nbsp;<b style="margin-left: 152px;">YEAR OF REG.: 2021</b></span></td>
          </tr>
          <tr class="">
            <td width="1" class="bgcolor_02"></td>
            <td align="left" valign="top">
              <table width="100%" class="">
                <tr class="">
                  <td>
                    <table style="width:100%">
                      <tr>
                        <td align="left" class="narmal" width="21%">NAME OF STUDENT</td>
                        <td align="left" class="narmal" width="1%">:</td>
                        <td align="left" class="narmal" width="37%" style="text-transform: uppercase;"><?php echo $row["prospectus_applicant_name"] ?></td>

                        <td align="left" class="narmal" width="1%">GENDER</td>
                        <td align="left" class="narmal" width="1%">:</td>
                        <td align="left" class="narmal" width="20%" style="text-transform: uppercase;"><?php echo $row["prospectus_gender"]; ?></td>

                        <th rowspan="3" style="width:100px; border: 1px solid #4d4a74"><?php
                                                                                        if (!empty($row["prospectus_profile_image"])) {
                                                                                        ?>
                            <img width="71.3671875" height="87" alt="Image" border="0" title="Images" class="profile-user-img " src=<?php echo  ' "data:image/jpeg;base64,' . base64_encode($row["prospectus_profile_image"]) . '" ' ?> alt="Student profile picture">
                          <?php
                                                                                        } else if (strtolower($row["prospectus_gender"]) == "female") {
                          ?>
                            <img width="71.3671875" height="87" alt="Image" border="0" title="Images" class="profile-user-img img-fluid img-circle" src="images/womenIcon.png" alt="Student profile picture">
                          <?php } else {   ?>
                            <img width="71.3671875" height="87" alt="Image" border="0" title="Images" class="profile-user-img img-fluid img-circle" src="images/menIcon.png" alt="Student profile picture">
                          <?php } ?>
                        </th>
                      </tr>
                      <tr>
                        <td align="left" class="narmal" width="21%">FATHER'S NAME </td>
                        <td align="left" class="narmal" width="1%">:</td>
                        <td align="left" class="narmal" width="37%" style="text-transform: uppercase;"><?php echo $row["prospectus_father_name"]; ?></td>

                        <td align="left" class="narmal" width="1%">DOB</td>
                        <td align="left" class="narmal" width="1%">:</td>
                        <td align="left" class="narmal" width="20%" ;><?php echo date('d-m-Y', strtotime($row["prospectus_dob"])); ?></td>
                      </tr>
                      <tr>
                        <td height="25" colspan="6" align="center" class="tb1_grid">&nbsp;&nbsp;<span class="admin"><u>SUBJECT DETAILS</u></span></td>
                      </tr>
                    </table>

                  </td>
                </tr>
                <tr colspan="3" class="tb1_grid">
                  <td>
                    <table width="100%" class="tb1_grid">
                      <thead>

                        <tr height="25" class="bgcolor_02" colspan="3" class="tb1_grid">
                          <td width="20%" align="center"><u>SUBJECT CODE</u></td>
                          <td width="50%" align="center"><u>SUBJECT NAME</u></td>
                          <td width="30%" align="center"><u>DATE OF EXAMINATION</u></td>
                        </tr>
                      </thead>

                      <tbody>
                        <?php
                        //  $sql = "SELECT * FROM `tbl_subjects` WHERE `status` = '$visible' && course_id = '1' && fee_academic_year = '3' ORDER BY `subject_id` ASC ";

                        $sql = "SELECT * FROM `tbl_subjects` WHERE `status` = '$visible' && course_id = '" . $row_course["course_id"] . "' && fee_academic_year = '" . $row_session["university_details_id"] . "' ORDER BY `subject_id` ASC ";
                        $rows = $con->query($sql);
                        while ($row_course = $rows->fetch_assoc()) {
                        ?>
                          <tr>
                            <td align="center" class="narmal"><?php echo $row_course["subject_code"] ?></td>
                            <td align="center" class="narmal" style="text-transform: uppercase;"><?php echo $row_course["subject_name"] ?></td>
                            <td align="center" class="narmal"><?php if (strtotime($row_course['date_of_examination']) > 0) {
                                                                echo date("d-m-Y", strtotime($row_course["date_of_examination"]));
                                                              } else {
                                                                echo '--';
                                                              } ?></td>
                          </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </td>
                </tr>

                <tr colspan="3">
                  <td>
                    <table width="100%">
                      <td class="narmal">CENTRE NAME: SRINATH UNIVERSITY, JAMSHEDPUR</br>ROLL NO: <span id="roll_no_data1" ></span></td>
                      <!-- <td class="narmal">LOG IN TIME: <?php echo strtoupper($row_semester["exam_reporting_time"]) ?> </br>TIME OF EXAMINATION: <?php echo strtoupper($row_semester["time_of_examination"]) ?></td> -->
                    </table>
                  </td>
                </tr>
              </table>
              <hr>

            </td>
            <td width="1" class="bgcolor_02"></td>
          </tr>
          <tr>
            <td width="1" class="bgcolor_02"></td>
            <td height="10">&nbsp;</td>
            <td width="1" class="bgcolor_02"></td>
          </tr>

          <!--  -->
          <tr>
            <td colspan="7" align="left" valign="top"></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="10"></td>
    </tr>
    <tr>
      <td colspan="10"></td>
    </tr>
    <tr>
      <td colspan="10"></td>
    </tr>
    <tr>
      <td colspan="10"></td>
    </tr>
    <tr>
      <td colspan="10"></td>
    </tr>
    <tr>
      <td colspan="10"></td>
    </tr>
    <tr>
      <td colspan="10"></td>
    </tr>
    <tr>
      <td colspan="10">
        <table width="100%" border="0">



          <tr>
            <td></td>
            <td></td>
            <td width="414" valign="top"><img src="images/signature.png" style="margin-top: -43px;height: 43px;width: 120px;margin-left: 41px;"></td>

          </tr>
          <tr>
            <td width="306" height="20" align="left" valign="top" class="narmal"><strong>STUDENT SIGNATURE</strong></td>
            <td width="414" valign="top" class="narmal"><strong>SIGNATURE OF DEPT.HEAD</strong></td>
            <td width="414" valign="top" class="narmal"><strong>CONTROLLER OF EXAMINATION</strong></td>

          </tr>



        </table>
      </td>
    </tr>

    <!--		-->
    <tr>
      <td height="1" colspan="3" class="bgcolor_02"></td>
    </tr>
  </table>

  <p>
  <table width="740" border="0" align="center" class="tb2_grid">
    <tbody>
      <tr>
        <td style=" margin-right: 50px;
  margin-left: 80px;">
          <center><b style="color:#0d1065;"><u style="font-size: 16px;"><br />
                READ VERY CAREFULLY, DO NOT IGNORE ANY INFORMATION
              </u></b></center>
          <ol style="font-size:14px;text-align: justify;color:#0d1065;">
            <p><b style="font-size: 16px;">PLEASE SPEND SUFFICIENT TIME TO READ ALL THESE BELOW MENTIONED DETAILS, TO AVOID ANY KIND OF LOSS, CONFUSION OR MISUNDERSTANDINGS...</b></p>
            <li>The candidate must reach centre 15 minutes before exam timing.</li>
            <li> Candidates are advised to carry their Admit Card along with them .</li>
            <li> Candidates must carry "Any one of the original and valid Photo Identification Proof issued by the Government..</li>
            <li>No candidates should adopt any unfair means or indulge in any unfair examination practices as the examination centers are under surveillance of CCTV .</li>
            <li>Candidates are advised to check the website regularly.They should also check their mailbox on the registered E_mail address and SMS in their registered Mobile no.for latest updates and information.</li>
            <li>Use of Calculators, Mobile phone etc, is Not permitted ,Plain sheet would be provided for rough work . Candidates should bring their own transparent pen/pencil. On completion of the exam , candidates would have to return the used sheet to the invigilator.</li>
            <p>
              “If you read all the instructions very careful, then you will not face any issue during your exam. Good Luck.”
            </p>
          </ol>
        </td>
      </tr>
    </tbody>
  </table>

  <script type="text/javascript">
    function getfieldvalues() {
      if (document.getElementById('sameaddress').checked) {
        //alert("checked");
        document.preadmission.pre_address.value = document.preadmission.pre_address1.value;
        document.preadmission.pre_city.value = document.preadmission.pre_city1.value;
        document.preadmission.pre_pincode.value = document.preadmission.pre_pincode1.value;
        document.preadmission.pre_phno.value = document.preadmission.pre_phno1.value;
        document.preadmission.pre_state.value = document.preadmission.pre_state1.value;


        document.preadmission.pre_mobile.value = document.preadmission.pre_mobile1.value;
        document.preadmission.pre_country.value = document.preadmission.pre_country1.value;
      } else {
        document.preadmission.pre_address.value = "";
        document.preadmission.pre_city.value = "";
        document.preadmission.pre_pincode.value = "";
        document.preadmission.pre_phno.value = "";
        document.preadmission.pre_state.value = "";


        document.preadmission.pre_mobile.value = "";
        document.preadmission.pre_country.value = "";
      }
    }

    function open_sub(val) {
      popup_letter('?pid=94&action=display_sub&scat_id=' + val);
    }
  </script>
  <script type="text/javascript">
    function popup_letter(url) {
      var width = 500;
      var height = 300;
      var left = (screen.width - width) / 2;
      var top = (screen.height - height) / 2;
      var params = 'width=' + width + ', height=' + height;
      params += ', top=' + top + ', left=' + left;
      params += ', directories=no';
      params += ', location=no';
      params += ', menubar=no';
      params += ', resizable=no';
      params += ', scrollbars=yes';
      params += ', status=no';
      params += ', toolbar=no';
      newwin = window.open(url, 'windowname5', params);
      if (window.focus) {
        newwin.focus()
      }
      return false;
    }
  </script>

  <iframe width=199 height=178 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="includes/js/WeekPicker/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
  </iframe>



  </td>
  </tr>

  </table>
  </td>
  </tr>
  <script type="text/javaScript">
    function printing(){
    document.getElementById("reg_no_value").style.display = "none";
    document.getElementById("roll_no_value").style.display = "none";
	  document.getElementById("printbutton").style.display = "none";
	  window.print();
	  window.close();
	 }
function reg_no(data){
  document.getElementById("reg_no_data").innerText=data;
  document.getElementById("reg_no_data1").innerText=data;

  
}
function roll_no(data){
  document.getElementById("roll_no_data1").innerText=data;

  
}
  </script>

  <style type="text/css" media="print">
    @page {
      size: auto;
      /* auto is the initial value */
      margin: 0mm;
      /* this affects the margin in the printer settings */
    }
  </style>
  </table>
</body>

</html>