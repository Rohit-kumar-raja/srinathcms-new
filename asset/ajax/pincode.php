<?php
$pincode = $_GET['code'];
pincode($pincode);
function pincode($pincode)
{
    if ($pincode > 100000 && $pincode <= 999999) {
        $api = 'https://api.postalpincode.in/pincode/';
        $json_data = file_get_contents($api . $pincode);
        $data = json_decode($json_data);
        if ($data[0]->PostOffice[0] != '') {
            $variable = $data[0]->PostOffice[0];
            echo  $_SESSION['pincode'] = $variable->Pincode . "," ;
            echo  $_SESSION['block'] = $variable->Block.",";
            echo  $_SESSION['state'] = $variable->State .",";
            echo  $_SESSION['country'] = $variable->Country.",";
            echo   $_SESSION['distric'] = $variable->District .",";
?>

<?php
        } else {
            $_SESSION['notvalid'] = 'pin code not valid';
        }
    } else {
        $_SESSION['notvalid'] = 'pin code not valid';
    }
}
?>
