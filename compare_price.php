<?php
@include 'config.php';
session_start();
if(!isset($_SESSION["bu_username"]))
header("location:login.php");

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// รับคำค้นหาจากฟอร์ม
$search_query = '';
if (isset($_POST['search'])) {
    $search_query = $_POST['search'];
}

// ดึงข้อมูลหนังสือและราคาจากฐานข้อมูลโดยใช้ Full Text Search
$sql = "SELECT product.name_pro, user_form.username, product.id_pro AS name_pro, product.price_pro,id_pro
        FROM product
        JOIN user_form ON product.id_user = user_form.id_member
        WHERE MATCH(product.name_pro) AGAINST(? IN NATURAL LANGUAGE MODE)
        ORDER BY product.id_pro";

$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $search_query);
$stmt->execute();
$result = $stmt->get_result();

$books = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[$row['name_pro']][] = [
            'store' => $row['username'],
            'price' => $row['price_pro'],
            'id' => $row['id_pro'],
        ];
    }
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เปรียบเทียบราคาหนังสือ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 1rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #333;
            color: #fff;
        }
        .search-form {
            margin-bottom: 20px;
        }
        .search-form input[type="text"] {
            padding: 10px;
            width: 80%;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .search-form input[type="submit"] {
            padding: 10px 20px;
            border: none;
            background-color: #333;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h1>เปรียบเทียบราคาหนังสือ</h1>
        <form class="search-form" method="post" action="">
            <input type="text" name="search" placeholder="ค้นหาหนังสือ..." value="<?php echo htmlspecialchars($search_query); ?>">
            <input type="submit" value="ค้นหา">
        </form>
        <?php if (!empty($books)): ?>
            
                <h2><?php echo htmlspecialchars($search_query); ?></h2>
                <table>
                    <thead>
                        <tr>
                            <th>ร้านค้า</th>
                            <th>ราคา (บาท)</th>
                            <th>ดูสินค้า</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($books as $title => $stores): ?>
                        <?php foreach ($stores as $store): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($store['store']); ?></td>
                                <td><?php echo number_format($store['price'], 2); ?></td>
                                <td><a class="btn btn-outline-success mt-2" href="detail_product.php?id=<?=$store['id']?>">รายละเอียด</a></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            
        <?php else: ?>
            <p>ไม่มีข้อมูลการเปรียบเทียบราคา</p>
        <?php endif; ?>
    </div>
</body>
<div class="text-center">
    <a href="index.php" class="btn btn-primary" role="button">ย้อนกลับ</a>
  </div>
</html>
