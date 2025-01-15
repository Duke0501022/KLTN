 <?php
  include_once("controller/TaiKhoan/ctaikhoan.php");
  include_once("controller/PhuHuynh/cdoanhnghiep.php");
  $a=new ctaikhoan();

  
 ?>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    const inputs = {
        tenkh: { input: document.getElementById('tenkh'), errorId: 'tenkhError', validate: validateTenKh },
        sdt: { input: document.getElementById('sdt'), errorId: 'sdtError', validate: validateSDT },
        email: { input: document.getElementById('email'), errorId: 'emailError', validate: validateEmail },
        gioitinh: { input: document.getElementById('gioitinh'), errorId: 'gioitinhError', validate: validateGioiTinh },
        diachi: { input: document.getElementById('diachi'), errorId: 'diachiError', validate: validateDiaChi },
        ngaySinh: { input: document.getElementById('ngaySinh'), errorId: 'ngaySinhError', validate: validateNgaySinh },
        username: { input: document.getElementById('username'), errorId: 'usernameError', validate: validateUsername },
        hinhAnh: { input: document.getElementById('hinhAnh'), errorId: 'hinhAnhError', validate: validateHinhAnh }
    };

    for (const key in inputs) {
        const field = inputs[key];
        field.input.addEventListener('input', field.validate);
    }

    form.addEventListener('submit', function (e) {
        let isValid = true;
        for (const key in inputs) {
            const field = inputs[key];
            if (!field.validate()) {
                isValid = false;
            }
        }

        if (!isValid) {
            e.preventDefault();
            alert('Vui lòng điền đầy đủ và chính xác thông tin trước khi gửi form.');
        }
    });

    function showError(input, errorId, message) {
        const errorElement = document.getElementById(errorId);
        errorElement.textContent = message;
        errorElement.style.display = 'block';
        input.classList.add('is-invalid');
    }

    function hideError(input, errorId) {
        const errorElement = document.getElementById(errorId);
        errorElement.textContent = '';
        errorElement.style.display = 'none';
        input.classList.remove('is-invalid');
    }

    function validateTenKh() {
        const value = inputs.tenkh.input.value.trim();
        if (value === '') {
            showError(inputs.tenkh.input, inputs.tenkh.errorId, 'Họ và tên không được để trống');
            return false;
        } else if (value.length < 2) {
            showError(inputs.tenkh.input, inputs.tenkh.errorId, 'Họ và tên phải có ít nhất 2 ký tự');
            return false;
        } else {
            hideError(inputs.tenkh.input, inputs.tenkh.errorId);
            return true;
        }
    }

    function validateSDT() {
        const value = inputs.sdt.input.value.trim();
        const regex = /^(0[3|5|7|8|9])[0-9]{8}$/;
        if (!regex.test(value)) {
            showError(inputs.sdt.input, inputs.sdt.errorId, 'Số điện thoại phải bắt đầu bằng số 0 và tiếp theo số là 3,5,7,9 và đủ 10 số');
            return false;
        } else {
            hideError(inputs.sdt.input, inputs.sdt.errorId);
            return true;
        }
    }

    function validateEmail() {
        const value = inputs.email.input.value.trim();
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!regex.test(value)) {
            showError(inputs.email.input, inputs.email.errorId, 'Email không hợp lệ');
            return false;
        } else {
            hideError(inputs.email.input, inputs.email.errorId);
            return true;
        }
    }

    function validateGioiTinh() {
        const value = inputs.gioitinh.input.value;
        if (value === '') {
            showError(inputs.gioitinh.input, inputs.gioitinh.errorId, 'Vui lòng chọn giới tính');
            return false;
        } else {
            hideError(inputs.gioitinh.input, inputs.gioitinh.errorId);
            return true;
        }
    }

    function validateDiaChi() {
        const value = inputs.diachi.input.value.trim();
        if (value === '') {
            showError(inputs.diachi.input, inputs.diachi.errorId, 'Địa chỉ không được để trống');
            return false;
        } else {
            hideError(inputs.diachi.input, inputs.diachi.errorId);
            return true;
        }
    }

    function validateNgaySinh() {
        const value = inputs.ngaySinh.input.value;
        if (value === '') {
            showError(inputs.ngaySinh.input, inputs.ngaySinh.errorId, 'Vui lòng chọn ngày sinh');
            return false;
        } else if (value > new Date().toISOString().split('T')[0]) {
            showError(inputs.ngaySinh.input, inputs.ngaySinh.errorId, 'Ngày sinh không được lớn hơn ngày hiện tại');
            return false;
        } else {
            hideError(inputs.ngaySinh.input, inputs.ngaySinh.errorId);
            return true;
        }
    }

    function validateUsername() {
        const value = inputs.username.input.value.trim();
        if (value === '') {
            showError(inputs.username.input, inputs.username.errorId, 'Tên đăng nhập không được để trống');
            return false;
        } else {
            hideError(inputs.username.input, inputs.username.errorId);
            return true;
        }
    }

    function validateHinhAnh() {
        const file = inputs.hinhAnh.input.files[0];
        if (!file) {
            showError(inputs.hinhAnh.input, inputs.hinhAnh.errorId, 'Vui lòng chọn hình ảnh');
            return false;
        }
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
            showError(inputs.hinhAnh.input, inputs.hinhAnh.errorId, 'Chỉ chấp nhận các định dạng JPG, PNG, GIF');
            return false;
        }
        hideError(inputs.hinhAnh.input, inputs.hinhAnh.errorId);
        return true;
    }
});
   
    </script>
 
 <style>
    .content-header h1 {
    font-size: 28px;
    font-weight: bold;
    color: #333;
  }

  .breadcrumb-item a {
    color: #007bff;
  }

  /* Form styles */
  form {
    background-color: #f9f9f9;
   
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
  }

  input[type="text"], select {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 15px;
    transition: border 0.3s;
  }

  input[type="text"]:focus, select:focus {
    border: 1px solid #007bff;
  }

  /* Buttons */
  .btn {
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
  }

  .btn-primary {
    background-color: #007bff;
    color: white;
    border: none;
  }

  .btn-primary:hover {
    background-color: #0056b3;
  }

  .btn-secondary {
    background-color: #6c757d;
    color: white;
    border: none;
  }

  .btn-secondary:hover {
    background-color: #5a6268;
  }

  .row {
    margin-bottom: 20px;
  }

  /* Adjustments for the select dropdowns */
  select.insert {
    background-color: #f8f9fa;
    border: 1px solid #ddd;
    padding: 10px;
    border-radius: 5px;
  }

  /* Align center */
  form h3 {
    margin-bottom: 20px;
    font-size: 24px;
    text-align: center;
  }


        /* [Thêm các styles cần thiết ở đây] */
        .error {
            color: red;
            display: none;
        }
        .is-invalid {
            border-color: red;
        }

  
 </style>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lý khách hàng</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-lg-10"> <!-- Changed from col-md-8 to col-lg-10 -->
          <div class="card">
            <div class="card-body">
            
              <h3 style="text-align:center">Thêm Phụ Huynh</h3>
              <form action="#" method='post' enctype="multipart/form-data">
                <div class="row">
                <div class="col-md-6">
            <div class="form-group">
                <label for="tenkh">Họ và Tên</label>
                <input type="text" class="form-control" id="tenkh" name="tenkh" placeholder="Nhập Tên Phụ Huynh" value="<?php echo isset($_POST['tenkh']) ? htmlspecialchars($_POST['tenkh']) : ''; ?>" required>
                <span class="error" id="tenkhError"></span>
              </div>
            <div class="form-group">
                <label for="gioitinh">Giới tính</label>
                <select name="gioitinh" id="gioitinh" class="form-control" required>
                <option value="">Chọn giới tính</option>
                                  <option value="0" <?php echo (isset($_POST['gioitinh']) && $_POST['gioitinh'] == '0') ? 'selected' : ''; ?>>Nam</option>
                                  <option value="1" <?php echo (isset($_POST['gioitinh']) && $_POST['gioitinh'] == '1') ? 'selected' : ''; ?>>Nữ</option>
                </select>
            </div>
           
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                <span class="error" id="emailError"></span>
            </div>
            <div class="form-group">
                <label for="hinhAnh">Hình Ảnh</label>
                <input type="file" class="form-control" id="hinhAnh" name="hinhAnh" required>
                <span class="error" id="hinhAnhError"></span>
            </div>
            
        </div>

        <!-- Second column -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="username">Tên đăng nhập</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Nhập Username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
                <span class="error" id="usernameError"></span>
              </div>
              <div class="form-group">
                              <label for="ngaySinh">Ngày Sinh</label>
                              <input type="date" class="form-control" id="ngaySinh" name="ngaySinh"  required>
                              <span class="error" id="ngaySinhError"></span>
              </div>
            <div class="form-group">
                <label for="sdt">Số điện thoại</label>
                <input type="text" class="form-control" id="sdt" name="sdt" placeholder="Nhập số điện thoại" value="<?php echo isset($_POST['sdt']) ? htmlspecialchars($_POST['sdt']) : ''; ?>" required>
                <span class="error" id="sdtError"></span>
            </div>
            <div class="form-group">
                <label for="diachi">Đia chỉ</label>
                <input type="text" class="form-control" id="diachi" name="diachi" placeholder="Nhập địa chỉ" value="<?php echo isset($_POST['diachi']) ? htmlspecialchars($_POST['diachi']) : ''; ?>" required>
                <span class="error" id="diachiError"></span>
            </div>
        </div>
    </div>
                       <div class="form-group text-center">
                              <button type="submit" class="btn btn-primary" name="submit">Thêm phụ huynh</button>
                              <button type="reset" class="btn btn-secondary" name="reset">Hủy</button>
                        </div>
                <!-- <input type="submit" value="Thêm Doanh Nghiệp" style="text-align:center"> -->
              </form>
            </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
  include_once("controller/PhuHuynh/cdoanhnghiep.php");
  if(isset($_POST["submit"])){
    // Lấy dữ liệu từ form và lọc dữ liệu
    $hoTen = trim($_POST["tenkh"] ?? '');
    $soDienThoai = trim($_POST["sdt"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $gioiTinh = $_POST["gioitinh"] ?? '';
    $diaChi = trim($_REQUEST["diachi"] ?? '');
    $hinhAnh = $_FILES['hinhAnh']['name'] ?? '';
    $hinhAnh_tmp = $_FILES['hinhAnh']['tmp_name'] ?? '';
    $uploads_dir = 'admin/assets/uploads/images/';
    $ngaySinh = $_REQUEST['ngaySinh'] ?? '';
    $username = trim($_POST["username"] ?? '');

    
    $taikhoan = new ctaikhoan();
    $errors = [];
    
    // Check email exists
    if ($taikhoan->get_check_email($email)) {
        $errors[] = "Email đã tồn tại vui lòng sử dụng email khác.";
    }
    
    // Check username exists
    $check_user_kh = $taikhoan->check_user_khachhang($username);
    if ($check_user_kh->num_rows > 0) {
        $errors[] = "Username đã tồn tại trong bảng khác.";
    }
    if (!$taikhoan->check_taikhoan($username)) {
      $errors[] = "Username chưa tồn tại trong bảng tài khoản, vui lòng thêm tài khoản trước.";
  }
    if (!empty($errors)) {
        $error_message = implode('<br>', $errors);
        echo "<script>alert('$error_message');</script>";
    } else {
        if (!is_dir($uploads_dir)) {
            mkdir($uploads_dir, 0777, true);
        }
    
        if (move_uploaded_file($hinhAnh_tmp, $uploads_dir.$hinhAnh)) {
            $nvpp = new cKHDN();
            if (!empty($username)) {
                $insert = $nvpp->add_DN($email, $hinhAnh, $hoTen, $soDienThoai, $gioiTinh, $ngaySinh, $diaChi, $username);
                if ($insert == 1) {
                    echo "<script>alert('Thêm thành công');</script>";
                    echo "<script>window.location.href='?qlgv'</script>";
                } else {
                    echo "<script>alert('Thêm không thành công');</script>";
                    echo "<script>window.location.href='?qlgv'</script>";
                }
            }
        }
    }
}

  ?>
 