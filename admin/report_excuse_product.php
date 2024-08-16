<?php
include 'config.php';
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
                        
                        <div class="card mb-4 mt-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                แสดงข้อมูลการขออนุญาตขายสินค้า (ยังไม่อนุญาต)
                            <div>
                                <br>
                            <a href="report_excuse_product.php" > <button type="button" class="btn btn-secondary">ยังไม่อนุญาต</button> </a>
                            <a href="report_excuse_product_yes.php" > <button type="button" class="btn btn-success">อนุญาตแล้ว</button> </a>
                            <a href="report_excuse_product_no.php" > <button type="button" class="btn btn-danger">ยกเลิกการอนุญาต</button> </a>
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
                                            <th>รหัสสินค้า</th>
                                            <th>ชื่อสินค้า</th>
                                            <th>ราคาสินค้า</th>
                                            <th>จำนวน</th>
                                            <th>ชื่อผู้ขาย</th>
                                            <th>สถานะ</th>
                                            <th>รายละเอียด</th>
                                            <th>อนุญาต</th>
                                            <th>ยกเลิก</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        </tr>
                                    </tfoot>
                                    <tbody>
<?php
$sql = "select * from product p,user_form u where p.id_user=u.id and status_pro='2' order by id_pro DESC";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){
$status = $row['status_pro'];
?>
                                    
                                        <tr>
                                            <td><?=$row['id_pro']?></td>
                                            <td><?=$row['name_pro']?></td>
                                            <td><?=$row['price_pro']?></td>
                                            <td><?=$row['amount']?></td>
                                            <td><?=$row['name']?></td>
                                            <td>
                                            <?php
                                        if($status == 1){
                                            echo "<b style='color:green '> วางขายแล้ว </b> ";
                                        }else if($status == 2){
                                            echo "<b style='color:blue '> รอตรวจสอบ </b> ";
                                        }else if($status == 0){
                                            echo "<b style='color:red '> ไม่อนุญาต </b> ";
                                        }
                                            ?>
                                            <td><a href="report_excuse_pro_detail.php?id=<?=$row['id_pro']?>" class="btn btn-warning">รายละเอียด</a></td>
                                            <td><a href="allow_excuse_pro.php?id=<?=$row['id_pro']?>" class="btn btn-success">อนุญาต</a></td>
                                            <td><a href="cancel_excuse_pro.php?id=<?=$row['id_pro']?>" class="btn btn-danger">ยกเลิก</a></td>
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