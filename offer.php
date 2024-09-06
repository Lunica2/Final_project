<?php
@include 'config.php';

session_start();

if(!isset($_SESSION["bu_username"]))
header("location:login.php");
$ids=$_SESSION["bu_id"];

$ID=$_GET['id'];
$sql1="SELECT * FROM product WHERE id_pro='$ID' ";
$hand=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_array($hand);

$sql="select * from address WHERE id_member='$ids'";
$query = mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดข้อเสนอการซื้อ</title>
    <link rel="stylesheet" href="style/style_register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<style>
body{
    background-color: #f0f0f5;
}
    </style>
<body>
<?php include 'menu.php'; ?>
<div class="form-container" >
    <form action="insert_offer.php" method="post">
        <h3>จัดข้อเสนอการซื้อ</h3>
        <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span>';
            };
        };
        ?>
        <label class="mt-1">ไอดีสินค้า</label>
        <input type="text" name="id_pro" class="form-control text-center" readonly value=<?=$row1['id_pro']?>>
        <label class="mt-1">ชื่อสินค้า</label>
        <input type="text" name="name_pro" class="form-control" readonly value=<?=$row1['name_pro']?>>
        <label class="mt-1">ราคาสินค้า</label>
        <input type="text" name="price" class="form-control" readonly value=<?=$row1['price_pro']?>>
        <label class="mt-1">จำนวนที่ต้องการสั่งซื้อ</label>
        <select name="amount_offer" id="amount_offer">
        <option value="10">10 เล่ม</option>
        <option value="20">20 เล่ม</option>
        <option value="30">30 เล่ม</option>
        </select><br>
        <label class="mt-1">ส่วนลดที่ต้องการ</label>
        <select name="discount" id="discount">
        <option value="10%">10 %</option>
        <option value="20%">20 %</option>
        </select><br>
        <input hidden type="text" name="uid" class="form-control text-center" readonly value=<?=$row1=$ids?>>
        <label>ที่อยู่ในการจัดส่ง: </label>
                    <select name="cus_add" id="address">
                        <option value="" selected disabled>เลือกที่อยู่ในการจัดส่ง</option>
                        <?php foreach ($query as $value){?>
                            <option value="<?=$value['address']?>"><?=$value['address']?></option>
                            <?php } ?>
                    </select> <br>
                    <label>รหัสไปรษณีย์</label>
                    <input type="text" name="zipcode" id="zipcode" readonly > <br> <br>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-danger" href="index.php" role="button">Cancel</a>
    </form>
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