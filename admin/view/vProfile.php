<?php
include_once("controller/cInfo.php");


// Đảm bảo rằng biến session 'username' đã được khởi tạo
if (isset($_SESSION['username']) || isset($_SESSION['Role'])) {
  $username = $_SESSION['username'];
  $role = $_SESSION['Role'];
} else {
  $username = null;
  $role = null;
}

// Gọi phương thức select_info để lấy thông tin người dùng
$info = new cInfo();
$result = $info->select_info($username, $role);

// Khởi tạo biến $role để tránh lỗi Undefined variable


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thông tin tài khoản</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .user-info {
      margin-top: 50px;
    }
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    .card-header {
      background-color: #007bff;
      color: white;
      border-radius: 15px 15px 0 0;
    }
    .card-header h2 {
      margin-bottom: 0;
    }
    .user-image-wrapper {
      position: relative;
      margin-bottom: 20px;
    }
    .user-image {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 50%;
      border: 5px solid #fff;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ease;
    }
    .user-image:hover {
      transform: scale(1.05);
    }
    .user-details {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 10px;
    }
    .user-details h5 {
      color: #007bff;
      margin-bottom: 20px;
    }
    .user-details p {
      margin-bottom: 10px;
      color: #495057;
    }
    .user-details i {
      width: 25px;
      color: #007bff;
    }
  </style>
</head>

<body>
  <div class="container user-info">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header text-center py-3">
            <h2><i class="fas fa-user-circle mr-2"></i>Thông tin tài khoản</h2>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 text-center">
                <?php
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="user-image-wrapper">';
                    echo '<img src="admin/assets/uploads/images/' . $row["hinhAnh"] . '" alt="User Image" class="user-image">';
                    echo '</div>';
                  }
                }
                ?>
              </div>
              <div class="col-md-8">
                <div class="user-details">
                  <?php
                  if (mysqli_num_rows($result) > 0) {
                    mysqli_data_seek($result, 0);
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo '<h5><i class="fas fa-id-card mr-2"></i>' . $row["hoTen"] . '</h5>';
                      echo '<p><i class="fas fa-venus-mars mr-2"></i>Giới tính: ' . ($row["gioiTinh"] == 0 ? "Nam" : "Nữ") . '</p>';
                      echo '<p><i class="fas fa-phone mr-2"></i>Số điện thoại: ' . $row["soDienThoai"] . '</p>';
                      echo '<p><i class="fas fa-envelope mr-2"></i>Email: ' . $row["email"] . '</p>';
                      echo '<p><i class="fas fa-user-tag mr-2"></i>Chức vụ: ';
                      switch ($row["Role"]) {
                        case '1':
                          echo 'Admin';
                          break;
                        case '3':
                          echo 'Chuyên viên';
                          break;
                        case '4':
                          echo 'Quản trị viên(CHUYÊN VIÊN)';
                          break;
                        case '5':
                          echo 'Giáo viên';
                          break; 
                        case '6':
                          echo 'Quản trị viên(GIÁO VIÊN)';
                          break; 
                        default:
                          echo 'Unknown';
                          break;
                      }
                      echo '</p>';
                    }
                  } else {
                    echo "<p class='text-center'>Không có thông tin</p>";
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

  <!-- Modal sửa thông tin -->
  

  <!-- Script JavaScript để gửi dữ liệu từ modal -->
  <script>
    document.getElementById("sendBtn").addEventListener("click", function() {
      var hoTen = document.getElementById("hoTen").value;
      var gioiTinh = document.getElementById("gioiTinh").value;
      var soDienThoai = document.getElementById("soDienThoai").value;
      var hinhAnh = document.getElementById("hinhAnh").value;
      var email = document.getElementById("email").value;

      // Sử dụng AJAX để gửi dữ liệu đến server
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "process.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          alert(xhr.responseText); // Hiển thị thông báo từ server
          location.reload(); // Tải lại trang sau khi gửi dữ liệu thành công
        }
      };
      // Gửi dữ liệu form thông tin người dùng
      xhr.send("hoTen=" + hoTen + "&gioiTinh=" + gioiTinh + "&soDienThoai=" + soDienThoai + "&hinhAnh=" + hinhAnh + "&email=" + email);
    });
  </script>

  <script src="https://code.jquery.com/jquery-3.5.1
