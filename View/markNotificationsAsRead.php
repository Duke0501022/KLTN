<?php
session_start();

include_once("../Model/ThongBao/mThongBao.php");

if (isset($_SESSION['username'])) {
    $thongBaoModel = new thongBaoModel();
    $thongBaoModel->mark_as_read($_SESSION['username']);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>