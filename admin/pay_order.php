<?php
include 'config.php';
$ids=$_GET['id'];

$sql="UPDATE tb_order SET order_status = 2 WHERE order_id='$ids' ";
$result=mysqli_query($conn,$sql);
if($result){
    echo "<script>window.location='report_order.php'; </script>";
}else{
    echo "<script>alert('ไม่สามารถปรับสถานะได้'); </script>";
}

mysqli_close($conn);
?>