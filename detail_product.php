<?php
@include 'config.php';

session_start();
if(!isset($_SESSION["bu_username"]))
header("location:login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Product</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script></head>
<style>
    body{
    background-color: #f0f0f5;
    }
</style>
</head>
<body>
<?php include 'menu.php'; ?>
<div class="container">
  <div class="row">
  <?php
  $ids=$_GET['id'];
$sql = "SELECT * FROM product,type,user_form WHERE product.id_type=type.id_type and product.id_user=user_form.id_member and product.id_pro='$ids'";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$image1=$row['photo_pro'];
    ?>
    <div class="col-md-4">
    <?php if($image1 == ""){ ?>
  <img src="img/no_image.png" width="250px" height="300" class="mt-5 p-2 my-2 border"> <br>
<?php }else{ ?>
  <img src="img/<?=$row['photo_pro']?>" width="250px" height="300" class="mt-5 p-2 my-2 border"> <br>
<?php }
  ?> <br>
   </div>
   <div class="col-md-8">
        <br><br>
    ID: <?=$row['id_pro']?> <br>
    <h5 class="text-success"><?=$row['name_pro']?></h5>
    ประเภทสินค้า: <?=$row['name_type']?> <br>
    ราคา: <b class="text-danger"><?=$row['price_pro']?> </b> บาท <br>
    มีจำนวน: <b class="text-danger"><?=$row['amount']?> </b> เล่ม <br>
    จากร้าน: <b class="text-info"><?=$row['username']?> </b><br>
    รายละเอียด: <?=$row['detail_pro']?> <br>
    <a class="btn btn-outline-success mt-2" href="order.php?id=<?=$row['id_pro']?>">เพิ่มสินค้าลงตะกร้า</a>
    <a class="btn btn-outline-info mt-2" href="offer.php?id=<?=$row['id_pro']?>">จัดข้อเสนอ</a>
    </div>
  <?php
  echo "<h3>ตัวอย่างสินค้า"."</h4>";
  $sql="SELECT * FROM product_images WHERE id_pro='$ids' ORDER BY id_photo";
  $hand=mysqli_query($conn,$sql);
  While($row1=mysqli_fetch_array($hand)){
  ?>
  <div class="col-md-3">
  <img src="./img/product_img/<?=$row1['file_name']?>" width="250px" height="300" class="mt-2 p-2 my-2 border">
  </div>
  <?php
  }
  ?>
  </div> <br> <br>
  <?php
  $sql = "SELECT * FROM review_table rt,user_form u WHERE rt.user_id=u.id_member and id_pro=$ids";
$result = $conn->query($sql);
echo "<h2>รีวิวสินค้า"."</h2> <br>" ;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      
        echo "<h4>ชื่อผู้รีวิว: ". $row["username"] . "</h4>";
        echo "<p>คะแนน: ";

        // แสดงผลดาวตามคะแนน
        for ($i = 0; $i < $row["user_rating"]; $i++) {
            echo "⭐";
        }
        echo "</p>";
        echo "<p>" . $row["user_review"] . "</p>";
        echo "<hr>";
    }
} else {
    echo "<h3>ไม่มีการรีวิว"."</h4>";
}
?>
</div>
<?php
mysqli_close($conn);
?>
</body>
</html>