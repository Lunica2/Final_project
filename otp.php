<?php
@include 'config.php';
session_start();
$email=$_POST['email'];
$otp=$_POST['otp'];

$to=$email;
$from="Test@.com";
$fromName="Nakarin Wannin";
$subject="OTP Authentication";
$message="Yous OTP is: ".$otp;
$header='From:'.$fromName.'<'.$from.'>';
if(mail($to,$subject,$message,$header)){
    $msg = "Successful";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="style/style_register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<form action="submitotp.php" method="POST">
    Enter OTP
    <input type="number" name="checkotp" placeholder="Enter OTP">
    <input type="hidden" name="otp" value="<?php echo $otp; ?>">
    <input type="submit" value="Verify" class="form-btn">
</form>
</body>
</html>
