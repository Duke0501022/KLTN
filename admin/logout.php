<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once('model/TaiKhoan/mtaikhoan.php');
require_once __DIR__ . '../../vendor/autoload.php';

use Pusher\Pusher;

$options = [
    'cluster' => 'ap1',
    'useTLS' => true
];
$pusher = new Pusher(
    '03dc77ca859c49e35e41',
    '5f7dc7d158c95e25a5e2',
    '1873489',
    $options
);

if (isset($_SESSION['idChuyenVien'])) {
    $p = new mtaikhoan();
    $updateStatus = $p->updateStatus($_SESSION['idChuyenVien'], 'offline');
    
    if ($updateStatus) {
        // Phát sự kiện Pusher
        $data = [
            'user_id' => $_SESSION['idChuyenVien'],
            'status' => 'offline',
            'last_activity' => date('Y-m-d H:i:s')
        ];
        $pusher->trigger('status-channel', 'status-updated', $data);
    } else {
        error_log("Failed to update status in database");
    }
} else {
    error_log("Session idChuyenVien is not set");
}

session_destroy();

// Kiểm tra xem header location có hoạt động không
if (!headers_sent()) {
    header("Location:../admin/");
    exit();
} else {
    echo "Error: Headers already sent.";
}
?>