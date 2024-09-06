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
    <title>การจัดข้อเสนอ</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script></head>
</head>
<body>
<?php include'menu.php'; ?>

<div class="container">
    <div class="alert alert-success h4 mt-4 text-center" role="alert">
    รายการจัดข้อเสนอ
    </div>
    <table class="table table-striped table-hover mt-4">
        <tr>
            <th>รหัสข้อเสนอ</th>
            <th>รูปภาพสินค้า</th>
            <th>ชื่อสินค้า</th>
            <th>ราคารวม</th>
            <th>สถานะข้อเสนอ</th>
            <th>ชำระเงิน</th>
        </tr>
        <?php
        $sql = "select * from offer o,product p,user_form u where o.id_pro=p.id_pro and o.id_member=u.id_member order by id_offer";
        $hand=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_array($hand)){
            $status = $row['offer_status'];
            $total = $row['price'] * $row['amount_offer'];
            $id_offer = $row['id_offer'];
        
        ?>
        <tr>
            <td><?=$row['id_offer']?></td>
            <td><img src="img/<?=$row['photo_pro']?>" width="100" height="100"></td>
            <td><?=$row['name_pro']?></td>
            <td><?=$total-($total * $row['discount'])/100?></td>
            <td>
                <?php if($status == 0){
                    echo "ชำระเงินแล้ว";
                }else if($status == 1){
                    echo "รอตรวจสอบ";
                }else if($status == 2){
                    echo "ยอมรับข้อเสนอแล้ว";
                }else if($status == 3){
                    echo "ไม่ยอมรับข้อเสนอ";
                }
                ?>
            </td>
            <?php
if($status == 2){ ?>
            <td><a href="payment_offer.php?id=<?=$row['id_offer']?>" class="btn btn-primary btn-sm" role="button">ชำระเงิน</a></td>
        </tr>
        <?php }else{ ?>
            <td><a href="payment_offer.php?id=<?=$row['id_offer']?>" class="btn btn-primary btn-sm disabled" role="button">ชำระเงิน</a></td>
            <?php } ?>
        <?php
        }
        mysqli_close($conn);
        ?>
    </table>
</div>

</body>
</html>