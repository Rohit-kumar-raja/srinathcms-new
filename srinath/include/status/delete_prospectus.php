<?php
session_start();
include '../config.php';
$delete=$_GET['delete'];
$trash=md5('trash');
$url=$_SERVER['HTTP_REFERER'];
$delete_prospectus="UPDATE `tbl_prospectus` SET `status`='$trash' WHERE `id`='$delete'";
$result=mysqli_query($con,$delete_prospectus);

if($result){
    $_SESSION['success']="Prospectus successfully moved to the trash";
    echo "<script>
    window.location.replace('".$url."')
</script>";
}else{
    $_SESSION['error']="Prospectus not moved in the trash";
    echo "<script>
    window.location.replace('".$url."')
</script>";
}
