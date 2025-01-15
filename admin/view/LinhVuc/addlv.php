<?php
include_once("controller/LinhVuc/cLinhVuc.php");

$p = new cLinhVuc();
$list_loai = $p->get_LinhVuc();
$list_p = $p->getunit();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý Lĩnh Vực</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Quản lý Lĩnh Vực</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <h3 style="text-align:center">Thêm Lĩnh Vực</h3>
                            <form action="#" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="linhvuc">Tên Lĩnh Vực</label>
                                            <input type="text" class="form-control" id="linhvuc" name="linhvuc" placeholder="Nhập Tên Lĩnh Vực" value="<?php echo isset($_POST['linhvuc']) ? htmlspecialchars($_POST['linhvuc']) : ''; ?>" required>
                                            <span class="error" id="linhvucError"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="unit">Unit</label>
                                            <select name="unit" id="unit" class="form-control" required>
                                                <option value="0">Chọn Unit...</option>
                                                <?php foreach ($list_p as $title_item) { ?>
                                                    <option value="<?php echo $title_item['idUnit'] ?>"><?php echo $title_item['tenUnit'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="error" id="unitError"></span>
                                        </div>
                                    </div>
                                
                                     
                                        
                                   
                                </div>
                                <div class="text-center">
                                    <button type="submit" id="button" class="btn btn-primary" name="submit">Thêm Lĩnh Vực</button>
                                    <button type="reset" class="btn btn-secondary" name="reset">Hủy</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php


if (isset($_REQUEST["submit"])) {
    $tenLinhVuc = $_REQUEST["linhvuc"];
    $idUnit = $_REQUEST["unit"];

    $p = new cLinhVuc();
    $check_linhvuc = $p->get_tenLinhVuc($tenLinhVuc,$idUnit);

    if ($idUnit == "0") {
        echo "<script>
            document.getElementById('unit').classList.add('is-invalid');
            document.getElementById('unitError').textContent = 'Vui lòng chọn Unit';
            document.getElementById('unitError').style.display = 'block';
        </script>";
    }

    if ($check_linhvuc) {
        echo "<script>
            document.getElementById('linhvuc').classList.add('is-invalid');
            document.getElementById('linhvucError').textContent = 'Tên Lĩnh Vực đã tồn tại trong Unit này';
            document.getElementById('linhvucError').style.display = 'block';
        </script>";
    } elseif ($idUnit == "0") {
        // Do nothing, errors are already displayed
    } else {
    
            $insert = $p->add_linhvuc($tenLinhVuc,$idUnit);
            if ($insert == 1) {
                echo "<script>alert('Thêm thành công');</script>";
                echo "<script>window.location.href='?qllinhvuc'</script>";
            } else {
                echo "<script>alert('Thêm không thành công');</script>";
                echo "<script>window.location.href='?qllinhvuc'</script>";
            }
    }
}
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
    button {
    padding: 5px 10px; /* Thu nhỏ khoảng cách trên/dưới và trái/phải */
    font-size: 14px; /* Kích thước chữ nhỏ hơn */
}
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

    input[type="text"], input[type="file"], select {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin-bottom: 15px;
        transition: border 0.3s;
    }

    input[type="text"]:focus, input[type="file"]:focus, select:focus {
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

    /* Form layout */
    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        margin-bottom: 5px;
    }

    .form-group input, .form-group select {
        flex: 1;
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