
<?php
include_once("Model/Connect.php");

class LienHeModel {
    public function select_lienhe() {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $query = "SELECT * FROM lienhe";
            $result = mysqli_query($conn, $query);
            $p->dongketnoi($conn);
            return $result;
        } else {
            return false;
        }
    }

    public function insert_lienhe($tieuDe, $noiDung, $thoiGian ,$hoTen, $soDienThoai, $email) {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $thoiGian = date('Y-m-d H:i:s'); // Current time
            $query = "INSERT INTO lienhe (tieuDe, noiDung, thoiGian, hoTen, soDienThoai, email) 
                      VALUES ('$tieuDe', '$noiDung', '$thoiGian', '$hoTen', '$soDienThoai', '$email')";
            $result = mysqli_query($conn, $query);
            $p->dongketnoi($conn);
            return $result;
        } else {
            return false;
        }
    }
}
?>

<?php
include_once("Model/Connect.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
class ContactModel {
    public function sendEmail($to, $tieuDe, $noiDung, $hoTen, $soDienThoai, $email) {
        // Khởi tạo đối tượng PHPMailer
        $mail = new PHPMailer(true);
        // Cấu hình SMTP
        $mail->isSMTP();
        $mail->CharSet  = "utf-8"; 
        $mail->Host = 'smtp.gmail.com';  // Thay đổi thành máy chủ SMTP của bạn
        $mail->SMTPAuth = true;
        $mail->Username = 'xuanhauk16@gmail.com';        
        $mail->Password = 'tppk rcma jdtz xafd';                      
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        // Thiết lập thông tin người gửi
        $mail->setFrom('xuanhauk16@gmail.com', 'Hệ thống tư vấn và hỗ trợ trẻ tự kỉ');
        // Thiết lập thông tin người nhận
        $mail->addAddress($email,$hoTen);
        // Thiết lập tiêu đề và nội dung email
        $noidung = "
        <div style='background-color: #f9f9f9; border: 1px solid #ddd; padding: 20px; border-radius: 10px; position: relative;'>
            <div style='position: absolute; top: 0; left: 0; border-radius: 50%;'>
                <img src='./admin/admin/assets/uploads/images/440943120_2188963681457292_7383826080244805221_n.jpg' alt='Logo' style='width: 100px; height: auto;'>
            </div>
            <h3 style='text-align: center; margin-bottom: 10px;'>Cảm ơn bạn đã phản hồi , chúng tôi sẽ phản hồi cho bạn sớm nhất!</h3>
            <hr style='border-color: #ddd;'>
            <table style='width: 100%;'>
                <tr>
                    <td style='font-weight: bold; width: 30%;'>Họ và tên :</td>
                    <td style='font-weight: bold; color: blue;'>".$hoTen."</td>
                </tr>
                <tr>
                    <td style='font-weight: bold;'>Nội dung của bạn:</td>
                    <td style='font-weight: bold; color: blue;'>".$noiDung."</td>
                </tr>
               
            </table>
        </div>";
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $tieuDe;
        $mail->Body    = $noidung; 
        // Gửi email
        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    }
}
?>

