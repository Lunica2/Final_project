<?php
@include 'config.php';

session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>My Shop</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php
        include 'menu1.php';
        ?>
            <div id="layoutSidenav_content">
                <main><br>
                    <div class="container-fluid px-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                รายการผู้ใช้งาน
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Telephone</th>
                                            <th>Type</th>
                                            <th>แก้ไข</th>
                                            <th>ลบ</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>username</th>
                                            <th>user_type</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                    $sql="SELECT * FROM user_form";
                                    $hand=mysqli_query($conn,$sql);
                                    while($row=mysqli_fetch_array($hand)){
                                    ?>
                                        <tr>
                                            <td><?=$row['id_member']?></td>
                                            <td><?=$row['username']?></td>
                                            <td><?=$row['name']?></td>
                                            <td><?=$row['email']?></td>
                                            <td><?=$row['telephone']?></td>
                                            <td><?=$row['user_type']?></td>
                                            <td><a href="insert_edit.php?id=<?=$row['id_member']?>" class="btn btn-success">แก้ไข</a></td>
                                            <td><a href="delete_user.php?id=<?=$row['id_member']?>" class="btn btn-danger">ลบ</a></td>
                                        </tr>
                                        <?php
                                        }
                                        mysqli_close($conn);
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <?php
        include 'footer.php';
        ?>
            </div>
        </div>
        
    </body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>