<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

include_once('Controller/cXemLichSu.php');
if (!isset($_SESSION['LoginSuccess']) || $_SESSION['LoginSuccess'] !== true) {
    // Redirect to login page if not logged in
    header('Location: index.php?login');
    exit();
}
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $idPhuHuynh = $_SESSION['idPhuHuynh'] ?? null; // Sử dụng null coalescing operator
} else {
    $username = null;
    $idPhuHuynh = null;
}

$xemls = new cSeeLichSu();
$res = $xemls->get_lichsu($idPhuHuynh, $username);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử làm bài</title>
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

        th,
        td {
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

        .details-row {
            display: none;
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

            th,
            td {
                padding: 12px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Lịch sử làm bài</h1>
        <div class="search-container">
            <input type="text" id="searchInput" class="search-input" onkeyup="searchTable()" placeholder="Tìm kiếm theo tên tài khoản...">
        </div>
        <table id="historyTable">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Unit</th>
                    <th>Điểm Tổng</th>
                    <th>Nội dung Đánh Giá</th>
                    <th>Ngày làm bài</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stt = 1;
                $units = [];

                if (is_object($res) && mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $unit = $row['tenUnit'];
                        $linhVuc = $row['tenLinhVuc'];
                        $diemLinhVuc = $row['diemLinhVuc'];
                        $ngayLamBai = date(' H:i:s d-m-Y ', strtotime($row['ngayTao']));

                        $diemunit = $row['diemSo'];
                        $noiDung = $row['noiDungKetQua'];
                        $key = $unit . '_' . $ngayLamBai;

                        if (!isset($units[$key])) {
                            $units[$key] = [
                                'unit' => $unit,
                                'ngayTao' => $ngayLamBai,
                                'diemunit' => $diemunit,
                                'noiDung' => $noiDung,
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
                        echo "<td>{$data['unit']}</td>";
                        echo "<td>{$data['diemunit']}</td>";
                        echo "<td>{$data['noiDung']}</td>";
                        echo "<td>{$data['ngayTao']}</td>";
                        echo "<td><button class='details-button' onclick='toggleDetails(\"details-{$stt}\")'>Xem chi tiết</button></td>";
                        echo "</tr>";

                        echo "<tr id='details-{$stt}' class='details-row'>";
                        echo "<td colspan='6'>";
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
        <div class="pagination" id="pagination">
            <!-- Pagination links will be added here by JavaScript -->
        </div>
    </div>

    <script>
    function paginateTable() {
        const rows = document.querySelectorAll('table tbody tr:not(.details-row)');
        const rowsPerPage = 2;
        const pageCount = Math.ceil(rows.length / rowsPerPage);
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

        function showPage(page) {
            for (let i = 0; i < rows.length; i++) {
                rows[i].style.display = 'none';
            }
            for (let i = (page - 1) * rowsPerPage; i < page * rowsPerPage && i < rows.length; i++) {
                rows[i].style.display = '';
                const detailsRow = document.getElementById('details-' + (i + 1));
                if (detailsRow) {
                    detailsRow.style.display = 'none';
                }
            }
            const links = pagination.getElementsByTagName('a');
            for (let i = 0; i < links.length; i++) {
                links[i].classList.remove('active');
            }
            links[page - 1].classList.add('active');
        }

        for (let i = 1; i <= pageCount; i++) {
            const link = document.createElement('a');
            link.href = '#';
            link.innerText = i;
            link.addEventListener('click', function (e) {
                e.preventDefault();
                showPage(i);
            });
            pagination.appendChild(link);
        }

        showPage(1);
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

</html>