
<div class="container-fluid bg-primary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
        <h3 class="display-3 font-weight-bold text-white">Tư vấn trực tiếp với chuyên gia</h3>
    </div>
</div>
<style>
    .container-feedback {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        margin-top: 20px;
    }

    .teacher-photo {
        width: 100px;
        height: 100px;
        background-color: #ddd;
        border-radius: 50%;
        margin-bottom: 20px;
    }

    .teacher-info {
        text-align: center;
        margin-bottom: 20px;
    }

    .teacher-info h3 {
        margin-bottom: 10px;
    }

    .teacher-info p {
        margin: 0;
    }

    .question-form {
        text-align: left;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .ask-button {
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        text-transform: uppercase;
        font-weight: bold;
    }

    .ask-button:hover {
        background-color: #0056b3;
    }
</style>
<?php
$idChuyenVien = $_GET['idChuyenVien'];
?>

<div class="container-feedback">
    <div class="feedback-section">
        <h4>Phản hồi chuyên viên</h4>
        <?php
        include_once("Model/mTuVanChuyenGia.php");
        $mTuVan = new mTuVanChuyenGia();
        $listcv = $mTuVan->select_ChuyenGia($idChuyenVien);
        foreach ($listcv as $cv) {
        ?>
            <div class="teacher-section">
                <img src="<?php echo $cv['hinhAnh']; ?>" alt="Ảnh Giáo Viên" class="teacher-photo">
                <div class="teacher-info">
                    <h3><?php echo $cv['hoTen']; ?></h3>
                    <p><?php echo $cv['moTa']; ?></p>
                </div>
            </div>
        <?php
        }
        ?>
        <form method="post" class="question-form mt-3" id="teacher1Form">
            <div class="form-group">
                <label for="loginHoTen">Họ và tên</label>
                <input type="hoTen" class="form-control" name="hoTen" id="loginHoTen" placeholder="Họ và tên">
            </div>
            <div class="form-group">
                <label for="loginSDT">Số điện thoại</label>
                <input type="sdt" class="form-control" name="sdt" id="loginSDT" placeholder="Số điện thoại">
            </div>
            <div class="form-group">
                <label for="loginEmail">Email</label>
                <input type="email" class="form-control" name="email" id="loginEmail" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="question1">Câu hỏi của bạn</label>
                <textarea class="form-control" id="question1" rows="3" required></textarea>
            </div>
            <button type="button" class="btn btn-success ask-button" onclick="sendQuestion('teacher1')">Gửi câu hỏi</button>
        </form>
    </div>
</div>

<?php
// }
?>
<?php
// include_once("Model/mTuVanChuyenGia.php");


// $mTuVanChuyenGia = new mTuVanChuyenGia();
// $TuVanModel = new TuVanTTModel();

// if (isset($_POST['send'])) {
//     $to = $_POST['email'];
//     $hoTen = $_POST['hoTen'];
//     $soDienThoai = $_POST['soDienThoai'];
//     $email = $_POST['email'];
//     $noiDung = $_POST['noiDung'];

//     $success = $TuVanModel->sendEmailCG($to, $hoTen, $soDienThoai, $noiDung, $email);
//     if ($success) {
//         echo "<script>alert('Tư vấn chuyên viên thành công!');</script>";
//     } else {
//         echo "<script>alert('Lỗi tư vấn! Vui lòng thử lại.');</script>";
//     }
// }
?>

