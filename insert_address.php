<?php
@include 'config.php';
session_start();
    $address = $_POST['address'];
    $zipcode = $_POST['zipcode'];
    $ids=$_SESSION["bu_id"];

    $sql = "INSERT INTO address(address,zipcode,id_member) VALUES('$address','$zipcode','$ids')";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "<script> alert('บันทึกเรียบร้อย'); </script> ";
        echo "<script> window.location='index.php'; </script> ";
    }else{
        echo "Error: " . $sql ."<br>" . mysqli_error($conn);
        echo "<script> alert('บันทึกไม่ได้'); </script> ";
    }
mysqli_close($conn);
?>