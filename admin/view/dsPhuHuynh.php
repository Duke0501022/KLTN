<?php
if (isset($_SESSION['idChuyenVien'])) {
    $idChuyenVien = $_SESSION['idChuyenVien'];
} else {
    echo "<script>alert('Bạn chưa đăng nhập!');</script>";
    echo "<script>window.location.href = 'index.php';</script>";
    exit;
}
?>
<?php
include_once("controller/cTuVanKH.php");

$tuvan = new cTuVanPhuHuynh();
$listcv1 = $tuvan->getTestPH();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thông tin tài khoản</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
   .container.user-info {
  padding: 40px 0;
}

.card {
  border: none;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.card-header {
  background-color: #f8f9fa;
  border-bottom: none;
  padding: 20px;
}

.card-header h2 {
  color: #333;
  font-weight: 600;
}

.card-body {
  padding: 30px;
}

.screening-card {
  border: 1px solid #e0e0e0;
  border-radius: 15px;
  padding: 20px;
  margin-bottom: 30px;
  transition: all 0.3s ease;
  background-color: #fff;
}

.screening-card:hover {
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  transform: translateY(-5px);
}

.screening-card-header {
  font-size: 22px;
  font-weight: 600;
  margin-bottom: 15px;
  color: #4a4a4a;
}

.screening-card-body {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.screening-card img {
  width: 120px;
  height: 120px;
  border-radius: 10px;
  object-fit: cover;
  margin-right: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.btn-screening {
  padding: 12px 25px;
  border-radius: 25px;
  font-size: 16px;
  font-weight: 500;
  transition: all 0.3s ease;
  background-color: #007bff;
  border-color: #007bff;
}

.btn-screening:hover {
  background-color: #0056b3;
  border-color: #0056b3;
  transform: scale(1.05);
}

.hover-effect {
  transition: transform 0.3s ease;
}

.hover-effect:hover {
  transform: scale(1.05);
}

@media (max-width: 768px) {
  .screening-card-body {
    flex-direction: column;
    align-items: flex-start;
  }
  
  .screening-card img {
    margin-right: 0;
    margin-bottom: 15px;
  }
  
  .btn-screening {
    width: 100%;
  }
}
  </style>
</head>

<body>

  <!-- Nội dung hiển thị thông tin người dùng -->
  <div class="container user-info">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header text-center">
            <h2>Danh sách phụ huynh</h2>
          </div>
          <div class="card-body">
            <?php
            if (!empty($listcv1)) {
              foreach ($listcv1 as $cv) {
                if (isset($cv['idPhuHuynh'], $cv['hinhAnh'], $cv['hoTenPH'])) {
                  $idPhuHuynh = $cv['idPhuHuynh'];
                  $hinhAnh = $cv['hinhAnh'];
                  $phuHuynhName = $cv['hoTenPH'];
            ?>
                  <div class="screening-card">
                    <div class="screening-card-header">Tư vấn phụ huynh: <?= $phuHuynhName ?></div>
                    <div class="screening-card-body">
                      <img class="card-img-top mb-2 hover-effect" src='admin/assets/uploads/images/<?php echo $cv['hinhAnh']; ?>' alt="">
                      <a href="index.php?tuvankh=<?= $idPhuHuynh ?>&idPhuHuynh=<?= $idPhuHuynh ?>" class="btn btn-primary btn-screening">Chọn</a>
                    </div>
                  </div>
            <?php
                } else {
                  echo "<p>Không tìm thấy thông tin về phụ huynh.</p>";
                }
              }
            } else {
              echo "<p>Không có danh sách phụ huynh.</p>";
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</body>

</html>