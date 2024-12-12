<?php
include 'config.php';
session_start();
$ids = $_SESSION["ad_id"];

if (!isset($_SESSION["admin"])) {
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sales Report</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .alert-primary {
            margin-bottom: 20px;
        }
        .card-body {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .btn-primary {
            border-radius: 20px;
        }
        .btn-primary:hover {
            opacity: 0.8;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <?php include 'menu1.php'; ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="alert alert-primary h4 text-center mt-4" role="alert">
                    ยอดขายสินค้า
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <form name="form1" method="POST" action="report_sale.php" class="mb-4">
                            <div class="row">
                            <label class="">วันเริ่มต้นการค้นหา - วันที่สิ้นสุดการค้นหา</label>
                                <div class="col-sm-2 mt-2">
                                    <input type="date" name="dt1" class="form-control">
                                </div>
                                <div class="col-sm-2 mt-2">
                                    <input type="date" name="dt2" class="form-control">
                                </div>
                                <div class="col-sm-4 mt-2">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> ค้นหา</button>
                                </div>
                            </div>
                        </form>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>เลขที่ใบสั่งซื้อ</th>
                                    <th>วันที่สั่งซื้อ</th>
                                    <th>ชื่อลูกค้า</th>
                                    <th>ราคารวมสุทธิ</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
$ddt1 = @$_POST['dt1'];
$ddt2 = @$_POST['dt2'];

if ($ddt1 != "" && $ddt2 == "") {

    echo "<div class='alert alert-info'>Searching for sales on $ddt1</div>";
    $sql = "SELECT * FROM tb_order t
            JOIN user_form u ON t.id = u.id_member
            JOIN order_detail od ON t.order_id = od.id_order
            JOIN product p ON od.id_pro = p.id_pro
            WHERE od.order_pro_status='3'
            AND DATE(reg_date) = '$ddt1'
            ORDER BY reg_date DESC";
} elseif ($ddt1 == "" && $ddt2 != "") {

    echo "<div class='alert alert-info'>Searching for sales on $ddt2</div>";
    $sql = "SELECT * FROM tb_order t
            JOIN user_form u ON t.id = u.id_member
            JOIN order_detail od ON t.order_id = od.id_order
            JOIN product p ON od.id_pro = p.id_pro
            WHERE od.order_pro_status='3'
            AND DATE(reg_date) = '$ddt2'
            ORDER BY reg_date DESC";
} elseif ($ddt1 != "" && $ddt2 != "") {

    $add_date = date('Y/m/d', strtotime($ddt2 . "+1 days"));
    echo "<div class='alert alert-info'>Searching from $ddt1 to $ddt2</div>";
    $sql = "SELECT * FROM tb_order t
            JOIN user_form u ON t.id = u.id_member
            JOIN order_detail od ON t.order_id = od.id_order
            JOIN product p ON od.id_pro = p.id_pro
            WHERE od.order_pro_status='3'
            AND reg_date BETWEEN '$ddt1' AND '$add_date'
            ORDER BY reg_date DESC";
} else {

    $sql = "SELECT * FROM tb_order t
            JOIN user_form u ON t.id = u.id_member
            JOIN order_detail od ON t.order_id = od.id_order
            JOIN product p ON od.id_pro = p.id_pro
            WHERE od.order_pro_status='3'
            ORDER BY reg_date DESC";
}

$total_sum = 0;
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
    $total_sum += $row['total_price'];
?>
    <tr>
        <td><?=$row['order_id']?></td>
        <td><?=$row['reg_date']?></td>
        <td><?=$row['cus_name']?></td>
        <td><?=$row['total_price']?> ฿</td>
    </tr>
<?php
}
mysqli_close($conn);
?>
                            </tbody>
                        </table>
                        <div class="text-end mt-4">
                            <strong>รวมเป็นเงินทั้งหมด <?=number_format($total_sum, 2)?> บาท</strong>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php include 'footer.php'; ?>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>
