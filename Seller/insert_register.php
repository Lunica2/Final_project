<?php
@include 'config.php';

    $name = $_POST['name'];
    $username = $_POST['username'];
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $email =$_POST['email'];
    $telephone = $_POST['telephone'];
    $user_type = $_POST['user_type'];
    $Bank = $_POST['bank'];
    $Bank_number = $_POST['bank_number'];

    $sql = "INSERT INTO user_form(username,password,name,email,telephone,user_type,bank,bank_number) VALUES('$username','$pass','$name','$email',
    '$telephone','$user_type','$Bank','$Bank_number')";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "<script> alert('บันทึกเรียบร้อย'); </script> ";
        echo "<script> window.location='login.php'; </script> ";
    }else{
        echo "Error: " . $sql ."<br>" . mysqli_error($conn);
        echo "<script> alert('บันทึกไม่ได้'); </script> ";
    }
mysqli_close($conn);
?>