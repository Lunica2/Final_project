<?php
session_start();
include 'config.php';


if (!isset($_SESSION["order_id"])) {
    die("ไม่มีการสั่งซื้อ");
}

$sql = "SELECT * FROM tb_order t,address a WHERE t.id=a.id_member and t.order_id= '" . $_SESSION["order_id"] . "'";
$result = mysqli_query($conn, $sql);
$rs = mysqli_fetch_array($result);
$total_price = $rs['total_price'];

$sum_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการสั่งซื้อ</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f9f9f9;
        }
        .card {
            border-radius: 15px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            border-radius: 15px 15px 0 0;
        }
        .card-body {
            background-color: #fff;
        }
        .btn {
            border-radius: 30px;
        }
        .btn-success:hover {
            background-color: #28a745;
            color: white;
            box-shadow: 0px 0px 15px rgba(0, 123, 255, 0.4);
        }
        .alert-primary {
            background-color: #007bff;
            color: white;
        }
        h6 {
            font-size: 1.2rem;
        }
        table thead th {
            background-color: #f1f1f1;
        }
        table tbody tr {
            transition: all 0.3s;
        }
        table tbody tr:hover {
            background-color: #f8f9fa;
        }
        .text-end {
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-primary text-center" role="alert">
                    การสั่งซื้อเสร็จสิ้น
                </div>
                <div class="card">
                    <div class="card-header text-center h4">
                        ข้อมูลการสั่งซื้อ
                    </div>
                    <div class="card-body">
                        <p><strong>เลขที่การสั่งซื้อ:</strong> <?=$rs['order_id'];?></p>
                        <p><strong>ชื่อ - นามสกุล (ผู้รับ):</strong><?=$rs['cus_name'];?></p>
                        <p><strong>ที่อยู่การจัดส่ง:</strong> <?=$rs['address'];?></p>
                        <p><strong>เบอร์โทรศัพท์:</strong> <?=$rs['telephone'];?></p>
                        <p><strong>เลขไปรษณีย์:</strong> <?=$rs['zipcode'];?></p>
                        
                        <div class="table-responsive mt-4">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>รหัสสินค้า</th>
                                        <th>ชื่อสินค้า</th>
                                        <th>ราคา</th>
                                        <th>จำนวนที่สั่งซื้อ</th>
                                        <th>ราคารวม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql1 = "SELECT *
                                             FROM order_detail d
                                             JOIN product p ON d.id_pro = p.id_pro
                                             WHERE d.id_order = '" . $_SESSION["order_id"] . "'";
                                    $result1 = mysqli_query($conn, $sql1);
                                    while ($row = mysqli_fetch_array($result1)) {
                                        $sum_price += $row['total'];
                                    ?>
                                    <tr>
                                        <td><?=$row['id_pro']?></td>
                                        <td><?=$row['name_pro']?></td>
                                        <td><?=number_format($row['price_pro'], 2)?> บาท</td>
                                        <td><?=$row['item_amount']?> เล่ม</td>
                                        <td><?=number_format($row['total'], 2)?> บาท</td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <h6 class="text-end">รวมเป็นเงิน <?=number_format($sum_price, 2);?> บาท</h6>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <p>*** ชำระเงินภายใน 7 วัน หลังจากสั่งซื้อสินค้า ***</p>
                    <a href="buyer.php" class="btn btn-success">Back</a>
                    <button onclick="window.print()" class="btn btn-success">Print</button>
                    <a href="check_order.php" class="btn btn-success">ชำระเงิน</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
