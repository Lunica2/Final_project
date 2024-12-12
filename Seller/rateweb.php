<?php
session_start();
include 'config.php';

if(!isset($_SESSION["Seller"])) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รีวิวเว็บไซต์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            background: linear-gradient(135deg, #d3d5d0 0%, #fad0c4 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .wrapper {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .h3 {
            text-align: center;
            font-size: 1.75rem;
            margin-bottom: 20px;
            color: #343a40;
        }

        .form-control {
            margin-bottom: 15px;
            border-radius: 8px;
        }

        .rating {
            text-align: center;
            margin-bottom: 20px;
        }

        .rating i {
            font-size: 30px;
            color: #ccc;
            transition: color 0.3s;
        }

        .rating i.active {
            color: #fbc02d;
        }

        .btn-group {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 25px;
        }

        .submit {
            background-color: #28a745;
            color: #fff;
        }

        .submit:hover {
            background-color: #218838;
        }

        .cancel {
            background-color: #dc3545;
            color: #fff;
        }

        .cancel:hover {
            background-color: #c82333;
        }

        textarea {
            border-radius: 8px;
            padding: 10px;
            width: 100%;
            font-size: 1rem;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="mb-2 mt-3 h3">รีวิวเว็บไซต์</div>
    
    <form method="POST" action="insert_rate.php">
        <label class="h6">รหัสสมาชิก</label>
        <input type="text" name="id_user" class="form-control text-center" id="id_user" readonly value="<?=$_SESSION["se_id"]?>">
        
        <label class="h6">ชื่อสมาชิก</label>
        <textarea class="form-control" name="user_name" id="user_name" rows="1" readonly><?=$_SESSION["se_name"]?></textarea>
        
        <label class="h6">*ความคิดเห็นของคุณ</label>
        <textarea name="opinion" class="form-control" cols="30" rows="5" placeholder="ความคิดเห็นของคุณ..." required></textarea>
        
        <div class="btn-group">
            <button type="submit" class="btn submit">ยืนยัน</button>
            <a class="btn cancel" href="index.php">ยกเลิก</a>
        </div>
    </form>
</div>
</body>
</html>
