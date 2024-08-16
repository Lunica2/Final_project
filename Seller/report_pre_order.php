<?php
include 'config.php';

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
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>รายงานการ Pre Order</title>
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
                                แสดงข้อมูลการ Pre Order (ยังไม่ชำระเงิน)
                                
                            <div>
                                <br>
                            <a href="report_pre_order.php" > <button type="button" class="btn btn-secondary">ยังไม่ชำระเงิน</button> </a>
                            <a href="report_pre_order_yes.php" > <button type="button" class="btn btn-success">ชำระเงินแล้ว</button> </a>
                            <a href="report_pre_order_no.php" > <button type="button" class="btn btn-danger">ยกเลิกการสั่งซื้อ</button> </a>
                            </div>
                            <br>
                            <div>
<form name="form1" method="POST" action="report_pre_order.php">
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
                                            <th>เลขที่การ Pre Order</th>
                                            <th>เลขที่ลุกค้า</th>
                                            <th>ชื่อลูกค้า</th>
                                            <th>ที่อยู่ - จัดส่ง</th>
                                            <th>ราคารวมสุทธิ</th>
                                            <th>วันที่สั่งซื้อ</th>
                                            <th>สถานะ</th>
                                            <th>รายละเอียด</th>
                                            <th>ปรับสถานะ</th>
                                            <th>ยกเลิก</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>id_pre</th>
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
    $sql = "select * from pre_order po,user_form u ,pre_order_detail pod,product p where po.id_member=u.id and po.id_pre=pod.id_pre and pod.id_pro=p.id_pro and id_user='$ids' and pre_status='1' or pre_status='3' and time_pre BETWEEN '$ddt1' and '$add_date'
    group by po.id_pre order by reg_date DESC";
}else{
    $sql = "select * from pre_order po,user_form u ,pre_order_detail pod,product p where po.id_member=u.id and po.id_pre=pod.id_pre and pod.id_pro=p.id_pro and id_user='$ids' and pre_status='1' or pre_status='3' group by po.id_pre order by time_pre DESC";
}

$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){
$status = $row['pre_status'];
?>
                                    
                                        <tr>
                                            <td><?=$row['id_pre']?></td>
                                            <td><?=$row['id_member']?></td>
                                            <td><?=$row['name']?></td>
                                            <td><?=$row['address']?></td>
                                            <td><?=$row['total_price_pre']?></td>
                                            <td><?=$row['time_pre']?></td>
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
                                            <td><a href="report_pre_order_detail.php?id=<?=$row['id_pre']?>" class="btn btn-success">รายละเอียด</a></td>
                                            <td><a href="pay_pre_order.php?id=<?=$row['id_pre']?>" class="btn btn-warning">ปรับสถานะ</a></td>
                                            <td><a href="cancel_pre_order.php?id=<?=$row['id_pre']?>" class="btn btn-danger">ยกเลิก</a></td>
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