<?php
@include 'config.php';
session_start();
if (!isset($_SESSION["bu_username"])) {
    header("location:login.php");
}

$ids = $_SESSION["bu_id"];
?>
<!DOCTYPE html>
<html lang="th">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>จัดการที่อยู่</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        
        <style>
            body {
                background-color: #f8f9fa;
            }
            .container-fluid {
                margin-top: 20px;
            }
            .card-header {
                background-color: #007bff;
                color: white;
            }
            .btn-success {
                background-color: #28a745;
            }
            .btn-danger {
                background-color: #dc3545;
            }
            table {
                text-align: center;
            }
        </style>
    </head>
<body>
    <?php include 'menu.php'; ?>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                รายการที่อยู่
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ชื่อ</th>
                            <th>ที่อยู่</th>
                            <th>รหัสไปรษณีย์</th>
                            <th>เบอร์โทรศัพท์</th>
                            <th>แก้ไข</th>
                            <th>ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT * FROM address WHERE id_member='$ids'";
                    $hand = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($hand)) {
                    ?>
                        <tr>
                            <td><?=$row['ad_name']?></td>
                            <td><?=$row['ad_address']?></td>
                            <td><?=$row['ad_zipcode']?></td>
                            <td><?=$row['telephone_ad']?></td>
                            <td>
                                <a href="insert_edit_address.php?id=<?=$row['id_address']?>" class="btn btn-success btn-sm">
                                    <i class="fas fa-edit"></i> แก้ไข
                                </a>
                            </td>
                            <td>
                                <a href="delete_address.php?id=<?=$row['id_address']?>" class="btn btn-danger btn-sm" onclick="return confirm('คุณต้องการลบที่อยู่นี้หรือไม่?');">
                                    <i class="fas fa-trash-alt"></i> ลบ
                                </a>
                            </td>
                        </tr>
                    <?php } mysqli_close($conn); ?>
                    </tbody>
                </table>
                <div class="text-center">
                    
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                        เพิ่มที่อยู่
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAddressModalLabel">เพิ่มที่อยู่</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="insert_address.php" method="post">
                        <div class="mb-3">
                            <label for="ad_name" class="form-label">ชื่อ</label>
                            <input type="text" name="ad_name" class="form-control" id="ad_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">ที่อยู่</label>
                            <input type="text" name="address" class="form-control" id="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="zipcode" class="form-label">รหัสไปรษณีย์</label>
                            <input type="number" name="zipcode" class="form-control" id="zipcode" required>
                        </div>
                        <div class="mb-3">
                            <label for="tel" class="form-label">เบอร์โทรศัพท์</label>
                            <input type="number" name="tel" class="form-control" id="tel" required>
                        </div>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>