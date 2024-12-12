<?php
include 'config.php';
$ids=$_GET['id'];
$id_pro=$_GET['ip'];

$sql="UPDATE order_detail SET order_pro_status = 2 WHERE id_order='$ids' and id_pro='$id_pro' ";
$result=mysqli_query($conn,$sql);
if($result){
    echo "<script>window.location='report_order.php'; </script>";
}else{
    echo "<script>alert('ไม่สามารถปรับสถานะได้'); </script>";
}

mysqli_close($conn);
?>