<?php
include 'config.php';

$sql = "DELETE FROM promotion WHERE end_date < CURDATE()";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "โปรโมชั่นที่หมดอายุได้ถูกลบออกเรียบร้อยแล้ว.";
} else {
    echo "เกิดข้อผิดพลาดในการลบโปรโมชั่น: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
