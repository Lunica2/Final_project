<?php
@include 'config.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Buyer</title>

    <link rel="stylesheet" href="style/style_register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<div class="form-container">
    <form action="login_check.php" method="post">
        <h3>login now for buyer</h3>

        <input type="username" name="username" class="form-control" required placeholder="enter your username">
        <input type="password" name="password" class="form-control" required placeholder="enter your password">
        <?php
            if(!isset($_SESSION["Error"]))
            {
                session_destroy();
            }else{
                echo $_SESSION["Error"];
            }
            $_SESSION['Error'] ="";
        ?>
        <input type="submit" name="submit" value="login now" class="form-btn"> 
      <!--  <p>don't have an account? <a href="otp_ver.php">register now</a></p>-->
        <p>don't have an account? <a href="register.php">register now</a></p> 
    </form>
</div>
</body>
</html>