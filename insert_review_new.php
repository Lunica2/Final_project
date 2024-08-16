<?php
@include 'config.php';

$user_id=$_POST['id_user'];
$user_name=$_POST['user_name'];
$id_pro=$_POST['id_pro'];
$rating=$_POST['rating'];
$opinion=$_POST['opinion'];

$sql="INSERT INTO review_table(id_pro,user_id,user_name,user_rating,user_review) VALUES('$id_pro','$user_id','$user_name','$rating','$opinion')";
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
     window.location = "review.php"; //หน้าที่ต้องการให้กระโดดไป
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
     window.location = "review.php"; //หน้าที่ต้องการให้กระโดดไป
 });
}, 1000);
</script>';
}
?>