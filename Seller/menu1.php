<?php
@include 'config.php';
?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand ps-3" href="index.php">Dashboard Seller</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                </div>
            </form>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <?php
if(isset($_SESSION["se_name"])){
?>
        <li class="nav-item">
        <b class="nav-link" href="#"> ID : <?=$_SESSION["se_id"]?> ยินดีต้อนรับ : <?=$_SESSION["se_name"]?> สถานะผู้ใช้งาน : <b><?=$_SESSION["Seller"]?></b></b>
        </li>
<?php
}
?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="editprofile.php?id=<?=$_SESSION["se_id"]?>">แก้ไขโปรไฟล์</a></li>
                        <li><a class="dropdown-item" href="editpay_ment.php?id=<?=$_SESSION["se_id"]?>">รายการช่องทางชำระเงิน</a></li>
                        <li><a class="dropdown-item" href="rateweb.php?id=<?=$_SESSION["se_id"]?>">ประเมินเว็ปไซต์</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                รายงานการขาย
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="report_order.php">รายการสั่งซื้อสินค้า</a>
                                    <a class="nav-link" href="report_pre_order.php">รายการสั่ง Pre Order</a>
                                    <a class="nav-link" href="report_order_promotion.php">รายการสั่งซื้อสินค้า Promotion</a>
                                    <a class="nav-link" href="report_sale.php">สรุปยอดขายสินค้า</a>
                                    
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        จัดการสินค้า
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="addproduct.php">เพิ่มสินค้า</a>
                                            <a class="nav-link" href="add_amount_product.php">เพิ่มจำนวนสินค้า</a>
                                            <a class="nav-link" href="stock_product.php">แก้ไขสินค้า</a>
                                            <a class="nav-link" href="report_promotion.php">จัดการโปรโมชั่น</a>
                                            <a class="nav-link" href="product_stock_less_10.php">สินค้าคงเหลือที่น้อยกว่า 10 ชิ้น</a>
                                        </nav>
                                    </div>

                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        จัดการข้อเสนอ
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="report_offer.php">รายการข้อเสนอ</a>
                                        <a class="nav-link" href="report_offer_yes.php">รายงานชำระเงินข้อเสนอ</a>
                                        </nav>
                                    </div>

                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapse" aria-expanded="false" aria-controls="pagesCollapse">
                                        จัดการการรีวิว
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapse" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="seller_edit_review.php">รีวิวสินค้า</a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">

                                </nav>
                            </div>
                        </div>
                        <a class="nav-link" href="report_excuse_product.php">ตรวจสอบการอนุญาตขายสินค้า</a>
                        <a class="nav-link" href="promotion.php">จัดทำโปรโมชั่น</a>
                    </div>
                </nav>
            </div>