<?php
include '../include/config.php';
require('PHPExcel/Excel.php');

$res=mysqli_query($con,"SELECT * FROM `tbl_prospectus` WHERE 1");
if(mysqli_num_rows($res)>0){
	$k=0;
	while($row=mysqli_fetch_assoc($res)){
		$data[$k]['no']=$row['prospectus_no'];
		$data[$k]['applicant_name']=$row['prospectus_applicant_name'];
		$data[$k]['gender']=$row['prospectus_gender'];
		$data[$k]['father_name']=$row['prospectus_father_name'];
		$data[$k]['mother_name']=$row['prospectus_mother_name'];
		$data[$k]['address']=$row['prospectus_address'];
		$data[$k]['country']=$row['prospectus_country'];
		$data[$k]['state']=$row['prospectus_state'];
		$data[$k]['city']=$row['prospectus_city'];
		$data[$k]['postal_code']=$row['prospectus_postal_code'];
		$data[$k]['dob']=$row['prospectus_dob'];
		$data[$k]['emailid']=$row['prospectus_emailid'];
		$data[$k]['mobile']=$row['mobile'];
		$data[$k]['revert_by']=$row['revert_by'];
		$data[$k]['course_name']=$row['prospectus_course_name'];
		$data[$k]['session']=$row['prospectus_session'];
		$data[$k]['payment_status']=$row['payment_status'];
		$data[$k]['rate']=$row['prospectus_rate'];
		$data[$k]['payment_mode']=$row['prospectus_payment_mode'];
		$data[$k]['deposit_to']=$row['prospectus_deposit_to'];
		$data[$k]['bank_name']=$row['bank_name'];
		$data[$k]['transaction_no']=$row['transaction_no'];
		$data[$k]['transaction_date']=$row['transaction_date'];
		$data[$k]['post_at']=$row['post_at'];
		$data[$k]['type']=$row['type'];
		$data[$k]['easebuzz_id']=$row['easebuzz_id'];
		$data[$k]['transaction_id']=$row['transaction_id'];
		$data[$k]['status']=$row['status'];
		$k++;
	}
}else{
	echo "Data not found";
}

$excel=new excel();
$file_name='prospectus-'.date('d-m-Y').'.xlsx';
$excel->userDefinedstream($file_name,$data);
?>