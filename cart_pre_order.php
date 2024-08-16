<?php
session_start();
include 'config.php';

if(!isset($_SESSION["bu_username"]))
header("location:login.php");
$ids=$_SESSION["bu_id"];

$sql="select * from address WHERE id_member='$ids'";
$query = mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre Order</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script></head>

</head>
<body>
<?php include 'menu.php'; ?>
<br>
    <div class="container">
        <form id="form1" method="POST" action="insert_pre_cart.php">
        <div class="row">
            <div class="col-md-10">
                <div class="alert alert-info h5" role="alert">Pre Order</div>
                <table class="table table-hover">
                    <tr> 
                        <th>ลำดับที่</th>
                        <th>รูปสินค้า</th>
                        <th>ชื่อสินค้า</th>
                        <th>ราคา</th>
                        <th>จำนวน</th>
                        <th>ราคารวม</th>
                        <th>จากร้าน</th>
                        <th>เพิ่ม - ลด</th>
                        <th>ลบ</th>
                    </tr>

<?php
$total = 0;
$sumprice = 0;
$m = 1;
$sumtotal=0;

if(isset($_SESSION["intLine"])){    //ถ้าไม่เป็นค่าว่างให้ทำงานใน {}

for($i=0;$i <=(int)$_SESSION["intLine"]; $i++){
    if(($_SESSION["strProductID"][$i]) != ""){
$sql1="SELECT * FROM product p,user_form u WHERE p.id_user=u.id and id_pro = '".$_SESSION["strProductID"][$i] . "' " ;
$result1 = mysqli_query($conn,$sql1);
$row_pro = mysqli_fetch_array($result1);

$_SESSION["price"] = $row_pro['price_pro'];
$total = $_SESSION["strQty"][$i];
$sum = $total * $row_pro['price_pro'];
$sumprice = $sumprice + $sum;
$_SESSION["sum_price"] = $sumprice;
$sumtotal=$sumtotal + $total;
    
?>
                    <tr> 
                        <td><?=$m?></td>
                        <td>
                            <img src="img/<?=$row_pro['photo_pro']?>" width="80" height="100" class="border"></td>
                        <td><?=$row_pro['name_pro']?></td>
                        <td><?=$row_pro['price_pro']?></td>
                        <td><?=$_SESSION["strQty"][$i]?></td>
                        <td><?=$sum?></td>
                        <td><b class="text-info"><?=$row_pro['username']?> </b><br></td>
                        <td>
                            <a href="pre_order.php?id=<?=$row_pro['id_pro']?>" class="btn btn-outline-primary">+</a>
                            <?php if($_SESSION["strQty"][$i] > 1){ ?>
                            <a href="pre_order_del.php?id=<?=$row_pro['id_pro']?>" class="btn btn-outline-primary">-</a>
                            <?php }?>
                        </td>
                        <td><a href="pre_delete.php?Line=<?=$i?>"> <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPY6MFeRzWq0FeFrLWh7r4fsArOVvodZ-d5gG-IXFzpw&s" width="30"></a></td>
                    </tr>
                    <?php
                    $m=$m+1;
    }
                    }
                }
                mysqli_close($conn);
                    ?>
                    <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                        <td class="text-end" colspan="4">รวมเป็นเงิน</td>
                        <td class="text-center"><?=$sumprice?></td>
                        <td>บาท</td>
                    </tr>
                </table>
                <p class="text-end">จำนวนสินค้าทั้งหมด <?=$sumtotal?> เล่ม </p>
                <div style="text-align:right">
                <?php if(isset($row_pro['username'])){
                ?>
                <button type="submit" class="btn btn-outline-primary">ยืนยันการ Pre Order</button>
                <?php
                 }else{ ?>
                 <button type="submit" class="btn btn-outline-primary"disabled>ยืนยันการ Pre Order</button>
                <?php
                 }
                ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-success" h4 role="alert">
                    ที่อยู่ในการจัดส่ง
                    </div>
                    ชื่อ-นามสกุล:
                    <textarea class="form-control" name="cus_name"  required placeholder="ชื่อ-นามสกุล ..." rows="1"><?=$_SESSION["bu_name"]?></textarea><br>
                    <label>ที่อยู่ในการจัดส่ง: </label>
                    <select name="cus_add" id="address">
                        <option value="" selected disabled>เลือกที่อยู่ในการจัดส่ง</option>
                        <?php foreach ($query as $value){?>
                            <option value="<?=$value['address']?>"><?=$value['address']?></option>
                            <?php } ?>
                    </select> <br> <br>
                    <label>รหัสไปรษณีย์</label>
                    <input type="text" name="zipcode" id="zipcode"> <br> <br>
                    เบอร์โทรศัพท์:
                    <input type="text" name="cus_tel" class="form-control" required placeholder="เบอร์โทรศัพท์ ..." value="<?=$_SESSION["bu_telephone"]?>">
                </div>

            </div>
        </div>
        </form>
    <br><br><br>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $('#address').change(function(){
            var id_address=$(this).val();
            $.ajax({
                type:"post",
                url:"ajax_address.php",
                data:{id:id_address,function:'address'},
                success: function(data){
                    //console.log(data)
                    $('#zipcode').val('')
                    $('#zipcode').val(data)
                }
            });
        });
    </script>
</body>
</html>