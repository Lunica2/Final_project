<?php
include 'config.php';
$ids=$_POST['pid'];
$nums=$_POST['pnum'];

$sql="UPDATE product set amount= amount + $nums WHERE id_pro='$ids' ";
$hand=mysqli_query($conn,$sql);
if($hand){
    echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    echo '<script>
    setTimeout(function() {
     swal({
         title: "เสร็จสิ้น",
         type: "success"
     }, function() {
         window.location = "add_amount_product.php"; //หน้าที่ต้องการให้กระโดดไป
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
         window.location = "add_amount_product.php"; //หน้าที่ต้องการให้กระโดดไป
     });
 }, 1000);
</script>';
}
mysqli_close($conn);
?>