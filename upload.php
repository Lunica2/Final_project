<?php
@include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-7">
            <div class="alert alert-primary h3 text-center mb-4 mt-4" role="alert">
  เพิ่มสินค้า
</div>
                <form name="form1" method="post" action="insert_product.php" enctype="multipart/form-data">
                    <label>ชื่อสินค้า: </label>
                    <input type="text" name="pname" class="form-control" placeholder="ชื่อสินค้า..." require> <br>
                    <label>ประเภทสินค้า: </label>
                    <select class="form-select" name="typeID">
                    <?php
                    $sql = "SELECT * FROM type ORDER BY id_type";
                    $hand=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_array($hand)){
                    ?>
                        <option value="<?=$row['id_type']?>"><?=$row['name_type']?></option>
                        <?php
                        }
                        mysqli_close($conn);
                        ?>
                    </select>
                    <label>ราคา: </label>
                    <input type="number" name="price" class="form-control" placeholder="ราคา..." require> <br>
                    <label>จำนวน: </label>
                    <input type="number" name="amount" class="form-control" placeholder="จำนวน..." require> <br>
                    <label>รูปภาพ: </label>
                    <input type="file" name="file1" require ><br> <br>
                    <label>รายละเอียด: </label>
                    <input type="text" name="detail" class="form-control" placeholder="รายละเอียด..." require> <br>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-danger" href="showproduct.php" role="button">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>