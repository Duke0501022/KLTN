<?php

// include_once("Model/mLienHe.php");

// class LienHeController
// {
//     private $model;

//     public function __construct()
//     {
//         $this->model = new LienHeModel();
//     }

//     public function get_lienhe()
//     {
//         $lienhe = $this->model->select_lienhe();
//         return $lienhe;
//     }

//     public function add_lienhe($tieuDe, $noiDung, $thoiGian, $hoTen, $soDienThoai, $email)
//     {
//         $p = new LienHeModel();
//         $result = $p->insert_lienhe($tieuDe, $noiDung, $thoiGian, $hoTen, $soDienThoai, $email);
//         if ($result) {
//             return $result;
//         } else {
//             return false;
//         }
//     }
// }

?>
<?php

include_once("Model/mLienHe.php");

class LienHeController
{
    private $model;

    public function __construct()
    {
        $this->model = new LienHeModel();
    }

    public function get_lienhe()
    {
        $lienhe = $this->model->select_lienhe();
        return $lienhe;
    }

    public function add_lienhe($tieuDe, $noiDung, $thoiGian, $hoTen, $soDienThoai, $email)
    {
        $result = $this->model->insert_lienhe($tieuDe, $noiDung, $thoiGian, $hoTen, $soDienThoai, $email);
        return $result;
    }
}

?>
<?php
// include_once("Controller/cLienHe.php");
include_once("Model/mLienHe.php");

class ContactController
{
    private $model;

    public function __construct()
    {
        $this->model = new ContactModel();
    }

    public function index()
    {
        // Hiển thị form liên hệ
        include_once("View/lienhe.php");
    }

    public function sendEmail()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $hoTen = $_POST['hoTen'];
            $email = $_POST['email'];
            $soDienThoai = $_POST['soDienThoai'];
            $tieuDe = $_POST['tieuDe'];
            $noiDung = $_POST['noiDung'];

            // Địa chỉ email nhận
            $to = 'xuanhauk16@gmail.com'; // Thay đổi thành địa chỉ email của bạn
            $success = $this->model->sendEmail($to, $tieuDe, $noiDung, $hoTen, $soDienThoai, $email);
            if ($success) {
                echo "Email sent successfully!";
            } else {
                echo "Failed to send email.";
            }
        }
    }
}
// Routing
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$controller = new ContactController();
$controller->$action();
?>