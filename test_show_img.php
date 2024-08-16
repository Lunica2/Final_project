<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Viewer</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        .viewer {
            position: relative;
        }
        .viewer img {
            max-width: 100%;
            max-height: 80vh;
            transition: transform 0.25s ease;
            cursor: zoom-in;
        }
        .controls {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
        .controls button {
            padding: 10px;
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <div class="viewer">
        <img id="currentImage" width="300px" height="350" src="" alt="Image Viewer">
    </div>
    <div class="controls">
        <button onclick="prevImage()">Previous</button>
        <button onclick="nextImage()">Next</button>
    </div>

    <script>
        let images = [];
        let currentIndex = 0;

        // Fetch images from the server
        fetch('fetch_images.php')
            .then(response => response.json())
            .then(data => {
                images = data;
                if (images.length > 0) {
                    document.getElementById('currentImage').src = images[0];
                }
            });

        function showImage(index) {
            if (index >= 0 && index < images.length) {
                document.getElementById('currentImage').src = images[index];
                currentIndex = index;
            }
        }

        function prevImage() {
            if (currentIndex > 0) {
                showImage(currentIndex - 1);
            }
        }

        function nextImage() {
            if (currentIndex < images.length - 1) {
                showImage(currentIndex + 1);
            }
        }

        // Zoom functionality
        const img = document.getElementById('currentImage');
        img.addEventListener('click', function() {
            if (img.style.transform === 'scale(2)') {
                img.style.transform = 'scale(1)';
                img.style.cursor = 'zoom-in';
            } else {
                img.style.transform = 'scale(2)';
                img.style.cursor = 'zoom-out';
            }
        });
    </script>
</body>
</html>
