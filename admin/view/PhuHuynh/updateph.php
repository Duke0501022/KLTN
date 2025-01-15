<?php
   include("controller/PhuHuynh/cdoanhnghiep.php");
   include_once("controller/TaiKhoan/ctaikhoan.php");
    $idPhuHuynh = $_REQUEST['MaKH'];
   $a= new ctaikhoan();
   $p = new cKHDN();
   $table = $p-> select_doanhnghiep_byid_xa($idPhuHuynh);
   
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cập nhật thông tin phụ huynh</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lý phụ huynh</li>
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
                <h3 class="card-title">Thông tin chi tiết</h3>
              </div>
              <div class="card-body">
               <!-- Ensure ngaySinh and diaChi are fetched from the database -->
<?php
  if ($table && mysqli_num_rows($table) > 0) {
    $row = mysqli_fetch_assoc($table);
?>
<form action="" method="post" enctype="multipart/form-data" novalidate>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <?php
          if($row["hinhAnh"] == NULL){
                 echo "<img src='/assets/uploads/images/user.png' alt='' class='img-fluid mb-2' style='max-height: 200px;'>";
              } else {
              echo "<img src='admin/assets/uploads/images/".$row['hinhAnh']."' alt='' class='img-fluid mb-2' style='max-height: 200px;'>";
            }
           ?>
              <input type='file' class='form-control-file' name='txtHinhAnh'>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Mã Phụ Huynh</label>
                      <input type='text' class='form-control' name='txtmakh' value="<?php echo $row['idPhuHuynh']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label>Họ và Tên</label>
                      <input type='text' class='form-control' name='tenkh' value="<?php echo $row['hoTenPH']; ?>">
                      <span class="error" id="tenkhError"></span>
                    </div>
                    <div class="form-group">
                      <label>Giới Tính</label>
                      <select name="gioitinh" id="gioitinh" class="form-control">
                          <option value="0" <?php if ($row['gioiTinh'] == "0") echo "selected"; ?>>Nam</option>
                          <option value="1" <?php if ($row['gioiTinh'] == "1") echo "selected"; ?>>Nữ</option>
                        </select>
                        <span class="error" id="gioitinhError"></span>
                    </div>
                    <div class="form-group">
                      <label for="diachi">Địa chỉ</label>
                      <input type="text" class="form-control" id="diachi" name="diachi" placeholder="Nhập địa chỉ" value="<?php echo $row['diaChi']; ?>" required>
                      <span class="error" id="diachiError"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Số Điện Thoại</label>
                      <input type='text' class='form-control' name='sdt' id="sdt" value="<?php echo $row['soDienThoai']; ?>">
                      <span class="error" id="sdtError"></span>
                    </div>
                    <div class="form-group">
                      <label for="ngaysinh">Ngày sinh</label>
                      <input type="date" class="form-control" id="ngaysinh" name="ngaysinh" value="<?php echo $row['ngaySinh']; ?>">
                      <span class="error" id="ngaysinhError"></span>
                     </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type='text' class='form-control' name='email' value="<?php echo $row['email']; ?>">
                      <span class="error" id="emailError"></span>
                    </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary" name="submit">Cập Nhật</button>
                    <button type="reset" class="btn btn-secondary" name="reset">Huỷ</button>
                  </div>
                </div>
              </form>
              <?php
                } else {
                  echo "<p>No customer data found.</p>";
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
</style>
<?php
// XỬ LÍ CẬP NHẬT KHÁCH HÀNG KHÔNG USERNAME
  if(isset($_REQUEST["submit"])){
    $idPhuHuynh=$_REQUEST["txtmakh"];
    $hoTen=$_REQUEST["tenkh"];
    $soDienThoai=$_REQUEST["sdt"];
    $email=$_REQUEST["email"];
    $gioiTinh=$_REQUEST["gioitinh"];
    $diaChi = $_REQUEST["diachi"];
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
  
    $p = new cKHDN();
   
    
  
  // Gọi phương thức cập nhật
  
  $update = $p->update_DN($idPhuHuynh, $email, $hinhAnh, $hoTen, $soDienThoai, $gioiTinh, $ngaySinh,$diaChi,$tmpimg, $typeimg, $sizeimg);

if ($update == 1) {
    echo "<script>alert('Cập nhật thành công');</script>";
    echo "<script>window.location.href='?qlkhdn'</script>";
} elseif($update == -2) {
    echo "<script>alert('Vui lòng chọn file có định dạng là hình ảnh');</script>"; // Include the error code
}else{
  echo "<script>alert('Cập nhật không thành công. Mã lỗi: $update');</script>"; // Include the error code
}
    
  }
?>
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
      tenkh: { input: document.querySelector('input[name="tenkh"]'), errorId: 'tenkhError', validate: validateTenGv },
        sdt: { input: document.querySelector('input[name="sdt"]'), errorId: 'sdtError', validate: validateSDT },
        email: { input: document.querySelector('input[name="email"]'), errorId: 'emailError', validate: validateEmail },
        gioitinh: { input: document.querySelector('select[name="gioitinh"]'), errorId: 'gioitinhError', validate: validateGioiTinh },
        diachi: { input: document.querySelector('input[name="diachi"]'), errorId: 'diachiError', validate: validateDiaChi },
        ngaysinh: { input: document.querySelector('input[name="ngaysinh"]'), errorId: 'ngaysinhError', validate: validateNgaySinh },
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

    function validateTenGv() {
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
        const value = inputs.ngaysinh.input.value;
        if (value === '') {
            showError(inputs.ngaysinh.input, inputs.ngaysinh.errorId, 'Vui lòng chọn ngày sinh');
            return false;
        } else if (value > new Date().toISOString().split('T')[0]) {
            showError(inputs.ngaysinh.input, inputs.ngaysinh.errorId, 'Ngày sinh không được lớn hơn ngày hiện tại');
            return false;
        } else {
            hideError(inputs.ngaysinh.input, inputs.ngaysinh.errorId);
            return true;
        }
    }

   
});  
</script>