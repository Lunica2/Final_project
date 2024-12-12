<?php
@include 'config.php';

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f0f0f5;
        }
        .form-container {
            margin-top: 30px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .product-card {
            transition: transform 0.3s ease-in-out;
        }
        .product-card:hover {
            transform: translateY(-10px);
        }
        .btn-primary, .btn-outline-success, .btn-info {
            border-radius: 20px;
        }
        .btn-primary:hover, .btn-outline-success:hover, .btn-info:hover {
            background-color: #0056b3;
            color: white;
        }
        .product-image {
            transition: transform 0.3s ease-in-out;
        }
        .product-image:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
<?php include 'menu.php'; ?>
<div class="container">
  <div class="form-container">

    <form id="filterForm" method="POST" action="buyer.php">
      <div class="row">
        <div class="col-md-3">

          <input type="text" class="form-control" name="product_name" placeholder="ค้นหาชื่อสินค้า"> <br>

          <!-- เพิ่ม onchange="this.form.submit()" เพื่อให้ฟอร์มส่งทันทีเมื่อมีการเปลี่ยนประเภทสินค้า -->
          <select class="form-select" name="key_type" aria-label="Default select example" onchange="this.form.submit()">
            <?php
            $sql = "SELECT * FROM type ORDER BY name_type";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>
            <option value="<?= $row['id_type'] ?>" <?= isset($_POST['key_type']) && $_POST['key_type'] == $row['id_type'] ? 'selected' : '' ?>>ประเภทสินค้า: <?= $row['name_type'] ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <div class="col-md-1 text-end">
          <button type="submit" name="search_product" class="btn btn-primary">ค้นหา</button>
        </div>
        <div class="col-md-8 text-end">
          <a href="buyer.php" type="submit" name="button2" class="btn btn-secondary">สินค้าทั้งหมด</a>
        </div>
      </div>
    </form>
  </div>

  <div class="row mt-4">
    <?php
    // ดึงค่า key_type จาก POST เพื่อกรองตามประเภทสินค้า
    $keytype = @$_POST['key_type'];

    if (isset($_POST['key_type'])) {
      $sql = "SELECT * FROM product p, type t, user_form u WHERE p.id_type = t.id_type AND p.id_user = u.id_member AND p.id_type = '$keytype' AND status_pro = 1 ORDER BY id_pro";
    } else if (isset($_POST['button2'])) {
      $sql = "SELECT * FROM product p, type t, user_form u WHERE p.id_type = t.id_type AND p.id_user = u.id_member AND status_pro = 1 ORDER BY id_pro";
    } else {
      $sql = "SELECT * FROM product p, type t, user_form u WHERE p.id_type = t.id_type AND p.id_user = u.id_member AND status_pro = 1 ORDER BY id_pro";
    }

    if (isset($_POST['search_product'])) {
        $product_name = $_POST['product_name'];

        $sql = "SELECT * FROM product p, user_form u 
                WHERE p.id_user = u.id_member 
                AND status_pro = 1 
                AND p.name_pro LIKE '%$product_name%' 
                ORDER BY id_pro";
    }

    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
      $amount1 = $row['amount'];
      $image1 = $row['photo_pro'];
    ?>
    <div class="col-sm-3">
      <div class="card product-card">
        <div class="text-center">
          <?php if($image1 == ""){ ?>
            <img src="img/no_image.png" width="200px" height="250" class="product-image mt-4 p-2 my-2 border"> <br>
          <?php } else { ?>
            <img src="img/<?=$row['photo_pro']?>" width="200px" height="250" class="product-image mt-4 p-2 my-2 border"> <br>
          <?php } ?>
        </div>
        <div class="card-body text-center">
          <h6 class="text-success"><?=$row['name_pro']?></h6>
          <p>ประเภทสินค้า : <b class="text-success"><?=$row['name_type']?></b></p>
          <p>ราคา: <b class="text-danger"><?=$row['price_pro']?></b> บาท</p>
          <p>มีจำนวน: <b class="text-danger"><?=$row['amount']?></b> เล่ม</p>
          <p>จากร้าน: <b class="text-info"><?=$row['name']?></b></p>
          <?php if($amount1 <= 0){ ?>
            <a class="btn btn-danger mt-2 disabled" href="#">สินค้าหมด</a>
            <a class="btn btn-info mt-2" href="pre_detail_product.php?id=<?=$row['id_pro']?>">Pre Order</a>
          <?php } else { ?>
            <a class="btn btn-outline-success mt-2" href="detail_product.php?id=<?=$row['id_pro']?>">รายละเอียด</a>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php
    }
    mysqli_close($conn);
    ?>
  </div>
</div>
</body>
</html>