<?php
@include 'config.php';
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="index.php">Myshop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="buyer.php">Product</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            อื่น ๆ
          </a>
          <ul class="dropdown-menu">
          <?php
if(isset($_SESSION["bu_id"])){
?>
            <li><a class="dropdown-item" href="payment.php?id=<?=$_SESSION["bu_id"]?>">แจ้งชำระเงิน</a></li>
<?php
}
?>
            <li><a class="dropdown-item" href="payment_pre.php">ชำระเงินการ Pre Order</a></li>
            <li><a class="dropdown-item" href="check_order.php">ตรวจสอบสถานะการสั่งซื้อ</a></li>
            <li><a class="dropdown-item" href="check_pre.php">ตรวจสอบสถานะการ Pre Order</a></li>
            <li><a class="dropdown-item" href="review.php">รีวิวสินค้าที่สั่งซื้อ</a></li>
            <li><a class="dropdown-item" href="report_offer.php">รายการจัดข้อเสนอ</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin/index.php">admin</a>
        </li>
        <?php
if(!isset($_SESSION["bu_name"])){
?>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <?php
}
?>
        <li class="nav-item">
          <a class="nav-link" href="Seller/index.php">Seller</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="rateweb.php">รีวิวเว็บไซต์</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="suggestion.php">หนังสือแนะนำ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="compare_price.php">เปรียบเทียบราคาหนังสือ</a>
        </li>
<?php
if(isset($_SESSION["bu_name"])){
?>
        <li class="nav-item">
          <b class="nav-link" href="#"> ID : <?=$_SESSION["bu_id"]?> ยินดีต้อนรับ : <?=$_SESSION["bu_name"]?></b>
        </li>
<?php
}
?>
<li class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4m">
<a class="nav-link"  href="cart.php" role="button" aria-expanded="false"><img src="img/cart.png" alt="Cart Logo" style="width:30px;" class="rounded-pill"></a>
</li>

      </ul>
      <!--<form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->
      
    </div>
  </div>
  <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="img/user.png" alt="Avatar Logo" style="width:30px;" class="rounded-pill"></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <?php
if(isset($_SESSION["bu_name"])){
?>
                        <li><a class="dropdown-item" href="address.php?id=<?=$_SESSION["bu_id"]?>">เพิ่มที่อยู่ในการจัดส่ง</a></li>
                        <?php
}
?>
<?php
if(isset($_SESSION["bu_name"])){
?>
                        <li><a class="dropdown-item" href="editprofile.php?id=<?=$_SESSION["bu_id"]?>">แก้ไขโปรไฟล์</a></li>
                        <?php
}
?>
<?php
if(isset($_SESSION["bu_name"])){
?>
                        <li><a class="dropdown-item" href="editaddress.php?id=<?=$_SESSION["bu_id"]?>">แก้ไขที่อยู่</a></li>
                        <?php
}
?>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
</nav>