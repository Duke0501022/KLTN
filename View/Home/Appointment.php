<?php

include_once("Controller/Datlich/cDatlich.php");

$controller = new AppointmentController();



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['idChuyenVien']) && !empty($_POST['idChuyenVien'])) {
        $_SESSION['appointment']['idChuyenVien'] = $_POST['idChuyenVien'];
        header("Location: View/AppointmentDetail.php");
        exit();
    } else {
        echo "Vui lòng chọn chuyên viên.";
    }
}

// Lấy danh sách chuyên viên
$specialists = $controller->listSpecialists();
?>

<style>
  .rounded-image {
  border-radius: 15px;
  object-fit: cover;
  max-width: 100%; /* Đảm bảo hình ảnh không vượt quá kích thước khối chứa */
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.rounded-image:hover {
  transform: scale(1.1);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
}

.specialist-info-container {
  margin-top: 70px;
}

.specialist-info img {
  max-height: 300px;
  width: auto;
}

/* Tăng kích thước ảnh trong dropdown sau khi chọn */
#selected-image {
  width: 300px;
  height: 300px;
  object-fit: cover;
  border-radius: 15px;
}

</style>

<section class="py-6">
  <div class="container">
    <div class="row">
      <!-- Thông tin chuyên viên -->
      <div class="col-lg-6 z-index-2 specialist-info-container">
        <div id="default-info" class="text-center">
          <img src="img/childcare.png" alt="Giới thiệu" class="img-fluid rounded-image mb-3" id="selected-image">
          <p class="text-dark">Chọn chuyên viên để xem thông tin chi tiết.</p>
        </div>
        <div id="specialist-info" class="text-center" style="display: none;">
          <img id="specialist-image" src="" alt="Chuyên viên" class="img-fluid rounded-image mb-3">
          <p id="specialist-description" class="text-dark"></p>
        </div>
      </div>

      <!-- Dropdown chọn chuyên viên -->
      <div class="col-lg-6 z-index-2 specialist-info-container">
        <form class="row g-3" action="" method="POST">
          <div class="col-md-12">
            <label class="form-label text-dark">Chọn chuyên viên:</label>
            <select class="form-select border border-primary" id="idChuyenVien" name="idChuyenVien" onchange="updateSpecialistInfo()">
              <option value="0" data-image="img/childcare.png" data-description="">Chọn chuyên viên</option>
              <?php
              if (!empty($specialists)) {
                foreach ($specialists as $item) { ?>
                  <option value="<?php echo $item['idChuyenVien'] ?>" data-image="<?php echo $item['hinhAnh'] ? 'admin/admin/assets/uploads/images/' . $item['hinhAnh'] : 'admin/admin/assets/uploads/images/default.png' ?>" data-description="<?php echo $item['moTa'] ?>">
                    <?php echo $item['hoTen']; ?>
                  </option>
                <?php }
              } ?>
            </select>
            <p class="text-danger error">
              <?php
              if (isset($_POST['sub_appointment'])) {
                if (!isset($_POST['idChuyenVien']) || $_POST['idChuyenVien'] == 0) {
                  echo 'Vui lòng chọn chuyên viên';
                }
              }
              ?>
            </p>
          </div>
          <div class="col-12 text-center">
            <input type="submit" value="Tiếp theo" class="btn btn-primary rounded-pill" name="sub_appointment">
          </div>
        </form>
      </div>
    </div>
  </div>
</section>


<script>
function updateSpecialistInfo() {
  var select = document.getElementById('idChuyenVien');
  var selectedOption = select.options[select.selectedIndex];
  var image = selectedOption.getAttribute('data-image');
  var description = selectedOption.getAttribute('data-description');

  // Hiển thị hình ảnh đã chọn
  var selectedImage = document.getElementById('selected-image');
  selectedImage.src = image;
  
  if (select.value == "0") {
    document.getElementById('default-info').style.display = 'block';
    document.getElementById('specialist-info').style.display = 'none';
  } else {
    document.getElementById('default-info').style.display = 'none';
    document.getElementById('specialist-info').style.display = 'block';
    document.getElementById('specialist-image').src = image;
    document.getElementById('specialist-description').innerText = description;
  }
}

// Gọi hàm updateSpecialistInfo() khi trang được tải để hiển thị thông tin mặc định
window.onload = updateSpecialistInfo;

</script>