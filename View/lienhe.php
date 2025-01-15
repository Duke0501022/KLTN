
<!-- Header Start -->
<div class="container-fluid bg-primary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
        <h3 class="display-3 font-weight-bold text-white">Liên hệ</h3>
    </div>
</div>
<!-- Header End -->

<!-- Contact Start -->
<div class="container-fluid pt-5">
    <div class="container">
        <div class="text-center pb-2">
            <p class="section-title px-5"><span class="px-2">Liên lạc</span></p>
            <h1 class="mb-4">Liên lạc với chúng tôi</h1>
        </div>
        <div class="row">
            <div class="col-lg-7 mb-5">
                <div class="contact-form">
                    <div id="success"></div>
                    <form method="post" action="">
                        <div class="control-group">
                            <input type="text" class="form-control" name="hoTen" placeholder="Họ tên" required="required" />
                        </div>
                        <br>
                        <div class="control-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" required="required" />
                        </div>
                        <br>
                        <div class="control-group">
                            <input type="tel" class="form-control" name="soDienThoai" placeholder="Số điện thoại" required="required" />
                        </div>
                        <br>
                        <div class="control-group">
                            <input type="text" class="form-control" name="tieuDe" placeholder="Tiêu đề" required="required" />
                        </div>
                        <br>
                        <div class="control-group">
                            <textarea class="form-control" rows="6" name="noiDung" placeholder="Nội dung" required="required"></textarea>
                        </div>
                        <br>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" name="send">Gửi</button>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <div class="d-flex">
                    <i class="fa fa-map-marker-alt d-inline-flex align-items-center justify-content-center bg-primary text-secondary rounded-circle" style="width: 45px; height: 45px;"></i>
                    <div class="pl-3">
                        <h5>Địa chỉ</h5>
                        <p>12 Nguyễn Văn Bảo, Phường 4, Gò Vấp, Hồ Chí Minh</p>
                    </div>
                </div>
                <div class="d-flex">
                    <i class="fa fa-envelope d-inline-flex align-items-center justify-content-center bg-primary text-secondary rounded-circle" style="width: 45px; height: 45px;"></i>
                    <div class="pl-3">
                        <h5>Email</h5>
                        <p>Xuanhauk16@gmail.com</p>
                        <p>duc200251@gmail.com</p>
                    </div>
                </div>
                <div class="d-flex">
                    <i class="fa fa-phone-alt d-inline-flex align-items-center justify-content-center bg-primary text-secondary rounded-circle" style="width: 45px; height: 45px;"></i>
                    <div class="pl-3">
                        <h5>Số điện thoại</h5>
                        <p>+012 345 67890</p>
                    </div>
                </div>
                <div class="d-flex">
                    <i class="far fa-clock d-inline-flex align-items-center justify-content-center bg-primary text-secondary rounded-circle" style="width: 45px; height: 45px;"></i>
                    <div class="pl-3">
                        <h5>Giờ mở cửa</h5>
                        <strong>Thứ 2 - Thứ 6</strong>
                        <p class="m-0">08:00 AM - 05:00 PM </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
<?php

require_once("Model/mLienHe.php");
require_once("Controller/cLienHe.php");
$lienheModel = new LienHeModel();
$contactModel = new ContactModel();
$mLienHe = new LienHeModel();

if (isset($_POST['send'])) {
    $to = $_POST['email'];
    $tieuDe = $_POST['tieuDe'];
    $noiDung = $_POST['noiDung'];
    $hoTen = $_POST['hoTen'];
    $email = $_POST['email'];
    $soDienThoai = $_POST['soDienThoai'];
    

    $thoiGian = date('Y-m-d H:i:s'); // Lấy thời gian hiện tại
    $addSuccess = $lienheModel->insert_lienhe($tieuDe, $noiDung, $thoiGian, $hoTen, $soDienThoai, $email);
    if ($addSuccess) {
        $sendSuccess = $contactModel->sendEmail($to, $tieuDe, $noiDung, $hoTen, $soDienThoai, $email);
        if ($sendSuccess) {
            echo "<script>alert('Xin cảm ơn! Chúng tôi sẽ phản hồi cho bạn sớm nhất có thể')</script>";
        } else {
            echo "<script>alert('Xin lỗi! Yêu cầu của bạn hiện không thể gửi phản hồi. Vui lòng thử lại sau.')</script>";
        }
    } 
}
?>
<script>


function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}


function validatePhoneNumber(phone) {
    const re = /^\d{10}$/; // Định dạng số điện thoại 10 chữ số
    return re.test(phone);
}


function showError(input, message) {
    const formGroup = input.closest('.control-group');
    let errorElement = formGroup.querySelector('.error-message');
    if (!errorElement) {
        errorElement = document.createElement('div');
        errorElement.className = 'error-message text-danger';
        formGroup.appendChild(errorElement);
    }
    errorElement.textContent = message;
    input.classList.add('is-invalid');
}


function clearError(input) {
    const formGroup = input.closest('.control-group');
    const errorElement = formGroup.querySelector('.error-message');
    if (errorElement) {
        errorElement.textContent = '';
    }
    input.classList.remove('is-invalid');
}

document.querySelector('form').addEventListener('submit', function(event) {
    const hoTen = document.querySelector('input[name="hoTen"]').value.trim();
    const email = document.querySelector('input[name="email"]').value.trim();
    const soDienThoai = document.querySelector('input[name="soDienThoai"]').value.trim();

    let valid = true;

    // Kiểm tra họ tên
    if (hoTen === '') {
        showError(document.querySelector('input[name="hoTen"]'), 'Vui lòng nhập họ tên.');
        valid = false;
    } else if (!/^[A-Za-zÀ-ỹ\s]{1,100}$/.test(hoTen)) {
        showError(document.querySelector('input[name="hoTen"]'), 'Họ tên không hợp lệ.');
        valid = false;
    } else {
        clearError(document.querySelector('input[name="hoTen"]'));
    }

    // Kiểm tra email
    if (!validateEmail(email)) {
        showError(document.querySelector('input[name="email"]'), 'Vui lòng nhập email hợp lệ.');
        valid = false;
    } else {
        clearError(document.querySelector('input[name="email"]'));
    }

    // Kiểm tra số điện thoại
    if (!validatePhoneNumber(soDienThoai)) {
        showError(document.querySelector('input[name="soDienThoai"]'), 'Vui lòng nhập số điện thoại hợp lệ phải đủ 10 số.');
        valid = false;
    } else {
        clearError(document.querySelector('input[name="soDienThoai"]'));
    }

    if (!valid) {
        event.preventDefault();
    }
      // Kiểm tra tiêu đề
      if (tieuDe === '') {
        showError(document.querySelector('input[name="tieuDe"]'), 'Vui lòng nhập tiêu đề.');
        valid = false;
    } else if (tieuDe.length > 100) {
        showError(document.querySelector('input[name="tieuDe"]'), 'Tiêu đề không được vượt quá 100 ký tự.');
        valid = false;
    } else {
        clearError(document.querySelector('input[name="tieuDe"]'));
    }

    // Kiểm tra nội dung
    if (noiDung === '') {
        showError(document.querySelector('textarea[name="noiDung"]'), 'Vui lòng nhập nội dung.');
        valid = false;
    } else if (noiDung.length > 1000) {
        showError(document.querySelector('textarea[name="noiDung"]'), 'Nội dung không được vượt quá 1000 ký tự.');
        valid = false;
    } else {
        clearError(document.querySelector('textarea[name="noiDung"]'));
    }
});

// Thêm trình lắng nghe sự kiện blur cho họ tên
document.querySelector('input[name="hoTen"]').addEventListener('blur', function() {
    const hoTen = this.value.trim();
    if (hoTen === '') {
        showError(this, 'Vui lòng nhập họ tên.');
    } else if (!/^[A-Za-zÀ-ỹ\s]{1,100}$/.test(hoTen)) {
        showError(this, 'Họ tên không hợp lệ.');
    } else {
        clearError(this);
    }
});

// Thêm trình lắng nghe sự kiện blur cho email
document.querySelector('input[name="email"]').addEventListener('blur', function() {
    const email = this.value.trim();
    if (!validateEmail(email)) {
        showError(this, 'Vui lòng nhập email hợp lệ.');
    } else {
        clearError(this);
    }
});
// Thêm trình lắng nghe sự kiện blur cho tiêu đề
document.querySelector('input[name="tieuDe"]').addEventListener('blur', function() {
    const tieuDe = this.value.trim();
    if (tieuDe === '') {
        showError(this, 'Vui lòng nhập tiêu đề.');
    } else if (tieuDe.length > 100) {
        showError(this, 'Tiêu đề không được vượt quá 100 ký tự.');
    } else {
        clearError(this);
    }
});

// Thêm trình lắng nghe sự kiện blur cho nội dung
document.querySelector('textarea[name="noiDung"]').addEventListener('blur', function() {
    const noiDung = this.value.trim();
    if (noiDung === '') {
        showError(this, 'Vui lòng nhập nội dung.');
    } else if (noiDung.length > 1000) {
        showError(this, 'Nội dung không được vượt quá 1000 ký tự.');
    } else {
        clearError(this);
    }
});
// Thêm trình lắng nghe sự kiện blur cho số điện thoại
document.querySelector('input[name="soDienThoai"]').addEventListener('blur', function() {
    const soDienThoai = this.value.trim();
    if (!validatePhoneNumber(soDienThoai)) {
        showError(this, 'Vui lòng nhập số điện thoại hợp lệ phải đủ 10 số.');
    } else {
        clearError(this);
    }
});
</script>