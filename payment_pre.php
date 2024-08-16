<?php
include 'config.php';
session_start();

if(!isset($_SESSION["bu_username"]))
header("location:login.php");

$ids=$_SESSION["bu_id"];
$order_id="";
$cusname="";
$total=0;
$preStatus="";

if(isset($_POST['btn1'])){
    $key_word=$_POST['keyword'];
    if($key_word != ""){
        $sql="SELECT * from pre_order p,user_form u,product pr where p.id_member=u.id and p.id_pro=pr.id_pro and id_pre='$key_word' and id='$ids' ";
        unset($_SESSION['error']);
    }else{
        echo "<script>window.location='payment_pre.php'; </script>";
        unset($_SESSION['error']);
    }
    $hand=mysqli_query($conn,$sql);
    $num1=mysqli_num_rows($hand);
    if($num1 == 0){
        echo "<script>window.location='payment_pre.php'; </script>";
        $_SESSION['error']="ไม่พบเลขที่ใบสั่งซื้อ";
    }else{
    $row=mysqli_fetch_array($hand);
    $order_id=$row['id_pre'];
    $cusname=$row['name'];
    $total=$row['total_price_pre'];
    $preStatus=$row['pre_status'];
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งชำระเงิน</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script></head>
</head>
<body>
    <div class="container mt-2">
<?php include 'menu.php'; ?>

        <div class="row mt-4">
            <div class="col-md-4">
            <div class="alert alert-warning" role="alert">
                แจ้งชำระเงิน Pre Order
                </div>
                <div class="border mt-4 p-2 my-2" style="background-color: #f0f0f5">
                <form action="payment_pre.php" method="POST">
                <label>เลขที่ Pre Order </label>
                <select class="form-select" name="keyword">
                <?php
                    $sql = "SELECT * FROM pre_order WHERE id_member='$ids'";
                    $hand=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_array($hand)){
                        $order_ids=$row['id_pre']
                    ?>
                        <option value="<?=$row['id_pre']?>"<?php if($order_ids == $order_ids)?>>
                        <?=$row['id_pre']?></option>
                        <?php
                        }
                        ?>
                    </select> <br>
                    <button type="submit" name="btn1" class="btn btn-primary">ค้นหา</button> <br>
                    <?php
                    if(isset($_SESSION['error'])){
                        echo "<div class='text-danger'> ";
                        echo $_SESSION['error'];
                        echo "</div>";
                    }
                    ?>
                </form>
                </div>
            </div>
        </div>

<div class="row">
    <div class="col-md-4">
    <form action="insert_payment_pre.php" method="POST" enctype="multipart/form-data">
        
    <label class="mt-4">เลขที่ Pre Order</label>
    <input type="text" name="order_id" required readonly value=<?=$order_id?>> <br>
    <?php
    $status="";
    if($preStatus == '1'){
        echo "<div class='text-danger'> "; 
        echo "ยังไม่ชำระเงิน";
        echo "</div>";

    }elseif($preStatus == '2'){
        echo "<div class='text-success'> ";
        echo "ชำระเงินแล้ว";
        echo "</div>";

    }elseif($preStatus == '3'){
        echo "<div class='text-info'> ";
        echo "รอการตรวจสอบ";
        echo "</div>";
    }
    ?>
    <label class="mt-4">ชื่อผู้สั่ง</label>
    <textarea name="cusname" class="form-control" readonly rows="1"><?=$cusname?></textarea>
    
    <label class="mt-4">จำนวนเงิน</label>
    <input type="number" name="total_price" class="form-control" readonly value=<?=$total?>>

    <label class="mt-4">วันที่โอน</label>
    <input type="date" name="pay_date" class="form-control" required>

    <label class="mt-4">เวลาที่โอน</label>
    <input type="time" name="pay_time" class="form-control" required>

    <label class="mt-4">หลักฐานการชำระเงิน</label>
    <input type="file" name="file1" class="form-control" required> <br>
   
    <button type="submit" name="btn2" class="btn btn-primary" >ยืนยัน</button>
    </form>
<br>
    </div>
</div>

    </div>
</body>
</html>