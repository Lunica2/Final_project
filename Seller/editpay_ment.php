<?php
@include 'config.php';
session_start();
if (!isset($_SESSION["se_username"]))
    header("location:login.php");

$ids = $_SESSION["se_id"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Payment Methods" />
    <meta name="author" content="Your Name" />
    <title>My Shop - Payment Methods</title>

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="sb-nav-fixed">
    <?php include 'menu1.php'; ?>

    <div id="layoutSidenav_content">
        <main class="mt-4">
            <div class="container-fluid px-4">
                <div class="card mb-4 shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-credit-card me-2"></i>
                        รายการช่องทางชำระเงิน
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatablesSimple" class="table table-hover table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ไอดี</th>
                                        <th>ช่องทาง</th>
                                        <th>เลขที่บัญชี</th>
                                        <th>แก้ไข</th>
                                        <th>ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM payment_methods WHERE id_member='$ids'";
                                    $hand = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_array($hand)) {
                                    ?>
                                        <tr>
                                            <td><?= $row['id_payment'] ?></td>
                                            <td><?= $row['bank'] ?></td>
                                            <td><?= $row['bank_number'] ?></td>
                                            <td>
                                                <a href="edit_payment_select.php?id=<?= $row['id_payment'] ?>" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i> แก้ไข
                                                </a>
                                            </td>
                                            <td>
                                                <a href="delete_payment.php?id=<?= $row['id_payment'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('ยืนยันการลบช่องทางชำระเงินนี้?');">
                                                    <i class="fas fa-trash-alt"></i> ลบ
                                                </a>
                                            </td>
                                        </tr>
                                        
                                    <?php
                                    }
                                    mysqli_close($conn);
                                    ?>
                                </tbody>
                            </table>
                            <div class="text-center">

    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPaymentModal">
        เพิ่มช่องทางชำระเงิน
    </button>
</div>


<div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPaymentModalLabel">เพิ่มช่องทางชำระเงิน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="insert_payment.php" method="post">
                    <div class="mb-3">
                        <label for="bank" class="form-label">ธนาคาร</label>
                        <input type="text" class="form-control" id="bank" name="bank" required placeholder="*ธนาคาร">
                    </div>
                    <div class="mb-3">
                        <label for="bank_number" class="form-label">เลขที่บัญชี</label>
                        <input type="number" class="form-control" id="bank_number" name="bank_number" required placeholder="*เลขที่บัญชี">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-primary">เสร็จสิ้น</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>
