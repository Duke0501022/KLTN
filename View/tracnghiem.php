<?php
include_once("Controller/cTracNghiem.php");
// Lấy danh sách các đơn vị trắc nghiệm
$tracnghiem = new cTracNghiem();
$testUnits = $tracnghiem->getTestUnits();

// Hiển thị danh sách các đơn vị trắc nghiệm
?>
<div class="container my-3">
    <h1 style="text-align: center;">Theo dõi phát triển</h1>
    <?php
    // Lặp qua mỗi đơn vị trắc nghiệm
    foreach ($testUnits as $unit) {
        // Lấy thông tin về đơn vị trắc nghiệm
        $idUnit = $unit['idUnit']; // Giả sử id của đơn vị được lưu trong cột id trong cơ sở dữ liệu
        $unitName = $unit['tenUnit']; // Giả sử tên đơn vị được lưu trong cột unit_name trong cơ sở dữ liệu
        $moTaUnit = $unit['moTaUnit']; // Giả sử mô tả đơn vị được lưu trong cột unit_description trong cơ sở dữ liệu
    ?>
        <div class="screening-card">
            <div class="screening-card-header" style="color:Black;">Trắc nghiệm <?= $unitName ?></div>
            <div class="screening-card-body">
                <!-- Thay đổi nội dung phần mô tả tùy thuộc vào cấu trúc dữ liệu của bạn -->
                <p><?= $moTaUnit ?></p>
                <!-- Tạo liên kết đến trang làm bài với idUnit tương ứng -->
                <a href="index.php?lambaitracnghiem=<?= $idUnit ?>&idUnit=<?= $idUnit ?>" class="btn btn-primary btn-screening">Làm bài</a>
            </div>
        </div>
    <?php
    }
    ?>
</div>
