<?php
@include 'config.php';

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรโมชั่น</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 600px;
            border-radius: 8px;
        }

        .form-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"], input[type="number"], textarea {
            width: calc(100% - 20px);
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
            resize: none;
        }

        .upload-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .image-preview {
            width: 200px;
            height: 200px;
            border: 2px solid #ccc;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f9f9f9;
            margin-right: 20px;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 100%;
        }

        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>จัดทำโปรโมชั่น</h2>

        <form action="insert_promotion.php" method="post" enctype="multipart/form-data">
            <div class="form-group upload-container">
                <div class="image-preview" id="imagePreview">
                    <span>No image selected</span>
                </div>
                <div>
                    <label for="productImage">รูปภาพสินค้า:</label>
                    <input type="file" name="file1" id="productImage" accept="image/*" onchange="previewImage(event)" required>
                </div>
            </div>

            <div class="form-group">
                <label for="productName">*ชื่อสินค้า:</label>
                <input type="text" name="pname" id="productName" placeholder="Enter product name" required>
            </div>

            <div class="form-group">
                <label for="productDetails">รายละเอียดโปรโมชั่น:</label>
                <textarea name="promotiondetails" id="productDetails" placeholder="Enter product details" required></textarea>
            </div>

            <div class="form-group">
                <label for="amount">จำนวนสินค้าในโปรโมชั่น:</label>
                <input type="number" name="amount" id="amount" placeholder="Enter amount" required>
            </div>

            <div class="form-group">
                <label for="productPrice">*ราคา:</label>
                <input type="number" name="price" id="productPrice" step="0.01" placeholder="Enter product price" required>
            </div>

            <div class="form-group">
    <label for="startDate">*วันที่เริ่มต้น:</label>
    <input type="date" name="start_date" id="startDate" required>
</div>

<div class="form-group">
    <label for="endDate">*วันที่สิ้นสุด:</label>
    <input type="date" name="end_date" id="endDate" required>
</div>

            <input type="submit" value="Submit Promotion" class="submit-btn">
            <a class="btn btn-danger" href="index.php" role="button">Cancel</a>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const imagePreview = document.getElementById('imagePreview');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                const img = document.createElement('img');
                img.src = reader.result;

                imagePreview.innerHTML = '';
                imagePreview.appendChild(img);
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                imagePreview.innerHTML = '<span>No image selected</span>';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
        const today = new Date().toISOString().split('T')[0];

        const startDateInput = document.getElementById('startDate');
        const endDateInput = document.getElementById('endDate');
        
        startDateInput.setAttribute('min', today);

    
        startDateInput.addEventListener('change', function () {
            endDateInput.setAttribute('min', this.value);
        });

        
        endDateInput.setAttribute('min', today);
    });
    </script>
</body>
</html>