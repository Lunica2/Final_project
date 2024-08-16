<?php
include 'config.php';

if(isset($_POST['function']) && $_POST['function'] == 'address'){
    $id = $_POST['id'];
    $sql ="SELECT * FROM address WHERE address='$id'";
    $query = mysqli_query($conn,$sql);
    $result = mysqli_fetch_assoc($query);
    echo $result['zipcode'];
    exit();
}
?>