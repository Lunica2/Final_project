<?php
session_start();
include 'config.php';

$cusAddress=$_POST['cus_add'];
$cusname=$_POST['ad_name'];
$cuszipcode = $_POST['zipcode'];
$cusTel = $_POST['telephone_ad'];
$cusID=$_SESSION["bu_id"];
$qty = $_POST['qty'];

$sql="insert into pre_order(id_member,pre_status,address,pre_name,pre_tel,pre_zip)
values('$cusID','1','$cusAddress','$cusname','$cusTel','$cuszipcode')";
mysqli_query($conn,$sql);

$orderPre = mysqli_insert_id($conn);
$_SESSION["id_pre"] = $orderPre;

for($i=0;$i <=(int)$_SESSION["intLine"]; $i++){
    if(($_SESSION["strProductID"][$i]) != ""){

        $sql1="select * from product where id_pro = '" . $_SESSION["strProductID"][$i] ."' ";
        $result1=mysqli_query($conn,$sql1);
        $row1=mysqli_fetch_array($result1);
        $price = $row1['price_pro'];
        $total = $qty * $price;

        $sql2="insert into pre_order_detail(item_amount,total,id_pro,id_pre)
        values('$qty','$total','" . $_SESSION["strProductID"][$i] ."','$orderPre')";
        mysqli_query($conn,$sql2);

        $sql3="UPDATE pre_order set id_pro ='" . $_SESSION["strProductID"][$i] ."'
        where id_pre='$orderPre'";
        mysqli_query($conn,$sql3);

        $sql4="UPDATE pre_order set total_price_pre='$total'
        where id_pre='$orderPre'";
        mysqli_query($conn,$sql4);

            echo "<script> window.location='print_pre_order.php'; </script>";
        }
    }
mysqli_close($conn);
unset($_SESSION["intLine"]);
unset($_SESSION["strQty"]);
unset($_SESSION["sum_price"]);

?>