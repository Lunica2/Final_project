<?php
session_start();
include 'config.php';

if(!isset($_SESSION["bu_username"]))
    header("location:login.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสอบสถานะการ Pre Order</title>
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

        .btn-success {
            border-radius: 10px;
            background-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .status-pending {
            color: orange;
        }

        .status-paid {
            color: green;
        }

        .status-canceled {
            color: red;
        }

        .status-review {
            color: blue;
        }
    </style>
</head>
<body>
<?php include 'menu.php'; ?>

<div class="container">
    <div class="alert alert-info h4 text-center" role="alert">
        ตรวจสอบสถานะการ Pre Order
    </div>
    <table class="table table-striped table-hover mt-4">
        <thead>
            <tr>
                <th>เลขที่ Pre Order</th>
                <th>รูปภาพสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>ราคารวมสุทธิ</th>
                <th>วันที่สั่ง Pre Order</th>
                <th>สถานะการ</th>
                <th>ชำระเงิน</th>
                <th>รายละเอียด</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM pre_order po,pre_order_detail pod,product p,user_form u WHERE po.id_member=u.id_member and po.id_pre=pod.id_pre and pod.id_pro=p.id_pro AND u.id_member='" . $_SESSION["bu_id"] ."' ";
        $hand = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($hand)) {
            $status = $row['pre_status'];
        ?>
            <tr>
                <td><?=$row['id_pre']?></td>
                <td><img src="img/<?=$row['photo_pro']?>" width="100" height="100"></td>
                <td><?=$row['name_pro']?></td>
                <td><?=number_format($row['total_price_pre'], 2)?></td>
                <td><?=$row['time_pre']?></td>
                <td>
                    <?php
                    if ($status == 1) {
                        echo "<span class='status-pending'>ยังไม่ยอมรับ</span>";
                    } elseif ($status == 2) {
                        echo "<span class='status-paid'><b>ชำระเงินแล้ว</b></span>";
                    } elseif ($status == 0) {
                        echo "<span class='status-canceled'><b>ถูกยกเลิกการสั่งซื้อ</b></span>";
                    } elseif ($status == 3) {
                        echo "<span class='status-review'><b>ยอมรับแล้ว</b></span>";
                    }
                    ?>
                </td>

                <?php
if($status == 3){ ?>
            <td><a href="payment_pre_new.php?id=<?=$row['id_pre']?>" class="btn btn-primary btn-sm" role="button">ชำระเงิน</a></td>
        <?php }else{ ?>
            <td><a href="payment_pre_new.php?id=<?=$row['id_pre']?>" class="btn btn-primary btn-sm disabled" role="button">ชำระเงิน</a></td>
            <?php } ?>

                <td><a href="detail_pre_order.php?id=<?=$row['id_pre']?>" class="btn btn-success">รายละเอียด</a></td>
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