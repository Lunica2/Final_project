<?php
include 'config.php';
session_start();
$ids = $_GET['id'];
$sql = "SELECT * FROM product WHERE id_pro='$ids'";
$hand = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($hand);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รีวิวสินค้า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            background: linear-gradient(135deg, #d3d5d0 0%, #fad0c4 100%);
        }

        .wrapper {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        img {
            display: block;
            margin: 0 auto;
            border-radius: 8px;
        }

        .h3 {
            text-align: center;
            font-size: 1.75rem;
            margin-top: 10px;
            color: #343a40;
        }

        .form-control {
            margin-bottom: 15px;
            border-radius: 8px;
        }

        .rating {
            text-align: center;
            margin-bottom: 20px;
        }

        .rating i {
            font-size: 30px;
            color: #ccc;
            transition: color 0.3s;
        }

        .rating i.active {
            color: #fbc02d;
        }

        .btn-group {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 25px;
        }

        .submit {
            background-color: #28a745;
            color: #fff;
        }

        .submit:hover {
            background-color: #218838;
        }

        .cancel {
            background-color: #dc3545;
            color: #fff;
        }

        .cancel:hover {
            background-color: #c82333;
        }

        textarea {
            border-radius: 8px;
            padding: 10px;
            width: 100%;
            font-size: 1rem;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <img src="./img/<?=$row['photo_pro']?>" alt="<?=$row['name_pro']?>" width="200" height="200">
    <div class="mb-3 mt-3 h3">
        รหัสสินค้า: <?=$row['id_pro']?><br>
        ชื่อสินค้า: <?=$row['name_pro']?>
    </div>
    
    <form method="POST" action="insert_review_new.php">
        <div class="rating">
            <input type="number" name="rating" hidden required>
            <i class='bx bx-star star' style="--i: 0;"></i>
            <i class='bx bx-star star' style="--i: 1;"></i>
            <i class='bx bx-star star' style="--i: 2;"></i>
            <i class='bx bx-star star' style="--i: 3;"></i>
            <i class='bx bx-star star' style="--i: 4;"></i>
        </div>
        <label class="h6" hidden>รหัสสินค้า</label>
        <input type="text" name="id_pro" class="form-control text-center" id="id_pro" readonly hidden value="<?=$row['id_pro']?>">
        
        <label class="h6" hidden>รหัสสมาชิก</label>
        <input type="text" name="id_user" class="form-control text-center" id="id_user" hidden readonly value="<?=$_SESSION["bu_id"]?>">
        
        <label class="h6">ชื่อสมาชิก</label>
        <textarea class="form-control" name="user_name" id="user_name" rows="1" readonly><?=$_SESSION["bu_name"]?></textarea>
        
        <label class="h6">*ความคิดเห็นของคุณ</label>
        <textarea name="opinion" class="form-control" cols="30" rows="5" placeholder="Your opinion..." required></textarea>
        
        <div class="btn-group mt-4">
            <button type="submit" class="btn submit">Submit</button>
            <a class="btn cancel" href="review.php">Cancel</a>
        </div>
    </form>
</div>

<script>
    const allStar = document.querySelectorAll('.rating .star');
    const ratingValue = document.querySelector('.rating input');

    allStar.forEach((item, idx) => {
        item.addEventListener('click', function() {
            ratingValue.value = idx + 1;
            
            allStar.forEach(i => {
                i.classList.replace('bxs-star', 'bx-star');
                i.classList.remove('active');
            });
            
            for (let i = 0; i <= idx; i++) {
                allStar[i].classList.replace('bx-star', 'bxs-star');
                allStar[i].classList.add('active');
            }
        });
    });
</script>

</body>
</html>
