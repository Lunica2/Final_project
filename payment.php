<?php
include 'config.php';
session_start();

if(!isset($_SESSION["bu_username"]))
header("location:login.php");

$ids=$_SESSION["bu_id"];
$order_id="";
$cusname="";
$total=0;
$orderStatus="";

if(isset($_POST['btn1'])){
    $key_word=$_POST['keyword'];
    if($key_word != ""){
        $sql="SELECT * FROM tb_order WHERE order_id='$key_word' and id='$ids' ";
        unset($_SESSION['error']);
    }else{
        echo "<script>window.location='payment.php'; </script>";
        unset($_SESSION['error']);
    }
    $hand=mysqli_query($conn,$sql);
    $num1=mysqli_num_rows($hand);
    if($num1 == 0){
        echo "<script>window.location='payment.php'; </script>";
        $_SESSION['error']="ไม่พบเลขที่ใบสั่งซื้อ";
    }else{
    $row=mysqli_fetch_array($hand);
    $order_id=$row['order_id'];
    $cusname=$row['cus_name'];
    $total=$row['total_price'];
    $orderStatus=$row['order_status'];
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
            <div class="alert alert-warning text-center" role="alert">
                แจ้งชำระเงิน
                </div>
                <div class="border mt-4 p-2 my-2" style="background-color: #f0f0f5">
                <form action="payment.php" method="POST">
                <label>เลขที่ใบสั่งซื้อ: </label>
                <select class="form-select" name="keyword">
                <?php
                    $sql = "SELECT * FROM tb_order WHERE id='$ids'";
                    $hand=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_array($hand)){
                        $order_ids=$row['order_id']
                    ?>
                        <option value="<?=$row['order_id']?>"<?php if($order_ids == $order_ids)?>>
                        <?=$row['order_id']?></option>
                        <?php
                        }
                        ?>
                    </select> <br>
                    <button type="submit" name="btn1" class="btn btn-primary">ค้นหา</button>
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
    <form action="insert_payment.php" method="POST" enctype="multipart/form-data">
    <label class="mt-4">เลขที่ใบสั่งซื้อ</label>
    <input type="text" name="order_id" required value=<?=$order_id?>> <br>
    <?php
    $status="";
    if($orderStatus == '1'){
        echo "<div class='text-danger'> "; 
        echo "ยังไม่ชำระเงิน";
        echo "</div>";

    }elseif($orderStatus == '2'){
        echo "<div class='text-success'> ";
        echo "ชำระเงินแล้ว";
        echo "</div>";

    }elseif($orderStatus == '3'){
        echo "<div class='text-info'> ";
        echo "รอการตรวจสอบ";
        echo "</div>";
    }
    ?>
    <a class="btn btn-primary" href="check_order.php">การสั่งซื้อทั้งหมด</a> <br>
    <label class="mt-4">ชื่อผู้ซื้อ</label>
    <textarea name="cusname" class="form-control" readonly rows="1"><?=$cusname?></textarea>
    
    <label class="mt-4">จำนวนเงิน</label>
    <input type="number" name="total_price" class="form-control" readonly value=<?=$total?>>

    <label class="mt-4">วันที่โอน</label>
    <input type="date" name="pay_date" class="form-control" required>

    <label class="mt-4">เวลาที่โอน</label>
    <input type="time" name="pay_time" class="form-control" required>

    <label class="mt-4">หลักฐานการชำระเงิน</label>
    <input type="file" name="file1" class="form-control" required> <br>

    <?php
    if($orderStatus =='1'){ ?>
    <button type="submit" name="btn2" class="btn btn-primary" >ยืนยัน</button>
    <?php
    }else{  ?>
    <button type="submit" name="btn2" class="btn btn-primary" disabled >ยืนยัน</button>
    <?php } ?>
    </form>
<br>
    </div>
</div>

    </div>
</body>
</html>