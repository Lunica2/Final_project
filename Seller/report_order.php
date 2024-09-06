<?php
@include 'config.php';

session_start();
$ids=$_SESSION["se_id"];

if(!isset($_SESSION["Seller"]))
header("location:login.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
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
                        

                        <div class="card mb-4 mt-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                แสดงข้อมูลการสั่งซื้อสินค้า (ยังไม่ชำระเงิน)
                            <div>
                                <br>
                            <a href="report_order.php" > <button type="button" class="btn btn-secondary">ยังไม่ชำระเงิน</button> </a>
                            <a href="report_order_yes.php" > <button type="button" class="btn btn-success">ชำระเงินแล้ว</button> </a>
                            <a href="report_order_no.php" > <button type="button" class="btn btn-danger">ยกเลิกการสั่งซื้อ</button> </a>
                            </div>
                            <br>
                            <div>
<form name="form1" method="POST" action="report_order.php">
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
                                            <th>เลขที่ใบสั่งซื้อ</th>
                                            <th>ชื่อลูกค้า</th>
                                            <th>ที่อยู่ - จัดส่ง</th>
                                            <th>เบอร์โทรศัพท์</th>
                                            <th>ราคารวมสุทธิ</th>
                                            <th>วันที่สั่งซื้อ</th>
                                            <th>จำนวน</th>
                                            <th>สถานะ</th>
                                            <th>รายละเอียด</th>
                                            <th>ปรับสถานะ</th>
                                            <th>ยกเลิก</th>
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
    $sql = "select * from tb_order t,user_form u ,order_detail od,product p where t.id=u.id_member and t.order_id=od.id_order and od.id_pro=p.id_pro and u.id_member='$ids' t.order_status='1' or t.order_status='3' and reg_date BETWEEN '$ddt1' and '$add_date'
    group by t.order_id order by reg_date DESC";
}else{
    $sql = "select * from tb_order t,user_form u ,order_detail od,product p where t.id=u.id_member and t.order_id=od.id_order and od.id_pro=p.id_pro and u.id_member='$ids' and t.order_status='1' or t.order_status='3' group by t.order_id order by reg_date DESC";
}

$hand=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($hand)){
$status = $row['order_status'];
?>
                                    
                                        <tr>
                                            <td><?=$row['order_id']?></td>
                                            <td><?=$row['cus_name']?></td>
                                            <td><?=$row['address']?></td>
                                            <td><?=$row['telephone']?></td>
                                            <td><?=$row['total_price']?></td>
                                            <td><?=$row['reg_date']?></td>
                                            <td><?=$row['item_amount']?></td>
                                            <td>
                                            <?php
                                        if($status == 1){
                                            echo "ยังไม่ชำระเงิน";
                                        }else if($status == 2){
                                            echo "<b style='color:green '> ชำระเงินแล้ว </b> ";
                                        }else if($status == 0){
                                            echo "<b style='color:red '> ยกเลิกการสั่งซื้อ </b> ";
                                        }else if($status == 3){
                                            echo "<b style='color:blue '> รอตรวจสอบ </b> ";
                                        }
                                            ?>

                                            </td>
                                            <td><a href="report_order_detail.php?id=<?=$row['order_id']?>" class="btn btn-success">รายละเอียด</a></td>
                                            <td><a href="pay_order.php?id=<?=$row['order_id']?>" class="btn btn-warning">ปรับสถานะ</a></td>
                                            <td><a href="cancel_order.php?id=<?=$row['order_id']?>?ia=<?=$row['item_amount']?>?ip=<?=$row['id_pro']?>" class="btn btn-danger">ยกเลิก</a></td>
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