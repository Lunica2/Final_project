<?php
@include 'config.php';

session_start();
$ids=$_SESSION["se_id"];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>รายงานโปรโมชั่น</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php
        include 'menu1.php';
        ?>
            <div id="layoutSidenav_content">
                <main><br>
                    <div class="container-fluid px-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                รายการโปรโมชั่น
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>รหัสโปรโมชั่น</th>
                                            <th>รูปภาพโปรโมชั่น</th>
                                            <th>ชื่อสินค้า</th>
                                            <th>รายละเอียดโปรโมชั่น</th>
                                            <th>จำนวนสินค้า</th>
                                            <th>ราคาต่อเล่ม</th>
                                            <th>ระยะเวลาโปรโมชั่น</th>
                                            <th>แก้ไขสินค้า</th>
                                            <th>ลบสินค้า</th>
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
                                    $sql="SELECT * FROM promotion pro,user_form u WHERE pro.id_member=u.id_member and u.id_member='$ids'";
                                    $hand=mysqli_query($conn,$sql);
                                    while($row=mysqli_fetch_array($hand)){
                                    ?>
                                        <tr>
                                        <td><?=$row['id_promo']?></td>
                                            <td><img src="../img/<?=$row['photo_pro']?>" width="100" height="100"></td>
                                            <td><?=$row['name_pro']?></td>
                                            <td><?=$row['promo_detail']?></td>
                                            <td><?=$row['amount']?> เล่ม</td>
                                            <td><?=$row['price']?> บาท</td>
                                            <td><b class="text-danger"><?=$row['start_date'] ?></b> ถึง <b class="text-danger"><?=$row['end_date'] ?></b></td>
                                            <td><a href="edit_promo.php?id=<?=$row['id_promo']?>" class="btn btn-success">แก้ไขโปรโมชั่น</a></td>
                                            <td><a href="delete_promo.php?id=<?=$row['id_promo']?>" class="btn btn-danger">ลบโปรโมชั่น</a></td>
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