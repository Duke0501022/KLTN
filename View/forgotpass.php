
<style>
  body {
    font-family: 'Arial', sans-serif;
    
    background: url(../kindergarten-website-template/img/login.jpg);
  }
  .login-container {
    max-width: 400px;
    margin: 100px auto;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px 0px #000000;
  }
  .header-text {
    margin-bottom: 30px;
    color: #333333;
    text-align: center;
  }
  .custom-btn {
    background-color: #f8b400;
    color: white;
    border: none;
  }
  .custom-btn:hover {
    background-color: #e5a300;
  }
  .form-link {
    color: #333333;
    text-align: center;
    display: block;
    margin-top: 15px;
  }
</style>
</head>
<body>

<?php
include_once("Controller/KhachHangDoanhNghiep/cKhachHangDoanhNghiep.php");
$p = new cKHDN();
$TK = $p->select_KHDN();
$fail = array();

if (isset($_POST['btn-forgot'])) {
    $fail = array();
    $emailMatch = false;
    $email = $_POST['email'];
    
    // Kiểm tra email trống
    if(empty($email)) {
        $fail['check'] = 'Vui lòng nhập email!';
    } else {
        foreach ($TK as $item) {
            if ($email == $item['email']) {
                $ac = $p->select_doanhnghiep_email($email);
                $hoTenSuccess = $ac[0]['hoTenPH'];
                $emailSuccess = $ac[0]['email'];
                $username = $ac[0]['username'];
                require 'View/sendmailPas.php';
                $emailMatch = true;
                break;
            }
        }
        if (!$emailMatch) {
            $fail['check'] = 'Email không tồn tại trong hệ thống!';
        }
    }
}
?>

<div class="login-container">
    <h2 class="header-text">Quên mật khẩu</h2>
    <form action='' method="POST"> 
        <div class="form-group">
            <label for="loginUsername">Email</label>
            <?php if (!empty($fail['check'])): ?>
                <p class="text-danger"><?php echo $fail['check']; ?></p>
            <?php endif; ?>
            <input type="email" class="form-control" name="email" id="loginUsername" placeholder="Nhập email của bạn" required>
        </div>
        <button type="submit" name="btn-forgot" class="btn btn-primary btn-block mt-3" id="loginbtn">Gửi</button> 
        <a href="index.php?login" class="form-link">Đăng nhập</a>
        <a href="index.php?register" class="form-link">Bạn chưa có tài khoản ? Đăng ký</a>
    </form>
</div>
</body>




