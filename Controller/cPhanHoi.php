<?php 
include_once("Model/mPhanHoi.php");

class cPhanHoi {
    public function getTestCV() {
        $model = new mPhanHoi();
        return $model->getTestCV();
    }

    public function select_ChuyenVien($idChuyenVien) {
        $model = new mPhanHoi();
        return $model->select_ChuyenVien($idChuyenVien);
    }
    public function luu_PhanHoi($idChuyenVien, $idPhuHuynh, $hoTen, $dienThoai, $email, $chatLuong, $noiDung, $username)
	{
		$p = new mPhanHoi();
		$result = $p->insert_PhanHoi($idChuyenVien, $idPhuHuynh, $hoTen, $dienThoai, $email, $chatLuong, $noiDung, $username);
		return $result;
	}
}
?>
<?php
include_once("Model/mPhanHoi.php");

class PhanHoiController {
    private $model; // Biến lưu trữ model

    public function __construct() {
        $this->model = new PhanHoiModel();
    }

    public function index() {
        // Hiển thị form liên hệ
        include_once("View/phanhoigiaovien.php");
    }

    public function sendEmailPH() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $hoTen = $_POST['hoTen'];
            $soDienThoai = $_POST['soDienThoai'];
            $email = $_POST['email'];
            $chatLuong = $_POST['chatLuong'];
            $noiDungPhanHoi = $_POST['noiDungPhanHoi'];

            // Địa chỉ email nhận
            $to = 'xuanhauk16@gmail.com'; // Thay đổi thành địa chỉ email của bạn
            $subject = 'Phản hồi từ phụ huynh'; // Tiêu đề email

            $success = $this->model->sendEmailPH($to, $subject , $hoTen, $soDienThoai, $chatLuong, $noiDungPhanHoi, $email);
            if ($success) {
                echo "Phản hồi thành công!";
            } else {
                echo "Phản hồi thất bại! Vui lòng thử lại.";
            }
        }
    }
}

// Routing
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$controller = new PhanHoiController();
$controller->$action();
?>