<?php
@include 'config.php';
session_start();
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
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <script src="passotp.js"></script>
    <style>
        .otpverify{
            display: none;
        }
    </style>
</head>

<body>
<div class="form-container">
    <div class="otp">
        <h3>OTP Verification</h3>
        <input type="email" id="email" class="form-control" required placeholder="Enter Your Email">
        <button onclick="sendOTP()" class="btn btn-primary">Send OTP</button>
    </div>
    <div class="otpverify">
        <input class="from-control" type="text" id="otp_inp" placeholder="Enter Your OPT">
        <button class="btn btn-primary" id="otp-btn">Verify</button>
    </div>
</div>
</body>
</html>
