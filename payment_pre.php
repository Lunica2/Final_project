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
        $sql="SELECT * FROM pre_order po,pre_order_detail pod ,product p ,user_form u WHERE po.id_pre=pod.id_pre and pod.id_pro=p.id_pro and po.id_member=u.id_member and po.id_pre='$key_word' and po.id_member='$ids' ";
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
    $id_pro=$row['id_pro'];
    $id_user=$row['id_user'];
    $namepro = $row['name_pro'];
    $amount = $row['item_amount'];
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body {
            background: linear-gradient(135deg, #d3d5d0 0%, #fad0c4 100%);
        }
        </style>
</head>
<body>
    <div class="container mt-4">
        <?php include 'menu.php'; ?>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="alert alert-warning" role="alert">
                    แจ้งชำระเงิน Pre Order
                </div>
                <div class="border mt-4 p-3 bg-light shadow-sm">
                    <form action="payment_pre.php" method="POST">
                        <label for="preOrderSelect">เลขที่ Pre Order</label>
                        <select class="form-select" id="preOrderSelect" name="keyword">
                        <?php
                            $sql = "SELECT * FROM pre_order WHERE id_member='$ids' and pre_status=1";
                            $hand=mysqli_query($conn,$sql);
                            while($row=mysqli_fetch_array($hand)){
                                $order_ids=$row['id_pre'];
                        ?>
                            <option value="<?=$row['id_pre']?>"><?=$row['id_pre']?></option>
                        <?php } ?>
                        </select> 
                        <br>
                        <button type="submit" name="btn1" class="btn btn-primary w-100">ค้นหา</button> 
                        <br>
                        <?php
                        if(isset($_SESSION['error'])){
                            echo "<div class='text-danger mt-2'> ";
                            echo $_SESSION['error'];
                            echo "</div>";
                        }
                        ?>
                    </form>
                </div>
            </div>

            <?php
    error_reporting(0);
    ini_set('display_errors', 0);
?>

            <div class="col-md-8">
                <div class="border p-4 bg-white shadow-sm">
                    <h5>รายละเอียด Pre Order</h5>
                    <form action="insert_payment_pre.php" method="POST" enctype="multipart/form-data">
                        <label class="mt-4">เลขที่ Pre Order</label>
                        <input type="text" name="order_id" class="form-control" required readonly value="<?=$order_id?>">

                        <?php
                        if ($preStatus == '1') {
                            echo "<div class='text-danger mt-2'>ยังไม่ชำระเงิน</div>";
                        } elseif ($preStatus == '2') {
                            echo "<div class='text-success mt-2'>ชำระเงินแล้ว</div>";
                        } elseif ($preStatus == '3') {
                            echo "<div class='text-info mt-2'>รอการตรวจสอบ</div>";
                        } elseif ($preStatus == '0') {
                            echo "<div class='text-danger mt-2'>การสั่งสินค้าถูกยกเลิก</div>";
                        }
                        ?>

                        <label class="mt-4">ไอดีสินค้า</label>
                        <textarea name="product_name" class="form-control" readonly rows="1"><?=$namepro?></textarea>

                        <label class="mt-4">ชื่อผู้สั่ง</label>
                        <textarea name="cusname" class="form-control" readonly rows="1"><?=$cusname?></textarea>

                        <label class="mt-4">จำนวนสินค้าที่สั่ง Pre Order</label>
                        <input type="number" name="item_amount" class="form-control" readonly value="<?=$amount?>">

                        <label class="mt-4">จำนวนเงินที่ต้องชำระ</label>
                        <input type="number" name="total_price" class="form-control" readonly value="<?=$total?>">

                        <h5 class="mt-4">*เลือกช่องทางการชำระเงิน</h5>
                        <?php
                        $sql = "SELECT * FROM payment_methods pm, product p WHERE pm.id_member=p.id_user AND p.id_pro='$id_pro' AND pm.id_member='$id_user'";
                        $result = $conn->query($sql);
                        ?>

                        <?php if ($result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="payment_<?php echo $row['id_payment']; ?>" name="payment_method" value="<?php echo $row['id_payment']; ?>" required>
                                    <label class="form-check-label" for="payment_<?php echo $row['id_payment']; ?>">
                                        <?php echo $row['bank']; ?> (<?php echo $row['bank_number']; ?>)
                                    </label>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>No payment methods available.</p>
                        <?php endif; ?><br>

                        <label class="mt-4">วันที่โอน</label>
                        <input type="date" name="pay_date" class="form-control" required>

                        <label class="mt-4">เวลาที่โอน</label>
                        <input type="time" name="pay_time" class="form-control" required>

                        <label class="mt-4">*หลักฐานการชำระเงิน</label>
                        <input type="file" name="file1" class="form-control" required> 
                        <br>
                        <button type="submit" name="btn2" class="btn btn-success w-100">ยืนยัน</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
