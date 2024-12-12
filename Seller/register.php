<?php
@include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    
    <link rel="stylesheet" href="style/style_register.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        form h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        input[type="text"], input[type="username"], input[type="password"], 
        input[type="email"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #5cb85c;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #4cae4c;
        }

        .error-msg {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
            display: block;
        }

        p {
            text-align: center;
            margin-top: 15px;
        }

        p a {
            color: #5cb85c;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .form-container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
<div class="form-container">
    <form action="insert_register.php" method="post">
        <h3>Register Now</h3>
        <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span>';
            };
        };
        ?>
        <input type="text" name="name" required placeholder="Enter your name">
        <input type="username" name="username" required placeholder="Enter your username">
        <input type="password" name="password" required placeholder="Enter your password">
        <input type="password" name="cpassword" required placeholder="Confirm your password">
        <input type="email" name="email" required placeholder="Enter your email">
        <input type="number" name="telephone" required placeholder="Enter your telephone">
        
        <select name="user_type" required>
            <option value="Seller">Seller</option>
        </select>

        <select name="bank" required>
            <option value="ธนาคารกรุงเทพ">ธนาคารกรุงเทพ</option>
            <option value="ธนาคารกสิกรไทย">ธนาคารกสิกรไทย</option>
            <option value="ธนาคารไทยพาณิชย์">ธนาคารไทยพาณิชย์</option>
        </select>
        
        <input type="number" name="bank_number" required placeholder="Enter your bank number">
        <input type="submit" name="submit" value="Register Now" class="form-btn">
        
        <p>Already have an account? <a href="login.php">Login now</a></p>
    </form>
</div>

</body>
</html>
