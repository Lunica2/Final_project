<?php
include 'config.php';
session_start();
$cusID=$_SESSION["bu_id"];

$totalPrice=$_POST['total_price'];
$payDate=$_POST['pay_date'];
$payTime=$_POST['pay_time'];
$payment_method_id = $_POST['payment_method'];
$promoid = $_POST["order_id"];
$address = $_POST["cus_add"];
$amount = $_POST["amount"];
$zipcode = $_POST["zipcode"];

if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
    $new_image_name = 'pay_'.uniqid().".".pathinfo(basename($_FILES['file1']['name']), PATHINFO_EXTENSION);
    $image_upload_path = "./img/payment_promo/".$new_image_name;
    move_uploaded_file($_FILES['file1']['tmp_name'],$image_upload_path);
    } else {
    $new_image_name = "";
    }

    $sql1="INSERT INTO order_promo(id_member,address,price,amount_promo,zipcode,id_promo)
    values('$cusID','$address','$totalPrice','$amount','$zipcode','$promoid')";
    $hand=mysqli_query($conn,$sql1);

$id_order_promo = mysqli_insert_id($conn);
$_SESSION["id_order_promo"] = $id_order_promo;


$sql="INSERT INTO payment_promo(pay_money,pay_date,pay_time,pay_image,id_promo,id_order_promo,payment_method_id)
values('$totalPrice','$payDate','$payTime','$new_image_name','$promoid','$id_order_promo','$payment_method_id')";
$hand=mysqli_query($conn,$sql);



if($hand){
    echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    echo '<script>
    setTimeout(function() {
     swal({
         title: "เสร็จสิ้น",
         type: "success"
     }, function() {
         window.location = "show_promotion.php"; //หน้าที่ต้องการให้กระโดดไป
     });
 }, 1000);
</script>';
    }else{
        echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    echo '<script>
    setTimeout(function() {
     swal({
         title: "ไม่สามารถเพิ่มได้",
         type: "error"
     }, function() {
         window.location = "show_promotion.php"; //หน้าที่ต้องการให้กระโดดไป
     });
 }, 1000);
</script>';
}
$id = $_POST['order_id'];

$sql = "SELECT amount FROM promotion WHERE id_promo='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $amount_offer = $row['amount'];
}

$quantity = $_POST['amount'];
$newAmount = $amount_offer - $quantity;

if ($newAmount >= 0) {
    $updatePromoSql = "UPDATE promotion SET amount='$newAmount' WHERE id_promo='$id'";
    $conn->query($updatePromoSql);
} else {
    exit;
}

mysqli_close($conn);
?>