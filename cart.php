<?php
session_start();
include 'config.php';

if (!isset($_SESSION["bu_username"])) {
    header("location:login.php");
}

$ids = $_SESSION["bu_id"];
$sql = "SELECT * FROM address WHERE id_member='$ids'";
$query = mysqli_query($conn, $sql);

$totalItems = isset($_SESSION["intLine"]) && $_SESSION["intLine"] >= 0 ? true : false;
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตะกร้าสินค้า</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f0f0f5;
            font-family: 'Arial', sans-serif;
        }
        .btn-outline-primary {
            border-radius: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .btn-outline-primary:hover {
            background-color: #007bff;
            color: white;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);
        }
        .btn-outline-danger:hover {
            background-color: #ff4d4d;
            color: white;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
        .border img {
            border-radius: 8px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s;
        }
        .border img:hover {
            transform: scale(1.1);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);
        }
        .card {
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 15px;
        }
        .alert {
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <?php
    error_reporting(0);
    ini_set('display_errors', 0);
?>
    <div class="container mt-4">
        
        <form id="form1" method="POST" action="insert_cart.php">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success h5 text-center" role="alert">สั่งซื้อสินค้า</div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>ลำดับที่</th>
                                    <th>รูปสินค้า</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>ราคา</th>
                                    <th>มีจำนวน</th>
                                    <th>จำนวน</th>
                                    <th>ราคารวม</th>
                                    <th>จากร้าน</th>
                                    <th>ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                $sumprice = 0;
                                $m = 1;
                                $sumtotal = 0;
                                $seller_names = [];

                                if (isset($_SESSION["intLine"])) {
                                    for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
                                        if (($_SESSION["strProductID"][$i]) != "") {
                                            $sql1 = "SELECT * FROM product p, user_form u WHERE p.id_user=u.id_member AND id_pro = '" . $_SESSION["strProductID"][$i] . "' ";
                                            $result1 = mysqli_query($conn, $sql1);
                                            $row_pro = mysqli_fetch_array($result1);

                                            $_SESSION["price"] = $row_pro['price_pro'];
                                            $total = $_SESSION["strQty"][$i];
                                            $sum = $total * $row_pro['price_pro'];
                                            $sumprice += $sum;
                                            $_SESSION["sum_price"] = $sumprice;
                                            $sumtotal += $total;
                                            $seller_names[] = $row_pro['username'];
                                ?>
                                            <tr>
                                                <td><?=$m?></td>
                                                <td><img src="img/<?=$row_pro['photo_pro']?>" width="80" height="100" class="border"></td>
                                                <td><?=$row_pro['name_pro']?></td>
                                                <td><?=$row_pro['price_pro']?> บาท</td>
                                                <td class="max-quantity"><?=$row_pro['amount']?> เล่ม</td>
                                                <td><input type="number" class="form-control qty-input" name="amounts[]" data-price="<?=$row_pro['price_pro']?>" value="<?=$_SESSION["strQty"][$i]?>" min="1"/></td>
                                                <td class="total-price"><?=$sum?></td>
                                                <td><b class="text-info"><?=$row_pro['username']?></b></td>
                                                <td><a href="pro_delete.php?Line=<?=$i?>"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPY6MFeRzWq0FeFrLWh7r4fsArOVvodZ-d5gG-IXFzpw&s" width="30" alt="Delete"></a></td>
                                            </tr>
                                <?php
                                            $m++;
                                        }
                                    }
                                }
                                mysqli_close($conn);
                                ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="text-end" colspan="5">รวมเป็นเงิน</td>
                                    <td class="text-center total-sum-price"><?=$sumprice?></td>
                                    <td>บาท</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row mt-4 justify-content-center">
    <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="alert alert-success text-center" role="alert">
                            ที่อยู่ในการจัดส่ง
                        </div>
                        <div class="mb-3">
                            <textarea id="cus_name" class="form-control" name="cus_name" hidden required><?=$_SESSION["bu_name"]?></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="ad_name" class="form-label">ชื่อผู้รับ:</label>
                            <input type="text" name="ad_name" id="ad_name" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">ที่อยู่ในการจัดส่ง:</label>
                            <select name="cus_add" id="address" class="form-select" required>
                                <option value="" disabled selected>เลือกที่อยู่ในการจัดส่ง</option>
                                <?php foreach ($query as $value) { ?>
                                    <option value="<?=$value['ad_address']?>"><?=$value['ad_address']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="zipcode" class="form-label">รหัสไปรษณีย์:</label>
                            <input type="text" name="zipcode" id="zipcode" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                        <label for="telephone_ad" class="form-label">เบอร์โทรศัพท์:</label>
                        <input type="text" name="telephone_ad" id="telephone_ad" class="form-control" readonly>

                        </div>
                        <p class="text-end">จำนวนสินค้าทั้งหมด <?=$sumtotal?> เล่ม </p>
                        <div class="text-end">
                        <button type="submit" class="btn btn-outline-primary" id="submitBtn" <?= !$totalItems ? 'disabled' : '' ?>>ยืนยันการสั่งซื้อ</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

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
    <script>
        $(document).ready(function() {
            $('.qty-input').on('input', function() {
                var price = $(this).data('price');
                var quantity = parseInt($(this).val());
                var maxQuantity = parseInt($(this).closest('tr').find('.max-quantity').text());

                if (quantity > maxQuantity) {
                    alert("จำนวนสินค้าที่เลือกเกินจำนวนที่มีอยู่");
                    $(this).val(maxQuantity);
                    quantity = maxQuantity;
                }

                var total = price * quantity;
                $(this).closest('tr').find('.total-price').text(total);

                var sumPrice = 0;
                var sumTotalQty = 0;

                $('.qty-input').each(function() {
                    var qty = $(this).val();
                    sumTotalQty += parseInt(qty) || 0;
                });

                $('.total-price').each(function() {
                    sumPrice += parseFloat($(this).text()) || 0;
                });

                $('.total-sum-price').text(sumPrice);
                $('p.text-end').text('จำนวนสินค้าทั้งหมด ' + sumTotalQty + ' เล่ม');
            });
        });
    </script>
    <script>
    function loadFromLocalStorage() {
        let cart = localStorage.getItem('cart');
        if (cart) {
            cart = JSON.parse(cart);
            $('.qty-input').each(function() {
                let productId = $(this).closest('tr').data('product-id');
                if (cart[productId]) {
                    $(this).val(cart[productId]);
                    let price = $(this).data('price');
                    let total = cart[productId] * price;
                    $(this).closest('tr').find('.total-price').text(total);
                }
            });
            updateSumPrice();
        }
    }

    function updateLocalStorage() {
        let cart = {};
        $('.qty-input').each(function() {
            let productId = $(this).closest('tr').data('product-id');
            let quantity = $(this).val();
            cart[productId] = quantity;
        });
        localStorage.setItem('cart', JSON.stringify(cart));
    }

    function updateSumPrice() {
        let sumPrice = 0;
        let sumTotalQty = 0;

        $('.qty-input').each(function() {
            var qty = $(this).val();
            sumTotalQty += parseInt(qty) || 0;
        });

        $('.total-price').each(function() {
            sumPrice += parseFloat($(this).text()) || 0;
        });

        $('.total-sum-price').text(sumPrice);
        $('p.text-end').text('จำนวนสินค้าทั้งหมด ' + sumTotalQty + ' เล่ม');
    }

    $(document).ready(function() {
        loadFromLocalStorage();

        $('.qty-input').on('input', function() {
            var price = $(this).data('price');
            var quantity = parseInt($(this).val());
            var maxQuantity = parseInt($(this).closest('tr').find('.max-quantity').text());

            if (quantity > maxQuantity) {
                alert("จำนวนสินค้าที่เลือกเกินจำนวนที่มีอยู่");
                $(this).val(maxQuantity);
                quantity = maxQuantity;
            }

            var total = price * quantity;
            $(this).closest('tr').find('.total-price').text(total);

            updateLocalStorage();
            updateSumPrice();
        });
    });
</script>
</body>
</html>