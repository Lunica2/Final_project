<?php
@include 'config.php';

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดสินค้า</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f0f0f5;
        }
        .product-image {
            transition: transform 0.3s ease-in-out;
        }
        .product-image:hover {
            transform: scale(1.05);
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .card-body {
            padding: 20px;
        }
        .btn-outline-success, .btn-outline-info {
            border-radius: 20px;
        }
        .btn-outline-success:hover, .btn-outline-info:hover {
            background-color: #0056b3;
            color: white;
        }
    </style>
</head>
<body>
<?php include 'menu.php'; ?>
<div class="container mt-4">
    <div class="row">
        <?php
        $ids = $_GET['id'];
        $sql = "SELECT * FROM product, type, user_form WHERE product.id_type=type.id_type AND product.id_user=user_form.id_member AND product.id_pro='$ids'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $image1 = $row['photo_pro'];
        ?>
        <div class="col-md-4">
            <div class="card">
                <img src="<?= $image1 == "" ? 'img/no_image.png' : 'img/'.$row['photo_pro'] ?>" class="product-image card-img-top" alt="Product Image">
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-success"><?= $row['name_pro'] ?></h5>
                    <p><strong>ID:</strong> <?= $row['id_pro'] ?></p>
                    <p><strong>ประเภทสินค้า:</strong> <?= $row['name_type'] ?></p>
                    <p><strong>ราคา:</strong> <span class="text-danger"><?= $row['price_pro'] ?> </span> บาท</p>
                    <p><strong>จำนวน:</strong> <span class="text-danger"><?= $row['amount'] ?> </span> เล่ม</p>
                    <p><strong>จากร้าน:</strong> <span class="text-info"><?= $row['username'] ?></span></p>
                    <p><strong>รายละเอียด:</strong> <?= $row['detail_pro'] ?></p>
                    <a class="btn btn-outline-success mt-2" href="order.php?id=<?= $row['id_pro'] ?>">เพิ่มสินค้าลงตะกร้า</a>
                    <a class="btn btn-outline-info mt-2" href="offer.php?id=<?= $row['id_pro'] ?>">จัดข้อเสนอ</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <h2>ตัวอย่างสินค้า</h2>
        <?php
        $sql = "SELECT * FROM product_images WHERE id_pro='$ids' ORDER BY id_photo";
        $hand = mysqli_query($conn, $sql);
        while ($row1 = mysqli_fetch_array($hand)) {
        ?>
        <div class="col-md-3">
            <div class="card">
                <img src="./img/product_img/<?= $row1['file_name'] ?>" class="product-image card-img-top" alt="Product Image">
            </div>
        </div>
        <?php
        }
        ?>
    </div>
    <div class="row mt-4">
        <?php
        $sql = "SELECT * FROM review_table rt, user_form u WHERE rt.user_id=u.id_member AND id_pro=$ids";
        $result = $conn->query($sql);
        echo "<h2>รีวิวสินค้า</h2>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='card mb-3'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>ชื่อผู้รีวิว: ". $row["username"] . "</h5>";
                echo "<p class='card-text'>คะแนน: ";
                for ($i = 0; $i < $row["user_rating"]; $i++) {
                    echo "⭐";
                }
                echo "</p>";
                echo "<p class='card-text'>" . $row["user_review"] . "</p>";
                echo "</div></div>";
            }
        } else {
            echo "<h3>ไม่มีการรีวิว</h3>";
        }
        ?>
    </div>
</div>
<?php
mysqli_close($conn);
?>
</body>
</html>