<?php
@include 'config.php';
session_start();
$p_name=$_POST['pname'];
$typeID=$_POST['typeID'];
$price=$_POST['price'];
$detail=$_POST['detail'];
$amount=$_POST['amount'];
$ids=$_SESSION["se_id"];

if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
    $new_image_name = 'pro_'.uniqid().".".pathinfo(basename($_FILES['file1']['name']), PATHINFO_EXTENSION);
    $image_upload_path = "../img/".$new_image_name;
    move_uploaded_file($_FILES['file1']['tmp_name'],$image_upload_path);
    } else {
    $new_image_name = "";
    }

    $sql="INSERT INTO product(name_pro,id_type,price_pro,photo_pro,detail_pro,amount,status_pro,id_user) VALUES('$p_name','$typeID','$price','$new_image_name','$detail','$amount','2','$ids')";
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
         window.location = "addproduct.php"; //หน้าที่ต้องการให้กระโดดไป
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
         window.location = "addproduct.php"; //หน้าที่ต้องการให้กระโดดไป
     });
 }, 1000);
</script>';
}

$sql1="insert into sell(sell_amount,id_pro)
values('0','$id_pro')";
mysqli_query($conn,$sql1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = '../img/product_img/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $errors = [];
    $uploadedFiles = [];

    foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
        $fileName = basename($_FILES['images']['name'][$key]);
        $targetFilePath = $uploadDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Check if file is an image
        $check = getimagesize($tmpName);
        if ($check !== false) {
            if (move_uploaded_file($tmpName, $targetFilePath)) {
                $uploadedFiles[] = $fileName;

                // Insert file information into database
                $sql = "INSERT INTO product_images (file_name,id_member,id_pro) VALUES ('$fileName','$ids','$id_pro')";
                if ($conn->query($sql) !== TRUE) {
                    $errors[] = "Error inserting file info into database: " . $conn->error;
                }
            } else {
                $errors[] = "Failed to upload file: $fileName";
            }
        } else {
            $errors[] = "File is not an image: $fileName";
        }
    }

    if (!empty($uploadedFiles)) {
        echo "Files uploaded successfully:<br>";
        foreach ($uploadedFiles as $file) {
            echo "$file<br>";
        }
    }

    if (!empty($errors)) {
        echo "Errors occurred:<br>";
        foreach ($errors as $error) {
            echo "$error<br>";
        }
    }
} else {
    echo "No files uploaded.";
}

$conn->close();
?>