<?php 
    include_once("controller/Luong/cLuong.php");
    $p = new cLuong();
    $table = $p->select_luong();
?>
<style>
  .pagination {
    margin-top: 20px;
}

.pagination-button {
    background-color: #007bff;
    border: none;
    color: white;
    padding: 10px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    margin-right: 5px;
    transition: background-color 0.3s ease;
}

.pagination-button:hover {
    background-color: #0056b3;
}

    /* Bo góc cho hình ảnh */
    .pagination-rows img {
        border-radius: 5px;
        transition: transform 0.3s ease;
    }

    /* Hiệu ứng hover */
    .pagination-rows img:hover {
        transform: scale(1.05);
    }


</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý Lương</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Quản lý Lương</li>
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
                            <h3 class="card-title">Danh sách thông tin bảng lương</h3> | <a href="index.php?tinhluong">Tính lương</a>
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
                                        <th style="text-align:center">Mã chuyên viên</th>
                                        <th style="text-align:center">Tên chuyên viên</th>
                                        <th style="text-align:center">Số điện thoại</th>
                                        <th style="text-align:center">Tuổi</th>
                                        <th style="text-align:center">Email</th>
                                        <th style="font-weight:bold;text-align:center">Hình ảnh</th>
                                        <th style="text-align:center">Giới tính</th>
                                        <th style="text-align:center">Username</th>
                                        <th style="text-align:center">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody class="pagination-rows">
                                    <?php
                                    if ($table) {
                                        $stt = 1;
                                        if (mysqli_num_rows($table) > 0) {
                                            while ($row = mysqli_fetch_assoc($table)) {
                                                $currentDate = date("Y-m-d");
                                                $ngaySinh = new DateTime($row['ngaySinh']);
                                                $currentDateTime = new DateTime($currentDate);
                                                $tuoi = $ngaySinh->diff($currentDateTime)->y;

                                                echo "<tr class='pagination-row'>";
                                                echo "<td style='text-align:center'>" . $stt++ . "</td>";
                                                echo "<td style='text-align:center'>" . $row['idChuyenVien'] . "</td>";
                                                echo "<td style='text-align:center'>" . $row['hoTen'] . "</td>";
                                                echo "<td style='text-align:center'>" . $row['soDienThoai'] . "</td>";
                                                echo "<td style='text-align:center'>" . $tuoi . "</td>";
                                                echo "<td style='text-align:center'>" . $row['email'] . "</td>";
                                                if ($row['hinhAnh'] == NULL) {
                                                    echo "<td style='text-align:center'><img class='rounded-image' src='/assets/uploads/images/user.png' alt='' height='100px' width='150px'></td>";
                                                  } else {
                                                    echo "<td style='text-align:center'><img class='rounded-image' src='admin/assets/uploads/images/" . $row['hinhAnh'] . "' alt='' height='100px' width='150px'></td>";
                                                  }
                                                if ($row['gioiTinh'] == 0) {
                                                    echo "<td style='text-align:center'>Nam</td>";
                                                } else {
                                                    echo "<td style='text-align:center'>Nữ</td>";
                                                }
                                                echo "<td style='text-align:center'>" . $row['username'] . "</td>";
                                                echo "<td style='text-align:center'><a href='?updatenvpp&&idChuyenVien=" . $row['idChuyenVien'] . "'><i class='fa fa-pen' aria-hidden='true'></i></a> | <a href='?delnvpp&&idChuyenVien=" . $row['idChuyenVien'] . "&&username=" . $row['username'] . "' onclick='return confirm_delete();'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
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
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Script JavaScript -->
<script>
    function showPage(pageNumber, pageSize) {
        let rows = document.querySelectorAll('.pagination-row');
        let startIndex = (pageNumber - 1) * pageSize;
        let endIndex = pageNumber * pageSize;

        rows.forEach((row, index) => {
            if (index >= startIndex && index < endIndex) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        const pageSize = 5;
        const rows = document.querySelectorAll('.pagination-row');
        const pageCount = Math.ceil(rows.length / pageSize);

        showPage(1, pageSize);

        const paginationContainer = document.createElement('div');
        paginationContainer.classList.add('pagination');

        for (let i = 1; i <= pageCount; i++) {
            const button = document.createElement('button');
            button.innerText = i;
            button.addEventListener('click', function () {
                showPage(i, pageSize);
            });
            paginationContainer.appendChild(button);
        }

        document.querySelector('.content-wrapper').appendChild(paginationContainer);
    });
</script>
