<?php
session_start();
require_once 'View/config.php';

$clientID = '';
$clientSecret = '';
$redirectUri = ''; // Cập nhật redirectUri

$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

if (isset($_SESSION['user_token'])) {
    header("Location: index.php");
    exit;
} else {
    // Tạo URL đăng nhập Google và chuyển hướng người dùng đến đó
    $authUrl = $client->createAuthUrl();
    header("Location: $authUrl");
    exit;
}
?>