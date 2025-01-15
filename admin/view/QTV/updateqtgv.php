<?php
   include("controller/QTV/cQTV.php");
   include_once("controller/TaiKhoan/ctaikhoan.php");
   $idQTGV = $_REQUEST['idQTGV'];
   $a = new ctaikhoan();
   $p = new cQTV();
   $table = $p->select_qtgv_id($idQTGV);
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
                <h3 class="card-title">Thông tin quản lý quản trị giáo viên</h3>
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
                        <label>Mã quản lý quản trị giáo viên</label>
                        <input type='text' class='form-control' name='idgiaovien' value="<?php echo $row['idQTGV']; ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Tên quản lý quản trị giáo viên</label>
                        <input type='text' class='form-control' name='tengv' value="<?php echo $row['hoTen']; ?>">
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
                        <input type='text' class='form-control' name='sdt' value="<?php echo $row['soDienThoai']; ?>">
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type='text' class='form-control' name='email' value="<?php echo $row['email']; ?>">
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
</style>
<script>
        $(document).ready(function () {

            $('.editbtn').on('click', function () {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#username').val(data[0]);
                $('#username1').val(data[0]);

            });
        });
        // Function to validate email
// Function to validate email
function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

// Function to validate phone number (Vietnamese format)
function validatePhone(phone) {
    const re = /^(0[3|5|7|8|9])+([0-9]{8})\b/;
    return re.test(phone);
}

// Function to set error
function setError(input, message) {
    const formGroup = input.closest('.form-group');
    const errorElement = formGroup.querySelector('.error-message') || document.createElement('div');
    errorElement.className = 'error-message text-danger';
    errorElement.textContent = message;
    if (!formGroup.querySelector('.error-message')) {
        formGroup.appendChild(errorElement);
    }
    input.classList.add('is-invalid');
}

// Function to clear error
function clearError(input) {
    const formGroup = input.closest('.form-group');
    const errorElement = formGroup.querySelector('.error-message');
    if (errorElement) {
        errorElement.remove();
    }
    input.classList.remove('is-invalid');
}

// Validate name
document.querySelector('input[name="tengv"]').addEventListener('blur', function() {
    if (this.value.trim() === '') {
        setError(this, 'Họ và tên không được để trống');
    } else if (this.value.trim().length < 2) {
        setError(this, 'Họ và tên phải có ít nhất 2 ký tự');
    } else {
        clearError(this);
    }
});

// Validate phone
document.querySelector('input[name="sdt"]').addEventListener('blur', function() {
    if (!validatePhone(this.value)) {
        setError(this, 'Số điện thoại không hợp lệ. Vui lòng nhập 10 số, bắt đầu bằng 03, 05, 07, 08 hoặc 09');
    } else {
        clearError(this);
    }
});

// Validate email
document.querySelector('input[name="email"]').addEventListener('blur', function() {
    if (!validateEmail(this.value)) {
        setError(this, 'Email không hợp lệ. Vui lòng nhập đúng định dạng (ví dụ: example@domain.com)');
    } else {
        clearError(this);
    }
});

// Validate form on submit
document.querySelector('form').addEventListener('submit', function(e) {
    let isValid = true;
    const inputs = this.querySelectorAll('input[type="text"], input[type="email"], select');
    inputs.forEach(input => {
        if (input.value.trim() === '') {
            setError(input, 'Trường này không được để trống');
            isValid = false;
        } else {
            // Trigger the blur event to revalidate
            input.dispatchEvent(new Event('blur'));
        }
    });

    if (!isValid) {
        e.preventDefault();
        alert('Vui lòng điền đầy đủ và chính xác thông tin trước khi gửi form.');
    }
});
</script>
<?php

if(isset($_REQUEST["submit"])){
    $idQTGV = $_REQUEST["idgiaovien"];
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
    $update = $p->update_QTGV($idQTGV, $email, $hinhAnh, $hoTen, $soDienThoai, $gioiTinh, $tmpimg ,$typeimg, $sizeimg,$ngaySinh);
          
    if($update == 1){
        echo "<script>alert('Cập nhật thành công');</script>";
        echo "<script>window.location.href='?qlqtgv'</script>";
    } elseif($update == -2) {
      echo "<script>alert('Vui lòng chọn file có định dạng là hình ảnh');</script>"; // Include the error code
  }else{
    echo "<script>alert('Cập nhật không thành công. Mã lỗi: $update');</script>"; // Include the error code
  }
}
?>