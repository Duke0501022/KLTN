<?php
include_once("Controller/cPhanHoi.php");
// Lấy danh sách các đơn vị trắc nghiệm
$phanhoi = new cPhanHoi();
$testUnits = $phanhoi->getTestCV();
// Hiển thị danh sách các đơn vị trắc nghiệm
?>
<div class="container my-3">
    <h1 style="text-align: center;">Danh sách phản hồi chuyên viên</h1>
    <?php
    // Lặp qua mỗi đơn vị trắc nghiệm
    foreach ($testUnits as $unit) {
        // Lấy thông tin về đơn vị trắc nghiệm
        // $idUnit = $unit['idUnit']; // Giả sử id của đơn vị được lưu trong cột id trong cơ sở dữ liệu
        // $unitName = $unit['tenUnit']; // Giả sử tên đơn vị được lưu trong cột unit_name trong cơ sở dữ liệu
        // $moTaUnit = $unit['moTaUnit']; // Giả sử mô tả đơn vị được lưu trong cột unit_description trong cơ sở dữ liệu
        $idChuyenVien = $unit['idChuyenVien']; // Giả sử id của đơn vị được lưu trong cột id trong cơ sở dữ liệu
        $hinhAnh = $unit['hinhAnh']; // Giả sử tên đơn vị được lưu trong cột unit_name trong cơ sở dữ liệu
        $ChuyenVienName = $unit['hoTen']; // Giả sử tên đơn vị được lưu trong cột unit_name trong cơ sở dữ liệu
        $moTaChuyenVien = $unit['moTa']; // Giả sử mô tả đơn vị được lưu trong cột unit_description trong cơ sở dữ liệu

    ?>
        <div class="screening-card">
            <div class="screening-card-header" style="color:Black;">Phản hồi chuyên viên <?= $ChuyenVienName ?></div>
            <div class="screening-card-body">
                <img class="card-img-top mb-2" src='admin/admin/assets/uploads/images/<?php echo $unit['hinhAnh']; ?>' alt="" style="width: 100px; height: 100px; border-radius: 50px;">
                <!-- Thay đổi nội dung phần mô tả tùy thuộc vào cấu trúc dữ liệu của bạn -->
                <p><?= $moTaChuyenVien ?></p>
                <!-- Tạo liên kết đến trang làm bài với idUnit tương ứng -->
                <a href="index.php?phanhoigiaovien=<?= $idChuyenVien ?>&idChuyenVien=<?= $idChuyenVien ?>" class="btn btn-primary btn-screening">Chọn</a>
            </div>
        </div>
    <?php
    }
    ?>
</div>
