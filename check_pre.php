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
    <title>ตรวจสอบสถานะการ Pre Order</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script></head>
</head>
<body>
<?php include'menu.php'; ?>

<div class="container">
    <div class="alert alert-info h4 mt-4 text-center" role="alert">
    ตรวจสอบสถานะการ Pre Order
    </div>
    <table class="table table-striped table-hover mt-4">
        <tr>
            <th>เลขที่การ Pre Order</th>
            <th>ชื่อ-สกุล</th>
            <th>ราคารวมสุทธิ</th>
            <th>วันที่สั่ง Pre Order</th>
            <th>สถานะการ Pre Order</th>
            <th>รายละเอียดการ Pre Order</th>
        </tr>
        <?php
        $sql="SELECT * FROM pre_order po,user_form u WHERE po.id_member=u.id and id='" . $_SESSION["bu_id"] ."' ";
        $hand=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_array($hand)){
        $status=$row['pre_status'];
        
        ?>
        <tr>
            <td><?=$row['id_pre']?></td>
            <td><?=$row['name']?></td>
            <td><?=$row['total_price_pre']?></td>
            <td><?=$row['time_pre']?></td>
            <td>
            <?php
                                        if($status == 1){
                                            echo "ยังไม่ชำระเงิน";
                                        }else if($status == 2){
                                            echo "<b style='color:green '> ชำระเงินแล้ว </b> ";
                                        }else if($status == 0){
                                            echo "<b style='color:red '> ถูกยกเลิกการสั่งซื้อ </b> ";
                                        }else if($status == 3){
                                            echo "<b style='color:blue '> รอตรวจสอบ </b> ";
                                        }
                                            ?>
            </td>
            <td><a href="detail_pre_order.php?id=<?=$row['id_pre']?>" class="btn btn-success">รายละเอียด</a></td>
        </tr>
        <?php
        }
        mysqli_close($conn);
        ?>
    </table>
</div>

</body>
</html>