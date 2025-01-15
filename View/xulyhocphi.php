<?php
include_once("../Controller/HocPhi/cHocPhi1.php");
date_default_timezone_set('Asia/Ho_Chi_Minh');

$idHocPhi = $_GET['idHocPhi'] ?? null;
$soTien = $_GET['soTien'] ?? null;

// Ghi log để kiểm tra giá trị của idHocPhi và soTien
error_log("idHocPhi: " . $idHocPhi);
error_log("soTien: " . $soTien);

// Kiểm tra xem idHocPhi và soTien có được lấy đúng hay không
if ($idHocPhi === null || $soTien === null) {
    echo "Không lấy được idHocPhi hoặc soTien. Vui lòng kiểm tra lại.";
    exit();
}

// Xử lý thanh toán với VNPay
$vnp_TmnCode = "SSN6P0KQ"; //Mã định danh merchant kết nối (Terminal Id)
$vnp_HashSecret = "C3MVKVJUEJ440HWP6TE296QIRFA94BNE"; 
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://localhost/KLTN_PJ/View/ketquathanhtoan.php?idHocPhi=" . $idHocPhi . "&soTien=" . $soTien;
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
$apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";

$startTime = date("YmdHis");
$expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

$vnp_TxnRef = time(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này   sang VNPAY
$vnp_OrderInfo = "THANH TOAN HOC PHI . $idHocPhi";
$vnp_OrderType = "THONG TIN 123";
$vnp_Amount = $soTien * 100;
$vnp_Locale = 'vn';
$vnp_BankCode = 'NCB';
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
    "vnp_OrderType" => $vnp_OrderType,
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef
   
);

if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}
if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
    $inputData['vnp_Bill_State'] = $vnp_Bill_State;
}

//var_dump($inputData);
ksort($inputData);
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

$vnp_Url = $vnp_Url . "?" . $query;
if (isset($vnp_HashSecret)) {
    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
}
$returnData = array(
    'code' => '00',
    'message' => 'success',
    'data' => $vnp_Url
);
// if (isset($_POST['redirect'])) {
header('Location: ' . $vnp_Url);
die();
?>