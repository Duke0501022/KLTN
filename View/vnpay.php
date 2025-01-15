<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$vnp_TmnCode = "SSN6P0KQ"; //Mã định danh merchant kết nối (Terminal Id)
$vnp_HashSecret = "C3MVKVJUEJ440HWP6TE296QIRFA94BNE"; //Secret key
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "/thanh-toan-thanh-cong.html";
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
$apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
//Config input format
//Expire
$startTime = date("YmdHis");
$expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));


///


$vnp_TxnRef = time(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này   sang VNPAY
$vnp_OrderInfo = "THANH TOAN VE XEM PHIM";
$vnp_OrderType = "THONG TIN 123";
$vnp_Amount = 1000;
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
    // "vnp_ExpireDate" => $vnp_ExpireDate,
    // "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
    // "vnp_Bill_Email" => $vnp_Bill_Email,
    // "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
    // "vnp_Bill_LastName" => $vnp_Bill_LastName,
    // "vnp_Bill_Address" => $vnp_Bill_Address,
    // "vnp_Bill_City" => $vnp_Bill_City,
    // "vnp_Bill_Country" => $vnp_Bill_Country,
    // "vnp_Inv_Phone" => $vnp_Inv_Phone,
    // "vnp_Inv_Email" => $vnp_Inv_Email,
    // "vnp_Inv_Customer" => $vnp_Inv_Customer,
    // "vnp_Inv_Address" => $vnp_Inv_Address,
    // "vnp_Inv_Company" => $vnp_Inv_Company,
    // "vnp_Inv_Taxcode" => $vnp_Inv_Taxcode,
    // "vnp_Inv_Type" => $vnp_Inv_Type
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
// } else {
//     echo json_encode($returnData);
// }
