<?php
include 'config.php';
$ids=$_GET['id'];

$sql="UPDATE pre_order SET pre_status = 0 WHERE id_pre='$ids' ";
$result=mysqli_query($conn,$sql);
if($result){
    echo "<script>window.location='report_pre_order.php'; </script>";
}else{
    echo "<script>alert('ไม่สามารถลบได้'); </script>";
}

mysqli_close($conn);
?>