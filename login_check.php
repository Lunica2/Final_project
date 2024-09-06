<?php
include 'config.php';
session_start();

$username =$_POST['username'];
$password =md5($_POST['password']);

$sql="SELECT * FROM user_form WHERE username='$username' and password ='$password' and user_type='Buyer' ";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);

if($row > 0){
    $_SESSION["bu_username"]=$row['username'];
    $_SESSION["bu_password"]=$row['password'];
    $_SESSION["bu_id"]=$row['id_member'];
    $_SESSION["bu_name"]=$row['name'];
    $_SESSION["bu_telephone"]=$row['telephone'];

    $_SESSION["Error"] ="";
        //$show=header("location:index.php");
        echo "<script> window.location='index.php'; </script>" ;
        $_SESSION['Error'] ="";
}else{
    $_SESSION["Error"] = "<p> Yor username or password is invalid </p>" ;
    $show=header("location:login.php");
}
echo $show;
?>