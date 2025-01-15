<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán thành công</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #28a745; /* Màu xanh thành công */
        }
        p {
            font-size: 18px;
            color: #333;
        }
        .btn-primary {
            background-color: #007bff; /* Màu xanh Bootstrap */
            border-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none; /* Xóa gạch chân */
            border-radius: 5px; /* Bo góc cho nút */
            transition: background-color 0.3s, box-shadow 0.3s; /* Hiệu ứng hover */
            display: inline-block;
            margin-top: 20px;
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Màu xanh đậm hơn khi hover */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Tăng đổ bóng */
        }
        .success-image {
            width: 100px;
            height: auto;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <img src="../img/0oxhzjmxbksr1686814746087.png" alt="Success" class="success-image">
        <h2>Thanh toán thành công</h2>
        <p>Cảm ơn bạn đã thanh toán học phí.</p>
        <a href="?hocphi" class="btn btn-primary">Quay lại danh sách học phí</a>
    </div>
</body>
</html>