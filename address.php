<?php
@include 'config.php';
session_start();

if(!isset($_SESSION["bu_username"]))
header("location:login.php");

$ids=$_SESSION["bu_id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มที่อยู่</title>
    
    <link rel="stylesheet" href="style/style_register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<?php include 'menu.php'; ?>
<div class="form-container">
    <form action="insert_address.php" method="post">
        <h3>เพิ่มที่อยู่ในการจัดส่ง</h3>
        <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span>';
            };
        };
        ?> 
        <input type="text" name="address" required placeholder="ที่อยู่">
        <input type="number" name="zipcode" required placeholder="รหัสไปรษณีย์">
        <input type="submit" name="submit" value="เสร็จสิ้น" class="form-btn">
        <a class="btn btn-danger" href="index.php" role="button">Cancel</a>
    </form>
</div>

</body>
</html>