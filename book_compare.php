<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_store";

// สร้างการเชื่อมต่อกับฐานข้อมูล
$conn = new mysqli($servername, $username, $password, $dbname);

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
$sql = "SELECT books.title, stores.name AS store_name, book_prices.price
        FROM book_prices
        JOIN books ON book_prices.book_id = books.id
        JOIN stores ON book_prices.store_id = stores.id
        WHERE MATCH(books.title, books.author) AGAINST(? IN NATURAL LANGUAGE MODE)
        ORDER BY books.title, book_prices.price";

$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $search_query);
$stmt->execute();
$result = $stmt->get_result();

$books = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[$row['title']][] = [
            'store' => $row['store_name'],
            'price' => $row['price']
        ];
    }
} else {
    echo "ไม่มีข้อมูล";
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
</head>
<body>
    <div class="container">
        <h1>เปรียบเทียบราคาหนังสือ</h1>
        <form class="search-form" method="post" action="">
            <input type="text" name="search" placeholder="ค้นหาหนังสือ..." value="<?php echo htmlspecialchars($search_query); ?>">
            <input type="submit" value="ค้นหา">
        </form>
        <?php if (!empty($books)): ?>
            <?php foreach ($books as $title => $stores): ?>
                <h2><?php echo htmlspecialchars($title); ?></h2>
                <table>
                    <thead>
                        <tr>
                            <th>ร้านค้า</th>
                            <th>ราคา (บาท)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($stores as $store): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($store['store']); ?></td>
                                <td><?php echo number_format($store['price'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endforeach; ?>
        <?php else: ?>
            <p>ไม่มีข้อมูลการเปรียบเทียบราคา</p>
        <?php endif; ?>
    </div>
</body>
</html>
