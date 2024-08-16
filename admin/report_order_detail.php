<?php
include 'config.php';
session_start();

$ids=$_GET['id'];
$sql1 = "SELECT * FROM tb_order t, payment m WHERE t.order_id=m.order_id and t.order_id = '$ids' ";

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
        <title>report</title>
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
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-2"></i>
                                แสดงรายการสินค้า
                            <div>
                                <br>
                            <a href="report_order.php" > <button type="button" class="btn btn-secondary">ย้อนกลับ</button> </a>
                            
                            </div>
                            <br>
                            </div>
                            <div class="card-body">
                                <h5>เลขที่ใบสั่งซื้อ : <?=$ids?></h5>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ชื่อลูกค้า</th>
                                            <th>รหัสสินค้า</th>
                                            <th>ชื่อสินค้า</th>
                                            <th>ราคา</th>
                                            <th>จำนวน</th>
                                            <th>ราคารวม</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php

$sql = "select * from order_detail d , product p, tb_order t where d.id_order=t.order_id
and d.id_pro=p.id_pro and d.id_order='$ids' order by d.id_pro ";
$result=mysqli_query($conn,$sql);
$sum_total=0;
while($row=mysqli_fetch_array($result)){
    $sum_total=$row['total_price'];
?>
                                    
                                        <tr>
                                            <td><?=$row['cus_name']?></td>
                                            <td><?=$row['id_pro']?></td>
                                            <td><?=$row['name_pro']?></td>
                                            <td><?=$row['price_pro']?></td>
                                            <td><?=$row['item_amount']?></td>
                                            <td><?=$row['total']?></td>
                                        
                                        </tr>
                                    
                                    <?php
                                    }
                                    mysqli_close($conn);
                                    ?>
                                    
                                </table>
                                <b>ราคารวมสุทธิ <?=number_format($sum_total,2)?> บาท</b>
                                <a href="print_order.php?id=<?=$ids?>" > <button type="button" class="btn btn-success">ดูใบเสร็จ</button> </a>
                            </div>
                        </div>
                        <div>
                            <?php
                            if($image_bill <> ""){ ?>
                            <h5>ชำระเงินแล้ว</h5>
                            <img src="../img/payment/<?=$row1['pay_image']?>" width="300px">
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