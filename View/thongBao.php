<?php

include_once("Model/mThongBao.php");

if (isset($_SESSION['username'])) {
    $thongBaoModel = new thongBaoModel();
    $notifications = $thongBaoModel->select_all_thongbao($_SESSION['username']);
    
    if ($notifications) {
        echo '<div class="container">';
        echo '<h2>Tất cả thông báo</h2>';
        echo '<ul class="list-group">';
        while ($row = mysqli_fetch_assoc($notifications)) {
            echo '<li class="list-group-item">';
            echo '<div>' . $row['noiDung'] . '</div>';
            echo '<small class="notification-time">' . $row['thoiGian'] . '</small>';
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
    } else {
        echo '<div class="container"><p>Không có thông báo nào.</p></div>';
    }
} else {
    echo '<div class="container"><p>Vui lòng đăng nhập để xem thông báo.</p></div>';
}
?>