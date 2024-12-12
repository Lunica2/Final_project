<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    @include 'config.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $payment_method_id = $_POST['payment_method'];

    $sql = "INSERT INTO tb_order (payment_method_id) VALUES ('$payment_method_id')";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
