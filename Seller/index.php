<?php
@include 'config.php';

session_start();
$ids=$_SESSION["se_id"];

if(!isset($_SESSION["Seller"]))
header("location:login.php");

//ยังไม่ชำระ
$sql1="SELECT COUNT(order_id) AS order_no FROM tb_order t,order_detail od,product p WHERE t.order_id=od.id_order and od.id_pro=p.id_pro and id_user='$ids' and order_status='1'";
$hand=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_array($hand);

//ชำระแล้ว
$sql2="SELECT COUNT(order_id) AS order_yes FROM tb_order t,order_detail od,product p WHERE t.order_id=od.id_order and od.id_pro=p.id_pro and id_user='$ids' and order_status='2'";
$hand2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_array($hand2);

//ยกเลิกการสั่งซื้อ
$sql0="SELECT COUNT(order_id) AS order_cancle FROM tb_order t,order_detail od,product p WHERE t.order_id=od.id_order and od.id_pro=p.id_pro and id_user='$ids' and order_status='0'";
$hand0=mysqli_query($conn,$sql0);
$row0=mysqli_fetch_array($hand0);

//สินค้าที่ต่ำกว่า 10
$sql4="SELECT COUNT(id_pro) AS pro_num from product WHERE amount < 10 and id_user='$ids'";
$hand4=mysqli_query($conn,$sql4);
$row4=mysqli_fetch_array($hand4);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Seller</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php
        include 'menu1.php';
        ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">รายการสั่งซื้อ (ยังไม่ชำระเงิน) <h4>[<?=$row1['order_no']?>]</h4></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="report_order.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">รายการสั่งซื้อ (ชำระเงินแล้ว) <h4>[<?=$row2['order_yes']?>]</h4></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="report_order_yes.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">รายการสั่งซื้อ (ยกเลิก) <h4>[<?=$row0['order_cancle']?>]</h4></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="report_order_no.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">รายการสินค้าที่น้อยกว่า 10 ชิ้น <h4>[<?=$row4['pro_num']?>]</h4></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="product_stock_less_10.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        จำนวนสินค้าคงเหลือ
                                    </div>
                                    <div class="card-body"><canvas id="graphCanvas" width="100%" height="40"></canvas></div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        ยอดเงินในแต่ละเดือน
                                    </div>
                                    <div class="card-body"><canvas id="graphCanvas1" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                รายการสินค้า
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>รูปภาพ</th>
                                            <th>รหัสสินค้า</th>
                                            <th>ชื่อสินค้า</th>
                                            <th>รายละเอียดสินค้า</th>
                                            <th>ประเภทสินค้า</th>
                                            <th>ราคา</th>
                                            <th>จำนวน</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>id_pro</th>
                                            <th>name_pro</th>
                                            <th>detail_pro</th>
                                            <th>name_type</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                    $sql="SELECT * FROM product p,type t WHERE p.id_type=t.id_type and id_user='$ids' and status_pro=1";
                                    $hand=mysqli_query($conn,$sql);
                                    while($row=mysqli_fetch_array($hand)){
                                    ?>
                                        <tr>
                                            <td><img src="../img/<?=$row['photo_pro']?>" width="100" height="100"></td>
                                            <td><?=$row['id_pro']?></td>
                                            <td><?=$row['name_pro']?></td>
                                            <td><?=$row['detail_pro']?></td>
                                            <td><?=$row['name_type']?></td>
                                            <td><?=$row['price_pro']?></td>
                                            <td><?=$row['amount']?></td>
                                        </tr>
                                        <?php
                                        }
                                        mysqli_close($conn);
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <?php
        include 'footer.php';
        ?>
            </div>
        </div>
        
    </body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        
<script type="text/javascript" src="chart_js/jquery.min.js"></script>
<script type="text/javascript" src="chart_js/Chart.min.js"></script>

    <script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("data_product.php",
                function (data)
                {
                    console.log(data);
                     var name = [];
                    var marks = [];

                    for (var i in data) {
                        name.push(data[i].name_pro);
                        marks.push(data[i].amount);
                    }

                    var chartdata = {
                        labels: name,
                        datasets: [
                            {
                                label: 'จำนวนสินค้าคงเหลือ',
                                backgroundColor: '#00FFF7',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: marks
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
            }
        }
        </script>
<!-- ยอดขายแต่ละเดือน -->
<script>
        $(document).ready(function () {
            showGraph1();
        });


        function showGraph1()
        {
            {
                $.post("data_sale.php",
                function (data)
                {
                    console.log(data);
                     var name = [];
                    var marks = [];

                    for (var i in data) {
                        name.push(data[i].dateMonth);
                        marks.push(data[i].sumtotal);
                    }

                    var chartdata = {
                        labels: name,
                        datasets: [
                            {
                                label: 'ยอดรวมแต่ละเดือน',
                                backgroundColor: '#0CFF00',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: marks
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas1");

                    var barGraph = new Chart(graphTarget, {
                        type: 'line',
                        data: chartdata
                    });
                });
            }
        }
        </script>