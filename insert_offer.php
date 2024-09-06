<?php
include 'config.php';

$id_pro=$_POST['id_pro'];
$name=$_POST['name_pro'];
$price=$_POST['price'];
$amount=$_POST['amount_offer'];
$discount=$_POST['discount'];
$id_user=$_POST['uid'];
$add=$_POST['cus_add'];
$zipcode=$_POST['zipcode'];

//แก้ไขข้อมูล
$sql = "INSERT INTO offer(id_pro,id_member,name_pro,price,amount_offer,discount,address,zipcode,offer_status) VALUES('$id_pro','$id_user','$name','$price','$amount','$discount'
,'$add','$zipcode','1')";
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
         title: "ไม่สามารถแก้ไขได้",
         type: "error"
     }, function() {
         window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
     });
 }, 1000);
</script>';;
}
?>