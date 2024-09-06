<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
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
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>เลขที่ข้อเสนอ</th>
                                            <th>ชื่อสินค้า</th>
                                            <th>ชื่อผู้จัดข้อเสนอ</th>
                                            <th>ที่อยู่ - จัดส่ง</th>
                                            <th>รหัสไปรษณีย์</th>
                                            <th>จำนวนที่สั่งซื้อ</th>
                                            <th>ราคารวมสุทธิ</th>
                                            <th>สถานะ</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
<?php
$sql = "select * from offer o,product p,user_form u where o.id_pro=p.id_pro and o.id_member=u.id_member and offer_status='0' order by id_offer";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){
$status = $row['offer_status'];
$total = $row['price'] * $row['amount_offer'];
?>
                                    
                                        <tr>
                                            <td><?=$row['id_offer']?></td>
                                            <td><?=$row['name_pro']?></td>
                                            <td><?=$row['name']?></td>
                                            <td><?=$row['address']?></td>
                                            <td><?=$row['zipcode']?></td>
                                            <td><?=$row['amount_offer']?></td>
                                            <td><?=$total-($total * $row['discount'])/100?></td>
                                            <td>
                                            <?php
                                        if($status == 1){
                                            echo "ยังไม่ชำระเงิน";
                                        }else if($status == 0){
                                            echo "<b style='color:green '> ชำระเงินแล้ว </b> ";
                                        }else if($status == 3){
                                            echo "<b style='color:red '> ยกเลิกการสั่งซื้อ </b> ";
                                        }
                                            ?>

                                            </td>
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