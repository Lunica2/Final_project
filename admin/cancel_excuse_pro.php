<?php
include 'config.php';
$ids=$_GET['id'];

$sql="UPDATE product SET status_pro = 0 WHERE id_pro='$ids' ";
$result=mysqli_query($conn,$sql);
if($result){
    echo "<script>window.location='report_excuse_product.php'; </script>";
}else{
    echo "<script>alert('ไม่สามารถลบได้'); </script>";
}

mysqli_close($conn);
?>