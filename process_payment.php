<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อกับฐานข้อมูล
    @include 'config.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // รับค่าช่องทางการชำระเงินที่ถูกเลือก
    $payment_method_id = $_POST['payment_method'];

    // คุณสามารถบันทึกข้อมูลการสั่งซื้อพร้อมกับช่องทางการชำระเงินที่เลือกไว้ในฐานข้อมูลได้ตามที่ต้องการ
    $sql = "INSERT INTO tb_order (payment_method_id) VALUES ('$payment_method_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Order placed successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
