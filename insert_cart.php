<?php
session_start();
include 'config.php';

$cusName = $_POST['ad_name'];
$cusAddress = $_POST['cus_add'];
$cusTel = $_POST['telephone_ad'];
$cuszipcode = $_POST['zipcode'];
$dmonth = date("F");

$cusID = $_SESSION["bu_id"];


$sql = "INSERT INTO tb_order(id, cus_name, address, telephone, order_status, dateMonth, zipcode)
VALUES ('$cusID', '$cusName', '$cusAddress', '$cusTel', '3', '$dmonth', '$cuszipcode')";
mysqli_query($conn, $sql);

$orderID = mysqli_insert_id($conn);
$_SESSION["order_id"] = $orderID;

$grandTotal = 0;

$amounts = $_POST['amounts'];


for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
    if (isset($_SESSION["strProductID"][$i]) && !empty($_SESSION["strProductID"][$i])) {

        
        if (!isset($amounts[$i])) {
            echo "Error: ไม่พบข้อมูลจำนวนสินค้าสำหรับสินค้าในแถวที่ $i";
            continue;
        }

        
        $sql1 = "SELECT * FROM product WHERE id_pro = '" . $_SESSION["strProductID"][$i] . "'";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_array($result1);

        if (!$row1) {
            echo "Error retrieving product data: " . mysqli_error($conn);
            exit();
        }

        $price = $row1['price_pro'];
        $amount = $amounts[$i];

        if ($amount <= 0) {
            echo "จำนวนสินค้าที่เลือกไม่ถูกต้อง";
            exit();
        }

        $total = $amount * $price;
        $grandTotal += $total;

        $sql2 = "INSERT INTO order_detail(item_amount, total, order_pro_status, id_pro, id_order)
                 VALUES ('$amount', '$total', '2', '" . $_SESSION["strProductID"][$i] . "', '$orderID')";
        
        if (!mysqli_query($conn, $sql2)) {
            echo "Error inserting order detail: " . mysqli_error($conn);
            exit();
        }

        $sql5 = "UPDATE sell SET sell_amount = sell_amount + '$amount' 
                 WHERE id_pro = '" . $_SESSION["strProductID"][$i] . "'";
        mysqli_query($conn, $sql5);

        $sql6 = "UPDATE sell SET sell_month = '$dmonth'
                 WHERE id_pro = '" . $_SESSION["strProductID"][$i] . "'";
        mysqli_query($conn, $sql6);

        $sql3 = "UPDATE product SET amount = amount - '$amount'
                 WHERE id_pro = '" . $_SESSION["strProductID"][$i] . "'";
        mysqli_query($conn, $sql3);
    }
}


$sql7 = "UPDATE tb_order SET total_price = '$grandTotal' WHERE order_id = '$orderID'";
mysqli_query($conn, $sql7);

mysqli_close($conn);

unset($_SESSION["intLine"]);
unset($_SESSION["strProductID"]);
unset($_SESSION["strQty"]);
unset($_SESSION["sum_price"]);

echo "<script>window.location='print_order.php';</script>";
?>
