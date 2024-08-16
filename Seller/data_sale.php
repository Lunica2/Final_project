<?php
header('Content-Type: application/json');
include 'config.php';
session_start();
$ids=$_SESSION["se_id"];
//$conn = mysqli_connect("localhost","root","","dbfinal");

$sqlQuery = "SELECT SUM(total_price) as sumtotal, dateMonth FROM tb_order t,order_detail od,product p WHERE t.order_id=od.id_order and od.id_pro=p.id_pro and id_user='$ids' GROUP BY dateMonth ORDER BY dateMonth";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>