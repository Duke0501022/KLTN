<?php
include_once("Model/Connect.php");
// Kết nối CSDL và kiểm tra thông tin học phí
class mHP{
function kiemTraHocPhi($idHocPhi) {
    $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $string = "SELECT * FROM hocphi where idHocPhi = '$idHocPhi'";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        } else {
            return false;
        }
}
        function selectallHocPhi($idPhuHuynh){
            $p = new clsketnoi();
            if ($p->ketnoiDB($conn)) {
                $string = "SELECT hocphi.*, lophoc.idLopHoc, lophoc.tenLop, hosotreem.*
                        FROM hocphi
                        INNER JOIN chitietlophoc ON hocphi.idHoSo = chitietlophoc.idHoSo
                        INNER JOIN hosotreem ON hocphi.idHoSo = hosotreem.idHoSo
                        INNER JOIN phuhuynh ON phuhuynh.idPhuHuynh = hosotreem.idPhuHuynh
                        INNER JOIN lophoc ON chitietlophoc.idLopHoc = lophoc.idLopHoc
                        WHERE phuhuynh.idPhuHuynh = '$idPhuHuynh'
                        ORDER BY hocphi.idHocPhi ASC";
                $table = mysqli_query($conn, $string);
                if (!$table) {
                    // Handle query error
                    $p->dongketnoi($conn);
                    return false;
                }
                $p->dongketnoi($conn);
                return $table;
            } else {
                return false;
            }
        }
// Tạo thanh toán VNPay
function taoThanhToanVNPay($idHocPhi, $soTien) {
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = "http://localhost/View/xulyhocphi.php";
    $vnp_TmnCode = "33OXYTC8"; // Mã website đăng ký
    $vnp_HashSecret = "GAXX0B0QGDQG5QAMGCAAABBJPWHI0JHE"; // Khóa bí mật

    $vnp_TxnRef = $idHocPhi; // Mã đơn hàng
    $vnp_OrderInfo = "Thanh toán học phí";
    $vnp_Amount = $soTien * 100; // Số tiền nhân 100 
    $vnp_Locale = "vn"; // Ngôn ngữ
    $vnp_BankCode = ""; // Mã ngân hàng (để trống để cho phép chọn)
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef
    );

    ksort($inputData);
    $query = "";
    $i = 0;
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $query .= "&";
        }
        $query .= $key . "=" . $value;
        $i = 1;
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    $vnpSecureHash = hash_hmac('sha512', $query, $vnp_HashSecret);
    $vnp_Url .= '&vnp_SecureHash=' . $vnpSecureHash;

    header("Location: " . $vnp_Url);
    exit();
}


}


?>