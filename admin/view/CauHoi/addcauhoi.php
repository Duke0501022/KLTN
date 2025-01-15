<?php
  include_once("controller/CauHoi/cCauHoi.php");
  
  $p = new cCauHoi();
  $list_loai = $p->select_unit();
  $list_p = $p->select_linhvuc();
?>
<!DOCTYPE html>
<html>
<head>
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

        input[type="text"], select, input[type="file"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
            transition: border 0.3s;
        }

        input[type="text"]:focus, select:focus, input[type="file"]:focus {
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

        .error {
            color: red;
            display: none;
            margin-top: 5px;
        }
        .is-invalid {
            border-color: red;
        }
    </style>
</head>
<body>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        <h3 class="card-title text-center">Thêm Câu Hỏi</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Quản lý câu hỏi</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="card">
            <div class="card-body">
              
              <form action="" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
              <div class="form-group">
                  <label for="cauhoi">Câu Hỏi</label>
                  <input type="text" class="form-control" id="cauhoi" placeholder="Nhập Câu Hỏi" name="cauhoi" value="<?php echo isset($_POST['cauhoi']) ? htmlspecialchars($_POST['cauhoi']) : ''; ?>" required>
                  <span class="error" id="cauhoiError"></span>
              </div>

              <div class="form-row">
                  <div class="form-group col-md-4">
                      <label for="cau1">Câu 1</label>
                      <input type="text" class="form-control" id="cau1" placeholder="Nhập Câu 1" name="cau1" value="<?php echo isset($_POST['cau1']) ? htmlspecialchars($_POST['cau1']) : ''; ?>" required>
                      <span class="error" id="cau1Error"></span>
                  </div>
                  <div class="form-group col-md-4">
                      <label for="cau2">Câu 2</label>
                      <input type="text" class="form-control" id="cau2" placeholder="Nhập Câu 2" name="cau2" value="<?php echo isset($_POST['cau2']) ? htmlspecialchars($_POST['cau2']) : ''; ?>" required>
                      <span class="error" id="cau2Error"></span>
                  </div>
                  <div class="form-group col-md-4">
                      <label for="cau3">Câu 3</label>
                      <input type="text" class="form-control" id="cau3" placeholder="Nhập Câu 3" name="cau3" value="<?php echo isset($_POST['cau3']) ? htmlspecialchars($_POST['cau3']) : ''; ?>" required>
                      <span class="error" id="cau3Error"></span>
                  </div>
                  <div class="form-group col-md-4">
                      <label for="hinhAnh">Hình Ảnh</label>
                      <input type="file" class="form-control" id="hinhAnh" name="hinhAnh" required>
                      <span class="error" id="hinhAnhError"></span>
                  </div>
              </div>

              <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="linhvuc">Lĩnh Vực</label>
                      <select name="linhvuc" id="linhvuc" class="form-control">
                          <option value="0">Chọn Lĩnh Vực...</option>
                          <?php foreach ($list_p as $title_item) { ?>
                              <option value="<?php echo $title_item['idLinhVuc'] ?>"><?php echo $title_item['tenLinhVuc'] ?></option>
                          <?php } ?>
                      </select>
                      <span class="error" id="linhvucError"></span>
                  </div>
                  
                  <div class="form-group col-md-6">
                      <label for="unit">Unit</label>
                      <select name="unit" id="unit" class="form-control">
                          <option value="0">Chọn Unit...</option>
                          <?php foreach ($list_loai as $title_item) { ?>
                              <option value="<?php echo $title_item['idUnit'] ?>"><?php echo $title_item['tenUnit'] ?></option>
                          <?php } ?>
                      </select>
                      <span class="error" id="unitError"></span>
                  </div>
              </div>

                <div class="form-group text-center">
                  <button type="submit" id="button" class="btn btn-primary btn-lg" name="submit">Thêm câu hỏi</button>
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
if (isset($_REQUEST["submit"])) {
    $cauHoi = $_REQUEST["cauhoi"];
    $cau1 = $_POST['cau1'];
    $cau2 = $_POST['cau2'];
    $cau3 = $_POST['cau3'];
    $idUnit = $_REQUEST["unit"];
    $idLinhVuc = $_REQUEST["linhvuc"];
    
    // Kiểm tra câu hỏi đã tồn tại
    $check_cauhoi = $p->get_cauhoi_ten($cauHoi);
    
    // Kiểm tra câu trả lời có trùng nhau không
    $unique_answers = count(array_unique([$cau1, $cau2, $cau3])) === 3;
    $errors = [];

    if (!$unique_answers) {
        echo "<script>
            document.getElementById('cau1').classList.add('is-invalid');
            document.getElementById('cau2').classList.add('is-invalid');
            document.getElementById('cau3').classList.add('is-invalid');
            document.getElementById('cau1Error').textContent = 'Các câu trả lời không được trùng nhau';
            document.getElementById('cau1Error').style.display = 'block';
            document.getElementById('cau2Error').textContent = 'Các câu trả lời không được trùng nhau';
            document.getElementById('cau2Error').style.display = 'block';
            document.getElementById('cau3Error').textContent = 'Các câu trả lời không được trùng nhau';
            document.getElementById('cau3Error').style.display = 'block';
        </script>";
    }

    if ($idLinhVuc == "0") {
        echo "<script>
            document.getElementById('linhvuc').classList.add('is-invalid');
            document.getElementById('linhvucError').textContent = 'Vui lòng chọn lĩnh vực';
            document.getElementById('linhvucError').style.display = 'block';
        </script>";
    }

    if ($idUnit == "0") {
        echo "<script>
            document.getElementById('unit').classList.add('is-invalid');
            document.getElementById('unitError').textContent = 'Vui lòng chọn unit';
            document.getElementById('unitError').style.display = 'block';
        </script>";
    }

    if ($check_cauhoi) {
        echo "<script>
            document.getElementById('cauhoi').classList.add('is-invalid');
            document.getElementById('cauhoiError').textContent = 'Câu hỏi đã tồn tại';
            document.getElementById('cauhoiError').style.display = 'block';
        </script>";
    } elseif (!$unique_answers || $idLinhVuc == "0" || $idUnit == "0") {
        // Do nothing, errors are already displayed
    } else {
        if (isset($_FILES['hinhAnh'])) {
            $hinhAnh = $_FILES['hinhAnh']['name'];
            $hinhAnh_tmp = $_FILES['hinhAnh']['tmp_name'];
            $uploads_dir = 'admin/assets/uploads/images/';
            if (!is_dir($uploads_dir)) {
                mkdir($uploads_dir, 0777, true);
            }
            
            if (move_uploaded_file($hinhAnh_tmp, $uploads_dir . $hinhAnh)) {
                $p = new cCauHoi();
                $insert = $p->add_cauhoi($cauHoi, $cau1, $cau2, $cau3, $hinhAnh, $idUnit, $idLinhVuc);
                if ($insert == 1) {
                    echo "<script>
                        alert('Thêm thành công');
                        window.location.href='?qlbt';
                    </script>";
                } else {
                    echo "<script>
                        alert('Thêm không thành công');
                        window.location.href='?qlbt';
                    </script>";
                }
            }
        } else {
            echo "<script>alert('Vui lòng chọn hình ảnh');</script>";
        }
    }
}
?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
 
    const inputs = {
        cauhoi: { 
            input: document.getElementById('cauhoi'), 
            errorId: 'cauhoiError', 
            validate: validateCauHoi 
        },
        cau1: { 
            input: document.getElementById('cau1'), 
            errorId: 'cau1Error', 
            validate: validateCau 
        },
        cau2: { 
            input: document.getElementById('cau2'), 
            errorId: 'cau2Error', 
            validate: validateCau 
        },
        cau3: { 
            input: document.getElementById('cau3'), 
            errorId: 'cau3Error', 
            validate: validateCau 
        },
        hinhAnh: { 
            input: document.getElementById('hinhAnh'), 
            errorId: 'hinhAnhError', 
            validate: validateHinhAnh 
        },
        linhvuc: { 
            input: document.getElementById('linhvuc'), 
            errorId: 'linhvucError', 
            validate: validateLinhVuc 
        },
        unit: { 
            input: document.getElementById('unit'), 
            errorId: 'unitError', 
            validate: validateUnit 
        }
    };

    // Add input event listeners
    for (const key in inputs) {
        const field = inputs[key];
        field.input.addEventListener('input', function() {
            validateField(field);
            validateUniqueCau();
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

        if (!validateUniqueCau()) {
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
            alert('Vui lòng kiểm tra lại thông tin.');
        }
    });

    function validateField(field) {
        const isValid = field.validate();
        const errorElement = document.getElementById(field.errorId);
        if (errorElement) {
            errorElement.style.display = isValid ? 'none' : 'block';
            field.input.classList.toggle('is-invalid', !isValid);
        }
        return isValid;
    }

    function validateCauHoi() {
        const cauhoi = inputs.cauhoi.input.value.trim();
        if (cauhoi.length < 10) {
            document.getElementById('cauhoiError').textContent = 'Câu hỏi phải có ít nhất 10 ký tự';
            return false;
        }
        return true;
    }

    function validateCau() {
        const cau = this.value.trim();
        if (cau.length < 1) {
            document.getElementById(this.id + 'Error').textContent = 'Vui lòng nhập câu trả lời';
            return false;
        }
        return true;
    }

        function validateHinhAnh() {
        const fileInput = inputs.hinhAnh.input;
        const errorElement = document.getElementById('hinhAnhError');
        
        // Check if file is selected
        if (fileInput.files.length === 0) {
            errorElement.textContent = 'Vui lòng chọn hình ảnh';
            return false;
        }

        const file = fileInput.files[0];
        const fileName = file.name.toLowerCase();
        const fileSize = file.size; // in bytes
        const maxSize = 5 * 1024 * 1024; // 5MB
        const allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        const fileExtension = fileName.split('.').pop();

        // Check file extension
        if (!allowedTypes.includes(fileExtension)) {
            errorElement.textContent = 'Chỉ chấp nhận file: jpg, jpeg, png, gif';
            return false;
        }

        // Check file size
        if (fileSize > maxSize) {
            errorElement.textContent = 'Kích thước file phải nhỏ hơn 5MB';
            return false;
        }

        errorElement.textContent = '';
        return true;
    }

    function validateLinhVuc() {
        const linhvuc = inputs.linhvuc.input.value;
        if (linhvuc === "0") {
            document.getElementById('linhvucError').textContent = 'Vui lòng chọn lĩnh vực';
            return false;
        }
        return true;
    }

    function validateUnit() {
        const unit = inputs.unit.input.value;
        if (unit === "0") {
            document.getElementById('unitError').textContent = 'Vui lòng chọn unit';
            return false;
        }
        return true;
    }
    inputs.cau1.input.addEventListener('input', function() {
    // Chỉ validate khi tất cả các câu đã được nhập
    if (inputs.cau2.input.value.trim() && inputs.cau3.input.value.trim()) {
        validateUniqueCau();
    }
});

inputs.cau2.input.addEventListener('input', function() {
    if (inputs.cau1.input.value.trim() && inputs.cau3.input.value.trim()) {
        validateUniqueCau();
    }
});

inputs.cau3.input.addEventListener('input', function() {
    if (inputs.cau1.input.value.trim() && inputs.cau2.input.value.trim()) {
        validateUniqueCau();
    }
});

    function validateUniqueCau() {
    const cau1 = inputs.cau1.input.value.trim();
    const cau2 = inputs.cau2.input.value.trim();
    const cau3 = inputs.cau3.input.value.trim();

    // Reset trước
    inputs.cau1.input.classList.remove('is-invalid');
    inputs.cau2.input.classList.remove('is-invalid');
    inputs.cau3.input.classList.remove('is-invalid');
    document.getElementById('cau1Error').style.display = 'none';
    document.getElementById('cau2Error').style.display = 'none';
    document.getElementById('cau3Error').style.display = 'none';

    // Chỉ kiểm tra khi tất cả các câu đã được nhập đầy đủ
    if (cau1 && cau2 && cau3) {
        const answers = [cau1, cau2, cau3];
        const uniqueAnswers = new Set(answers);

        if (uniqueAnswers.size < 3) {
            const errorMessage = 'Các câu trả lời không được trùng nhau';
            
            inputs.cau1.input.classList.add('is-invalid');
            inputs.cau2.input.classList.add('is-invalid');
            inputs.cau3.input.classList.add('is-invalid');
            
            document.getElementById('cau1Error').textContent = errorMessage;
            document.getElementById('cau2Error').textContent = errorMessage;
            document.getElementById('cau3Error').textContent = errorMessage;
            
            document.getElementById('cau1Error').style.display = 'block';
            document.getElementById('cau2Error').style.display = 'block';
            document.getElementById('cau3Error').style.display = 'block';
            
            return false;
        }
    }

    return true;
}
document.getElementById('button').onsubmit = function() {
  return validateUniqueCau();
};
});
document.getElementById('unit').addEventListener('change', function() {
    const unitId = this.value;
    const linhvucSelect = document.getElementById('linhvuc');
    
    // Reset linhvuc dropdown
    linhvucSelect.innerHTML = '<option value="0">Chọn lĩnh vực</option>';
    
    if (unitId !== "0") {
        // Add debugging
        console.log('Fetching linhvuc for unit:', unitId);
        
        fetch(`View/CauHoi/get_linhvuc.php?unit_id=${unitId}`)
            .then(response => response.json())
            .then(data => {
                console.log('Received data:', data); // Debug
                if (data.error) {
                    console.error('Error:', data.error);
                    return;
                }
                data.forEach(lv => {
                    const option = document.createElement('option');
                    option.value = lv.idLinhVuc;
                    option.textContent = lv.tenLinhVuc;
                    linhvucSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Fetch error:', error));
    }
});
    </script>
 