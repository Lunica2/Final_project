<?php
session_start();
include 'config.php';

if(!isset($_SESSION["bu_username"]))
header("location:login.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รีวิวสินค้า</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script></head>
</head>
<body>
<?php include'menu.php'; ?>

<div class="container">
    <div class="alert alert-success h4 mt-4 text-center" role="alert">
    รีวิวสินค้า
    </div>
    <table class="table table-striped table-hover mt-4">
        <tr>
            <th>รหัสสินค้า</th>
            <th>รูปภาพสินค้า</th>
            <th>ชื่อสินค้า</th>
            <th>วันที่สั่งซื้อ</th>
            <th>สถานะการสั่งซื้อ</th>
            <th>รีวิวสินค้าที่สั่งซื้อ</th>
        </tr>
        <?php
        $sql = "select * from order_detail d , product p, tb_order t where d.id_order=t.order_id
        and d.id_pro=p.id_pro AND id='" . $_SESSION["bu_id"] ."' ";
        $hand=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_array($hand)){
        $status=$row['order_status'];
        
        ?>
        <tr>
            <td><?=$row['id_pro']?></td>
            <td><img src="img/<?=$row['photo_pro']?>" width="100" height="100"></td>
            <td><?=$row['name_pro']?></td>
            <td><?=$row['reg_date']?></td>
            <td>
                <?php if($status == 0){
                    echo "สินค้าถูกยกเลิก";
                }else if($status == 1){
                    echo "สินค้ายังไม่ชำระเงิน";
                }else if($status == 2){
                    echo "ชำระเงินเรียบร้อย";
                }else if($status == 3){
                    echo "รอการตรวจสอบ";
                }
                ?>
            </td>
            <?php
if($status == 2){ ?>
            <td><a href="review_new.php?id=<?=$row['id_pro']?>" class="btn btn-primary btn-sm" role="button">รีวิวสินค้า</a></td>
        </tr>
        <?php }else{ ?>
            <td><a href="review_new.php?id=<?=$row['id_pro']?>" class="btn btn-primary btn-sm disabled" role="button">รีวิวสินค้า</a></td>
            <?php } ?>
        <?php
        }
        mysqli_close($conn);
        ?>
    </table>
</div>

</body>
</html>