<?php
include 'config.php';
$ids=$_GET['id'];
$sql="SELECT * FROM product WHERE id_pro='$ids' ";
$hand=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($hand);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AddStock</title>

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-5">

            <div class="alert alert-success mt-4 h3" role="alert">
                เพิ่มจำนวนสินค้าในสต็อก
            </div>
        <form name="form1" method="POST" action="up_stock.php">
            <div class="mb-3 mt-3">
                <label>รหัสสินค้า:</label>
                <input type="text" name="pid" class="form-control" readonly value="<?=$row['id_pro']?>">
            </div>
            <div class="mb-3">
                <label>ชื่อสินค้า:</label>
                <input type="text" name="pname" class="form-control" readonly value="<?=$row['name_pro']?>">
                </div>
            <div class="mb-3">
                <label>เพิ่มจำนวนสินค้า:</label>
                <input type="text" name="pnum" class="form-control" required >
                </div>
                <input type="submit" name="submit" class="btn btn-success" value="Submit">
                <a href="add_amount_product.php" class="btn btn-danger">Cancel</a>
        </form>
        </div>
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