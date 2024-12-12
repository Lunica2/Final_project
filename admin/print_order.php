<?php
session_start();
include 'config.php';
$ids = $_GET['id'];
$sql = "SELECT * FROM tb_order WHERE order_id = '$ids'";
$result = mysqli_query($conn, $sql);
$rs = mysqli_fetch_array($result);
$total_price = $rs['total_price'];
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบเสร็จการสั่งซื้อ</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Prompt', sans-serif;
        }
        .receipt-container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .receipt-header {
            background-color: #007bff;
            color: #fff;
            padding: 10px 0;
            border-radius: 15px 15px 0 0;
        }
        .receipt-header h4 {
            margin: 0;
        }
        .card-body {
            background-color: #f1f1f1;
        }
        table th {
            background-color: #007bff;
            color: #fff;
        }
        .table-hover tbody tr:hover {
            background-color: #e9ecef;
        }
        .btn-custom {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
        }
        .btn-custom:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .btn-print {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }
        .btn-print:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="receipt-container">
                    <div class="receipt-header text-center">
                        <h4>ใบเสร็จการสั่งซื้อ</h4>
                    </div>
                    <div class="mt-4">
                        <p><strong>เลขที่การสั่งซื้อ :</strong> <?= $rs['order_id']; ?></p>
                        <p><strong>เลขที่สมาชิก :</strong> <?= $rs['id']; ?></p>
                        <p><strong>ชื่อ - นามสกุล (ผู้ซื้อ) :</strong> <?= $rs['cus_name']; ?></p>
                        <p><strong>ที่อยู่การจัดส่ง :</strong> <?= $rs['address']; ?></p>
                        <p><strong>เบอร์โทรศัพท์ :</strong> <?= $rs['telephone']; ?></p>
                        <p><strong>เลขไปรษณีย์ :</strong> <?= $rs['zipcode']; ?></p>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>รหัสสินค้า</th>
                                        <th>ชื่อสินค้า</th>
                                        <th>ราคา (บาท)</th>
                                        <th>จำนวนที่สั่งซื้อ</th>
                                        <th>ราคารวม (บาท)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql1 = "SELECT * FROM order_detail d, product p, user_form uf WHERE d.id_pro = p.id_pro AND p.id_user = uf.id_member AND d.id_order = '$ids'";
                                    $result1 = mysqli_query($conn, $sql1);
                                    while ($row = mysqli_fetch_array($result1)) {
                                    ?>
                                        <tr>
                                            <td><?= $row['id_pro']; ?></td>
                                            <td><?= $row['name_pro']; ?></td>
                                            <td><?= number_format($row['price_pro'], 2); ?></td>
                                            <td><?= $row['item_amount']; ?> เล่ม</td>
                                            <td><?= number_format($row['total'], 2); ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <h6 class="text-end">รวมเป็นเงิน <?= number_format($total_price, 2); ?> บาท</h6>
                        </div>
                    </div>
                    <div class="text-center">
                        <p class="text-muted">*** ชำระเงินภายใน 7 วัน หลังจากสั่งซื้อสินค้า ***</p>
                        <a href="report_order.php" class="btn btn-custom">กลับ</a>
                        <button onclick="window.print()" class="btn btn-print">พิมพ์ใบเสร็จ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
