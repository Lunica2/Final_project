<?php
include 'config.php';
session_start();

if(!isset($_SESSION["bu_username"]))
    header("location:login.php");

$ids = $_SESSION["bu_id"];
$id = $_GET['id'];

$sql1 = "SELECT * FROM address WHERE id_member='$ids'";
$query = mysqli_query($conn, $sql1);

$sql = "SELECT * FROM promotion pmt, user_form u , payment_methods pm WHERE pmt.id_member=u.id_member AND pmt.id_member=pm.id_member AND id_promo='$id'";
$hand = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($hand);
$id_user = $row['id_member'];
$namepro = $row['name_pro'];
$price = $row['price'];
$amount_offer = $row['amount'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งชำระเงิน โปรโมชั่น</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body {
            background: linear-gradient(135deg, #d3d5d0 0%, #fad0c4 100%);
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const today = new Date().toISOString().split('T')[0];
            document.querySelector('input[name="pay_date"]').value = today;

            const currentTime = new Date().toLocaleTimeString('it-IT', {
                hour: '2-digit',
                minute: '2-digit'
            });
            document.querySelector('input[name="pay_time"]').value = currentTime;
        });
    </script>
</head>
<body>
    <div class="container mt-2"> 
        <?php include 'menu.php'; ?><br>
        <div class="row mt-6">
            <div class="col-md-12">
                <div class="alert alert-warning text-center" role="alert">
                    ชำระเงินการสั่งโปรโมชั่น
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <form action="insert_payment_promo.php" method="POST" enctype="multipart/form-data">
                    <label class="mt-4">เลขที่โปรโมชั่น</label>
                    <input type="text" name="order_id" required readonly value="<?=$id?>"> <br> <br>

                    <label class="mt-4">ชื่อสินค้า</label> 
                    <textarea name="cusname" class="form-control" readonly rows="1"><?= $namepro ?></textarea>

                    <label class="mt-4">ชื่อร้าน</label>
                    <textarea name="cusname" class="form-control" readonly rows="1"><?=$row['name']?></textarea>

                    <label class="mt-4">ราคาสินค้า</label>
                    <input type="number" name="price" class="form-control" readonly value="<?=$price?>">

                    <label class="mt-4">*จำนวนสินค้าที่สั่งซื้อ</label>
                    <input type="number" name="amount" class="form-control" id="item_quantity" value="1" min="1" max="<?=$amount_offer?>"> 

                    <label class="mt-4">จำนวนเงินที่ต้องชำระ</label>
                    <input type="number" name="total_price" class="form-control" readonly id="total_price"> <br>
            </div>
            <div class="col-md-6">
                    <h2>เลือกช่องทางการชำระเงิน</h2>
                    <?php
                    $sql = "SELECT * FROM payment_methods pm, promotion p WHERE pm.id_member=p.id_member AND id_promo='$id' AND pm.id_member='$id_user'";
                    $result = $conn->query($sql);
                    ?>

                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <div>
                                <input type="radio" id="payment_<?php echo $row['id_payment']; ?>" name="payment_method" value="<?php echo $row['id_payment']; ?>" required>
                                <label for="payment_<?php echo $row['id_payment']; ?>"><?php echo $row['bank']; ?> <?php echo $row['bank_number']; ?></label>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No payment methods available.</p>
                    <?php endif; ?>

                    <label class="mt-2">วันที่โอน</label>
                    <input type="date" name="pay_date" class="form-control" readonly required> <br>

                    <label class="">เวลาที่โอน</label>
                    <input type="time" name="pay_time" class="form-control" readonly required>

                    <label class="mt-4">*หลักฐานการชำระเงิน</label>
                    <input type="file" name="file1" class="form-control" required>

                    <div class="mt-3">
                        <label for="address" class="form-label">*ที่อยู่ในการจัดส่ง:</label>
                        <select name="cus_add" id="address" class="form-select" required>
                            <option value="" disabled selected>เลือกที่อยู่ในการจัดส่ง</option>
                            <?php foreach ($query as $value) { ?>
                                <option value="<?=$value['ad_address']?>"><?=$value['ad_address']?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="zipcode" class="form-label">*รหัสไปรษณีย์:</label>
                        <input type="text" name="zipcode" id="zipcode" class="form-control" readonly>
                    </div>
                </div>
            <button type="submit" name="btn2" class="btn btn-primary w-100">ยืนยัน</button>
        </form>
    </div>
</div>
</body>
</html>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const pricePerItem = <?=$price?>;
        const maxQuantity = <?=$amount_offer?>;
        const quantityField = document.getElementById('item_quantity');
        const totalPriceField = document.getElementById('total_price');

        function calculateTotal() {
            let quantity = parseInt(quantityField.value) || 1;

            if (quantity < 1) {
                quantity = 1;
                quantityField.value = 1;
            }

            if (quantity > maxQuantity) {
                alert(`คุณไม่สามารถสั่งซื้อเกิน ${maxQuantity} รายการได้`); 
                quantityField.value = maxQuantity;
            }

            const totalPrice = pricePerItem * quantity;
            totalPriceField.value = totalPrice;
        }

        quantityField.addEventListener('input', calculateTotal);
        calculateTotal();
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$('#address').change(function() {
    var id_address = $(this).val();
    $.ajax({
        type: "post",
        url: "ajax_address.php",
        data: { id: id_address, function: 'ad_address' },
        success: function(data) {
            var response = JSON.parse(data);
            $('#zipcode').val(response.zipcode);
            $('#telephone_ad').val(response.telephone_ad);
            $('#ad_name').val(response.ad_name);
        }
    });
});
    </script>
