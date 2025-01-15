<?php 

include_once("controller/cLichSu.php");

$p = new cLichSu();

$table = $p->select_ketqua();

?>
    <style>
       body {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    margin: 0;
    padding: 0;
    
    min-height: 100vh;
}

.container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 2rem;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #2c3e50;
    font-size: 2.5rem;
    margin-bottom: 2rem;
    font-weight: 600;
    position: relative;
}

h1:after {
    content: '';
    display: block;
    width: 100px;
    height: 4px;
    background: linear-gradient(90deg, #318EA5, #5ab9d1);
    margin: 10px auto;
    border-radius: 2px;
}

.search-container {
    text-align: center;
    margin-bottom: 2rem;
}

.search-input {
    padding: 12px 24px;
    width: 400px;
    border: 2px solid #e0e0e0;
    border-radius: 50px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="%23999" class="bi bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg>') no-repeat;
    background-position: 16px center;
    padding-left: 45px;
}

.search-input:focus {
    outline: none;
    border-color: #318EA5;
    box-shadow: 0 0 0 3px rgba(49, 142, 165, 0.2);
}

table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin-top: 1rem;
    background: white;
    border-radius: 12px;
    overflow: hidden;
}

th, td {
    padding: 16px;
    text-align: left;
    border-bottom: 1px solid #edf2f7;
}

th {
    background: #318EA5;
    color: white;
    font-weight: 500;
    text-transform: uppercase;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
}

tr:hover {
    background-color: #f8fafc;
}

.details-button {
    padding: 8px 16px;
    background: #318EA5;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.details-button:hover {
    background: #2b7d92;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(49, 142, 165, 0.2);
}

.details-row table {
    margin: 1rem;
    width: calc(100% - 2rem);
    background: #f8fafc;
    border: 1px solid #edf2f7;
}

.details-row th {
    background: #2b7d92;
    font-size: 0.85rem;
}

.pagination {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-top: 2rem;
    flex-wrap: wrap;
}

.pagination a {
    color: #318EA5;
    padding: 8px 16px;
    text-decoration: none;
    border: 2px solid #318EA5;
    border-radius: 6px;
    transition: all 0.3s ease;
    font-weight: 500;
}

.pagination a.active {
    background-color: #318EA5;
    color: white;
    border-color: #318EA5;
}

.pagination a:hover:not(.active) {
    background-color: rgba(49, 142, 165, 0.1);
    transform: translateY(-1px);
}

@media (max-width: 768px) {
    .container {
        margin: 1rem;
        padding: 1rem;
    }
    
    .search-input {
        width: 100%;
        max-width: 300px;
    }
    
    table {
        display: block;
        overflow-x: auto;
    }
    
    th, td {
        padding: 12px;
        font-size: 0.9rem;
    }
}
    </style>


<body>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Lịch sử làm bài</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Lịch sử làm bài</li>
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
              <h3 class="card-title">Danh sách lịch sử làm bài</h3>
              <div class="card-tools">
                <div class="search-container">
                  <input type="text" id="searchInput" class="search-input" onkeyup="searchTable()" placeholder="Tìm kiếm theo tên tài khoản...">
                </div>
              </div>
            </div>
            <div class="card-body table-responsive p-0">
              <table id="historyTable" class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên Phụ Huynh</th>
                    <th>Email</th>
                    <th>Hình Ảnh</th>
                    <th>Điểm số</th>
                    <th>Nội dung đánh giá</th>
                    <th>Tên Unit</th>
                    <th>Ngày tạo</th>
                    <th>Chi tiết</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $stt = 1;
                $units = [];

                if ($table && mysqli_num_rows($table) > 0) {
                    while ($row = mysqli_fetch_assoc($table)) {
                        $unit = $row['tenUnit'];
                        $linhVuc = $row['tenLinhVuc'];
                        $diemLinhVuc = $row['diemLinhVuc'];
                        $key = $unit . '_' . $row['hoTenPH'] . '_' . $row['ngayTao']; // Thêm ngày tạo vào khóa

                        if (!isset($units[$key])) {
                            $units[$key] = [
                                'hoTen' => $row['hoTenPH'],
                                'email' => $row['email'],
                                'hinhAnh' => $row['hinhAnh'],
                                'diemSo' => $row['diemSo'],
                                'noiDungKetQua' => $row['noiDungKetQua'],
                                'tenUnit' => $row['tenUnit'],
                                'ngaytao' => $row['ngayTao'],
                                'fields' => []
                            ];
                        }

                        if (!isset($units[$key]['fields'][$linhVuc])) {
                            $units[$key]['fields'][$linhVuc] = 0;
                        }

                        $units[$key]['fields'][$linhVuc] += $diemLinhVuc;
                    }

                    foreach ($units as $key => $data) {
                        echo "<tr>";
                        echo "<td>{$stt}</td>";
                        echo "<td>{$data['hoTen']}</td>";
                        echo "<td>{$data['email']}</td>";
                        if ($data['hinhAnh'] == NULL) {
                            echo "<td><img class='rounded-image' src='/assets/uploads/images/user.png' alt='' height='100px' width='150px'></td>";
                        } else {
                            echo "<td><img class='rounded-image' src='admin/assets/uploads/images/{$data['hinhAnh']}' alt='' height='100px' width='150px'></td>";
                        }
                        echo "<td>{$data['diemSo']}</td>";
                        echo "<td>{$data['noiDungKetQua']}</td>";
                        echo "<td>{$data['tenUnit']}</td>";
                        echo "<td>{$data['ngaytao']}</td>";
                        echo "<td><button class='details-button' onclick='toggleDetails(\"details-{$stt}\")'>Xem chi tiết</button></td>";
                        echo "</tr>";

                        echo "<tr id='details-{$stt}' class='details-row' style='display: none;'>";
                        echo "<td colspan='8'>";
                        echo "<table>";
                        echo "<thead><tr><th>Lĩnh vực</th><th>Điểm số</th></tr></thead>";
                        echo "<tbody>";
                        foreach ($data['fields'] as $linhVuc => $diemLinhVuc) {
                            echo "<tr><td>{$linhVuc}</td><td>{$diemLinhVuc}</td></tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        echo "</td>";
                        echo "</tr>";

                        $stt++;
                    }
                }
                ?>
                </tbody>
              </table>
              <div class="pagination">
                <!-- Pagination links will be added here by JavaScript -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
        function searchTable() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('historyTable');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                const td = tr[i].getElementsByTagName('td')[1];
                if (td) {
                    const txtValue = td.textContent || td.innerText;
                    tr[i].style.display = txtValue.toLowerCase().indexOf(filter) > -1 ? '' : 'none';
                }
            }
        }

        function paginateTable() {
            const rowsPerPage = 10;
            const table = document.getElementById('historyTable');
            const rows = table.getElementsByTagName('tr');
            const totalRows = rows.length - 1; // Exclude header row
            const totalPages = Math.ceil(totalRows / rowsPerPage);
            const pagination = document.querySelector('.pagination');

            pagination.innerHTML = '';

            for (let i = 1; i <= totalPages; i++) {
                const link = document.createElement('a');
                link.href = '#';
                link.textContent = i;
                link.onclick = function () {
                    showPage(i);
                    return false;
                };
                pagination.appendChild(link);
            }

            showPage(1);

            function showPage(page) {
                for (let i = 1; i < rows.length; i++) {
                    rows[i].style.display = 'none';
                }

                const start = (page - 1) * rowsPerPage + 1;
                const end = start + rowsPerPage;

                for (let i = start; i < end && i < rows.length; i++) {
                    rows[i].style.display = '';
                }

                const links = pagination.getElementsByTagName('a');
                for (let i = 0; i < links.length; i++) {
                    links[i].classList.remove('active');
                }
                links[page - 1].classList.add('active');

                // Ẩn tất cả các hàng chi tiết khi chuyển trang
                const detailRows = document.querySelectorAll('.details-row');
                detailRows.forEach(row => {
                    row.style.display = 'none';
                });
            }
        }

        function toggleDetails(id) {
            const row = document.getElementById(id);
            if (row) {
                row.style.display = row.style.display === 'none' || row.style.display === '' ? 'table-row' : 'none';
            }
        }

        window.onload = function () {
            paginateTable();
        };
    </script>
</body>