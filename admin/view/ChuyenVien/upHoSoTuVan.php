<?php
include_once("controller/HoSoTuVan/cHSTV.php");

$p = new cHSTV();
$id_hoso = isset($_GET['id_hoso']) ? $_GET['id_hoso'] : null;

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loiDan = $_POST['loiDan'];
    $chuanDoan = $_POST['chuanDoan'];
    $idHoSo = $_POST['idHoSo'];

    $result = $p->update_hoso($id_hoso, $loiDan, $chuanDoan);
    if ($result) {
        echo "<script>alert('Cập nhật hồ sơ thành công!');</script>";
        echo "<script>window.location.href='?lichtuvan'</script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra!');</script>";
    }
}

// Get existing hoso data
$hoso = $p->select_hosotuvan($idHoSo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật hồ sơ tư vấn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container border p-4 mt-3">
        <h2 class="text-center mb-4">Cập nhật hồ sơ tư vấn</h2>
        
        <form action="" method="post">
            <input type="hidden" name="id_hoso" value="<?php echo htmlspecialchars($id_hoso); ?>">
            
            <div class="form-group mb-3">
                <label for="loiDan">Lời dặn:</label>
                <textarea class="form-control" name="loiDan" rows="4" required><?php echo htmlspecialchars($hoso['loiDan']); ?></textarea>
            </div>
            
            <div class="form-group mb-3">
                <label for="chuanDoan">Chuẩn đoán:</label>
                <textarea class="form-control" name="chuanDoan" rows="4" required><?php echo htmlspecialchars($hoso['chuanDoan']); ?></textarea>
            </div>
            
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="?lichtuvan" class="btn btn-secondary">Quay lại</a>
            </div>
        </form>
    </div>
</body>
</html>