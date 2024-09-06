<?php
include 'config.php';
session_start();

if(!isset($_SESSION["bu_username"]))
header("location:login.php");

$ids=$_SESSION["bu_id"];
$id=$_GET['id'];

$sql = "select * from offer o,product p,user_form u ,payment_methods pm where o.id_pro=p.id_pro and o.id_member=u.id_member and p.id_user=pm.id_member order by id_offer";
    $hand=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($hand);
    $id_pro=$row['id_pro'];
    $id_user=$row['id_user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งชำระเงิน</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script></head>
</head>
<body>
    <div class="container mt-2">
<?php include 'menu.php'; ?>
        <div class="row mt-6">
            <div class="col-md-6">
            <div class="alert alert-warning text-center" role="alert">
                แจ้งชำระเงินการจัดข้อเสนอ
                </div>
            </div>
        </div>
        <?php
    error_reporting(0);
    ini_set('display_errors', 0);
?>

<div class="row">
    <div class="col-md-6">
    <form action="insert_payment_offer.php" method="POST" enctype="multipart/form-data">
    <label class="mt-4">เลขที่ข้อเสนอ</label>
    <input type="text" name="order_id" required readonly value=<?=$id?>> <br>
    
    <label class="mt-4">ไอดีสินค้า</label>
    <textarea name="cusname" class="form-control" readonly rows="1"><?=$row['id_pro']?></textarea>
    <?php
    $sql = "SELECT * FROM payment_methods pm,product p WHERE pm.id_member=p.id_user and p.id_pro='$id_pro' and pm.id_member='$id_user'";
    $result = $conn->query($sql);
    $total = $row['price'] * $row['amount_offer'];
    ?>

    <label class="mt-4">ชื่อผู้ซื้อ</label>
    <textarea name="cusname" class="form-control" readonly rows="1"><?=$row['name']?></textarea>
    
    <label class="mt-4">จำนวนเงินที่ต้องชำระ</label>
    <input type="number" name="total_price" class="form-control" readonly value=<?=$total-($total * $row['discount'])/100?>> <br>

        <h2>เลือกช่องทางการชำระเงิน</h2>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div>
                    <input type="radio" id="payment_<?php echo $row['id_payment']; ?>" name="payment_method" value="<?php echo $row['id_payment']; ?>" required>
                    <label for="payment_<?php echo $row['id_payment']; ?>"><?php echo $row['bank']; ?> <?php echo $row['bank_number']; ?></label>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No payment methods available.</p>
        <?php endif; ?>

    <label class="mt-4">วันที่โอน</label>
    <input type="date" name="pay_date" class="form-control" required>

    <label class="mt-4">เวลาที่โอน</label>
    <input type="time" name="pay_time" class="form-control" required>

    <label class="mt-4">หลักฐานการชำระเงิน</label>
    <input type="file" name="file1" class="form-control" required> <br>


    <button type="submit" name="btn2" class="btn btn-primary" >ยืนยัน</button>
    </form>
<br>
    </div>
</div>

    </div>
</body>
</html>