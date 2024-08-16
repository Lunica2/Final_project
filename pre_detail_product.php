<?php
@include 'config.php';

session_start();

if(!isset($_SESSION["bu_username"]))
header("location:login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script></head>
<style>
            .viewer {
            position: relative;
        }
        .viewer img {
            max-width: 100%;
            max-height: 80vh;
            transition: transform 0.25s ease;
            cursor: zoom-in;
        }
        .controls {
            display: flex;
            margin-top: 10px;
        }
        .controls button {
            padding: 10px;
            margin: 0 5px;
        }
          body{
    background-color: #f0f0f5;
}
</style>
</head>
<body>
<?php include 'menu.php'; ?>
<div class="container"><br>
  <div class="row">
  <?php
  $ids=$_GET['id'];
$sql = "SELECT * FROM product,type,user_form WHERE product.id_type=type.id_type and product.id_user=user_form.id and product.id_pro='$ids'";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$image1=$row['photo_pro'];
    ?>
    <div class="col-md-4">
    <?php if($image1 == ""){ ?>
  <img src="img/no_image.png" width="250px" height="300" class="mt-5 p-2 my-2 border"> <br>
<?php }else{ ?>
  <img src="img/<?=$row['photo_pro']?>" width="250px" height="300" class="mt-5 p-2 my-2 border"> <br>
<?php }
  ?>
  <div>ตัวอย่างสินค้า</div>
  <div class="viewer">
        <img id="currentImage" width="250px" height="300" src="" alt="Image Viewer">
    </div>
    <div class="controls">
        <button onclick="prevImage()">Previous</button>
        <button onclick="nextImage()">Next</button>
    </div>

    <script>
        let images = [];
        let currentIndex = 0;

        // Fetch images from the server
        fetch('fetch_images.php?id=<?=$row['id_pro']?>')
            .then(response => response.json())
            .then(data => {
                images = data;
                if (images.length > 0) {
                    document.getElementById('currentImage').src = images[0];
                }
            });

        function showImage(index) {
            if (index >= 0 && index < images.length) {
                document.getElementById('currentImage').src = images[index];
                currentIndex = index;
            }
        }

        function prevImage() {
            if (currentIndex > 0) {
                showImage(currentIndex - 1);
            }
        }

        function nextImage() {
            if (currentIndex < images.length - 1) {
                showImage(currentIndex + 1);
            }
        }

        // Zoom functionality
        const img = document.getElementById('currentImage');
        img.addEventListener('click', function() {
            if (img.style.transform === 'scale(2)') {
                img.style.transform = 'scale(1)';
                img.style.cursor = 'zoom-in';
            } else {
                img.style.transform = 'scale(2)';
                img.style.cursor = 'zoom-out';
            }
        });
    </script>
    </div>
    <div class="col-md-6">
        <br><br>
    ID: <?=$row['id_pro']?> <br>
    <h5 class="text-success"><?=$row['name_pro']?></h5>
    ประเภทสินค้า: <?=$row['name_type']?> <br>
    ราคา: <b class="text-danger"><?=$row['price_pro']?> </b> บาท <br>
    จากร้าน: <b class="text-info"><?=$row['username']?> </b><br>
    รายละเอียด: <?=$row['detail_pro']?> <br>
    <a class="btn btn-outline-success mt-2" href="pre_order.php?id=<?=$row['id_pro']?>">Pre-Order</a>
    </div>
  </div>
</div>
<?php
mysqli_close($conn);
?>
</body>
</html>