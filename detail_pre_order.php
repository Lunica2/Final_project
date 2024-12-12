<?php
session_start();
include 'config.php';
$ids = $_GET['id'];
$sql = "SELECT * FROM pre_order po, user_form u WHERE po.id_member = u.id_member AND id_pre = $ids";
$result = mysqli_query($conn, $sql);
$rs = mysqli_fetch_array($result);
$total_price = $rs['total_price_pre'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดการสั่งสินค้าล่วงหน้า</title>
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

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .btn-success {
            border-radius: 10px;
            background-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .text-end {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .text-center {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-primary text-center mt-4" role="alert">
                    รายละเอียดการสั่งสินค้าล่วงหน้า
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5><strong>เลขที่การ Pre Order :</strong> <?=$rs['id_pre'];?></h5>
                        <h5><strong>เลขที่สมาชิก :</strong> <?=$rs['id_member'];?></h5>
                        <h5><strong>ชื่อ - นามสกุล (ผู้สั่ง) :</strong> <?=$rs['name'];?></h5>
                        <h5><strong>ที่อยู่การจัดส่ง :</strong> <?=$rs['address'];?></h5>
                        <h5><strong>เบอร์โทรศัพท์ :</strong> <?=$rs['telephone'];?></h5>
                    </div>
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
                                $sql1 = "SELECT * FROM pre_order_detail pod, product p ,pre_order po WHERE pod.id_pro = p.id_pro and pod.id_pre=po.id_pre AND pod.id_pre = $ids";
                                $result1 = mysqli_query($conn, $sql1);
                                while ($row = mysqli_fetch_array($result1)) {
                                    $status = $row['pre_status'];
                                ?>
                                    <tr>
                                        <td><?=$row['id_pro']?></td>
                                        <td><?=$row['name_pro']?></td>
                                        <td><?=number_format($row['price_pro'], 2)?> บาท</td>
                                        <td><?=$row['item_amount']?> เล่ม</td>
                                        <td><?=number_format($row['total'], 2)?></td>
                                        <td>
                            <?php
                            if ($status == 1) {
                                echo "ยังไม่ชำระเงิน";
                                echo "<img src='img/no.jpg' width='30' height='30' border='0' />";
                            } else if ($status == 2) {
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
                        <h6 class="text-end">รวมเป็นเงิน <?=number_format($total_price, 2);?> บาท</h6>
                    </div>
                </div>

                <div class="alert alert-warning text-center">
                    *** ชำระเงินภายใน 7 วัน หลังจากสั่งซื้อสินค้า ***
                </div>

                <div class="text-center">
                    <a href="check_pre.php" class="btn btn-success">กลับไปหน้าการตรวจสอบ</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
