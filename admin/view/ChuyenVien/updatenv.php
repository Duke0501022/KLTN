<?php
    include("controller/ChuyenVien/cChuyenVien.php");
    include_once("controller/TaiKhoan/ctaikhoan.php");
    $idChuyenVien = $_REQUEST['idChuyenVien'];
    $p = new cNVPP();
    $a = new ctaikhoan();
    $table = $p->select_nhanvien_byid($idChuyenVien);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cập nhật thông tin chuyên viên</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lý chuyên viên</li>
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
                <h3 class="card-title">Thông tin chuyên viên</h3>
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
                        <label>Mã chuyên viên</label>
                        <input type='text' class='form-control'  name='idchuyenvien' value="<?php echo $row['idChuyenVien']; ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Tên chuyên viên</label>
                        <input type='text' class='form-control' id='tencv' name='tencv' value="<?php echo $row['hoTen']; ?>">
                        <span class="error" id="tencvError"></span>
                      </div>
                      <div class="form-group">
                        <label>Giới tính</label>
                        <select name="gioitinh" id="gioitinh" class="form-control">
                          <option value="0" <?php if ($row['gioiTinh'] == "0") echo "selected"; ?>>Nam</option>
                          <option value="1" <?php if ($row['gioiTinh'] == "1") echo "selected"; ?>>Nữ</option>
                        </select>
                        <span class="error" id="gioitinhError"></span>
                      </div>
                      <div class="form-group">
                        <label>Mô tả</label>
                        <input type='text' class='form-control' id ='mota' name='mota' value="<?php echo $row['moTa']; ?>">
                        <span class="error" id="motaError"></span>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Ngày sinh</label>
                        <input type='date' class='form-control' id='ngaySinh' name='ngaySinh' value="<?php echo $row['ngaySinh']; ?>">
                        <span class="error" id="ngaySinhError"></span>
                      </div>
                      <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type='text' class='form-control' id='sdt' name='sdt' value="<?php echo $row['soDienThoai']; ?>">
                        <span class="error" id="sdtError"></span>
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type='text' class='form-control' id='email' name='email' value="<?php echo $row['email']; ?>">
                        <span class="error" id="emailError"></span>
                      </div>
                      <div class="form-group">
                      <label for="diachi">Địa chỉ</label>
                      <input type="text" class="form-control" id="diachi" name="diachi" value="<?php echo $row['diaChi']; ?>" required>
                      <span class="error" id="diachiError"></span>
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
                    echo "<p>Không tìm thấy thông tin chuyên viên.</p>";
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
  .error {
            color: red;
            display: none;
        }
        .is-invalid {
            border-color: red;
        }
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
</style>
<script>
   document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    const inputs = {
        tencv: { input: document.querySelector('input[name="tencv"]'), errorId: 'tencvError', validate: validateTenCv },
        sdt: { input: document.querySelector('input[name="sdt"]'), errorId: 'sdtError', validate: validateSDT },
        email: { input: document.querySelector('input[name="email"]'), errorId: 'emailError', validate: validateEmail },
        gioitinh: { input: document.querySelector('select[name="gioitinh"]'), errorId: 'gioitinhError', validate: validateGioiTinh },
        diachi: { input: document.querySelector('input[name="diachi"]'), errorId: 'diachiError', validate: validateDiaChi },
        ngaySinh: { input: document.querySelector('input[name="ngaySinh"]'), errorId: 'ngaySinhError', validate: validateNgaySinh },
        mota: { input: document.querySelector('input[name="mota"]'), errorId:'motaError', validate: validateMoTa },
        hinhAnh: { input: document.querySelector('input[name="txtHinhAnh"]'), errorId: '', validate: validateHinhAnh }
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

    function validateTenCv() {
        const value = inputs.tencv.input.value.trim();
        if (value === '') {
            showError(inputs.tencv.input, inputs.tencv.errorId, 'Họ và tên không được để trống');
            return false;
        } else if (value.length < 2) {
            showError(inputs.tencv.input, inputs.tencv.errorId, 'Họ và tên phải có ít nhất 2 ký tự');
            return false;
        } else {
            hideError(inputs.tencv.input, inputs.tencv.errorId);
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
    function validateMoTa() {
        const value = inputs.mota.input.value.trim();
        if (value === '') {
            showError(inputs.mota.input, inputs.mota.errorId, 'Mô tả không được để trống');
            return false;
        } else {
            hideError(inputs.mota.input, inputs.mota.errorId);
            return true;
        }
    }
    function validateHinhAnh() {
        const value = inputs.hinhAnh.input.value.trim();
        if (value === '') {
            showError(inputs.hinhAnh.input, inputs.hinhAnh.errorId, 'Hình ảnh không được để trống');
            return false;
        } else {
            hideError(inputs.hinhAnh.input, inputs.hinhAnh.errorId);
            return true;
        }
    }

   
});  
</script>
<?php
// Xử lý cập nhật thông tin
if(isset($_REQUEST["submit"])){
    $idChuyenVien = $_REQUEST["idchuyenvien"];
    $hoTen = $_REQUEST["tencv"];
    $soDienThoai = $_REQUEST["sdt"];
    $diaChi = $_REQUEST["diachi"];
    $ngaySinh = $_REQUEST["ngaySinh"];
    $email = $_REQUEST["email"];
    $gioiTinh = $_REQUEST["gioitinh"];
    $moTa = $_REQUEST["mota"];
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


    $p = new cNVPP();
    $update = $p->update_CV($idChuyenVien, $email, $hinhAnh, $hoTen, $soDienThoai, $gioiTinh,$moTa,$diaChi, $tmpimg, $typeimg, $sizeimg, $ngaySinh);
          
    if($update == 1){
        echo "<script>alert('Cập nhật thành công');</script>";
        echo "<script>window.location.href='?qlcv'</script>";
    } else {
        echo "<script>alert('Cập nhật không thành công');</script>";
        echo "<script>window.location.href='?qlcv'</script>";
    }
}
?>