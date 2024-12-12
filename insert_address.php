<?php
@include 'config.php';
session_start();
    $address = $_POST['address'];
    $zipcode = $_POST['zipcode'];
    $tel = $_POST['tel'];
    $ad_name = $_POST['ad_name'];
    $ids=$_SESSION["bu_id"];

    $sql = "INSERT INTO address(ad_name,ad_address,ad_zipcode,telephone_ad,id_member) VALUES('$ad_name','$address','$zipcode','$tel','$ids')";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "<script> alert('บันทึกเรียบร้อย'); </script> ";
        echo "<script> window.location='editaddress.php'; </script> ";
    }else{
        echo "Error: " . $sql ."<br>" . mysqli_error($conn);
        echo "<script> alert('บันทึกไม่ได้'); </script> ";
    }
mysqli_close($conn);
?>