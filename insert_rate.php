<?php
@include 'config.php';

$user_id=$_POST['id_user'];
$user_name=$_POST['user_name'];
$opinion=$_POST['opinion'];

$sql="INSERT INTO rate(rate_detail,id_member) VALUES('$opinion','$user_id')";
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
     window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
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
     title: "ไม่สามารถเพิ่มได้",
     type: "error"
 }, function() {
     window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
 });
}, 1000);
</script>';
}
?>