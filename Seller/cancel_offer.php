<?php
include 'config.php';
$ids=$_GET['id'];

$sql="UPDATE offer SET offer_status = 0 WHERE id_offer='$ids' ";
$result=mysqli_query($conn,$sql);
if($result){
    echo "<script>window.location='report_offer.php'; </script>";
}else{
    echo "<script>alert('ไม่สามารถลบได้'); </script>";
}

mysqli_close($conn);
?>