<?php
include 'config.php';
session_start();

$ids=$_GET['id'];
$sql1 = "SELECT * FROM order_promo op, payment_promo pp WHERE op.id_order_promo=pp.id_order_promo and op.id_order_promo = '$ids' ";

$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_array($result1);
$image_bill=$row1['pay_image'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>รายงานรายละเอียดโปรโมชั่น</title>
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
                        <div class="card mb-4 mt-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                แสดงการชำระสินค้า Promotion
                                
                            <div>
                                <br>
                            <a href="report_order_promotion.php" > <button type="button" class="btn btn-secondary">ย้อนกลับ</button> </a>
                            </div>
                            <br>
                            </div>
                            <div class="card-body">
                                <h5>เลขที่ใบสั่งซื้อ Promotion : <?=$ids?></h5>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>รหัสสินค้า Promotion</th>
                                            <th>ชื่อสินค้า</th>
                                            <th>ราคาสินค้า</th>
                                            <th>จำนวน</th>
                                            <th>ราคารวม</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php

$sql = "select * FROM order_promo op,promotion po,payment_promo pp WHERE op.id_promo=po.id_promo and op.id_order_promo=pp.id_order_promo and pp.id_order_promo='$ids' GROUP BY pp.id_order_promo";
$result=mysqli_query($conn,$sql);
$sum_total=0;
while($row=mysqli_fetch_array($result)){
    $sum_total=$row['price'] * $row['amount_promo']
?>
                                    
                                        <tr>
                                            <td><?=$row['id_order_promo']?></td>
                                            <td><?=$row['name_pro']?></td>
                                            <td><?= $row['price']?> บาท</td>
                                            <td><?=$row['amount_promo']?> เล่ม</td>
                                            <td><?=$row['price'] * $row['amount_promo']?> บาท</td>
                                        
                                        </tr>
                                    
                                    <?php
                                    }
                                    mysqli_close($conn);
                                    ?>
                                    
                                </table>
                                <b>ราคารวมสุทธิ <?=number_format($sum_total,2)?> บาท</b>
                            </div>
                        </div>
                        <div>
                            <?php
                            if($image_bill <> ""){ ?>
                            <h5>ชำระเงินแล้ว</h5>
                            <img src="../img/payment_promo/<?=$row1['pay_image']?>" width="300px">
                            <?php }else{ ?>
                                <h5>ยังไม่ชำระเงิน</h5>
                            <?php } ?>
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
<script>