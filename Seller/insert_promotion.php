<?php
@include 'config.php';
session_start();
$p_name=$_POST['pname'];
$promotiondetails=$_POST['promotiondetails'];
$price=$_POST['price'];
$amount=$_POST['amount'];
$ids=$_SESSION["se_id"];
$start=$_POST['start_date'];
$end=$_POST['end_date'];

if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
    $new_image_name = 'promo_'.uniqid().".".pathinfo(basename($_FILES['file1']['name']), PATHINFO_EXTENSION);
    $image_upload_path = "../img/".$new_image_name;
    move_uploaded_file($_FILES['file1']['tmp_name'],$image_upload_path);
    } else {
    $new_image_name = "";
    }

    $sql="INSERT INTO promotion(name_pro,promo_detail,price,amount,photo_pro,start_date,end_date,id_member) VALUES('$p_name','$promotiondetails','$price','$amount','$new_image_name','$start','$end','$ids')";
    $result=mysqli_query($conn,$sql);

    $id_pro = mysqli_insert_id($conn);
    $_SESSION["id_pro"] = $id_pro;
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
         window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
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
         window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
     });
 }, 1000);
</script>';
}
$conn->close();
?>