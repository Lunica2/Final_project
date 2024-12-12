<?php
session_start();
include 'config.php';
$ids = $_GET['id'];
$sql = "SELECT * FROM tb_order WHERE order_id=$ids";
$result = mysqli_query($conn, $sql);
$rs = mysqli_fetch_array($result);
$total_price = $rs['total_price'];
$grandTotal = 0; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดการสั่งซื้อ</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 40px;
        }

        .alert {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .table {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .card {
            border-radius: 10px;
        }

        .text-end {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .notice {
            background-color: #fff3cd;
            border-radius: 5px;
            padding: 15px;
            margin-top: 20px;
        }

        .btn-success {
            border-radius: 10px;
            background-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="alert alert-primary text-center" role="alert">
                    รายละเอียดการสั่งซื้อ
                </div>
                <div class="mb-4">
                    <strong>เลขที่การสั่งซื้อ:</strong> <?= $rs['order_id']; ?><br>
                    <strong>เลขที่สมาชิก:</strong> <?= $rs['id']; ?><br>
                    <strong>ชื่อ - นามสกุล (ผู้ซื้อ):</strong> <?= $rs['cus_name']; ?><br>
                    <strong>ที่อยู่การจัดส่ง:</strong> <?= $rs['address']; ?><br>
                    <strong>เบอร์โทรศัพท์:</strong> <?= $rs['telephone']; ?><br>
                    <strong>เลขไปรษณีย์:</strong> <?= $rs['zipcode']; ?><br>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>รหัสสินค้า</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>ราคา</th>
                                    <th>จำนวนที่สั่งซื้อ</th>
                                    <th>ราคารวม</th>
                                    <th>สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql1 = "SELECT * FROM order_detail d, product p WHERE d.id_pro=p.id_pro AND d.id_order=$ids";
                                $result1 = mysqli_query($conn, $sql1);
                                while ($row = mysqli_fetch_array($result1)) {
                                    $totalPricePerItem = $row['price_pro'] * $row['item_amount']; 
                                    $grandTotal += $totalPricePerItem;
                                    $status = $row['order_pro_status'];
                                ?>
                                    <tr>
                                        <td><?= $row['id_pro'] ?></td>
                                        <td><?= $row['name_pro'] ?></td>
                                        <td><?= number_format($row['price_pro'], 2) ?> บาท</td>
                                        <td><?= $row['item_amount'] ?> เล่ม</td>
                                        <td><?= number_format($totalPricePerItem, 2) ?> บาท</td>
                                        <td>
                            <?php
                            if ($status == 2) {
                                echo "ยังไม่ชำระเงิน";
                                echo "<img src='img/no.jpg' width='30' height='30' border='0' />";
                            } else if ($status == 3) {
                                echo "ชำระเงินแล้ว";
                                echo "<img src='img/yes.jpg' width='30' height='30' border='0' />";
                            }
                            ?>
                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <h6 class="text-end">รวมเป็นเงิน <?= number_format($grandTotal, 2); ?> บาท</h6> 
                    </div>
                </div>
                <div class="notice">
                    *** กรุณาชำระเงินภายใน 7 วัน หลังจากสั่งซื้อสินค้า ***
                </div>
                <div class="text-center mt-4">
                    <a href="check_order.php" class="btn btn-success">กลับไปหน้าตรวจสอบการสั่งซื้อ</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
