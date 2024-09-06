<?php
// เชื่อมต่อกับฐานข้อมูล
@include 'config.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลช่องทางการชำระเงิน
$sql = "SELECT * FROM payment_methods";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Payment Method</title>
</head>
<body>
    <form action="process_payment.php" method="POST">
        <h2>Select Payment Method</h2>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div>
                    <input type="radio" id="payment_<?php echo $row['id_payment']; ?>" name="payment_method" value="<?php echo $row['id_payment']; ?>" required>
                    <label for="payment_<?php echo $row['id_payment']; ?>"><?php echo $row['bank']; ?> <?php echo $row['bank_number']; ?> - <?php echo $row['description']; ?></label>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No payment methods available.</p>
        <?php endif; ?>
        <button type="submit">Proceed to Payment</button>
    </form>

    <?php $conn->close(); ?>
</body>
</html>
