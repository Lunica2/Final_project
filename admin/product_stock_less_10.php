<?php
@include 'config.php';

session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>My Shop</title>
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
                                <h4 class="alert alert-warning">รายการสินค้าที่เหลือน้อยกว่า 10 ชิ้น</h4>
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
                                            <th>แก้ไขจำนวนสินค้า</th>
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
                                    $sql="SELECT * FROM product p,type t WHERE p.id_type=t.id_type and amount < 10 and status_pro=1";
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
                                            <td><a href="addstock.php?id=<?=$row['id_pro']?>" class="btn btn-success">เพิ่ม</a></td>
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