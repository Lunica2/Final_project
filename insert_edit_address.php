<?php
include 'config.php';

session_start();
?>
<?php
$ID=$_GET['id'];
$sql1="SELECT * FROM address WHERE id_address='$ID' ";
$hand=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_array($hand);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>report</title>
        <link rel="stylesheet" href="style/style_register.css">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php
        include 'menu.php';
        ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        

                        <div class="card mb-4 mt-4">
                            <div class="card-header">
                                แก้ไขข้อมูล
                                 <br>
                            <div>

                            </div>
                            
                            <div class="card-body">
                            <form name="form1" method="post" action="update_address.php" enctype="multipart/form-data">
                    <label>ID: </label>
                    <input type="text" name="uid" class="form-control" readonly value=<?=$ID?>> <br>
                    <label>ที่อยู่: </label>
                    <textarea name="address" class="form-control" ><?=$row1['address']?></textarea> <br>
                    <label>รหัสไปรษณีย์: </label>
                    <textarea name="zipcode" class="form-control" ><?=$row1['zipcode']?></textarea> <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-danger" href="editaddress.php" role="button">Cancel</a>
                </form>
                            </div>
                        </div>
                    </div>
                </main>
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

<?php
 mysqli_close($conn);
 ?>