<?php

include_once("controller/TreEm/cTreEm.php");
// session_start();

$p = new cHoSoTreEm();

// Lấy danh sách trẻ em theo username từ session
$table = $p->select_treem();
if (isset($_GET['search_query'])) {
  $search_query = $_GET['search_query'];
  $table = $p->search_treem($search_query); // Ensure the search function is correctly defined
} else {
  $table = $p->select_treem();
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

<style>
  .rounded-image {
  border-radius: 10px;
  object-fit: cover;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .rounded-image:hover {
  transform: scale(1.1);
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

  .dataTables_wrapper .dataTables_paginate .paginate_button {
  padding: 0.5em 1em;
  margin-left: 2px;
  border: 1px solid transparent;
  border-radius: 4px;
  background: #007bff;
  color: white !important;
  cursor: pointer;
  transition: background-color 0.3s ease;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
  background: #0056b3;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button.current {
  background: #0056b3;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
  background: #e9ecef;
  color: #6c757d !important;
  cursor: not-allowed;
  }
  .modal-dialog {
  max-width: 800px;
  }

  .modal-content {
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }

  .modal-header {
  background-color: #007bff;
  color: #fff;
  border-top-left-radius: 12px;
  border-top-right-radius: 12px;
  }

  .modal-title {
  font-size: 1.25rem;
  font-weight: 600;
  }

  .modal-body {
  padding: 24px;
  }

  .detail-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 16px;
  }

  .detail-label {
  font-weight: 600;
  width: 30%;
  }

  .detail-value {
  width: 70%;
  }

  .btn-view-detail {
  background-color: #007bff;
  border: none;
  color: #fff;
  padding: 8px 16px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  }

  .btn-view-detail:hover {
  background-color: #0056b3;
  }
</style>

<body>
  <div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      <h1>Quản lý Thông Tin Trẻ Em</h1>
      </div>
      <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
        <li class="breadcrumb-item active">Quản lý trẻ em</li>
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
        <h3 class="card-title">Danh sách thông tin trẻ em</h3> 
        <div class="card-tools">
          <form class="search-form" action="index.php" method="GET">
          <input type="hidden" name="qlte" value="treem">
          <input id="search_query" type="text" name="search_query" placeholder="Nhập từ khóa tìm kiếm">
          <button type="submit"><i class="fas fa-search"></i></button>
          </form>
        </div>
        </div>
        <div class="card-body table-responsive p-0">
        <table id="treemTable" class="table table-hover text-nowrap">
          <thead>
          <tr>
            <th>STT</th>
            <th>Họ tên trẻ em</th>
            <th>Hình Ảnh</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            
            <th>Chi tiết</th>
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
            echo "<td>" . $row['hoTenTE'] . "</td>";
            echo "<td><a href='" . ($row['hinhAnh'] ? 'admin/assets/uploads/images/' . $row['hinhAnh'] : '/assets/uploads/images/user.png') . "' class='popup-link'><img class='rounded-image' src='" . ($row['hinhAnh'] ? 'admin/assets/uploads/images/' . $row['hinhAnh'] : '/assets/uploads/images/user.png') . "' alt='' height='100px' width='150px'></a></td>";
            echo "<td>" . $row['ngaySinh'] . "</td>";
            echo "<td>" . ($row['gioiTinh'] == 0 ? 'Nam' : 'Nữ') . "</td>";

            echo "<td><button class='btn-view-detail' onclick='showDetails(" . json_encode($row) . ")'>Chi tiết</button></td>";
            echo "<td><a href='?updatetreem&&idHoSo=" . $row['idHoSo'] . "'><i class='fa fa-pen' aria-hidden='true'></i></a> | <a href='?deleteTreEm&&idHoSo=" . $row['idHoSo'] . "' onclick='return confirm_delete();'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
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

  <!-- Modal -->
  <div id="detailModal" class="modal fade" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Chi tiết Trẻ Em</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Content will be dynamically inserted here -->
      </div>
    </div>
  </div>
  </div>

  <script>
  function confirm_delete() {
    return confirm('Bạn có chắc chắn muốn xóa?');
  }

  function formatDate(dateString) {
    const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
    return new Date(dateString).toLocaleDateString('vi-VN', options);
  }

  function showDetails(record) {
    const modal = $('#detailModal');
    const modalBody = modal.find('.modal-body');
    
    const content = `
      <div class="detail-row">
        <div class="detail-label">Họ tên trẻ em:</div>
        <div class="detail-value">${record.hoTenTE}</div>
      </div>
      <div class="detail-row">
            <div class="detail-label">Hình Ảnh:</div>
            <div class="detail-value">
                <img src="${record.hinhAnh ? 'admin/assets/uploads/images/' + record.hinhAnh : '/assets/uploads/images/user.png'}" 
                     alt="Hình ảnh chi tiết" 
                     style="max-width: 300px; border-radius: 8px;">
            </div>
        </div>
      <div class="detail-row">
        <div class="detail-label">Ngày sinh:</div>
        <div class="detail-value">${formatDate(record.ngaySinh)}</div>
      </div>
      <div class="detail-row">
        <div class="detail-label">Giới tính:</div>
        <div class="detail-value">${record.gioiTinh == 0 ? 'Nam' : 'Nữ'}</div>
      </div>
      <div class="detail-row">
        <div class="detail-label">Trẻ được sinh vào thai kỳ thứ:</div>
        <div class="detail-value">${record.thaiKy}</div>
      </div>
      <div class="detail-row">
        <div class="detail-label">Tình trạng:</div>
        <div class="detail-value">${record.tinhTrang}</div>
      </div>
      <div class="detail-row">
        <div class="detail-label">Kết quả đánh giá:</div>
        <div class="detail-value">${record.noiDungKetQua}</div>
      </div>
      <div class="detail-row">
        <div class="detail-label">Con của Phụ Huynh:</div>
        <div class="detail-value">${record.hoTenPH}</div>
      </div>
    `;
    
    modalBody.html(content);
    modal.modal('show');
  }
  </script>

  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script>
  $(document).ready(function() {
    $('#treemTable').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false, // Loại bỏ thanh tìm kiếm của DataTables
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "pageLength": 5, // Thay đổi số lượng bản ghi hiển thị trên mỗi trang tại đây
    "language": {
      "paginate": {
      "first": "Đầu",
      "last": "Cuối",
      "next": "Tiếp",
      "previous": "Trước"
      },
      "lengthMenu": "Hiển thị _MENU_ bản ghi mỗi trang",
      "zeroRecords": "Không tìm thấy bản ghi nào",
      "info": "Hiển thị trang _PAGE_ của _PAGES_",
      "infoEmpty": "Không có bản ghi nào",
      "infoFiltered": "(lọc từ _MAX_ bản ghi)",
      "search": "Tìm kiếm:",
      "loadingRecords": "Đang tải...",
      "processing": "Đang xử lý...",
      "emptyTable": "Không có dữ liệu trong bảng",
      "aria": {
      "sortAscending": ": sắp xếp tăng dần",
      "sortDescending": ": sắp xếp giảm dần"
      }
    }
    });
  });
  </script>
</body>