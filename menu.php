<?php
@include 'config.php';
?>
<style>
  .nav-link {
    text-decoration: none;
    position: relative;
    transition: all 0.3s ease; 
    padding: 5px 10px;
    border: 2px solid transparent;
}

.nav-link::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 0;
    left: 0;
    background-color: #000;
    visibility: hidden;
    transition: all 0.3s ease-in-out;
}

.nav-link:hover::after {
    visibility: visible;
    width: 100%; 
}

.nav-link:hover {
    border-color: #000; 
    border-radius: 5px;
}
</style>
<nav class="navbar navbar-expand-lg" style="background-color: #f8f9fa;">
  <div class="container">
    <a class="navbar-brand" href="index.php">Myshop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link btn btn-primary me-2" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-success me-2" href="buyer.php">Product</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link btn btn-warning dropdown-toggle me-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            อื่น ๆ
          </a>
          <ul class="dropdown-menu">
            <?php
            if (isset($_SESSION["bu_id"])) {
            ?>
            <li><a class="dropdown-item" href="payment.php?id=<?=$_SESSION["bu_id"]?>" hidden>แจ้งชำระเงิน</a></li>
            <?php
            }
            ?>
            <li><a class="dropdown-item" href="report_pre_order.php" hidden>รายการ Pre Order</a></li>
            <li><a class="dropdown-item" href="check_order.php">ตรวจสอบสถานะการสั่งซื้อ</a></li>
            <li><a class="dropdown-item" href="check_pre.php">ตรวจสอบสถานะการ Pre Order</a></li>
            <li><a class="dropdown-item" href="review.php">รีวิวสินค้าที่สั่งซื้อ</a></li>
            <li><a class="dropdown-item" href="report_offer.php">รายการจัดข้อเสนอ</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-info me-2" href="rateweb.php">รีวิวเว็บไซต์</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-info me-2" href="suggestion.php">หนังสือแนะนำ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-info me-2" href="compare_price.php">เปรียบเทียบราคาหนังสือ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-warning me-2" href="show_promotion.php">รายการโปรโมชั่น</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php">
            <img src="img/cart.png" alt="Cart Logo" style="width:30px;">
          </a>
        </li>
        <?php
        if (!isset($_SESSION["bu_name"])) {
        ?>
        <li class="nav-item">
          <a class="nav-link btn btn-danger me-2" href="login.php">Login</a>
        </li>
        <?php
        }
        ?>
      </ul>

      <ul class="navbar-nav ms-auto">
        <?php
        if (isset($_SESSION["bu_name"])) {
        ?>
        <li class="nav-item">
          <span class="navbar-text"> <div hidden>ID : <?=$_SESSION["bu_id"]?></div> ยินดีต้อนรับ : <?=$_SESSION["bu_name"]?> สถานะผู้ใช้งาน : <b><?=$_SESSION["bu_type"]?></b></span>
        </li>
        <?php
        }
        ?>
      </ul>

    </div>
  </div>
  <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="img/user.png" alt="Avatar Logo" style="width:30px;" class="rounded-pill">
      </a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <?php
        if (isset($_SESSION["bu_name"])) {
        ?>
        <li><a class="dropdown-item" href="editprofile.php?id=<?=$_SESSION["bu_id"]?>">แก้ไขโปรไฟล์</a></li>
        <li><a class="dropdown-item" href="editaddress.php?id=<?=$_SESSION["bu_id"]?>">แก้ไขที่อยู่</a></li>
        <?php
        }
        ?>
        <li><a class="dropdown-item" href="Seller/index.php">เข้าสู่ระบบ Seller</a></li>
        <li><a class="dropdown-item" href="admin/index.php">เข้าสู่ระบบ admin</a></li>
        <?php
        if (isset($_SESSION["bu_name"])) {
        ?>
        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        <?php
        }
        ?>
      </ul>
    </li>
  </ul>
</nav>