<?php
@include 'config.php';

session_start();

if(!isset($_SESSION["se_username"]))
header("location:login.php");

$ID=$_GET['id'];
$sql1="SELECT * FROM payment_methods WHERE id_payment='$ID' ";
$hand=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_array($hand);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไข ช่องทางชำระเงิน</title>
    <link rel="stylesheet" href="style/style_register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<style>
body{
    background-color: #f0f0f5;
}
    </style>
<body>
<div class="form-container" >
    <form action="insert_edit_payment.php" method="post">
        <h3>แก้ไขช่องทางชำระเงิน</h3>
        <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span>';
            };
        };
        ?>
        <input type="text" name="id" class="form-control text-center" readonly value=<?=$row1['id_payment']?>>
        <label class="mt-1">ธนาคาร</label>
        <input type="text" name="bank" class="form-control" value=<?=$row1['bank']?>>
        <label class="mt-1">เลขที่บัญชี</label>
        <input type="text" name="bank_number" class="form-control" value=<?=$row1['bank_number']?>>
<br>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-danger" href="editpay_ment.php" role="button">Cancel</a>
    </form>
</body>
</html>