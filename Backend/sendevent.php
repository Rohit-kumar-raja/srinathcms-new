<?php

function event_mail($add_prospectus_email, $prosprectus_number,$college_name)

{
    $reciever_email = $add_prospectus_email;
    // $reciever_name = $name;
    // $amount = $prospectus_rate;
    // $prosprectus_number = $prosprectus_number;
    // $course = $prospectus_course_name;
    // $session = $prospectus_session;
    $smtp_host = "smtp.gmail.com";
    $port = 465;
    $sender_email_id = "admissions.srinathuniversity@gmail.com";  //here put the sender email id he show in the clint email
    $sender_password = "Rafiganj"; //here put the password of email id to send the email otp

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
    $mail->CharSet = 'UTF-8';
    // $mail->Encoding = 'base64';
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = '५ वाँ अंतर्राष्ट्रीय श्रीनाथ हिन्दी महोत्सव, जमशेदपुर २०२१';
    $mail->Body    = '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;vertical-align:top;background-color:#fff;border-spacing:0;min-width:320px;table-layout:fixed;width:100%" valign="top" width="100%">
    <tbody>
        <tr style="border-collapse:collapse;vertical-align:top" valign="top">
            <td style="border-collapse:collapse;vertical-align:top;word-break:break-word" valign="top">
                <div style="background-color:#ffffff">
                    <div class="m_7666453172668600852block-grid" style="min-width:320px;max-width:720px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:#ffffff">
                        <div style="border-collapse:collapse;display:table;width:100%;background-color:#ffffff">
                            <div class="m_7666453172668600852col" style="min-width:320px;max-width:720px;display:table-cell;vertical-align:top;width:720px">
                                <div class="m_7666453172668600852col_cont" style="width:100%!important">
                                    <div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:20px;padding-right:0px;padding-left:0px">
                                        <div align="center" class="m_7666453172668600852img-container m_7666453172668600852big" style="padding-right:0px;padding-left:0px">
                                            <img align="center" alt="Image" border="0" src="http://65.2.20.135/srinath/images/logo1.png" style="text-decoration:none;height:auto;border:0;width:200px;max-width:50%;display:block" title="Image" width="200" class="CToWUd a6T" tabindex="0">
                                            <div class="a6S" dir="ltr" style="opacity: 0.01; left: 516px; top: 123px;">
                                                <div id=":1qe" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" role="button" tabindex="0" aria-label="Download attachment " data-tooltip-class="a1V" data-tooltip="Download">
                                                    <div class="akn">
                                                        <div class="aSK J-J5-Ji aYr"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="color:#1c2951;font-family:Montserrat,Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Tahoma,sans-serif;line-height:2;padding-top:25px;padding-right:25px;padding-bottom:25px;padding-left:25px">
                                            <div style="font-family:Montserrat,Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Tahoma,sans-serif;font-size:12px;line-height:2;color:#1c2951">
                                                <p style="margin:0;font-size:14px;text-align:justify;line-height:2;word-break:break-word;margin-top:0;margin-bottom:0"><span style="font-size:14px">प्रिय <b> '.$college_name.' </b>,</span></p>
                                                <br>
                                                <p style="margin:0;font-size:14px;text-align:justify;line-height:2;word-break:break-word;margin-top:0;margin-bottom:0"><span style="font-size:14px">५वाँ अंतरराष्ट्रीय श्रीनाथ हिंदी महोत्सव, जमशेदपुर २०२१” में आपका नामांकन दर्ज करने के लिए </span></p>
                                        
                                                <!-- <p style="margin:0;line-height:2;word-break:break-word;font-size:14px;text-align:justify;margin-top:0;margin-bottom:0">&nbsp;</p> -->
                                                <p style="margin:0;font-size:14px;text-align:justify;line-height:2;word-break:break-word;margin-top:0;margin-bottom:0"><span style="font-size:14px">धन्यवाद !! आपके द्वारा उपलब्ध कराई गई प्रतिभागियों एवं शिक्षक प्रतिनिधियों के सूची संलग्न है।<span></p>
                                                <!-- <p style="margin:0;line-height:2;word-break:break-word;font-size:14px;text-align:justify;margin-top:0;margin-bottom:0">&nbsp;</p> -->
                                                <p style="margin:0;font-size:14px;text-align:justify;line-height:2;word-break:break-word;margin-top:0;margin-bottom:0"><span style="font-size:14px">किसी भी शंका निवारण हेतु दिए गए दूरभाष संख्या ७९०९०३३३१८ / ७००४२११४२६ /  </span></p>
                                                <!-- <p style="margin:0;line-height:2;word-break:break-word;font-size:14px;text-align:justify;margin-top:0;margin-bottom:0">&nbsp;</p> -->

                                                <p style="margin:0;font-size:14px;text-align:justify;line-height:2;word-break:break-word;margin-top:0;margin-bottom:0"><span style="font-size:14px">८४३४०१३२४६ / ८८२५२१७८३९ पर सम्पर्क कर सकते हैं। </span></p>
                                                <br>
                                                <br>
                                                <p style="margin:0;font-size:14px;text-align:justify;line-height:2;word-break:break-word;margin-top:0;margin-bottom:0"><span style="font-size:14px"> <b> प्रतिभागी सूची को प्रिंट करने के लिए प्रिंट बटन पर क्लिक करें </b> </span></p>

                                                <p style="margin:0;line-height:2;word-break:break-word;font-size:14px;text-align:justify;margin-top:0;margin-bottom:0">&nbsp;</p>
                                                <p style="margin:0;font-size:14px;text-align:justify;line-height:2;word-break:break-word;margin-top:0;margin-bottom:0"><span style="font-size:14px">Best regards,</span></p>
                                                <p style="margin:0;font-size:14px;text-align:justify;line-height:2;word-break:break-word;margin-top:0;margin-bottom:0"><strong><span style="font-size:14px">SRINATH UNIVERSITY</span></strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="background-color:transparent">
                    <div class="m_7666453172668600852block-grid" style="min-width:320px;max-width:720px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:#ffffff">
                        <div style="border-collapse:collapse;display:table;width:100%;background-color:#ffffff">
                            <div class="m_7666453172668600852col" style="min-width:320px;max-width:720px;display:table-cell;vertical-align:top;width:720px">
                                <div class="m_7666453172668600852col_cont" style="width:100%!important">
                                    <div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:5px;padding-bottom:5px;padding-right:0px;padding-left:0px">
                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;vertical-align:top;border-spacing:0;min-width:100%;table-layout:fixed" valign="top" width="100%">
                                            <tbody>
                                                <tr style="border-collapse:collapse;vertical-align:top" valign="top">
                                                    <td style="border-collapse:collapse;vertical-align:top;min-width:100%;padding-bottom:0;padding-left:0;padding-right:0;padding-top:0;word-break:break-word" valign="top">
                                                        <table align="center" border="0" cellpadding="0" cellspacing="0" height="0" role="presentation" style="border-collapse:collapse;vertical-align:top;border-spacing:0;border-top:5px solid #f94a29;height:0;table-layout:fixed;width:100%" valign="top" width="100%">
                                                            <tbody>
                                                                <tr style="border-collapse:collapse;vertical-align:top" valign="top">
                                                                    <td height="0" style="border-collapse:collapse;vertical-align:top;word-break:break-word" valign="top"><span></span></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div align="center" style="padding-top:30px;padding-right:10px;padding-bottom:10px;padding-left:10px">
                                            <a href="http://65.2.20.135/printevent.php?ins='.$college_name.'" style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#f94a29;border-radius:5px;width:auto;width:auto;border-top:1px solid #f94a29;border-right:1px solid #f94a29;border-bottom:1px solid #f94a29;border-left:1px solid #f94a29;padding-top:10px;padding-bottom:10px;font-family:Montserrat,Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Tahoma,sans-serif;text-align:center;word-break:keep-all" target="_blank"><span style="padding-left:60px;padding-right:60px;font-size:16px;display:inline-block;letter-spacing:undefined"><span style="font-size:16px;line-height:2;word-break:break-word"><strong>Print Now</strong></span></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="background-color:transparent">
                    <div class="m_7666453172668600852block-grid" style="min-width:320px;max-width:720px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:#ffffff">
                        <div style="border-collapse:collapse;display:table;width:100%;background-color:#ffffff">
                            <div class="m_7666453172668600852col" style="min-width:320px;max-width:720px;display:table-cell;vertical-align:top;width:720px">
                                <div class="m_7666453172668600852col_cont" style="width:100%!important">
                                    <div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px">
                                        <div style="color:#555555;font-family:Montserrat,Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Tahoma,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:0px;padding-left:10px">
                                            <div style="font-family:Montserrat,Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Tahoma,sans-serif;font-size:12px;line-height:1.2;color:#555555">
                                                <p style="margin:0;font-size:14px;line-height:1.2;text-align:center;word-break:break-word;margin-top:0;margin-bottom:0"><span style="color:#1c2951;font-size:14px"><strong><span style="font-size:10px"><span style="font-size:10px">IMPORTANT</span></span></strong></span></p>
                                            </div>
                                        </div>
                                        <div style="color:#777777;font-family:Montserrat,Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Tahoma,sans-serif;line-height:1.2;padding-top:5px;padding-right:10px;padding-bottom:15px;padding-left:10px">
                                            <div style="font-family:Montserrat,Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Tahoma,sans-serif;font-size:12px;line-height:1.2;color:#777777">
                                                <p style="margin:0;font-size:10px;line-height:1.2;text-align:center;word-break:break-word;margin-top:0;margin-bottom:0"><span style="font-size:10px;color:#1c2951">Please do not reply to this email.&nbsp;</span><span style="font-size:10px;color:#1c2951">For any queries</span></p>
                                                <p style="margin:0;font-size:10px;line-height:1.2;text-align:center;word-break:break-word;margin-top:0;margin-bottom:0"><span style="font-size:10px;color:#1c2951"><span style="text-decoration:underline;font-size:10px"><span style="color:#f94a29;text-decoration:underline;font-size:10px"><a href="mailto:info@srinathuniversity.in" rel="noopener" style="text-decoration:underline;color:#f94a29" target="_blank">Email Us</a></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="background-color:transparent">
                    <div class="m_7666453172668600852block-grid" style="min-width:320px;max-width:720px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:#ffffff">
                        <div style="border-collapse:collapse;display:table;width:100%;background-color:#ffffff">
                            <div class="m_7666453172668600852col" style="min-width:320px;max-width:720px;display:table-cell;vertical-align:top;width:720px">
                                <div class="m_7666453172668600852col_cont" style="width:100%!important">
                                    <div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:5px;padding-bottom:5px;padding-right:0px;padding-left:0px">
                                        <table cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;vertical-align:top;border-spacing:0;table-layout:fixed" valign="top" width="100%">
                                            <tbody>
                                                <tr style="border-collapse:collapse;vertical-align:top" valign="top">
                                                    <td style="border-collapse:collapse;vertical-align:top;padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;word-break:break-word" valign="top">
                                                        <table align="center" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;vertical-align:top;border-spacing:0;table-layout:fixed" valign="top">
                                                            <tbody>
                                                                <tr align="center" style="border-collapse:collapse;vertical-align:top;display:inline-block;text-align:center" valign="top">
                                                                    <td style="border-collapse:collapse;vertical-align:top;padding-bottom:5px;padding-left:0;padding-right:20px;word-break:break-word" valign="top"><a href="https://link.engage.srinathuniversity.com/ss/c/scbD5ZNE2AS0oXAwvo7TcPPHRrEKcg4cy2v1okzDDmMy4-5CLAq51G9ds2Ew0B9mU7l74_cS5k2jruearOe1T2x9DAoOoG3BB8GYqht_0vAqTgylzQnOmxwxh-f3rPXbRE2cLKg8HSvtj6Q1Tg6oRUeEQtKRoCFTAHnYq_PF_GC0Ye_ce-a5xXILFRD-okz3ITmWsc8_vTHsrdgQi2c4RarYaB6rCLO8modbP7vmQRfTJVPq4hTa_n_ND835qxRofNDfQJK_T3_f26xBdjyoemc6SQ00t7g7yGXlOwgO7xikmz0AOu85vWpDuZ2AP3pmbMZvF3pN1C5VnAuALPO0NjnXcOpgyjzrq54vtjs1DQo4FchmGa8G93_Vah-HlX0A3KI9xs6ZU1ru0WzPwtyzSqyf8kL8kBlu5bTeUR1baIrXMFiGapf0hrI9IsmnxEquuamiu_Q-xZrhIDC2wcZAg_Grpt5akgdpXufWTTbMzhmsoltxoMJboEqsoU3ZtWxJ98whaVnuLszOOViJq_IrBJ2Y-_TMtaQbbMZO3rnscT_ktKvVrw67mrLNXUwJZ4J4I2DcA7FHRc13CseludsabvnVY6fPiGqH1klkWaRNTwfIcVXmqpVrmINnsPGXVsGN-rcr0xo0nN7h_CvMMk6saK3VN_ZJl3VbvxGTSeJ_jWfv75Bm_GktG9UfjiceCmIhJPbyzEy10LQj31F9YaN0RqWVlPZDpxbicNG31o7VQ8f7DQ_aD6ycw-vlEJS3ZrYXfamYuSGtP_xcg5UlyOoMYKzsT-28SShsuOnN71LqDkrs_L9FVx23eWP5VMOW3I0JWV8KRIMI5zHShDJ1oZlADa-MUhGgFAk2ChGenvRbSD0lf7IgJzQEHqOU14hfaeRWPjsr8FSNjBFjj3Ztm9XtgXn_AZxsG0A-MvFThoOfJw8JfOdHqwHyVXwd8x7EI5eFQWnDiXK1HxNj2AKmfFWjHj0Zw5MWPLPiF4z34DocDwMDwUnx7s0b6JXd55mYRSFmSPkIWPgIYYeqE5EiMQxqhw/3er/WwXVOUT4SB-W3DETrCfz2Q/h3/4E6F7qHA1qO8dNIbvtQMqCL1UuDgwLd2_RWU2BFQMt0" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://link.engage.srinathuniversity.com/ss/c/scbD5ZNE2AS0oXAwvo7TcPPHRrEKcg4cy2v1okzDDmMy4-5CLAq51G9ds2Ew0B9mU7l74_cS5k2jruearOe1T2x9DAoOoG3BB8GYqht_0vAqTgylzQnOmxwxh-f3rPXbRE2cLKg8HSvtj6Q1Tg6oRUeEQtKRoCFTAHnYq_PF_GC0Ye_ce-a5xXILFRD-okz3ITmWsc8_vTHsrdgQi2c4RarYaB6rCLO8modbP7vmQRfTJVPq4hTa_n_ND835qxRofNDfQJK_T3_f26xBdjyoemc6SQ00t7g7yGXlOwgO7xikmz0AOu85vWpDuZ2AP3pmbMZvF3pN1C5VnAuALPO0NjnXcOpgyjzrq54vtjs1DQo4FchmGa8G93_Vah-HlX0A3KI9xs6ZU1ru0WzPwtyzSqyf8kL8kBlu5bTeUR1baIrXMFiGapf0hrI9IsmnxEquuamiu_Q-xZrhIDC2wcZAg_Grpt5akgdpXufWTTbMzhmsoltxoMJboEqsoU3ZtWxJ98whaVnuLszOOViJq_IrBJ2Y-_TMtaQbbMZO3rnscT_ktKvVrw67mrLNXUwJZ4J4I2DcA7FHRc13CseludsabvnVY6fPiGqH1klkWaRNTwfIcVXmqpVrmINnsPGXVsGN-rcr0xo0nN7h_CvMMk6saK3VN_ZJl3VbvxGTSeJ_jWfv75Bm_GktG9UfjiceCmIhJPbyzEy10LQj31F9YaN0RqWVlPZDpxbicNG31o7VQ8f7DQ_aD6ycw-vlEJS3ZrYXfamYuSGtP_xcg5UlyOoMYKzsT-28SShsuOnN71LqDkrs_L9FVx23eWP5VMOW3I0JWV8KRIMI5zHShDJ1oZlADa-MUhGgFAk2ChGenvRbSD0lf7IgJzQEHqOU14hfaeRWPjsr8FSNjBFjj3Ztm9XtgXn_AZxsG0A-MvFThoOfJw8JfOdHqwHyVXwd8x7EI5eFQWnDiXK1HxNj2AKmfFWjHj0Zw5MWPLPiF4z34DocDwMDwUnx7s0b6JXd55mYRSFmSPkIWPgIYYeqE5EiMQxqhw/3er/WwXVOUT4SB-W3DETrCfz2Q/h3/4E6F7qHA1qO8dNIbvtQMqCL1UuDgwLd2_RWU2BFQMt0&amp;source=gmail&amp;ust=1632053715871000&amp;usg=AFQjCNGpSV_1KobVf0CVQp9rPkCRspeB9w"><img alt="Twitter" height="32" src="https://ci4.googleusercontent.com/proxy/xPCdBiJE943Zfe0G96DiTiZZJh5gWpRpYfnlirC3zjMuhiz7qTlFv5MXg9U4CrlUSwmfBC2S412xtDeDLtHK5Vqb9HwgPSn0QIAp-9Lka42xlWtyltv63v-cfBzauPoV9sctCNxaVrUlWMVCyWonBiLE82ZiM7pnShc-F8z7VJj0BNVCAQ=s0-d-e1-ft#https://d2fi4ri5dhpqd1.cloudfront.net/public/resources/social-networks-icon-sets/t-circle-dark-gray/twitter@2x.png" style="text-decoration:none;height:auto;border:0;display:block" title="Twitter" width="32" class="CToWUd"></a></td>
                                                                    <td style="border-collapse:collapse;vertical-align:top;padding-bottom:5px;padding-left:0;padding-right:20px;word-break:break-word" valign="top"><a href="https://link.engage.srinathuniversity.com/ss/c/scbD5ZNE2AS0oXAwvo7TcPPHRrEKcg4cy2v1okzDDmMy4-5CLAq51G9ds2Ew0B9mU7l74_cS5k2jruearOe1T2x9DAoOoG3BB8GYqht_0vAqTgylzQnOmxwxh-f3rPXbRE2cLKg8HSvtj6Q1Tg6oRUeEQtKRoCFTAHnYq_PF_GC0Ye_ce-a5xXILFRD-okz3ITmWsc8_vTHsrdgQi2c4RarYaB6rCLO8modbP7vmQRfTJVPq4hTa_n_ND835qxRofNDfQJK_T3_f26xBdjyoemc6SQ00t7g7yGXlOwgO7xikmz0AOu85vWpDuZ2AP3pmbMZvF3pN1C5VnAuALPO0NvULy5XB_UEdL889i1pBVi7i3h-3TCWQR1KzpjU8g2FWYjkP3YbqCrFjx7VznoxNZlMnIb6KB3-bMDBv6qZTJqW7vtkEfeEHfycWRhUkItaWjvCdlTLass9t9pR4Trj3w0F9afw0KhrgxHImJV2dLJNG9wM0rzPIWAHVCsuV1ekqHlfkn6s7Dvsds8kJQGZcGUMLtaLEcPOCDAsM4wt9meRRD9lhd6MjZONciGuXVcfFlb9fJBzwn4YWsvX8A7Eor6V_TubKA7pvQtlXaTqutxfnsNLRWMQT9gcRDIKyRLze1dPNRgXUDCPaAjQT_OV1NwglqE4QmaKBkmki6sNiMU7Sys4kpqFlAmatEApnPhCMtFgO19jw5YU6rI7C72hDFpMXnShItchFdhlXjjdnAyk_Q7vB4aWGVt49mDjh09INExu3JNv2JXecKhUCHg53gtmM2jio6Lrw-ZO9fJEbOBtvjePzMz_V3MO4Y96AnpEtjZlK34Br4MuadlBgIvB8XmVySZG4kVRfzXkkyq3hz4xrTQ3qlhzxur-bVuBcntz48Sl-U_JkSzLpks3FCa2TBx8d2vAAsEK9geF--1ibuyLkRWrQ1yr8BM9L3b2sCJijWCc6WH3pDEh5nMiq_1-_5yb93Ap4NWl927yUGi47HS1HIEOXIZGpysQD2l5rrPsNZzYNhNdiAWjW0hXGf4RfI9OvnD_r3juniUZsmkoW0KUgQsN2LB_1iy0oEJ1AkjtJL6b-0jxDZc8otERoDJ_5a3cEY9Fd4AugOPbX79EY0NctVp-j4JnarbAS631-_kRg/3er/WwXVOUT4SB-W3DETrCfz2Q/h4/MWnKEMzn7A0YaPzgKRIg6-U1oUM3LKlrLnz60r7g9w0" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://link.engage.srinathuniversity.com/ss/c/scbD5ZNE2AS0oXAwvo7TcPPHRrEKcg4cy2v1okzDDmMy4-5CLAq51G9ds2Ew0B9mU7l74_cS5k2jruearOe1T2x9DAoOoG3BB8GYqht_0vAqTgylzQnOmxwxh-f3rPXbRE2cLKg8HSvtj6Q1Tg6oRUeEQtKRoCFTAHnYq_PF_GC0Ye_ce-a5xXILFRD-okz3ITmWsc8_vTHsrdgQi2c4RarYaB6rCLO8modbP7vmQRfTJVPq4hTa_n_ND835qxRofNDfQJK_T3_f26xBdjyoemc6SQ00t7g7yGXlOwgO7xikmz0AOu85vWpDuZ2AP3pmbMZvF3pN1C5VnAuALPO0NvULy5XB_UEdL889i1pBVi7i3h-3TCWQR1KzpjU8g2FWYjkP3YbqCrFjx7VznoxNZlMnIb6KB3-bMDBv6qZTJqW7vtkEfeEHfycWRhUkItaWjvCdlTLass9t9pR4Trj3w0F9afw0KhrgxHImJV2dLJNG9wM0rzPIWAHVCsuV1ekqHlfkn6s7Dvsds8kJQGZcGUMLtaLEcPOCDAsM4wt9meRRD9lhd6MjZONciGuXVcfFlb9fJBzwn4YWsvX8A7Eor6V_TubKA7pvQtlXaTqutxfnsNLRWMQT9gcRDIKyRLze1dPNRgXUDCPaAjQT_OV1NwglqE4QmaKBkmki6sNiMU7Sys4kpqFlAmatEApnPhCMtFgO19jw5YU6rI7C72hDFpMXnShItchFdhlXjjdnAyk_Q7vB4aWGVt49mDjh09INExu3JNv2JXecKhUCHg53gtmM2jio6Lrw-ZO9fJEbOBtvjePzMz_V3MO4Y96AnpEtjZlK34Br4MuadlBgIvB8XmVySZG4kVRfzXkkyq3hz4xrTQ3qlhzxur-bVuBcntz48Sl-U_JkSzLpks3FCa2TBx8d2vAAsEK9geF--1ibuyLkRWrQ1yr8BM9L3b2sCJijWCc6WH3pDEh5nMiq_1-_5yb93Ap4NWl927yUGi47HS1HIEOXIZGpysQD2l5rrPsNZzYNhNdiAWjW0hXGf4RfI9OvnD_r3juniUZsmkoW0KUgQsN2LB_1iy0oEJ1AkjtJL6b-0jxDZc8otERoDJ_5a3cEY9Fd4AugOPbX79EY0NctVp-j4JnarbAS631-_kRg/3er/WwXVOUT4SB-W3DETrCfz2Q/h4/MWnKEMzn7A0YaPzgKRIg6-U1oUM3LKlrLnz60r7g9w0&amp;source=gmail&amp;ust=1632053715871000&amp;usg=AFQjCNHw9sHzL-VJUS3aGOwNlZBGFB07vg"><img alt="YouTube" height="32" src="https://ci6.googleusercontent.com/proxy/Wb0-Cv-_YsddjfmxQepuVNR4g7d_wBSwo14uB-y81SBmdNtS4XZu_FGuovFq4dbdJA9W5y-JaE5bAa1NoSBoNAl5DnoA8X3uEx7YFvtBIjl861tF1tpTGVsNX97N3QoLwz3S78EmyM7JVlevJxUr_tIF-iFkRu8d9VZgc_aFppkLUpWX2A=s0-d-e1-ft#https://d2fi4ri5dhpqd1.cloudfront.net/public/resources/social-networks-icon-sets/t-circle-dark-gray/youtube@2x.png" style="text-decoration:none;height:auto;border:0;display:block" title="YouTube" width="32" class="CToWUd"></a></td>
                                                                    <td style="border-collapse:collapse;vertical-align:top;padding-bottom:5px;padding-left:0;padding-right:20px;word-break:break-word" valign="top"><a href="https://link.engage.srinathuniversitysrinathuniversity.com/ss/c/scbD5ZNE2AS0oXAwvo7TcPPHRrEKcg4cy2v1okzDDmMy4-5CLAq51G9ds2Ew0B9mU7l74_cS5k2jruearOe1T2x9DAoOoG3BB8GYqht_0vAqTgylzQnOmxwxh-f3rPXbRE2cLKg8HSvtj6Q1Tg6oRUeEQtKRoCFTAHnYq_PF_GC0Ye_ce-a5xXILFRD-okz3ITmWsc8_vTHsrdgQi2c4RarYaB6rCLO8modbP7vmQRfTJVPq4hTa_n_ND835qxRofNDfQJK_T3_f26xBdjyoemc6SQ00t7g7yGXlOwgO7xikmz0AOu85vWpDuZ2AP3pmbMZvF3pN1C5VnAuALPO0NilGeLMS_rnBb21K6K_bCkTNXEeeVKPBa_lCGsv9fo1xVM8kvvr7vhr9TwshPN9EA8DwiJrhnQKoVPCPkcwlx7Ub4rFFXN0caeMjq7siIXRRtV380rxpTn_GE4Ge1z1svdasijm8Zlzjb5lLPG1wq7xIbcdQ32642oC2uv4r1lO7kZJFCjDvpddN0dru8jYStpU-jB5M7vbWPzmg9rg3efdKsQ3XYlfCdsiI8l0ovGcoqPnRascd3U5H_zp_qMeka0672dQO4qyU2liv5e7FKvk1fYK-4aJEUdwiM5x6UdMRv4-E_K764yRSsmeFd5m6_swXFS7QgXzlUYGVtKGbnWOmE_se1MPMn0T-tHXuYZzKBTg8NZDM9F8EflAQ_6IUJGO6swvTek6sDncsLClQOqM-5GXSCQ5Sj0FWampfbrFdUBWiCo30_-XOpFUVemadPTEcB5fOeRw2WfETmBHmGqaaPzEy7cCQfb8AW_-o67T6dFkfTjdiXs7K7bFJx5-WKj93ZqBGoW19sL_mNfHXYJxCEYmaHV3ANws8kneHSMdUTuLxRaEm89Hqsv42HUyVQtakDNK9YXEp6fO3e0WvvsS_Laho2lOWjfreGyA1eaI1leDRdnn09D8brcBLjmhEZc3hpj--RCkR4rnjO17G_l-zdVdfsS37POUNfOTptNmC7eSixU6MLYlXBruzA4K9x0DLgbgOU0Mtkg1t2xN-k_4/3er/WwXVOUT4SB-W3DETrCfz2Q/h5/2zxnOSx8piR9N97jH-cwXjdUecHou_SaA_GKJw5QNHg" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://link.engage.srinathuniversity.com/ss/c/scbD5ZNE2AS0oXAwvo7TcPPHRrEKcg4cy2v1okzDDmMy4-5CLAq51G9ds2Ew0B9mU7l74_cS5k2jruearOe1T2x9DAoOoG3BB8GYqht_0vAqTgylzQnOmxwxh-f3rPXbRE2cLKg8HSvtj6Q1Tg6oRUeEQtKRoCFTAHnYq_PF_GC0Ye_ce-a5xXILFRD-okz3ITmWsc8_vTHsrdgQi2c4RarYaB6rCLO8modbP7vmQRfTJVPq4hTa_n_ND835qxRofNDfQJK_T3_f26xBdjyoemc6SQ00t7g7yGXlOwgO7xikmz0AOu85vWpDuZ2AP3pmbMZvF3pN1C5VnAuALPO0NilGeLMS_rnBb21K6K_bCkTNXEeeVKPBa_lCGsv9fo1xVM8kvvr7vhr9TwshPN9EA8DwiJrhnQKoVPCPkcwlx7Ub4rFFXN0caeMjq7siIXRRtV380rxpTn_GE4Ge1z1svdasijm8Zlzjb5lLPG1wq7xIbcdQ32642oC2uv4r1lO7kZJFCjDvpddN0dru8jYStpU-jB5M7vbWPzmg9rg3efdKsQ3XYlfCdsiI8l0ovGcoqPnRascd3U5H_zp_qMeka0672dQO4qyU2liv5e7FKvk1fYK-4aJEUdwiM5x6UdMRv4-E_K764yRSsmeFd5m6_swXFS7QgXzlUYGVtKGbnWOmE_se1MPMn0T-tHXuYZzKBTg8NZDM9F8EflAQ_6IUJGO6swvTek6sDncsLClQOqM-5GXSCQ5Sj0FWampfbrFdUBWiCo30_-XOpFUVemadPTEcB5fOeRw2WfETmBHmGqaaPzEy7cCQfb8AW_-o67T6dFkfTjdiXs7K7bFJx5-WKj93ZqBGoW19sL_mNfHXYJxCEYmaHV3ANws8kneHSMdUTuLxRaEm89Hqsv42HUyVQtakDNK9YXEp6fO3e0WvvsS_Laho2lOWjfreGyA1eaI1leDRdnn09D8brcBLjmhEZc3hpj--RCkR4rnjO17G_l-zdVdfsS37POUNfOTptNmC7eSixU6MLYlXBruzA4K9x0DLgbgOU0Mtkg1t2xN-k_4/3er/WwXVOUT4SB-W3DETrCfz2Q/h5/2zxnOSx8piR9N97jH-cwXjdUecHou_SaA_GKJw5QNHg&amp;source=gmail&amp;ust=1632053715872000&amp;usg=AFQjCNEG1UWBVds2QYRlva3CGkKRzAl0yA"><img alt="Telegram" height="32" src="https://ci5.googleusercontent.com/proxy/HUsE_TXy_59YP380kkWjClmzrNTJA0RLDSshgfnZN_dMkWOB1Z01M3EF8yROyJpFag7HyzY4hKn1JRJwzKnAELOwJbo2SU-MZqamzYlU3YL0e2-UDKuq2rPdOVstGi6E-SwgyArCkSAvjerJyp7J3tpXzVmWSNL1hRgofyTcjWms93r7-Tc=s0-d-e1-ft#https://d2fi4ri5dhpqd1.cloudfront.net/public/resources/social-networks-icon-sets/t-circle-dark-gray/telegram@2x.png" style="text-decoration:none;height:auto;border:0;display:block" title="Telegram" width="32" class="CToWUd"></a></td>
                                                                    <td style="border-collapse:collapse;vertical-align:top;padding-bottom:5px;padding-left:0;padding-right:20px;word-break:break-word" valign="top"><a href="https://link.engage.srinathuniversity.com/ss/c/scbD5ZNE2AS0oXAwvo7TcPPHRrEKcg4cy2v1okzDDmMy4-5CLAq51G9ds2Ew0B9mU7l74_cS5k2jruearOe1T2x9DAoOoG3BB8GYqht_0vAqTgylzQnOmxwxh-f3rPXbRE2cLKg8HSvtj6Q1Tg6oRUeEQtKRoCFTAHnYq_PF_GC0Ye_ce-a5xXILFRD-okz3ITmWsc8_vTHsrdgQi2c4RarYaB6rCLO8modbP7vmQRfTJVPq4hTa_n_ND835qxRofNDfQJK_T3_f26xBdjyoemc6SQ00t7g7yGXlOwgO7xikmz0AOu85vWpDuZ2AP3pmbMZvF3pN1C5VnAuALPO0Nl4kXYqm1X2xKAmqhFgVgi7JuwwCTHlL6owD_AuClMVJieRlhFg87VyhWWAS64Q6_XGJPgVr0FP-pFxFPAN9FtUsv7IO4DBNKVudNsHIkcWghSwN7Eduz2K6F6dp9qKJAlGj3ySEQD4TxSscC2GGHWfksXZd7nY-NvGJSeveUuqpGZJWlCXQ0jz0baj8uVnxtDgigupMRihCetZJMzZJYXJNyrwVHv6t5ARS2Ip2WfVV629UrXhCbUSaZ52paQeLmsAbCBp8x1xa8ToZX7kDiSeV0mA6RCIO77bCtDilzoKbCSusR-MILwnw12J_pV2upDEnPHBzym04zW5xaopi95bF-1mnQmM0kK20aerxJJENT1_XWEyTunBarC-nAjnuLC0dGYEIqqUbszsH0Ar_SHXg32Eqpt45hfbsGlIaVMOq0sI9HQ5TJ37mP_ZZUek0rFZEt5IVQ8CYLaI25AbaXKD6zSYxae_6vTy1VGGcAdjjRfYGHxyDYO42nq7QdQtZ929C8E9_nNUWj589tREqhAB2CaSnD7iGXlkrtHu6peXSS6uj5w0Ak4OTN_w7Is_puXzvTNAWdfK88uV_Hwgx2EMAqxMvvvbVeupzG5ZVHNkSIpOgJFsh06otALYL4GBRbxAMNEDj06HqN5zvC9Jo2LFyuaSlSDTamW1RgwOtNr9293tjw58NyPiVCCbLz8NdYhC24bO64u2l72KIdOevNpMPQtNU0W4F4wRlmW34obIb/3er/WwXVOUT4SB-W3DETrCfz2Q/h6/MyN5lDFExHRpeL18SujYnlTGlopnSCTwr_AL2jpU64A" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://link.engage.srinathuniversity.com/ss/c/scbD5ZNE2AS0oXAwvo7TcPPHRrEKcg4cy2v1okzDDmMy4-5CLAq51G9ds2Ew0B9mU7l74_cS5k2jruearOe1T2x9DAoOoG3BB8GYqht_0vAqTgylzQnOmxwxh-f3rPXbRE2cLKg8HSvtj6Q1Tg6oRUeEQtKRoCFTAHnYq_PF_GC0Ye_ce-a5xXILFRD-okz3ITmWsc8_vTHsrdgQi2c4RarYaB6rCLO8modbP7vmQRfTJVPq4hTa_n_ND835qxRofNDfQJK_T3_f26xBdjyoemc6SQ00t7g7yGXlOwgO7xikmz0AOu85vWpDuZ2AP3pmbMZvF3pN1C5VnAuALPO0Nl4kXYqm1X2xKAmqhFgVgi7JuwwCTHlL6owD_AuClMVJieRlhFg87VyhWWAS64Q6_XGJPgVr0FP-pFxFPAN9FtUsv7IO4DBNKVudNsHIkcWghSwN7Eduz2K6F6dp9qKJAlGj3ySEQD4TxSscC2GGHWfksXZd7nY-NvGJSeveUuqpGZJWlCXQ0jz0baj8uVnxtDgigupMRihCetZJMzZJYXJNyrwVHv6t5ARS2Ip2WfVV629UrXhCbUSaZ52paQeLmsAbCBp8x1xa8ToZX7kDiSeV0mA6RCIO77bCtDilzoKbCSusR-MILwnw12J_pV2upDEnPHBzym04zW5xaopi95bF-1mnQmM0kK20aerxJJENT1_XWEyTunBarC-nAjnuLC0dGYEIqqUbszsH0Ar_SHXg32Eqpt45hfbsGlIaVMOq0sI9HQ5TJ37mP_ZZUek0rFZEt5IVQ8CYLaI25AbaXKD6zSYxae_6vTy1VGGcAdjjRfYGHxyDYO42nq7QdQtZ929C8E9_nNUWj589tREqhAB2CaSnD7iGXlkrtHu6peXSS6uj5w0Ak4OTN_w7Is_puXzvTNAWdfK88uV_Hwgx2EMAqxMvvvbVeupzG5ZVHNkSIpOgJFsh06otALYL4GBRbxAMNEDj06HqN5zvC9Jo2LFyuaSlSDTamW1RgwOtNr9293tjw58NyPiVCCbLz8NdYhC24bO64u2l72KIdOevNpMPQtNU0W4F4wRlmW34obIb/3er/WwXVOUT4SB-W3DETrCfz2Q/h6/MyN5lDFExHRpeL18SujYnlTGlopnSCTwr_AL2jpU64A&amp;source=gmail&amp;ust=1632053715872000&amp;usg=AFQjCNFy3LXmsKK4bHRXAUMt-HdxGkUG1w"><img alt="Facebook" height="32" src="https://ci6.googleusercontent.com/proxy/fq-eHuLycj3giw-FlRTjOQbSPFNeBlQ4Ucq-SGNYxUMPeWwH2IXeM0XXNU4Ik6FAWegfw7eNbsLegVb4LH_cD-DAe5iyy78qOSzryovNb8guzRDvsgjnV3DwChRBwKYoXUId3PZhV5qhUh3gn4kQvtHJLGYkMIj3LsEL8Y-Mbqk0B_oW_Zo=s0-d-e1-ft#https://d2fi4ri5dhpqd1.cloudfront.net/public/resources/social-networks-icon-sets/t-circle-dark-gray/facebook@2x.png" style="text-decoration:none;height:auto;border:0;display:block" title="Facebook" width="32" class="CToWUd"></a></td>
                                                                    <td style="border-collapse:collapse;vertical-align:top;padding-bottom:5px;padding-left:0;padding-right:20px;word-break:break-word" valign="top"><a href="https://link.engage.srinathuniversity.com/ss/c/scbD5ZNE2AS0oXAwvo7TcPPHRrEKcg4cy2v1okzDDmMy4-5CLAq51G9ds2Ew0B9mU7l74_cS5k2jruearOe1T2x9DAoOoG3BB8GYqht_0vAqTgylzQnOmxwxh-f3rPXbRE2cLKg8HSvtj6Q1Tg6oRUeEQtKRoCFTAHnYq_PF_GC0Ye_ce-a5xXILFRD-okz3ITmWsc8_vTHsrdgQi2c4RarYaB6rCLO8modbP7vmQRfTJVPq4hTa_n_ND835qxRofNDfQJK_T3_f26xBdjyoemc6SQ00t7g7yGXlOwgO7xikmz0AOu85vWpDuZ2AP3pmbMZvF3pN1C5VnAuALPO0NtSDW1gourHwNTg9cXccUjQ4VzzM1ZoQyyPqNxxKlxopjAZSEGebmuGbInbn1M-2p3QDqIwPfAdW2imuprI74yepArNxsQWP80tK3XeCpqFkyE2b8AGnnn-ruZmD_eX2FNM4FZ4WCu-Z8nU3Tbl1Z4ITgGKoRPgdVN8CXGeAiJGOY0b1C0bAjBAre0TGykD7CYvGLK3to4TR3b9Pz3keIlDWqiflANoo7o9DlXHQxDeI20VHDGwEdraCHcJs5XA2ZmtyxnqVRJlmMQ8HCMKc_YpEy_8uLCxp0lKcUy4PSWxjo2hBaBJu9rTCCkrFCGDNj6ye0dbWw_4B3VfaZlIk9-FUz-m9dICfF8XaH2ryse5inYGDiPL3W1jOMBmqmlDf4wNL6-CSrT-7NBLWD1IMLhiffIo9csBsy5InhS24z3GW_-jbiPQl_9fNenJwLan__oqOXOP0eXdA0nATf-1dkup1LeyHZI15XI30b8wvaPwrZNffZmk8X7j1-E-8dHHcADAymTbofQ3yHl1exI1Dm5-78l5QJX0iRtM71bmum--CB8jSHp5EINvegHUvEtd8mgbWTUPHJX-cQvhvVdZhAhUmWKUXMcGYGRcQfSTHWX0aWTFyke0ai1INbPGwgNOVEvMvB8UnHZJPo46lgcOEwSMS3yBRV3LkaR0-027RtRLC0jhXdj3k2RpKxMJLvuLFc_IiahIWSvsWRGD_nlJxTXU/3er/WwXVOUT4SB-W3DETrCfz2Q/h7/en_79KQYcU4zMQv453PV414fHP73nJ2DQpAGQTOE1tc" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://link.engage.srinathuniversity.com/ss/c/scbD5ZNE2AS0oXAwvo7TcPPHRrEKcg4cy2v1okzDDmMy4-5CLAq51G9ds2Ew0B9mU7l74_cS5k2jruearOe1T2x9DAoOoG3BB8GYqht_0vAqTgylzQnOmxwxh-f3rPXbRE2cLKg8HSvtj6Q1Tg6oRUeEQtKRoCFTAHnYq_PF_GC0Ye_ce-a5xXILFRD-okz3ITmWsc8_vTHsrdgQi2c4RarYaB6rCLO8modbP7vmQRfTJVPq4hTa_n_ND835qxRofNDfQJK_T3_f26xBdjyoemc6SQ00t7g7yGXlOwgO7xikmz0AOu85vWpDuZ2AP3pmbMZvF3pN1C5VnAuALPO0NtSDW1gourHwNTg9cXccUjQ4VzzM1ZoQyyPqNxxKlxopjAZSEGebmuGbInbn1M-2p3QDqIwPfAdW2imuprI74yepArNxsQWP80tK3XeCpqFkyE2b8AGnnn-ruZmD_eX2FNM4FZ4WCu-Z8nU3Tbl1Z4ITgGKoRPgdVN8CXGeAiJGOY0b1C0bAjBAre0TGykD7CYvGLK3to4TR3b9Pz3keIlDWqiflANoo7o9DlXHQxDeI20VHDGwEdraCHcJs5XA2ZmtyxnqVRJlmMQ8HCMKc_YpEy_8uLCxp0lKcUy4PSWxjo2hBaBJu9rTCCkrFCGDNj6ye0dbWw_4B3VfaZlIk9-FUz-m9dICfF8XaH2ryse5inYGDiPL3W1jOMBmqmlDf4wNL6-CSrT-7NBLWD1IMLhiffIo9csBsy5InhS24z3GW_-jbiPQl_9fNenJwLan__oqOXOP0eXdA0nATf-1dkup1LeyHZI15XI30b8wvaPwrZNffZmk8X7j1-E-8dHHcADAymTbofQ3yHl1exI1Dm5-78l5QJX0iRtM71bmum--CB8jSHp5EINvegHUvEtd8mgbWTUPHJX-cQvhvVdZhAhUmWKUXMcGYGRcQfSTHWX0aWTFyke0ai1INbPGwgNOVEvMvB8UnHZJPo46lgcOEwSMS3yBRV3LkaR0-027RtRLC0jhXdj3k2RpKxMJLvuLFc_IiahIWSvsWRGD_nlJxTXU/3er/WwXVOUT4SB-W3DETrCfz2Q/h7/en_79KQYcU4zMQv453PV414fHP73nJ2DQpAGQTOE1tc&amp;source=gmail&amp;ust=1632053715872000&amp;usg=AFQjCNHAHLVFhds4M0h9cv72fE9oL7sgRw"><img alt="LinkedIn" height="32" src="https://ci4.googleusercontent.com/proxy/36bRob0GhkVHklPL9c_XcgBt-FBxht1wPxVn7seOXBEbA_UgVIDds36Sdtb60eGNx_jnDIBNOHbxdujLZa1ib9DoabMU63g0k6Xp9OBIHwKZQ6aSRTsTs5DrPMZcC1VOOrtJ6AMFDlL5nQLpuFuodQWO-PwoCDKjzvL0yTynkjO-Y4kI7vs=s0-d-e1-ft#https://d2fi4ri5dhpqd1.cloudfront.net/public/resources/social-networks-icon-sets/t-circle-dark-gray/linkedin@2x.png" style="text-decoration:none;height:auto;border:0;display:block" title="LinkedIn" width="32" class="CToWUd"></a></td>
                                                                    <td style="border-collapse:collapse;vertical-align:top;padding-bottom:5px;padding-left:0;padding-right:20px;word-break:break-word" valign="top"><a href="https://link.engage.srinathuniversity.com/ss/c/scbD5ZNE2AS0oXAwvo7TcPPHRrEKcg4cy2v1okzDDmMy4-5CLAq51G9ds2Ew0B9mU7l74_cS5k2jruearOe1T2x9DAoOoG3BB8GYqht_0vAqTgylzQnOmxwxh-f3rPXbRE2cLKg8HSvtj6Q1Tg6oRUeEQtKRoCFTAHnYq_PF_GC0Ye_ce-a5xXILFRD-okz3ITmWsc8_vTHsrdgQi2c4RarYaB6rCLO8modbP7vmQRfTJVPq4hTa_n_ND835qxRofNDfQJK_T3_f26xBdjyoemc6SQ00t7g7yGXlOwgO7xikmz0AOu85vWpDuZ2AP3pmbMZvF3pN1C5VnAuALPO0Nv83gO33u-GKEzEGhTt575K1IKlXBYZya3vr1ZnnrxaD0hWiEWE3CMOY3hB7qJveOMjeXMzz2sm_76f5D0UKAOpMWZBNhXP6jW7au01XQN3XpP_WuPWps-v9QTASUFrOpceaWF1Vr2dtQ9YFsaHERat9uVFhzBcb31bLFDxZEE4SSg3kt9NE_V65-e7vTEsgv4ASJzlpCcaUD8ahPr3jgNbeosw7eatb9hBVyknP-bzJRHaMa49NvGS5PqEQNyQd0yQKMIMdWk44LTO_VLoDTh-YQSAdKIRBaiLDm2rRofIljjEhWZnh7NF0tpFwX4X6E2uPsF5Py5rcEzasIAGDKEHdRAWf6fQES2jmiv3M1ul03zsea4NNUbHSvkHJe5E2HwpcvaZIyqIa7dZqY_ul0cUVvxGRWFx-whcNYWN1eed9yUAaMUSxtpgA7DfuwMwXvyRLRxKBfAXasAQAunWuV7sRP7C3R-JA-SZ1WigAMi4b7vcBz89IPKkzJ4y5gWztlDVdbXXTRxGnRy7XNOu_hpKdafmgW7B0IqjUSzKMdXM8IqtvJp3Y6TsPivBjrxWtW21LrqVoyz8G7cxJBg078OMG3KnI-kxUGH1mA8NrySGcxeHVHOJEAQa7NmsNp5TnteYzN41oBb7D3xZrHhKiDr20xq_S8gXRyhn81LTpR3ijWBPZAVqUGdeFgZNizEmt3vhCwjRparR-3TAplbAdAiuISATsV1jPmguZIQkQBxa7Unql8oDENXqaqhok9kzPrQ/3er/WwXVOUT4SB-W3DETrCfz2Q/h8/UBsYpH5fpDcYY2hb9YwYYMHXLzNUX2P1csRdgD2Ml_A" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://link.engage.srinathuniversity.com/ss/c/scbD5ZNE2AS0oXAwvo7TcPPHRrEKcg4cy2v1okzDDmMy4-5CLAq51G9ds2Ew0B9mU7l74_cS5k2jruearOe1T2x9DAoOoG3BB8GYqht_0vAqTgylzQnOmxwxh-f3rPXbRE2cLKg8HSvtj6Q1Tg6oRUeEQtKRoCFTAHnYq_PF_GC0Ye_ce-a5xXILFRD-okz3ITmWsc8_vTHsrdgQi2c4RarYaB6rCLO8modbP7vmQRfTJVPq4hTa_n_ND835qxRofNDfQJK_T3_f26xBdjyoemc6SQ00t7g7yGXlOwgO7xikmz0AOu85vWpDuZ2AP3pmbMZvF3pN1C5VnAuALPO0Nv83gO33u-GKEzEGhTt575K1IKlXBYZya3vr1ZnnrxaD0hWiEWE3CMOY3hB7qJveOMjeXMzz2sm_76f5D0UKAOpMWZBNhXP6jW7au01XQN3XpP_WuPWps-v9QTASUFrOpceaWF1Vr2dtQ9YFsaHERat9uVFhzBcb31bLFDxZEE4SSg3kt9NE_V65-e7vTEsgv4ASJzlpCcaUD8ahPr3jgNbeosw7eatb9hBVyknP-bzJRHaMa49NvGS5PqEQNyQd0yQKMIMdWk44LTO_VLoDTh-YQSAdKIRBaiLDm2rRofIljjEhWZnh7NF0tpFwX4X6E2uPsF5Py5rcEzasIAGDKEHdRAWf6fQES2jmiv3M1ul03zsea4NNUbHSvkHJe5E2HwpcvaZIyqIa7dZqY_ul0cUVvxGRWFx-whcNYWN1eed9yUAaMUSxtpgA7DfuwMwXvyRLRxKBfAXasAQAunWuV7sRP7C3R-JA-SZ1WigAMi4b7vcBz89IPKkzJ4y5gWztlDVdbXXTRxGnRy7XNOu_hpKdafmgW7B0IqjUSzKMdXM8IqtvJp3Y6TsPivBjrxWtW21LrqVoyz8G7cxJBg078OMG3KnI-kxUGH1mA8NrySGcxeHVHOJEAQa7NmsNp5TnteYzN41oBb7D3xZrHhKiDr20xq_S8gXRyhn81LTpR3ijWBPZAVqUGdeFgZNizEmt3vhCwjRparR-3TAplbAdAiuISATsV1jPmguZIQkQBxa7Unql8oDENXqaqhok9kzPrQ/3er/WwXVOUT4SB-W3DETrCfz2Q/h8/UBsYpH5fpDcYY2hb9YwYYMHXLzNUX2P1csRdgD2Ml_A&amp;source=gmail&amp;ust=1632053715872000&amp;usg=AFQjCNFfOarXnvwvXj59SxeRbEZXVDq2Ww"><img alt="Instagram" height="32" src="https://ci6.googleusercontent.com/proxy/rulFhqRIi_il0rAtxBorZY0s0-nkTdEesBZPROFrI1ShNArhpnNtnDr2xkSlPoXMnzLnbtOxZS1CrJvTTBja5rbsQG9EbFu5-UEMiQpTha6x9a7bx361AYXcwjPn0Nv4im3Noj04u-XSoHZulAnRV9xffichZWyqVLqTutA6NWjhPwnLh5vV=s0-d-e1-ft#https://d2fi4ri5dhpqd1.cloudfront.net/public/resources/social-networks-icon-sets/t-circle-dark-gray/instagram@2x.png" style="text-decoration:none;height:auto;border:0;display:block" title="Instagram" width="32" class="CToWUd"></a></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        return  'Mail has been sended to the this' . $reciever_email;

    }
}

