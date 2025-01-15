<?php 
include_once("controller/LopHoc/cLopHoc.php");

$p = new cLopHoc();
if (isset($_GET['search_query'])) {
    $search_query = $_GET['search_query'];
    $classes = $p->search_KHDN($search_query);
} else {
    $classes = $p->get_lop();
}
$classGroups = [];
if ($classes) {
    while ($row = $classes->fetch_assoc()) {
        $idLopHoc = $row['idLopHoc'];
        if (!isset($classGroups[$idLopHoc])) {
            $classGroups[$idLopHoc] = [
                'details' => [
                    'idLopHoc' => $row['idLopHoc'],
                    'tenLop' => $row['tenLop'],
                    'tenGiaoVien'=> $row['hoTen'],
                ],
                'students' => [],
                'hinhAnh' => []
            ];
        }
        if (!empty($row['hoTenTE'])) {
            $classGroups[$idLopHoc]['students'][] = [
                'hoTenTE' => $row['hoTenTE'],
                'gioiTinh' => $row['gioiTinh'] == 0 ? 'Nam' : 'Nữ',
                'ngaySinh' => $row['ngaySinh'],
                'tinhTrang' => $row['tinhTrang'],
                'noiDungKetQua' => $row['noiDungKetQua'] ?? '',
                'hinhAnh' => $row['hinhAnh'] ?? ''
            ];
        }
    }
}

?>

<style>
    :root {
        --primary-color: #4a90e2;
        --secondary-color: #f5f6fa;
        --border-color: #e1e8ed;
        --text-color: #2c3e50;
        --shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: var(--secondary-color);
    color: var(--text-color);
    line-height: 1.6;
   
}

    .content-wrapper {
    max-width: 1200px; /* Kiểm tra giá trị này */
    margin: 0 auto;
    background: white;
    border-radius: 15px;
    box-shadow: var(--shadow);
    padding: 25px;
}
    .content-header {
        margin-bottom: 30px;
        border-bottom: 2px solid var(--border-color);
        padding-bottom: 15px;
    }

    .content-header h1 {
        color: var(--primary-color);
        font-size: 24px;
        margin: 0;
    }

    .accordion {
        background: white;
        border-radius: 10px;
        margin-bottom: 20px;
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    .accordion-header {
        background: var(--primary-color);
        color: white;
        padding: 15px 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: background 0.3s ease;
    }

    .accordion-header:hover {
        background: #357abd;
    }

    .accordion-content {
        padding: 0;
        max-height: 0;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .accordion-content.active {
        padding: 20px;
        max-height: 1000px;
    }


    .edit-button {
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .edit-button:hover {
        background: #357abd;
    }

    .status-badge {
        background: #e1e8ed;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.9em;
        margin-left: 10px;
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

    /* Responsive Design */
    @media (max-width: 768px) {
        .content-wrapper {
            padding: 15px;
        }
        
        .student-item {
            flex-direction: column;
            text-align: center;
        }
        
        .student-image {
            margin-right: 0;
            margin-bottom: 10px;
        }
        
        .edit-button {
            margin-top: 10px;
        }
    }
    .action-buttons {
    display: flex;
    gap: 10px;
}

.class-header {
    background: linear-gradient(135deg, #4a90e2, #357abd);
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 8px 8px 0 0;
    color: white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.class-header span {
    font-size: 16px;
    font-weight: 500;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
}

.action-buttons {
    display: flex;
    gap: 12px;
}

.btn-icon {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    transition: all 0.3s ease;
}

.btn-icon:hover {
    transform: scale(1.1);
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

.btn-icon.edit {
    background-color: #28a745;
}

.btn-icon.edit:hover {
    background-color: #218838;
}

.btn-icon.delete {
    background-color: #dc3545;
}

.btn-icon.delete:hover {
    background-color: #c82333;
}

.fas {
    font-size: 14px;
}
.table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin-bottom: 1rem;
    background-color: transparent;
    border-radius: 8px;
    overflow: hidden;
}

.table thead th {
    background-color: #4a90e2;
    color: white;
    font-weight: 500;
    padding: 12px;
    text-align: center;
    border: none;
    white-space: nowrap;
}

.table tbody tr:nth-child(even) {
    background-color: #f8f9fa;
}

.table tbody tr:nth-child(odd) {
    background-color: #ffffff;
}

.table tbody tr:hover {
    background-color: #e9ecef;
    transition: background-color 0.2s ease;
}

.table td {
    padding: 12px;
    vertical-align: middle;
    border-top: 1px solid #dee2e6;
    color: #495057;
}

.table tbody tr:last-child td {
    border-bottom: none;
}

.student-image {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Specific column styling */
.table td:nth-child(3) {  /* Họ và Tên column */
    font-weight: 500;
    color: #2c3e50;
}

.table td:nth-child(6) {  /* Tình Trạng column */
    font-weight: 500;
    color: #28a745;
}

.table td:nth-child(7) {  /* Đánh Giá column */
    color: #6c757d;
    max-width: 200px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>

<body>
  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý Lớp Học</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lý lớp học</li>
            </ol>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách thông tin lớp</h3> | 
                            <a href="?addlop">Thêm lớp mới</a>
                            <div class="card-tools">
                <form class="search-form" action="index.php" method="GET">
                    <input type="hidden" name="qllop" value="">
                    <input id="search_query" type="text" name="search_query" placeholder="Nhập từ khóa tìm kiếm">
                    <button type="submit"><i class="fas fa-search"></i></button>
                  </form>
                </div>
                        </div>
                        
                        <div class="card-body">
                            <?php if (empty($classGroups)): ?>
                                <p>Không có lớp học nào.</p>
                            <?php else: ?>
                                <?php foreach ($classGroups as $class): ?>
                                    <div class="class-card">
                                    <div class="class-header">
                                    <span class="toggle-icon">▼</span>
                                    <span>
                                        <?php 
                                            echo htmlspecialchars($class['details']['tenLop']) . 
                                            " - GV: " . 
                                            htmlspecialchars($class['details']['tenGiaoVien']); 
                                        ?>
                                    </span>
                                            <div class="action-buttons">
                                                <a href="?upLop&idLopHoc=<?php echo $class['details']['idLopHoc']; ?>" 
                                                class="btn-icon edit" 
                                                title="Sửa lớp">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="?dellop&idLopHoc=<?php echo $class['details']['idLopHoc']; ?>" 
                                                class="btn-icon delete" 
                                                onclick="return confirm('Bạn có chắc muốn xóa lớp này?')"
                                                title="Xóa lớp">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        </div>
                                        
                                        <div class="class-content">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>STT</th>
                                                        <th>Hình Ảnh</th>
                                                        <th>Họ và Tên</th>
                                                        <th>Giới Tính</th>
                                                        <th>Ngày Sinh</th>
                                                        <th>Tình Trạng</th>
                                                        <th>Đánh Giá</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($class['students'] as $index => $student): ?>
                                                        <tr>
                                                            <td><?php echo $index + 1; ?></td>
                                                            <td>
                                                                <img src="<?php echo !empty($student['hinhAnh']) ? 'assets/uploads/images/' . htmlspecialchars($student['hinhAnh']) : 'assets/uploads/images/default.png'; ?>" 
                                                                     class="student-image" 
                                                                     alt="Hình ảnh học sinh">
                                                            </td>
                                                            <td><?php echo htmlspecialchars($student['hoTenTE']); ?></td>
                                                            <td><?php echo htmlspecialchars($student['gioiTinh']); ?></td>
                                                            <td><?php echo date('d/m/Y', strtotime($student['ngaySinh'])); ?></td>
                                                            <td><?php echo htmlspecialchars($student['tinhTrang']); ?></td>
                                                            <td><?php echo htmlspecialchars($student['noiDungKetQua']); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.class-header').forEach(header => {
        header.addEventListener('click', function(e) {
            // Prevent toggling when clicking action buttons
            if (e.target.closest('.action-buttons')) {
                return;
            }
            
            const content = this.nextElementSibling;
            const icon = this.querySelector('.toggle-icon');
            
            // Toggle content visibility
            content.classList.toggle('active');
            
            // Update icon
            if (content.classList.contains('active')) {
                icon.textContent = '▼';
                icon.style.transform = 'rotate(0deg)';
            } else {
                icon.textContent = '▶';
                icon.style.transform = 'rotate(-90deg)';
            }
        });
    });
});
</script>
</body>
<style>
.class-card {
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.class-header {
    background-color: #f8f9fa;
    padding: 10px 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.class-content {
    padding: 15px;
}

.student-image {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 4px;
}
</style>
<!-- /.content-wrapper -->
