<?php
session_start();
include 'config.php';
$ids=$_GET['id'];
$sql="select * from tb_order where order_id=$ids";
$result = mysqli_query($conn,$sql);
$rs=mysqli_fetch_array($result);
$total_price=$rs['total_price'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดการสั่งซื้อ</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="alert alert-primary h4 text-center mt-4" role="alert">
            รายละเอียดการสั่งซื้อ
            <br>
                </div>
                เลขที่การสั่งซื้อ : <?=$rs['order_id'];?><br>
                เลขที่สมาชิก : <?=$rs['id'];?><br>
                ชื่อ - นามสกุล (ผู้ซื้อ) : <?=$rs['cus_name'];?><br>
                ที่อยู่การจัดส่ง : <?=$rs['address'];?><br>
                เบอร์โทรศัพท์ : <?=$rs['telephone'];?><br>
                เลขไปรษณีย์ : <?=$rs['zipcode'];?><br>
                --------------------------------------------------------------------------------------------------------------------------
                <?php
                $sql2="select * from product p ,user_form uf where p.id_user=uf.id";
                $result2 = mysqli_query($conn,$sql2);
                $rs2=mysqli_fetch_array($result2);
                ?>
                ชำระเงินได้ที่ : <?=$rs2['bank'];?><br>
                เลขที่บัญชี : <?=$rs2['bank_number'];?><br>
                <div class="card mb-4 mt-4">
                    <div class="card-body">
<table class="table table-hover">
  <thead>
    <tr>
      <th>รหัสสินค้า</th>
      <th>ชื่อสินค้า</th>
      <th>ราคา</th>
      <th>จำนวนที่สั่งซื้อ</th>
      <th>ราคารวม</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql1="select * from order_detail d,product p where d.id_pro=p.id_pro and d.id_order=$ids";
    $result1 = mysqli_query($conn,$sql1);
    while($row=mysqli_fetch_array($result1)){
    ?>
    <tr>
      <td><?=$row['id_pro']?></td>
      <td><?=$row['name_pro']?></td>
      <td><?=$row['price_pro']?></td>
      <td><?=$row['item_amount']?></td>
      <td><?=$row['total']?></td>
    </tr>
  </tbody>
  <?php
  }
  ?>
</table>
<h6 class="text-end">รวมเป็นเงิน <?=number_format($total_price,2);?> บาท</h6>
</div>
</div>
<div>
    *** ชำระเงินภายใน 7 วัน หลังจากสั่งซื้อสินค้า ***
    <br>
    
    <br><br>
</div>
<div class="text-center">
<a href="check_order.php" class="btn btn-success">Back</a>
</div>
            </div>
        </div>
    </div>
</body>
</html>