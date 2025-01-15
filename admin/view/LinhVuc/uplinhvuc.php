<?php
include("controller/LinhVuc/cLinhVuc.php");
$p = new cLinhVuc();
$idLinhVuc = $_REQUEST['idLinhVuc'];
$table = $p->get_tieude_ten($idLinhVuc);
$list_loai = $p->getunit();

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
                                    <label>ID Lĩnh Vực:</label>
                                    <input type="text" class="form-control" name="idLinhVuc" readonly value="<?php echo htmlspecialchars($row['idLinhVuc']); ?>">
                                </div>

                                <div class="form-group">
                                    <label>Tên Lĩnh Vực:</label>
                                    <input type="text" class="form-control" name="tenLinhVuc" id="linhvuc" value="<?php echo htmlspecialchars($row['tenLinhVuc']); ?>">
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
                    echo "<p>Không tìm thấy thông tin lĩnh vực .</p>";
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
    $idLinhVuc = $_REQUEST["idLinhVuc"];
    $tenLinhVuc = $_POST["tenLinhVuc"];
    $idUnit = $_REQUEST["unit"];
    // Kiểm tra câu hỏi đã tồn tại
    $current_question = $p->get_tieude_ten($idLinhVuc);
    $current_question_data = mysqli_fetch_assoc($current_question);
    
    // Check if the question text has changed
    if ($current_question_data['tenLinhVuc'] !== $tenLinhVuc) {
        // Check if the new question already exists
        $check_LinhVuc = $p->get_tenLinhVuc($tenLinhVuc, $idUnit);
        if ($check_LinhVuc) {
            echo "<script>
                document.getElementById('linhvuc').classList.add('is-invalid');
                document.getElementById('linhvucError').textContent = 'Tên lĩnh vực đã tồn tại trong Unit này';
                document.getElementById('linhvucError').style.display = 'block';
            </script>";
        } else {
            // Update the record
            $update = $p->update_linhvuc($idLinhVuc, $tenLinhVuc, $idUnit);
            if ($update) {
                echo "<script>alert('Cập nhật thành công');</script>";
                echo "<script>window.location.href='?qllinhvuc'</script>";
            } else {
                echo "<script>alert('Cập nhật không thành công');</script>";
            }
        }
    } else {
        echo "<script>alert('Không có thay đổi nào được thực hiện');</script>";
        echo "<script>window.location.href='?qllinhvuc'</script>";
    }
}
?>

?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    const inputs = {
        linhvuc: { 
            input: document.getElementById('linhvuc'), 
            errorId: 'linhvucError', 
            validate: validatelinhvuc 
        },
        
        unit: { 
            input: document.getElementById('unit'), 
            errorId: 'unitError', 
            validate: validateunit 
        }
    };

    // Add input event listeners for real-time validation
    for (const key in inputs) {
        const field = inputs[key];
        field.input.addEventListener('input', function() {
            validateField(field);
        });
        if (field.input.type === 'file') {
            field.input.addEventListener('change', function() {
                validateField(field);
            });
        }
    }

    form.addEventListener('submit', function (event) {
        let isValid = true;

        for (const key in inputs) {
            if (!validateField(inputs[key])) {
                isValid = false;
            }
        }

        if (!isValid) {
            event.preventDefault();
            alert('Vui lòng kiểm tra lại thông tin.');
        }
    });

    function validateField(field) {
        const errorMessage = field.validate(field.input);
        const errorElement = document.getElementById(field.errorId);

        if (errorMessage) {
            field.input.classList.add('is-invalid');
            errorElement.textContent = errorMessage;
            errorElement.style.display = 'block';
            return false;
        } else {
            field.input.classList.remove('is-invalid');
            errorElement.style.display = 'none';
            return true;
        }
    }

    function validatelinhvuc(input) {
        const value = input.value.trim();
        if (!value) {
            return 'Vui lòng nhập Tên Lĩnh Vực';
        }
        if (value.length < 5) {
            return 'Tên Lĩnh Vực phải có ít nhất 5 ký tự';
        }
        if (value.length > 100) {
            return 'Tên Lĩnh Vực không được vượt quá 100 ký tự';
        }
        return '';
    }

    
    function validateunit(input) {
        if (input.value === "0") {
            return 'Vui lòng chọn unit';
        }
        return '';
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