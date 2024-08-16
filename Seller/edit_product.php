<?php
include 'config.php';

session_start();
?>
<?php
$proID=$_GET['id'];
$sql1="SELECT * FROM product WHERE id_pro='$proID' ";
$hand=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_array($hand);
$Ptype_id=$row1['id_type'];
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
                                แก้ไขข้อมูลสินค้า
                                 <br>
                            <div>

                            </div>
                            
                            <div class="card-body">
                            <form name="form1" method="post" action="update_product.php" enctype="multipart/form-data">
                    <label>รหัสสินค้า: </label>
                    <input type="text" name="pid" class="form-control" readonly value=<?=$row1['id_pro']?>> <br>
                    <label>ชื่อสินค้า: </label>
                    <textarea name="pname" class="form-control" ><?=$row1['name_pro']?></textarea> <br>
                    <label>ประเภทสินค้า: </label>
                    <select class="form-select" name="typeID">
                    <?php
                    $sql = "SELECT * FROM type ORDER BY id_type";
                    $hand=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_array($hand)){
                        $Ttype_id=$row['id_type']
                    ?>
                        <option value="<?=$row['id_type']?>"<?php if($Ttype_id == $Ptype_id){echo "SELECTED=SELECTED";}?>>
                        <?=$row['name_type']?></option>
                        <?php
                        }

                        ?>
                    </select> <br>
                    <label>ราคา: </label>
                    <input type="number" name="price" class="form-control" value=<?=$row1['price_pro']?>> <br>
                    <label>จำนวน: </label>
                    <input type="number" name="amount" class="form-control" value=<?=$row1['amount']?> > <br>
                    
                    <img src="../img/<?=$row1['photo_pro']?>" width="100" height="100">
                    <label>รูปภาพ: </label>
                    <input type="file" name="file1" ><br>
                    <input type="hidden" name="txtimg" class="form-control" value=<?=$row1['photo_pro']?> > <br>
                    <label>รายละเอียด: </label>
                    <textarea name="detail" class="form-control" ><?=$row1['detail_pro']?></textarea> <br>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-danger" href="stock_product.php" role="button">Cancel</a>
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