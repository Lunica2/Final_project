<?php
include 'config.php';
session_start();

$username =$_POST['username'];
$password =md5($_POST['password']);

$sql="SELECT * FROM user_form WHERE username='$username' and password ='$password' and user_type='admin' ";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);

if($row > 0){
    $_SESSION["ad_id"]=$row['id_member'];
    $_SESSION["username"]=$row['username'];
    $_SESSION["pw"]=$row['password'];
    $_SESSION["ad_name"]=$row['name'];
    $_SESSION["admin"]=$row['user_type'];
    $show=header("location:index.php");
}else{
    $show=header("location:login.php");
}
echo $show;
?>