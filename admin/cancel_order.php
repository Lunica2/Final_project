<?php
include 'config.php';
$ids=$_GET['id'];
$conn->begin_transaction();
try {
    // ดึงข้อมูลการสั่งซื้อ
    $sql = "SELECT * FROM tb_order t,product p,order_detail od WHERE t.order_id=od.id_order and od.id_pro=p.id_pro and t.order_id = $ids";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    // อัปเดตจำนวนสินค้าคืน
    while ($row = $result->fetch_assoc()) {
        $product_id = $row['id_pro'];
        $quantity = $row['amount'];
        $amount = $row['item_amount'];

        $update_sql = "UPDATE product SET amount = amount + '$amount ' WHERE id_pro = '$product_id'";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->execute();
    }
    // ทำการ commit การ transaction
    $conn->commit();

    echo "Order has been cancelled and stock has been updated.";
} catch (Exception $e) {
    // ยกเลิกการ transaction ถ้ามีข้อผิดพลาด
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

$sql1="UPDATE tb_order SET order_status = 0 WHERE order_id='$ids' ";
$result=mysqli_query($conn,$sql1);
if($result){
    echo "<script>window.location='report_order.php'; </script>";
}else{
    echo "<script>alert('ไม่สามารถลบได้'); </script>";
}
$conn->commit();
mysqli_close($conn);
?>