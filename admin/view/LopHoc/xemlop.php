<?php
include_once("controller/LopHoc/cLopHoc.php");

$p = new cLopHoc();

// Kiểm tra xem giáo viên đã đăng nhập chưa
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $idGiaoVien = $_SESSION['idGiaoVien'] ?? null; // Sử dụng null coalescing operator
} else {
    $username = null;
    $idGiaoVien = null;
}
if (isset($_GET['search_query'])) {
    $search_query = $_GET['search_query'];
    $classes = $p->search_treem($search_query, $idGiaoVien, $username);
} else {
    $classes = $p->get_lop_by_giaovien($idGiaoVien, $username);
}

// Kiểm tra kết quả trả về
if ($classes === false) {
    echo "Lỗi khi truy vấn cơ sở dữ liệu.";
    exit;
}

// Group students by class
$classGroups = [];
while ($row = $classes->fetch_assoc()) {
    $idLopHoc = $row['idLopHoc'];
    if (!isset($classGroups[$idLopHoc])) {
        $classGroups[$idLopHoc] = [
            'details' => [
                'idLopHoc' => $row['idLopHoc'],
                'tenLop' => $row['tenLop'],
            ],
            'students' => []
        ];
    }
    if (!empty($row['hoTenTE'])) {
        $classGroups[$idLopHoc]['students'][] = [
            'hoTenTE' => $row['hoTenTE'],
            'idHoSo' => $row['idHoSo'],
            'hinhAnh' => $row['hinhAnh'],
            'noiDung' => $row['noiDungKetQua'],
            'tinhTrang' => $row['tinhTrang'],
            'gioiTinh' => $row['gioiTinh'] == 0 ? 'Nam' : 'Nữ',
            'ngaySinh' => $row['ngaySinh']
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
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
            margin: 0;
            padding: 20px;
        }

        .content-wrapper {
            max-width: 1200px;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content-header h1 {
            color: var(--primary-color);
            font-size: 24px;
            margin: 0;
        }

        .search-form {
            display: flex;
            align-items: center;
        }

        .search-form input[type="text"] {
            width: 200px;
            padding: 5px;
            border: 2px solid #ced4da;
            border-radius: 10px;
            font-size: 16px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .search-form input[type="text"]:focus {
            border-color: #4a90e2;
            outline: none;
            box-shadow: 0 0 8px rgba(74, 144, 226, 0.5);
        }

        .search-form button {
            width: 40px;
            height: 40px;
            background-color: #4a90e2;
            color: white;
            border: none;
            margin-left: 15px;
            border-radius: 15px;
            cursor: pointer;
            font-size: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease;
        }

        .class-card {
            background: white;
            border-radius: 10px;
            margin-bottom: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .class-header {
            background: var(--primary-color);
            color: white;
            padding: 15px 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .class-content {
            padding: 0;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .class-content.active {
            padding: 20px;
            max-height: 1000px;
        }

        .student-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .student-table th, .student-table td {
            border: 1px solid var(--border-color);
            padding: 10px;
            text-align: left;
        }

        .student-table th {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
        }

        .student-table-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }

        .edit-button {
            display: inline-block;
            padding: 5px 10px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }

        .edit-button:hover {
            background-color: #357abd;
        }

        @media (max-width: 768px) {
            .content-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .content-header h1 {
                margin-bottom: 15px;
            }

            .search-form {
                width: 100%;
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <div class="content-header">
            <h1>Quản lý Thông Tin Lớp Học</h1>
            <form class="search-form" action="index.php" method="GET">
                <input type="hidden" name="xemlop" value="">
                <input id="search_query" type="text" name="search_query" placeholder="Nhập từ khóa tìm kiếm">
                <button type="submit" aria-label="Tìm kiếm"><i class="fas fa-search"></i></button>
            </form>
        </div>
        
        <div class="classes-container">
            <?php if (empty($classGroups)): ?>
                <p>Không có lớp học nào.</p>
            <?php else: ?>
                <?php foreach ($classGroups as $class): ?>
                    <div class="class-card">
                        <div class="class-header">
                            <span><?php echo htmlspecialchars($class['details']['tenLop']); ?></span>
                            <span class="toggle-icon">▶</span>
                        </div>
                        
                        <div class="class-content">
                            <table class="student-table">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Hình Ảnh</th>
                                        <th>Họ và Tên</th>
                                        <th>Giới Tính</th>
                                        <th>Ngày Sinh</th>
                                        <th>Tình Trạng</th>
                                        <th>Đánh Giá</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($class['students'] as $index => $student): ?>
                                        <tr>
                                            <td><?php echo $index + 1; ?></td>
                                            <td>
                                                <img class="student-table-image" 
                                                     src="<?php echo $student['hinhAnh'] ? 'assets/uploads/images/' . htmlspecialchars($student['hinhAnh']) : 'assets/uploads/images/default.png'; ?>" 
                                                     alt="Hình ảnh của <?php echo htmlspecialchars($student['hoTenTE']); ?>">
                                            </td>
                                            <td><?php echo htmlspecialchars($student['hoTenTE']); ?></td>
                                            <td><?php echo htmlspecialchars($student['gioiTinh']); ?></td>
                                            <td><?php 
                                                $ngaySinh = date('d/m/Y', strtotime($student['ngaySinh'])); 
                                                echo htmlspecialchars($ngaySinh); 
                                            ?></td>
                                            <td><?php echo htmlspecialchars($student['tinhTrang']); ?></td>
                                            <td><?php echo htmlspecialchars($student['noiDung']); ?></td>
                                            <td>
                                                <a href="?updateStudent&idHoSo=<?php echo $student['idHoSo']; ?>" 
                                                   class="edit-button">Sửa</a>
                                                
                                            </td>
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

    <script>
        // Toggle class content
        document.querySelectorAll('.class-header').forEach(header => {
            header.addEventListener('click', function () {
                const content = this.nextElementSibling;
                content.classList.toggle('active');
                const icon = this.querySelector('.toggle-icon');
                icon.textContent = content.classList.contains('active') ? '▼' : '▶';
            });
        });
        function editStatus(hoTenTE, idLopHoc) {
            const newStatus = prompt("Nhập tình trạng mới cho học sinh " + hoTenTE + ":");
            if (newStatus !== null && newStatus.trim() !== '') {
                const formData = new FormData();
                formData.append('hoTenTE', hoTenTE);
                formData.append('tinhTrang', newStatus);
                formData.append('idLopHoc', idLopHoc);

                fetch('update_status.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(result => {
                    alert("Cập nhật tình trạng thành công!");
                    location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("Có lỗi xảy ra khi cập nhật tình trạng!");
                });
            }
        }

        function updateStatus(idHoSo, tinhTrang) {
            fetch('view/LopHoc/update_tt.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ idHoSo, tinhTrang })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Status updated successfully.');
                } else {
                    console.log('Failed to update status.');
                }
            })
            .catch(error => console.error('Error:', error));
        }

    </script>
</body>
</html>
<?php
include_once("controller/LopHoc/cLopHoc.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kiểm tra và làm sạch dữ liệu đầu vào
    $hoTenTE = filter_input(INPUT_POST, 'hoTenTE', FILTER_SANITIZE_STRING);
    $tinhTrang = filter_input(INPUT_POST, 'tinhTrang', FILTER_SANITIZE_STRING);
    $idLopHoc = filter_input(INPUT_POST, 'idLopHoc', FILTER_SANITIZE_NUMBER_INT);

    if ($hoTenTE && $tinhTrang && $idLopHoc) {
        $p = new cLopHoc();
        $result = $p->update_tinh_trang($hoTenTE, $tinhTrang, $idLopHoc);
        
        header('Content-Type: application/json');
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Cập nhật thành công']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Cập nhật thất bại']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ']);
    }
    exit;
}
?>
