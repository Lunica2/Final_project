<?php
header('Content-Type: application/json');
include 'config.php';
//$conn = mysqli_connect("localhost","root","","dbfinal");

$sqlQuery = "SELECT SUM(total_price) as sumtotal, dateMonth FROM tb_order GROUP BY dateMonth  ORDER BY dateMonth";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>