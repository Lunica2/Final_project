<?php
include 'config.php';

session_start();
?>
<?php
$proID=$_GET['id'];
$sql1="SELECT * FROM promotion WHERE id_promo='$proID' ";
$hand=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_array($hand);
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
                                แก้ไขข้อมูลโปรโมชั่น
                                 <br>
                            <div>

                            </div>
                            
                            <div class="card-body">
                            <form name="form1" method="post" action="update_promotion.php" enctype="multipart/form-data">
                    <label>รหัสโปรโมชั่น: </label>
                    <input type="text" name="pid" class="form-control" readonly value=<?=$row1['id_promo']?>> <br>
                    <label>ชื่อสินค้า: </label>
                    <textarea name="pname" class="form-control" ><?=$row1['name_pro']?></textarea> <br>

                    <label>จำนวนสินค้า: </label>
                    <input type="number" name="amount" class="form-control" value=<?=$row1['amount']?>> <br>

                    <label>ราคา: </label>
                    <input type="number" name="price" class="form-control" value=<?=$row1['price']?>> <br>
                    
                    <img src="../img/<?=$row1['photo_pro']?>" width="100" height="100">
                    <label>รูปภาพ: </label>
                    <input type="file" name="file1" ><br>
                    <input type="hidden" name="txtimg" class="form-control" value=<?=$row1['photo_pro']?> > <br>
                    <label>รายละเอียด: </label>
                    <textarea name="detail" class="form-control" ><?=$row1['promo_detail']?></textarea> <br>

                    <div class="form-group">
    <label for="startDate">แก้ไขวันที่เริ่มต้น:</label>
    <input type="date" name="start_date" id="startDate" value=<?=$row1['start_date']?> required>
</div> <br>

<div class="form-group">
    <label for="endDate">แก้ไขวันที่สิ้นสุด:</label>
    <input type="date" name="end_date" id="endDate" value=<?=$row1['end_date']?> required>
</div> <br>

                    <button type="submit" class="btn btn-primary">ยืนยัน</button>
                    <a class="btn btn-danger" href="report_promotion.php" role="button">ยกเลิก</a>
                </form>
                                
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

<?php
 mysqli_close($conn);
 ?>