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
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script></head>
    <style>
body{
    background-color: #f0f0f5;
}
    </style>
<body>
<?php include 'menu.php'; ?>
<?php include 'header.php'; ?>
<div class="container" style="background-color: #ffffff;">
  <br>
  <div class="row">
    <?php
$sql = "SELECT * FROM product p,type t ,user_form u WHERE p.id_type=t.id_type and p.id_user=u.id and status_pro=1 ORDER BY id_pro limit 8";
$result = mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){
$amount1=$row['amount'];
$image1=$row['photo_pro'];
    ?>
    <div class="col-sm-3">  
      <div class="text-center">
      <?php if($image1 == ""){ ?>
  <img src="img/no_image.png" width="200px" height="250" class="mt-5 p-2 my-2 border"> <br>
<?php }else{ ?>
  <img src="img/<?=$row['photo_pro']?>" width="200px" height="250" class="mt-5 p-2 my-2 border"> <br>
<?php }
  ?>
      ID: <?=$row['id_pro']?> <br>
      <h6 class="text-success"><?=$row['name_pro']?></h6>
      <h6 class="text-primary"><?=$row['name_type']?></h6>
      ราคา: <b class="text-danger"><?=$row['price_pro']?> </b> บาท <br>
      จากร้าน: <b class="text-info"><?=$row['username']?> </b><br>
<?php
if($amount1 <= 0){ ?>
  <a class="btn btn-danger mt-2 disabled" href="#">สินค้าหมด</a>
  <a class="btn btn-info mt-2" href="pre_detail_product.php?id=<?=$row['id_pro']?>">Pre Order</a>
<?php }else{ ?>
  <a class="btn btn-outline-success mt-2" href="detail_product.php?id=<?=$row['id_pro']?>">รายละเอียด</a>
<?php } ?>
    </div>
    <br>
    </div>
    <?php
    }
    mysqli_close($conn);
    ?>

  </div>
  <div class="text-center">
    <a href="buyer.php" class="btn btn-primary" role="button">แสดงสินค้าทั้งหมด...</a>
  </div>
  <br>
</div>
<footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; My Website 2024</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
</body>
</html>