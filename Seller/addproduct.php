<?php
include 'config.php';
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
                                เพิ่มสินค้า
                                 <br>
                            <div>

                            </div>
                            <div class="card-body">
                            <form name="form1" method="post" action="insert_product.php" enctype="multipart/form-data">
                    <label>ชื่อสินค้า: </label>
                    <input type="text" name="pname" class="form-control" placeholder="ชื่อสินค้า..." required> <br>
                    <label>ประเภทสินค้า: </label>
                    <select class="form-select" name="typeID">
                    <?php
                    $sql = "SELECT * FROM type ORDER BY id_type";
                    $hand=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_array($hand)){
                    ?>
                        <option value="<?=$row['id_type']?>"><?=$row['name_type']?></option>
                        <?php
                        }
                        mysqli_close($conn);
                        ?>
                    </select><br>
                    <label>ราคา: </label>
                    <input type="number" name="price" class="form-control" placeholder="ราคา..." required> <br>
                    <label>จำนวน: </label>
                    <input type="number" name="amount" class="form-control" placeholder="จำนวน..." required> <br>
                    <label>รูปภาพ: </label>
                    <input type="file" name="file1" required ><br> <br>
                    <label>รูปภาพหน้าหนังสือ: </label>
                    <input type="file" name="images[]" accept="image/*" multiple> <br> <br>
                    <label>รายละเอียด: </label>
                    <textarea type="text" name="detail" class="form-control" placeholder="รายละเอียด..." required> </textarea> <br>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-danger" href="addproduct.php" role="button">Cancel</a>
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
<script>