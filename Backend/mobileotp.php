<?php

session_start();
$phone = "7250634942";
$otp = rand(1000, 9999);
$_SESSION['otp'] = $otp;
echo $otp;
//put the message;			
$message = "Your OTP is " . $otp . ". Please do not share this OTP to anyone. Regards, Srinath University, JSR";
//put the comma separated mobile number;			


sendsmsGET($phone, $message);
function sendsmsGET($mobileNumber, $message)
{

    $senderId = "SRIUNI";
    $serverUrl = "msg.msgclub.net";
    //put the auth key;			
    $authKey = "fbfdee58a904a1d82641561a74c354";
    $routeId = "1";
    $route = "default";
    $getData = 'mobileNos=' . $mobileNumber . '&message=' . urlencode($message) . '&senderId=' . $senderId . '&routeId=' . $routeId;
    //API URL			
    $url = "http://" . $serverUrl . "/rest/services/sendSMS/sendGroupSms?AUTH_KEY=" . $authKey . "&" . $getData;
    // init the resource			
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0
    ));
    //get response			
    $output = curl_exec($ch);
    //Print error if any		
    if (curl_errno($ch)) {
        echo 'error:' . curl_error($ch);
    }
    curl_close($ch);
    return $output;
}
