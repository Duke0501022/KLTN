
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <style>
        body {
            background: url(../kindergarten-website-template/img/login.jpg);
        }
        .register-container {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 50px auto;
        }
        .header-text {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 5px;
            font-size: 16px;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        select.form-control {
            appearance: none;
            background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgdmlld0JveD0iMCAwIDE2IDE2Ij4gPHBhdGggZmlsbD0iIzAwN0JGZiIgZD0iTTEzLjg5IDQuNzVsLjcwLjcxLTYgNi02LTYgLjc1LS43NSA1LjI1IDUuMjUtNS4yNiA1LjI1eiIvPiA8L3N2Zz4=') no-repeat right 10px center;
            background-size: 12px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
        }
        button:focus {
            outline: none;
        }
        button.custom-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            transition: background-color 0.3s ease;
        }
        button.custom-btn:hover {
            background-color: #0056b3;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .form-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }
        .form-link:hover {
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .row {
                display: flex;
                flex-direction: column;
            }
            .col-md-6 {
                width: 100%;
            }
        }
        .error {
            border-color: red;
        }
        .error-message {
            color: red;
            display: block; /* Thay vì display: none */
            margin-top: 5px;
        }
    </style>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');

        // Các trường input cần kiểm tra
        const inputs = {
            hoTen: { input: document.getElementById('loginHoTen'), errorId: 'hoTenError', validate: validateHoTen },
            sdt: { input: document.getElementById('loginSDT'), errorId: 'sdtError', validate: validateSDT },
            email: { input: document.getElementById('loginEmail'), errorId: 'emailError', validate: validateEmail },
            password: { input: document.getElementById('registerPassword'), errorId: 'passwordError', validate: validatePassword },
            confirmPassword: { input: document.getElementById('confirmPassword'), errorId: 'confirmPasswordError', validate: validateConfirmPassword },
            dob: { input: document.getElementById('dob'), errorId: 'dobError', validate: validateDOB }
        };

        // Thêm sự kiện cho từng input
        for (const key in inputs) {
            const field = inputs[key];
            field.input.addEventListener('input', field.validate);
        }

        // Kiểm tra form khi submit
        form.addEventListener('submit', function (e) {
            let isValid = true;

            for (const key in inputs) {
                const field = inputs[key];
                if (!field.validate()) {
                    isValid = false;
                }
            }

            if (!isValid) {
                e.preventDefault(); // Ngăn không cho form submit nếu có lỗi
            }
        });

        // Hàm hiển thị lỗi
        function showError(input, errorId, message) {
            const errorElement = document.getElementById(errorId);
            errorElement.textContent = message;
            errorElement.style.display = 'block';
            input.classList.add('is-invalid');
        }

        // Hàm ẩn lỗi
        function hideError(input, errorId) {
            const errorElement = document.getElementById(errorId);
            errorElement.textContent = '';
            errorElement.style.display = 'none';
            input.classList.remove('is-invalid');
        }

        // Hàm kiểm tra họ tên
        function validateHoTen() {
            const hoTen = inputs.hoTen.input.value.trim();
            if (hoTen === '') {
                showError(inputs.hoTen.input, inputs.hoTen.errorId, 'Vui lòng nhập họ và tên');
                return false;
            } else {
                hideError(inputs.hoTen.input, inputs.hoTen.errorId);
                return true;
            }
        }

        // Hàm kiểm tra số điện thoại
        function validateSDT() {
            const sdt = inputs.sdt.input.value.trim();
            const sdtRegex = /^[0-9]{10,11}$/;
            if (!sdtRegex.test(sdt)) {
                showError(inputs.sdt.input, inputs.sdt.errorId, 'Số điện thoại không hợp lệ (10 hoặc 11 số)');
                return false;
            } else {
                hideError(inputs.sdt.input, inputs.sdt.errorId);
                return true;
            }
        }

        // Hàm kiểm tra email
        function validateEmail() {
            const email = inputs.email.input.value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showError(inputs.email.input, inputs.email.errorId, 'Email không hợp lệ vd: nguyen@gmail.com');
                return false;
            } else {
                hideError(inputs.email.input, inputs.email.errorId);
                return true;
            }
        }

        // Hàm kiểm tra mật khẩu
        function validatePassword() {
            const password = inputs.password.input.value;
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!passwordRegex.test(password)) {
                showError(inputs.password.input, inputs.password.errorId, 'Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt');
                return false;
            } else {
                hideError(inputs.password.input, inputs.password.errorId);
                return true;
            }
        }

        // Hàm kiểm tra xác nhận mật khẩu
        function validateConfirmPassword() {
            const password = inputs.password.input.value;
            const confirmPassword = inputs.confirmPassword.input.value;
            if (password !== confirmPassword) {
                showError(inputs.confirmPassword.input, inputs.confirmPassword.errorId, 'Mật khẩu không khớp');
                return false;
            } else {
                hideError(inputs.confirmPassword.input, inputs.confirmPassword.errorId);
                return true;
            }
        }

        // Hàm kiểm tra ngày sinh
        function validateDOB() {
            const dobValue = inputs.dob.input.value;
            const today = new Date();
            if (!dobValue) {
                showError(inputs.dob.input, inputs.dob.errorId, 'Vui lòng chọn ngày sinh!');
                return false;
            }

            const dob = new Date(dobValue);
            if (dob > today) {
                showError(inputs.dob.input, inputs.dob.errorId, 'Ngày sinh không được sau ngày hiện tại!');
                return false;
            } else if (dob.getFullYear() < 1) {
                showError(inputs.dob.input, inputs.dob.errorId, 'Ngày sinh không được trước Công nguyên!');
                return false;
            } else {
                hideError(inputs.dob.input, inputs.dob.errorId);
                return true;
            }
        }
    });
</script>

</head>
<body>
    <div class="register-container">
        <h2 class="header-text">Đăng ký tài khoản</h2>
        <form id="registrationForm" action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="hoTen" id="loginHoTen" placeholder="Họ và tên" value="<?php echo isset($_POST['hoTen']) ? htmlspecialchars($_POST['hoTen']) : ''; ?>" required>
                        <span class="error-message" id="hoTenError"></span>
                    </div>
                    <div class="form-group">
                    <input type="tel" class="form-control" name="sdt" id="loginSDT" placeholder="Số điện thoại" value="<?php echo isset($_POST['sdt']) ? htmlspecialchars($_POST['sdt']) : ''; ?>" required>
                        <span class="error-message" id="sdtError"></span>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" id="loginEmail" placeholder="Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                        <span class="error-message" id="emailError"></span>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="slgioitinh" name="slgioitinh" required>
                            <option value="">Chọn giới tính</option>
                            <option value="0">Nam</option>
                            <option value="1">Nữ</option>
                        </select>
                        <span class="error-message" id="gioiTinhError"></span>
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" id="dob" name="dob" placeholder="Ngày sinh" value="<?php echo isset($_POST['dob']) ? htmlspecialchars($_POST['dob']) : ''; ?>" required>
                        <span class="error-message" id="dobError"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" id="loginUsername" placeholder="Tên đăng nhập" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
                        <span class="error-message" id="usernameError"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="registerPassword" placeholder="Mật khẩu" name="password" required>
                        <span class="error-message" id="passwordError"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="confirmPassword" placeholder="Nhập lại mật khẩu" required>
                        <span class="error-message" id="confirmPasswordError"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ" value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>" required>
                        <span class="error-message" id="addressError"></span>
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control" id="hinhAnh" name="hinhAnh" required>
                        <span class="error-message" id="hinhAnhError"></span>
                    </div>
                </div>
            </div>
           
            <div class="button-container">
                <button type="submit" class="btn btn-primary custom-btn" name="dangky">Đăng Ký</button>
            </div>
            <a href="index.php?login" class="form-link">Bạn đã có tài khoản? Đăng nhập</a>
        </form>
    </div>
</body>
</html>

<?php 
require_once("config/config.php");
include_once("Controller/KhachHangDoanhNghiep/cKhachHangDoanhNghiep.php");
include_once("Controller/TaiKhoan/cTaikhoan.php"); 
include_once("Model/Connect.php");
include_once("Controller/CLASS/clsMailer.php");

$mail = new cPHPMailer();

if (isset($_POST['dangky'])) {
    
        $hoTen = $_POST['hoTen'];
        $soDienThoai = $_POST['sdt'];
        
        $hinhAnh = $_FILES['hinhAnh']['name']; 
        $hinhAnh_tmp = $_FILES['hinhAnh']['tmp_name']; 
      
        move_uploaded_file($hinhAnh_tmp, "admin/admin/assets/uploads/images/" . $hinhAnh);
        $email = $_POST['email'];
        $gioiTinh = $_POST['slgioitinh'];
        $Role = 2;
        $diaChi = $_POST['address'];
        $ngaySinh = $_POST['dob'];
        $username = $_POST['username'];
        $password = $_POST['password'];
      
        $dk = new cTaiKhoan();
        $user_dn = new cKHDN();
       
        
        $check_email = $user_dn->select_KHDN_email($email);
        $check_username = $user_dn->select_KHDN_username($username);

       
        $errors = [];

        if ($check_email === true) {
            $errors[] = "Email này đã tồn tại vui lòng nhập email khác.";
        }
    
        if ($check_username === true) {
            $errors[] = "Tên đăng nhập này đã tồn tại vui lòng nhập tên đăng nhập khác.";
        }
    
        if (!empty($errors)) {
            $error_message = implode('<br>', $errors);
            echo "<script>alert('$error_message');</script>";
        } else {
            $insert = $dk->them_taikhoan($username, $password, $Role);
            if ($insert == 1) {
                $ins_khdn = $user_dn->add_KHDN($email, $hinhAnh, $hoTen, $soDienThoai, $gioiTinh, $ngaySinh, $username, $diaChi, 1, 1);
                if ($ins_khdn == 1) {
                    $mail->send_mail($hoTen, $email, $username, $password, $hinhAnh, $Role, $gioiTinh, $soDienThoai);
                    echo "<script>alert('Đăng ký thành công, bạn có thể coi email về thông tin tài khoản');</script>";
                    echo "<script>window.location.href = 'index.php?login';</script>";
                } else {
                    echo "<script>alert('Đăng ký thất bại vui lòng thử lại');</script>";
                }
            } else {
                echo "<script>alert('Đăng ký thất bại vui lòng thử lại');</script>";
            }
        }
        
        
    }
?>