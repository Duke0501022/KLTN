<?php
// Thêm vào phần đầu file
require_once("Controller/KhachHangDoanhNghiep/cKhachHangDoanhNghiep.php");
include_once("Controller/LSTV/cLichSuTuVan.php");
if (!isset($_SESSION['LoginSuccess']) || $_SESSION['LoginSuccess'] !== true) {
    // Redirect to login page if not logged in
    header('Location: index.php?login');
    exit();
}
$c = new cKHDN();
$username = $_SESSION['username'] ?? null;
$idPhuHuynh = $_SESSION['idPhuHuynh'] ?? null;
$p = new cLSTV();

// Xử lý lọc theo ngày
$startDate = $_GET['start_date'] ?? '';
$endDate = $_GET['end_date'] ?? '';
$search_query = $_GET['search_query1'] ?? '';

// Modify your existing getHSTVbyIDPH function to accept date filters
$table1 = $p->getHSTVbyIDPH($idPhuHuynh, $username, $startDate, $endDate, $search_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .calendar {
            margin-top: 50px;
        }
        .table-responsive {
            margin-top: 20px;
        }
        .btn-primary, .btn-danger, .btn-success {
            margin-right: 10px;
        }
        .container {
            max-width: 1200px;
        }
        .card {
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .badge {
            font-size: 12px;
            padding: 5px 10px;
            margin-right: 5px;
        }
        .detail-row {
            display: flex;
            margin-bottom: 15px;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .detail-label {
            width: 150px;
            font-weight: 500;
            color: #555;
        }
        .detail-value {
            flex: 1;
        }
        .modal-content {
            border-radius: 8px;
        }
        .btn-view-detail {
            padding: 5px 15px;
            border-radius: 4px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .btn-view-detail:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh sách hồ sơ tư vấn</h3>
                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="medicalRecordsTable">
                                        <thead>
                                            <tr>
                                                <th>Ngày khám</th>
                                                <th>Chi tiết khám</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (is_array($table1)) {
                                                foreach ($table1 as $row) {
                                                    $formatted_date = date('d/m/Y', strtotime($row['date']));
                                                    $image_path = $row['hinhAnh'] ? 'admin/admin/assets/uploads/images/' . $row['hinhAnh'] : 'admin/admin/assets/uploads/images/default.png';
                                            ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <span style="font-weight: bold;"><?php echo $formatted_date; ?></span>
                                                    </td>
                                                    <td>
                                                        <div class="container p-2 bg-body shadow-sm rounded">
                                                            <div class="row align-items-center">
                                                                <div class="col-md-3">
                                                                    <strong>Chuyên viên:</strong> <?php echo $row['hoTen']; ?>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <strong>Lời dặn:</strong> 
                                                                    <span class="text-truncate d-inline-block" style="max-width: 200px;">
                                                                        <?php echo $row['loiDan']; ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <strong>Chuẩn đoán:</strong>
                                                                    <span class="text-truncate d-inline-block" style="max-width: 200px;">
                                                                        <?php echo $row['chuanDoan']; ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <button class="btn-view-detail" onclick="showDetails(<?php echo htmlspecialchars(json_encode($row)); ?>)">
                                                                        Chi tiết
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
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
            </div>
        </section>
    </div>

    <!-- Modal -->
    <div id="detailModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chi tiết hồ sơ tư vấn</h5>
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
        function showDetails(record) {
            const modal = document.getElementById('detailModal');
            const modalBody = modal.querySelector('.modal-body');
            
            const content = `
                <div class="detail-row">
                    <div class="detail-label">Chuyên viên:</div>
                    <div class="detail-value">${record.hoTen}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Ngày khám:</div>
                    <div class="detail-value">${new Date(record.date).toLocaleDateString('vi-VN')}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Lời dặn:</div>
                    <div class="detail-value">${record.loiDan}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Chuẩn đoán:</div>
                    <div class="detail-value">${record.chuanDoan}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Hình ảnh:</div>
                    <div class="detail-value">
                        <img src="${record.hinhAnh ? 'admin/admin/assets/uploads/images/' + record.hinhAnh : 'admin/admin/assets/uploads/images/default.png'}" 
                             alt="Hình ảnh chi tiết" 
                             style="max-width: 300px; border-radius: 8px;">
                    </div>
                </div>
            `;
            
            modalBody.innerHTML = content;
            $(modal).modal('show');
        }

        function filterResults() {
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            const searchQuery = document.getElementById('search_query1')?.value || '';
            
            window.location.href = `index.php?start_date=${startDate}&end_date=${endDate}&search_query1=${searchQuery}`;
        }

        $(document).ready(function() {
            $('#medicalRecordsTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "pageLength": 5,
                "language": {
                    "paginate": {
                        "first": "Đầu",
                        "last": "Cuối",
                        "next": "Tiếp",
                        "previous": "Trước"
                    },
                    "info": "Hiển thị trang _PAGE_ của _PAGES_",
                    "infoEmpty": "Không có bản ghi nào",
                    "zeroRecords": "Không tìm thấy kết quả"
                }
            });
        });
    </script>
</body>
</html>