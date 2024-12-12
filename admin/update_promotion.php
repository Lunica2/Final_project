<?php
include 'config.php';

$proid=$_POST['pid'];
$proname=$_POST['pname'];
$detail=$_POST['detail'];
$price=$_POST['price'];
$amount=$_POST['amount'];
$img=$_POST['txtimg'];
$start=$_POST['start_date'];
$end=$_POST['end_date'];

if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
    $new_image_name = 'pro_'.uniqid().".".pathinfo(basename($_FILES['file1']['name']), PATHINFO_EXTENSION);
    $image_upload_path = "../img/".$new_image_name;
    move_uploaded_file($_FILES['file1']['tmp_name'],$image_upload_path);
    } else {
    $new_image_name = "$img";
    }

$sql="UPDATE promotion SET
name_pro='$proname',
promo_detail='$detail',
amount='$amount',
price='$price',
photo_pro='$new_image_name',
start_date='$start',
end_date='$end'
WHERE id_promo='$proid' ";

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
         window.location = "report_promotion.php"; //หน้าที่ต้องการให้กระโดดไป
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
         window.location = "report_promotion.php"; //หน้าที่ต้องการให้กระโดดไป
     });
 }, 1000);
</script>';;
}
?>