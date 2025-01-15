<?php
include_once("Model/Connect.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class mPhanHoi
{
    function getTestCV()
    {
      
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $string = "SELECT * FROM chuyenvien";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);

            return $table;
        } else {
            return false;
        }
    }

    public function select_ChuyenVien($idChuyenVien)
    {
 
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $string = "SELECT * FROM chuyenvien WHERE  idChuyenVien = '$idChuyenVien'";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);

            return $table;
        } else {
            return false;
        }
    }
    public function insert_PhanHoi($idChuyenVien, $idPhuHuynh, $hoTen, $dienThoai, $email, $chatLuong, $noiDung, $username)
	{
		$p = new clsketnoi();
		$conn = $p->ketnoiDB($conn);
		$idPH = "SELECT idPhuHuynh FROM phuhuynh WHERE username = '$username'";
        $result1 = mysqli_query($conn, $idPH);
            if ($result1 && mysqli_num_rows($result1) > 0) {
                $row1 = mysqli_fetch_assoc($result1);
                $idPhuHuynh = $row1['idPhuHuynh'];
				$string = "INSERT INTO phanhoi(idChuyenVien, idPhuHuynh, hoTen, soDienThoai, email, chatLuong, noiDungPhanHoi) VALUES ($idChuyenVien, $idPhuHuynh, '$hoTen', '$dienThoai', '$email','$chatLuong', '$noiDung')";

				$kq = mysqli_query($conn, $string);
			}
		if (!$kq) {
			throw new mysqli_sql_exception(mysqli_error($conn));
		}
		$p->dongketnoi($conn);
		return $kq;
	}
}

?>

<?php 
class PhanHoiModel
{
    public function sendEmailPH($to, $hoTen, $soDienThoai, $chatLuong, $noiDungPhanHoi, $email)
    {
        // Khởi tạo đối tượng PHPMailer
        $mail = new PHPMailer(true);

        // Cấu hình SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Thay đổi thành máy chủ SMTP của bạn
        $mail->SMTPAuth = true;
        $mail->Username = 'xuanhauk16@gmail.com';        
        $mail->Password = 'tppk rcma jdtz xafd';                      
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;


        // Thiết lập thông tin người gửi
        $mail->setFrom($email, $hoTen, $soDienThoai);

        // Thiết lập thông tin người nhận
        $mail->addAddress($to);

        // Thiết lập tiêu đề và nội dung email
        $mail->isHTML(true);
        $mail->Subject = 'Phản hồi từ phụ huynh';
        $mail->Body = 'Chất lượng: ' . $chatLuong . '<br>';
        $mail->Body .= 'Nội dung phản hồi: ' . $noiDungPhanHoi;

        // Gửi email
        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    }
}

?>