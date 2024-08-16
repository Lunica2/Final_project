<?php
include 'config.php';
$ids=$_GET['id'];
$sql = "SELECT file_name FROM product_images WHERE id_pro='$ids'";
$result = $conn->query($sql);

$images = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $images[] = './img/product_img/' . $row['file_name'];
    }
}else{
    $images[] = "img/no_image.png";
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($images);
?>
