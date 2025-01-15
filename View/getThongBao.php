<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("../Model/mThongBao.php");

if (isset($_SESSION['username'])) {
    $thongBaoModel = new thongBaoModel();
    
    // Only fetch notifications, don't mark as read yet
    $notifications = $thongBaoModel->select_thongbao($_SESSION['username']);
    
    if ($notifications) {
        $result = array();
        while ($row = mysqli_fetch_assoc($notifications)) {
            $result[] = array(
                'noiDung' => $row['noiDung'],
                'thoiGian' => $row['thoiGian']
            );
        }
        echo json_encode($result);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}
?>