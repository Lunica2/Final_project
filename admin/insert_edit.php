<?php
include 'config.php';

session_start();
?>
<?php
$ID=$_GET['id'];
$sql1="SELECT * FROM user_form WHERE id='$ID' ";
$hand=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_array($hand);
$Utype_id=$row1['user_type'];
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
        include 'menu1.php';
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
                            <form name="form1" method="post" action="update_user.php" enctype="multipart/form-data">
                    <label>ID: </label>
                    <input type="text" name="uid" class="form-control" readonly value=<?=$row1['id']?>> <br>
                    <label>Username: </label>
                    <textarea name="username" class="form-control" ><?=$row1['username']?></textarea> <br>
                    <label>Name: </label>
                    <textarea name="uname" class="form-control" ><?=$row1['name']?></textarea> <br>
                    <label>Email: </label>
                    <input type="text" name="email" class="form-control" readonly value=<?=$row1['email']?>> <br>
                    <label>Telephone: </label>
                    <input name="tel" class="form-control" value=<?=$row1['telephone']?> > <br>
                    <label>Type: </label>
                    <select name="user_type">
        <option value="Buyer">Buyer</option>
        <option value="Seller">Seller</option>
        </select>
        <br> <br>
        <label>Bank: </label>
                    <select name="bank">
        <option value="ธนาคารกรุงเทพ">ธนาคารกรุงเทพ</option>
        <option value="ธนาคารกสิกรไทย">ธนาคารกสิกรไทย</option>
        <option value="ธนาคารไทยพาณิชย์">ธนาคารไทยพาณิชย์</option>
        </select>
        <br> <br>
        <label>เลขที่บัญชี : </label>
                    <input name="bank_number" class="form-control" value=<?=$row1['bank_number']?> > <br>
<br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-danger" href="edit_user.php" role="button">Cancel</a>
                </form>
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

<?php
 mysqli_close($conn);
 ?>