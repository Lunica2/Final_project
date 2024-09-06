<?php
@include 'config.php';
session_start();
    $bank = $_POST['bank'];
    $bank_number = $_POST['bank_number'];
    $ids=$_SESSION["se_id"];

    $sql = "INSERT INTO payment_methods(bank,bank_number,id_member) VALUES('$bank','$bank_number','$ids')";
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