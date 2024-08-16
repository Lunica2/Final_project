<?php
$checkotp=$_POST['checkotp'];
$checkotp=$_POST['otp'];

if($checkotp==$otp){
    echo "OTP Verified Success";
}else{
    echo "Incorrect OTP";
}
?>