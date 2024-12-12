<?php
session_start();
include 'config.php';

if (!isset($_SESSION["bu_username"])) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสอบสถานะการสั่งซื้อ</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #d3d5d0 0%, #fad0c4 100%);
        }

        .container {
            margin-top: 40px;
        }

        .alert {
            font-size: 1.5rem;
            font-weight: bold;
        }

        table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: #007bff;
            color: white;
        }

        td {
            vertical-align: middle;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #ffffff;
        }

        .status-label {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 20px;
        }

        .status-pending {
            background-color: #ffcc00;
            color: white;
        }

        .status-paid {
            background-color: #28a745;
            color: white;
        }

        .status-canceled {
            background-color: #dc3545;
            color: white;
        }

        .status-checking {
            background-color: #17a2b8;
            color: white;
        }

        .btn-success {
            background-color: #007bff;
            border: none;
            border-radius: 10px;
        }

        .btn-success:hover {
            background-color: #0056b3;
        }

    </style>
</head>

<body>
    <?php include 'menu.php'; ?>

    <div class="container">
        <div class="alert alert-success text-center" role="alert">
            ตรวจสอบสถานะการสั่งซื้อ
        </div>
        <table class="table table-striped table-hover mt-4">
            <thead>
                <tr>
                    <th>เลขที่ใบสั่งซื้อ</th>
                    <th>รูปภาพสินค้า</th>
                    <th hidden>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>ราคารวมสุทธิ</th>
                    <th>วันที่สั่งซื้อ</th>
                    <th>สถานะการสั่งซื้อ</th>
                    <th></th>
                    <th>ชำระเงิน</th>
                    <th>รายละเอียดการสั่งซื้อ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM tb_order t,order_detail od,product p,user_form u WHERE t.order_id=od.id_order and od.id_pro=p.id_pro AND u.id_member='" . $_SESSION["bu_id"] ."' order by order_id ";
                $hand = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($hand)) {
                    $status = $row['order_pro_status'];
                ?>
                    <tr>
                        <td><?= $row['order_id'] ?></td>
                        <td><img src="img/<?=$row['photo_pro']?>" width="100" height="100"></td>
                        <td hidden><?= $row['id_pro'] ?></td>
                        <td><?=$row['name_pro']?></td>
                        <td><?= $row['total'] ?></td>
                        <td><?= $row['reg_date'] ?></td>
                        <td>
                            <?php
                            if ($status == 2) {
                                echo "<span class='status-label status-pending'>ยังไม่ชำระเงิน</span>";
                            } else if ($status == 3) {
                                echo "<span class='status-label status-paid'>ชำระเงินแล้ว</span>";
                            } else if ($status == 0) {
                                echo "<span class='status-label status-canceled'>ยกเลิกการสั่งซื้อ</span>";
                            }
                            ?>
                        </td>
                        <td>
                <?php
if($status == 2){ ?>
            <td><a href="payment.php?id=<?=$row['order_id']?>&ip=<?= $row['id_pro'] ?>" class="btn btn-primary btn-sm" role="button">ชำระเงิน</a></td>
        <?php }else{ ?>
            <td><a href="payment.php?id=<?=$row['order_id']?>&ip=<?= $row['id_pro'] ?>" class="btn btn-primary btn-sm disabled" role="button">ชำระเงิน</a></td>
            <?php } ?>
                </td>
                        <td><a href="detail_order.php?id=<?= $row['order_id'] ?>" class="btn btn-success">รายละเอียด</a></td>
                        
                    </tr>
                <?php
                }
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>