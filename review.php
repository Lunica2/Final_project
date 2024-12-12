<?php
session_start();
include 'config.php';

if (!isset($_SESSION["bu_username"])) {
    header("location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รีวิวสินค้า</title>
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
            font-size: 1.6rem;
            font-weight: bold;
        }

        .table th {
            background-color: #007bff;
            color: white;
            text-align: center;
        }

        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .img-thumbnail {
            border-radius: 8px;
        }

        .btn-primary {
            border-radius: 20px;
            padding: 5px 20px;
        }

        .btn-sm.disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
<?php include 'menu.php'; ?>

<div class="container">
    <div class="alert alert-success text-center mt-4" role="alert">
        รีวิวสินค้า
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover mt-4">
            <thead>
                <tr>
                    <th>รหัสสินค้า</th>
                    <th>รูปภาพสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>วันที่สั่งซื้อ</th>
                    <th>สถานะการสั่งซื้อ</th>
                    <th>รีวิวสินค้าที่สั่งซื้อ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT *,
                (SELECT COUNT(*) FROM review_table r WHERE r.id_pro = d.id_pro AND r.user_id = '" . $_SESSION["bu_id"] . "') AS reviewed
                FROM order_detail d
                JOIN product p ON d.id_pro = p.id_pro
                JOIN tb_order t ON d.id_order = t.order_id
                WHERE t.id = '" . $_SESSION["bu_id"] . "'";
        
                $hand = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($hand)) {
                    $status = $row['order_pro_status'];
                ?>
                <tr>
                    <td><?=$row['id_pro']?></td>
                    <td><img src="img/<?=$row['photo_pro']?>" class="img-thumbnail" width="100" height="100"></td>
                    <td><?=$row['name_pro']?></td>
                    <td><?=$row['reg_date']?></td>
                    <td>
                        <?php
                        switch ($status) {
                            case 0:
                                echo "<span class='badge bg-danger'>สินค้าถูกยกเลิก</span>";
                                break;
                            case 2:
                                echo "<span class='badge bg-warning'>ยังไม่ชำระเงิน</span>";
                                break;
                            case 3:
                                echo "<span class='badge bg-success'>ชำระเงินเรียบร้อย</span>";
                                break;
                            case 1:
                                echo "<span class='badge bg-info'>รอการตรวจสอบ</span>";
                                break;
                        }
                        ?>
                    </td>
                    <td>
    <?php if ($status == 3 && $row['reviewed'] == 0) { ?>
        <a href="review_new.php?id=<?=$row['id_pro']?>" class="btn btn-primary btn-sm">รีวิวสินค้า</a>
    <?php } else if ($row['reviewed'] > 0) { ?>
        <button class="btn btn-secondary btn-sm disabled" role="button">รีวิวแล้ว</button>
    <?php } else { ?>
        <button class="btn btn-primary btn-sm disabled" role="button">รีวิวสินค้า</button>
    <?php } ?>
</td>
                </tr>
                <?php
                }
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>