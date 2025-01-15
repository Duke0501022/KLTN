<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
     <div class="container-fluid">
       <div class="row">
         <div class="col-md-6">
           <!-- /.card -->
         </div>
         <!-- /.col -->
         <div class="col-md-6">

         </div>
         <!-- /.col -->
       </div>
       <!-- /.row -->
       <div class="row">
         <div class="col-12">
           <div class="card">
             <div class="card-header">
               <h3 style="text-align:center">Thêm trẻ em mới</h3>
               <form action="#" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                  <div class="row">
                    <div class="col">
                      <td>Họ tên</td>
                      <input type="text" class="form-control" id="tenkh" placeholder="Nhập họ tên trẻ em" name="hoTen" value="<?php echo isset($_POST['hoTen']) ? htmlspecialchars($_POST['hoTen']) : ''; ?>" required></br>
                      <span class="error" id="tenkhError"></span>
                      <td>Ngày sinh</td>
                      <input type="date" class="form-control" id="ngaySinh" placeholder="Nhập ngày sinh" name="ngaySinh"></br>
                      <span class="error" id="ngaySinhError"></span>
                      <td>Giới Tính</td>
                      <select class="form-control" id="gioiTinh" name="gioiTinh">
                      <option value="">Chọn giới tính</option>
                                  <option value="0" <?php echo (isset($_POST['gioiTinh']) && $_POST['gioiTinh'] == '0') ? 'selected' : ''; ?>>Nam</option>
                                  <option value="1" <?php echo (isset($_POST['gioiTinh']) && $_POST['gioiTinh'] == '1') ? 'selected' : ''; ?>>Nữ</option>

                    </select>
                      <span class="error" id="gioiTinhError"></span>
                  </br>
                      <td>Trẻ được sinh vào thai kỳ thứ mấy?</td>
                      <input type="text" class="form-control" id="thaiKy" placeholder="Nhập thai kỳ mà trẻ sinh ra" name="thaiKy" value="<?php echo isset($_POST['thaiKy']) ? htmlspecialchars($_POST['thaiKy']) : ''; ?>" required></br>
                      <span class="error" id="thaiKyError"></span>
                      <td>Tình trạng</td>
                      <input type="text" class="form-control" id="tinhTrang" placeholder="Nhập tình trạng hiện tại của trẻ em" name="tinhTrang" value="<?php echo isset($_POST['tinhTrang']) ? htmlspecialchars($_POST['tinhTrang']) : ''; ?>"></br>
                      <span class="error" id="tinhTrangError"></span>
                      <td>Hình ảnh</td>
                      <input type="file" class="form-control" id="hinhAnh" name="hinhAnh"></br>
                      <span class="error" id="hinhAnhError"></span>
                    </div>
                  </div>
                  </br>
                  <button type="submit" class="btn btn-primary" name="btnsubmit" style="margin-left:45%">Lưu</button>
                  <button type="reset" class="btn btn-primary">Hủy</button>
                </form>
               <!-- /.card-body -->
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
include("Controller/cTreEm.php");
if (isset($_REQUEST["btnsubmit"])) {
  $hoTenTE = $_REQUEST['hoTen'];
  $ngaySinh = $_REQUEST['ngaySinh'];
  $thaiKy = $_REQUEST['thaiKy'];
  $tinhTrang = $_REQUEST['tinhTrang'];
  $gioiTinh = $_REQUEST['gioiTinh'];
  
  // Xử lý tải lên hình ảnh
  $hinhAnh = $_FILES['hinhAnh']['name']; // Name of the uploaded file
  $hinhAnh_tmp = $_FILES['hinhAnh']['tmp_name']; // Temporary location of the file
  $uploads_dir = 'admin/assets/uploads/images/';

  if (!is_dir($uploads_dir)) {
    mkdir($uploads_dir, 0777, true);
  }

  if (move_uploaded_file($hinhAnh_tmp, $uploads_dir . $hinhAnh)) {
    // File uploaded successfully, now proceed with database insertion
    $p = new cHoSoTreEm();
    $table = $p->add_TE($hoTenTE, $ngaySinh, $thaiKy, $tinhTrang, $hinhAnh, $gioiTinh);
    if ($table == 1) {
      echo "<script>alert('Tạo trẻ em thành công')</script>";
      echo "<script>window.location.href='?qlte'</script>";
    } else {
      echo "<script>alert('Tạo trẻ em không thành công')</script>";
      echo "<script>window.location.href='?qlte'</script>";
    }
  } else {
    echo "<script>alert('Upload ảnh không thành công');</script>";
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

</style>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');

        const inputs = {
            tenkh: { input: document.getElementById('tenkh'), errorId: 'tenkhError', validate: validateTenKh },
            ngaySinh: { input: document.getElementById('ngaySinh'), errorId: 'ngaySinhError', validate: validateNgaySinh },
            gioiTinh: { input: document.getElementById('gioiTinh'), errorId: 'gioiTinhError', validate: validateGioiTinh },
            thaiKy: { input: document.getElementById('thaiKy'), errorId: 'thaiKyError', validate: validateThaiKy },
            tinhTrang: { input: document.getElementById('tinhTrang'), errorId: 'tinhTrangError', validate: validateTinhTrang },
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

        function validateGioiTinh() {
            const value = inputs.gioiTinh.input.value;
            if (value === '') {
                showError(inputs.gioiTinh.input, inputs.gioiTinh.errorId, 'Vui lòng chọn giới tính');
                return false;
            } else {
                hideError(inputs.gioiTinh.input, inputs.gioiTinh.errorId);
                return true;
            }
        }

        function validateThaiKy() {
              const value = inputs.thaiKy.input.value.trim();
              const weeks = parseInt(value, 10);
              if (value === '') {
                  showError(inputs.thaiKy.input, inputs.thaiKy.errorId, 'Thai kỳ không được để trống');
                  return false;
              } else if (isNaN(weeks) || weeks < 1 || weeks > 40) {
                  showError(inputs.thaiKy.input, inputs.thaiKy.errorId, 'Thai kỳ phải là số từ 1 đến 40 tuần');
                  return false;
              } else {
                  hideError(inputs.thaiKy.input, inputs.thaiKy.errorId);
                  return true;
              }
          }

        function validateTinhTrang() {
            const value = inputs.tinhTrang.input.value.trim();
            if (value === '') {
                showError(inputs.tinhTrang.input, inputs.tinhTrang.errorId, 'Tình trạng không được để trống');
                return false;
            } else {
                hideError(inputs.tinhTrang.input, inputs.tinhTrang.errorId);
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