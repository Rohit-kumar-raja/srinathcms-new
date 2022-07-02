<?php
// send the main in the email variable
function generate_otp($email)

{
    $otp  = rand(100000, 999999);
    $_SESSION['otp']=$otp;
    return $otp;
}
function send_otp()
{
    $phone = $_SESSION['phone'];
    $reciever_email = $_SESSION['email'];
    $reciever_name = $_SESSION['name'];
    $otp = $_SESSION['otp'];
    $smtp_host = "smtp.gmail.com";
    $port = 465;
    $sender_email_id = "admissions.srinathuniversity@gmail.com";  //here put the sender email id he show in the clint email
    $sender_password = "Rafiganj"; //here put the password of email id to send the email otp

    // sending otp in mobile phone
    $message = "Your OTP is " . $otp . ". Please do not share this OTP to anyone. Regards, Srinath University, JSR";
    sendsmsGET($phone, $message);
    // here is the actual logic to send the otp on the email id show keep changes quirefully
    include 'phpmailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;
  
    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $smtp_host;  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $sender_email_id;                 // SMTP username
    $mail->Password = $sender_password;                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = $port;                                    // TCP port to connect to

    $mail->setFrom($sender_email_id, 'Srinath University');
    $mail->addAddress($reciever_email, $reciever_name);     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo($reciever_email, 'Information');  // if You want to giving the reply then you can enable 
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Otp Varification code';
    $mail->Body    = '<p> Thank you for showing interest in Srinath University <br><br> </p> <big>  Your One Time Varification Code is  <b>' . $otp . '</b> </big>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        return  'OTP Sent To ' . $reciever_email .' and '.$phone;
    }
}



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
