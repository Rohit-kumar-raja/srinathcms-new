<?php
include '../../include/config.php';
require('../../export/PHPExcel/Excel.php');

$res = mysqli_query($con, "SELECT * FROM `participants_list` WHERE 1");
if (mysqli_num_rows($res) > 0) {
	$i = 1;
	$k = 0;
	while ($row = mysqli_fetch_assoc($res)) {
		$college_name = $row['college_name'];
		$teacher = "SELECT * FROM `event_teachers` WHERE `college_name`='$college_name'";
		$result_teacher=mysqli_query($con,$teacher);
		$t_row=mysqli_fetch_array($result_teacher);

		$data[$k]['S.no'] = $i;
		$data[$k]['college_name'] = $college_name;

		$data[$k]['type '] = $row['type'];
		$data[$k]['board_name'] = $row['board_name'];
		$data[$k]['affiliated_name'] = $row['affiliated_name'];
		$data[$k]['mobile'] = $row['mobile'];
		$data[$k]['email'] = $row['email'];
		$data[$k]['country'] = $row['country'];
		$data[$k]['state'] = $row['state'];
		$data[$k]['district'] = $row['district'];
		$data[$k]['city'] = $row['city'];
		$data[$k]['pincode'] = $row['pincode'];
		$data[$k]['address1'] = $row['address1'];
		$data[$k]['address2'] = $row['address2'];


		$data[$k]['Student Name'] = $row['s_name'];
		$data[$k]['Student Father Name'] = $row['s_f_name'];
		$data[$k]['Student dob'] = $row['s_dob'];
		$data[$k]['Student Gender'] = $row['s_gender'];
		$data[$k]['Student mobile'] = $row['s_mobile'];
		$data[$k]['Student email'] = $row['s_email'];
		$data[$k]['Student whatsapp'] = $row['s_whatsapp'];
		$data[$k]['Student address'] = $row['s_address'];
		$data[$k]['Student event_name'] = $row['event_name'];


		$data[$k]['Teacher Name'] = $t_row['name'];
		$data[$k]['Teacher Email'] = $t_row['email'];
		$data[$k]['Teacher Phone'] = $t_row['phone'];
		$data[$k]['Teacher Designation'] = $t_row['post'];
		$k++;
		$i++;
	}
} else {
	echo "Data not found";
}

$excel = new excel();
$file_name = 'report-' . date('d-m-Y') . '.xlsx';
$excel->userDefinedstream($file_name, $data);
echo "
<script>
	window.location.replace('../../participants.php')
</script>";
