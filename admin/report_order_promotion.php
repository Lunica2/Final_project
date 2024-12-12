<?php
@include 'config.php';

session_start();
$ids=$_SESSION["ad_id"];

if(!isset($_SESSION["admin"]))
header("location:login.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>รายงานคำสั่งซื้อ โปรโมชั่น</title>
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
                                แสดงข้อมูลการสั่งซื้อสินค้า Promotion
                            <div> <br>
<form name="form1" method="POST" action="report_order_promotion.php">
<div class="row">
    <div class="col-sm-2">
      <input type="date" name="dt1" class="form-control">
    </div>
    <div class="col-sm-2">
    <input type="date" name="dt2" class="form-control">
    </div>
    <div class="col-sm-4">
    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
    </div>
  </div>
                            </form>

                            </div>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ชื่อลูกค้า</th>
                                            <th>ชื่อสินค้า</th>
                                            <th>ที่อยู่ - จัดส่ง</th>
                                            <th>รหัสไปรษณีย์</th>
                                            <th>ราคารวมสุทธิ</th>
                                            <th>วันที่สั่งซื้อ</th>
                                            <th>จำนวน</th>
                                            <th>รายละเอียด</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>order_id</th>
                                            <th>cus_name</th>
                                            <th>address</th>
                                            <th>telephone</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
<?php
$ddt1=@$_POST['dt1'];
$ddt2=@$_POST['dt2'];
$add_date= date('Y/m/d', strtotime($ddt2 . "+1 days"));

if(($ddt1 != "") & ($ddt2 != "")){
    echo "ค้นหาจากวันที่ $ddt1 ถึง $ddt2 " ;
    $sql = "select * FROM order_promo op,promotion po,payment_promo pp,user_form u WHERE op.id_promo=po.id_promo and op.id_order_promo=pp.id_order_promo and op.id_member=u.id_member and pp.pay_date BETWEEN '$ddt1' and '$add_date'
    GROUP BY pp.id_order_promo order by pp.pay_date DESC";
}else{
    $sql = "select * FROM order_promo op,promotion po,payment_promo pp,user_form u WHERE op.id_promo=po.id_promo and op.id_order_promo=pp.id_order_promo and op.id_member=u.id_member GROUP BY pp.id_order_promo order by pp.pay_date DESC";
}

$hand=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($hand)){
?>
                                    
                                    <tr>
                                        <td><?=$row['name']?></td>
                                        <td><?=$row['name_pro']?></td>
                                        <td><?=$row['address']?></td>
                                        <td><?=$row['zipcode']?></td>
                                        <td><?= $row['price'] * $row['amount_promo'] ?> บาท</td>
                                        <td><?=$row['pay_date']?></td>
                                        <td><?=$row['amount_promo']?> เล่ม</td>
                                        <td><a href="report_promo_detail.php?id=<?=$row['id_order_promo']?>" class="btn btn-success">รายละเอียด</a></td>
                                    </tr>
                                    
                                    <?php
                                    }
                                    mysqli_close($conn);
                                    ?>
                                    
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
<script>