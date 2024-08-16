<?php
include 'config.php';
session_start();
$ids=$_GET['id'];
$sql="SELECT * FROM product WHERE id_pro='$ids' ";
$hand=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($hand);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script></head>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="review.css">
</head>
<body>
<div class="wrapper">
<img src="./img/<?=$row['photo_pro']?>" width="200" height="200"><br>
                    <div class="mb-3 mt-3 h3">
                    รหัสสินค้า: <?=$row['id_pro']?><br>
                    ชื่อสินค้า: <?=$row['name_pro']?>
                    </div>
		<form method="POST" action="insert_review_new.php">
			<div class="rating">
				<input type="number" name="rating" hidden>
				<i class='bx bx-star star' style="--i: 0;"></i>
				<i class='bx bx-star star' style="--i: 1;"></i>
				<i class='bx bx-star star' style="--i: 2;"></i>
				<i class='bx bx-star star' style="--i: 3;"></i>
				<i class='bx bx-star star' style="--i: 4;"></i>
			</div>
            <label class="h6">รหัสสินค้า</label>
            <input type="text" name="id_pro" class="form-control text-center" id="id_pro" readonly value="<?=$row['id_pro']?>">
			<label class="h6">รหัสสมาชิก</label>
            <input type="text" name="id_user" class="form-control text-center" id="id_user" readonly value="<?=$_SESSION["bu_id"]?>">
            <label class="h6">ชื่อสมาชิก</label>
	        <textarea class="form-control" name="user_name" id="user_name"  rows="1" readonly ><?=$_SESSION["bu_name"]?></textarea>
			<textarea name="opinion" cols="30" rows="5" placeholder="Your opinion..."></textarea>
			<div class="btn-group">
				<button type="submit" class="btn submit">Submit</button>
			</div>
		</form>
		<div class="btn-group">
		<a class="btn cancel" href="review.php">Cancel</a>
		</div>
	</div>
</body>
</html>

<script>
    const allStar = document.querySelectorAll('.rating .star')
const ratingValue = document.querySelector('.rating input')

allStar.forEach((item, idx)=> {
	item.addEventListener('click', function () {
		let click = 0
		ratingValue.value = idx + 1

		allStar.forEach(i=> {
			i.classList.replace('bxs-star', 'bx-star')
			i.classList.remove('active')
		})
		for(let i=0; i<allStar.length; i++) {
			if(i <= idx) {
				allStar[i].classList.replace('bx-star', 'bxs-star')
				allStar[i].classList.add('active')
			} else {
				allStar[i].style.setProperty('--i', click)
				click++
			}
		}
	})
})
</script>