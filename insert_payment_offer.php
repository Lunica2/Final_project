<?php
include 'config.php';
$orderID=$_POST['order_id'];
$totalPrice=$_POST['total_price'];
$payDate=$_POST['pay_date'];
$payTime=$_POST['pay_time'];


if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
    $new_image_name = 'pay_'.uniqid().".".pathinfo(basename($_FILES['file1']['name']), PATHINFO_EXTENSION);
    $image_upload_path = "./img/payment_offer/".$new_image_name;
    move_uploaded_file($_FILES['file1']['tmp_name'],$image_upload_path);
    } else {
    $new_image_name = "";
    }

$sql="INSERT INTO payment_offer(id_payment_offer,pay_money,pay_date,pay_time,pay_image)
values('$orderID','$totalPrice','$payDate','$payTime','$new_image_name')";
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
         window.location = "report_offer.php"; //หน้าที่ต้องการให้กระโดดไป
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
         window.location = "report_offer.php"; //หน้าที่ต้องการให้กระโดดไป
     });
 }, 1000);
</script>';
}
$sql1="UPDATE offer SET offer_status = 0 WHERE id_offer='$orderID' ";
$result=mysqli_query($conn,$sql1);
if($result){
    echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    echo '<script>
    setTimeout(function() {
     swal({
         title: "เสร็จสิ้น",
         type: "success"
     }, function() {
         window.location = "report_offer.php"; //หน้าที่ต้องการให้กระโดดไป
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
         window.location = "report_offer.php"; //หน้าที่ต้องการให้กระโดดไป
     });
 }, 1000);
</script>';
}
// รับค่าช่องทางการชำระเงินที่ถูกเลือก
$payment_method_id = $_POST['payment_method'];

// คุณสามารถบันทึกข้อมูลการสั่งซื้อพร้อมกับช่องทางการชำระเงินที่เลือกไว้ในฐานข้อมูลได้ตามที่ต้องการ
$sql = "UPDATE payment_offer SET payment_method_id='$payment_method_id' WHERE id_payment_offer='$orderID' ";

if ($conn->query($sql) === TRUE) {
    echo "Order placed successfully!";
    '<script> window.location = "report_offer.php"; </script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
mysqli_close($conn);
?>