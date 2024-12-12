<?php
include 'config.php';
session_start();

if (!isset($_SESSION["bu_username"])) {
    header("location:login.php");
}

$ids = $_SESSION["bu_id"];
$id = $_GET['id'];
$ip = $_GET['ip'];

$sql = "SELECT * FROM tb_order t, order_detail od, product p, user_form u, payment_methods pm 
        WHERE t.order_id = od.id_order AND od.id_pro = p.id_pro 
        AND t.id = u.id_member AND p.id_user = pm.id_member 
        AND od.id_order = '$id' AND od.id_pro = '$ip'";
$hand = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($hand);

$id_pro = $row['id_pro'];
$id_user = $row['id_user'];
$namepro = $row['name_pro'];
$amount = $row['item_amount'];
$price = $row['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งชำระเงิน</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #d3d5d0 0%, #fad0c4 100%);
        }
        .form-section {
            margin-top: 20px;
        }
        .payment-options, .payment-details {
            background-color: #f7f7f7;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }
        .btn-primary {
            background-color: #5d4037;
            border: none;
            border-radius: 20px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #3e2723;
        }
        h2 {
            color: #5d4037;
            font-weight: bold;
            margin-top: 20px;
        }
        input[type="radio"] {
            margin-right: 10px;
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
    <div class="container mt-4">
        <?php include 'menu.php'; ?><br>
        <div class="row">
            <div class="col-md-6 form-section">
                <div class="alert alert-warning text-center" role="alert">
                    แจ้งชำระเงินการสั่งซื้อ
                </div>
                <form action="insert_payment.php" method="POST" enctype="multipart/form-data">
                    <label class="">เลขที่การสั่งซื้อ</label>
                    <input type="text" name="order_id" class="form-control" required readonly value="<?= $id ?>"> 

                    <label hidden>เลขที่สินค้า</label>
                    <input type="text" name="id_pro" class="form-control" required readonly hidden value="<?= $id_pro ?>">

                    <label class="mt-4">ชื่อสินค้า</label>
                    <textarea name="cusname" class="form-control" readonly rows="1"><?= $namepro ?></textarea>

                    <label class="mt-4">ชื่อผู้ซื้อ</label>
                    <textarea name="cusname" class="form-control" readonly rows="1"><?= $row['name'] ?></textarea>

                    <label class="mt-4">จำนวนสินค้าที่สั่งซื้อ</label>
                    <input type="number" name="amount" class="form-control" readonly value="<?= $amount ?>">

                    <label class="mt-4">จำนวนเงินที่ต้องชำระ</label>
                    <input type="number" name="total_price" class="form-control" readonly value="<?= $price ?>">
                
            </div>

            <div class="col-md-6 payment-options">
                <h2>*เลือกช่องทางการชำระเงิน</h2>
                <?php
                $sql = "SELECT * FROM payment_methods pm, product p 
                        WHERE pm.id_member = p.id_user AND p.id_pro = '$id_pro' AND pm.id_member = '$id_user'";
                $result = $conn->query($sql);
                ?>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div>
                            <input type="radio" id="payment_<?= $row['id_payment']; ?>" name="payment_method" value="<?= $row['id_payment']; ?>" required>
                            <label for="payment_<?= $row['id_payment']; ?>"><?= $row['bank']; ?> <?= $row['bank_number']; ?></label>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No payment methods available.</p>
                <?php endif; ?>

                <div class="payment-details mt-4">
                    <label class="mt-2">วันที่โอน</label>
                    <input type="date" name="pay_date" class="form-control" readonly required>

                    <label class="mt-2">เวลาที่โอน</label>
                    <input type="time" name="pay_time" class="form-control" readonly required>

                    <label class="mt-4">*หลักฐานการชำระเงิน</label>
                    <input type="file" name="file1" class="form-control" required>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" name="btn2" class="btn btn-primary">ยืนยัน</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>