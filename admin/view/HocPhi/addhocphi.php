<?php
  include_once("controller/HocPhi/cHocPhi.php");
  $p = new cHocPhi();
  $list_p  = $p->getallhosotre();
  
 ?>
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

  /* Additional style for error messages */
  .text-danger {
    font-size: 14px;
    color: #e3342f;
  }
</style>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        <h3 class="card-title text-center">Thêm Học Phí</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Quản lý Học Phí</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-lg-10"> <!-- Changed from col-md-8 to col-lg-10 -->
          <div class="card">
            <div class="card-body">
              
              <form action="#" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
                <div class="form-group">
                <label>Số Tiền</label>
                <input type="text" class="form-control" name="soTien" value="<?php echo isset($_POST['soTien']) ? htmlspecialchars($_POST['soTien']) : ''; ?>" required>
                </div>
                
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="hocKy">Học Kỳ</label>
                    <input type="text" class="form-control" id="hocKy" placeholder="Nhập Học Kỳ" name="hocKy" value="<?php echo isset($_POST['hocKy']) ? htmlspecialchars($_POST['hocKy']) : ''; ?>" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="namHoc">Năm Học</label>
                    <input type="text" class="form-control" id="namHoc" placeholder="Nhập Năm Học" name="namHoc" value="<?php echo isset($_POST['namHoc']) ? htmlspecialchars($_POST['namHoc']) : ''; ?>" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="moTa">Mô Tả</label>
                    <input type="text" class="form-control" id="moTa" placeholder="Nhập  Mô Tả" name="moTa" value="<?php echo isset($_POST['moTa']) ? htmlspecialchars($_POST['moTa']) : ''; ?>" required>
                  </div>
                
                </div>

                
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="idHoSo">Trẻ</label>
                    <select name="idHoSo" id="idHoSo" class="form-control">
                      <option value="0">Chọn Trẻ...</option>
                      <?php foreach ($list_p as $title_item) { ?>
                        <option value="<?php echo $title_item['idHoSo'] ?>"><?php echo $title_item['hoTenTE'] ?></option>
                      <?php } ?>
                    </select>
                    <p class="text-danger"><?php if (!empty($error['empty']['idHoSo'])) echo $error['empty']['idHoSo']; ?></p>
                  </div>
                </div>
                 

                <div class="form-group text-center">
                  <button type="submit" id="button" class="btn btn-primary btn-lg" name="submit">Thêm Học Phí</button>
                  <button type="reset" class="btn btn-secondary btn-lg" name="reset">Hủy</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

  <?php
if (isset($_POST["submit"])) {
    $idHoSo = $_POST['idHoSo'];
    $soTien = $_POST['soTien'];
    $hocKy = $_POST['hocKy'];
    $namHoc = $_POST['namHoc'];
    $moTa = $_POST['moTa'];

   
    $check_tt = 0;
    $result = $p->add_hocphi($idHoSo, $soTien, $hocKy, $namHoc,$moTa,$check_tt);

    if ($result) {
        echo "<script>alert('Thêm học phí thành công!');</script>";
        echo "<script>window.location.href='?qlhocphi'</script>";
    } else {
        echo "<script>alert('Thêm học phí thất bại!');</script>";
    }
}
?>
<script>
function validateForm() {
    // Get form fields
    const soTien = document.getElementById('soTien').value.trim();
    const hocKy = document.getElementById('hocKy').value.trim();
    const namHoc = document.getElementById('namHoc').value.trim();
    const moTa = document.getElementById('moTa').value.trim();
    const lopHoc = document.getElementById('idLopHoc').value;
   
    // Validate số tiền
    if(!/^[0-9]+$/.test(soTien)) {
        alert('Số tiền chỉ được nhập số');
        return false;
    }
   
    // Validate học kỳ 
    if(hocKy !== '1' && hocKy !== '2') {
        alert('Học kỳ chỉ được nhập số 1 hoặc 2');
        return false;
    }

    // Validate năm học
    const namHocPattern = /^[0-9]{4}-[0-9]{4}$/;
    if(!namHocPattern.test(namHoc)) {
        alert('Năm học phải có định dạng YYYY-YYYY (VD: 2023-2024)');
        return false;
    }

    // Validate năm sau lớn hơn năm trước
    const [namDau, namSau] = namHoc.split('-');
    if(parseInt(namSau) <= parseInt(namDau)) {
        alert('Năm sau phải lớn hơn năm trước');
        return false;
    }
   
    // Validate mô tả
    if(!/^[a-zA-Z0-9\sÀ-ỹ]+$/.test(moTa)) {
        alert('Mô tả không được chứa ký tự đặc biệt');
        return false;
    }

    // Validate selections
    if(lopHoc === '0') {
        alert('Vui lòng chọn lớp học');
        return false;
    }
    
    

    return true;
}

// Format currency input
document.getElementById('soTien').addEventListener('input', function(e) {
    let value = this.value.replace(/[^\d]/g, '');
    if(value) {
        value = parseInt(value).toLocaleString('vi-VN');
        this.value = value;
    }
});

// Auto format school year
document.getElementById('namHoc').addEventListener('input', function(e) {
    let value = this.value.replace(/\D/g, '');
    if(value.length >= 4) {
        const namDau = value.substr(0, 4);
        const namSau = (parseInt(namDau) + 1).toString();
        this.value = namDau + '-' + namSau;
    }
});
</script>
<script>
   document.getElementById('soTien').addEventListener('input', function(e) {
    // Loại bỏ tất cả các ký tự không phải số
    let value = this.value.replace(/[^\d]/g, '');
    
    // Nếu có giá trị, định dạng thành tiền VND
    if(value) {
        this.value = new Intl.NumberFormat('vi-VN', { 
            style: 'currency', 
            currency: 'VND' 
        }).format(value);
    } else {
        this.value = '';
    }
});
</script>