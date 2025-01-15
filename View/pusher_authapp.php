<?php
// pusher_auth.php
require '../vendor/autoload.php';
use Pusher\Pusher;

session_start();

$options = array(
    'cluster' => 'ap1',
    'useTLS' => true
);
$pusher = new Pusher(
    '03dc77ca859c49e35e41',
                        '5f7dc7d158c95e25a5e2',
                        '1873489',
    $options
);

if (isset($_SESSION['idChuyenVien'])) {
    $user_id = 'chuyenVien_' . $_SESSION['idChuyenVien'];
    $user_info = array('name' => 'Chuyên viên'); // Thông tin thêm nếu cần
    echo $pusher->authorizePresenceChannel($_POST['my-channel'], $_POST['socket_id'], $user_id, $user_info);
} else {
    header('', true, 403);
    echo "Forbidden";
}