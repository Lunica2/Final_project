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
    <title>รายการ Pre Order</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script></head>
<style>
    body{
        background: linear-gradient(135deg, #d3d5d0 0%, #fad0c4 100%);
    }
</style>
</head>
<body>
<?php include'menu.php'; ?>

<div class="container">
    <div class="alert alert-success h4 mt-4 text-center" role="alert">
    รายการ Pre Order
    </div>
    <table class="table table-striped table-hover mt-4">
        <tr>
            <th>รหัสการ Pre Order</th>
            <th>รูปภาพสินค้า</th>
            <th>ชื่อสินค้า</th>
            <th>ราคารวม</th>
            <th>สถานะ</th>
            <th>ชำระเงิน</th>
        </tr>
        <?php
        $sql = "SELECT * FROM pre_order po,pre_order_detail pod,product p,user_form u WHERE po.id_member=u.id_member and po.id_pre=pod.id_pre and pod.id_pro=p.id_pro AND u.id_member='" . $_SESSION["bu_id"] ."' ";
        $hand=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_array($hand)){
            $status = $row['pre_status'];
            $id_offer = $row['id_pre'];
        ?>
        <tr>
            <td><?=$row['id_pre']?></td>
            <td><img src="img/<?=$row['photo_pro']?>" width="100" height="100"></td>
            <td><?=$row['name_pro']?></td>
            <td><?=$row['total_price_pre']?></td>
            <td>
                <?php if($status == 2){
                    echo "ชำระเงินแล้ว";
                }else if($status == 3){
                    echo "ยอมรับแล้ว";
                }else if($status == 0){
                    echo "การ Per Order ถูกยกเลิก";
                }else if($status == 1){
                    echo "ยังไม่ยอมรับ";
                }
                ?>
            </td>
            <?php
if($status == 3){ ?>
            <td><a href="payment_pre_new.php?id=<?=$row['id_pre']?>" class="btn btn-primary btn-sm" role="button">ชำระเงิน</a></td>
        </tr>
        <?php }else{ ?>
            <td><a href="payment_pre_new.php?id=<?=$row['id_pre']?>" class="btn btn-primary btn-sm disabled" role="button">ชำระเงิน</a></td>
            <?php } ?>
        <?php
        }
        mysqli_close($conn);
        ?>
    </table>
</div>

</body>
</html>