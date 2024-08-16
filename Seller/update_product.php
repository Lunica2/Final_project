<?php
include 'config.php';

$proid=$_POST['pid'];
$proname=$_POST['pname'];
$detail=$_POST['detail'];
$typeid=$_POST['typeID'];
$price=$_POST['price'];
$amount=$_POST['amount'];
$img=$_POST['txtimg'];

//อัปรูป
if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
    $new_image_name = 'pro_'.uniqid().".".pathinfo(basename($_FILES['file1']['name']), PATHINFO_EXTENSION);
    $image_upload_path = "../img/".$new_image_name;
    move_uploaded_file($_FILES['file1']['tmp_name'],$image_upload_path);
    } else {
    $new_image_name = "$img";
    }

//แก้ไขข้อมูล
$sql="UPDATE product SET
name_pro='$proname',
detail_pro='$detail',
id_type='$typeid',
price_pro='$price',
amount='$amount',
photo_pro='$new_image_name'
WHERE id_pro='$proid' ";

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
         window.location = "stock_product.php"; //หน้าที่ต้องการให้กระโดดไป
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
         window.location = "stock_product.php"; //หน้าที่ต้องการให้กระโดดไป
     });
 }, 1000);
</script>';;
}
?>