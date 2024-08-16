<?php
@include 'config.php';

session_start();

if(isset($_POST['submit'])){

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = md5($_POST['password']);

    $select = "SELECT * FROM user_form WHERE username = '$username' && password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_array($result);

        if($row['user_type'] == 'Seller'){
            $_SESSION['Seller_name'] = $row['name'];
            header('location:seller.php');
     
        }elseif($row['user_type'] == 'Buyer'){
            $_SESSION['Buyer_name'] = $row['name'];
            header('location:buyer.php');

        }elseif($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            header('location:admin/index.php');

        }else{
            $error[] = '<p> incorrect username or password! </p>';
        }
    }
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>
    
    <link rel="stylesheet" href="style/style_register.css">
</head>
<body>
<div class="form-container">
    <form action="" method="post">
        <h3>login now</h3>

        <input type="username" name="username" required placeholder="enter your username">
        <input type="password" name="password" required placeholder="enter your password">
        <?php
        if(isset($error)){
                echo $error;
        };
        ?>
        <input type="submit" name="submit" value="login now" class="form-btn">
        <p>don't have an account? <a href="register.php">register now</a></p>
    </form>
</div>

</body>
</html>