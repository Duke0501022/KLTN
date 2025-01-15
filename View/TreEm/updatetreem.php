<?php
   include("Controller/cTreEm.php");
  
    $idHoSo = $_REQUEST['idHoSo'];
   
   $p = new cHoSoTreEm();
   $table = $p-> select_treem_byid($idHoSo);
   
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
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
                            echo "<img src='admin/admin/assets/uploads/images/".$row['hinhAnh']."' alt='' class='img-fluid mb-2' style='max-height: 200px;'>";
                          }
                        ?>
                        <input type='file' class='form-control-file' id="hinhAnh" name='txtHinhAnh'>
                        <span class="error" id="hinhAnhError"></span>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Mã Hồ Sơ</label>
                        <input type='text' class='form-control' name='txtmakh'  value="<?php echo $row['idHoSo']; ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Họ và Tên</label>
                        <input type='text' class='form-control' name='txttenkh' id="tenkh" value="<?php echo $row['hoTenTE']; ?>">
                        <span class="error" id="tenkhError"></span>
                      </div>
                      <div class="form-group">
                        <label>Giới Tính</label>
                        <select name="txtgioitinh" id="gioiTinh" class="form-control">
                          <option value="0" <?php if ($row['gioiTinh'] == "0") echo "selected"; ?>>Nam</option>
                          <option value="1" <?php if ($row['gioiTinh'] == "1") echo "selected"; ?>>Nữ</option>
                        </select>
                        <span class="error" id="gioiTinhError"></span>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Tình Trạng</label>
                        <input type='text' class='form-control' name='txtTrang' id="tinhTrang" value="<?php echo $row['tinhTrang']; ?>">
                        <span class="error" id="tinhTrangError"></span>
                      </div>
                      <div class="form-group">
                        <label>Ngày Sinh</label>
                        <input type='date' class='form-control' name='txtngaysinh' id="ngaySinh" value="<?php echo $row['ngaySinh']; ?>">
                        <span class="error" id="ngaySinhError"></span>
                      </div>
                      <div class="form-group">
                        <label>Thai Kỳ</label>
                        <input type='text' class='form-control' name='txtthaiky' id="thaiKy" value="<?php echo $row['thaiKy']; ?>">
                        <span class="error" id="thaiKyError"></span>
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
    $hoTenTE=$_REQUEST["txttenkh"];
    $gioiTinh=$_REQUEST["txtgioitinh"];
    $ngaySinh=$_REQUEST["txtngaysinh"];
    $thaiKy=$_REQUEST["txtthaiky"];
    $tinhTrang=$_REQUEST["txtTrang"];
   
    $hinhAnhCu = $row['hinhAnh'] ?? '';
    $hinhAnh = NULL;

    if (isset($_FILES['txtHinhAnh']) && $_FILES['txtHinhAnh']['size'] > 0) {
        $target_dir = "admin/assets/uploads/images/";
        $target_file = $target_dir . basename($_FILES["txtHinhAnh"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["txtHinhAnh"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "<script>alert('File không phải là hình ảnh.');</script>";
            $uploadOk = 0;
        }

        if ($_FILES["txtHinhAnh"]["size"] > 5000000) {
            echo "<script>alert('Xin lỗi, hình ảnh quá lớn.');</script>";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "<script>alert('Xin lỗi, hình ảnh của bạn không được tải lên.');</script>";
        } else {
            if (move_uploaded_file($_FILES["txtHinhAnh"]["tmp_name"], $target_file)) {
                $hinhAnh = basename($_FILES["txtHinhAnh"]["name"]);
            } else {
                echo "<script>alert('Xin lỗi, đã có lỗi xảy ra khi tải lên file.');</script>";
            }
        }
    } else {
        $hinhAnh = $hinhAnhCu;
    }
  
    $p = new cHoSoTreEm();
   
  // Gọi phương thức cập nhật
  
  $update = $p->update_TE($idHoSo,$hoTenTE, $ngaySinh, $thaiKy, $tinhTrang,$hinhAnh,$gioiTinh,$tmpimg = '', $typeimg = '', $sizeimg = '');

if ($update == 1) {
    echo "<script>alert('Cập nhật thành công');</script>";
    echo "<script>window.location.href='?hosotreem'</script>";
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

        
    });
</script>