<?php

include_once("controller/TaiKhoan/ctaikhoan.php");
include_once("model/TaiKhoan/mtaikhoan.php");
require_once __DIR__ . '../../vendor/autoload.php';

use Pusher\Pusher;

$p = new mtaikhoan();
$account = new ctaikhoan();

$options = [
    'cluster' => 'ap1',
    'useTLS' => true
];
$pusher = new Pusher(
    '03dc77ca859c49e35e41',
    '5f7dc7d158c95e25a5e2',
    '1873489',
    $options
);

if (isset($_POST['submit'])) {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    $account->login($username, $password);
    if(isset($_SESSION['idChuyenVien']) || isset($_SESSION['login_admin'])){
        $p->updateStatus($_SESSION['idChuyenVien'], 'online');
        
        // Phát sự kiện Pusher
        $data = [
            'user_id' => $_SESSION['idChuyenVien'],
            'status' => 'online',
            'last_activity' => date('Y-m-d H:i:s')
        ];
        $pusher->trigger('status-channel', 'status-updated', $data);
        
        error_log("Pusher event triggered for login");
        
        echo "<script>
        alert('Đăng nhập thành công');
        setTimeout(function() {
            window.location.href = '../admin/';
        }, 1000);
      </script>";
        header("Location:../admin/");
        exit();
    } else {
        error_log("Login failed or session not set");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Control Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .title h2 {
            color: #337ab7;
            text-align: center;
            margin: 0;
            padding-bottom: 10px;
        }
        .form-row {
            margin-bottom: 15px;
            position: relative;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            padding-left: 40px; /* Add padding to make space for the icon */
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-row i {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #aaa;
        }
        .btn-login {
            width: 100%;
            padding: 10px;
            background-color: #337ab7;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-login:hover {
            background-color: #286090;
        }
        .error-message {
            color: red;
            margin-top: 10px;
            text-align: center;
        }
        .navbar {
            background-color: #fff;
            border-top: 1px solid #ddd;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .navbar .container {
            text-align: center;
        }
        .navbar h5 {
            margin: 0;
            color: #333;
        }
        .navbar a {
            color: red;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">
            <h2>QUẢN TRỊ HỆ THỐNG</h2>
        </div>
        <hr>
        <div class="myform">
            <form name="form1" action="" method="post">
                <div class="form-row">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập">
                </div>
                <div class="form-row">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                </div>
                <div class="form-row">
                    <button type="submit" name="submit" class="btn btn-login">Đăng nhập</button>
                </div>
            </form>
            <?php
            if (isset($error)) {
                echo '<div class="error-message">' . $error . '</div>';
            }
            ?>
        </div>
    </div>
    <nav class="navbar navbar-fixed-bottom" role="navigation">
       
            <h5 class="text-center">Copyright © 2024 <a href="#">QUẢN LÝ CHUYÊN BIỆT</a>. All rights reserved.</h5>
    </nav>
</body>
</html>
