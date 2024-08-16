<?php
include 'config.php';
session_start();

$username =$_POST['username'];
$password =md5($_POST['password']);

$sql="SELECT * FROM user_form WHERE username='$username' and password ='$password' and user_type='Seller' ";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);

if($row > 0){
    $_SESSION["se_username"]=$row['username'];
    $_SESSION["se_password"]=$row['password'];
    $_SESSION["se_id"]=$row['id'];
    $_SESSION["se_name"]=$row['name'];
    $_SESSION["Seller"]=$row['user_type'];
    $_SESSION["se_address"]=$row['address'];
    $_SESSION["se_telephone"]=$row['telephone'];

    $show=header("location:index.php");
}else{
    $show=header("location:login.php");
}
echo $show;
?>