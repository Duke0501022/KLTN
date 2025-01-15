<?php
session_start();
include_once(__DIR__ . "/../../vendor/autoload.php");
require_once(__DIR__ . "/../../Controller/PDFDK/cPDFDK.php");

use Dompdf\Dompdf;

// Kiểm tra session `idPhuHuynh`
if (!isset($_SESSION['idPhuHuynh'])) {
    echo "Session idPhuHuynh không được thiết lập.";
    exit();
}

$idPhuHuynh = $_SESSION['idPhuHuynh'];
$id_datlich = $_GET['id_datlich'] ?? null;

if ($id_datlich) {
    $p = new cLSTV1();
    $appointment = $p->getAppointmentById($id_datlich, $idPhuHuynh);
    if ($appointment) {
        $dompdf = new Dompdf(array('enable_remote' => true));
        
        $fullName = htmlspecialchars($appointment['hoTenPH']);
        $genderPatient = $appointment['gioiTinh'] == 0 ? "Nam" : "Nữ";
        $patientBirthday = date("d/m/Y", strtotime($appointment['ngaySinh']));
        $describe_problem = htmlspecialchars($appointment['describe_problem']);
        $address = htmlspecialchars($appointment['diaChi'] ?? 'Không có thông tin'); // Bảo vệ chống XSS

        $imagePath = $appointment['hinhAnh'] ? 
            'https://quanlychuyenbiet.pro.vn/admin/admin/assets/uploads/images/' . urlencode($appointment['hinhAnh']) :
            'https://quanlychuyenbiet.pro.vn/assets/uploads/images/user.png';

        $html = "
        <!DOCTYPE html>
        <html lang='vi'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Giấy Tư Vấn</title>
            <style>
                body {
                    font-family: DejaVu Sans, sans-serif;
                    position: relative;
                }
                .header, .footer {
                    width: 100%;
                    text-align: center;
                }
                .header {
                    position: fixed;
                    top: 0;
                }
                .footer {
                    position: fixed;
                    bottom: 0;
                    font-size: 10px;
                    color: red;
                }
                .content {
                    margin-top: 150px;
                }
            </style>
        </head>
        <body>
            <div class='header'>
                <div style='float:left;'>
                    <span style='color:blue'><b>Quản lý chuyên biệt CHILDCARE </b></span><br>
                    <span style='font-size: 12px;'>Địa chỉ: 12 Nguyễn Văn Bảo, Phường 4, Gò Vấp, TPHCM</span>
                </div>
                <div style='float:right; text-align:center'>
                    <span>Cộng hòa xã hội chủ nghĩa Việt Nam</span><br>
                    <span style='font-size: 12px; text-decoration: underline;'><b> Độc lập - Tự do - Hạnh phúc </b></span>
                </div>
                <div style='clear: both;'></div>
                <hr>
            </div>

            <div class='content'>
                <h2 style='text-align:center; color:blue;'>GIẤY TƯ VẤN</h2>
                <p style='font-size: 10px; text-align:center;'>(Tòa A Phòng A.04)</p>
                
                <div style='margin-top:70px; width: 160px; display: inline-block;'>
                    <img src='$imagePath' alt='Hình ảnh' style='width:140px;height: 100px'>
                </div>
                <div style='position: absolute; top: 160px; left: 200px;'>
                    <span>Họ và tên Phụ Huynh: $fullName</span><br>
                    <span>Giới tính: $genderPatient</span><br>
                    <span>Năm sinh: $patientBirthday</span><br>
                    <span>Chỗ ở: $address</span><br>
                    <span>Triệu chứng: $describe_problem</span><br>
                </div>

                <!-- Nội dung PDF của bạn ở đây -->

                <!-- Footer -->
                <div class='footer'>
                    * Vui lòng in phiếu trước khi đến khám bệnh
                </div>
            </div>
        </body>
        </html>
        ";

        // Load HTML vào Dompdf
        $dompdf->loadHtml($html, 'UTF-8');

        // Render HTML thành PDF
        $dompdf->render();

        // Lấy dữ liệu PDF
        $pdfContent = $dompdf->output();

        // Hiển thị dữ liệu PDF trong một trang HTML
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Preview PDF</title>
            <style>
                body, html {
                    margin: 0;
                    padding: 0;
                    height: 100%;
                    overflow: hidden;
                    margin-left: auto;
                }
                iframe {
                    border: none;
                    width: 100%;
                    height: 100%;
                }
            </style>
        </head>
        <body>
            <iframe src="data:application/pdf;base64,<?= base64_encode($pdfContent); ?>"></iframe>
        </body>
        </html>
        <?php
    } else {
        echo "Không tìm thấy lịch tư vấn.";
    }
} else {
    echo "ID lịch tư vấn không hợp lệ.";
}
?>