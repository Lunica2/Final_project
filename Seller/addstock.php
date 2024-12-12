<?php
include 'config.php';
$ids = $_GET['id'];
$sql = "SELECT * FROM product WHERE id_pro='$ids' ";
$hand = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($hand);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Stock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .alert {
            border-radius: 10px;
            text-align: center;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px;
        }

        .btn-success, .btn-danger {
            width: 100%;
            padding: 10px;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background-color: #218838;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #dc3545;
            color: #fff;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            padding: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-container {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-5">
            <div class="alert alert-success mt-4 h4" role="alert">
                เพิ่มจำนวนสินค้าในสต็อก
            </div>
            <div class="card">
                <form name="form1" method="POST" action="up_stock.php">
                    <div class="mb-3">
                        <label class="form-label">รหัสสินค้า:</label>
                        <input type="text" name="pid" class="form-control" readonly value="<?=$row['id_pro']?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ชื่อสินค้า:</label>
                        <input type="text" name="pname" class="form-control" readonly value="<?=$row['name_pro']?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">เพิ่มจำนวนสินค้า:</label>
                        <input type="number" name="pnum" class="form-control" required placeholder="จำนวนสินค้า">
                    </div>
                    <div class="btn-container">
                        <button type="submit" name="submit" class="btn btn-success">ยืนยัน</button>
                        <a href="add_amount_product.php" class="btn btn-danger">ยกเลิก</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>
</html>
