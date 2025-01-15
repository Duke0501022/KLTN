<?php
include("controller/CauHoi/cCauHoi.php");
$p = new cCauHoi();

// Lấy ID câu hỏi từ request
$idcauHoi = isset($_REQUEST['idcauHoi']) ? $_REQUEST['idcauHoi'] : '';

// Lấy thông tin câu hỏi hiện tại
$table = $p->select_cauhoi_id($idcauHoi);


// Lấy danh sách unit và lĩnh vực
$list_loai = $p->select_unit();
$list_p = $p->select_linhvuc();
?> 

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý Câu Hỏi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Quản lý Câu Hỏi</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 style="text-align:center">Cập nhật câu hỏi</h3>
                        </div>
                        <div class="card-body">
                        <?php
                  if ($table && mysqli_num_rows($table) > 0) {
                    $row = mysqli_fetch_assoc($table);
                ?>
                            <form name="updateForm" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>ID Câu Hỏi:</label>
                                    <input type="text" class="form-control" name="idcauHoi" readonly value="<?php echo htmlspecialchars($row['idcauHoi']); ?>">
                                </div>

                                <div class="form-group">
                                    <label>Câu Hỏi:</label>
                                    <input type="text" class="form-control" name="cauhoi" id="cauhoi" value="<?php echo htmlspecialchars($row['cauHoi']); ?>">
                                    <span class="error" id="cauhoiError"></span>
                                </div>

                                <div class="form-group">
                                    <label>Hình Ảnh:</label>
                                    <?php
                          if($row["hinhAnh"] == NULL){
                            echo "<img src='/assets/uploads/images/user.png' alt='' class='img-fluid mb-2' style='max-height: 200px; border-radius: 50px;'>";
                          } else {
                            echo "<img src='admin/assets/uploads/images/".$row['hinhAnh']."' alt='' class='img-fluid mb-2' style='max-height: 200px; border-radius: 50px;'>";
                          }
                        ?>
                        <input type='file' class='form-control-file' id="hinhAnh" name='hinhAnh'>
                        <span class="error" id="hinhAnhError"></span>
                                </div>

                                <div class="form-group">
                                    <label>Đáp án 1:</label>
                                    <input type="text" class="form-control" name="cau1" id="cau1" value="<?php echo htmlspecialchars($row['cau1']); ?>">
                                    <span class="error" id="cau1Error"></span>
                                </div>

                                <div class="form-group">
                                    <label>Đáp án 2:</label>
                                    <input type="text" class="form-control" name="cau2" id="cau2" value="<?php echo htmlspecialchars($row['cau2']); ?>">
                                    <span class="error" id="cau2Error"></span>
                                </div>

                                <div class="form-group">
                                    <label>Đáp án 3:</label>
                                    <input type="text" class="form-control" name="cau3" id ="cau3" value="<?php echo htmlspecialchars($row['cau3']); ?>">
                                    <span class="error" id="cau3Error"></span>
                                </div>

                                <div class="form-group">
                                    <label>Lĩnh Vực:</label>
                                    <select name="linhvuc" id="linhvuc" class="form-control">
                                        <option value="0">Chọn lĩnh vực...</option>
                                        <?php foreach ($list_p as $item): ?>
                                            <option value="<?php echo $item['idLinhVuc']; ?>" 
                                                <?php echo ($row['idLinhVuc'] == $item['idLinhVuc']) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($item['tenLinhVuc']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="error" id="linhvucError"></span>
                                </div>

                                <div class="form-group">
                                    <label>Unit:</label>
                                    <select name="unit" id="unit" class="form-control">
                                        <option value="0">Chọn unit...</option>
                                        <?php foreach ($list_loai as $item): ?>
                                            <option value="<?php echo $item['idUnit']; ?>"
                                                <?php echo ($row['idUnit'] == $item['idUnit']) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($item['tenUnit']); ?>
                                                <?php echo htmlspecialchars($item['moTaUnit']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="error" id="unitError"></span>
                                </div>

                                <div class="text-center">
                                    <button type="submit" id="button" class="btn btn-primary" name="submit">Cập nhật</button>
                                    <button type="reset" class="btn btn-secondary">Làm mới</button>
                                </div>
                            </form>
                            <?php
                  } else {
                    echo "<p>Không tìm thấy thông tin câu hỏi .</p>";
                  }
                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
if (isset($_REQUEST["submit"])) {
    $idcauHoi = $_REQUEST["idcauHoi"];
    $cauHoi = $_POST["cauhoi"];
    $cau1 = $_POST['cau1'];
    $cau2 = $_POST['cau2'];
    $cau3 = $_POST['cau3'];
    $idLinhVuc = $_REQUEST["linhvuc"];
    $idUnit = $_REQUEST["unit"];
    
    // Kiểm tra câu hỏi đã tồn tại
    $current_question = $p->select_cauhoi_id($idcauHoi);
    $current_question_data = mysqli_fetch_assoc($current_question);
    
    // Check if the question text has changed
    if ($current_question_data['cauHoi'] !== $cauHoi) {
        // Check if the new question already exists
        $check_cauhoi = $p->get_cauhoi_ten($cauHoi);
        if ($check_cauhoi) {
            echo "<script>
                document.getElementById('cauhoi').classList.add('is-invalid');
                document.getElementById('cauhoiError').textContent = 'Câu hỏi đã tồn tại';
                document.getElementById('cauhoiError').style.display = 'block';
            </script>";
        }
    } else {
        $check_cauhoi = false; // No need to check for duplicates if the question hasn't changed
    }
    
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
            document.getElementById('unitError').textContent = 'Vui lòng chọn Unit';
            document.getElementById('unitError').style.display = 'block';
        </script>";
    }

    if (!$unique_answers || $idLinhVuc == "0" || $check_cauhoi || $idUnit == "0") {
        // Do nothing, errors are already displayed
    } else {
        if (isset($_FILES['hinhAnh']) && $_FILES['hinhAnh']['error'] === UPLOAD_ERR_OK) {
            // Get file info
            $file = $_FILES['hinhAnh'];
            $file_extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
            $file_size = $file['size'];
            $file_type = $file['type'];
            
            // Validation settings
            $max_size = 5 * 1024 * 1024; // 5MB
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            
            // Validate file
            $errors = [];
            
            if (!in_array($file_type, $allowed_types)) {
                $errors[] = "Chỉ chấp nhận file hình ảnh (JPG, PNG, GIF)";
            }
            
            if (!in_array($file_extension, $allowed_extensions)) {
                $errors[] = "Định dạng file không hợp lệ";
            }
            
            if ($file_size > $max_size) {
                $errors[] = "Kích thước file phải nhỏ hơn 5MB";
            }
            
            if (!empty($errors)) {
                echo "<script>alert('".implode("\\n", $errors)."'); window.location.href='?qlbt';</script>";
                exit;
            }
        
            // Proceed with upload if validation passes
            $hinhAnh = uniqid() . '.' . $file_extension;
            $upload_path = 'admin/assets/uploads/images/' . $hinhAnh;
            
            if (!move_uploaded_file($file['tmp_name'], $upload_path)) {
                echo "<script>alert('Lỗi upload hình ảnh'); window.location.href='?qlbt';</script>";
                exit;
            }
        
            // Delete old image
            if (!empty($row['hinhAnh']) && file_exists('admin/assets/uploads/images/' . $row['hinhAnh'])) {
                unlink('admin/assets/uploads/images/' . $row['hinhAnh']);
            }
        } else {
            // Keep existing image
            $hinhAnh = $row['hinhAnh'];
        }

        $update = $p->update_cauhoi1($idcauHoi, $cauHoi, $cau1, $cau2, $cau3, $hinhAnh, $idUnit, $idLinhVuc);
        if ($update == 1) {
            echo "<script>
                alert('Cập nhật thành công');
                window.location.href='?qlbt';
            </script>";
        } else {
            echo "<script>
                alert('Cập nhật không thành công');
                window.location.href='?qlbt';
            </script>";
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

    

    function validateLinhVuc() {
        const linhvuc = inputs.linhvuc.input.value;
        if (linhvuc === "0") {
            document.getElementById('linhvucError').textContent = 'Vui lòng chọn lĩnh vực';
            return false;
        }
        return true;
    }
    function validateUnit(){
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
document.addEventListener('DOMContentLoaded', function() {
    const unitSelect = document.getElementById('unit');
    const linhvucSelect = document.getElementById('linhvuc');

    // Keep current linhvuc value for re-selection after loading new options
    const currentLinhvuc = linhvucSelect.value;

    unitSelect.addEventListener('change', function() {
        const unitId = this.value;
        
        // Reset linhvuc dropdown
        linhvucSelect.innerHTML = '<option value="0">Chọn lĩnh vực</option>';
        
        if (unitId !== "0") {
            fetch(`View/CauHoi/get_linhvuc.php?unit_id=${unitId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error('Error:', data.error);
                        return;
                    }
                    
                    data.forEach(lv => {
                        const option = document.createElement('option');
                        option.value = lv.idLinhVuc;
                        option.textContent = lv.tenLinhVuc;
                        // Re-select current linhvuc if it exists in new options
                        if (lv.idLinhVuc == currentLinhvuc) {
                            option.selected = true;
                        }
                        linhvucSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Fetch error:', error));
        }
    });

    // Trigger change event on page load if unit is pre-selected
    if (unitSelect.value !== "0") {
        unitSelect.dispatchEvent(new Event('change'));
    }
});
</script>
<style>
.card {
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.card-header {
    background-color: #f8f9fa;
    padding: 15px;
    border-bottom: 1px solid #dee2e6;
}

.card-body {
    padding: 20px;
}

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    font-weight: 600;
    margin-bottom: 0.5rem;
    display: block;
}

.form-control {
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus {
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

.btn {
    margin: 0 5px;
}

.text-center {
    text-align: center;
}

select.form-control {
    height: calc(1.5em + 0.75rem + 2px);
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