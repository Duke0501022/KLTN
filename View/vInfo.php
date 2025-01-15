<?php
include_once("Controller/cInfo.php");

$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
$info = new cInfo();
$result = $info->select_info($username);
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin tài khoản</title>
   
</head>
<body>
<style>
    .user-info {
        margin-top: 50px;
        display: flex;
        justify-content: space-between;
        padding: 20px;
        background-color: #f1f1f1;
        border-radius: 15px;
    }

    .user-image-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-right: 40px;
        padding: 20px;
        border-radius: 15px;
        overflow: hidden;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }

    .user-image-container:hover {
        transform: scale(1.05);
    }

    .user-image {
        width: 300px;
        height: 200px;
        object-fit: cover;
        border-radius: 15px;
        transition: transform 0.3s ease-in-out;
    }

    .user-image:hover {
        transform: scale(1.1);
    }

    .user-details {
        display: flex;
        flex-direction: column;
        justify-content: center;
        border-left: 2px solid #ddd;
        padding-left: 30px;
        text-align: left;
        flex: 1;
    }

    .user-details h5 {
        margin-top: 0;
        margin-bottom: 10px;
        font-size: 1.5em;
    }

    .user-details p {
        margin-bottom: 10px;
        font-size: 1.2em;
    }

    .edit-btn {
        margin-top: 20px;
        padding: 10px 20px;
        font-size: 1.2em;
    }

    .modal-body form {
        margin-bottom: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .modal-body form .form-group {
        margin-bottom: 10px;
        flex: 1 1 48%;
    }

    .modal-body form .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .modal-body form .form-group input, 
    .modal-body form .form-group select {
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #ced4da;
        border-radius: 5px;
    }

    .modal-body form .form-group input:focus, 
    .modal-body form .form-group select:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
    }

    .modal-footer .btn {
        padding: 10px 20px;
        border-radius: 5px;
    }

    .user-details i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }

    .card {
        margin-top: 10px;
        padding: 10px;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
       
    }
   

    .card:hover {
        transform: scale(1.02);
    }

    .card-header {
        
        color: #fff;
        padding: 15px;
        border-radius: 15px 15px 0 0;
        text-align: center;
    }

    .card-footer {
        
        padding: 10px;
        border-radius: 0 0 15px 15px;
        text-align: center;
    }
</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<div><br></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Thông tin tài khoản</h2>
                </div>
                <div class="card-body">
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="d-flex align-items-start">';
                            echo '<div class="user-image-container">';
                           
                                echo "<img src='admin/admin/assets/uploads/images/" . $row['hinhAnh'] . "' alt='' class='user-image'>";
                            
                            echo "<br>";
                            echo '<h5>' . $row["hoTenPH"] . '</h5>';
                            echo '</div>';
                            echo '<div class="user-details">';
                            echo '<p><i class="fas fa-venus-mars"></i> ' . ($row["gioiTinh"] == 0 ? "Nam" : "Nữ") . '</p>';
                            echo '<p><i class="fas fa-phone"></i>Số Điện Thoại: ' . $row["soDienThoai"] . '</p>';
                            echo '<p><i class="fas fa-map-marker-alt"></i>Địa chỉ: ' . $row["diaChi"] . '</p>';
                            echo '<p><i class="fas fa-envelope"></i>Email: ' . $row["email"] . '</p>';
                            echo '<p><i class="fas fa-birthday-cake"></i>Ngày Sinh: ' . date('d/m/Y', strtotime($row["ngaySinh"])) . '</p>';
                            echo '<p><i class="fas fa-user"></i>Tên Tài Khoản: ' . $row["username"] . '</p>';
                            echo '</div>';
                            echo '</div>';
                            $formRow = $row;
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                </div>
                <div class="card-footer text-center">
                    <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target="#editModal">Sửa thông tin</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Sửa thông tin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="username">Tên Tài Khoản:</label>
                        <input type='text' class='form-control' name='username' value="<?php echo isset($formRow["username"]) ? $formRow["username"] : ''; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="hoTen">Họ tên:</label>
                        <input type="text" class="form-control" id="hoTen" name="hoTen" id="tenkh" value="<?php echo isset($formRow["hoTenPH"]) ? $formRow["hoTenPH"] : ''; ?>">
                        <span class="error" id="tenkhError"></span>
                    </div>
                    <div class="form-group">
                        <label for="gioiTinh">Giới tính:</label>
                        <select class="form-control" id="gioiTinh" name="gioiTinh">
                            <option value="0" <?php echo isset($formRow["gioiTinh"]) && $formRow["gioiTinh"] == 0 ? 'selected' : ''; ?>>Nam</option>
                            <option value="1" <?php echo isset($formRow["gioiTinh"]) && $formRow["gioiTinh"] == 1 ? 'selected' : ''; ?>>Nữ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="soDienThoai">Số điện thoại:</label>
                        <input type="text" class="form-control" id="soDienThoai" name="soDienThoai" value="<?php echo isset($formRow["soDienThoai"]) ? $formRow["soDienThoai"] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="diaChi" >Địa chỉ:</label>
                        <input type="text" class="form-control" id="diaChi" name="diaChi" value="<?php echo isset($formRow["diaChi"]) ? $formRow["diaChi"] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="hinhAnh">Hình ảnh:</label>
                        <input type="file" class="form-control" id="hinhAnh" name="txtHinhAnh">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($formRow["email"]) ? $formRow["email"] : ''; ?>">
                        <span class="error" id="emailError"></span>
                    </div>
                    <div class="form-group">
                        <label for="ngaySinh">Ngày Sinh:</label>
                        <div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                            <input type="text" class="form-control" id="ngaySinh" name="ngaySinh" value="<?php echo isset($formRow["ngaySinh"]) ? date('d/m/Y', strtotime($formRow["ngaySinh"])) : ''; ?>">
                            <span class="error" id="ngaysinhError"></span>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="send">Lưu thay đổi</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>

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
</body>

<?php
if (isset($_POST["send"])) {
    $username = $_POST['username'];
    $hoTen = $_POST['hoTen'];
    $gioiTinh = $_POST['gioiTinh'];
    $soDienThoai = $_POST['soDienThoai'];
    $email = $_POST['email'];
    $diaChi = $_POST['diaChi'];
    $ngaySinh = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['ngaySinh'])));
    $hinhAnh = NULL;

    // Check if a new file was uploaded
    if (isset($_FILES['txtHinhAnh']) && $_FILES['txtHinhAnh']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "admin/admin/assets/uploads/images/";
        $target_file = $target_dir . basename($_FILES["txtHinhAnh"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Validate image
        $check = getimagesize($_FILES["txtHinhAnh"]["tmp_name"]);
        if ($check === false) {
            echo "<script>alert('File không phải là hình ảnh.');</script>";
        }
        // Check file size
        else if ($_FILES["txtHinhAnh"]["size"] > 5000000) {
            echo "<script>alert('Xin lỗi, hình ảnh quá lớn.');</script>";
        }
        // Try to upload
        else if (move_uploaded_file($_FILES["txtHinhAnh"]["tmp_name"], $target_file)) {
            $hinhAnh = basename($_FILES["txtHinhAnh"]["name"]);
        } else {
            echo "<script>alert('Lỗi khi tải file.');</script>";
        }
    }

    $success = $info->update_info2($username, $hoTen, $gioiTinh, $soDienThoai, $email, $ngaySinh, $diaChi, $hinhAnh);

    if ($success) {
        echo "<script>alert('Cập nhật thành công');</script>";
        echo "<script>window.location.href='?info'</script>";
    } else {
        echo "<script>alert('Cập nhật không thành công');</script>";
    }
}

?>