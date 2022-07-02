
<?php
if(isset($_POST['su'])){
    echo "<pre>";
print_r($_FILES['img1']);


}
?>
<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="img1">
    <input type="submit" name="su" id="">
</form>