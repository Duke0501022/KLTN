<div class="container-fluid bg-primary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
        <h3 class="display-3 font-weight-bold text-white">Trò chuyện với chuyên viên</h3>
    </div>
</div>
<?php
if (isset($_SESSION['idPhuHuynh'])) {
    $idPhuHuynh = $_SESSION['idPhuHuynh'];
} else {
    $idPhuHuynh = null;
}
?>

<?php
include_once("Controller/cTuVanChuyenGia.php");

$tuvan = new cTuVanChuyenGia();
$listcv1 = $tuvan->getTestCG();

?>
<style>
.status {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 500;
    margin-left: 8px;
}

.status.online {
    background-color: #dcf5dc;
    color: #0d6b0d;
    border: 1px solid #28a745;
}

.status.online::before {
    content: "•";
    color: #28a745;
    margin-right: 4px;
    font-size: 16px;
}

.status.offline {
    background-color: #ffe0e0;
    color: #9b0000;
    border: 1px solid #dc3545;
}

.status.offline::before {
    content: "•"; 
    color: #dc3545;
    margin-right: 4px;
    font-size: 16px;
}
</style>
<div class="container my-3">
    <h1 style="text-align: center;">Danh sách tư vấn viên</h1>
    <?php

    if (!empty($listcv1)) {

        foreach ($listcv1 as $cv) {
            if (isset($cv['idChuyenVien'], $cv['hinhAnh'], $cv['hoTen'], $cv['moTa'], $cv['status'])) {
                $idChuyenVien = $cv['idChuyenVien'];
                $hinhAnh = $cv['hinhAnh'];
                $ChuyenVienName = htmlspecialchars($cv['hoTen'], ENT_QUOTES, 'UTF-8');
                $moTaChuyenVien = htmlspecialchars($cv['moTa'], ENT_QUOTES, 'UTF-8');
                $status = htmlspecialchars($cv['status'], ENT_QUOTES, 'UTF-8');
        ?>
                <div class="screening-card">
                    <div class="screening-card-header" style="color:Black;">
                        Tư vấn chuyên viên <?= $ChuyenVienName ?> 
                        <span class="status status-<?= $idChuyenVien ?> <?= strtolower($status) ?>"><?= ucfirst($status) ?></span>
                    </div>
                    <div class="screening-card-body">
                        <img class="card-img-top mb-2" src='admin/admin/assets/uploads/images/<?= $hinhAnh; ?>' alt="" style="width: 100px; height: 100px; border-radius: 50px;">
                        <p><?= $moTaChuyenVien ?></p>
                        <a href="index.php?tuvanchuyengia=<?= $idChuyenVien ?>&idChuyenVien=<?= $idChuyenVien ?>" class="btn btn-primary btn-screening">Chọn</a>
                    </div>
                </div>
        <?php
            } else {
                echo "<p>Không tìm thấy thông tin về chuyên viên.</p>";
            }
        }
    }
    ?>
</div>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
const pusher = new Pusher('03dc77ca859c49e35e41', {
    cluster: 'ap1'
});

const channel = pusher.subscribe('status-channel');
channel.bind('status-updated', function(data) {
    // Update status indicator
    const statusElement = document.querySelector(`.status-${data.user_id}`);
    if (statusElement) {
        statusElement.classList.remove('online', 'offline');
        statusElement.classList.add(data.status.toLowerCase());
        statusElement.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
    }
});
</script>