<?php
include 'config.php';

$id=$_POST['uid'];
$username=$_POST['username'];
$uname=$_POST['uname'];
$email=$_POST['email'];
$address=$_POST['address'];
$tel=$_POST['tel'];

//แก้ไขข้อมูล
$sql="UPDATE user_form SET
username='$username',
name='$uname',
email='$email',
address='$address',
telephone='$tel'
WHERE id_member='$id'";

$result=mysqli_query($conn,$sql);
if($result){
    echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    echo '<script>
    setTimeout(function() {
     swal({
         title: "เสร็จสิ้น",
         type: "success"
     }, function() {
         window.location = "login.php"; //หน้าที่ต้องการให้กระโดดไป
     });
 }, 1000);
</script>';

}else{
    echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    echo '<script>
    setTimeout(function() {
     swal({
         title: "ไม่สามารถแก้ไขได้",
         type: "error"
     }, function() {
         window.location = "login.php"; //หน้าที่ต้องการให้กระโดดไป
     });
 }, 1000);
</script>';;
}
?>