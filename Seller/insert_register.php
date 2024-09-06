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

    $sql = "INSERT INTO user_form(username,password,name,email,telephone,user_type) VALUES('$username','$pass','$name','$email',
    '$telephone','$user_type')";
    $result = mysqli_query($conn, $sql);

    $ID = mysqli_insert_id($conn);
    $_SESSION["id_member"] = $ID;
    if($result){
        echo "<script> alert('บันทึกเรียบร้อย'); </script> ";
        echo "<script> window.location='login.php'; </script> ";
    }else{
        echo "Error: " . $sql ."<br>" . mysqli_error($conn);
        echo "<script> alert('บันทึกไม่ได้'); </script> ";
    }

    $sql2="insert into payment_methods(bank,bank_number,id_member)
    values('$Bank','$Bank_number','$ID')";
    mysqli_query($conn,$sql2);
mysqli_close($conn);
?>