<?php
@include 'config.php';
session_start();

if(!isset($_SESSION["bu_username"])) {
    header("location:login.php");
}

$ids = $_SESSION["bu_id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มที่อยู่</title>
    
    <link rel="stylesheet" href="style/style_register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background: linear-gradient(135deg, #d3d5d0 0%, #fad0c4 100%);
        }

        .form-container {
            max-width: 500px;
            margin: 60px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
        }

        .form-control {
            margin-bottom: 15px;
            border-radius: 8px;
            padding: 10px;
        }

        .form-btn {
            display: block;
            width: 100%;
            padding: 10px;
            border-radius: 25px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .form-btn:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            display: block;
            width: 100%;
            padding: 10px;
            border-radius: 25px;
            margin-top: 10px;
        }

        .error-msg {
            color: #dc3545;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="form-container">
    <form action="insert_address.php" method="post">
        <h3>เพิ่มที่อยู่ในการจัดส่ง</h3>

        <?php
        if (isset($error)) {
            foreach ($error as $error) {
                echo '<span class="error-msg">' . $error . '</span>';
            }
        }
        ?>
        <input type="text" name="ad_name" class="form-control" required placeholder="*ชื่อ">
        <input type="text" name="address" class="form-control" required placeholder="*ที่อยู่">
        <input type="number" name="zipcode" class="form-control" required placeholder="*รหัสไปรษณีย์">
        <input type="number" name="tel" class="form-control" required placeholder="*เบอร์โทรศัพท์">
        <input type="submit" name="submit" value="เสร็จสิ้น" class="form-btn">
        <a class="btn btn-danger" href="index.php" role="button">Cancel</a>
    </form>
</div>

</body>
</html>