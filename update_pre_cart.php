<?php
session_start();
include 'config.php';

$id_pro = $_POST['id_pro'];
$qty = $_POST['qty'];

// อัปเดตจำนวนสินค้าใน session
for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
    if ($_SESSION["strProductID"][$i] == $id_pro) {
        $_SESSION["strQty"][$i] = $qty;
        break;
    }
}

// คำนวณราคารวมใหม่
$total_price = 0;
$sum = 0; // เพื่อให้สามารถส่งราคารวมของสินค้านั้นๆ กลับไปด้วย
for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
    if ($_SESSION["strProductID"][$i] != "") {
        $sql1 = "SELECT * FROM product WHERE id_pro = '" . $_SESSION["strProductID"][$i] . "' ";
        $result1 = mysqli_query($conn, $sql1);
        $row_pro = mysqli_fetch_array($result1);

        // คำนวณราคารวมสำหรับสินค้านั้นๆ
        $item_sum = $_SESSION["strQty"][$i] * $row_pro['price_pro'];
        if ($_SESSION["strProductID"][$i] == $id_pro) {
            $sum = $item_sum; // ราคารวมของสินค้าที่ถูกเปลี่ยนจำนวน
        }
        $total_price += $item_sum;
    }
}

// ส่งข้อมูลกลับเป็น JSON
$response = array(
    'sum' => $sum, // ราคารวมของสินค้านั้นๆ
    'total_price' => $total_price // ราคารวมทั้งหมด
);
echo json_encode($response);

mysqli_close($conn);
?>
