<?php
include 'config.php';
$ids=$_GET['id'];
$ia=$_GET['ia'];
$ip=$_GET['ip'];

$sql1 = "UPDATE product set amount= amount + '$ia' where id_pro='$ip' ";
mysqli_query($conn,$sql1);

$sql="UPDATE tb_order SET order_status = 0 WHERE order_id='$ids' ";
$result=mysqli_query($conn,$sql);
if($result){
    echo "<script>window.location='report_order.php'; </script>";
}else{
    echo "<script>alert('ไม่สามารถลบได้'); </script>";
}

mysqli_close($conn);
?>