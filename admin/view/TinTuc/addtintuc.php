<?php
include_once("controller/TinTuc/cTinTuc.php");

$p = new cloaibaiviet();
$list_loai = $p->select_tintuc();
$list_p = $p->get_danhmuc();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý Tin Tức</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Quản lý Tin Tức</li>
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
                            <h3 style="text-align:center">Thêm Bài Viết</h3>
                            <form action="#" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tieude">Tiêu Đề</label>
                                            <input type="text" class="form-control" id="tieude" name="tieude" placeholder="Nhập Tiêu Đề" value="<?php echo isset($_POST['tieude']) ? htmlspecialchars($_POST['tieude']) : ''; ?>" required>
                                            <span class="error" id="tieudeError"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="cau1">Nội dung</label>
                                            <input type="text" class="form-control" id="cau1" name="cau1" placeholder="Nhập nội dung" value="<?php echo isset($_POST['cau1']) ? htmlspecialchars($_POST['cau1']) : ''; ?>" required>
                                            <span class="error" id="cau1Error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hinhAnh">Hình Ảnh</label>
                                            <input type="file" class="form-control" id="hinhAnh" name="hinhAnh" required>
                                            <span class="error" id="hinhAnhError"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="danhmuc">Danh Mục</label>
                                            <select name="danhmuc" id="danhmuc" class="form-control" required>
                                                <option value="0">Chọn Danh Mục...</option>
                                                <?php foreach ($list_p as $title_item) { ?>
                                                    <option value="<?php echo $title_item['idDanhMuc'] ?>"><?php echo $title_item['tenDanhMuc'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="error" id="danhmucError"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" id="button" class="btn btn-primary" name="submit">Thêm bài viết</button>
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
include_once("model/connect.php");

if (isset($_REQUEST["submit"])) {
    $tieuDe = $_REQUEST["tieude"];
    $noiDung = $_REQUEST["cau1"];
    $hinhAnh = isset($_FILES["hinhAnh"]["name"]) ? $_FILES["hinhAnh"]["name"] : '';
    $hinhAnh_tmp = isset($_FILES["hinhAnh"]["tmp_name"]) ? $_FILES["hinhAnh"]["tmp_name"] : '';
    $uploads_dir = 'admin/assets/uploads/images/';
    $danhMuc = $_REQUEST["danhmuc"];

    $p = new cloaibaiviet();
    $check_tieude = $p->get_tieude_ten($tieuDe);

    if ($danhMuc == "0") {
        echo "<script>
            document.getElementById('danhmuc').classList.add('is-invalid');
            document.getElementById('danhmucError').textContent = 'Vui lòng chọn danh mục';
            document.getElementById('danhmucError').style.display = 'block';
        </script>";
    }

    if ($check_tieude) {
        echo "<script>
            document.getElementById('tieude').classList.add('is-invalid');
            document.getElementById('tieudeError').textContent = 'Tiêu đề đã tồn tại';
            document.getElementById('tieudeError').style.display = 'block';
        </script>";
    } elseif ($danhMuc == "0") {
        // Do nothing, errors are already displayed
    } else {
        if (!is_dir($uploads_dir)) {
            mkdir($uploads_dir, 0777, true);
        }

        if ($hinhAnh && move_uploaded_file($hinhAnh_tmp, $uploads_dir . $hinhAnh)) {
            $insert = $p->add_tintuc($tieuDe, $noiDung, $hinhAnh, $danhMuc);
            if ($insert == 1) {
                echo "<script>alert('Thêm thành công');</script>";
                echo "<script>window.location.href='?qltt'</script>";
            } else {
                echo "<script>alert('Thêm không thành công');</script>";
                echo "<script>window.location.href='?qltt'</script>";
            }
        } else {
            echo "<script>alert('Upload ảnh không thành công');</script>";
        }
    }
}
?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    const inputs = {
        tieude: { 
            input: document.getElementById('tieude'), 
            errorId: 'tieudeError', 
            validate: validateTieuDe 
        },
        cau1: { 
            input: document.getElementById('cau1'), 
            errorId: 'cau1Error', 
            validate: validateCau 
        },
        hinhAnh: { 
            input: document.getElementById('hinhAnh'), 
            errorId: 'hinhAnhError', 
            validate: validateHinhAnh 
        },
        danhmuc: { 
            input: document.getElementById('danhmuc'), 
            errorId: 'danhmucError', 
            validate: validateDanhMuc 
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

    function validateTieuDe(input) {
        const value = input.value.trim();
        if (!value) {
            return 'Vui lòng nhập tiêu đề';
        }
        if (value.length < 5) {
            return 'Tiêu đề phải có ít nhất 5 ký tự';
        }
        if (value.length > 100) {
            return 'Tiêu đề không được vượt quá 100 ký tự';
        }
        return '';
    }

    function validateCau(input) {
        const value = input.value.trim();
        if (!value) {
            return 'Vui lòng nhập nội dung';
        }
        if (value.length < 20) {
            return 'Nội dung phải có ít nhất 20 ký tự';
        }
        if (value.length > 1000) {
            return 'Nội dung không được vượt quá 1000 ký tự';
        }
        return '';
    }

    function validateHinhAnh(input) {
        const file = input.files[0];
        if (!file) {
            return 'Vui lòng chọn hình ảnh';
        }
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
            return 'Chỉ chấp nhận các định dạng ảnh: JPEG, PNG, GIF';
        }
        const maxSize = 3 * 1024 * 1024; // 3MB
        if (file.size > maxSize) {
            return 'Kích thước ảnh không được vượt quá 3MB';
        }
        return '';
    }

    function validateDanhMuc(input) {
        if (input.value === "0") {
            return 'Vui lòng chọn danh mục';
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