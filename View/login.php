
<style>
    body {
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
    .form-link-container {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: white;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        text-decoration: none;
        color: black;
        margin-top: 15px;
    }
    .form-link-container img {
        margin-right: 10px;
    }
    .form-link-container:hover {
        background-color: #f0f0f0;
    }
    .password-container {
        position: relative;
    }
    .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    }
    .error {
    color: red;
    
    display: none;
    margin-top: 5px;
}

.password-container {
    position: relative;
}

.toggle-password {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
}
</style>
</head>

<body>

<div class="login-container">
  <h2 class="header-text">Đăng nhập</h2>
  <form action='' method="POST"> 
  <div class="form-group">
    <label for="loginUsername">Tài khoản</label>
    <input type="username" class="form-control" name="username" id="username" placeholder="Tài khoản">
    <span class="error" id="usernameError"></span>
</div>
<div class="form-group password-container">
    <label for="loginPassword">Mật khẩu</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu">
    <span class="toggle-password" onclick="togglePassword()">👁️</span>
    <span class="error" id="passwordError"></span>
</div>
    <button type="submit" name="submit" class="btn btn-primary btn-block mt-3" id="loginbtn" value="login" onclick="return validateForm()">Đăng nhập</button>
    <a href="logingoogle.php" class="form-link form-link-container">
      <img src="./img/images (3).png" alt="Google" style="width:20px; height:20px; vertical-align:middle;">
      Đăng nhập bằng Google
    </a>
    <a href="index.php?register" class="form-link">Bạn chưa có tài khoản? Đăng ký</a>
    <a href="index.php?forgot" class="form-link">Quên mật khẩu</a>
    <a href="admin/" class="form-link">Đăng nhập trang quản lý</a>
  </form>
</div>

</body>
<script>
   document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    const inputs = {
        username: { 
            input: document.querySelector('#username'), 
            errorId: 'usernameError', 
            validate: validateUsername 
        },
        password: { 
            input: document.querySelector('#password'), 
            errorId: 'passwordError', 
            validate: validatePassword 
        }
    };

    // Add input listeners
    for (const key in inputs) {
        const field = inputs[key];
        field.input.addEventListener('input', function() {
            validateField(field);
        });
    }

    // Form submit validation
    form.addEventListener('submit', function (e) {
        let isValid = true;
        for (const key in inputs) {
            if (!validateField(inputs[key])) {
                isValid = false;
            }
        }

        if (!isValid) {
            e.preventDefault();
            alert('Vui lòng điền đầy đủ thông tin đăng nhập.');
        }
    });

    function validateField(field) {
        const isValid = field.validate();
        const errorElement = document.getElementById(field.errorId);
        errorElement.style.display = isValid ? 'none' : 'block';
        return isValid;
    }

    function validateUsername() {
        const username = inputs.username.input.value.trim();
        if (username.length < 2) {
            document.getElementById('usernameError').textContent = 'Tài khoản phải có ít nhất 2 ký tự';
            return false;
        }
        return true;
    }

    function validatePassword() {
        const password = inputs.password.input.value;
        if (password.length < 1) {
            document.getElementById('passwordError').textContent = 'Mật khẩu phải có ít nhất 1 ký tự';
            return false;
        }
        return true;
    }

    // Password toggle function
    window.togglePassword = function() {
        const passwordInput = document.getElementById('password');
        passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
    }
});
</script>