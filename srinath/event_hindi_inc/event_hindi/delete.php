<?php 
include '../../../Backend/connection.inc.php';
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $delete="DELETE FROM `tbl_sub_events` WHERE `id`='$id'";
    $success_result=mysqli_query($connection,$delete);
if($success_result){
    echo "<script>
    setTimeout(function() {
        window.location.replace('../../event_hindi.php')
      }, 10);

</script>";
}
else{
    echo "data not deleted";
}
}
