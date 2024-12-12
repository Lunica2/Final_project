<?php
include 'config.php';
session_start();

if(!isset($_SESSION["bu_username"]))
header("location:login.php");

$ids=$_SESSION["bu_id"];
$id=$_GET['id'];

$sql = "select * from pre_order po,pre_order_detail pod,product p,user_form u ,payment_methods pm where po.id_pre=pod.id_pre and po.id_pro=p.id_pro and po.id_member=u.id_member and p.id_user=pm.id_member and po.id_pre='$id'";
$hand=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($hand);
$id_pro=$row['id_pro'];
$id_user=$row['id_user'];
$namepro = $row['name_pro'];
$amount = $row['item_amount'];
$price = $row['total_price_pre'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งชำระเงิน Pre Order</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background: linear-gradient(135deg, #d3d5d0 0%, #fad0c4 100%);
            font-family: 'Arial', sans-serif;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        h2 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }
        label {
            font-weight: bold;
        }
        .btn-primary {
            width: 100%;
            padding: 10px;
        }
        .form-check-label {
            margin-left: 10px;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const today = new Date().toISOString().split('T')[0];
            document.querySelector('input[name="pay_date"]').value = today;

            const currentTime = new Date().toLocaleTimeString('it-IT', {
                hour: '2-digit',
                minute: '2-digit'
            });
            document.querySelector('input[name="pay_time"]').value = currentTime;
        });
    </script>
</head>
<body>
<?php include 'menu.php'; ?>
    <div class="container"> 

        <div class="row">
            <div class="col-12">
                <div class="alert alert-warning text-center mt-3" role="alert">
                    แจ้งชำระเงิน Pre Order
                </div>
            </div>
        </div>

        <form action="insert_payment_pre.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="mt-4">เลขที่ Pre Order</label>
                    <input type="text" name="order_id" class="form-control" required readonly value="<?= $id ?>"> <br>
                    
                    <label class="mt-2">ชื่อสินค้า</label>
                    <textarea name="cusname" class="form-control" readonly rows="1"><?= $namepro ?></textarea>

                    <label class="mt-4">ชื่อผู้ซื้อ</label>
                    <textarea name="cusname" class="form-control" readonly rows="1"><?= $row['name'] ?></textarea>
                    
                    <label class="mt-4">จำนวนสินค้าที่ Pre order</label>
                    <input type="number" name="amount" class="form-control" readonly value="<?= $amount ?>">

                    <label class="mt-4">จำนวนเงินที่ต้องชำระ</label>
                    <input type="number" name="total_price" class="form-control" readonly value="<?= $row['total'] ?>"> <br>
                </div>

                <div class="col-md-6 mb-6">
                    <h2>*เลือกช่องทางการชำระเงิน</h2>
                    <?php
                    $sql = "SELECT * FROM payment_methods pm,product p WHERE pm.id_member=p.id_user and p.id_pro='$id_pro' and pm.id_member='$id_user'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="payment_<?php echo $row['id_payment']; ?>" name="payment_method" value="<?php echo $row['id_payment']; ?>" required>
                                <label class="form-check-label" for="payment_<?php echo $row['id_payment']; ?>">
                                    <?php echo $row['bank']; ?> <?php echo $row['bank_number']; ?>
                                </label>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No payment methods available.</p>
                    <?php endif; ?>

                    <label class="mt-3">วันที่โอน</label>
                    <input type="date" name="pay_date" class="form-control" readonly required> <br>

                    <label>เวลาที่โอน</label>
                    <input type="time" name="pay_time" class="form-control" readonly required>

                    <label class="mt-4">*หลักฐานการชำระเงิน</label>
                    <input type="file" name="file1" class="form-control" required> <br>

                    <button type="submit" name="btn2" class="btn btn-primary mt-4">ยืนยัน</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>