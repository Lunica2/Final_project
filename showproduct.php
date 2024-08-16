<?php
@include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Product</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="container">
    <div class="alert alert-primary h3 text-center mb-4 mt-4" role="alert">
  แสดงสินค้า
</div>
<a class="btn btn-primary mb-4" href="upload.php" role="button">Add</a>
        <table class="table table-striped table-hover">
            <tr>
                <th>รหัสสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>ประเภทสินค้า</th>
                <th>ราคา</th>
                <th>รูปภาพ</th>
                <th>รายละเอียด</th>
            </tr>
            <?php
            $sql="SELECT * FROM product,type WHERE product.id_type = type.id_type ";
            $hand=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($hand)){
            ?>
            <tr>
                <td><?=$row['id_pro']?> </td>
                <td><?=$row['name_pro']?> </td>
                <td><?=$row['name_type']?> </td>
                <td><?=$row['price_pro']?> </td>
                <td><img src="img/<?=$row['photo_pro']?>" width="90px" height="100px"> </td>
                <td><?=$row['detail_pro']?> </td>
            </tr>

            <?php
            }
            mysqli_close($conn);
            ?>
        </table>
    </div>
</body>
</html>