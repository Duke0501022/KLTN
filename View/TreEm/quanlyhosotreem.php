<?php

include_once("Controller/cTreEm.php");
// session_start();

$p = new cHoSoTreEm();

// Lấy danh sách trẻ em theo username từ session
$table = $p->select_treem();

?>
<!-- Content Wrapper. Contains page content -->
<style>
    .rounded-image {
        border-radius: 10px;
        /* Bo góc hình ảnh */
        object-fit: cover;
        /* Đảm bảo hình ảnh được căn chỉnh và không bị vặn */
        transition: transform 0.3s ease;
        /* Hiệu ứng khi di chuột qua */
    }

    .rounded-image:hover {
        transform: scale(1.1);
        /* Phóng to hình ảnh khi di chuột qua */
    }
    .card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0,0,0,0.05);
    margin: 20px;
    overflow: hidden;
}

.card-header {
    background: linear-gradient(to right, #4b6cb7, #182848);
    color: white;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-header .card-title {
    font-size: 1.5rem;
    margin: 0;
}

.card-header a {
    background: rgba(255,255,255,0.2);
    color: white;
    padding: 8px 15px;
    border-radius: 20px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.card-header a:hover {
    background: rgba(255,255,255,0.3);
    transform: translateY(-2px);
}

/* Table styling */
.table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 8px;
    margin: 0;
}

.table thead th {
    background: #f8f9fa;
    padding: 15px;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
    border: none;
    color: #495057;
}

.table tbody tr {
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: transform 0.2s ease;
}

.table tbody tr:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.table tbody td {
    padding: 15px;
    background: white;
    vertical-align: middle;
    border: none;
}

.table tbody tr td:first-child {
    border-radius: 8px 0 0 8px;
}

.table tbody tr td:last-child {
    border-radius: 0 8px 8px 0;
}

/* Action buttons */
.table .fa {
    padding: 8px;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.table .fa-pen {
    color: #4b6cb7;
    margin-right: 10px;
}

.table .fa-pen:hover {
    background: rgba(75,108,183,0.1);
}

.table .fa-trash {
    color: #dc3545;
}

.table .fa-trash:hover {
    background: rgba(220,53,69,0.1);
}

/* Search box styling */
.input-group-sm {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.input-group-sm input {
    border: none;
    padding: 10px 15px;
}

.input-group-sm .btn {
    background: #4b6cb7;
    color: white;
    border: none;
    padding: 10px 15px;
}

.input-group-sm .btn:hover {
    background: #182848;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .card-header {
        flex-direction: column;
        gap: 10px;
    }
    
    .table-responsive {
        overflow-x: auto;
    }
    
    .table td, .table th {
        min-width: 120px;
    }
}
</style>

<body>
    <div><br></div>
    <!-- Content Wrapper -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh sách thông tin trẻ em</h3> <a href="?addTreEm">Thêm trẻ em mới</a>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center">STT</th>
                                            <th style="text-align:center">Họ tên trẻ em</th>
                                            <th style="text-align:center">Hình Ảnh</th>
                                            <th style="text-align:center">Ngày sinh</th>
                                            <th style="text-align:center">Trẻ được sinh vào thai kỳ thứ</th>
                                          
                                            <th style="text-align:center">Tình trạng</th>
                                            <th style="text-align:center">Giới Tính</th>
                                            <th style="text-align:center">Kết quả đánh giá</th>
                                            <th style="text-align:center">Tác vụ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($table) {
                                            $stt = 1;
                                            if (mysqli_num_rows($table) > 0) {
                                                while ($row = mysqli_fetch_assoc($table)) {
                                                    echo "<tr>";
                                                    echo "<td style='text-align:center'>" . $stt++ . "</td>"; // Tăng giá trị của biến đếm và hiển thị nó
                                                   
                                                    echo "<td style='text-align:center'>" . $row['hoTenTE'] . "</td>";
                                                    echo "<td><a href='" . ($row['hinhAnh'] ? 'admin/admin/assets/uploads/images/' . $row['hinhAnh'] : 'admin/admin/assets/uploads/images/user.png') . "' class='popup-link'><img class='rounded-image' src='" . ($row['hinhAnh'] ? 'admin/assets/uploads/images/' . $row['hinhAnh'] : '/assets/uploads/images/user.png') . "' alt='' height='100px' width='150px'></a></td>";
                                                    echo "<td style='text-align:center'>" . $row['ngaySinh'] . "</td>";
                                                    echo "<td style='text-align:center'>" . $row['thaiKy'] . "</td>";
                                                   
                                                    echo "<td style='text-align:center'>" . $row['tinhTrang'] . "</td>";
                                                    echo "<td style='text-align:center'>" . ($row["gioiTinh"] == 0 ? "Nam" : "Nữ") . "</td>";
                                                    echo "<td style='text-align:center'>" . $row['noiDungKetQua'] . "</td>";
                                                    echo "<td style='text-align:center'><a href='?updatetreem&&idHoSo=" . $row['idHoSo'] . "'><i class='fa fa-pen' aria-hidden='true'></i></a> | <a href='?deleteTreEm&&idHoSo=" . $row['idHoSo'] . "' onclick='return confirm_delete();'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
                                                    echo "</tr>";
                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- JavaScript -->
    <script>
        function confirm_delete() {
            return confirm('Bạn có chắc chắn muốn xóa?');
        }
    </script>
</body>
<!-- /.content-wrapper -->