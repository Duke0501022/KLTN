<?php
// ketquathanhtoan.php

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("../Model/HocPhi/mHocPhi1.php");

error_log("GET Parameters: " . print_r($_GET, true));

$vnp_TxnRef = $_GET['vnp_TxnRef'] ?? '';
$vnp_Amount = isset($_GET['vnp_Amount']) ? $_GET['vnp_Amount'] / 100 : 0;
$vnp_ResponseCode = $_GET['vnp_ResponseCode'] ?? '';
$vnp_TransactionNo = $_GET['vnp_TransactionNo'] ?? '';
$vnp_BankCode = $_GET['vnp_BankCode'] ?? '';
$vnp_PayDate = $_GET['vnp_PayDate'] ?? '';

// Retrieve idHocPhi directly from $_GET
$idHocPhi = $_GET['idHocPhi'] ?? null;
$soTien = $vnp_Amount; // Use the amount from VNPay response

// Ghi log để kiểm tra giá trị của các tham số GET
error_log("vnp_TxnRef: " . $vnp_TxnRef);
error_log("vnp_Amount: " . $vnp_Amount);
error_log("vnp_ResponseCode: " . $vnp_ResponseCode);
error_log("vnp_TransactionNo: " . $vnp_TransactionNo);
error_log("vnp_BankCode: " . $vnp_BankCode);
error_log("vnp_PayDate: " . $vnp_PayDate);
error_log("idHocPhi: " . $idHocPhi);
error_log("soTien: " . $soTien);

if ($vnp_ResponseCode == '00') {
    if ($idHocPhi && $soTien) {
        $trangThai = 'Paid';
        
        error_log("Processing payment - ID: $idHocPhi, Amount: $soTien");
        
        $mHP1 = new mHP1();
        $result = $mHP1->xuLyKetQuaThanhToan($idHocPhi, $soTien, $trangThai);

        if ($result) {
            header('Location: thongbaothanhtoan.php');
            exit();
        } else {
            echo "Failed to process payment.";
            error_log("Failed to process payment - ID: $idHocPhi, Amount: $soTien");
        }
    } else {
        echo "Missing idHocPhi or soTien.";
        error_log("Missing idHocPhi or soTien");
    }
} else {
    echo "Payment failed with response code: " . $vnp_ResponseCode;
    error_log("Payment failed with response code: " . $vnp_ResponseCode);
}
?>