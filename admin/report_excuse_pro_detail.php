<?php
include 'config.php';
session_start();

$ids=$_GET['id'];
$sql1 = "SELECT * FROM product p, user_form u WHERE p.id_user=u.id_member and p.id_pro = '$ids' ";

$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_array($result1);
$image_pro=$row1['photo_pro'];
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
        <style>
          .viewer {
            position: relative;
        }
        .viewer img {
            max-width: 100%;
            max-height: 80vh;
            transition: transform 0.25s ease;
            cursor: zoom-in;
        }
        .controls {
            display: flex;
            margin-top: 10px;
        }
        .controls button {
            padding: 10px;
            margin: 0 5px;
        }
</style>
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
                            <a href="report_excuse_product.php"> <button type="button" class="btn btn-secondary">ย้อนกลับ</button> </a>
                            </div>
                            <br>
                            </div>
                            <div class="card-body">
                                <h5>รหัสสินค้า : <?=$ids?></h5>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ชื่อผู้ขาย</th>
                                            <th>รหัสสินค้า</th>
                                            <th>ชื่อสินค้า</th>
                                            <th>ราคา</th>
                                            <th>จำนวน</th>
                                            <th>รายละเอียดสินค้า</th>
                                            <th>ประเภทสินค้า</th>
                                            <th>สถานะการอนุญาต</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php

$sql = "SELECT * FROM product p, user_form u,type t WHERE p.id_user=u.id_member and p.id_type=t.id_type and p.id_pro='$ids' order by p.id_pro ";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){
$status = $row['status_pro'];
?>
                                        <tr>
                                            <td><?=$row['name']?></td>
                                            <td><?=$row['id_pro']?></td>
                                            <td><?=$row['name_pro']?></td>
                                            <td><?=$row['price_pro']?></td>
                                            <td><?=$row['amount']?></td>
                                            <td><?=$row['detail_pro']?></td>
                                            <td><?=$row['name_type']?></td>
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
                                        </tr>
                                    

                                    
                                </table>
                            </div>
                        </div>
                        <div>
                            <?php
                            if($image_pro <> ""){ ?>
                            <h5>รูปภาพสินค้า</h5>
                            <img src="../img/<?=$row1['photo_pro']?>" width="300px">
                            <?php }else{ ?>
                                <h5>ไม่มีรูปภาพ</h5>
                            <?php } ?>
                        </div>
                        <div>ตัวอย่างสินค้า</div>
  <?php
  $sql="SELECT * FROM product_images WHERE id_pro='$ids' ORDER BY id_photo";
  $hand=mysqli_query($conn,$sql);
  While($row1=mysqli_fetch_array($hand)){
  ?>
  <img src="../img/product_img/<?=$row1['file_name']?>" width="250px" height="300" class="mt-2 p-2 my-2 border">
  <?php
  }
  ?>
                                      <?php
                                    }
                                    mysqli_close($conn);
                                    ?>
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