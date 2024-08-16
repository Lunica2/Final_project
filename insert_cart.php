<?php
session_start();
include 'config.php';
$cusName=$_POST['cus_name'];
$cusAddress=$_POST['cus_add'];
$cusTel=$_POST['cus_tel'];
$cuszipcode=$_POST['zipcode'];
$dmonth = date("F");

$cusID=$_SESSION["bu_id"];

$sql="insert into tb_order(id,cus_name,address,telephone,total_price,order_status,dateMonth,zipcode)
values('$cusID','$cusName','$cusAddress','$cusTel','". $_SESSION["sum_price"] . "','1','$dmonth','$cuszipcode')";
mysqli_query($conn,$sql);

$orderID = mysqli_insert_id($conn);
$_SESSION["order_id"] = $orderID;

for($i=0;$i <=(int)$_SESSION["intLine"]; $i++){
    if(($_SESSION["strProductID"][$i]) != ""){

        $sql1="select * from product where id_pro = '" . $_SESSION["strProductID"][$i] ."' ";
        $result1=mysqli_query($conn,$sql1);
        $row1=mysqli_fetch_array($result1);
        $price = $row1['price_pro'];
        $total = $_SESSION["strQty"][$i] * $price;

        $sql5 = "update sell set sell_amount= sell_amount + ('" . $_SESSION["strQty"][$i] ."' )
        where id_pro='" . $_SESSION["strProductID"][$i] ."' ";
        mysqli_query($conn,$sql5);

        $sql6 = "update sell set sell_month='$dmonth'
        where id_pro='" . $_SESSION["strProductID"][$i] ."' ";
        mysqli_query($conn,$sql6);

        $sql7 = "update sell set id_member='$cusID'
        where id_pro='" . $_SESSION["strProductID"][$i] ."' ";
        mysqli_query($conn,$sql7);

        $sql2="insert into order_detail(item_amount,total,id_pro,id_order)
        values('".$_SESSION["strQty"][$i] ."','$total','" . $_SESSION["strProductID"][$i] ."','$orderID')";
        if(mysqli_query($conn,$sql2)){

            $sql3 = "update product set amount= amount - '" . $_SESSION["strQty"][$i] ."' 
            where id_pro='" . $_SESSION["strProductID"][$i] ."' ";
            mysqli_query($conn,$sql3);
            //echo "<script> alert('บันทึกเรียบร้อย') </script> ";
            echo "<script> window.location='print_order.php'; </script>";
        }
    }
}
mysqli_close($conn);
unset($_SESSION["intLine"]);
unset($_SESSION["strProductID"]);
unset($_SESSION["strQty"]);
unset($_SESSION["sum_price"]);

?>