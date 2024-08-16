<?php
header('Content-Type: application/json');
include 'config.php';
session_start();
$ids=$_SESSION["se_id"];
//$conn = mysqli_connect("localhost","root","","dbfinal");

$sqlQuery = "SELECT * FROM product WHERE id_user='$ids' and status_pro='1' ORDER BY id_pro";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>