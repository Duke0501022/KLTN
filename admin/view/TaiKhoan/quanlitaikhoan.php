<?php
include_once("controller/TaiKhoan/ctaikhoan.php");

$p = new ctaikhoan();
$roleNames = array(
  1 => 'admin',
  2 => 'phuhuynh',
  3 => 'chuyenvien',
  4 => 'quantrichuyenvien',
  5 => 'giaovien',
  6 => 'quantrigiaovien'
);

$roleMap = array_flip($roleNames); // Create a reverse mapping array

if (isset($_POST['search_role']) && $_POST['search_role'] != '') {
    $roleInput = $_POST['search_role'];
    if (isset($roleMap[$roleInput])) {
        $Role = $roleMap[$roleInput]; // Map role name to its corresponding integer value
        $table = $p->select_taikhoan_role($Role);
    } else {
        // Handle case where the role name does not exist in the map
        $table = false; // or you can set an error message
    }
} else {
    $table = $p->select_taikhoan();
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý Thông Tin Tài Khoản</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Quản lý Thông Tin Tài Khoản</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách thông tin tài khoản</h3> | <a href="index.php?addtk">Thêm tài khoản</a>

                            <div class="card-tools">
                                <form method="POST" action="">
                                    <div class="input-group input-group-sm" style="width: 300px;">
                                        <input type="text" name="search_role" class="form-control float-right" placeholder="Nhập vai trò cần tìm" value="<?php echo htmlspecialchars(isset($_POST['search_role']) ? $_POST['search_role'] : ''); ?>">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th style='text-align:center'>STT</th>
                                        <th style='text-align:center'>Username</th>
                                        <th style='text-align:center'>Password</th>
                                        <th style='text-align:center'>Vai trò</th>
                                        <th style='text-align:center'>Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody class="pagination-rows">
                                    <?php
                                    if ($table) {
                                        $stt = 1;
                                        $roleNames = array(1 => 'admin', 2 => 'phuhuynh', 3 => 'chuyenvien', 4 => 'quantrichuyenvien', 5 => 'giaovien', 6 => 'quantrigiaovien');
                                        if (mysqli_num_rows($table) > 0) {
                                            while ($row = mysqli_fetch_assoc($table)) {
                                                echo "<tr class='pagination-row'>";
                                                echo "<td style='text-align:center'>" . $stt++ . "</td>";
                                                echo "<td style='text-align:center'>" . htmlspecialchars($row['username']) . "</td>";
                                                echo "<td style='text-align:center'>" . htmlspecialchars($row['password']) . "</td>";
                                                echo "<td style='text-align:center'>" . htmlspecialchars($roleNames[$row['Role']]) . "</td>";
                                                echo "<td style='text-align:center'>
                                                <a href='?updatetk&&username=" . htmlspecialchars($row['username']) . "&&Role=" . htmlspecialchars($row['Role']) . "'><i class='fa fa-pen' aria-hidden='true'></i></a> | 
                                                <a href='?deletetk&&username=" . htmlspecialchars($row['username']) . "' onclick='return confirmDelete();'><i class='fa fa-trash' aria-hidden='true'></i></a>
                                              </td>";
                                        
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
                    <div id="pagination-container" class="pagination-container"></div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
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

        const paginationContainer = document.getElementById('pagination-container');

        for (let i = 1; i <= pageCount; i++) {
            const button = document.createElement('button');
            button.innerText = i;
            button.addEventListener('click', function () {
                showPage(i, pageSize);
            });
            paginationContainer.appendChild(button);
        }
    });
    function confirmDelete() {
    return confirm("Bạn có muốn xoá  này chứ ?");
}
</script>
