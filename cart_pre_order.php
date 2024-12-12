<?php
session_start();
include 'config.php';

if (!isset($_SESSION["bu_username"])) {
    header("location:login.php");
}

$ids = $_SESSION["bu_id"];
$sql = "SELECT * FROM address WHERE id_member='$ids'";
$query = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre Order</title>
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
    <div class="container mt-4">
        <form id="form1" method="POST" action="insert_pre_cart.php">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success h5 text-center" role="alert">สั่ง Pre Order สินค้า</div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>ลำดับที่</th>
                                    <th>รูปสินค้า</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>ราคา</th>
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
                                ?>
                                            <tr>
                                                <td><?=$m?></td>
                                                <td><img src="img/<?=$row_pro['photo_pro']?>" width="80" height="100" class="border"></td>
                                                <td><?=$row_pro['name_pro']?></td>
                                                <td><?=$row_pro['price_pro']?></td>
                                                <td>
                                                    <input type="number" name="qty" value="<?=$total?>" min="1" class="form-control text-center qty-input" data-price="<?=$row_pro['price_pro']?>" data-index="<?=$i?>">
                                                </td>
                                                <td><span id="sum<?=$i?>"><?=$sum?></span> บาท</td>
                                                <td><b class="text-info"><?=$row_pro['username']?></b></td>
                                                <td><a href="pre_delete.php?Line=<?=$i?>"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPY6MFeRzWq0FeFrLWh7r4fsArOVvodZ-d5gG-IXFzpw&s" width="30" alt="Delete"></a></td>
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
                                    <td></td>
                                    <td class="text-end" colspan="3">รวมเป็นเงิน</td>
                                    <td class="text-center"><span id="total-sum"><?=$sumprice?></span> บาท</td>
                                    <td></td>
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

                        <p class="text-end">จำนวนสินค้าทั้งหมด <span id="total-qty"><?=$sumtotal?></span> เล่ม </p>
                        <div class="text-end">
                            <button type="submit" class="btn btn-outline-primary">ยืนยันการสั่งซื้อ</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $('.qty-input').on('input', function() {
            var index = $(this).data('index');
            var price = $(this).data('price');
            var qty = $(this).val();
            var sum = price * qty;
            
            $('#sum' + index).text(sum);
            
            var totalQty = 0;
            var totalSum = 0;
            $('.qty-input').each(function() {
                totalQty += parseInt($(this).val());
                totalSum += parseFloat($(this).val()) * parseFloat($(this).data('price'));
            });
            
            $('#total-qty').text(totalQty);
            $('#total-sum').text(totalSum.toFixed(2));
        });

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
</body>
</html>
