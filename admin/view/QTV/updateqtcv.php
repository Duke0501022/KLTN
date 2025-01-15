<?php
   include("controller/QTV/cQTV.php");
   include_once("controller/TaiKhoan/ctaikhoan.php");
   $idQTCV = $_REQUEST['idQTCV'];
   $a = new ctaikhoan();
   $p = new cQTV();
   $table = $p->select_qtcv_id($idQTCV);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cập nhật thông tin quản lý quản trị chuyên viên</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lý quản lý quản trị chuyên viên</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Main Content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Thông tin quản lý quản trị chuyên viên</h3>
              </div>
              <div class="card-body">
                <?php
                  if ($table && mysqli_num_rows($table) > 0) {
                    $row = mysqli_fetch_assoc($table);
                ?>
                <form action="#" method="post" enctype="multipart/form-data" novalidate>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                       
                        <?php
                          if($row["hinhAnh"] == NULL){
                            echo "<img src='/assets/uploads/images/user.png' alt='' class='img-fluid mb-2' style='max-height: 200px; border-radius: 50px;'>";
                          } else {
                            echo "<img src='admin/assets/uploads/images/".$row['hinhAnh']."' alt='' class='img-fluid mb-2' style='max-height: 200px; border-radius: 50px;'>";
                          }
                        ?>
                        <input type='file' class='form-control-file' name='txtHinhAnh'>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Mã quản lý quản trị chuyên viên</label>
                        <input type='text' class='form-control' name='idgiaovien' value="<?php echo $row['idQTCV']; ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Tên quản lý quản trị chuyên viên</label>
                        <input type='text' class='form-control' name='tengv' id="tenkh" value="<?php echo $row['hoTen']; ?>">
                        <span class="error" id="tenkhError"></span>
                      </div>
                      <div class="form-group">
                        <label>Giới tính</label>
                        <select name="gioitinh" id="gioitinh" class="form-control">
                          <option value="0" <?php if ($row['gioiTinh'] == "0") echo "selected"; ?>>Nam</option>
                          <option value="1" <?php if ($row['gioiTinh'] == "1") echo "selected"; ?>>Nữ</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                    
                      <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type='text' class='form-control' name='sdt' id="sdt" value="<?php echo $row['soDienThoai']; ?>">
                        <span class="error" id="sdtError"></span>
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type='text' class='form-control' name='email' id="email"  value="<?php echo $row['email']; ?>">
                        <span class="error" id="emailError"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-12 text-center">
                      <button type="submit" class="btn btn-primary" name="submit">Cập nhật</button>
                      <button type="reset" class="btn btn-secondary" name="reset">Hủy</button>
                    </div>
                  </div>
                </form>
                <?php
                  } else {
                    echo "<p>Không tìm thấy thông tin quản lý quản trị chuyên viên.</p>";
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>

<style>
  .content-wrapper {
    padding: 20px;
  }
  .card {
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
  }
  .form-group {
    margin-bottom: 1rem;
  }
  .btn {
    margin-right: 5px;
  }
  .error {
            color: red;
            display: none;
        }
        .is-invalid {
            border-color: red;
        }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    const inputs = {
        tenkh: { input: document.getElementById('tenkh'), errorId: 'tenkhError', validate: validateTenKh },
        sdt: { input: document.getElementById('sdt'), errorId: 'sdtError', validate: validateSDT },
        email: { input: document.getElementById('email'), errorId: 'emailError', validate: validateEmail },
        gioitinh: { input: document.getElementById('gioitinh'), errorId: 'gioitinhError', validate: validateGioiTinh },
       
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
<?php

if(isset($_REQUEST["submit"])){
    $idQTCV = $_REQUEST["idgiaovien"];
    $hoTen = $_REQUEST["tengv"];
    $soDienThoai = $_REQUEST["sdt"];
    $ngaySinh = $_REQUEST["ngaysinh"];
    $email = $_REQUEST["email"];
    $gioiTinh = $_REQUEST["gioitinh"];
    $ngaySinh = $_REQUEST["ngaysinh"];
    $hinhAnhCu = $row['hinhAnh'] ?? '';
    $hinhAnh = NULL;

    if (isset($_FILES['txtHinhAnh'])) {
      $tmpimg = $_FILES["txtHinhAnh"]["tmp_name"];
      $typeimg = $_FILES["txtHinhAnh"]["type"];
      $sizeimg = $_FILES["txtHinhAnh"]["size"];
      $hinhAnh = basename($_FILES["txtHinhAnh"]["name"]);
  } else {
      $hinhAnh = $hinhAnhCu; // Keep the old image
  }

    $p = new cQTV();
    $update = $p->update_QTCV($idQTCV, $email, $hinhAnh, $hoTen, $soDienThoai, $gioiTinh, $tmpimg ,$typeimg, $sizeimg,$ngaySinh);
          
    if($update == 1){
        echo "<script>alert('Cập nhật thành công');</script>";
        echo "<script>window.location.href='?qlqtcv'</script>";
    } elseif($update == -2) {
      echo "<script>alert('Vui lòng chọn file có định dạng là hình ảnh');</script>"; // Include the error code
  }else{
    echo "<script>alert('Cập nhật không thành công. Mã lỗi: $update');</script>"; // Include the error code
  }
}
?>