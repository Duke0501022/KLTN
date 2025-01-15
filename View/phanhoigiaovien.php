<style>
  .teacher-section {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-top: 20px;
  }

  .teacher-photo {
    width: 150px;
    height: 150px;
    background-color: #ddd;
    border-radius: 50%;
    margin: auto;
    display: block;
  }

  .teacher-info {
    text-align: center;
    margin-top: 20px;
  }

  .feedback-section {
    background-color: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
    margin-top: 20px;
  }

  .feedback-form {
    margin-top: 20px;
  }

  .btn-send-feedback {
    background-color: #007bff;
    color: white;
    font-weight: bold;
    margin-top: 10px; /* Added margin for spacing */
  }

  .btn-send-feedback:hover {
    background-color: #0056b3;
  }

  /* Adjusted form input and select styles */
  .form-group {
    margin-bottom: 20px; /* Adjusted margin for spacing */
  }

  .form-control {
    width: 100%; /* Ensuring input fields take full width */
  }
</style>

<?php
include_once("Controller/cPhanHoi.php");

if (isset($_GET['idChuyenVien'])) {
  include_once("Model/mPhanHoi.php");

  $idChuyenVien = $_GET['idChuyenVien'];
  
  $phanhoi = new cPhanHoi();
  $PhanHoiModel = new PhanHoiModel();
  $listcv = $phanhoi->select_ChuyenVien($idChuyenVien);

  // if ($listcv) {
?>
    <div class="feedback-section">
      <h4>Phản hồi chuyên viên</h4>
      <?php
      foreach ($listcv as $cv) {
      ?>
        <div class="teacher-section">
        <img src="admin/admin/assets/uploads/images/<?php echo $cv['hinhAnh']; ?>" alt="Ảnh Giáo Viên" class="teacher-photo"> 
          <div class="teacher-info">
            <h3><?php echo $cv['hoTen']; ?></h3>
            <p><?php echo $cv['moTa']; ?></p>
          </div>
        </div>
      <?php
      }
      ?>
      <form method="post" class="feedback-form">
        <div class="form-group">
          <label for="loginHoTen">Họ và tên</label>
          <input type="text" class="form-control" name="hoTen" id="loginHoTen" placeholder="Họ và tên">
        </div>
        <div class="form-group">
          <label for="loginSDT">Số điện thoại</label>
          <input type="text" class="form-control" name="soDienThoai" id="loginSDT" placeholder="Số điện thoại">
        </div>
        <div class="form-group">
          <label for="loginEmail">Email</label>
          <input type="email" class="form-control" name="email" id="loginEmail" placeholder="Email">
        </div>
        <div class="form-group">
          <label for="qualityRating">Chất lượng (đánh giá từ 1 đến 5 sao):</label>
          <select class="form-control" name="chatLuong" id="qualityRating">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
          </select>
        </div>
        <div class="form-group">
          <label for="teacherComment">Nhận xét:</label>
          <textarea class="form-control" name="noiDungPhanHoi" id="teacherComment" rows="3"></textarea>
        </div>
        <button type="submit" name="send" class="btn btn-send-feedback">Gửi phản hồi</button>
      </form>
    </div>
<?php
  } 
?>

<?php

include_once("Model/mPhanHoi.php");
// include_once("Controller/cPhanHoi.php");

$mPhanHoi = new mPhanHoi();
$PhanHoiModel = new PhanHoiModel();

if (isset($_POST['send'])) {
    $to = $_POST['email'];
    $hoTen = $_POST['hoTen'];
    $soDienThoai = $_POST['soDienThoai'];
    $email = $_POST['email'];
    $chatLuong = $_POST['chatLuong'];
    $noiDungPhanHoi = $_POST['noiDungPhanHoi']; 

    $success = $PhanHoiModel->sendEmailPH($to, $hoTen, $soDienThoai, $chatLuong, $noiDungPhanHoi, $email);
    if ($success) {
        echo "<script>alert('Phản hồi chuyên viên thành công!');</script>";
    } else {
        echo "<script>alert('Lỗi phản hồi! Vui lòng thử lại.');</script>";
    }
}
?>
<?php
		$p = new cPhanHoi();
		$username = $_SESSION['username'];
		if(isset($_REQUEST['send']))
		{
			$idChuyenVien = $_GET['idChuyenVien'];
			$result = $p->luu_PhanHoi($idChuyenVien, $_SESSION['idPhuHuynh'], $hoTen, $soDienThoai, $email, $chatLuong, $noiDungPhanHoi, $username);
			if($result){
				echo "<script>alert('Lưu phản hồi thành công!')</script>";	
			}
			else
			{
				echo "<script>alert('Lưu phản hồi không thành công!')</script>";	
			}
		}
  ?>
