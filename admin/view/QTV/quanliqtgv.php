<?php 

include_once("controller/QTV/cQTV.php");

$p = new cQTV();

$table = $p->get_qtgv();
if (isset($_GET['search_query1'])) {
  $search_query = $_GET['search_query1'];
  $table = $p->search_qtgiaovien($search_query); // Ensure the search function is correctly defined
} else {
  $table = $p->get_qtgv();
}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.2/dist/css/select2.min.css">

<style>
  .rounded-image {
    border-radius: 8px;
    object-fit: cover;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .rounded-image:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }

  .search-form {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-bottom: 20px;
  }

  .search-form input[type="text"] {
    width: 220px;
    padding: 8px 12px;
    border: 1px solid #ced4da;
    border-radius: 6px;
    margin-right: 10px;
    font-size: 14px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
  }

  .search-form input[type="text"]:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
  }

  .search-form button {
    padding: 8px 16px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease;
  }

  .search-form button:hover {
    background-color: #0056b3;
  }

  .table {
    width: 100%;
    margin: 20px 0;
    border-collapse: collapse;
  }

  .table th, .table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #dee2e6;
  }

  .table th {
    background-color: #f8f9fa;
    font-weight: bold;
  }

  .table tr:hover {
    background-color: #f1f1f1;
  }
</style>

<body>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý Thông Tin Quản Trị Giáo Viên</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lý quản trị giáo viên</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách thông tin quản trị giáo viên</h3> | <a href="?addqtgv">Thêm giáo quản trị viên mới</a>
                <div class="card-tools">
                  <form class="search-form" action="index.php" method="GET">
                    <input type="hidden" name="qlqtgv" value="quantrigiaovien">
                    <input id="search_query1" type="text" name="search_query1" placeholder="Nhập từ khóa tìm kiếm">
                    <button type="submit"><i class="fas fa-search"></i></button>
                  </form>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Mã Quản Trị Giáo Viên</th>
                      <th>Tên Giáo Viên</th>
                      <th>Số điện thoại</th>
                    
                      <th>Email</th>
                      <th>Hình Ảnh</th>
                      <th>Giới Tính</th>
                      <th>Tác vụ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($table) {
                      $stt = 1;
                      while ($row = mysqli_fetch_assoc($table)) {
                        

                        echo "<tr>";
                        echo "<td>" . $stt++ . "</td>";
                        echo "<td>" . $row['idQTGV'] . "</td>";
                        echo "<td>" . $row['hoTen'] . "</td>";
                        echo "<td>" . $row['soDienThoai'] . "</td>";
                       
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td><img class='rounded-image' src='" . ($row['hinhAnh'] ? 'admin/assets/uploads/images/' . $row['hinhAnh'] : '/assets/uploads/images/user.png') . "' alt='' height='100px' width='150px'></td>";
                        echo "<td>" . ($row['gioiTinh'] == 0 ? 'Nam' : 'Nữ') . "</td>";
                        echo "<td><a href='?updateqtgv&&idQTGV=" . $row['idQTGV'] . "'><i class='fa fa-pen' aria-hidden='true'></i></a> | <a href='?delqtgv&&idQTGV=" . $row['idQTGV'] . "&&username=" . $row['username'] . "' onclick='return confirm_delete();'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
                        echo "</tr>";
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script>
    function confirm_delete() {
      return confirm('Bạn có chắc chắn muốn xóa?');
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.2/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#search_query1').select2({
        ajax: {
          url: 'search.php',
          dataType: 'json',
          delay: 250,
          data: function(params) {
            return {
              q: params.term
            };
          },
          processResults: function(data) {
            return {
              results: data.items
            };
          }
        }
      });
    });
  </script>
</body>
