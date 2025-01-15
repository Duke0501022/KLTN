<?php
include_once("controller/HocPhi/cHocPhi.php");
$p = new cHocPhi();

// Get học phí record
if(isset($_GET['idHocPhi'])) {
    $idHocPhi = $_GET['idHocPhi'];
    $hocphi = mysqli_fetch_array($p->getHocPhiById($idHocPhi));
}

// Get dropdowns data
$lophoc = $p->getallhosotre();


// Handle form submission
if(isset($_POST['submit'])) {
    $idHoSo = $_POST['idHoSo'];
    $soTien = $_POST['soTien'];
    $hocKy = $_POST['hocKy'];
    $namHoc = $_POST['namHoc'];
  
    $idHoSo = $_POST['idHoSo'];
    $moTa = $_POST['moTa'];

    // Validation
  
        $update = $p->update_hocphi($idHocPhi, $idHoSo, $soTien, $hocKy, $namHoc,$moTa);
        if($update) {
            echo "<script>alert('Cập nhật thành công!'); window.location='?qlhocphi';</script>";
        }
    }

?>

<div class="content-wrapper" style="min-height: 1203.6px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cập Nhật Học Phí</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Cập nhật học phí</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin học phí</h3>
                        </div>
                        <form method="post" action="">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Lớp Học</label>
                                    <select class="form-control" name="idHoSo" required>
                                        <?php 
                                        while($row = mysqli_fetch_array($lophoc)) {
                                            $selected = ($row['idHoSo'] == $hocphi['idHoSo']) ? 'selected' : '';
                                            echo "<option value='".$row['idHoSo']."' ".$selected.">".$row['hoTenTE']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                               

                                <div class="form-group">
                                    <label>Số Tiền</label>
                                    <input type="text" class="form-control" name="soTien" value="<?php echo $hocphi['soTien']; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Học Kỳ</label>
                                    <select class="form-control" name="hocKy" required>
                                        <option value="1" <?php echo ($hocphi['hocky'] == 1) ? 'selected' : ''; ?>>1</option>
                                        <option value="2" <?php echo ($hocphi['hocky'] == 2) ? 'selected' : ''; ?>>2</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Năm Học</label>
                                    <input type="text" class="form-control" name="namHoc" value="<?php echo $hocphi['namHoc']; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Trạng Thái Thanh Toán</label>
                                    <select class="form-control" name="trangthai_tt_display" disabled>
                                        <option value="Đã thanh toán" <?php echo ($hocphi['check_tt'] == '1') ? 'selected' : ''; ?>>Đã thanh toán</option>
                                        <option value="Chưa thanh toán" <?php echo ($hocphi['check_tt'] == '0') ? 'selected' : ''; ?>>Chưa thanh toán</option>
                                    </select>
                                    <input type="hidden" name="trangthai_tt" value="<?php echo ($hocphi['check_tt'] == '1') ? 'Đã thanh toán' : 'Chưa thanh toán'; ?>">
                                </div>

                                <div class="form-group">
                                    <label>Mô Tả</label>
                                    <textarea class="form-control" name="moTa" rows="3"><?php echo $hocphi['moTa']; ?></textarea>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" name="submit" class="btn btn-primary">Cập Nhật</button>
                                <a href="?qlhp" class="btn btn-default">Quay Lại</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>