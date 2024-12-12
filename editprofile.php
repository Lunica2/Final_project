<?php
@include 'config.php';

session_start();

if(!isset($_SESSION["bu_username"])) {
    header("location:login.php");
}

$ID = $_GET['id'];
$sql1 = "SELECT * FROM user_form WHERE id_member='$ID' ";
$hand = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_array($hand);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไข Profile</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #f0f0f5;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
        }
        .form-control {
            margin-bottom: 15px;
            border-radius: 8px;
            padding: 10px;
        }
        .btn-primary, .btn-danger {
            display: block;
            width: 100%;
            padding: 10px;
            border-radius: 25px;
            margin-top: 10px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .error-msg {
            color: #dc3545;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="form-container">
    <form action="insert_edit_pro.php" method="post">
        <h3>Edit Profile</h3>

        <?php
        if (isset($error)) {
            foreach ($error as $error) {
                echo '<span class="error-msg">' . $error . '</span>';
            }
        }
        ?>

        <input type="text" name="uid" class="form-control text-center" hidden readonly value="<?=$row1['id_member']?>">
        <label class="mt-1">UserName</label>
        <input type="text" name="username" class="form-control" value="<?=$row1['username']?>">

        <label class="mt-1">Name</label>
        <input type="text" name="uname" class="form-control" value="<?=$row1['name']?>">

        <label class="mt-1">Email</label>
        <input type="text" name="email" class="form-control" readonly value="<?=$row1['email']?>">

        <label class="mt-1">Tel.</label>
        <input name="tel" class="form-control" value="<?=$row1['telephone']?>"><br>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-danger" href="index.php" role="button">Cancel</a>
    </form>
</div>

</body>
</html>