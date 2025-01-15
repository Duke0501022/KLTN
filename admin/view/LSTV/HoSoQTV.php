<head>
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <!-- Magnific Popup CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
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
  </style>
</head>
<body>
<?php 
    include_once("controller/HoSoTuVan/cHSTV.php");
    $p = new cHSTV();
    $table = $p->get_hoso();
    if (isset($_GET['search_query1'])) {
        $search_query = $_GET['search_query1'];
        $table = $p->search_hoso($search_query) ; 
    } else {
        $table = $p->get_hoso();
    }
?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Quản lý Thông Tin Hồ Sơ Tư Vấn</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Quản lý Hồ Sơ</li>
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
              <h3 class="card-title">Danh sách hồ sơ tư vấn</h3> 
              <div class="card-tools">
                <form class="search-form" action="index.php" method="GET">
                  <input type="hidden" name="qlgv" value="giaovien">
                  <input id="search_query1" type="text" name="search_query1" placeholder="Nhập từ khóa tìm kiếm">
                  <button type="submit"><i class="fas fa-search"></i></button>
                </form>
              </div>
            </div>
            <div class="card-body table-responsive p-0">
              <table id="giaovienTable" class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên Phụ Huynh</th>
                    <th>Hình Ảnh</th>
                    <th>Ngày Đặt Lịch</th>
                    <th>Lời Dặn</th>
                    <th>Chuẩn Đoán</th>
                    <th>Ngày Tạo Hồ Sơ</th>
                    <th>Tác vụ</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  if ($table) {
                    $stt = 1;
                    while ($row = mysqli_fetch_assoc($table)) {
                      $formatted_date = date('d/m/Y', strtotime($row['date']));
                      $formatted_date_create = date('d/m/Y', strtotime($row['date_create']));

                      echo "<tr>";
                      echo "<td>" . $stt++ . "</td>";
                      echo "<td>" . $row['hoTenPH'] . "</td>";
                      echo "<td><a href='" . ($row['hinhAnh'] ? 'admin/assets/uploads/images/' . $row['hinhAnh'] : '/assets/uploads/images/user.png') . "' class='popup-link'><img class='rounded-image' src='" . ($row['hinhAnh'] ? 'admin/assets/uploads/images/' . $row['hinhAnh'] : '/assets/uploads/images/user.png') . "' alt='' height='100px' width='150px'></a></td>";
                      echo "<td>" . $formatted_date . "</td>";
                      echo "<td>" . $row['loiDan'] . "</td>";
                      echo "<td>" . $row['chuanDoan'] . "</td>";
                      echo "<td>" . $formatted_date_create . "</td>";
                      echo "<td>
        <a href='?delHS&idHoSoTuVan=" . $row['idRecord'] . "' 
           onclick='return confirm(\"Bạn có chắc chắn muốn xoá hồ sơ tư vấn này?\")'>
           <button class='btn btn-danger'>Xoá</button>
        </a>
      </td>";

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script>
  function confirm_delete() {
    return confirm('Bạn có chắc chắn muốn xóa?');
  }
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#giaovienTable').DataTable({
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
<script>
  $(document).ready(function() {
    $('.popup-link').magnificPopup({
      type: 'image',
      closeBtnInside: true,
      closeOnContentClick: true,
      image: {
        verticalFit: true
      }
    });
  });
</script>
</body>